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
'Researchers have unveiled a new diagnostic system powered by Artificial Intelligence that promises unprecedented accuracy in detecting diseases. Named MediSense AI, the system uses advanced deep learning models to analyze medical images such as X-rays, MRIs, and CT scans in a matter of seconds. Preliminary tests indicate an accuracy rate exceeding 95 percent, outperforming human specialists in critical areas, including early cancer detection.

According to the project’s lead scientist, Jane Carter, this system has the potential to transform healthcare, especially in regions where access to specialists is limited. Integrating AI into diagnostics can save lives and significantly reduce costs.

Key features of MediSense AI include real-time analysis delivering diagnostic results in less than 10 seconds, the ability to identify over 50 different conditions, including rare diseases, and functionality across multiple languages and low-resource environments.

The implications of this advancement extend far beyond diagnostics. Experts predict that AI will soon play a central role in personalized medicine, tailoring treatments to individual patients based on genetic profiles and medical histories.

However, the rise of such advanced AI systems also raises ethical and regulatory concerns, particularly regarding patient data privacy and the risk of over-reliance on automated systems.

Tech giants and governments are closely monitoring developments in this field. With investments in AI-driven healthcare solutions expected to exceed 100 billion dollars by 2030, MediSense AI could mark the beginning of a new era in medical science.

For further updates on this story and its global impact, stay tuned to our news section.',
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
'Python has become one of the most popular programming languages, and mastering its nuances can significantly improve your productivity. First, embrace the Zen of Python by following its principles for writing clean and readable code. Leverage built-in functions like map, filter, and zip to simplify common operations and avoid unnecessary loops. Use list comprehensions for concise and efficient data manipulation, but ensure they remain readable. When handling large datasets, consider using generators to save memory. The functools library is invaluable for advanced tasks such as memoization with lru_cache and function chaining with reduce. Always prefer Pythonic idioms like unpacking for cleaner code. For debugging, take advantage of pdb or the breakpoint function, both of which allow you to inspect variables and step through your code. Writing modular code using functions and classes will not only make your programs easier to maintain but also encourage reusability. Use type hints and tools like mypy to make your code self-documenting and to catch type-related bugs early. Finally, invest time in mastering virtual environments with venv or conda to isolate dependencies for different projects, ensuring compatibility and avoiding version conflicts. By consistently applying these tips, you can take your Python skills to the next level and write code that is not only functional but also elegant.',
TRUE, 200, 5, 3),

('Cybersecurity Threats in 2024', NOW() - INTERVAL '4 days', NULL, 
'Cybersecurity threats continue to evolve in 2024, demanding increased vigilance from both companies and individuals. One of the most alarming trends is the growing use of artificial intelligence by attackers to create more sophisticated malware and conduct targeted attacks. This malware, often referred to as “polymorphic,” can automatically modify its code to evade detection by traditional security systems.

Another major challenge is ransomware attacks, now employing new double extortion tactics. In addition to locking access to data, attackers threaten to publicly release sensitive information. Sectors such as healthcare, finance, and critical infrastructure remain prime targets, with hospitals and power grids frequently at the center of attacks due to their strategic importance.

Phishing scams have also become more advanced, using deepfake voice and video technology to deceive victims, particularly in corporate environments. A recent example involved a fictitious CEO created with AI technology, who successfully instructed employees to transfer large sums of money to accounts controlled by criminals.

Additionally, digital supply chains are being exploited by attackers implanting malware into widely used software. Incidents like attacks compromising open-source code libraries highlight the need for greater vigilance and audits of third-party solutions.

With the growing connectivity of IoT devices, threats are expanding into the physical world, such as attacks on smart home systems or connected medical devices. Experts warn that security measures for these devices have not yet kept pace with their rapid adoption.

In response to this landscape, specialists recommend increased investment in AI-based threat detection tools, continuous training for teams to identify social engineering attacks, and the implementation of robust practices like multi-factor authentication and regular backups. The future of cybersecurity will depend on a collective effort by governments, businesses, and individuals to mitigate risks and safeguard sensitive data.',
FALSE, 175, 8, 4),

('Machine Learning Breakthroughs', NOW() - INTERVAL '3 days', NOW() - INTERVAL '2 days', 
'The advances in machine learning in 2024 are marking a new chapter in artificial intelligence, with breakthroughs that expand its applications and efficiency. Multimodal models, capable of processing text, images, audio, and even video simultaneously, are gaining prominence, enabling richer and more dynamic interactions between machines and users. These tools, such as the revolutionary Gemini model, can not only understand complex contexts but also generate highly tailored responses across different types of data.

In the field of sustainability, machine learning is being used to optimize renewable energy systems. Advanced algorithms help predict solar and wind generation patterns with greater accuracy, improving efficiency and reducing waste. Additionally, deep learning models are being implemented to monitor forests and detect early signs of deforestation or wildfires, aiding in environmental protection.

Another significant milestone is the progress in reinforcement learning models. Companies are using this technique to develop smarter industrial robots that learn to perform complex tasks independently, from assembling components to autonomously exploring unknown environments. These systems are cutting costs and boosting productivity in factories worldwide.

In healthcare, machine learning is revolutionizing drug discovery. New algorithms are reducing the time required to identify promising compounds, enabling the faster and more accessible creation of treatments for rare diseases. Moreover, AI-based diagnostics are becoming increasingly reliable, helping doctors detect conditions like cancer and heart problems in their early stages.

These advancements not only highlight the transformative potential of machine learning but also underscore the importance of developing ethical and inclusive technologies, ensuring that the benefits are widely distributed and accessible.',
TRUE, 300, 1, 5),

('Innovations in Health Tech', NOW() - INTERVAL '2 days', NULL, 
'Innovations in health technology are revolutionizing the sector in 2024, bringing advancements that promise to enhance diagnosis, treatment, and overall patient care. One of the leading trends is the use of wearable devices equipped with advanced sensors for real-time health monitoring. These devices, such as next-generation smartwatches, can detect cardiac arrhythmias, monitor blood glucose levels, and even predict panic attacks before they occur.

Artificial intelligence (AI) is also playing a pivotal role. Machine learning algorithms are being utilized to analyze medical images with exceptional precision, helping doctors detect conditions like cancer and neurological diseases at earlier stages. Meanwhile, generative AI systems are assisting in the creation of personalized treatment plans, leveraging clinical, genetic, and historical health data to tailor care to each patient.

Another significant breakthrough is the application of 3D printing in medicine. Custom prosthetics and biological implants are becoming more accessible, while artificial organs printed with human cells are undergoing testing, offering new hope to patients awaiting transplants.

In telemedicine, new platforms are integrating virtual consultations with automated diagnostics, enabling patients in remote areas to access high-quality care. These systems use AI for initial triage, reducing wait times and optimizing medical resources.

Additionally, biotechnology is advancing with genetic therapies that target rare diseases at the DNA level. Techniques like CRISPR are being refined for greater precision and safety, opening doors to potential cures for previously untreatable conditions.

These innovations in health tech are not only saving lives but also redefining the possibilities of medical care, making it more efficient, accessible, and patient-centric.',
TRUE, 250, 4, 6),

('Exploring Quantum Computing', NOW() - INTERVAL '1 day', NULL, 
'Quantum computing is emerging as one of the most exciting and revolutionary fields in technology. In 2024, advancements in quantum computing continue to push the boundaries of what’s possible in computation, offering the potential to solve complex problems that are beyond the reach of classical computers. Unlike traditional computers that process information in bits, quantum computers use quantum bits, or qubits, which can represent both 0 and 1 simultaneously due to a property called superposition. This allows quantum computers to perform parallel computations at an unprecedented scale.

One of the major breakthroughs in 2024 is the development of more stable qubits. Researchers are focusing on improving qubit coherence times, which determine how long a qubit can retain its quantum state. This has been a significant challenge, as qubits are highly sensitive to their environment, and even minor disturbances can cause errors. With enhanced error correction techniques and improved qubit designs, quantum systems are becoming more reliable and capable of handling real-world tasks.

Quantum computing also has great potential in fields like cryptography, material science, and drug discovery. In cryptography, quantum computers could eventually break widely used encryption methods, which is driving the development of quantum-safe encryption techniques. In material science, quantum simulations could lead to the discovery of new materials with enhanced properties, while in drug discovery, quantum algorithms could dramatically speed up the process of finding new compounds for treating diseases.

Despite these advancements, quantum computing is still in its infancy. The technology faces numerous challenges, including scalability, noise management, and the need for more efficient algorithms. However, companies like IBM, Google, and startups like Rigetti Computing are making significant strides, and in the coming years, we may see the first commercial quantum computing systems begin to emerge.

As the field continues to grow, exploring quantum computing offers an exciting opportunity for developers, researchers, and tech enthusiasts to contribute to one of the most promising technological revolutions of our time.',
FALSE, 350, 2, 7),

('Developments in 5G Technology', NOW(), NULL, 
'In 2024, 5G technology is continuing its rapid expansion, promising to transform industries and enable innovations across a wide range of sectors. Building on the groundwork laid by earlier generations, 5G offers significantly faster data speeds, ultra-low latency, and the ability to connect a massive number of devices simultaneously, enabling the true potential of the Internet of Things (IoT) to be realized.

One of the most notable developments in 5G technology this year is the ongoing rollout of standalone 5G networks. These networks, unlike earlier versions that were built on top of 4G infrastructure, operate independently, offering enhanced performance and reliability. With the deployment of standalone 5G, users can expect even faster download speeds, improved network efficiency, and better coverage, especially in densely populated urban areas.

Another key advancement is the introduction of 5G-enabled private networks. These networks are being adopted by enterprises to power applications that require high-speed, low-latency connections, such as real-time data processing, smart manufacturing, and autonomous vehicles. Private 5G networks offer enhanced security, control, and reliability, making them ideal for industries like healthcare, logistics, and energy.

In addition to the advancements in infrastructure, 5G technology is playing a pivotal role in the development of cutting-edge applications. In healthcare, 5G is enabling remote surgery and telemedicine with high-definition video and near-instantaneous data transfer. In entertainment, 5G is driving the growth of immersive experiences like augmented reality (AR) and virtual reality (VR), offering users ultra-responsive and seamless interactions in gaming, education, and entertainment.

Edge computing, which involves processing data closer to the source rather than relying on distant data centers, is another key area where 5G and its ultra-low latency capabilities are making a significant impact. This combination is enhancing everything from autonomous vehicles to real-time analytics in industrial automation.

Despite these exciting developments, challenges remain. The global rollout of 5G networks faces obstacles, including the high cost of infrastructure, regulatory hurdles, and the need for widespread adoption of 5G-enabled devices. However, as more regions and industries adopt 5G, the technology’s potential will continue to grow, opening the door to new innovations and applications.

In 2024, 5G is not just an incremental improvement but a transformative leap forward, offering unprecedented speed, connectivity, and reliability that will shape the digital future for years to come.',
TRUE, 400, 6, 8),

('Could AI help prevent diabetes-related sight loss?', NOW(), NULL,
'<h2><strong style="color: rgb(255, 255, 255);">This is the second feature in a six-part series that is looking at how AI is changing medical research and treatments.</strong></h2><p><br></p><h3><span style="color: rgb(255, 255, 255);">Terry Quinn was only in his teens when he was diagnosed with diabetes. In some ways he rebelled against the label and frequent tests, not wanting to feel different.</span></h3><h3><span style="color: rgb(255, 255, 255);">His biggest fear was of someday needing to have his foot amputated. Vision loss, another possible complication of diabetes, wasn’t really on his radar. </span></h3><p><br></p><blockquote><span style="color: rgb(255, 255, 255);">“I never thought I’d lose my sight,” says Quinn, who lives in West Yorkshire.</span></blockquote><h3><span style="color: rgb(255, 255, 255);">But one day he noticed bleeding in his eye. Doctors told him he had diabetic retinopathy: diabetes-related damage to blood vessels in the retinas. This required laser treatments and then injections.</span></h3><h3><span style="color: rgb(255, 255, 255);">Eventually the treatments weren’t enough to prevent the deterioration of his vision. He would hurt his shoulder walking into lampposts. He couldn’t make out his son’s face. And he had to give up driving.</span></h3><p><br></p><blockquote><span style="color: rgb(255, 255, 255);">“I felt pathetic. I felt like this shadow of a man that couldn’t do anything,” he remembers.</span></blockquote><h3><span style="color: rgb(255, 255, 255);">One thing that helped him climb out of his despair was the support of the Guide Dogs for the Blind Association, which connected him with a black Labrador named Spencer. “He saved my life,” says Quinn, who is now a fundraiser for Guide Dogs.</span></h3><h3><span style="color: rgb(255, 255, 255);">In the UK </span><u style="color: rgb(255, 255, 255);">the NHS invites patients</u><span style="color: rgb(255, 255, 255);"> for diabetic eye screening every one or two years.</span></h3><h3><span style="color: rgb(255, 255, 255);">US guidelines are that every adult with type 2 diabetes should be screened at diagnosis of diabetes, and then annually if there are no issues. Yet for many people, that doesn’t happen in practice.</span></h3><p><br></p><blockquote><span style="color: rgb(255, 255, 255);">“There’s very clear evidence that screening prevents vision loss,” says Roomasa Channa, a retina specialist at the University of Wisconsin-Madison in the US.</span></blockquote><h3><span style="color: rgb(255, 255, 255);">In the US barriers include cost, communication and convenience. Dr Channa believes that making the tests easier to access would help patients.</span></h3><h3><span style="color: rgb(255, 255, 255);">To screen for diabetic retinopathy health professionals take pictures of the rear interior wall of the eye, known as the fundus.</span></h3><p><br></p><blockquote><span style="color: rgb(255, 255, 255);">Currently, interpreting fundus images manually is “a lot of repetitive work”, Dr Channa says.</span></blockquote><h3><span style="color: rgb(255, 255, 255);">But some think that artificial intelligence (AI) could speed up the process and make it cheaper.</span></h3><h3><span style="color: rgb(255, 255, 255);">Diabetic retinopathy develops in fairly clear stages, which means that AI can be trained to pick it up.</span></h3><h3><span style="color: rgb(255, 255, 255);">In some cases, AI could decide whether a referral to an eye specialist is needed, or work in tandem with human image graders.</span></h3><p class="ql-align-center"><br></p><p class="ql-align-center"><img src="http://localhost:8000/post/5z/gX/5zgXClzYNWdtl4pR1WaAckbLINwJn59wTsmTaifB.jpg"></p><p><br></p><ol><li data-list="bullet"><span class="ql-ui" contenteditable="false"></span><a href="http://localhost:8000/news/16" rel="noopener noreferrer" target="_blank">More on AI and Medicine</a></li></ol>',
FALSE, 500, 7, 1),

('Tech giants like Meta, Google to be forced to pay for Australian news', NOW(), NULL,
'<h2>Billion of dollars will arrive to Australia.</h2><h3><br></h3><h3><strong style="color: rgb(255, 255, 255); background-color: rgb(68, 68, 68);"><em>SydneyReuters</em></strong><em style="color: rgb(255, 255, 255); background-color: rgb(68, 68, 68);"> </em><span style="color: rgb(255, 255, 255); background-color: rgb(68, 68, 68);">— </span></h3><h3><a href="https://www.cnn.com/world/australia" rel="noopener noreferrer" target="_blank" style="color: rgb(255, 255, 255); background-color: rgb(68, 68, 68);">Australia</a><span style="color: rgb(255, 255, 255); background-color: rgb(68, 68, 68);"> plans new rules to “create a financial incentive” for big tech firms to pay Australian media companies for news content on their platforms, Assistant Treasurer and Minister for Financial Services Stephen Jones announced on Thursday.</span></h3><h3><span style="color: rgb(255, 255, 255); background-color: rgb(68, 68, 68);">The move, described as a “news bargaining initiative,” piles pressure on global tech giants like Facebook-owner Meta Platforms and Google to pay publishers for content or face the risk of paying millions to continue operations in Australia.</span></h3><h3><br></h3><div class="ql-code-block-container" spellcheck="false"><div class="ql-code-block" data-language="plain">“The News Bargaining Initiative will … will create a financial incentive for agreement-making between digital platforms and news media businesses in Australia,” Jones told a press conference.</div></div><h3><br></h3><h3><span style="color: rgb(255, 255, 255); background-color: rgb(68, 68, 68);">The platforms at risk of the charge will be significant social media platforms and search engines with an Australian-based revenue in excess of 250 million Australian dollars (about $160 million), he said.</span></h3><p><br></p><p><img src="http://localhost:8000/post/XF/lw/XFlwnCmeZSDsv74SG1SusgmYh6lyzxrck4WOclHI.png"></p><h3><br></h3><h3><span style="color: rgb(255, 255, 255); background-color: rgb(68, 68, 68);">The charge will be offset for any commercial agreements that are voluntarily entered into between the platforms and news media businesses, he added.</span></h3><h3><span style="color: rgb(255, 255, 255); background-color: rgb(68, 68, 68);">Australia in 2021 passed laws to make the US tech giants, such as Alphabet’s Google and Meta, compensate media companies for the links that drive readers - and advertising revenue - to their platforms.</span></h3><h3><span style="color: rgb(255, 255, 255); background-color: rgb(68, 68, 68);">“We agree with the government that the current law is flawed and continue to have concerns about charging one industry to subsidise another,” a Meta spokesman said after Jones’ announcement.</span></h3><h3><span style="color: rgb(255, 255, 255); background-color: rgb(68, 68, 68);">“The proposal fails to account for the realities of how our platforms work, specifically that most people don’t come to our platforms for news content and that news publishers voluntarily choose to post content on our platforms because they receive value from doing so.”</span></h3><h3><span style="color: rgb(255, 255, 255); background-color: rgb(68, 68, 68);">Meta struck deals with several Australian media firms including News Corp and national broadcaster Australian Broadcasting Corp but has since said it will not renew those arrangements beyond 2024.</span></h3><p><br></p><p><br></p>',
TRUE, 469, 0, 1),

('Forbes is cutting ties with freelance writers, citing Google spam policies', NOW(), NULL,
'<h2><strong style="color: rgb(255, 255, 255);">One explanation for the change: updated Google Search rules around “parasite” SEO.</strong></h2><p><br></p><p><img src="http://localhost:8000/post/aT/Py/aTPyf8anWSS0O3B52BkiTEkiSvncXwL0eM9GWuVS.jpg"></p><p><br></p><h3><em style="color: rgb(255, 255, 255);">Forbes</em><span style="color: rgb(255, 255, 255);"> will stop using freelancers for some types of stories indefinitely — and has blamed the change on a recent update to Google Search policies.</span></h3><h3><span style="color: rgb(255, 255, 255);">In recent days, </span><em style="color: rgb(255, 255, 255);">Forbes </em><span style="color: rgb(255, 255, 255);">has said it will stop hiring freelancers to produce content for its product review section Forbes Vetted, according to a journalist who has written for the site. In a note shared with</span><em style="color: rgb(255, 255, 255);"> The Verge, </em><span style="color: rgb(255, 255, 255);">an editor at </span><em style="color: rgb(255, 255, 255);">Forbes </em><span style="color: rgb(255, 255, 255);">cited </span><u style="color: rgb(255, 255, 255);">Google’s “site reputation abuse” policy </u><span style="color: rgb(255, 255, 255);">for the change.</span></h3><h3><span style="color: rgb(255, 255, 255);">Site reputation abuse — also called parasite SEO — refers to a website publishing a deluge of off-brand or irrelevant content in order to take advantage of the main site’s ranking power and reputation in Google Search. Often, this piggybacking is concealed from users browsing the website. (For instance: those weird coupon code sections on newspaper sites that pop up via search engines but aren’t prominently displayed on the homepage.) Sometimes this spammy content is produced by </span><u style="color: rgb(255, 255, 255);">third-party marketing firms</u><span style="color: rgb(255, 255, 255);"> that are contracted to produce a mountain of search-friendly content.</span></h3><p><br></p><blockquote><span style="color: rgb(255, 255, 255);">“Our evaluation of numerous cases has shown that no amount of first-party involvement alters the fundamental third-party nature of the content or the unfair, exploitative nature of attempting to take advantage of the host’s sites ranking signals,” the company </span><a href="https://developers.google.com/search/blog/2024/11/site-reputation-abuse" rel="noopener noreferrer" target="_blank" style="color: rgb(255, 255, 255);">wrote</a><span style="color: rgb(255, 255, 255);"> in a blog post.</span></blockquote><p><br></p><p>Related News:</p><ol><li data-list="ordered"><span class="ql-ui" contenteditable="false"></span><a href="http://localhost:8000/news/7" rel="noopener noreferrer" target="_blank">Virtual Reality: The Next Big Thing?</a></li><li data-list="ordered"><span class="ql-ui" contenteditable="false"></span><a href="http://localhost:8000/news/14" rel="noopener noreferrer" target="_blank">Cybersecurity Threats in 2024</a></li></ol><p><br></p>',
FALSE, 200, 2, 1);


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
('post/qZsEnWGYlGFc4G8TofPZiH7oSkzCHbbVHZkzc5A4.jpg', 'PostTitle', 18, NULL),
('post/4bLhpc8uLI4LW4NgQuuz6nODbuOhOcWRxpqaCRoI.jpg', 'PostTitle', 19, NULL),
('post/T92f1jtE2yFhTLDl0CTUD72Zm0dsx3ppkDd9oTC9.jpg', 'PostTitle', 20, NULL),
('post/rE7luglk5BFAJDLJalIbGoRthgFr2r8X26TOxBCd.jpg', 'PostTitle', 21, NULL);

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
