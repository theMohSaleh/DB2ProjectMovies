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
    `content` varchar(500),
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
);

CREATE OR REPLACE TABLE `dbProj_COMMENT` (
    `commentID` int NOT NULL AUTO_INCREMENT,
    `commentText` varchar(300),
    `creationDate` datetime,
    `userID` int,
    `articleID` int,
    PRIMARY KEY (`commentID`),
    FOREIGN KEY (`userID`) REFERENCES `dbProj_USER`(`userID`),
    FOREIGN KEY (`articleID`) REFERENCES `dbProj_ARTICLE`(`articleID`)
);

CREATE OR REPLACE TABLE `dbProj_FILES`(
    `fileID` int(11) NOT NULL AUTO_INCREMENT,
    `fileName` int(11) NOT NULL,
    `fileType` varchar(30),
    `filelocation` varchar(30),
    `articleID` int NOT NULL,
    PRIMARY KEY (`fileID`),
    FOREIGN KEY (`articleID`) REFERENCES `dbProj_ARTICLE`(`articleID`)
);


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


INSERT INTO dbProj_ARTICLE (articleID, title, content, publishDate, views, likes, dislikes, rating, isPublished, userID, catID)
VALUES (NULL, 'World Leaders Gather at G7 Summit to Address Global Challenges', 'Leaders from the world''s most powerful economies convened at the G7 Summit to discuss pressing issues such as climate change, pandemic recovery, and economic cooperation. The summit resulted in agreements to promote sustainable development, strengthen healthcare systems, and enhance international cooperation on various fronts.', NOW(), 0, 0, 0, NULL, 1, 4, 1);

INSERT INTO dbProj_ARTICLE (articleID, title, content, publishDate, views, likes, dislikes, rating, isPublished, userID, catID)
VALUES (NULL, 'Tensions Escalate in Middle East: International Community Urges Diplomatic Solutions', 'Rising tensions in the Middle East have raised concerns among the international community. Leaders and diplomats are advocating for dialogue and peaceful resolutions to prevent further escalation of conflicts and maintain stability in the region.', NOW(), 0, 0, 0, NULL, 1, 5, 1);

INSERT INTO dbProj_ARTICLE (articleID, title, content, publishDate, views, likes, dislikes, rating, isPublished, userID, catID)
VALUES (NULL, 'Global Efforts to Combat Climate Change: Paris Agreement Milestones', 'Countries worldwide are stepping up their commitments to combat climate change. Recent milestones include renewable energy targets, carbon neutrality pledges, and increased investment in sustainable infrastructure. These actions reflect a growing global consensus on the urgent need for collective action to protect our planet.', NOW(), 0, 0, 0, NULL, 1, 6, 1);



INSERT INTO dbProj_ARTICLE (articleID, title, content, publishDate, views, likes, dislikes, rating, isPublished, userID, catID)
VALUES (NULL, 'Community Comes Together for Annual Charity Drive', 'Local residents rallied together for the annual charity drive, raising funds and donating essential items to support underprivileged members of the community. The event showcased the power of unity and compassion in creating a positive impact at the local level.', NOW(), 0, 0, 0, NULL, 0, 4, 2);

INSERT INTO dbProj_ARTICLE (articleID, title, content, publishDate, views, likes, dislikes, rating, isPublished, userID, catID)
VALUES (NULL, 'New Cultural Center Opens: Celebrating Local Arts and Heritage', 'A new cultural center has opened its doors, providing a platform for local artists, musicians, and performers to showcase their talent. The center aims to promote and preserve the rich cultural heritage of the community while fostering a vibrant arts scene.', NOW(), 0, 0, 0, NULL, 5, 5, 2);

INSERT INTO dbProj_ARTICLE (articleID, title, content, publishDate, views, likes, dislikes, rating, isPublished, userID, catID)
VALUES (NULL, 'Local High School Wins Robotics Competition', 'A local high school''s robotics team emerged victorious at a prestigious regional competition, showcasing their innovation and technical expertise. The students'' hard work and dedication paid off, earning recognition for their school and inspiring future generations of aspiring engineers and scientists.', NOW(), 0, 0, 0, NULL, 0, 6, 2);



INSERT INTO dbProj_ARTICLE (articleID, title, content, publishDate, views, likes, dislikes, rating, isPublished, userID, catID)
VALUES (NULL, 'Grand Slam Triumph: Tennis Star Claims Historic Victory', 'In a thrilling match, a tennis superstar secured a historic Grand Slam title, solidifying their place among the all-time greats in the sport. The victory is a testament to their skill, determination, and unwavering focus on achieving excellence.', NOW(), 0, 0, 0, NULL, 0, 4, 3);

INSERT INTO dbProj_ARTICLE (articleID, title, content, publishDate, views, likes, dislikes, rating, isPublished, userID, catID)
VALUES (NULL, 'Record-Breaking Performance: Athlete Shatters Long-Standing World Record', 'An exceptional athlete broke a long-standing world record, leaving spectators awe-struck by their incredible feat. Their achievement not only showcases their exceptional talent but also sets a new benchmark for future generations of athletes to aspire to.', NOW(), 0, 0, 0, NULL, 0, 5, 3);

INSERT INTO dbProj_ARTICLE (articleID, title, content, publishDate, views, likes, dislikes, rating, isPublished, userID, catID)
VALUES (NULL, 'Art Exhibition Inspires Creativity and Conversation', 'A thought-provoking art exhibition captivated audiences with its innovative and meaningful artworks. The exhibition served as a platform for artists to express their perspectives on contemporary issues, sparking engaging discussions and fostering a deeper appreciation for the power of art.', NOW(), 0, 0, 0, NULL, 0, 6, 3);


INSERT INTO dbProj_ARTICLE (articleID, title, content, publishDate, views, likes, dislikes, rating, isPublished, userID, catID)
VALUES (NULL, 'Severe Storm Warning: Preparing for Extreme Weather Conditions', 'Meteorologists have issued a severe storm warning, urging residents to take necessary precautions to ensure their safety. With strong winds and heavy rainfall expected, it is essential to stay informed and prepared for potential disruptions to daily life.', NOW(), 0, 0, 0, NULL, 0, 4, 4);

INSERT INTO dbProj_ARTICLE (articleID, title, content, publishDate, views, likes, dislikes, rating, isPublished, userID, catID)
VALUES (NULL, 'Heatwave Grips the Region: Tips for Staying Cool', 'As temperatures soar, a heatwave has engulfed the region, posing health risks for vulnerable individuals. The article provides helpful tips on staying cool, staying hydrated, and recognizing the signs of heat-related illnesses to ensure the well-being of the community.', NOW(), 0, 0, 0, NULL, 0, 5, 4);

INSERT INTO dbProj_ARTICLE (articleID, title, content, publishDate, views, likes, dislikes, rating, isPublished, userID, catID)
VALUES (NULL, 'Seasonal Shift: Embracing the Arrival of Spring', 'After a long winter, the arrival of spring brings a renewed sense of joy and vitality. From blooming flowers to longer daylight hours, the article highlights the positive impacts of the changing season and encourages readers to embrace the beauty of nature around them.', NOW(), 0, 0, 0, NULL, 0, 6, 4);


INSERT INTO dbProj_ARTICLE (articleID, title, content, publishDate, views, likes, dislikes, rating, isPublished, userID, catID)
VALUES (NULL, 'Experience the Ultimate Adventure: Book Your Dream Vacation Today!', 'Escape to paradise with our exclusive travel packages that offer unforgettable experiences and breathtaking landscapes. Whether you seek relaxation on pristine beaches or thrilling adventures in exotic destinations, our tailored vacations cater to all your desires.', NOW(), 0, 0, 0, NULL, 0, 4, 5);

INSERT INTO dbProj_ARTICLE (articleID, title, content, publishDate, views, likes, dislikes, rating, isPublished, userID, catID)
VALUES (NULL, 'Unleash Your Creativity: Join Our Art Workshop and Explore Your Artistic Side', 'Unlock your artistic potential with our immersive art workshops led by renowned artists. From painting to sculpture, our classes provide a supportive environment for individuals of all skill levels to nurture their creativity and express themselves through art.', NOW(), 0, 0, 0, NULL, 0, 5, 5);

INSERT INTO dbProj_ARTICLE (articleID, title, content, publishDate, views, likes, dislikes, rating, isPublished, userID, catID)
VALUES (NULL, 'Revamp Your Home: Discover Our Stylish and Functional Furniture Collection', 'Transform your living spaces with our exquisite furniture collection, carefully curated to elevate both style and functionality. From modern minimalist designs to timeless classics, our range offers something for every taste, enabling you to create the home of your dreams.', NOW(), 0, 0, 0, NULL, 0, 6, 5);


INSERT INTO dbProj_ARTICLE (articleID, title, content, publishDate, views, likes, dislikes, rating, isPublished, userID, catID)
VALUES (NULL, 'A Riveting Thrill Ride: Movie Review of ''Edge of Darkness''', 'In this gripping suspense thriller, ''Edge of Darkness'' takes audiences on a rollercoaster of emotions with its unpredictable twists and stellar performances. With a captivating storyline and masterful direction, this film keeps viewers on the edge of their seats from start to finish.', NOW(), 0, 0, 0, NULL, 0, 4, 6);

INSERT INTO dbProj_ARTICLE (articleID, title, content, publishDate, views, likes, dislikes, rating, isPublished, userID, catID)
VALUES (NULL, 'Heartwarming and Inspirational: Movie Review of ''The Power of Dreams''', '''The Power of Dreams'' is a touching tale that reminds us of the indomitable spirit of the human soul. With its heartfelt storytelling, brilliant cinematography, and remarkable performances, this film captures the essence of hope, resilience, and the pursuit of one''s dreams.', NOW(), 0, 0, 0, NULL, 0, 5, 6);

INSERT INTO dbProj_ARTICLE (articleID, title, content, publishDate, views, likes, dislikes, rating, isPublished, userID, catID)
VALUES (NULL, 'Visually Stunning and Epic: Movie Review of ''Legend of the Lost Kingdom''', 'Prepare to be transported to a fantastical world with ''Legend of the Lost Kingdom.'' This visually stunning adventure film immerses audiences in breathtaking landscapes, jaw-dropping special effects, and an enthralling narrative. With a stellar ensemble cast and impeccable production, it''s a must-watch for fantasy enthusiasts.', NOW(), 0, 0, 0, NULL, 0, 6, 6);
