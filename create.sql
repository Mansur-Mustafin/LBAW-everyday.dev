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
    is_omitted BOOLEAN NOT NULL DEFAULT FALSE,
    upvotes INTEGER NOT NULL DEFAULT 0 CHECK (upvotes >= 0),
    downvotes INTEGER NOT NULL DEFAULT 0 CHECK (downvotes >= 0),
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

-- if the vote is deleted or "undo-ed", the notification associated with it is deleted

CREATE TABLE notification (
    id SERIAL PRIMARY KEY,
    is_viewed BOOLEAN NOT NULL DEFAULT FALSE,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP CHECK (created_at <= CURRENT_TIMESTAMP),
    notification_type NotificationType NOT NULL,
    user_id INTEGER NOT NULL REFERENCES "user"(id),     -- notified user
    news_post_id INTEGER REFERENCES news_post(id),
    vote_id INTEGER REFERENCES vote(id) ON DELETE CASCADE,
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

-- delete news post tag if the tag is deleted

CREATE TABLE news_post_tag (
    news_post_id INTEGER NOT NULL REFERENCES news_post(id),
    tag_id INTEGER NOT NULL REFERENCES tag(id) ON DELETE CASCADE,
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

-- remove subcribe from tag if the tag is deleted

CREATE TABLE user_tag_subscribes (
    user_id INTEGER NOT NULL REFERENCES "user"(id),
    tag_id INTEGER NOT NULL REFERENCES tag(id) ON DELETE CASCADE,
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

CREATE UNIQUE INDEX unique_follow_notification 
ON notification (notification_type, user_id, follower_id)
WHERE notification_type = 'FollowNotification';

CREATE UNIQUE INDEX unique_post_vote_notification
ON notification (notification_type, user_id, vote_id)
WHERE notification_type = 'VoteNotification';

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

--
-- Triggers
--

-- Trigger 1
CREATE OR REPLACE FUNCTION update_changed_at()
RETURNS TRIGGER AS $$
BEGIN
    IF NEW.content <> OLD.content OR NEW.title <> OLD.title THEN
        NEW.changed_at := CURRENT_TIMESTAMP;
    END IF;
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER trigger_update_changed_at
BEFORE UPDATE ON news_post
FOR EACH ROW
EXECUTE FUNCTION update_changed_at();

-- Trigger 2
CREATE OR REPLACE FUNCTION update_user_ranking()
RETURNS TRIGGER AS $$
BEGIN
    IF NEW.reputation <= 999 THEN
        NEW.rank := 'noobie';
    ELSIF NEW.reputation BETWEEN 1000 AND 1999 THEN
        NEW.rank := 'code monkey';
    ELSIF NEW.reputation BETWEEN 2000 AND 2999 THEN
        NEW.rank := 'spaghetti code chef';
    ELSIF NEW.reputation BETWEEN 3000 AND 3999 THEN
        NEW.rank := 'rock star';
    ELSIF NEW.reputation BETWEEN 4000 AND 4999 THEN
        NEW.rank := '10x developer';
    ELSE
        NEW.rank := '404 error evader';
    END IF;

    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER trigger_update_user_ranking
BEFORE UPDATE OF reputation ON "user"
FOR EACH ROW
EXECUTE FUNCTION update_user_ranking();

-- Trigger 3
CREATE OR REPLACE FUNCTION limit_daily_posts()
RETURNS TRIGGER AS $$
BEGIN
    IF (SELECT COUNT(*) FROM news_post WHERE author_id = NEW.author_id AND created_at::DATE = CURRENT_DATE) >= 10  THEN
        RAISE EXCEPTION 'User cannot create more than 10 posts per day.';
    END IF;
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER trigger_limit_daily_posts
BEFORE INSERT ON news_post
FOR EACH ROW
EXECUTE FUNCTION limit_daily_posts();

-- Trigger 4
CREATE OR REPLACE FUNCTION omit_post_after_reports()
RETURNS TRIGGER AS $$
BEGIN
    IF (SELECT COUNT(*) FROM report WHERE news_post_id = NEW.news_post_id) >= 10 THEN
        UPDATE news_post SET is_omitted = TRUE WHERE id = NEW.news_post_id AND is_omitted = FALSE;
    END IF;
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER trigger_omit_post_after_reports
AFTER INSERT ON report
FOR EACH ROW
EXECUTE FUNCTION omit_post_after_reports();

-- Trigger 5
CREATE OR REPLACE FUNCTION limit_daily_reports()
RETURNS TRIGGER AS $$
BEGIN
    IF (SELECT COUNT(*) FROM report WHERE reporter_id = NEW.reporter_id AND created_at::DATE = CURRENT_DATE) >= 3 THEN
        RAISE EXCEPTION 'User cannot make more than 3 reports per day.';
    END IF;
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER trigger_limit_daily_reports
BEFORE INSERT ON report
FOR EACH ROW
EXECUTE FUNCTION limit_daily_reports();

-- Trigger 6
CREATE OR REPLACE FUNCTION prevent_post_deletion_with_references()
RETURNS TRIGGER AS $$
BEGIN
    IF EXISTS (SELECT 1 FROM comment WHERE news_post_id = OLD.id) THEN
        RAISE EXCEPTION 'Cannot delete post: It has associated comments.';
    END IF;

    IF EXISTS (SELECT 1 FROM vote WHERE news_post_id = OLD.id) THEN
        RAISE EXCEPTION 'Cannot delete post: It has associated votes.';
    END IF;

    RETURN OLD;  
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER trigger_prevent_post_deletion_with_references
BEFORE DELETE ON news_post
FOR EACH ROW
EXECUTE FUNCTION prevent_post_deletion_with_references();

-- Trigger 7
CREATE OR REPLACE FUNCTION prevent_comment_deletion_with_references()
RETURNS TRIGGER AS $$
BEGIN
    IF EXISTS (SELECT 1 FROM comment WHERE parent_comment_id = OLD.id) THEN
        RAISE EXCEPTION 'Cannot delete comment: It has associated replies.';
    END IF;

    IF EXISTS (SELECT 1 FROM vote WHERE comment_id = OLD.id) THEN
        RAISE EXCEPTION 'Cannot delete comment: It has associated votes.';
    END IF;

    RETURN OLD;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER trigger_prevent_comment_deletion_with_references
BEFORE DELETE ON comment
FOR EACH ROW
EXECUTE FUNCTION prevent_comment_deletion_with_references();


-- Trigger 8
CREATE OR REPLACE FUNCTION notify_on_comment() RETURNS TRIGGER AS $$
DECLARE authorid INTEGER;
BEGIN

    IF NEW.news_post_id IS NOT NULL THEN 
        SELECT author_id INTO authorid FROM news_post WHERE id = NEW.news_post_id;
        IF authorid <> NEW.author_id THEN
            INSERT INTO notification (notification_type, user_id, comment_id) 
            VALUES ('CommentNotification', authorid, NEW.id);
        END IF;
    
    ELSIF NEW.parent_comment_id IS NOT NULL THEN
        SELECT author_id INTO authorid FROM comment WHERE id = NEW.parent_comment_id;
        IF authorid <> NEW.author_id THEN
            INSERT INTO notification (notification_type, user_id, comment_id) 
            VALUES ('CommentNotification', authorid, NEW.id);
        END IF;
    END IF;

    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER trigger_notify_on_comment
AFTER INSERT ON comment
FOR EACH ROW
EXECUTE FUNCTION notify_on_comment();

-- Trigger 9
CREATE OR REPLACE FUNCTION notify_on_new_post()
RETURNS TRIGGER AS $$
BEGIN
    -- Insert a notification for each follower of the post author
    INSERT INTO notification (notification_type, user_id, news_post_id)
    SELECT 'PostNotification', follower_id, NEW.id
    FROM follows
    WHERE followed_id = NEW.author_id;

    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER trigger_notify_on_new_post
AFTER INSERT ON news_post
FOR EACH ROW
EXECUTE FUNCTION notify_on_new_post();

-- Trigger 10
CREATE OR REPLACE FUNCTION notify_on_follow() RETURNS TRIGGER AS $$
BEGIN
    INSERT INTO notification ( notification_type, user_id, follower_id) 
    VALUES ('FollowNotification', NEW.followed_id, NEW.follower_id);

    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER trigger_notify_on_follow
AFTER INSERT ON follows
FOR EACH ROW
EXECUTE FUNCTION notify_on_follow();

-- Trigger 11
CREATE OR REPLACE FUNCTION notify_on_vote() RETURNS TRIGGER AS $$
DECLARE
    authorid INTEGER;
BEGIN

    IF NEW.vote_type = 'PostVote' THEN
        SELECT author_id INTO authorid FROM news_post WHERE id = NEW.news_post_id;
        
        INSERT INTO notification (notification_type, user_id, vote_id) 
        VALUES ('VoteNotification', authorid, NEW.id);

    ELSIF NEW.vote_type = 'CommentVote' THEN
        SELECT author_id INTO authorid FROM comment WHERE id = NEW.comment_id;
        
        INSERT INTO notification (notification_type, user_id, vote_id) 
        VALUES ('VoteNotification', authorid, NEW.id);
    END IF;

    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER trigger_notify_on_vote
AFTER INSERT ON vote
FOR EACH ROW
EXECUTE FUNCTION notify_on_vote();


-- Trigger 12
CREATE OR REPLACE FUNCTION adjust_reputation_on_post_vote()
RETURNS TRIGGER AS $$
DECLARE
    post_author_id INTEGER;
    reputation_change INTEGER;
BEGIN
    IF TG_OP = 'INSERT' AND NEW.vote_type = 'PostVote' THEN
        IF NEW.is_upvote THEN
            reputation_change := 10;
        ELSE
            reputation_change := -10;
        END IF;
        SELECT author_id INTO post_author_id FROM news_post WHERE id = NEW.news_post_id;
        UPDATE "user" SET reputation = reputation + reputation_change WHERE id = post_author_id;

    ELSIF TG_OP = 'DELETE' AND OLD.vote_type = 'PostVote' THEN
        IF OLD.is_upvote THEN
            reputation_change := -10;
        ELSE
            reputation_change := 10;
        END IF;
        SELECT author_id INTO post_author_id FROM news_post WHERE id = OLD.news_post_id;
        UPDATE "user" SET reputation = reputation + reputation_change WHERE id = post_author_id;
    END IF;

    RETURN NULL;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER trigger_adjust_reputation_on_post_vote
AFTER INSERT OR DELETE ON vote
FOR EACH ROW
EXECUTE FUNCTION adjust_reputation_on_post_vote();


-- Trigger 13
CREATE OR REPLACE FUNCTION adjust_reputation_on_comment_vote()
RETURNS TRIGGER AS $$
DECLARE
    comment_author_id INTEGER;
    reputation_change INTEGER;
BEGIN
    IF TG_OP = 'INSERT' AND NEW.vote_type = 'CommentVote' THEN
        IF NEW.is_upvote THEN
            reputation_change := 50;
        ELSE
            reputation_change := -50;
        END IF;
        SELECT author_id INTO comment_author_id FROM comment WHERE id = NEW.comment_id;
        UPDATE "user" SET reputation = reputation + reputation_change WHERE id = comment_author_id;

    ELSIF TG_OP = 'DELETE' AND OLD.vote_type = 'CommentVote' THEN
        IF OLD.is_upvote THEN
            reputation_change := -50;
        ELSE
            reputation_change := 50;
        END IF;
        SELECT author_id INTO comment_author_id FROM comment WHERE id = OLD.comment_id;
        UPDATE "user" SET reputation = reputation + reputation_change WHERE id = comment_author_id;
    END IF;

    RETURN NULL;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER trigger_adjust_reputation_on_comment_vote
AFTER INSERT OR DELETE ON vote
FOR EACH ROW
EXECUTE FUNCTION adjust_reputation_on_comment_vote();



-- Trigger 14
CREATE OR REPLACE FUNCTION update_reputation_on_post_omit()
RETURNS TRIGGER AS $$
BEGIN
    IF (NEW.is_omitted = TRUE AND OLD.is_omitted = FALSE) THEN
        UPDATE "user" SET reputation = reputation - 100 WHERE id = OLD.author_id;
    ELSIF (NEW.is_omitted = FALSE AND OLD.is_omitted = TRUE) THEN
        UPDATE "user" SET reputation = reputation + 100 WHERE id = OLD.author_id;
    END IF;
    RETURN OLD;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER trigger_reputation_post_omit
AFTER UPDATE ON news_post
FOR EACH ROW
EXECUTE FUNCTION update_reputation_on_post_omit();

-- Trigger 15
CREATE OR REPLACE FUNCTION adjust_reputation_on_successful_report()
RETURNS TRIGGER AS $$
BEGIN
    UPDATE "user"
    SET reputation = reputation + 100
    FROM (
        SELECT reporter_id
        FROM report
        WHERE news_post_id = NEW.id AND report_type = 'PostReport'
    ) AS unique_reporters
    WHERE "user".id = unique_reporters.reporter_id;

    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER trigger_adjust_reputation_on_successful_report
AFTER UPDATE OF is_omitted ON news_post
FOR EACH ROW
WHEN (NEW.is_omitted = TRUE AND OLD.is_omitted = FALSE)
EXECUTE FUNCTION adjust_reputation_on_successful_report();

-- Trigger 16
CREATE OR REPLACE FUNCTION adjust_post_votes()
RETURNS TRIGGER AS $$
BEGIN
    IF TG_OP = 'INSERT' AND NEW.vote_type = 'PostVote' THEN
        IF NEW.is_upvote THEN
            UPDATE news_post SET upvotes = upvotes + 1 WHERE id = NEW.news_post_id;
        ELSE
            UPDATE news_post SET downvotes = downvotes + 1 WHERE id = NEW.news_post_id;
        END IF;
    
    ELSIF TG_OP = 'DELETE' AND OLD.vote_type = 'PostVote' THEN
        IF OLD.is_upvote THEN
            UPDATE news_post SET upvotes = upvotes - 1 WHERE id = OLD.news_post_id;
        ELSE
            UPDATE news_post SET downvotes = downvotes - 1 WHERE id = OLD.news_post_id;
        END IF;
    END IF;

    RETURN NULL;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER trigger_adjust_post_votes
AFTER INSERT OR DELETE ON vote
FOR EACH ROW
EXECUTE FUNCTION adjust_post_votes();

-- Trigger 17
CREATE OR REPLACE FUNCTION adjust_comment_votes()
RETURNS TRIGGER AS $$
BEGIN
    IF TG_OP = 'INSERT' AND NEW.vote_type = 'PostVote' THEN
        IF NEW.is_upvote THEN
            UPDATE comment SET upvotes = upvotes + 1 WHERE id = NEW.comment_id;
        ELSE
            UPDATE comment SET downvotes = downvotes + 1 WHERE id = NEW.comment_id;
        END IF;
    
    ELSIF TG_OP = 'DELETE' AND OLD.vote_type = 'PostVote' THEN
        IF OLD.is_upvote THEN
            UPDATE comment SET upvotes = upvotes - 1 WHERE id = OLD.comment_id;
        ELSE
            UPDATE comment SET downvotes = downvotes - 1 WHERE id = OLD.comment_id;
        END IF;
    END IF;

    RETURN NULL;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER trigger_adjust_comment_votes
AFTER INSERT OR DELETE ON vote
FOR EACH ROW
EXECUTE FUNCTION adjust_comment_votes();