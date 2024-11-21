--
-- Set lbaw2441 as a default schema.
--
SET search_path TO lbaw2441;

--
-- Inserting values
--
INSERT INTO "user" (username, public_name, password, email, rank, status, reputation, is_admin)
VALUES
('johndoe', 'John Doe', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'johndoe@example.com', 'noobie', 'active', 0, FALSE),
('janedoe', 'Jane Doe', 'securepassword', 'janedoe@example.com', 'noobie', 'active', 150, FALSE),
('adminuser', 'Admin User', 'adminpass', 'admin@example.com', 'code monkey', 'active', 1000, TRUE),
('samsmith', 'Sam Smith', 'samspassword', 'samsmith@example.com', 'code monkey', 'active', 20, FALSE),
('lindajones', 'Linda Jones', 'lindapass', 'lindajones@example.com', 'noobie', 'active', 250, FALSE),
('mikebrown', 'Mike Brown', 'mikepassword', 'mikebrown@example.com', '10x developer', 'active', 500, FALSE),
('emilywhite', 'Emily White', 'emilypass', 'emilywhite@example.com', 'code monkey', 'blocked', -15, FALSE),
('davidjohnson', 'David Johnson', 'davidpass', 'davidjohnson@example.com', 'noobie', 'active', 80, FALSE),
('sarahlee', 'Sarah Lee', 'sarahpassword', 'sarahlee@example.com', 'noobie', 'active', 30, FALSE),
('alexmartin', 'Alex Martin', 'alexpass', 'alexmartin@example.com', 'noobie', 'pending', 200, FALSE);


INSERT INTO tag (name)
VALUES ('AI'), ('Machine Learning'), ('Security'), ('Cloud'), ('Python');


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


INSERT INTO image (path, image_type, news_post_id, user_id)
VALUES
('/images/news/ai_news.jpg', 'PostTitle', 1, NULL),
('/images/news/ai_image1.jpg', 'PostContent', 1, NULL),
('/images/news/ai_image2.jpg', 'PostContent', 1, NULL),
('/images/news/cloud_news.jpg', 'PostTitle', 2, NULL),
('/images/news/python_tips.jpg', 'PostTitle', 3, NULL),
('/images/news/python_image1.jpg', 'PostContent', 3, NULL),
('/images/news/python_image2.jpg', 'PostContent', 3, NULL),
('/images/news/cybersecurity_threats.jpg', 'PostTitle', 4, NULL),
('/images/news/ml_breakthroughs.jpg', 'PostTitle', 5, NULL),
('/images/news/health_tech.jpg', 'PostTitle', 6, NULL),
('/images/news/quantum_computing.jpg', 'PostTitle', 7, NULL),
('/images/news/5g_tech.jpg', 'PostTitle', 8, NULL),
('/images/users/johndoe.jpg', 'Profile', NULL, 1),
('/images/users/janedoe.jpg', 'Profile', NULL, 2),
('/images/users/adminuser.jpg', 'Profile', NULL, 3);


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
(NOW() - INTERVAL '1 days', 'Agreed 2 times!', 5, NULL, 13),
(NOW() - INTERVAL '1 days', 'Agreed 3 times!', 5, NULL, 14),
(NOW() - INTERVAL '1 days', 'Agreed 4 times!', 5, NULL, 7),
(NOW() - INTERVAL '1 days', 'Agreed 5 times!', 5, NULL, 7),
(NOW() - INTERVAL '1 days', 'Agreed 5 times!', 5, NULL, 16),
(NOW() - INTERVAL '30 minutes', 'This is a reply to your reply.', 2, NULL, 11),
(NOW(), 'Following up on the discussion.', 6, NULL, 12);


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


INSERT INTO unblock_appeal (description, is_resolved, user_id)
VALUES
('I believe my account was blocked in error.', FALSE, 6),
('Apologies for the violation, please unblock.', FALSE, 8),
('I have read the guidelines, request to unblock.', FALSE, 10),
('Account blocked due to misunderstanding.', FALSE, 7),
('Promise to adhere to rules, please unblock.', FALSE, 9);


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
