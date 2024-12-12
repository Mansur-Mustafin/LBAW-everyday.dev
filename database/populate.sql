--
-- Set lbaw2441 as a default schema.
--
SET search_path TO lbaw2441;

--
-- Inserting values
--
INSERT INTO "user" (username, public_name, password, email, rank, status, reputation, is_admin)
VALUES
('johndoe', 'John Doe', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'johndoe@example.com', 'noobie', 'active', 0, TRUE),
('rubem', 'Rubem Neto', '$2y$10$ICGiPHxxCcFA8tFC.YR69OcYynMlf93xbHY3XjBHZY.4MZ43JTamS', 'rubem@example.com', 'noobie', 'active', 0, FALSE),
('mansur', 'Mansur Mustafin', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'mansur@example.com', 'noobie', 'active', 0, FALSE),
('janedoe', 'Jane Doe', 'securepassword', 'janedoe@example.com', 'noobie', 'active', 150, FALSE),
('adminuser', 'Admin User', 'adminpass', 'admin@example.com', 'code monkey', 'active', 1000, TRUE),
('samsmith', 'Sam Smith', 'samspassword', 'samsmith@example.com', 'code monkey', 'pending', 20, FALSE),
('lindajones', 'Linda Jones', 'lindapass', 'lindajones@example.com', 'noobie', 'pending', 250, FALSE),
('mikebrown', 'Mike Brown', 'mikepassword', 'mikebrown@example.com', '10x developer', 'pending', 500, FALSE),
('emilywhite', 'Emily White', 'emilypass', 'emilywhite@example.com', 'code monkey', 'pending', -15, FALSE),
('davidjohnson', 'David Johnson', 'davidpass', 'davidjohnson@example.com', 'noobie', 'pending', 80, FALSE),
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


INSERT INTO tag (name)
VALUES 
('AI'), 
('Machine Learning'), 
('Security'), 
('Cloud'), 
('Python'),
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

INSERT INTO news_post (title, created_at, changed_at, content, for_followers, upvotes, downvotes, author_id)
VALUES
('Advances in Renewable Energy', NOW() - INTERVAL '7 days', NULL, 'Renewable energy is at the forefront of combating climate change with sustainable solutions. Solar power is becoming more efficient through improved photovoltaic technology. Wind energy projects are expanding, producing cleaner electricity at lower costs. Governments are implementing incentives to encourage renewable energy adoption. Innovations in battery storage are addressing challenges of energy intermittency. The transition to green energy is also generating economic opportunities worldwide. Hydropower and geothermal energy contribute to diverse renewable energy portfolios. Offshore wind farms are maximizing energy generation in coastal regions. Investments in research are advancing hydrogen fuel as a clean energy alternative. Renewable energy plays a critical role in reducing greenhouse gas emissions globally.', TRUE, 220, 5, 1),
('The Rise of Electric Vehicles', NOW() - INTERVAL '6 days', NOW() - INTERVAL '3 days', 'Electric vehicles (EVs) are transforming the transportation industry with sustainable alternatives. Advances in battery technology are increasing EV range and reducing costs. Major automakers are expanding their EV lineups to meet growing demand. Charging infrastructure is rapidly improving, making EVs more convenient. Government policies and subsidies are driving adoption of electric vehicles. EVs significantly reduce carbon emissions, addressing environmental concerns. Autonomous driving features are being integrated with EV platforms. Recycling of EV batteries is a focus area to minimize waste and environmental impact. Consumers are increasingly prioritizing EVs for their economic and ecological benefits. The shift to electric mobility is critical for achieving net-zero emissions goals.', FALSE, 180, 4, 1),
('Top JavaScript Frameworks for 2024', NOW() - INTERVAL '5 days', NULL, 'JavaScript frameworks are essential tools for modern web development. React remains a favorite for building dynamic and responsive user interfaces. Vue.js offers a lightweight and flexible framework for rapid development. Angular is widely used for creating scalable, enterprise-grade applications. Developers are adopting Svelte for its innovative approach to compiling code. Frameworks like Next.js streamline server-side rendering and performance optimization. JavaScript frameworks enable faster development cycles and enhanced user experiences. They integrate seamlessly with backend technologies for full-stack applications. Open-source communities contribute extensively to framework development and support. Staying updated with the latest trends ensures developers harness their full potential. These tools are shaping the future of web and mobile applications.', TRUE, 150, 7, 1),
('The Importance of Data Privacy', NOW() - INTERVAL '4 days', NOW() - INTERVAL '2 days', 'Data privacy has become a critical concern as technology evolves rapidly. New regulations like GDPR and CCPA aim to protect user data. Companies are implementing stricter policies to safeguard sensitive information. Consumers are increasingly aware of how their data is being used. Advanced encryption techniques ensure secure data transmission and storage. AI is being used to detect and mitigate potential data breaches. Governments are pressuring tech giants to enhance user privacy measures. Ethical dilemmas arise as businesses balance innovation with privacy concerns. Transparency in data collection and usage builds consumer trust and loyalty. Strong data privacy frameworks are vital for maintaining a secure digital future.', FALSE, 210, 6, 1),
('Blockchain Beyond Cryptocurrency', NOW() - INTERVAL '3 days', NULL, 'Blockchain technology is expanding beyond cryptocurrency applications. It’s being used for supply chain management to ensure transparency and authenticity. Healthcare industries are exploring blockchain for secure patient record storage. Smart contracts enable automated and tamper-proof transactions across industries. Decentralized finance (DeFi) platforms are reshaping the financial sector. Governments are piloting blockchain projects for secure voting systems. Blockchain helps reduce fraud and enhance trust in digital ecosystems. Environmental concerns arise from the energy consumption of blockchain processes. Developers are exploring more sustainable approaches like proof-of-stake systems. The versatility of blockchain continues to unlock new possibilities across various domains.', TRUE, 330, 2, 1),
('Breakthroughs in Space Exploration', NOW() - INTERVAL '2 days', NULL, 'Space exploration is advancing with exciting breakthroughs and new missions. NASA and private companies are planning crewed Mars missions. Lunar exploration is seeing a resurgence with plans for permanent bases. Satellite technology is improving communication and Earth observation capabilities. New propulsion systems are enabling faster and more efficient space travel. International collaborations are fostering shared advancements in space science. Space tourism is emerging, making space accessible to private citizens. Telescopes are uncovering distant exoplanets and expanding our cosmic understanding. Robotics and AI are supporting autonomous exploration of hostile environments. The future of space exploration holds promise for humanity’s expansion beyond Earth.', TRUE, 300, 3, 1),
('Virtual Reality: The Next Big Thing?', NOW() - INTERVAL '1 day', NULL, 'Virtual reality (VR) is evolving to become a transformative technology. VR applications extend beyond gaming into education and training. Immersive VR environments enhance learning experiences in schools and workplaces. Medical professionals use VR for surgical training and patient therapy. VR tourism allows people to explore destinations without leaving their homes. Social VR platforms connect users in shared virtual spaces. Advances in hardware are making VR devices more affordable and accessible. Concerns about motion sickness and prolonged VR use are being addressed. Developers are creating realistic environments to improve user immersion. As VR grows, it continues to push the boundaries of creativity and innovation.', FALSE, 275, 5, 1),
('Sustainable Agriculture Practices', NOW(), NULL, 'Sustainable agriculture practices are redefining farming to be eco-friendly. Crop rotation and cover cropping improve soil health and fertility. Organic farming methods reduce the use of synthetic fertilizers and pesticides. Vertical farming in urban areas maximizes space and reduces water consumption. Precision agriculture uses technology to optimize resource allocation. Agroforestry combines agriculture with forestry for sustainable land use. Farmers are adopting renewable energy solutions like solar-powered equipment. Composting and waste recycling reduce environmental impact and enhance productivity. Governments are promoting subsidies and programs for sustainable farming. These practices ensure food security while protecting natural ecosystems for future generations.', TRUE, 190, 4, 1),
('Augmented Reality in Retail', NOW() - INTERVAL '7 days', NOW() - INTERVAL '6 days', 'Augmented reality (AR) is transforming the retail industry with innovative experiences. AR applications let customers visualize products in their homes before purchase. Virtual fitting rooms enable shoppers to try on clothes digitally. Furniture retailers use AR to help customers plan interior designs. QR code integration enhances in-store navigation and product information. AR technology drives engagement in marketing campaigns through interactive content. Retailers are creating apps to provide seamless shopping experiences. 5G networks improve AR functionality with faster processing and lower latency. AR adoption is growing across industries, including fashion, electronics, and real estate. These advancements are enhancing customer satisfaction and driving sales growth.', FALSE, 240, 3, 1),
('The Growth of Remote Work', NOW() - INTERVAL '6 days', NULL, 'Remote work is reshaping industries, offering flexibility and new challenges. Advances in communication tools enable seamless collaboration from anywhere. Employees enjoy improved work-life balance and reduced commuting stress. Businesses save costs on office space and related expenses. Remote work widens the talent pool, allowing global recruitment. Cybersecurity remains a concern as employees access sensitive data remotely. Companies are investing in digital tools to boost productivity and engagement. Hybrid work models are becoming a popular solution for balancing flexibility and in-person interactions. Remote work is influencing urban planning as people move away from city centers. As it grows, remote work is redefining the future of employment.', TRUE, 260, 5, 1),
('Breaking News in AI', NOW() - INTERVAL '7 days', NULL, 
'Johnson did not return requests for comment. Similar requests to those who spread the false assassination attempt story went mostly unanswered. Those who responded defended their posts and videos. 
“We reported it as potentially being a hoax,” Dore said. 

Andrew Kolvet, a representative for Kirk and a producer of his podcast, said Kirk noted at the time that it wasn’t possible to verify the claim. 

"Frankly we’re glad to know that Ukraine wasn’t orchestrating an assassination attempt against Tucker,” Kolvet said of the former Fox News host. “That’s a good thing."

Storm-1516’s video production team likely operates out of an office in St. Petersburg and appears to recruit actors from diaspora communities there, researchers at Microsoft said. Based on an analysis of methods and personnel, the researchers believe the group is in part a vestige of the Internet Research Agency, a disinformation factory founded by Yevgeny Prigozhin that meddled in the 2016 U.S. presidential election. Prigozhin, a onetime ally of Russian President Vladimir Putin, led a quickly quashed rebellion against the Russian military in June 2023 and died months later in a plane crash. 

Storm-1516 is loosely tied to the Kremlin by people, products and tactics; Microsoft researchers believe it’s directed by the Center for Geopolitical Expertise, an anti-liberal think tank that, according to Estonian intelligence, organized press tours of Ukraine for Western pro-Putin propagandists. The Foundation for Battling Injustice, a former Prigozhin propaganda operation that imitates a human rights organization, has amplified Storm-1516’s fake videos, researchers say.

Other groups have similar goals but different methods. Storm-1099 is known for its “Doppelganger” operation, which uses fake news websites — dozens of which were recently seized by the Justice Department — and a bot network to push disinformation. Storm-1679 trades in feature-length films that mimic American documentaries and political thrillers, including on the Paris Olympics. 

Storm-1516’s cheap videos echo Cold War-era propaganda techniques. The most memorable may be the KGB-designed “Operation Denver,” which concocted and spread the false conspiracy theory that the AIDS virus had been engineered by the Pentagon. 

A known launderer of KGB disinformation, the Indian newspaper Patriot seeds a lie about AIDS on July 17, 1983. (Archive.org)

A known launderer of KGB disinformation, the Indian newspaper Patriot seeds a lie about AIDS on July 17, 1983. (Archive.org)

That campaign began with a letter from an anonymous but “well-known” scientist with insider information published in 1983 in the Patriot, a pro-Soviet Indian newspaper.  

In 2024, Russia’s strategies have evolved, with the creation of more legitimate-looking fake news websites, more sophisticated bot networks and the increasing use of AI. Some of Russia’s disinformation projects are professional productions involving paid actors, while others are slick documentaries with AI-fabricated celebrity hosts. Some target Russian citizens and others the outside world. 

The Storm-1516 videos initially relied on real people, like a Cameroonian woman in St. Petersburg who journalists revealed had posed as a Cartier intern in a viral TikTok video falsely smearing Olena Zelenska, the first lady of Ukraine, from October 2023.',
TRUE, 150, 3, 1),

('The Future of Cloud Computing', NOW() - INTERVAL '6 days', NOW() - INTERVAL '1 day', 
'

Looking at brain cells closely has shown some interesting patterns. Over the past five years, techniques that enable scientists to catalogue the genes expressed in a single cell have been revealing the many different types of cell that make up a brain — at a level of detail much higher than anything achieved before.

Last year, a team based at the Allen Institute for Brain Science in Seattle, Washington, reported the most-comprehensive atlases yet of cell types in both the mouse and human brain. As part of an international effort called the BRAIN Initiative Cell Census Network (BICCN), researchers catalogued the whole mouse brain, finding 5,300 cell types2; the human atlas is unfinished but so far includes more than 3,300 types from 100 locations3; researchers expect to find many more.

Some regions do have distinct cell types — for instance, the human visual cortex contained several types of neuron that were exclusive to that area4. But in general, human-specific cell types are rare.

The overall impression, when comparing the cell types of the human brain with other species, is one of similarity. “I was expecting bigger differences,” says Ed Lein, a neuroscientist at the Allen Institute, who is involved in efforts to catalogue cells in human, mouse and other brains. “The basic cellular architecture is remarkably conserved until you get down to the finer details”, he says.

Most human brain regions differ from primates and mice in the relative proportions of cell types that appear5, and in the ways those cells express their genes: its not the ingredients that are different, but the recipe.

Take these two comparable regions of the human and mouse cortex, which both process auditory information. The mouse area contains a higher proportion of excitatory neurons, which propagate signals, relative to inhibitory neurons, which dampen activity. The human region had a much greater proportion of non-neuronal cells, such as astrocytes, oligodendrocytes and microglia. These cells support neurons and also help to prune and refine their connections during development. The ratio of these cells to neurons was five times that of mice.',
FALSE, 100, 2, 2),

('Top Python Tips for Developers', NOW() - INTERVAL '5 days', NULL, 
'Johnson did not return requests for comment. Similar requests to those who spread the false assassination attempt story went mostly unanswered. Those who responded defended their posts and videos. 

“We reported it as potentially being a hoax,” Dore said. 

Andrew Kolvet, a representative for Kirk and a producer of his podcast, said Kirk noted at the time that it wasn’t possible to verify the claim. 

"Frankly we’re glad to know that Ukraine wasn’t orchestrating an assassination attempt against Tucker,” Kolvet said of the former Fox News host. “That’s a good thing."

Storm-1516’s video production team likely operates out of an office in St. Petersburg and appears to recruit actors from diaspora communities there, researchers at Microsoft said. Based on an analysis of methods and personnel, the researchers believe the group is in part a vestige of the Internet Research Agency, a disinformation factory founded by Yevgeny Prigozhin that meddled in the 2016 U.S. presidential election. Prigozhin, a onetime ally of Russian President Vladimir Putin, led a quickly quashed rebellion against the Russian military in June 2023 and died months later in a plane crash. 

Storm-1516 is loosely tied to the Kremlin by people, products and tactics; Microsoft researchers believe it’s directed by the Center for Geopolitical Expertise, an anti-liberal think tank that, according to Estonian intelligence, organized press tours of Ukraine for Western pro-Putin propagandists. The Foundation for Battling Injustice, a former Prigozhin propaganda operation that imitates a human rights organization, has amplified Storm-1516’s fake videos, researchers say.

Other groups have similar goals but different methods. Storm-1099 is known for its “Doppelganger” operation, which uses fake news websites — dozens of which were recently seized by the Justice Department — and a bot network to push disinformation. Storm-1679 trades in feature-length films that mimic American documentaries and political thrillers, including on the Paris Olympics. 

Storm-1516’s cheap videos echo Cold War-era propaganda techniques. The most memorable may be the KGB-designed “Operation Denver,” which concocted and spread the false conspiracy theory that the AIDS virus had been engineered by the Pentagon. 

A known launderer of KGB disinformation, the Indian newspaper Patriot seeds a lie about AIDS on July 17, 1983. (Archive.org)

A known launderer of KGB disinformation, the Indian newspaper Patriot seeds a lie about AIDS on July 17, 1983. (Archive.org)

That campaign began with a letter from an anonymous but “well-known” scientist with insider information published in 1983 in the Patriot, a pro-Soviet Indian newspaper.  

In 2024, Russia’s strategies have evolved, with the creation of more legitimate-looking fake news websites, more sophisticated bot networks and the increasing use of AI. Some of Russia’s disinformation projects are professional productions involving paid actors, while others are slick documentaries with AI-fabricated celebrity hosts. Some target Russian citizens and others the outside world. 

The Storm-1516 videos initially relied on real people, like a Cameroonian woman in St. Petersburg who journalists revealed had posed as a Cartier intern in a viral TikTok video falsely smearing Olena Zelenska, the first lady of Ukraine, from October 2023.',
TRUE, 200, 5, 3),

('Cybersecurity Threats in 2024', NOW() - INTERVAL '4 days', NULL, 
'Johnson did not return requests for comment. Similar requests to those who spread the false assassination attempt story went mostly unanswered. Those who responded defended their posts and videos. 

“We reported it as potentially being a hoax,” Dore said. 

Andrew Kolvet, a representative for Kirk and a producer of his podcast, said Kirk noted at the time that it wasn’t possible to verify the claim. 

"Frankly we’re glad to know that Ukraine wasn’t orchestrating an assassination attempt against Tucker,” Kolvet said of the former Fox News host. “That’s a good thing."

Storm-1516’s video production team likely operates out of an office in St. Petersburg and appears to recruit actors from diaspora communities there, researchers at Microsoft said. Based on an analysis of methods and personnel, the researchers believe the group is in part a vestige of the Internet Research Agency, a disinformation factory founded by Yevgeny Prigozhin that meddled in the 2016 U.S. presidential election. Prigozhin, a onetime ally of Russian President Vladimir Putin, led a quickly quashed rebellion against the Russian military in June 2023 and died months later in a plane crash. 

Storm-1516 is loosely tied to the Kremlin by people, products and tactics; Microsoft researchers believe it’s directed by the Center for Geopolitical Expertise, an anti-liberal think tank that, according to Estonian intelligence, organized press tours of Ukraine for Western pro-Putin propagandists. The Foundation for Battling Injustice, a former Prigozhin propaganda operation that imitates a human rights organization, has amplified Storm-1516’s fake videos, researchers say.

Other groups have similar goals but different methods. Storm-1099 is known for its “Doppelganger” operation, which uses fake news websites — dozens of which were recently seized by the Justice Department — and a bot network to push disinformation. Storm-1679 trades in feature-length films that mimic American documentaries and political thrillers, including on the Paris Olympics. 

Storm-1516’s cheap videos echo Cold War-era propaganda techniques. The most memorable may be the KGB-designed “Operation Denver,” which concocted and spread the false conspiracy theory that the AIDS virus had been engineered by the Pentagon. 

A known launderer of KGB disinformation, the Indian newspaper Patriot seeds a lie about AIDS on July 17, 1983. (Archive.org)

A known launderer of KGB disinformation, the Indian newspaper Patriot seeds a lie about AIDS on July 17, 1983. (Archive.org)

That campaign began with a letter from an anonymous but “well-known” scientist with insider information published in 1983 in the Patriot, a pro-Soviet Indian newspaper.  

In 2024, Russia’s strategies have evolved, with the creation of more legitimate-looking fake news websites, more sophisticated bot networks and the increasing use of AI. Some of Russia’s disinformation projects are professional productions involving paid actors, while others are slick documentaries with AI-fabricated celebrity hosts. Some target Russian citizens and others the outside world. 

The Storm-1516 videos initially relied on real people, like a Cameroonian woman in St. Petersburg who journalists revealed had posed as a Cartier intern in a viral TikTok video falsely smearing Olena Zelenska, the first lady of Ukraine, from October 2023.',
FALSE, 175, 8, 4),

('Machine Learning Breakthroughs', NOW() - INTERVAL '3 days', NOW() - INTERVAL '2 days', 
'Johnson did not return requests for comment. Similar requests to those who spread the false assassination attempt story went mostly unanswered. Those who responded defended their posts and videos. 

“We reported it as potentially being a hoax,” Dore said. 

Andrew Kolvet, a representative for Kirk and a producer of his podcast, said Kirk noted at the time that it wasn’t possible to verify the claim. 

"Frankly we’re glad to know that Ukraine wasn’t orchestrating an assassination attempt against Tucker,” Kolvet said of the former Fox News host. “That’s a good thing."

Storm-1516’s video production team likely operates out of an office in St. Petersburg and appears to recruit actors from diaspora communities there, researchers at Microsoft said. Based on an analysis of methods and personnel, the researchers believe the group is in part a vestige of the Internet Research Agency, a disinformation factory founded by Yevgeny Prigozhin that meddled in the 2016 U.S. presidential election. Prigozhin, a onetime ally of Russian President Vladimir Putin, led a quickly quashed rebellion against the Russian military in June 2023 and died months later in a plane crash. 

Storm-1516 is loosely tied to the Kremlin by people, products and tactics; Microsoft researchers believe it’s directed by the Center for Geopolitical Expertise, an anti-liberal think tank that, according to Estonian intelligence, organized press tours of Ukraine for Western pro-Putin propagandists. The Foundation for Battling Injustice, a former Prigozhin propaganda operation that imitates a human rights organization, has amplified Storm-1516’s fake videos, researchers say.

Other groups have similar goals but different methods. Storm-1099 is known for its “Doppelganger” operation, which uses fake news websites — dozens of which were recently seized by the Justice Department — and a bot network to push disinformation. Storm-1679 trades in feature-length films that mimic American documentaries and political thrillers, including on the Paris Olympics. 

Storm-1516’s cheap videos echo Cold War-era propaganda techniques. The most memorable may be the KGB-designed “Operation Denver,” which concocted and spread the false conspiracy theory that the AIDS virus had been engineered by the Pentagon. 

A known launderer of KGB disinformation, the Indian newspaper Patriot seeds a lie about AIDS on July 17, 1983. (Archive.org)

A known launderer of KGB disinformation, the Indian newspaper Patriot seeds a lie about AIDS on July 17, 1983. (Archive.org)

That campaign began with a letter from an anonymous but “well-known” scientist with insider information published in 1983 in the Patriot, a pro-Soviet Indian newspaper.  

In 2024, Russia’s strategies have evolved, with the creation of more legitimate-looking fake news websites, more sophisticated bot networks and the increasing use of AI. Some of Russia’s disinformation projects are professional productions involving paid actors, while others are slick documentaries with AI-fabricated celebrity hosts. Some target Russian citizens and others the outside world. 

The Storm-1516 videos initially relied on real people, like a Cameroonian woman in St. Petersburg who journalists revealed had posed as a Cartier intern in a viral TikTok video falsely smearing Olena Zelenska, the first lady of Ukraine, from October 2023.',
TRUE, 300, 1, 5),

('Innovations in Health Tech', NOW() - INTERVAL '2 days', NULL, 
'Johnson did not return requests for comment. Similar requests to those who spread the false assassination attempt story went mostly unanswered. Those who responded defended their posts and videos. 

“We reported it as potentially being a hoax,” Dore said. 

Andrew Kolvet, a representative for Kirk and a producer of his podcast, said Kirk noted at the time that it wasn’t possible to verify the claim. 

"Frankly we’re glad to know that Ukraine wasn’t orchestrating an assassination attempt against Tucker,” Kolvet said of the former Fox News host. “That’s a good thing."

Storm-1516’s video production team likely operates out of an office in St. Petersburg and appears to recruit actors from diaspora communities there, researchers at Microsoft said. Based on an analysis of methods and personnel, the researchers believe the group is in part a vestige of the Internet Research Agency, a disinformation factory founded by Yevgeny Prigozhin that meddled in the 2016 U.S. presidential election. Prigozhin, a onetime ally of Russian President Vladimir Putin, led a quickly quashed rebellion against the Russian military in June 2023 and died months later in a plane crash. 

Storm-1516 is loosely tied to the Kremlin by people, products and tactics; Microsoft researchers believe it’s directed by the Center for Geopolitical Expertise, an anti-liberal think tank that, according to Estonian intelligence, organized press tours of Ukraine for Western pro-Putin propagandists. The Foundation for Battling Injustice, a former Prigozhin propaganda operation that imitates a human rights organization, has amplified Storm-1516’s fake videos, researchers say.

Other groups have similar goals but different methods. Storm-1099 is known for its “Doppelganger” operation, which uses fake news websites — dozens of which were recently seized by the Justice Department — and a bot network to push disinformation. Storm-1679 trades in feature-length films that mimic American documentaries and political thrillers, including on the Paris Olympics. 

Storm-1516’s cheap videos echo Cold War-era propaganda techniques. The most memorable may be the KGB-designed “Operation Denver,” which concocted and spread the false conspiracy theory that the AIDS virus had been engineered by the Pentagon. 

A known launderer of KGB disinformation, the Indian newspaper Patriot seeds a lie about AIDS on July 17, 1983. (Archive.org)

A known launderer of KGB disinformation, the Indian newspaper Patriot seeds a lie about AIDS on July 17, 1983. (Archive.org)

That campaign began with a letter from an anonymous but “well-known” scientist with insider information published in 1983 in the Patriot, a pro-Soviet Indian newspaper.  

In 2024, Russia’s strategies have evolved, with the creation of more legitimate-looking fake news websites, more sophisticated bot networks and the increasing use of AI. Some of Russia’s disinformation projects are professional productions involving paid actors, while others are slick documentaries with AI-fabricated celebrity hosts. Some target Russian citizens and others the outside world. 

The Storm-1516 videos initially relied on real people, like a Cameroonian woman in St. Petersburg who journalists revealed had posed as a Cartier intern in a viral TikTok video falsely smearing Olena Zelenska, the first lady of Ukraine, from October 2023.',
TRUE, 250, 4, 6),

('Exploring Quantum Computing', NOW() - INTERVAL '1 day', NULL, 
'Johnson did not return requests for comment. Similar requests to those who spread the false assassination attempt story went mostly unanswered. Those who responded defended their posts and videos. 

“We reported it as potentially being a hoax,” Dore said. 

Andrew Kolvet, a representative for Kirk and a producer of his podcast, said Kirk noted at the time that it wasn’t possible to verify the claim. 

"Frankly we’re glad to know that Ukraine wasn’t orchestrating an assassination attempt against Tucker,” Kolvet said of the former Fox News host. “That’s a good thing."

Storm-1516’s video production team likely operates out of an office in St. Petersburg and appears to recruit actors from diaspora communities there, researchers at Microsoft said. Based on an analysis of methods and personnel, the researchers believe the group is in part a vestige of the Internet Research Agency, a disinformation factory founded by Yevgeny Prigozhin that meddled in the 2016 U.S. presidential election. Prigozhin, a onetime ally of Russian President Vladimir Putin, led a quickly quashed rebellion against the Russian military in June 2023 and died months later in a plane crash. 

Storm-1516 is loosely tied to the Kremlin by people, products and tactics; Microsoft researchers believe it’s directed by the Center for Geopolitical Expertise, an anti-liberal think tank that, according to Estonian intelligence, organized press tours of Ukraine for Western pro-Putin propagandists. The Foundation for Battling Injustice, a former Prigozhin propaganda operation that imitates a human rights organization, has amplified Storm-1516’s fake videos, researchers say.

Other groups have similar goals but different methods. Storm-1099 is known for its “Doppelganger” operation, which uses fake news websites — dozens of which were recently seized by the Justice Department — and a bot network to push disinformation. Storm-1679 trades in feature-length films that mimic American documentaries and political thrillers, including on the Paris Olympics. 

Storm-1516’s cheap videos echo Cold War-era propaganda techniques. The most memorable may be the KGB-designed “Operation Denver,” which concocted and spread the false conspiracy theory that the AIDS virus had been engineered by the Pentagon. 

A known launderer of KGB disinformation, the Indian newspaper Patriot seeds a lie about AIDS on July 17, 1983. (Archive.org)

A known launderer of KGB disinformation, the Indian newspaper Patriot seeds a lie about AIDS on July 17, 1983. (Archive.org)

That campaign began with a letter from an anonymous but “well-known” scientist with insider information published in 1983 in the Patriot, a pro-Soviet Indian newspaper.  

In 2024, Russia’s strategies have evolved, with the creation of more legitimate-looking fake news websites, more sophisticated bot networks and the increasing use of AI. Some of Russia’s disinformation projects are professional productions involving paid actors, while others are slick documentaries with AI-fabricated celebrity hosts. Some target Russian citizens and others the outside world. 

The Storm-1516 videos initially relied on real people, like a Cameroonian woman in St. Petersburg who journalists revealed had posed as a Cartier intern in a viral TikTok video falsely smearing Olena Zelenska, the first lady of Ukraine, from October 2023.',
FALSE, 350, 2, 7),

('Developments in 5G Technology', NOW(), NULL, 
'Johnson did not return requests for comment. Similar requests to those who spread the false assassination attempt story went mostly unanswered. Those who responded defended their posts and videos. 

“We reported it as potentially being a hoax,” Dore said. 

Andrew Kolvet, a representative for Kirk and a producer of his podcast, said Kirk noted at the time that it wasn’t possible to verify the claim. 

"Frankly we’re glad to know that Ukraine wasn’t orchestrating an assassination attempt against Tucker,” Kolvet said of the former Fox News host. “That’s a good thing."

Storm-1516’s video production team likely operates out of an office in St. Petersburg and appears to recruit actors from diaspora communities there, researchers at Microsoft said. Based on an analysis of methods and personnel, the researchers believe the group is in part a vestige of the Internet Research Agency, a disinformation factory founded by Yevgeny Prigozhin that meddled in the 2016 U.S. presidential election. Prigozhin, a onetime ally of Russian President Vladimir Putin, led a quickly quashed rebellion against the Russian military in June 2023 and died months later in a plane crash. 

Storm-1516 is loosely tied to the Kremlin by people, products and tactics; Microsoft researchers believe it’s directed by the Center for Geopolitical Expertise, an anti-liberal think tank that, according to Estonian intelligence, organized press tours of Ukraine for Western pro-Putin propagandists. The Foundation for Battling Injustice, a former Prigozhin propaganda operation that imitates a human rights organization, has amplified Storm-1516’s fake videos, researchers say.

Other groups have similar goals but different methods. Storm-1099 is known for its “Doppelganger” operation, which uses fake news websites — dozens of which were recently seized by the Justice Department — and a bot network to push disinformation. Storm-1679 trades in feature-length films that mimic American documentaries and political thrillers, including on the Paris Olympics. 

Storm-1516’s cheap videos echo Cold War-era propaganda techniques. The most memorable may be the KGB-designed “Operation Denver,” which concocted and spread the false conspiracy theory that the AIDS virus had been engineered by the Pentagon. 

A known launderer of KGB disinformation, the Indian newspaper Patriot seeds a lie about AIDS on July 17, 1983. (Archive.org)

A known launderer of KGB disinformation, the Indian newspaper Patriot seeds a lie about AIDS on July 17, 1983. (Archive.org)

That campaign began with a letter from an anonymous but “well-known” scientist with insider information published in 1983 in the Patriot, a pro-Soviet Indian newspaper.  

In 2024, Russia’s strategies have evolved, with the creation of more legitimate-looking fake news websites, more sophisticated bot networks and the increasing use of AI. Some of Russia’s disinformation projects are professional productions involving paid actors, while others are slick documentaries with AI-fabricated celebrity hosts. Some target Russian citizens and others the outside world. 

The Storm-1516 videos initially relied on real people, like a Cameroonian woman in St. Petersburg who journalists revealed had posed as a Cartier intern in a viral TikTok video falsely smearing Olena Zelenska, the first lady of Ukraine, from October 2023.',
TRUE, 400, 6, 8);


INSERT INTO image (path, image_type, news_post_id, user_id)
VALUES
('post/64ONZCusT3DBrS4TO1XrYZJKrMhdgCDy8ZjUhsqf.webp', 'PostTitle', 1, NULL),
('post/8Q9jRGDijSFzBmWs1kUKcO6SlFOMYgoPaD1CViTk.webp', 'PostContent', 1, NULL),
('post/fuuPsO4T4j9FwSnUFWtjK0Kua31wvo0Znf06H3UM.png', 'PostTitle', 2, NULL),
('post/jK2u2SHbW21055A80YJ3fxKYjfTt5UjHULfpMdA6.jpg', 'PostTitle', 3, NULL),
('post/ijntS0epmuvFR4YIsWtqMJOFEFSiynIJ1LSCOkok.webp', 'PostTitle', 4, NULL),
('post/N1JduCRiLze3lpLBwZ6gCK9qsJk2CCDMw0lm6Rmw.webp', 'PostTitle', 5, NULL),
('post/hBy7Ku4HBH9r1xzS296Fveda6d9vi29JpgepMoGG.jpg', 'PostTitle', 6, NULL),
('post/PWicNYjT3yJRkLVuKFxlbmR9rgV53doXCBzxkSck.jpg', 'PostTitle', 7, NULL),
('post/q6PnXK1mOhk3at2NmgrFA4VAdlxprbXwKyLfcG36.jpg', 'PostTitle', 8, NULL),
('post/PhauknJxL7vlCGZfWjvbwDPH7XFOf5EmB00e2iqN.webp', 'PostTitle', 9, NULL),
('post/sw5LaQ9adf8VDOWxnSsQgMUksUpm0kxlCxI76tG8.jpg', 'PostTitle', 10, NULL),
('post/53c4LGgwBjudrzAffAmDdpUucY5BRcKux4xpYHoM.jpg', 'PostTitle', 11, NULL),
('post/0WqScYm28tmiWJxkRLjkPMNNItKZEnQHbczWW0z5.jpg', 'PostTitle', 12, NULL),
('post/7fGFCpLTszqDKqcwpMyKdgwSvJVSwdQlAQUdItfh.jpg', 'PostTitle', 13, NULL),
('post/TVSzhrjA4nU3L3EYdjMzCWr80h27phdU4zU48JEP.jpg', 'PostTitle', 14, NULL),
('post/tNHwX1K2O9nAX7gsX437sDreGVJZKHJzcK35UoZk.jpg', 'PostTitle', 15, NULL),
('post/91t6hUBk7Viw9cJNHGhwKIJn2h6pIi4fHim7oV7H.jpg', 'PostTitle', 16, NULL),
('post/CXfnXjKtjI9WtDa01XhcF1Yp86As3JuwB8zAogap.jpg', 'PostTitle', 17, NULL),
('post/qZsEnWGYlGFc4G8TofPZiH7oSkzCHbbVHZkzc5A4.jpg', 'PostTitle', 18, NULL);

INSERT INTO comment (created_at, content, author_id, news_post_id, parent_comment_id)
VALUES
(NOW() - INTERVAL '5 days', 'This is great news!', 1, 1, NULL),
(NOW() - INTERVAL '4 days', 'Can''t wait to try the new gadget.', 3, NULL, 1),
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
(NOW() - INTERVAL '2 days', 'CommentVote', TRUE,  3, NULL, 10),
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


INSERT INTO tag_proposal (name,description, is_resolved, proposer_id)
VALUES
('Innovation','Suggesting a new tag: Innovation', FALSE, 2),
('Mental Health Awareness','Proposing tag: Mental Health Awareness', FALSE, 3),
('Crypto','Request to add tag: Cryptocurrency', FALSE, 4),
('Renewable Energy','Suggesting tag: Renewable Energy', FALSE, 5),
('Virtual Reality','Proposal for new tag: Virtual Reality', FALSE, 6),
('Remote Work','Adding tag: Remote Work', FALSE, 7),
('Social Media Trends','Proposing tag: Social Media Trends', FALSE, 8),
('Space Exploration','Suggesting tag: Space Exploration', FALSE, 9),
('Climate Change','Request to add tag: Climate Change', FALSE, 10),
('Culinary Arts','Proposal for new tag: Culinary Arts', FALSE, 1);


INSERT INTO unblock_appeal (description, is_resolved, user_id)
VALUES
('I believe my account was blocked in error.', FALSE, 6),
('Apologies for the violation, please unblock.', FALSE, 8),
('I have read the guidelines, request to unblock.', FALSE, 10),
('Account blocked due to misunderstanding.', FALSE, 7),
('Promise to adhere to rules, please unblock.', FALSE, 9);


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

INSERT INTO notification (is_viewed, created_at, notification_type, user_id, news_post_id, vote_id, follower_id, comment_id)
VALUES
('False','2024-12-01 10:00:00','FollowNotification','2', NULL, NULL,'1', NULL),
('False','2024-12-01 10:01:00','FollowNotification','3', NULL, NULL,'2', NULL),
('False','2024-12-01 10:02:00','FollowNotification','4', NULL, NULL,'3', NULL),
('False','2024-12-01 10:03:00','FollowNotification','5', NULL, NULL,'4', NULL),
('False','2024-12-01 10:04:00','FollowNotification','6', NULL, NULL,'5', NULL),
('False','2024-12-01 10:05:00','FollowNotification','7', NULL, NULL,'6', NULL),
('False','2024-12-01 10:06:00','FollowNotification','8', NULL, NULL,'7', NULL),
('False','2024-12-01 10:07:00','FollowNotification','9', NULL, NULL,'8', NULL),
('False','2024-12-01 10:08:00','FollowNotification','10', NULL, NULL,'9', NULL),
('False','2024-12-01 10:09:00','FollowNotification','1', NULL, NULL,'10', NULL),
('False','2024-12-01 10:10:00','FollowNotification','3', NULL, NULL,'1', NULL),
('False','2024-12-01 10:11:00','FollowNotification','4', NULL, NULL,'2', NULL),
('False','2024-12-01 10:12:00','FollowNotification','5', NULL, NULL,'3', NULL),
('False','2024-12-01 10:13:00','FollowNotification','6', NULL, NULL,'4', NULL),
('False','2024-12-01 10:14:00','FollowNotification','7', NULL, NULL,'5', NULL),
('False','2024-12-01 10:15:00','PostNotification','10','1', NULL, NULL, NULL),
('False','2024-12-01 10:16:00','PostNotification','10','2', NULL, NULL, NULL),
('False','2024-12-01 10:17:00','PostNotification','10','3', NULL, NULL, NULL),
('False','2024-12-01 10:18:00','PostNotification','10','4', NULL, NULL, NULL),
('False','2024-12-01 10:19:00','PostNotification','10','5', NULL, NULL, NULL),
('False','2024-12-01 10:20:00','PostNotification','10','6', NULL, NULL, NULL),
('False','2024-12-01 10:21:00','PostNotification','10','7', NULL, NULL, NULL),
('False','2024-12-01 10:22:00','PostNotification','10','8', NULL, NULL, NULL),
('False','2024-12-01 10:23:00','PostNotification','10','9', NULL, NULL, NULL),
('False','2024-12-01 10:24:00','PostNotification','10','10', NULL, NULL, NULL),
('False','2024-12-01 10:25:00','PostNotification','10','11', NULL, NULL, NULL),
('False','2024-12-01 10:26:00','PostNotification','1','12', NULL, NULL, NULL),
('False','2024-12-01 10:27:00','PostNotification','2','13', NULL, NULL, NULL),
('False','2024-12-01 10:28:00','PostNotification','1','13', NULL, NULL, NULL),
('False','2024-12-01 10:29:00','PostNotification','3','14', NULL, NULL, NULL),
('False','2024-12-01 10:30:00','PostNotification','2','14', NULL, NULL, NULL),
('False','2024-12-01 10:31:00','PostNotification','4','15', NULL, NULL, NULL),
('False','2024-12-01 10:32:00','PostNotification','3','15', NULL, NULL, NULL),
('False','2024-12-01 10:33:00','PostNotification','5','16', NULL, NULL, NULL),
('False','2024-12-01 10:34:00','PostNotification','4','16', NULL, NULL, NULL),
('False','2024-12-01 10:35:00','PostNotification','6','17', NULL, NULL, NULL),
('False','2024-12-01 10:36:00','PostNotification','5','17', NULL, NULL, NULL),
('False','2024-12-01 10:37:00','PostNotification','7','18', NULL, NULL, NULL),
('False','2024-12-01 10:38:00','CommentNotification','1', NULL, NULL, NULL,'2'),
('False','2024-12-01 10:39:00','CommentNotification','1', NULL, NULL, NULL,'3'),
('False','2024-12-01 10:40:00','CommentNotification','1', NULL, NULL, NULL,'4'),
('False','2024-12-01 10:41:00','CommentNotification','1', NULL, NULL, NULL,'5'),
('False','2024-12-01 10:42:00','CommentNotification','1', NULL, NULL, NULL,'6'),
('False','2024-12-01 10:43:00','CommentNotification','1', NULL, NULL, NULL,'7'),
('False','2024-12-01 10:44:00','CommentNotification','1', NULL, NULL, NULL,'8'),
('False','2024-12-01 10:45:00','CommentNotification','1', NULL, NULL, NULL,'9'),
('False','2024-12-01 10:46:00','CommentNotification','1', NULL, NULL, NULL,'11'),
('False','2024-12-01 10:47:00','CommentNotification','7', NULL, NULL, NULL,'12'),
('False','2024-12-01 10:48:00','CommentNotification','8', NULL, NULL, NULL,'13'),
('False','2024-12-01 10:49:00','CommentNotification','8', NULL, NULL, NULL,'16'),
('False','2024-12-01 10:50:00','CommentNotification','8', NULL, NULL, NULL,'17'),
('False','2024-12-01 10:51:00','CommentNotification','3', NULL, NULL, NULL,'19'),
('False','2024-12-01 10:52:00','CommentNotification','4', NULL, NULL, NULL,'20'),
('False','2024-12-01 10:53:00','VoteNotification','1', NULL,'1', NULL, NULL),
('False','2024-12-01 10:54:00','VoteNotification','1', NULL,'2', NULL, NULL),
('False','2024-12-01 10:55:00','VoteNotification','1', NULL,'3', NULL, NULL),
('False','2024-12-01 10:56:00','VoteNotification','1', NULL,'4', NULL, NULL),
('False','2024-12-01 10:57:00','VoteNotification','1', NULL,'5', NULL, NULL),
('False','2024-12-01 10:58:00','VoteNotification','1', NULL,'6', NULL, NULL),
('False','2024-12-01 10:59:00','VoteNotification','1', NULL,'7', NULL, NULL),
('False','2024-12-01 11:01:00','VoteNotification','1', NULL,'8', NULL, NULL),
('False','2024-12-01 11:02:00','VoteNotification','3', NULL,'9', NULL, NULL),
('False','2024-12-01 11:03:00','VoteNotification','4', NULL,'10', NULL, NULL),
('False','2024-12-01 11:04:00','VoteNotification','5', NULL,'11', NULL, NULL),
('False','2024-12-01 11:05:00','VoteNotification','6', NULL,'12', NULL, NULL),
('False','2024-12-01 11:06:00','VoteNotification','7', NULL,'13', NULL, NULL),
('False','2024-12-01 11:07:00','VoteNotification','8', NULL,'14', NULL, NULL),
('False','2024-12-01 11:08:00','VoteNotification','9', NULL,'15', NULL, NULL);
