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
('Breaking News in AI', NOW() - INTERVAL '7 days', NULL, 'Artificial Intelligence is making a significant impact on industries around the world. This revolutionary technology is automating processes, reducing operational costs, and driving innovation. Businesses are integrating AI to improve customer experiences and optimize workflows. From healthcare to transportation, AI applications are expanding rapidly. It is also influencing job markets and skill requirements globally. Ethical concerns are emerging as AI decisions affect lives in sensitive ways. Governments and organizations are working to create regulatory frameworks for AI use. Startups and research institutions are focusing on advanced AI techniques like deep learning. As investments in AI grow, it continues to shape the future of technology. The potential for AI to address complex challenges remains unparalleled.', TRUE, 150, 3, 1),
('The Future of Cloud Computing', NOW() - INTERVAL '6 days', NOW() - INTERVAL '1 day', 'The future of cloud computing is incredibly promising and dynamic. As cloud services evolve, they are introducing groundbreaking capabilities for businesses. Edge computing, serverless architectures, and multi-cloud strategies are on the rise. Companies are leveraging cloud platforms for scalability and innovation. Security concerns are leading to better encryption and authentication protocols. The industry is witnessing a shift toward hybrid and distributed cloud environments. AI and machine learning are integrating with cloud systems for enhanced processing. Developers are building more efficient and reliable applications using cloud resources. Cloud computing is also becoming more accessible to small and medium enterprises. The continuous evolution of this technology will define the next decade of IT advancements.', FALSE, 100, 2, 1),
('Top Python Tips for Developers', NOW() - INTERVAL '5 days', NULL, 'Python remains a popular language for developers worldwide, offering simplicity and versatility. Mastering Python tips can dramatically enhance coding efficiency. Developers are advised to focus on clean and maintainable code practices. Using Pythons extensive libraries can speed up problem-solving. Debugging and profiling tools are essential for optimizing scripts. Learning advanced concepts, such as decorators and generators, can save time. Python is widely used in data science, web development, and automation. Writing tests and documentation ensures better collaboration and scalability. The community offers abundant resources for learning and improving skills. Staying updated with new Python versions and tools can give developers a competitive edge.', TRUE, 200, 5, 1),
('Cybersecurity Threats in 2024', NOW() - INTERVAL '4 days', NULL, 'Cybersecurity is a top priority in 2024 due to rising digital threats. New malware and ransomware attacks are targeting individuals and organizations. Protecting sensitive data requires updated security protocols and practices. Cybersecurity experts are developing advanced AI-driven threat detection systems. Industries are adopting zero-trust security models to minimize breaches. Educating employees about phishing and social engineering tactics is crucial. The rise of IoT devices adds new vulnerabilities to networks. Governments are enforcing stricter regulations to safeguard digital ecosystems. Ethical hacking and bug bounty programs are gaining traction to uncover flaws. Investing in robust cybersecurity infrastructure is no longer optional but mandatory.', FALSE, 175, 8, 1),
('Machine Learning Breakthroughs', NOW() - INTERVAL '3 days', NOW() - INTERVAL '2 days', 'Machine learning breakthroughs are transforming technology and industries. Researchers are exploring innovative algorithms to solve complex problems. Natural language processing advancements are enhancing AI communication. Image recognition and computer vision are improving automation and safety. Reinforcement learning is pushing the boundaries of autonomous systems. Machine learning is revolutionizing healthcare diagnostics and treatment plans. The integration of machine learning with robotics is advancing smart devices. Ethical concerns about data bias and fairness remain critical discussions. Cloud-based ML services are making technology accessible to businesses of all sizes. These developments continue to fuel progress across sectors, from finance to education.', TRUE, 300, 1, 1),
('Innovations in Health Tech', NOW() - INTERVAL '2 days', NULL, 'Health technologies are reshaping the medical landscape with groundbreaking advancements. Diagnostics tools now leverage AI to detect diseases early and accurately. Wearable health devices track real-time data, promoting preventive care. Telemedicine services are connecting patients with doctors regardless of distance. Robotic surgery is enhancing precision, reducing recovery times for patients. Genomic technologies are enabling personalized treatments for complex diseases. Mobile health apps empower individuals to manage their health proactively. Research in nanotechnology is offering innovative solutions for drug delivery. As healthcare becomes more technology-driven, accessibility and affordability remain key challenges. Governments and organizations are collaborating to ensure these innovations reach underserved communities.', TRUE, 250, 4, 1),
('Exploring Quantum Computing', NOW() - INTERVAL '1 day', NULL, 'Quantum computing represents a monumental leap in computational power and possibilities. By leveraging quantum mechanics, it processes data at unprecedented speeds. Industries like finance and cryptography are exploring quantum algorithms for optimization. Quantum simulations could revolutionize material science and drug discovery. The field is still in its infancy, with practical applications emerging gradually. Quantum computers require significant advancements in error correction and stability. Governments and tech giants are heavily investing in quantum research initiatives. Collaboration between academia and industry is driving innovation in this space. Quantum networks could transform data security by enabling unbreakable encryption. The long-term potential of quantum computing could redefine every facet of technology.', FALSE, 350, 2, 1),
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
('/images/news/green_buildings.jpg', 'PostTitle', 25, NULL);

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
