DELIMITER ;

CREATE OR REPLACE TABLE `dbProj_USER` (
	`userID` int NOT NULL AUTO_INCREMENT,
	`userName` varchar(30) NOT NULL,
	`password` varchar(30) NOT NULL,
	`firstName` varchar(30) NOT NULL,
	`lastName` varchar(30) NOT NULL,
	`DOB` date NOT NULL,
	`regDate` date NOT NULL,
	`roleID` int(30) NOT NULL,
    PRIMARY KEY (`userID`),
    CONSTRAINT username_unique UNIQUE (userName)
);

CREATE OR REPLACE TABLE `dbProj_CATEGORY` (
    `catID` int NOT NULL AUTO_INCREMENT,
    `catName` varchar(60),
    PRIMARY KEY (`catID`)
);

CREATE OR REPLACE TABLE `dbProj_ARTICLE` (
    `articleID` int NOT NULL AUTO_INCREMENT,
    `title` varchar(500),
    `description` varchar(1000),
    `content` varchar(2000),
    `publishDate` datetime,
    `views` int(11),
    `likes` int(11),
    `dislikes` int(11),
    `rating` float(11) GENERATED ALWAYS AS (round(likes/if(likes+dislikes,0,1))),
    `isPublished` boolean DEFAULT FALSE,
    `userID` int(11) NOT NULL,
    `catID` int(11),
    PRIMARY KEY (`articleID`),
    FOREIGN KEY (`userID`) REFERENCES `dbProj_USER`(`userID`),
    FOREIGN KEY (`catID`) REFERENCES `dbProj_CATEGORY`(`catID`)
)ENGINE=MyISAM;

CREATE OR REPLACE TABLE `dbProj_COMMENT` (
    `commentID` int NOT NULL AUTO_INCREMENT,
    `commentText` varchar(500),
    `creationDate` datetime,
    `userID` int,
    `articleID` int,
    PRIMARY KEY (`commentID`),
    FOREIGN KEY (`userID`) REFERENCES `dbProj_USER`(`userID`),
    FOREIGN KEY (`articleID`) REFERENCES `dbProj_ARTICLE`(`articleID`)
)ENGINE=MyISAM;

CREATE OR REPLACE TABLE `dbProj_FILES`(
    `fileID` int(11) NOT NULL AUTO_INCREMENT,
    `fileName` int(11) NOT NULL,
    `fileType` varchar(30),
    `filelocation` varchar(30),
    `articleID` int NOT NULL,
    PRIMARY KEY (`fileID`),
    FOREIGN KEY (`articleID`) REFERENCES `dbProj_ARTICLE`(`articleID`)
)ENGINE=MyISAM;

ALTER TABLE dbProj_ARTICLE ADD FULLTEXT(title);

INSERT INTO dbProj_USER (userID, userName, password, firstName, lastName, DOB, regDate, roleID) VALUES (NULL,'User1',AES_ENCRYPT('123', 'P0ly'),'User','One', DATE('2002-03-06'),CURRENT_DATE(),2);

INSERT INTO dbProj_USER (userID, userName, password, firstName, lastName, DOB, regDate, roleID) VALUES (NULL,'User2',AES_ENCRYPT('123', 'P0ly'),'User','Two', DATE('2002-04-07'),CURRENT_DATE(),2);

INSERT INTO dbProj_USER (userID, userName, password, firstName, lastName, DOB, regDate, roleID) VALUES (NULL,'User3',AES_ENCRYPT('123', 'P0ly'),'User','Three', DATE('2002-05-08'),CURRENT_DATE(),2);

INSERT INTO dbProj_USER (userID, userName, password, firstName, lastName, DOB, regDate, roleID) VALUES (NULL,'Author1',AES_ENCRYPT('123', 'P0ly'),'Author','One', DATE('2002-06-09'),CURRENT_DATE(),1);

INSERT INTO dbProj_USER (userID, userName, password, firstName, lastName, DOB, regDate, roleID) VALUES (NULL,'Author2',AES_ENCRYPT('123', 'P0ly'),'Author','Two', DATE('2002-07-10'),CURRENT_DATE(),1);

INSERT INTO dbProj_USER (userID, userName, password, firstName, lastName, DOB, regDate, roleID) VALUES (NULL,'Author3',AES_ENCRYPT('123', 'P0ly'),'Author','Three', DATE('2002-08-11'),CURRENT_DATE(),1);

INSERT INTO dbProj_USER (userID, userName, password, firstName, lastName, DOB, regDate, roleID) VALUES (NULL,'Admin1',AES_ENCRYPT('123', 'P0ly'),'Admin','One', DATE('2002-06-09'),CURRENT_DATE(),0);

INSERT INTO dbProj_USER (userID, userName, password, firstName, lastName, DOB, regDate, roleID) VALUES (NULL,'Admin2',AES_ENCRYPT('123', 'P0ly'),'Admin','Two', DATE('2002-07-10'),CURRENT_DATE(),0);

INSERT INTO dbProj_USER (userID, userName, password, firstName, lastName, DOB, regDate, roleID) VALUES (NULL,'Admin3',AES_ENCRYPT('123', 'P0ly'),'Admin','Three', DATE('2002-08-11'),CURRENT_DATE(),0);


INSERT INTO dbProj_CATEGORY (catID, catName) VALUES (NULL,"International News");

INSERT INTO dbProj_CATEGORY (catID, catName) VALUES (NULL,"Local News");

INSERT INTO dbProj_CATEGORY (catID, catName) VALUES (NULL,"Sports and Art News");

INSERT INTO dbProj_CATEGORY (catID, catName) VALUES (NULL,"Weather News");

INSERT INTO dbProj_CATEGORY (catID, catName) VALUES (NULL,"Advertisement Section");

INSERT INTO dbProj_CATEGORY (catID, catName) VALUES (NULL,"Latest Movies and Movie Reviews");


INSERT INTO dbProj_ARTICLE (articleID, title, description, content, publishDate, views, likes, dislikes, rating, isPublished, userID, catID)
VALUES (NULL, 'World Leaders Gather at G7 Summit to Address Global Challenges', 'Leaders from the world''s most powerful economies convened at the G7 Summit to discuss pressing issues such as climate change, pandemic recovery, and economic cooperation.', "The G7 Summit served as a platform for global leaders to come together and address the pressing challenges facing our world today. With a shared commitment to finding solutions, the summit resulted in agreements that aim to promote sustainable development, strengthen healthcare systems, and enhance international cooperation on various fronts.\n\nClimate change, a critical concern for the international community, was one of the key topics discussed. Leaders acknowledged the urgency of taking action to mitigate its effects and committed to ambitious goals and strategies to combat climate change.\n\nAdditionally, the summit focused on pandemic recovery and economic cooperation. Discussions centered around bolstering healthcare systems, ensuring equitable access to vaccines and treatments, and fostering economic growth that benefits all nations. The agreements reached at the summit reflect a collective effort to address global challenges and pave the way for a more sustainable and prosperous future.", NOW(), 0, 0, 0, NULL, 1, 4, 1);


INSERT INTO dbProj_ARTICLE (articleID, title, description, content, publishDate, views, likes, dislikes, rating, isPublished, userID, catID)
VALUES (NULL, 'Tensions Escalate in Middle East: International Community Urges Diplomatic Solutions', 'Rising tensions in the Middle East have raised concerns among the international community.', "The escalating tensions in the Middle East have prompted a growing sense of unease among the global community. Leaders and diplomats worldwide are emphasizing the urgent need for diplomatic solutions to prevent further escalation of conflicts and maintain stability in the region.\n\nDialogue, negotiation, and peaceful resolutions are being advocated as the most effective means to address the complex challenges and foster understanding among nations. The international community recognizes that lasting solutions can only be achieved through constructive engagement and cooperation.\n\nEfforts are underway to promote dialogue and facilitate diplomatic channels to de-escalate tensions and promote peace in the Middle East. The collective commitment to finding peaceful resolutions demonstrates the determination of leaders and diplomats to safeguard regional stability and work towards a more peaceful and prosperous future.", NOW(), 0, 0, 0, NULL, 1, 5, 1);

INSERT INTO dbProj_ARTICLE (articleID, title, description, content, publishDate, views, likes, dislikes, rating, isPublished, userID, catID)
VALUES (NULL, 'Global Efforts to Combat Climate Change: Paris Agreement Milestones', 'Countries worldwide are stepping up their commitments to combat climate change.', "The global community is witnessing a significant rise in efforts to combat climate change. Countries across the globe are recognizing the urgency of the situation and taking concrete steps to address this pressing issue.\n\nRecent milestones in the fight against climate change include the establishment of ambitious renewable energy targets, the adoption of carbon neutrality pledges, and a substantial increase in investments towards sustainable infrastructure. These actions showcase a growing global consensus on the need for collective action to protect our planet.\n\nThe Paris Agreement, a landmark international treaty, has played a pivotal role in driving these commitments. As nations join forces to implement the goals and targets outlined in the agreement, there is renewed hope for a sustainable and resilient future. The Paris Agreement has become a catalyst for collaboration, innovation, and the sharing of best practices across borders.", NOW(), 0, 0, 0, NULL, 1, 6, 1);


INSERT INTO dbProj_ARTICLE (articleID, title, description, content, publishDate, views, likes, dislikes, rating, isPublished, userID, catID)
VALUES (NULL, 'Community Comes Together for Annual Charity Drive', 'Local residents rallied together for the annual charity drive.', "The community's annual charity drive brought together local residents for a noble cause. Participants actively contributed by raising funds and donating essential items to support underprivileged members of the community.\n\nThe event served as a powerful demonstration of unity and compassion, highlighting the profound impact that collective action can have at the local level. Through their generosity and kindness, individuals showcased the spirit of giving and selflessness, creating a positive and lasting change in the lives of those in need.\n\nThe success of the annual charity drive exemplifies the strong sense of community and the willingness of people to come together for the betterment of society. It not only addresses immediate needs but also fosters a culture of empathy, encouraging continued support and engagement in future initiatives.", NOW(), 0, 0, 0, NULL, 0, 4, 2);

INSERT INTO dbProj_ARTICLE (articleID, title, description, content, publishDate, views, likes, dislikes, rating, isPublished, userID, catID)
VALUES (NULL, 'New Cultural Center Opens: Celebrating Local Arts and Heritage', 'A new cultural center has opened its doors, providing a platform for local artists, musicians, and performers to showcase their talent. The center aims to promote and preserve the rich cultural heritage of the community while fostering a vibrant arts scene.', "The grand opening of the new cultural center marks a significant milestone for the community, as it offers an exciting space for local artists, musicians, and performers to exhibit their talent and share their passion with the public.\n\nWith a vision to celebrate and preserve the diverse cultural heritage of the community, the center serves as a hub for creativity and expression. It provides artists with a platform to showcase their artwork, musicians to perform their melodies, and performers to captivate the audience with their skills.\n\nBy nurturing and supporting the local arts scene, the cultural center not only enriches the community's cultural fabric but also creates opportunities for collaboration, education, and entertainment. It brings people together, fostering a sense of pride and appreciation for the arts.", NOW(), 0, 0, 0, NULL, 5, 5, 2);

INSERT INTO dbProj_ARTICLE (articleID, title, description, content, publishDate, views, likes, dislikes, rating, isPublished, userID, catID)
VALUES (NULL, 'Local High School Wins Robotics Competition', 'A local high school''s robotics team emerged victorious at a prestigious regional competition, showcasing their innovation and technical expertise. The students'' hard work and dedication paid off, earning recognition for their school and inspiring future generations of aspiring engineers and scientists.', "The local high school's robotics team has achieved remarkable success at the recent regional competition, securing the top position and demonstrating their exceptional innovation and technical skills.\n\nTheir victory is a testament to the countless hours of hard work, perseverance, and dedication put in by the students, as well as the guidance and support provided by their mentors and teachers. The team's achievement not only brings pride to their school but also inspires and motivates other aspiring engineers and scientists.\n\nBy showcasing their talent and capabilities, the robotics team has raised the bar and set a new standard of excellence in the field of robotics. Their success serves as a shining example of what can be accomplished through determination, teamwork, and a passion for innovation.", NOW(), 0, 0, 0, NULL, 0, 6, 2);


INSERT INTO dbProj_ARTICLE (articleID, title, description, content, publishDate, views, likes, dislikes, rating, isPublished, userID, catID)
VALUES (NULL, 'Grand Slam Triumph: Tennis Star Claims Historic Victory', 'In a thrilling match, a tennis superstar secured a historic Grand Slam title, solidifying their place among the all-time greats in the sport. The victory is a testament to their skill, determination, and unwavering focus on achieving excellence.', "The recent tennis tournament witnessed a remarkable feat as a tennis superstar claimed a historic victory in the Grand Slam event.\n\nIn an exhilarating match filled with suspense and high-intensity rallies, the tennis star showcased their exceptional talent and demonstrated why they are considered one of the all-time greats in the sport. Their unwavering determination, relentless pursuit of excellence, and remarkable skill set them apart from their competitors.\n\nThis triumph marks a significant milestone in the tennis star's career, solidifying their legacy and leaving an indelible mark on the sport. Their extraordinary achievement serves as an inspiration to aspiring athletes worldwide, encouraging them to push their boundaries, work hard, and never give up on their dreams.", NOW(), 0, 0, 0, NULL, 0, 4, 3);

INSERT INTO dbProj_ARTICLE (articleID, title, description, content, publishDate, views, likes, dislikes, rating, isPublished, userID, catID)
VALUES (NULL, 'Record-Breaking Performance: Athlete Shatters Long-Standing World Record', 'An exceptional athlete broke a long-standing world record, leaving spectators awe-struck by their incredible feat. Their achievement not only showcases their exceptional talent but also sets a new benchmark for future generations of athletes to aspire to.', "In a remarkable display of skill and determination, an extraordinary athlete shattered a long-standing world record, capturing the attention and admiration of spectators from around the globe.\n\nThe awe-inspiring performance left everyone in attendance in disbelief as the athlete achieved the seemingly impossible. Their exceptional talent, unwavering focus, and relentless pursuit of greatness propelled them to surpass the previous record and etch their name in the annals of sporting history.\n\nThis monumental accomplishment not only highlights the remarkable abilities of the athlete but also serves as an inspiration for aspiring athletes worldwide. It sets a new benchmark, pushing the boundaries of what is considered achievable and motivating future generations to strive for excellence.", NOW(), 0, 0, 0, NULL, 0, 5, 3);

INSERT INTO dbProj_ARTICLE (articleID, title, description, content, publishDate, views, likes, dislikes, rating, isPublished, userID, catID)
VALUES (NULL, 'Art Exhibition Inspires Creativity and Conversation', 'A thought-provoking art exhibition captivated audiences with its innovative and meaningful artworks. The exhibition served as a platform for artists to express their perspectives on contemporary issues, sparking engaging discussions and fostering a deeper appreciation for the power of art.', "The recently held art exhibition proved to be a transformative experience, as attendees were immersed in a world of creativity and imagination.\n\nThe exhibition showcased a diverse range of artworks, each one thoughtfully created to evoke emotions and challenge conventional thinking. From paintings and sculptures to installations and digital art, the exhibition provided a platform for artists to communicate their unique perspectives on contemporary issues.\n\nVisitors were captivated by the thought-provoking nature of the artworks, which prompted deep conversations and meaningful interactions. The exhibition became a catalyst for exploring important topics and fostering a greater understanding of the power of art in shaping society and influencing change.", NOW(), 0, 0, 0, NULL, 0, 6, 3);


INSERT INTO dbProj_ARTICLE (articleID, title, description, content, publishDate, views, likes, dislikes, rating, isPublished, userID, catID)
VALUES (NULL, 'Severe Storm Warning: Preparing for Extreme Weather Conditions', 'Meteorologists have issued a severe storm warning, urging residents to take necessary precautions to ensure their safety. With strong winds and heavy rainfall expected, it is essential to stay informed and prepared for potential disruptions to daily life.', "As the severe storm warning looms, it becomes crucial for individuals and communities to prioritize their safety and well-being.\n\nMeteorologists are predicting the arrival of intense weather conditions characterized by strong winds and heavy rainfall. These weather events can pose significant risks, including property damage, power outages, and potential hazards to personal safety.\n\nIn light of this forecast, it is imperative to stay informed about the latest updates from local authorities and weather services. Taking proactive measures such as securing loose objects, stocking up on essential supplies, and reviewing emergency plans can help mitigate potential risks and ensure a smooth response in the face of adverse weather.\n", NOW(), 0, 0, 0, NULL, 0, 4, 4);

INSERT INTO dbProj_ARTICLE (articleID, title, description, content, publishDate, views, likes, dislikes, rating, isPublished, userID, catID)
VALUES (NULL, 'Heatwave Grips the Region: Tips for Staying Cool', 'As temperatures soar, a heatwave has engulfed the region, posing health risks for vulnerable individuals. The article provides helpful tips on staying cool, staying hydrated, and recognizing the signs of heat-related illnesses to ensure the well-being of the community.', "With the region in the grip of a scorching heatwave, it is crucial to take necessary precautions to stay cool and protect your health.\n\nAs temperatures continue to soar, vulnerable individuals, such as the elderly, young children, and those with pre-existing medical conditions, are particularly susceptible to heat-related illnesses. It is essential to be aware of the signs of heat exhaustion and heatstroke, which include dizziness, nausea, rapid heartbeat, and confusion.\n\nTo beat the heat and stay comfortable, experts recommend staying hydrated by drinking plenty of water, avoiding excessive physical exertion during the hottest hours of the day, seeking shade or air-conditioned spaces, and wearing lightweight, breathable clothing.\n", NOW(), 0, 0, 0, NULL, 0, 5, 4);

INSERT INTO dbProj_ARTICLE (articleID, title, description, content, publishDate, views, likes, dislikes, rating, isPublished, userID, catID)
VALUES (NULL, 'Seasonal Shift: Embracing the Arrival of Spring', 'After a long winter, the arrival of spring brings a renewed sense of joy and vitality. From blooming flowers to longer daylight hours, the article highlights the positive impacts of the changing season and encourages readers to embrace the beauty of nature around them.', "As winter fades away and the days grow longer, the arrival of spring rejuvenates both the environment and our spirits.\n\nOne of the most noticeable changes during this season is the blossoming of flowers and trees. Vibrant colors paint the landscapes, and the sweet fragrance fills the air. The sight of blooming cherry blossoms, daffodils, and tulips brings a sense of joy and hope, symbolizing new beginnings.\n\nIn addition to the visual beauty, spring also offers longer daylight hours, giving us more time to enjoy outdoor activities. The warmth of the sun, gentle breezes, and the chorus of birdsong create an inviting atmosphere to engage in recreational pursuits and connect with nature.\n", NOW(), 0, 0, 0, NULL, 0, 6, 4);


INSERT INTO dbProj_ARTICLE (articleID, title, description, content, publishDate, views, likes, dislikes, rating, isPublished, userID, catID)
VALUES (NULL, 'Experience the Ultimate Adventure: Book Your Dream Vacation Today!', 'Escape to paradise with our exclusive travel packages that offer unforgettable experiences and breathtaking landscapes. Whether you seek relaxation on pristine beaches or thrilling adventures in exotic destinations, our tailored vacations cater to all your desires.', "Are you ready to embark on the journey of a lifetime? Look no further! Our travel packages are designed to provide you with the ultimate adventure and create memories that will last a lifetime.\n\nImagine yourself lounging on pristine beaches with crystal-clear waters, feeling the warm sun on your skin and listening to the soothing sound of waves. Picture yourself exploring vibrant cities, immersing in different cultures, and tasting exotic cuisines that will tantalize your taste buds.\n\nFor thrill-seekers, we have a range of exhilarating activities such as skydiving, scuba diving, hiking through breathtaking landscapes, and much more. Our team of experienced professionals ensures your safety and guides you through these thrilling adventures.\n", NOW(), 0, 0, 0, NULL, 0, 4, 5);

INSERT INTO dbProj_ARTICLE (articleID, title, description, content, publishDate, views, likes, dislikes, rating, isPublished, userID, catID)
VALUES (NULL, 'Unleash Your Creativity: Join Our Art Workshop and Explore Your Artistic Side', 'Unlock your artistic potential with our immersive art workshops led by renowned artists. From painting to sculpture, our classes provide a supportive environment for individuals of all skill levels to nurture their creativity and express themselves through art.', "Are you ready to embark on a transformative artistic journey? Join our art workshop and discover the depths of your creativity in a nurturing and inspiring environment.\n\nLed by renowned artists in the industry, our workshops offer a wide range of artistic mediums to explore. Whether you have prior experience or are a complete beginner, our classes are designed to cater to individuals of all skill levels.\n\nThrough hands-on guidance and personalized instruction, you will learn various techniques and develop your artistic skills. From painting vibrant landscapes to sculpting intricate forms, our workshops will unlock your potential and help you express your unique artistic voice.\n", NOW(), 0, 0, 0, NULL, 0, 5, 5);

INSERT INTO dbProj_ARTICLE (articleID, title, description, content, publishDate, views, likes, dislikes, rating, isPublished, userID, catID)
VALUES (NULL, 'Revamp Your Home: Discover Our Stylish and Functional Furniture Collection', 'Transform your living spaces with our exquisite furniture collection, carefully curated to elevate both style and functionality. From modern minimalist designs to timeless classics, our range offers something for every taste, enabling you to create the home of your dreams.', "Are you looking to give your home a fresh new look? Our stylish and functional furniture collection is here to help you revamp your living spaces.\n\nWe understand that furniture plays a vital role in creating a comfortable and aesthetically pleasing environment. That's why we have curated a diverse range of pieces that combine both style and functionality.\n\nFrom sleek and modern designs to elegant and timeless classics, our furniture collection caters to every taste and interior style. Whether you prefer a minimalist aesthetic or a more eclectic vibe, you'll find pieces that perfectly complement your vision.\n", NOW(), 0, 0, 0, NULL, 0, 6, 5);


INSERT INTO dbProj_ARTICLE (articleID, title, description, content, publishDate, views, likes, dislikes, rating, isPublished, userID, catID)
VALUES (NULL, 'A Riveting Thrill Ride: Movie Review of ''Edge of Darkness''', 'In this gripping suspense thriller, ''Edge of Darkness'' takes audiences on a rollercoaster of emotions with its unpredictable twists and stellar performances. With a captivating storyline and masterful direction, this film keeps viewers on the edge of their seats from start to finish.', "Get ready for a riveting cinematic experience with ''Edge of Darkness,'' the latest suspense thriller that will leave you breathless.\n\nThis gripping film takes audiences on a thrilling rollercoaster ride of emotions, with its unpredictable twists and turns. From the opening scene to the final moments, ''Edge of Darkness'' keeps viewers on the edge of their seats, eagerly anticipating what will happen next.\n\nOne of the film's greatest strengths is its outstanding performances. The talented cast delivers stellar acting, immersing the audience in the characters' struggles and triumphs. The chemistry between the actors is palpable, adding depth and authenticity to the story.\n", NOW(), 0, 0, 0, NULL, 0, 4, 6);

INSERT INTO dbProj_ARTICLE (articleID, title, description, content, publishDate, views, likes, dislikes, rating, isPublished, userID, catID)
VALUES (NULL, 'Heartwarming and Inspirational: Movie Review of ''The Power of Dreams''', '''The Power of Dreams'' is a touching tale that reminds us of the indomitable spirit of the human soul. With its heartfelt storytelling, brilliant cinematography, and remarkable performances, this film captures the essence of hope, resilience, and the pursuit of one''s dreams.', "Experience the magic of ''The Power of Dreams,'' a truly inspiring film that will leave you uplifted and motivated.\n\nThis heartwarming story takes viewers on a journey of self-discovery and the power of belief. Through its poignant storytelling, the film reminds us of the strength of the human spirit and the ability to overcome obstacles.\n\nThe exceptional cinematography adds an extra layer of depth to the film, capturing the emotions and intricacies of the characters' experiences. Each frame is beautifully crafted, immersing the audience in the visual splendor of the story.\n", NOW(), 0, 0, 0, NULL, 0, 5, 6);

INSERT INTO dbProj_ARTICLE (articleID, title, description, content, publishDate, views, likes, dislikes, rating, isPublished, userID, catID)
VALUES (NULL, 'Visually Stunning and Epic: Movie Review of ''Legend of the Lost Kingdom''', 'Prepare to be transported to a fantastical world with ''Legend of the Lost Kingdom.'' This visually stunning adventure film immerses audiences in breathtaking landscapes, jaw-dropping special effects, and an enthralling narrative. With a stellar ensemble cast and impeccable production, it''s a must-watch for fantasy enthusiasts.', "Embark on an extraordinary journey with ''Legend of the Lost Kingdom,'' a movie that will captivate your senses and transport you to a realm of imagination and wonder.\n\nThe film showcases breathtaking landscapes that will leave you in awe. From lush green forests to towering mountains and mystical realms, every scene is a visual treat.\n\nThe special effects in the movie are nothing short of spectacular. Be prepared to witness mind-blowing visuals, magical creatures, and thrilling action sequences that will keep you on the edge of your seat.\n", NOW(), 0, 0, 0, NULL, 0, 6, 6);


INSERT INTO dbProj_COMMENT (commentID, commentText, creationDate, userID, articleID) VALUES (NULL, "I just booked my dream vacation after reading this article! Can't wait to experience the ultimate adventure!", NOW(), 1, 1);

INSERT INTO dbProj_COMMENT (commentID, commentText, creationDate, userID, articleID) VALUES (NULL, "This article convinced me to finally plan my dream vacation. The excitement is overwhelming!", NOW(), 2, 1);

INSERT INTO dbProj_COMMENT (commentID, commentText, creationDate, userID, articleID) VALUES (NULL, "The article provided some great insights and recommendations for planning a dream vacation. I'm definitely going to book one soon!", NOW(), 3, 1);

INSERT INTO dbProj_COMMENT (commentID, commentText, creationDate, userID, articleID)
VALUES
    (NULL, 'It''s disheartening to witness the escalating tensions in the Middle East. Diplomatic solutions are crucial in order to prevent further violence and promote peace in the region.', NOW(), 1, 2),
    (NULL, 'The international community must come together to prioritize diplomacy and dialogue in resolving the conflicts in the Middle East. War and aggression only lead to more suffering and instability.', NOW(), 2, 2),
    (NULL, 'As tensions rise in the Middle East, it is imperative that all parties involved engage in meaningful discussions to find peaceful resolutions. Diplomacy is the key to avoiding a catastrophic escalation of conflicts.', NOW(), 3, 2);

INSERT INTO dbProj_COMMENT (commentID, commentText, creationDate, userID, articleID)
VALUES
    (NULL, 'The Paris Agreement has played a crucial role in uniting countries in the fight against climate change. It''s inspiring to see global efforts being made to protect our planet and secure a sustainable future for generations to come.', NOW(), 1, 3),
    (NULL, 'Climate change is a pressing issue that requires immediate action. The milestones achieved through the Paris Agreement demonstrate the commitment of nations towards reducing greenhouse gas emissions and transitioning to cleaner energy sources.', NOW(), 2, 3),
    (NULL, 'The Paris Agreement is a significant step forward in addressing climate change on a global scale. It''s vital that countries continue to work together and implement effective strategies to meet the agreed-upon targets and mitigate the impact of climate change.', NOW(), 3, 3);

INSERT INTO dbProj_COMMENT (commentID, commentText, creationDate, userID, articleID)
VALUES
    (NULL, 'It''s heartwarming to see our community united for a good cause during the annual charity drive. Together, we can make a significant impact and bring hope to those in need.', NOW(), 1, 4),
    (NULL, 'The annual charity drive is a testament to the generosity and compassion of our community. It''s inspiring to witness everyone coming together to support important causes and make a difference in the lives of others.', NOW(), 2, 4),
    (NULL, 'The community''s dedication to the annual charity drive is truly admirable. By working together, we can address various social issues and uplift the lives of individuals and families who require our support.', NOW(), 3, 4);

INSERT INTO dbProj_COMMENT (commentID, commentText, creationDate, userID, articleID)
VALUES
    (NULL, 'The opening of the new cultural center is an exciting milestone for our community. It provides a platform to showcase and celebrate our rich local arts and heritage. I can''t wait to explore the diverse range of artistic expressions in this vibrant space.', NOW(), 1, 5),
    (NULL, 'The new cultural center is a testament to our commitment to preserving and promoting our local heritage. It will serve as a hub for cultural exchange and education, fostering a deeper appreciation for our traditions and history among both residents and visitors.', NOW(), 2, 5),
    (NULL, 'The opening of the cultural center is a game-changer for local artists. It offers a dedicated space for creativity to thrive and encourages collaboration among artists of various disciplines. I''m thrilled to witness the growth of our artistic community through this incredible initiative.', NOW(), 3, 5);

INSERT INTO dbProj_COMMENT (commentID, commentText, creationDate, userID, articleID)
VALUES
    (NULL, 'Congratulations to the local high school robotics team on their impressive victory! Their hard work, dedication, and innovation have paid off. This win not only showcases their technical skills but also highlights the importance of STEM education in preparing future leaders.', NOW(), 1, 6),
    (NULL, 'As a proud parent, I couldn''t be happier for the high school robotics team. Their success in the competition is a testament to their teamwork and problem-solving abilities. It''s inspiring to see young minds excel in the field of robotics.', NOW(), 2, 6),
    (NULL, 'The local high school robotics team''s triumph is a significant achievement. It demonstrates the power of combining creativity and technology to overcome challenges. Kudos to the team for their exceptional performance and for inspiring other students to explore the world of robotics.', NOW(), 3, 6);

INSERT INTO dbProj_COMMENT (commentID, commentText, creationDate, userID, articleID)
VALUES
    (NULL, 'What an incredible achievement! This historic victory by the tennis star in the Grand Slam is a testament to their exceptional skill, hard work, and dedication. They have etched their name in the annals of tennis history.', NOW(), 1, 7),
    (NULL, 'This is a momentous win for the tennis star. Their triumph in the Grand Slam showcases their talent and mental fortitude. They have made their mark in the sport and inspired aspiring athletes around the world.', NOW(), 2, 7),
    (NULL, 'The tennis star''s historic victory in the Grand Slam is awe-inspiring. Their relentless pursuit of excellence and unwavering determination have paid off. This win will be remembered as a milestone in their career.', NOW(), 3, 7);


INSERT INTO dbProj_COMMENT (commentID, commentText, creationDate, userID, articleID)
VALUES
    (NULL, "Wow! What an astonishing performance by the athlete. Shattering a long-standing world record is no small feat and is a testament to their incredible talent and determination. This achievement will be remembered for years to come.", NOW(), 1, 8),
    (NULL, "This is a truly remarkable accomplishment by the athlete. Breaking a long-standing world record is a milestone in their career and showcases their exceptional skill and dedication. They have set a new standard of excellence in their sport.", NOW(), 2, 8),
    (NULL, "The athlete's record-breaking performance is simply phenomenal. They have pushed the boundaries of what was thought to be possible and proven that with hard work and perseverance, anything can be achieved. This moment will go down in history.", NOW(), 3, 8);


INSERT INTO dbProj_COMMENT (commentID, commentText, creationDate, userID, articleID)
VALUES
    (NULL, "The art exhibition is truly inspiring and thought-provoking. It showcases the power of art to evoke emotions, spark conversations, and ignite creativity. It's a wonderful opportunity for the community to come together and appreciate the beauty of various art forms.", NOW(), 1, 9),
    (NULL, "I am captivated by the art exhibition's ability to stimulate imagination and encourage dialogue. Each artwork tells a unique story and invites viewers to interpret it in their own way. It's a great platform for artists to express their perspectives and connect with the audience.", NOW(), 2, 9),
    (NULL, "The art exhibition is a testament to the transformative power of art. It has the ability to transcend boundaries and bridge cultures. It's inspiring to see how artists use their creativity to address important social issues and inspire change. This exhibition is a must-visit for art enthusiasts.", NOW(), 3, 9);

INSERT INTO dbProj_COMMENT (commentID, commentText, creationDate, userID, articleID)
VALUES
    (NULL, "The severe storm warning serves as a reminder to prioritize safety and preparedness. It's crucial to have emergency plans in place and stock up on essential supplies. Stay informed, heed the warnings, and take necessary precautions to protect yourself and your loved ones.", NOW(), 1, 10),
    (NULL, "Extreme weather conditions require us to be vigilant and proactive. It's important to stay updated with the latest information from reliable sources. Take steps to secure your property, create an emergency kit, and have a communication plan. Let's prioritize safety and support one another during challenging times.", NOW(), 2, 10),
    (NULL, "The article on severe storm warning highlights the importance of being prepared. It's essential to take these warnings seriously and have a well-thought-out plan. Stay safe by staying indoors, monitoring the weather updates, and following the guidelines provided by local authorities. Let's ensure the safety of ourselves and our communities.", NOW(), 3, 10);

INSERT INTO dbProj_COMMENT (commentID, commentText, creationDate, userID, articleID)
VALUES
    (NULL, "The heatwave has made it crucial to prioritize staying cool and hydrated. Remember to drink plenty of water, stay in shaded areas, and avoid prolonged exposure to the sun. Let's take care of ourselves and each other during this hot weather.", NOW(), 1, 11),
    (NULL, "The article provides valuable tips for coping with the heatwave. It's important to stay indoors during the hottest hours of the day, use fans or air conditioning, and wear lightweight, breathable clothing. Let's beat the heat together!", NOW(), 2, 11),
    (NULL, "During this heatwave, it's essential to take necessary precautions to protect our health. Stay cool by seeking air-conditioned spaces, using sunscreen, and checking on vulnerable individuals. Let's stay safe and beat the heatwave with smart choices.", NOW(), 3, 11);

INSERT INTO dbProj_COMMENT (commentID, commentText, creationDate, userID, articleID)
VALUES
    (NULL, "The arrival of spring brings a sense of renewal and rejuvenation. It's a beautiful season to embrace nature's blossoming and enjoy outdoor activities. Let's welcome spring with open arms and cherish the vibrant energy it brings.", NOW(), 1, 12),
    (NULL, "Spring is a magical time of the year, filled with blooming flowers, mild weather, and new beginnings. It's a great opportunity to engage in gardening, explore scenic landscapes, and appreciate the beauty of nature. Let's make the most of this enchanting season!", NOW(), 2, 12),
    (NULL, "Spring symbolizes a fresh start and a time of growth. It's a wonderful season to embrace positivity, embark on new adventures, and spend time with loved ones outdoors. Let's embrace the seasonal shift and relish in the joys that spring brings.", NOW(), 3, 12);


INSERT INTO dbProj_COMMENT (commentID, commentText, creationDate, userID, articleID)
VALUES
    (NULL, "The article has ignited my wanderlust! Booking a dream vacation is the perfect way to embark on an ultimate adventure and create lifelong memories. It's time to make those travel plans and explore the world!", NOW(), 1, 13),
    (NULL, "The idea of experiencing the ultimate adventure through a dream vacation is truly exciting. It's a chance to step out of our comfort zones, immerse ourselves in new cultures, and discover breathtaking destinations. Let's make our travel dreams a reality!", NOW(), 2, 13),
    (NULL, "Booking a dream vacation is the gateway to an extraordinary experience. It allows us to escape the ordinary and indulge in thrilling adventures, relax in idyllic locations, and connect with different cultures. It's time to embark on an unforgettable journey!", NOW(), 3, 13);

INSERT INTO dbProj_COMMENT (commentID, commentText, creationDate, userID, articleID)
VALUES
    (NULL, "Joining the art workshop is a fantastic opportunity to unleash our creativity and explore our artistic side. It's a platform to learn new techniques, express ourselves, and connect with fellow art enthusiasts. Let's embark on this artistic journey together!", NOW(), 1, 14),
    (NULL, "The art workshop sounds like an incredible experience to nurture our creativity. It's a chance to discover new mediums, experiment with different styles, and grow as artists. Let's seize this opportunity to explore our artistic potential!", NOW(), 2, 14),
    (NULL, "The article on the art workshop is inspiring! It's an invitation to tap into our creative abilities and express ourselves through art. Let's join this enriching workshop, learn from talented instructors, and unlock our artistic potential. Get ready for a fulfilling artistic journey!", NOW(), 3, 14);

INSERT INTO dbProj_COMMENT (commentID, commentText, creationDate, userID, articleID)
VALUES
    (NULL, "The furniture collection showcased in the article is truly stunning! It offers a perfect blend of style and functionality to revamp our homes. Let's explore these options and create a space that reflects our unique taste and meets our practical needs.", NOW(), 1, 15),
    (NULL, "Discovering the stylish and functional furniture collection is exciting! It's an opportunity to transform our homes into beautiful and comfortable spaces. Let's dive into the world of interior design and elevate our living environments.", NOW(), 2, 15),
    (NULL, "The article on the furniture collection has caught my attention. It's time to revamp our homes with pieces that not only enhance aesthetics but also serve practical purposes. Let's explore this collection and create a living space that's both stylish and functional!", NOW(), 3, 15);

INSERT INTO dbProj_COMMENT (commentID, commentText, creationDate, userID, articleID)
VALUES
    (NULL, "The movie 'Edge of Darkness' was a thrilling rollercoaster ride from start to finish. The gripping plot, intense performances, and suspenseful moments kept me on the edge of my seat. It's a must-watch for all fans of the thriller genre!", NOW(), 1, 16),
    (NULL, "I thoroughly enjoyed watching 'Edge of Darkness'! The movie had a captivating storyline, excellent cinematography, and a stellar cast. The suspense and twists kept me guessing until the very end. Highly recommend it to all movie enthusiasts!", NOW(), 2, 16),
    (NULL, "The movie review of 'Edge of Darkness' has piqued my interest. I can't wait to experience the riveting thrill ride it promises. This action-packed film seems like a perfect choice for a movie night filled with suspense and excitement!", NOW(), 3, 16);

INSERT INTO dbProj_COMMENT (commentID, commentText, creationDate, userID, articleID)
VALUES (NULL, "What a truly beautiful and uplifting film! 'The Power of Dreams' touched my heart and reminded me of the strength of the human spirit. Highly recommended for anyone in need of inspiration.", NOW(), 1, 17),
       (NULL, "I was deeply moved by 'The Power of Dreams.' This movie beautifully captures the essence of hope and determination. The characters and their journeys stayed with me long after the credits rolled. A must-watch for all!", NOW(), 2, 17),
       (NULL, "I can't express how much 'The Power of Dreams' resonated with me. It's a powerful reminder that dreams have the ability to transform lives. This film is a testament to the importance of perseverance and the pursuit of one's passions.", NOW(), 3, 17);

INSERT INTO dbProj_COMMENT (commentID, commentText, creationDate, userID, articleID)
VALUES (NULL, "This movie left me feeling inspired and uplifted. 'The Power of Dreams' beautifully showcases the triumph of the human spirit. A must-see for anyone in search of motivation.", NOW(), 1, 18),
       (NULL, "I was moved to tears by 'The Power of Dreams.' The heartfelt performances and powerful storytelling touched my soul. It's a reminder that dreams have the power to change lives.", NOW(), 2, 18),
       (NULL, "What an incredible film! 'The Power of Dreams' captures the essence of hope and perseverance. It reminds us to never give up on our aspirations. Truly a masterpiece.", NOW(), 3, 18);


