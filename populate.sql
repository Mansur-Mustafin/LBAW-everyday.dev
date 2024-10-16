--
-- Set lbaw2441 as a default schema.
--
SET search_path TO lbaw2441;


--
-- Inserting users
--
INSERT INTO "user" (username, public_name, password, image_path, email, rank, status, reputation, is_admin)
VALUES
('johndoe', 'John Doe', 'password123', '/images/users/johndoe.jpg', 'johndoe@example.com', 'noobie', 'active', 0, FALSE),
('janedoe', 'Jane Doe', 'securepassword', NULL, 'janedoe@example.com', 'noobie', 'active', 150, FALSE),
('adminuser', 'Admin User', 'adminpass', NULL, 'admin@example.com', 'code monkey', 'active', 1000, TRUE),
('samsmith', 'Sam Smith', 'samspassword', NULL, 'samsmith@example.com', 'code monkey', 'active', 20, FALSE),
('lindajones', 'Linda Jones', 'lindapass', '/images/users/lindajones.jpg', 'lindajones@example.com', 'noobie', 'active', 250, FALSE),
('mikebrown', 'Mike Brown', 'mikepassword', NULL, 'mikebrown@example.com', '10x developer', 'active', 500, FALSE),
('emilywhite', 'Emily White', 'emilypass', '/images/users/emilywhite.jpg', 'emilywhite@example.com', 'code monkey', 'blocked', -15, FALSE),
('davidjohnson', 'David Johnson', 'davidpass', NULL, 'davidjohnson@example.com', 'noobie', 'active', 80, FALSE),
('sarahlee', 'Sarah Lee', 'sarahpassword', NULL, 'sarahlee@example.com', 'noobie', 'active', 30, FALSE),
('alexmartin', 'Alex Martin', 'alexpass', '/images/users/alexmartin.jpg', 'alexmartin@example.com', 'noobie', 'pending', 200, FALSE);


--
-- Inserting tags
--
INSERT INTO tag (name)
VALUES ('AI'), ('Machine Learning'), ('Security'), ('Cloud'), ('Python');


--
-- Inserting news_post
--
INSERT INTO news_post (title, created_at, changed_at, content, hash, is_public, image_path, author_id)
VALUES
('Python 3.10 Released with Pattern Matching', NOW() - INTERVAL '10 days', NULL, 'The latest version of Python introduces pattern matching and other features.', 'hash001', TRUE, '/images/posts/python.jpg', 1),
('JavaScript ES2021 Features Announced', NOW() - INTERVAL '9 days', NULL, 'ES2021 brings new features like logical assignment operators.', 'hash002', TRUE, NULL, 2),
('GitHub Copilot Now Available to All Developers', NOW() - INTERVAL '8 days', NOW() - INTERVAL '7 days', 'GitHub has made Copilot available to all developers after successful beta.', 'hash003', TRUE, '/images/posts/copilot.jpg', 3),
('React 18 Released with Concurrent Features', NOW() - INTERVAL '7 days', NULL, 'React 18 includes concurrent rendering features for better performance.', 'hash004', TRUE, NULL, 4),
('Interview with Linus Torvalds on Linux Kernel Development', NOW() - INTERVAL '6 days', NOW() - INTERVAL '5 days', 'An exclusive interview with Linus Torvalds discussing the future of Linux.', 'hash005', FALSE, '/images/posts/linus.jpg', 5),
('Top 10 VSCode Extensions for Developers', NOW() - INTERVAL '5 days', NULL, 'Enhance your development workflow with these top VSCode extensions.', 'hash006', TRUE, NULL, 6),
('TypeScript 4.5 Released with New Features', NOW() - INTERVAL '4 days', NULL, 'TypeScript 4.5 introduces new language features and improvements.', 'hash007', TRUE, '/images/posts/typescript.jpg', 7),
('Django 4.0: What’s New', NOW() - INTERVAL '3 days', NULL, 'Django 4.0 brings asynchronous handlers and other new features.', 'hash008', TRUE, NULL, 8),
('Advancements in Machine Learning Frameworks', NOW() - INTERVAL '2 days', NULL, 'New updates in TensorFlow and PyTorch improve ML development.', 'hash009', TRUE, '/images/posts/ml.jpg', 9),
('Upcoming Tech Conferences You Should Attend', NOW() - INTERVAL '1 days', NULL, 'Don''t miss these tech conferences happening soon.', 'hash010', TRUE, NULL, 10),
('Rust Becomes the Most Loved Language Again', NOW(), NULL, 'Rust tops the list of most loved programming languages.', 'hash011', TRUE, '/images/posts/rust.jpg', 1),
('Google Announces Flutter 2.5', NOW() - INTERVAL '6 days', NULL, 'Flutter 2.5 brings performance improvements and new features.', 'hash012', TRUE, NULL, 2),
('Kubernetes 1.22 Released with Major Updates', NOW() - INTERVAL '5 days', NULL, 'Kubernetes 1.22 introduces significant changes and deprecations.', 'hash013', TRUE, '/images/posts/kubernetes.jpg', 3),
('Microsoft Announces .NET 6.0', NOW() - INTERVAL '4 days', NULL, 'The release of .NET 6.0 brings performance enhancements.', 'hash014', TRUE, NULL, 4),
('Exploring the New Features in PHP 8.1', NOW() - INTERVAL '3 days', NULL, 'PHP 8.1 introduces enums, fibers, and other features.', 'hash015', TRUE, '/images/posts/php.jpg', 5);


--
-- Inserting news_post
--
INSERT INTO comment (created_at, content, author_id, news_post_id, parent_comment_id)
VALUES
(NOW() - INTERVAL '5 days', 'This is great news!', 2, 1, NULL),
(NOW() - INTERVAL '4 days', 'Can''t wait to try the new gadget.', 3, 2, NULL),
(NOW() - INTERVAL '3 days', 'Very helpful tips, thank you.', 4, 3, NULL),
(NOW() - INTERVAL '2 days', 'Congratulations to the team!', 5, 4, NULL),
(NOW() - INTERVAL '1 days', 'Fascinating interview.', 6, 5, NULL),
(NOW() - INTERVAL '12 hours', 'I disagree with this point.', 7, 6, NULL),
(NOW() - INTERVAL '6 hours', 'Could you provide more details?', 8, 7, NULL),
(NOW() - INTERVAL '3 hours', 'Looking forward to attending.', 9, 10, NULL),
(NOW() - INTERVAL '1 hours', 'Important advancements indeed.', 10, 9, NULL),
(NOW(), 'Thanks for sharing!', 1, 8, NULL),
(NOW() - INTERVAL '4 days', 'Replying to your comment.', 3, NULL, 1),
(NOW() - INTERVAL '2 days', 'I have a different opinion.', 4, NULL, 6),
(NOW() - INTERVAL '1 days', 'Agreed!', 5, NULL, 7),
(NOW() - INTERVAL '30 minutes', 'This is a reply to your reply.', 2, NULL, 11),
(NOW(), 'Following up on the discussion.', 6, NULL, 12);


--
-- Inserting vote
--
INSERT INTO vote (created_at, vote_type, is_upvote, user_id, news_post_id, comment_id)
VALUES
(NOW() - INTERVAL '2 days', 'PostVote', TRUE,  3, 1, NULL),
(NOW() - INTERVAL '1 days', 'PostVote', TRUE, 4, 2, NULL),
(NOW() - INTERVAL '12 hours', 'PostVote', TRUE, 5, 3, NULL),
(NOW() - INTERVAL '6 hours', 'PostVote', TRUE, 6, 4, NULL),
(NOW() - INTERVAL '3 hours', 'PostVote', TRUE, 7, 5, NULL),
(NOW() - INTERVAL '1 hours', 'PostVote', TRUE, 8, 6, NULL),
(NOW(), 'PostVote', TRUE, 9, 7, NULL),
(NOW() - INTERVAL '1 days', 'CommentVote', TRUE, 10, NULL, 1),
(NOW() - INTERVAL '12 hours', 'CommentVote', TRUE, 1, NULL, 2),
(NOW() - INTERVAL '6 hours', 'CommentVote', TRUE, 2, NULL, 3),
(NOW() - INTERVAL '3 hours', 'CommentVote', TRUE, 3, NULL, 4),
(NOW() - INTERVAL '1 hours', 'CommentVote', TRUE, 4, NULL, 5),
(NOW(), 'CommentVote', TRUE, 5, NULL, 6),
(NOW(), 'CommentVote', TRUE, 6, NULL, 7),
(NOW(), 'CommentVote', FALSE, 7, NULL, 8);


--
-- Inserting notification
--
INSERT INTO notification (is_viewed, created_at, notification_type, user_id, news_post_id, vote_id, follower_id, comment_id)
VALUES
(FALSE, NOW() - INTERVAL '1 days', 'PostNotification', 1, 1, NULL, NULL, NULL),
(FALSE, NOW() - INTERVAL '12 hours', 'VoteNotification', 2, NULL, 1, NULL, NULL),
(FALSE, NOW() - INTERVAL '6 hours', 'CommentNotification', 3, NULL, NULL, NULL, 1),
(FALSE, NOW() - INTERVAL '3 hours', 'FollowNotification', 4, NULL, NULL, 2, NULL),
(FALSE, NOW() - INTERVAL '1 hours', 'PostNotification', 5, 2, NULL, NULL, NULL),
(FALSE, NOW(), 'VoteNotification', 6, NULL, 2, NULL, NULL),
(FALSE, NOW(), 'CommentNotification', 7, NULL, NULL, NULL, 2),
(FALSE, NOW(), 'FollowNotification', 8, NULL, NULL, 3, NULL),
(FALSE, NOW(), 'PostNotification', 9, 3, NULL, NULL, NULL),
(FALSE, NOW(), 'VoteNotification', 10, NULL, 3, NULL, NULL),
(FALSE, NOW(), 'CommentNotification', 1, NULL, NULL, NULL, 3),
(FALSE, NOW(), 'FollowNotification', 2, NULL, NULL, 4, NULL),
(FALSE, NOW(), 'PostNotification', 3, 4, NULL, NULL, NULL),
(FALSE, NOW(), 'VoteNotification', 4, NULL, 4, NULL, NULL),
(FALSE, NOW(), 'CommentNotification', 5, NULL, NULL, NULL, 4);


--
-- Inserting report
--
INSERT INTO report (created_at, description, report_type, reporter_id, news_post_id, comment_id, reported_user_id)
VALUES
(NOW() - INTERVAL '2 days', 'Inappropriate content in the news post.', 'PostReport', 2, 1, NULL, NULL),
(NOW() - INTERVAL '1 days', 'Offensive language used in the comment.', 'CommentReport', 3, NULL, 1, NULL),
(NOW(), 'User is spamming in comments.', 'UserReport', 4, NULL, NULL, 5),
(NOW() - INTERVAL '12 hours', 'Plagiarism detected in the post.', 'PostReport', 5, 2, NULL, NULL),
(NOW() - INTERVAL '6 hours', 'Harassment in the comment section.', 'CommentReport', 6, NULL, 2, NULL),
(NOW(), 'User is creating fake accounts.', 'UserReport', 7, NULL, NULL, 8),
(NOW(), 'False information spread in the news post.', 'PostReport', 8, 3, NULL, NULL),
(NOW(), 'Comment contains hate speech.', 'CommentReport', 9, NULL, 3, NULL),
(NOW(), 'User is violating community guidelines.', 'UserReport', 10, NULL, NULL, 1),
(NOW(), 'Post contains unauthorized content.', 'PostReport', 1, 4, NULL, NULL);


--
-- Inserting tag
--
INSERT INTO tag (name)
VALUES
('Technology'),
('Health'),
('Sports'),
('Entertainment'),
('Travel'),
('Politics'),
('Science'),
('Education'),
('Business'),
('Lifestyle'),
('Environment'),
('Culture'),
('Art'),
('Economy'),
('History');


--
-- Inserting news_post_tag
--
INSERT INTO news_post_tag (news_post_id, tag_id)
VALUES
(1, 9),
(2, 1),
(3, 2),
(4, 3),
(5, 13),
(6, 5),
(7, 6),
(8, 14),
(9, 7),
(10, 4),
(11, 7),
(12, 8),
(13, 9),
(14, 11),
(15, 15);


--
-- Inserting tag_proposal
--
INSERT INTO tag_proposal (description, is_resolved, proposer_id)
VALUES
('Suggesting a new tag: Innovation', FALSE, 2),
('Proposing tag: Mental Health Awareness', FALSE, 3),
('Request to add tag: Cryptocurrency', FALSE, 4),
('Suggesting tag: Renewable Energy', FALSE, 5),
('Proposal for new tag: Virtual Reality', FALSE, 6),
('Adding tag: Remote Work', FALSE, 7),
('Proposing tag: Social Media Trends', FALSE, 8),
('Suggesting tag: Space Exploration', FALSE, 9),
('Request to add tag: Climate Change', FALSE, 10),
('Proposal for new tag: Culinary Arts', FALSE, 1);


--
-- Inserting unblock_appeal
--
INSERT INTO unblock_appeal (description, is_resolved, user_id)
VALUES
('I believe my account was blocked in error.', FALSE, 6),
('Apologies for the violation, please unblock.', FALSE, 8),
('I have read the guidelines, request to unblock.', FALSE, 10),
('Account blocked due to misunderstanding.', FALSE, 7),
('Promise to adhere to rules, please unblock.', FALSE, 9);


--
-- Inserting follows
--
INSERT INTO follows (follower_id, followed_id)
VALUES
(1, 2),
(2, 3),
(3, 4),
(4, 5),
(5, 6),
(6, 7),
(7, 8),
(8, 9),
(9, 10),
(10, 1),
(1, 3),
(2, 4),
(3, 5),
(4, 6),
(5, 7);


--
-- Inserting user_tag_subscribes
--
INSERT INTO user_tag_subscribes (user_id, tag_id)
VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7),
(8, 8),
(9, 9),
(10, 10),
(1, 11),
(2, 12),
(3, 13),
(4, 14),
(5, 15);


--
-- Inserting bookmarks
--
INSERT INTO bookmarks (user_id, news_post_id)
VALUES
(1, 2),
(2, 3),
(3, 4),
(4, 5),
(5, 6),
(6, 7),
(7, 8),
(8, 9),
(9, 10),
(10, 1),
(1, 5),
(2, 6),
(3, 7),
(4, 8),
(5, 9);
