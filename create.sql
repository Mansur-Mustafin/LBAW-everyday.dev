--
-- Set lbaw2441 as a default schema.
--
DROP SCHEMA IF EXISTS lbaw2441 CASCADE;
CREATE SCHEMA IF NOT EXISTS lbaw2441;
SET search_path TO lbaw2441;

--
-- Define enums
--
CREATE TYPE Ranking AS ENUM ('noobie', 'code monkey', 'spaghetti code chef', 'rock star', '10x developer', '404 error evader');
CREATE TYPE UserStatus AS ENUM ('active', 'blocked', 'pending');
CREATE TYPE VoteType AS ENUM ('PostVote', 'CommentVote');
CREATE TYPE NotificationType AS ENUM ('PostNotification', 'VoteNotification', 'FollowNotification', 'CommentNotification');
CREATE TYPE ReportType AS ENUM ('PostReport', 'UserReport', 'CommentReport');

--
-- Create Tables
--
CREATE TABLE "user" (
    id SERIAL PRIMARY KEY,
    username VARCHAR NOT NULL UNIQUE,
    public_name VARCHAR NOT NULL,
    password VARCHAR NOT NULL,
    image_path VARCHAR,
    email VARCHAR NOT NULL UNIQUE,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP CHECK (created_at <= CURRENT_TIMESTAMP),
    rank Ranking NOT NULL DEFAULT 'noobie',
    status UserStatus NOT NULL DEFAULT 'active',
    reputation INTEGER NOT NULL DEFAULT 0,
    is_admin BOOLEAN NOT NULL DEFAULT FALSE
);

CREATE TABLE news_post (
    id SERIAL PRIMARY KEY,
    title VARCHAR NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP CHECK (created_at <= CURRENT_TIMESTAMP),
    changed_at TIMESTAMP DEFAULT NULL CHECK (changed_at <= CURRENT_TIMESTAMP),
    content TEXT NOT NULL,
    for_followers BOOLEAN NOT NULL DEFAULT TRUE,
    upvotes INTEGER NOT NULL DEFAULT 0 CHECK (upvotes >= 0),
    downvotes INTEGER NOT NULL DEFAULT 0 CHECK (downvotes >= 0),
    author_id INTEGER NOT NULL REFERENCES "user"(id),
    CHECK (changed_at IS NULL OR created_at < changed_at)
);

CREATE TABLE image (
    id SERIAL PRIMARY KEY,
    path VARCHAR NOT NULL,
    is_title_image BOOLEAN NOT NULL DEFAULT FALSE,
    news_post_id INTEGER REFERENCES news_post(id)
);

CREATE TABLE comment (
    id SERIAL PRIMARY KEY,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP CHECK (created_at <= CURRENT_TIMESTAMP),
    content TEXT NOT NULL,
    author_id INTEGER NOT NULL REFERENCES "user"(id),
    news_post_id INTEGER REFERENCES news_post(id),
    parent_comment_id INTEGER REFERENCES comment(id),
    CHECK (
        (news_post_id IS NOT NULL AND parent_comment_id IS NULL) OR
        (parent_comment_id IS NOT NULL AND news_post_id IS NULL)
    )
);

CREATE TABLE vote (
    id SERIAL PRIMARY KEY,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP CHECK (created_at <= CURRENT_TIMESTAMP),
    vote_type VoteType NOT NULL,
    is_upvote BOOLEAN NOT NULL,
    user_id INTEGER NOT NULL REFERENCES "user"(id),
    news_post_id INTEGER REFERENCES news_post(id),
    comment_id INTEGER REFERENCES comment(id),
    CHECK (
        (vote_type = 'PostVote' AND news_post_id IS NOT NULL AND comment_id IS NULL) OR
        (vote_type = 'CommentVote' AND comment_id IS NOT NULL AND news_post_id IS NULL)
    )
);

CREATE TABLE notification (
    id SERIAL PRIMARY KEY,
    is_viewed BOOLEAN NOT NULL DEFAULT FALSE,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP CHECK (created_at <= CURRENT_TIMESTAMP),
    notification_type NotificationType NOT NULL,
    user_id INTEGER NOT NULL REFERENCES "user"(id),
    news_post_id INTEGER REFERENCES news_post(id),
    vote_id INTEGER REFERENCES vote(id),
    follower_id INTEGER REFERENCES "user"(id),
    comment_id INTEGER REFERENCES comment(id),
    CHECK (
        (notification_type = 'PostNotification' AND news_post_id IS NOT NULL) OR
        (notification_type = 'VoteNotification' AND vote_id IS NOT NULL) OR
        (notification_type = 'FollowNotification' AND follower_id IS NOT NULL) OR
        (notification_type = 'CommentNotification' AND comment_id IS NOT NULL)
    )
);

CREATE TABLE report (
    id SERIAL PRIMARY KEY,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP CHECK (created_at <= CURRENT_TIMESTAMP),
    description TEXT,
    report_type ReportType NOT NULL,
    reporter_id INTEGER NOT NULL REFERENCES "user"(id),
    news_post_id INTEGER REFERENCES news_post(id),
    comment_id INTEGER REFERENCES comment(id),
    reported_user_id INTEGER REFERENCES "user"(id),
    CHECK (
        (
            (report_type = 'PostReport' AND news_post_id IS NOT NULL) OR
            (report_type = 'CommentReport' AND comment_id IS NOT NULL) OR
            (report_type = 'UserReport' AND reported_user_id IS NOT NULL)
        ) AND
        (reporter_id <> reported_user_id)
    )
);

CREATE TABLE tag (
    id SERIAL PRIMARY KEY,
    name VARCHAR NOT NULL UNIQUE
);

CREATE TABLE news_post_tag (
    news_post_id INTEGER NOT NULL REFERENCES news_post(id),
    tag_id INTEGER NOT NULL REFERENCES tag(id),
    PRIMARY KEY (news_post_id, tag_id)
);

CREATE TABLE tag_proposal (
    id SERIAL PRIMARY KEY,
    description TEXT NOT NULL,
    is_resolved BOOLEAN NOT NULL DEFAULT FALSE,
    proposer_id INTEGER NOT NULL REFERENCES "user"(id)
);

CREATE TABLE unblock_appeal (
    id SERIAL PRIMARY KEY,
    description TEXT NOT NULL,
    is_resolved BOOLEAN NOT NULL DEFAULT FALSE,
    user_id INTEGER NOT NULL REFERENCES "user"(id)
);

CREATE TABLE follows (
    follower_id INTEGER NOT NULL REFERENCES "user"(id),
    followed_id INTEGER NOT NULL REFERENCES "user"(id),
    PRIMARY KEY (follower_id, followed_id),
    CHECK (follower_id <> followed_id)
);

CREATE TABLE user_tag_subscribes (
    user_id INTEGER NOT NULL REFERENCES "user"(id),
    tag_id INTEGER NOT NULL REFERENCES tag(id),
    PRIMARY KEY (user_id, tag_id)
);

CREATE TABLE bookmarks (
    user_id INTEGER NOT NULL REFERENCES "user"(id),
    news_post_id INTEGER NOT NULL REFERENCES news_post(id),
    PRIMARY KEY (user_id, news_post_id)
);
