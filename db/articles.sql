SET foreign_key_checks = 0;

DROP TABLE IF EXISTS `articles`;

CREATE TABLE `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `excerpt` mediumtext DEFAULT NULL,
  `content` mediumtext DEFAULT NULL,
  `meta_description` varchar(160) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `slug` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `articles`
--

LOCK TABLES `articles` WRITE;

INSERT INTO `articles` VALUES (1,'Understanding Proverbs','A deep dive into the wisdom literature of the Bible.','<p>Proverbs teaches us to live wisely and fear the Lord, emphasizing the foundational principle that wisdom and reverence for God are key to leading a life that is fulfilling, righteous, and aligned with God\'s purpose. The book of Proverbs is filled with practical advice, warnings, and exhortations that guide us in our daily choices and relationships, helping us navigate the complexities of life in a way that honors God. One of the core messages of Proverbs is that true wisdom begins with the fear of the Lord—recognizing His sovereignty, holiness, and authority over all creation.</p><p>In Proverbs 1:7, it is written, \"The fear of the Lord is the beginning of knowledge, but fools despise wisdom and instruction.\" This verse highlights that the foundation of wisdom is not merely intellectual understanding or human experience, but a deep reverence and awe for God. To fear the Lord is to acknowledge His greatness and to live with a sense of humility before Him. It is not a fear of terror, but a respectful awe that leads to obedience, trust, and a desire to live according to God\'s will. In doing so, we gain true understanding and insight into the ways of God and the world around us.</p><p>Proverbs also teaches that wisdom is more than just knowledge; it is the application of that knowledge in ways that reflect God\'s character. The wise person is one who makes choices that align with God\'s values, showing discernment, justice, kindness, and integrity in their interactions with others. In Proverbs 2:6, it says, \"For the Lord gives wisdom; from His mouth come knowledge and understanding.\" This reminds us that wisdom is a gift from God, and we are called to seek it diligently through His Word and through prayer, trusting that He will guide us in all things.</p><p>The book also highlights the contrast between wisdom and folly, urging us to choose the path of wisdom, which leads to life, peace, and prosperity, rather than the way of folly, which leads to destruction. Proverbs 3:5-6 offers a beautiful exhortation: \"Trust in the Lord with all your heart and lean not on your own understanding; in all your ways submit to Him, and He will make your paths straight.\" This teaches us that wisdom is not always about relying on our own intellect or reasoning but about trusting in God\'s guidance and submitting to His will. By doing so, we can avoid the pitfalls of self-reliance and foolishness.</p><p>Moreover, Proverbs teaches that wisdom is essential for healthy relationships and a well-lived life. It instructs us to be careful with our words, to be slow to anger, to seek peace, and to work hard with integrity. Proverbs 15:1 says, \"A gentle answer turns away wrath, but a harsh word stirs up anger.\" This wisdom helps build harmonious relationships and promotes a spirit of love and understanding in our homes, workplaces, and communities.</p><p>The fear of the Lord, according to Proverbs, is also linked to the blessings of God. Proverbs 10:27 states, \"The fear of the Lord adds length to life, but the years of the wicked are cut short.\" This highlights the practical benefits of living in reverence to God, where we align our lives with His eternal purposes. It is not just about avoiding evil, but also about positioning ourselves to receive God\'s favor, protection, and guidance.</p><p>In conclusion, Proverbs calls us to live wisely by fearing the Lord, recognizing His authority, and seeking His wisdom above all else. This wisdom transforms how we live, how we relate to others, and how we walk through life. It is not simply about acquiring knowledge, but about living in a way that honors God and reflects His love, justice, and truth. Through wisdom and the fear of the Lord, we are equipped to navigate life\'s challenges and experience the peace, joy, and fulfillment that come from living in alignment with God\'s will.</p>','','2025-02-12 00:00:00','understanding-proverbs'),(2,'What Jesus Said About Faith','Exploring Christ\'s teachings on belief and trust.','<p>Jesus emphasized the importance of faith in God for miracles to happen, repeatedly teaching His followers that faith plays a crucial role in experiencing God\'s power and intervention. In the Gospels, we see that Jesus often healed people or performed miracles not just because of His divine power, but also because of their faith in Him. For example, in Matthew 17:20, Jesus tells His disciples, \"If you have faith as small as a mustard seed, you can say to this mountain, ‘Move from here to there,’ and it will move. Nothing will be impossible for you.\" This statement highlights the transformative power of even a small amount of genuine faith.</p><p>In several healing stories, such as the woman who touched Jesus\' garment (Matthew 9:20-22), Jesus acknowledges the faith of those seeking healing, telling them, \"Your faith has healed you.\" This demonstrates that faith is not merely an abstract belief but an active trust that aligns the individual with God\'s will, enabling them to receive miracles. It is through faith that individuals open their hearts to the possibility of the miraculous and invite God to work in their lives.</p><p>Furthermore, Jesus also pointed out the connection between faith and salvation. In John 14:12, He promised His followers that anyone who believes in Him will do the works He has been doing, and even greater things will be done in His name. This shows that faith in Jesus is the key to receiving the power of the Holy Spirit and performing miraculous acts that align with God\'s purpose.</p><p>However, Jesus also warned that without faith, miracles would not happen. In Nazareth, for instance, He could not perform many miracles because of the people\'s lack of faith (Matthew 13:58). This reinforces the idea that God’s power operates in partnership with human faith. The miracles of Jesus were not only signs of His divine identity but also invitations to deepen one\'s trust in God\'s ability to do the impossible.</p><p>Ultimately, Jesus taught that faith is foundational not only for receiving miracles but also for maintaining a strong relationship with God. Faith transforms hearts, allowing individuals to experience the fullness of God’s power and presence in their lives, whether in times of personal need or in their spiritual walk with Christ. By emphasizing faith, Jesus called His followers to trust in God\'s limitless power and to believe that with God, all things are possible.</p>','','2025-02-12 00:00:00','what-jesus-said-about-faith'),(3,'End Times Prophecies','Examining key prophecies about the last days.','<p>The Bible speaks about the signs of the end times, which include various natural disasters, wars, and widespread turmoil. In the New Testament, particularly in the Gospel of Matthew, Jesus outlines many of these signs in what is commonly known as the Olivet Discourse (Matthew 24). He warns that in the last days, there will be wars, rumors of wars, famines, and earthquakes. These events are not to be taken as specific predictions of dates or times but as indicators of a world in distress, pointing toward the fulfillment of God\'s ultimate plan. The natural disasters, such as earthquakes and storms, are not just random occurrences but are seen as part of a divine narrative, meant to alert believers to the coming of God\'s kingdom.</p><p>In addition to natural disasters, the Bible also speaks about the moral and spiritual condition of the world as a sign of the end times. People will become more selfish, greedy, and disobedient, and there will be an increase in lawlessness. In 2 Timothy 3:1-5, the apostle Paul describes how people will be \"lovers of themselves\" and \"lovers of money,\" highlighting a decline in moral values. This moral decay is often seen as another sign of the approaching return of Christ.</p><p>The most important and central sign of the end times, according to Christian belief, is the return of Jesus Christ. Christians believe that Jesus will come again in glory to judge the living and the dead, as stated in the Nicene Creed. This event is referred to as the \"Second Coming.\" Before this return, many Christians believe there will be a time of tribulation, a period of great suffering and trials, during which the faithful are called to remain vigilant and steadfast in their faith. The return of Christ will mark the end of human history as we know it, and the beginning of God\'s eternal kingdom.</p><p>While the Bible gives us these signs, it also reminds us that no one knows the exact time or hour of Christ\'s return, as it is ultimately in God\'s hands. In Matthew 24:36, Jesus says, \"But about that day or hour no one knows, not even the angels in heaven, nor the Son, but only the Father.\" This encourages believers to live with a sense of readiness and anticipation, always prepared for the coming of Christ, while continuing to love and serve others in the meantime.</p><p>In sum, the Bible describes the signs of the end times in a way that emphasizes the need for spiritual readiness and trust in God\'s sovereignty. Believers are called to watch for these signs and live their lives in anticipation of Christ\'s return, while maintaining a deep faith in God\'s promises, knowing that He will bring justice, peace, and restoration in the end.</p>','','2025-02-12 00:00:00','end-times-prophecies'),(43,'The Power of Faith in Christian Life','With God, all things are possible.','<p><strong>Introduction:</strong> Faith is central to the Christian life. Throughout the Bible, faith is described as the key to a relationship with God and a gateway to spiritual growth. It’s not merely a mental agreement but a deep trust in God’s promises, His character, and His work in our lives.</p><p><strong>The Role of Faith:</strong> In Hebrews 11, often called the \"Hall of Faith,\" we see numerous examples of individuals whose lives were shaped by faith. From Abraham, who trusted God even when asked to sacrifice his son, to Noah, who built an ark despite not seeing any sign of rain, faith in God led them to take bold actions.</p><p>Jesus Himself frequently emphasized faith as a foundation for miracles. In Mark 9:23, He says, “Everything is possible for one who believes.” This powerful statement reveals the transformative power of faith in a believer\'s life.</p><p><strong>Faith and Salvation:</strong> Christianity teaches that faith is the means by which we receive salvation. Ephesians 2:8-9 states, \"For it is by grace you have been saved, through faith—and this is not from yourselves, it is the gift of God—not by works, so that no one can boast.\" Faith opens the door to the grace of God, making salvation available to all who believe.</p><p><strong>Living Out Faith:</strong> Faith is not just about belief but also action. James 2:26 reminds us, \"Faith without works is dead.\" True faith compels believers to act according to God’s will, whether it’s through helping others, spreading the gospel, or living a life of integrity and love. The power of faith is not only in what we believe but in how we live out those beliefs.</p><p><strong>Conclusion:</strong> The power of faith in Christian life cannot be overstated. It enables believers to endure hardships, experience God’s miracles, and live in the light of His promises. By holding firm to faith, Christians are called to be a reflection of Christ’s love in the world, trusting that, with God, all things are possible.</p>','Explore the transformative power of faith in Christianity, understanding its role in salvation, spiritual growth, and how it shapes the lives of believers.','2025-02-24 00:00:00','the-power-of-faith-in-christian-life');

UNLOCK TABLES;

--
-- Table structure for table `bible_notes`
--

DROP TABLE IF EXISTS `bible_notes`;

CREATE TABLE `bible_notes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `bible_reference` varchar(50) DEFAULT NULL,
  `note` varchar(500) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `bible_notes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bible_notes`
--

LOCK TABLES `bible_notes` WRITE;

UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(20) DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;

UNLOCK TABLES;

SET foreign_key_checks = 1;
