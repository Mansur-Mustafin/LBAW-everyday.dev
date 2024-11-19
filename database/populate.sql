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
('alexmartin', 'Alex Martin', 'alexpass', 'alexmartin@example.com', 'noobie', 'pending', 200, FALSE),
('charlottejames', 'Charlotte James', 'charlottepassword', 'charlottejames@example.com', '10x developer', 'active', 600, FALSE),
('benjaminclark', 'Benjamin Clark', 'benjaminpass', 'benjaminclark@example.com', 'noobie', 'active', 50, FALSE),
('oliviagarcia', 'Olivia Garcia', 'oliviapass', 'oliviagarcia@example.com', 'code monkey', 'active', 350, FALSE),
('ethanmoore', 'Ethan Moore', 'ethanpass', 'ethanmoore@example.com', '10x developer', 'active', 450, FALSE),
('isabellathomas', 'Isabella Thomas', 'isabellapass', 'isabellathomas@example.com', 'noobie', 'blocked', -20, FALSE),
('jamesmartinez', 'James Martinez', 'jamespass', 'jamesmartinez@example.com', 'code monkey', 'active', 120, FALSE),
('ameliataylor', 'Amelia Taylor', 'ameliapass', 'ameliataylor@example.com', 'noobie', 'pending', 10, FALSE),
('michaelwilson', 'Michael Wilson', 'michaelpass', 'michaelwilson@example.com', 'code monkey', 'active', 300, FALSE),
('emmagonzalez', 'Emma Gonzalez', 'emmapass', 'emmagonzalez@example.com', 'noobie', 'active', 40, FALSE),
('jacksonbrown', 'Jackson Brown', 'jacksonpass', 'jacksonbrown@example.com', 'code monkey', 'active', 220, FALSE),
('averyhill', 'Avery Hill', 'averypass', 'averyhill@example.com', '10x developer', 'blocked', -10, FALSE),
('lucasharris', 'Lucas Harris', 'lucaspass', 'lucasharris@example.com', 'noobie', 'active', 25, FALSE),
('ellaadams', 'Ella Adams', 'ellapass', 'ellaadams@example.com', '10x developer', 'active', 750, TRUE),
('liamturner', 'Liam Turner', 'liampass', 'liamturner@example.com', 'code monkey', 'active', 180, FALSE),
('sofiacampbell', 'Sofia Campbell', 'sofiapass', 'sofiacampbell@example.com', 'noobie', 'pending', 5, FALSE),
('harperroberts', 'Harper Roberts', 'harperpass', 'harperroberts@example.com', 'code monkey', 'active', 400, FALSE),
('masonhall', 'Mason Hall', 'masonpass', 'masonhall@example.com', '10x developer', 'active', 800, TRUE),
('ellaallen', 'Ella Allen', 'ellapass', 'ellaallen@example.com', 'noobie', 'blocked', -50, FALSE),
('loganharris', 'Logan Harris', 'loganpass', 'loganharris@example.com', 'code monkey', 'active', 100, FALSE),
('scarlettclark', 'Scarlett Clark', 'scarlettpass', 'scarlettclark@example.com', '10x developer', 'active', 900, TRUE),
('zacharydavis', 'Zachary Davis', 'zacharypass', 'zacharydavis@example.com', 'code monkey', 'active', 320, FALSE),
('gracelopez', 'Grace Lopez', 'gracepass', 'gracelopez@example.com', 'noobie', 'pending', 15, FALSE),
('elijames', 'Eli James', 'elipass', 'elijames@example.com', '10x developer', 'active', 500, TRUE),
('victoriaward', 'Victoria Ward', 'victoriapass', 'victoriaward@example.com', 'noobie', 'active', 60, FALSE),
('liamwright', 'Liam Wright', 'liampass', 'liamwright@example.com', 'code monkey', 'blocked', -10, FALSE),
('nataliegreen', 'Natalie Green', 'nataliepass', 'nataliegreen@example.com', 'noobie', 'active', 80, FALSE),
('loganevans', 'Logan Evans', 'loganpass', 'loganevans@example.com', 'code monkey', 'active', 210, FALSE),
('chloejackson', 'Chloe Jackson', 'chloepass', 'chloejackson@example.com', 'noobie', 'pending', 5, FALSE),
('alexwalk', 'Alex Walker', 'alexpass', 'alexwalk@example.com', '10x developer', 'active', 700, TRUE),
('averyyoung', 'Avery Young', 'averypass', 'averyyoung@example.com', 'noobie', 'active', 40, FALSE),
('danielking', 'Daniel King', 'danielpass', 'danielking@example.com', 'code monkey', 'active', 280, FALSE),
('emilybrown', 'Emily Brown', 'emilypass', 'emilybrown@example.com', 'noobie', 'active', 100, FALSE),
('nathanmartin', 'Nathan Martin', 'nathanpass', 'nathanmartin@example.com', '10x developer', 'active', 800, TRUE),
('ameliawhite', 'Amelia White', 'ameliapass', 'ameliawhite@example.com', 'noobie', 'blocked', -20, FALSE),
('owengray', 'Owen Gray', 'owenpass', 'owengray@example.com', 'code monkey', 'active', 180, FALSE),
('sophiabell', 'Sophia Bell', 'sophiapass', 'sophiabell@example.com', 'noobie', 'active', 30, FALSE),
('lucasreid', 'Lucas Reid', 'lucaspass', 'lucasreid@example.com', '10x developer', 'active', 600, TRUE),
('ellaedwards', 'Ella Edwards', 'ellapass', 'ellaedwards@example.com', 'noobie', 'active', 50, FALSE),
('jacksonphillips', 'Jackson Phillips', 'jacksonpass', 'jacksonphillips@example.com', 'code monkey', 'active', 300, FALSE),
('isabellawood', 'Isabella Wood', 'isabellapass', 'isabellawood@example.com', 'noobie', 'pending', 10, FALSE);



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
('Advances in Renewable Energy', NOW() - INTERVAL '7 days', NULL, 'Solar and wind energy projects are growing at an unprecedented rate.', TRUE, 220, 5, 9),
('The Rise of Electric Vehicles', NOW() - INTERVAL '6 days', NOW() - INTERVAL '3 days', 'Electric vehicles are becoming more accessible and sustainable.', FALSE, 180, 4, 10),
('Top JavaScript Frameworks for 2024', NOW() - INTERVAL '5 days', NULL, 'Discover the most popular frameworks to enhance your web development.', TRUE, 150, 7, 11),
('The Importance of Data Privacy', NOW() - INTERVAL '4 days', NOW() - INTERVAL '2 days', 'Data privacy laws are evolving to address modern security challenges.', FALSE, 210, 6, 12),
('Blockchain Beyond Cryptocurrency', NOW() - INTERVAL '3 days', NULL, 'Blockchain technology is finding applications in various industries.', TRUE, 330, 2, 13),
('Breakthroughs in Space Exploration', NOW() - INTERVAL '2 days', NULL, 'New missions to Mars and beyond are capturing the worlds attention.', TRUE, 300, 3, 14),
('Virtual Reality: The Next Big Thing?', NOW() - INTERVAL '1 day', NULL, 'VR technology is expanding its applications in entertainment and education.', FALSE, 275, 5, 15),
('Sustainable Agriculture Practices', NOW(), NULL, 'Farming methods are shifting to more sustainable and eco-friendly practices.', TRUE, 190, 4, 16),
('Augmented Reality in Retail', NOW() - INTERVAL '7 days', NOW() - INTERVAL '6 days', 'AR is transforming how consumers shop by providing immersive experiences.', FALSE, 240, 3, 17),
('The Growth of Remote Work', NOW() - INTERVAL '6 days', NULL, 'Remote work trends are reshaping industries worldwide.', TRUE, 260, 5, 18),
('AI Ethics and Bias', NOW() - INTERVAL '5 days', NOW() - INTERVAL '4 days', 'Addressing ethical challenges in AI development is crucial.', FALSE, 310, 2, 19),
('Big Data Analytics for Business', NOW() - INTERVAL '4 days', NULL, 'Data analytics is helping businesses make informed decisions.', TRUE, 280, 1, 20),
('Gene Editing: CRISPR Updates', NOW() - INTERVAL '3 days', NULL, 'CRISPR advancements are opening new possibilities in medicine.', TRUE, 370, 8, 21),
('Trends in Wearable Technology', NOW() - INTERVAL '2 days', NOW() - INTERVAL '1 day', 'Wearables are becoming smarter and more integrated into daily life.', FALSE, 260, 7, 22),
('Autonomous Vehicles on the Rise', NOW() - INTERVAL '1 day', NULL, 'Driverless cars are making their way onto public roads.', TRUE, 400, 3, 23),
('Breakthroughs in Cancer Research', NOW(), NULL, 'New treatments are improving survival rates for various types of cancer.', TRUE, 350, 2, 24),
('The Role of AI in Education', NOW() - INTERVAL '7 days', NULL, 'Artificial Intelligence is changing the way students learn.', TRUE, 180, 6, 25),
('Green Building Innovations', NOW() - INTERVAL '6 days', NULL, 'Sustainable architecture is redefining urban landscapes.', TRUE, 200, 1, 26),
('Challenges in Robotics Development', NOW() - INTERVAL '5 days', NOW() - INTERVAL '4 days', 'Developers face technical and ethical hurdles in advancing robotics.', FALSE, 310, 5, 27),
('The Evolution of Social Media', NOW() - INTERVAL '4 days', NULL, 'Social media platforms are introducing new features and challenges.', TRUE, 220, 2, 28),
('Revolutionizing Transportation Infrastructure', NOW() - INTERVAL '7 days', NULL, 'Advancements in transportation infrastructure are set to redefine urban mobility.', TRUE, 320, 4, 29),
('The Impact of AI on Job Markets', NOW() - INTERVAL '6 days', NULL, 'Artificial Intelligence is reshaping employment trends worldwide.', FALSE, 270, 6, 30),
('How 6G Could Change Connectivity', NOW() - INTERVAL '5 days', NULL, '6G networks promise even faster connectivity and groundbreaking applications.', TRUE, 400, 2, 31),
('Advances in Biotechnology', NOW() - INTERVAL '4 days', NOW() - INTERVAL '2 days', 'Biotechnology innovations are paving the way for better healthcare solutions.', FALSE, 290, 3, 32),
('The Rise of Green Hydrogen', NOW() - INTERVAL '3 days', NULL, 'Green hydrogen is emerging as a promising energy source for the future.', TRUE, 360, 1, 33),
('AI in Creative Industries', NOW() - INTERVAL '2 days', NOW() - INTERVAL '1 day', 'AI is increasingly being used in arts, music, and other creative fields.', TRUE, 280, 2, 34),
('Exploring Underwater Robotics', NOW() - INTERVAL '1 day', NULL, 'Underwater robots are transforming marine exploration and industries.', FALSE, 340, 5, 35),
('The Future of Smart Cities', NOW(), NULL, 'Smart cities are blending technology and urban planning for a better future.', TRUE, 410, 4, 36),
('Ethical Dilemmas in Biotechnology', NOW() - INTERVAL '7 days', NULL, 'Biotechnology raises new ethical challenges as it advances.', TRUE, 270, 8, 37),
('Breakthroughs in Energy Storage', NOW() - INTERVAL '6 days', NULL, 'New battery technologies are enabling efficient energy storage solutions.', FALSE, 300, 6, 38),
('Satellite Internet Revolution', NOW() - INTERVAL '5 days', NOW() - INTERVAL '4 days', 'Satellite internet is bringing connectivity to remote regions worldwide.', TRUE, 290, 2, 39),
('AI-Powered Healthcare Diagnostics', NOW() - INTERVAL '4 days', NULL, 'AI tools are improving diagnostics accuracy in healthcare.', FALSE, 320, 1, 40),
('3D Printing in Manufacturing', NOW() - INTERVAL '3 days', NULL, '3D printing technology is making manufacturing faster and more efficient.', TRUE, 380, 3, 41),
('Exploring Edge Computing', NOW() - INTERVAL '2 days', NULL, 'Edge computing is reducing latency and improving real-time data processing.', TRUE, 310, 5, 42),
('AI-Generated Content', NOW() - INTERVAL '1 day', NULL, 'AI-generated content is becoming increasingly indistinguishable from human work.', FALSE, 340, 7, 43),
('Sustainable Urban Agriculture', NOW(), NULL, 'Urban farming techniques are being adopted to feed growing populations.', TRUE, 270, 2, 44),
('The Ethics of Autonomous Drones', NOW() - INTERVAL '7 days', NOW() - INTERVAL '6 days', 'Autonomous drones are raising new ethical and legal concerns.', TRUE, 300, 3, 45),
('Fusion Energy: The Next Frontier', NOW() - INTERVAL '6 days', NULL, 'Fusion energy could provide a near-limitless source of clean power.', FALSE, 390, 5, 46),
('Challenges in Human Augmentation', NOW() - INTERVAL '5 days', NULL, 'Human augmentation technologies are pushing the limits of ethics and science.', TRUE, 350, 1, 47),
('The Future of E-Waste Recycling', NOW() - INTERVAL '4 days', NULL, 'New recycling technologies are tackling the growing problem of electronic waste.', TRUE, 290, 4, 48);




INSERT INTO image (path, image_type, news_post_id, user_id)
VALUES
('/images/news/breaking_ai.jpg', 'PostTitle', 1, NULL),
('/images/news/breaking_ai_content1.jpg', 'PostContent', 1, NULL),
('/images/news/breaking_ai_content2.jpg', 'PostContent', 1, NULL),
('/images/news/cloud_future.jpg', 'PostTitle', 2, NULL),
('/images/news/cloud_trends.jpg', 'PostContent', 2, NULL),
('/images/news/python_tips.jpg', 'PostTitle', 3, NULL),
('/images/news/python_coding.jpg', 'PostContent', 3, NULL),
('/images/news/cybersecurity_2024.jpg', 'PostTitle', 4, NULL),
('/images/news/cyber_threats.jpg', 'PostContent', 4, NULL),
('/images/news/ml_breakthrough.jpg', 'PostTitle', 5, NULL),
('/images/news/ml_progress.jpg', 'PostContent', 5, NULL),
('/images/news/health_innovations.jpg', 'PostTitle', 6, NULL),
('/images/news/healthcare_tech.jpg', 'PostContent', 6, NULL),
('/images/news/quantum_computing.jpg', 'PostTitle', 7, NULL),
('/images/news/quantum_potential.jpg', 'PostContent', 7, NULL),
('/images/news/renewable_energy.jpg', 'PostTitle', 8, NULL),
('/images/news/electric_vehicles.jpg', 'PostTitle', 9, NULL),
('/images/news/javascript_frameworks.jpg', 'PostTitle', 10, NULL),
('/images/news/data_privacy.jpg', 'PostTitle', 11, NULL),
('/images/news/blockchain_apps.jpg', 'PostTitle', 12, NULL),
('/images/news/space_exploration.jpg', 'PostTitle', 13, NULL),
('/images/news/virtual_reality.jpg', 'PostTitle', 14, NULL),
('/images/news/sustainable_agriculture.jpg', 'PostTitle', 15, NULL),
('/images/news/ar_retail.jpg', 'PostTitle', 16, NULL),
('/images/news/remote_work.jpg', 'PostTitle', 17, NULL),
('/images/news/ai_ethics.jpg', 'PostTitle', 18, NULL),
('/images/news/big_data.jpg', 'PostTitle', 19, NULL),
('/images/news/crispr_updates.jpg', 'PostTitle', 20, NULL),
('/images/news/wearable_tech.jpg', 'PostTitle', 21, NULL),
('/images/news/autonomous_vehicles.jpg', 'PostTitle', 22, NULL),
('/images/news/cancer_research.jpg', 'PostTitle', 23, NULL),
('/images/news/ai_education.jpg', 'PostTitle', 24, NULL),
('/images/news/green_buildings.jpg', 'PostTitle', 25, NULL),
('/images/news/robotics_challenges.jpg', 'PostTitle', 26, NULL),
('/images/news/social_media.jpg', 'PostTitle', 27, NULL),
('/images/news/javascript_tutorial.jpg', 'PostTitle', 28, NULL),
('/images/news/transportation_infra.jpg', 'PostTitle', 29, NULL),
('/images/news/ai_jobs.jpg', 'PostTitle', 30, NULL),
('/images/news/6g_connectivity.jpg', 'PostTitle', 31, NULL),
('/images/news/biotech_advances.jpg', 'PostTitle', 32, NULL),
('/images/news/green_hydrogen.jpg', 'PostTitle', 33, NULL),
('/images/news/ai_creative.jpg', 'PostTitle', 34, NULL),
('/images/news/underwater_robotics.jpg', 'PostTitle', 35, NULL),
('/images/news/smart_cities.jpg', 'PostTitle', 36, NULL),
('/images/news/biotech_ethics.jpg', 'PostTitle', 37, NULL),
('/images/news/energy_storage.jpg', 'PostTitle', 38, NULL),
('/images/news/satellite_internet.jpg', 'PostTitle', 39, NULL),
('/images/news/ai_diagnostics.jpg', 'PostTitle', 40, NULL),
('/images/news/3d_printing.jpg', 'PostTitle', 41, NULL),
('/images/news/edge_computing.jpg', 'PostTitle', 42, NULL),
('/images/news/ai_content.jpg', 'PostTitle', 43, NULL),
('/images/news/urban_agriculture.jpg', 'PostTitle', 44, NULL),
('/images/news/autonomous_drones.jpg', 'PostTitle', 45, NULL),
('/images/news/fusion_energy.jpg', 'PostTitle', 46, NULL),
('/images/news/human_augmentation.jpg', 'PostTitle', 47, NULL);

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
