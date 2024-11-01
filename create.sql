--
-- Drop old schema
--
DROP SCHEMA IF EXISTS lbaw2441 CASCADE;

--
-- Set lbaw2441 as a default schema.
--
CREATE SCHEMA IF NOT EXISTS lbaw2441;
SET search_path TO lbaw2441;

--
-- Define enums
--
CREATE TYPE Ranking AS ENUM ('noobie', 'code monkey', 'spaghetti code chef', 'rock star', '10x developer', '404 error evader');
CREATE TYPE UserStatus AS ENUM ('active', 'blocked', 'pending', 'deleted');
CREATE TYPE VoteType AS ENUM ('PostVote', 'CommentVote');
CREATE TYPE NotificationType AS ENUM ('PostNotification', 'VoteNotification', 'FollowNotification', 'CommentNotification');
CREATE TYPE ReportType AS ENUM ('PostReport', 'UserReport', 'CommentReport');
CREATE TYPE ImageType AS ENUM ('Profile', 'PostTitle', 'PostContent');

--
-- Create Tables
--
CREATE TABLE "user" (
    id SERIAL PRIMARY KEY,
    username VARCHAR(256) NOT NULL UNIQUE,
    public_name VARCHAR(256) NOT NULL,
    password VARCHAR NOT NULL,
    email VARCHAR(256) NOT NULL UNIQUE,
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
    is_omitted BOOLEAN NOT NULL DEFAULT FALSE,
    author_id INTEGER NOT NULL REFERENCES "user"(id),
    CHECK (changed_at IS NULL OR created_at < changed_at)
);

CREATE TABLE image (
    id SERIAL PRIMARY KEY,
    path VARCHAR NOT NULL UNIQUE,
    image_type ImageType NOT NULL,
    news_post_id INTEGER REFERENCES news_post(id),
    user_id INTEGER REFERENCES "user"(id),
    CHECK (
        (image_type = 'Profile' AND user_id IS NOT NULL) OR
        ((image_type = 'PostTitle' OR image_type = 'PostContent') AND news_post_id IS NOT NULL)
    )
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
    user_id INTEGER NOT NULL REFERENCES "user"(id),     -- vote's author
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
    user_id INTEGER NOT NULL REFERENCES "user"(id),     -- notified user
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
    name VARCHAR(64) NOT NULL UNIQUE
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
    follower_id INTEGER NOT NULL REFERENCES "user"(id),     -- who follows
    followed_id INTEGER NOT NULL REFERENCES "user"(id),     -- who is followed
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

--
-- Unique Indexes
--
CREATE UNIQUE INDEX unique_title_image_per_post
ON image (news_post_id)
WHERE image_type = 'PostTitle';

CREATE UNIQUE INDEX unique_report_post
ON report (reporter_id, news_post_id)
WHERE report_type = 'PostReport';

CREATE UNIQUE INDEX unique_report_comment
ON report (reporter_id, comment_id)
WHERE report_type = 'CommentReport';

CREATE UNIQUE INDEX unique_report_user
ON report (reporter_id, reported_user_id)
WHERE report_type = 'UserReport';

CREATE UNIQUE INDEX unique_user_post_vote
ON vote (user_id, news_post_id)
WHERE vote_type = 'PostVote';

CREATE UNIQUE INDEX unique_user_comment_vote
ON vote (user_id, comment_id)
WHERE vote_type = 'CommentVote';

CREATE UNIQUE INDEX unique_user_post_content 
ON news_post (author_id, title, content);

--
-- Performance Indexes
--

CREATE INDEX idx_news_post_author_id ON news_post USING btree (author_id);

CREATE INDEX idx_news_post_created_at ON news_post USING btree (created_at);

CREATE INDEX idx_comments_news_post_id ON comment USING hash (news_post_id);

--
-- Full-Text Search Indexes
--

ALTER TABLE news_post
ADD COLUMN tsvectors TSVECTOR;

CREATE FUNCTION news_post_search_update() RETURNS TRIGGER AS $$
BEGIN
    IF TG_OP = 'INSERT' THEN
        NEW.tsvectors = (
            setweight(to_tsvector('english', NEW.title), 'A') ||
            setweight(to_tsvector('english', NEW.content), 'B')
        );
    ELSIF TG_OP = 'UPDATE' THEN
        IF (NEW.title <> OLD.title OR NEW.content <> OLD.content) THEN
            NEW.tsvectors = (
                setweight(to_tsvector('english', NEW.title), 'A') ||
                setweight(to_tsvector('english', NEW.content), 'B')
            );
        END IF;
    END IF;
    RETURN NEW;
END $$
LANGUAGE plpgsql;

CREATE TRIGGER news_post_search_update
    BEFORE INSERT OR UPDATE ON news_post
    FOR EACH ROW
    EXECUTE FUNCTION news_post_search_update();

CREATE INDEX idx_news_post_search ON news_post USING GIN (tsvectors);


ALTER TABLE comment
ADD COLUMN tsvectors TSVECTOR;

CREATE FUNCTION news_comment_search_update() RETURNS TRIGGER AS $$
BEGIN
    IF TG_OP = 'INSERT' THEN
        NEW.tsvectors = to_tsvector('english', NEW.content);
    ELSIF TG_OP = 'UPDATE' THEN
        IF (NEW.content <> OLD.content) THEN
            NEW.tsvectors = to_tsvector('english', NEW.content);
        END IF;
    END IF;
    RETURN NEW;
END $$
LANGUAGE plpgsql;

CREATE TRIGGER news_comment_search_update
    BEFORE INSERT OR UPDATE ON comment
    FOR EACH ROW
    EXECUTE FUNCTION news_comment_search_update();

CREATE INDEX idx_news_comment_search ON comment USING GIN (tsvectors);

