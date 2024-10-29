--
-- Set lbaw2441 as a default schema.
--
SET search_path TO lbaw2441;

--
-- Inserting image
--
INSERT INTO image (path, news_post_id, is_title_image)
VALUES
('/images/news/ai_news.jpg', 1, TRUE),
('/images/news/cloud_news.jpg', 2, TRUE),
('/images/news/python_tips.jpg', 3, TRUE),
('/images/news/cybersecurity_threats.jpg', 4, TRUE),
('/images/news/ml_breakthroughs.jpg', 5, TRUE),
('/images/news/health_tech.jpg', 6, TRUE),
('/images/news/quantum_computing.jpg', 7, TRUE),
('/images/news/5g_tech.jpg', 8, TRUE),
('/images/users/johndoe.jpg', NULL, FALSE),
('/images/users/lindajones.jpg', NULL, FALSE),
('/images/users/emilywhite.jpg', NULL, FALSE),
('/images/users/alexmartin.jpg', NULL, FALSE);

--
-- Inserting users
--
INSERT INTO "user" (username, public_name, password, image_id, email, rank, status, reputation, is_admin)
VALUES
('johndoe', 'John Doe', 'password123', 8, 'johndoe@example.com', 'noobie', 'active', 0, FALSE),
('janedoe', 'Jane Doe', 'securepassword', NULL, 'janedoe@example.com', 'noobie', 'active', 150, FALSE),
('adminuser', 'Admin User', 'adminpass', NULL, 'admin@example.com', 'code monkey', 'active', 1000, TRUE),
('samsmith', 'Sam Smith', 'samspassword', NULL, 'samsmith@example.com', 'code monkey', 'active', 20, FALSE),
('lindajones', 'Linda Jones', 'lindapass', 9, 'lindajones@example.com', 'noobie', 'active', 250, FALSE),
('mikebrown', 'Mike Brown', 'mikepassword', NULL, 'mikebrown@example.com', '10x developer', 'active', 500, FALSE),
('emilywhite', 'Emily White', 'emilypass', 10, 'emilywhite@example.com', 'code monkey', 'blocked', -15, FALSE),
('davidjohnson', 'David Johnson', 'davidpass', NULL, 'davidjohnson@example.com', 'noobie', 'active', 80, FALSE),
('sarahlee', 'Sarah Lee', 'sarahpassword', NULL, 'sarahlee@example.com', 'noobie', 'active', 30, FALSE),
('alexmartin', 'Alex Martin', 'alexpass', 11, 'alexmartin@example.com', 'noobie', 'pending', 200, FALSE);


--
-- Inserting tags
--
INSERT INTO tag (name)
VALUES ('AI'), ('Machine Learning'), ('Security'), ('Cloud'), ('Python');


--
-- Inserting news_post
--
INSERT INTO news_post (title, created_at, changed_at, content, for_followers, upvotes, downvotes, author_id)
VALUES
('Breaking News in AI', NOW() - INTERVAL '7 days', NULL, 'Artificial Intelligence is transforming industries across the globe.', TRUE, 150, 3, 1),
('The Future of Cloud Computing', NOW() - INTERVAL '6 days', NOW() - INTERVAL '1 day', 'Cloud services continue to evolve with exciting new trends.', FALSE, 100, 2, 2),
('Top Python Tips for Developers', NOW() - INTERVAL '5 days', NULL, 'Here are some of the best Python tips to improve your coding skills.', TRUE, 200, 5, 3),
('Cybersecurity Threats in 2024', NOW() - INTERVAL '4 days', NULL, 'New threats emerge in the digital world, learn how to protect yourself.', FALSE, 175, 8, 4),
('Machine Learning Breakthroughs', NOW() - INTERVAL '3 days', NOW() - INTERVAL '2 days', 'The latest machine learning algorithms are pushing boundaries.', TRUE, 300, 1, 5),
('Innovations in Health Tech', NOW() - INTERVAL '2 days', NULL, 'Health technologies are making it easier to diagnose and treat diseases.', TRUE, 250, 4, 6),
('Exploring Quantum Computing', NOW() - INTERVAL '1 day', NULL, 'Quantum computing could revolutionize data processing.', FALSE, 350, 2, 7),
('Developments in 5G Technology', NOW(), NULL, '5G is set to become more prevalent, offering faster connectivity.', TRUE, 400, 6, 8);


--
-- Inserting comment
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
(NOW() - INTERVAL '3 hours', 'Looking forward to attending.', 9, 7, NULL),
(NOW() - INTERVAL '1 hours', 'Important advancements indeed.', 10, 7, NULL),
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
(1, 14),
(2, 7),
(3, 4),
(4, 7),
(5, 8),
(6, 9),
(7, 11),
(8, 15);


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
(7, 2),
(8, 3),
(9, 4),
(10, 5),
(1, 5),
(2, 6),
(3, 7),
(4, 8),
(5, 3);
