SET search_path TO lbaw24105;

-----------------------------------------
-- USERS TABLE
-----------------------------------------

-- Anonymous Account
INSERT INTO users(first_name, last_name, username, email, password, profile_picture, is_admin)
VALUES
    ('John', 'Doe', 'johndoe', 'johndoe@lost.com', '$2y$10$70JFRa.wylskSh6qKhbhKeYmUW4cSlvMmw39FTKLTU.Qks5Ul3zv.', 'default.png', false); -- MysteriousMystery

-- Admin Accounts
INSERT INTO users(first_name, last_name, username, email, password, profile_picture, is_admin)
VALUES
    -- Demo Admin Account
    ('Linus', 'Torvalds', 'TuxCommander', 'linus@opensource.org', '$2y$10$K9kPHQBS5WmzNDHE5SBbMeTU6tBD79kSD.YPkzizjHh4w3pqUGOti', 'linus.jpg', true), -- KernelPanic!123
    -- Dev Team Accounts
    ('Afonso', 'Neves', 'ANeves', 'up202108884@up.pt', '$2y$10$pfYAIlSwza5FmEtG2ew/au2au31xcCkJ7S4MfF.TYUcKUyhrhH8dO', 'image.png', true), -- afonsoneves123
    ('Andre', 'Pinto', 'APinto', 'up202108856@up.pt', '$2y$10$20iHYeHXrA5kiwYmEmXiUuaUZAtbI5AjyZ1E8jnojBOEb3qkxPzd6', 'image.png', true), -- andrepinto123
    ('Beatriz', 'Oliveira', 'BOliveira', 'up202204353@up.pt', '$2y$10$WmvpTW4v4NI5bfhP7oNgU..ke4z2YuYle64U0tIcquzYC13gheoAi', 'image.png', true), -- beatrizoliveira123
    ('Victor', 'Velasco', 'VVelasco', 'up202401431@up.pt', '$2y$10$oPoXLydvoUT0TI0dbjGXs.7du6ufib4YtTEL9Zd08U0eeOkRdEpU2', 'image.png', true); -- victorvelasco123

-- Client Dummy Accounts
INSERT INTO users(first_name, last_name, username, email, password, is_admin)
VALUES
    -- Dummy Accounts
    ('Phyllys', 'Sweatland', 'psweatland60808', 'phyllys.sweatland@bellsouth.net', '$2b$10$CHBqTF7bJj0Y/WmmKHvjg.TeHlGnc1nSwqvjUHup1nlpx/mhH55Jy', false),
    ('Jena', 'Hush', 'jhush56742', 'jena.hush@hotmail.co.uk', '$2b$10$qc6xh/PU1VJb1c/3i2W.K.iSVN6FoIu4xmQTkGSUmFT3LCxWwIXpy', false),
    ('Sam', 'Beedon', 'sbeedon23501', 'sam.beedon@yahoo.com', '$2b$10$2hROvPoj7XlYa1TiD7Mq1Oj3YNT3PJgH5W5BcL6t/N6BIsb9pE2hS', false),
    ('Prissie', 'Novic', 'pnovic28758', 'prissie.novic@yahoo.com', '$2b$10$vIk3vr4yoG/vmwIiruTP0uQH0meLJcr7M6hHfdxB/K2hsuIY9/5eO', false),
    ('Lorrie', 'Bartolommeo', 'lbartolommeo12345', 'lorrie.bartolommeo@example.com', '$2b$10$yGOaL3jPEMRMJF2KQo37bOb0mbYzVdEG7mva7vgkQzvjzxDxui5K.', false),
    ('James', 'Carter', 'jcarter21', 'james.c4rter@gmail.com', '$2b$10$W/3mUMvsBZYDyjt273MoEuJy1TOPc.t7lWZ067O1vim1FvXfygNC2', false),
    ('Leroi', 'Naismith', 'lnaismith55963', 'leroi.naismith@gmail.com', '$2b$10$8scs2WZeg8.MP/wy.SR7pepkc16IyjR8ANd/KY2uIJF4LNnRSNryG', false),
    ('Skye', 'Tune', 'stune52338', 'skye.tune@hotmail.com', '$2b$10$RH7Pg2c30L9frp2kO/IdDO3AFiFJlLQLnKNBRBIQlM3wY2j5TfEka', false),
    ('Sheffield', 'Errington', 'serrington44687', 'sheffield.errington@hotmail.com', '$2b$10$OoNmWPaMGhbbrXRrXLKTyetSuvawhQUfpVLDBzlSCU0XV7px1/6sK', false),
    ('Obadias', 'Shortt', 'oshortt18768', 'obadias.shortt@yahoo.com', '$2b$10$J7lhcdj4L75J2E.pjpg3NutG9DNE.nB0sOUZiFXgYogByqQf5Dxdm', false);

-- Demo Client Accounts
INSERT INTO users(first_name, last_name, username, email, password, profile_picture, is_admin)
VALUES
    -- Demo Client Accounts
    ('Steve', 'Jobs', 'AppleTree', 'jobs@apple.com', '$2y$10$Sd3HXq1ETazuxYq7lr4oY.2OJhNtIH0n2R98uM1ioWVhfoau6rRUu', 'jobs.jpg', false), -- 1MoreThing...
    ('Elon', 'Musk', 'MusketeerX', 'elon@tesla.com', '$2y$10$2aNmjMiugiLSf7SLrkMK.OBBWRPhYr5wOpklo5.lrVcV1s.oaUSV2', 'elon.jpg', false), -- D0geC01nToDaMoon
    ('Bill', 'Gates', 'MacroGates', 'bill@microsoft.com', '$2y$10$qtx4mK4LtK/SdVKjVkdkr.mYPPYJZDnYC3byzddPECgP13KFNzLmW', 'bill.jpg', false), -- W1nd0ws98?NoThanks
    ('Mark', 'Zuckerberg', 'ZuckerBro', 'zucker@meta.com', '$2y$10$m7d1calZD.QZ1kEj6goPd.OQdfiov/4HJRv6zITJbk2qY3fTvqKqm', 'zucker.jpg', false); -- MetaVerse4Life$$

-- More Client Dummy Accounts
INSERT INTO users(first_name, last_name, username, email, password, is_admin)
VALUES
    -- More Dummy Accounts
    ('Iver', 'Lynn', 'ilynn42682', 'iver.lynn@yahoo.com', '$2b$10$ayT/y8zxuTJ9.UKNp7mDReLRhKfjzjIZObt536Pq4KdgjStN9kSoq', false),
    ('Arlena', 'Pomery', 'apomery42926', 'arlena.pomery@hotmail.fr', '$2b$10$2vKWBRYj6G9tyKMqJ.nzROA6dCJ4DEWcyHvy8Kk3VmcQSbU7YNzaS', false),
    ('Waylin', 'Grindell', 'wgrindell22206', 'waylin.grindell@yahoo.com', '$2b$10$f6RlG8KgaEUAdiCOHgZXkOf29MxQzxXAEBtqtK7hA7a1pbxNJM1.S', false),
    ('Branden', 'Fraser', 'bfraser27731', 'branden.fraser@hotmail.com', '$2b$10$VdAT.hhhepqiPLP45k9W/uhGrQGoh0tjKdHHxnNoYmJwoWgK5OhMm', false),
    ('Isidor', 'Johnsson', 'ijohnsson5327', 'isidor.johnsson@gmail.com', '$2b$10$HiXizS3MqYIVAv8Qd2..h.Q8DqXNPx9tEpUbql5DGtnX1LSK/b2Oa', false),
    ('Retha', 'Baudino', 'rbaudino58988', 'retha.baudino@gmail.com', '$2b$10$3N3qduK9HQaFGrwhb.GIu.3Vkxp5nVv.f9TasgYtUUx23STP/JrqK', false),
    ('Charmaine', 'Bircher', 'cbircher46633', 'charmaine.bircher@hotmail.com', '$2b$10$nz500sjM3Zo3n5i1iMsVpOI5/AXYhZtS/YfFw45TEQY0UPKpi5NeG', false),
    ('Bink', 'Cuardall', 'bcuardall4821', 'bink.cuardall@gmail.com', '$2b$10$rh6b1K1NmVWoeiq0RY.Mk.3zprY/Xjy/mq.wtzvdj6P0BfajcGAYG', false),
    ('Vinnie', 'Tejero', 'vtejero64434', 'vinnie.tejero@gmail.com', '$2b$10$dHkgY.6expfQ99khJ3LRUOjVy2GS6nfs2mEJNYZQd0HyBtfmE4EXe', false),
    ('Marielle', 'Leggatt', 'mleggatt9891', 'marielle.leggatt@yahoo.com.br', '$2b$10$cX4Fz4vKiOfXplfysabaLef46RN02KLo6PzvF2ixLrDPvDI/WMHGa', false);

-----------------------------------------
-- REST OF THE TABLES
-----------------------------------------

INSERT INTO categories(name, description)
VALUES
    ('Action', 'Fast-paced games focused on physical challenges, including combat and quick reflexes.'),
    ('Adventure', 'Games that involve exploration and puzzle-solving in an immersive narrative-driven environment.'),
    ('Role-Playing', 'Games where players assume the roles of characters in a fictional world, often with complex storylines and character development.'),
    ('Simulation', 'Games that mimic real-world activities or processes, offering realistic gameplay and environments.'),
    ('Strategy', 'Games that emphasize strategic thinking, resource management, and tactical decision-making.'),
    ('Sports', 'Games that simulate real-world sports, allowing players to compete in various athletic events.'),
    ('Puzzle', 'Games that involve solving puzzles or brain teasers, often focusing on logic and problem-solving.'),
    ('Multiplayer', 'Games that allow multiple players to interact and compete with each other in real-time.'),
    ('Horror', 'Games designed to create fear or anxiety, often featuring a dark, eerie atmosphere and suspenseful gameplay.'),
    ('Platformer', 'Games where players navigate characters across various platforms, often with jumping and timing challenges.'),
    ('Open World', 'Games set in expansive worlds with a high degree of freedom to explore, complete missions, and interact with the environment.'),
    ('Indie', 'Games developed by small independent studios, often with unique artistic styles and innovative gameplay mechanics.'),
    ('Racing', 'Games that focus on speed, control, and competition in various racing scenarios and tracks.'),
    ('Battle Royale', 'A genre where players fight to be the last one standing in a large, shrinking map with a variety of weapons and strategies.'),
    ('Fighting', 'Games that involve close combat between characters, often with a focus on moves, combos, and competitive play.'),
    ('Survival', 'Games where players must gather resources, manage health, and overcome environmental challenges to survive.'),
    ('Educational', 'Games designed to teach or reinforce knowledge and skills, often targeted at younger audiences.'),
    ('Rhythm', 'Games that require players to match their actions to the rhythm of music, often with timing-based gameplay.'),
    ('First-Person Shooter', 'Games that emphasize combat from a first-person perspective, often featuring shooting mechanics and intense action.'),
    ('Third-Person Shooter', 'Games where players control characters from a third-person perspective while engaging in shooting-based combat.');

INSERT INTO promotions(name, description)
VALUES
    ('Mega Discounts', 'Big savings are just a click away!'),
    ('Special Week', 'The discounts youve been waiting for'),
    ('Action Days', 'Deals that make you double-take!'),
    ('Flash Sales', 'Flash Sale Alert! Prices drop'),
    ('Extra Sales', 'Dont miss out!'),
    ('Rapid Sales', 'Stock up and save big! Limited-time offers');

INSERT INTO discounts(name, percentage, start_date, end_date, promotion_id)
VALUES
    ('Special Week30', 0.3, '2023-12-30T06:01:30+00:00', '2023-12-31T05:08:19+00:00', 2),
    ('Rapid Sales40', 0.4, '2024-06-10T23:25:08+00:00', '2024-06-14T14:56:35+00:00', 6),
    ('Rapid Sales50', 0.5, '2024-06-27T23:49:13+00:00', '2024-07-01T22:02:21+00:00', 6),
    ('Rapid Sales30', 0.3, '2024-07-05T23:23:41+00:00', '2024-07-10T00:45:14+00:00', 6),
    ('Rapid Sales20', 0.2, '2024-05-09T02:04:24+00:00', '2024-05-12T04:39:31+00:00', 6),
    ('Special Week40', 0.4, '2023-11-09T11:58:38+00:00', '2023-11-09T15:07:29+00:00', 2),
    ('Rapid Sales45', 0.45, '2024-06-05T09:14:02+00:00', '2024-06-08T22:33:31+00:00', 6),
    ('Special Week50', 0.5, '2024-03-03T15:15:49+00:00', '2024-03-05T15:42:25+00:00', 2);

INSERT INTO products(title,description, images, type, platform, region, price, rating, visibility)
VALUES
    ('Fifa 25 Steam Europe', 'EA SPORTS FC™ 25 gives you more ways to win for the club. Team up with friends in your favourite modes with the new 5v5 Rush, and manage your club to victory as FC IQ delivers more tactical control than ever before.', 'images/products/1', 'Game', 'Steam', 'Europe',49.99, 4.2, TRUE),
    ('Terraria Steam Europe', 'Dig, Fight, Explore, Build: The very world is at your fingertips as you fight for survival, fortune, and glory. Will you delve deep into cavernous expanses in search of treasure and raw materials with which to craft ever-evolving gear, machinery, and aesthetics? Perhaps you will choose instead to seek out ever-greater foes to test your mettle in combat? Maybe you will decide to construct your own city to house the host of mysterious allies you may encounter along your travels?
', 'images/products/2', 'Game', 'Steam', 'Europe',14.99, 4.2, TRUE),
    ('PICO PARK Steam Europe', 'PICO PARK is a cooperaive local/online multiplayer action puzzle, The rule is quite simple: "Get all the keys and get to the goal and clear", but all 48 levels have special gimmicks designed specifically for multiplayer. At most levels, different gimmicks will appear as you move forward, and you will need to consult with your peers and think about new ways to cooperate.', 'images/products/3', 'Game', 'Steam', 'Europe', 4.99, 5, TRUE),
    ('Cities Skylines II Steam Europe', 'Raise a city from the ground up and transform it into a thriving metropolis with the most realistic city builder ever. Push your creativity and problem-solving to build on a scale youve never experienced. With deep simulation and a living economy, this is world-building without limits. ', 'images/products/4', 'Game', 'Steam', 'Europe', 69.99, 3.2, TRUE),
    ('Outer Wilds Steam Europe', 'Named Game of the Year 2019 by Giant Bomb, Polygon, Eurogamer, and The Guardian, Outer Wilds is a critically-acclaimed and award-winning open world mystery about a solar system trapped in an endless time loop. ', 'images/products/5', 'Game', 'Steam', 'Europe', 13.99, 5, TRUE),
    ('Elden Ring Steam Europe', 'The Lands Between are part of a vast continent where magnificent open fields and huge dungeons with complex and three-dimensional designs are seamlessly connected. As you explore, the joy of discovering unknown and overwhelming threats awaits you.
    Mastery of the terrain and knowledge of its secrets can help you overcome enemies and defeat formidable bosses or lead invading players into traps.', 'images/products/6', 'Game', 'Steam', 'Europe', 59.99, 5, TRUE),
    ('Balatro Steam Europe', 'The poker roguelike. Balatro is a hypnotically satisfying deckbuilder where you play illegal poker hands, discover game-changing jokers, and trigger adrenaline-pumping, outrageous combos. ', 'images/products/7', 'Game', 'Steam', 'Europe', 10.99, 4.8, TRUE),
    ('Dredge Steam Europe', 'DREDGE is a single-player fishing adventure with a sinister undercurrent. Sell your catch, upgrade your boat, and dredge the depths for long-buried secrets. Explore a mysterious archipelago and discover why some things are best left forgotten. ', 'images/products/8', 'Game', 'Steam', 'Europe', 7.99, 4.5, TRUE),
    ('Call of Duty Black Ops 6 Steam Europe', 'Developed by Treyarch and Raven, Black Ops 6 is a spy action thriller set in the early 90s, a period of transition and upheaval in global politics, characterized by the end of the Cold War and the rise of the United States as a single superpower. With a mind-bending narrative, and unbound by the rules of engagement, this is signature Black Ops.
    The Black Ops 6 Campaign provides dynamic moment-to-moment gameplay that includes a variety of play spaces with blockbuster set pieces and action-packed moments, high-stakes heists, and cloak-and-dagger spy activity.', 'images/products/9', 'Game', 'Steam', 'Europe', 69.99, 2.8, TRUE),
    ('Hades 2 Steam Europe', 'The first-ever sequel from Supergiant Games builds on the best aspects of the original god-like rogue-like dungeon crawler in an all-new, action-packed, endlessly replayable experience rooted in the Underworld of Greek myth and its deep connections to the dawn of witchcraft.', 'images/products/10', 'Game', 'Steam', 'Europe', 29.99, 4.7, TRUE),
    ('Slay the Spire Steam Europe', 'We fused card games and roguelikes together to make the best single player deckbuilder we could. Craft a unique deck, encounter bizarre creatures, discover relics of immense power, and Slay the Spire! ', 'images/products/11', 'Game', 'Steam', 'Europe', 6.99, 4.9, TRUE),
    ('DAVE THE DIVER Steam Europe', 'DAVE THE DIVER is a casual, singleplayer adventure RPG featuring deep-sea exploration and fishing during the day and sushi restaurant management at night. Join Dave and his quirky friends as they seek to uncover the secrets of the mysterious Blue Hole. ', 'images/products/12', 'Game', 'Steam', 'Europe', 10.99, 4.8, TRUE);

INSERT INTO orders(price, status, order_date, deliver_date, billing_address, user_id)
VALUES
    (49.99, 'Delivered', '2024-11-01 14:30:00', '2024-11-01 14:35:00', row('Rua das Flores 123 2º Esq', 'Porto', 'Porto', '4050-265', 'Portugal', '999888999'), 15),
    (14.99, 'Delivered', '2024-10-15 09:00:00', '2024-10-15 09:02:00', row('Rua das Flores 123 2º Esq', 'Porto', 'Porto', '4050-265', 'Portugal', '999888999'), 15),
    (69.99, 'Delivered', '2024-09-20 18:45:00', '2024-09-20 18:50:00', row('Rua das Flores 123 2º Esq', 'Porto', 'Porto', '4050-265', 'Portugal', '999888999'), 15),
    (29.99, 'Waiting Delivery', '2024-11-25 16:20:00', NULL, row('Rua das Flores 123 2º Esq', 'Porto', 'Porto', '4050-265', 'Portugal', '999888999'), 15);

INSERT INTO transactions(date,amount,provider, status,order_id)
VALUES
    ('2024-11-01 14:35:00', 49.99, 'PayPal', 'Completed', 1),
    ('2024-10-15 09:02:00', 14.99, 'Card', 'Completed', 2),
    ('2024-09-20 18:50:00', 69.99, 'MBWay', 'Completed', 3);

INSERT INTO product_keys(key, product_id, order_id)
VALUES
    ('HPYM3-X1CEG-4SQHW-NEIAN-NFFKU', 1, 1),
    ('FDGBR-HMJ3F-3VAUN-I6JTG-YQOFV', 1, NULL),
    ('O17YT-5JILP-OT8BG-36SW1-LDFDF', 1, NULL),
    ('E9KJK-ZN3PV-PC97M-6KP7T-H31OV', 1, NULL),
    ('RHOYP-718UP-LX5QQ-XHDTO-0OZDB', 1, NULL),
    ('VHDH1-IS34D-FFHKJ-U0JJ8-SDQW1', 1, NULL),
    ('JUAGO-P72IB-8IYIB-E3X4D-8KIUL', 1, NULL),
    ('RDGMI-D33WH-OPR2Y-77V9J-FATJR', 1, NULL),
    ('74I17-PBJJS-IDYHO-N5I36-IHDPU', 1, NULL),
    ('VJ2LR-IMLRU-BTREX-WVM4H-SUFSO', 1, NULL),
    ('S9XQG-GX9MQ-4UM85-AP7P0-DAGAC', 2, 2),
    ('TQA1Z-REL2D-T5JFO-2SRJJ-6I6XF', 2, NULL),
    ('PF8WL-8DI5G-7T9II-8KY2V-MLRNF', 2, NULL),
    ('843V9-MB2CK-D6587-QOQIF-EC19K', 2, NULL),
    ('OHO0A-CKRN5-8BJ3M-N6GVH-EJR9V', 2, NULL),
    ('9EUM5-GFBQE-UV8JN-HRIOG-O0ZJZ', 2, NULL),
    ('X3VZL-JDJXQ-1WH1Y-RH6VT-V4H2N', 2, NULL),
    ('SKJDI-BWYFS-3B0K7-SQ4TK-6MY95', 2, NULL),
    ('HT5IA-QTSZZ-BAN3N-RSJKA-MGSKA', 2, NULL),
    ('Z0467-58FOE-2LQIM-QLS2O-84UKC', 2, NULL),
    ('AV8W3-B1JB7-SWHW9-GI6LZ-L67IR', 3, 3),
    ('B9S08-WULZU-GPVXN-LPIIK-07FFA', 3, NULL),
    ('X4ZSF-ELOA7-MCRJL-LH759-DCZWV', 3, NULL),
    ('TVK7L-32GCC-6O75U-S52AG-LJ62C', 3, NULL),
    ('QY839-8TM08-P85SH-WEOM4-O3CE3', 3, NULL),
    ('G6OCX-G0N8Q-6HT7O-NPC83-KJRY7', 3, NULL),
    ('K6146-B2L79-9BD75-D5Z86-RVF8V', 3, NULL),
    ('P2VO7-V23OA-YUB0O-85U4U-3G9X8', 3, NULL),
    ('P3NTC-G8DY0-JGLPG-2IL2Z-MET1N', 3, NULL),
    ('Y7DTO-YKP3T-XGDUL-89KOB-JMPIZ', 3, NULL),
    ('ZS1NB-84HEL-EDKZ7-RJVJP-X5MVL', 4, 3),
    ('NKZPT-N1RJC-UP0ME-51BAI-EW4QQ', 4, NULL),
    ('2KBLO-4M02E-L8ZNY-97EVI-F2602', 4, NULL),
    ('N42AU-7P77Z-EWOR7-Y29QS-JHLB2', 4, NULL),
    ('ZOG3X-R8U3P-OSCM4-7ATRT-6DEG3', 4, NULL),
    ('D7MCM-KK8PX-DJ29J-BSJ50-V4BAT', 4, NULL),
    ('J22S0-FF235-MYQ68-T19Q2-U4YR8', 4, NULL),
    ('A2JWO-DBVCL-XWNB9-H9RRL-5RTF9', 4, NULL),
    ('5P10I-VI44R-F4NN3-26C92-K5A34', 4, NULL),
    ('F8OZO-PKBJL-X7E1G-TCJP2-4ROKX', 4, NULL),
    ('PN3B5-VTU7H-DXHKN-MKJDC-G76SW', 5, NULL),
    ('HMA18-UHO93-9Y8X6-O38DT-84SWO', 5, NULL),
    ('Y7FJ5-D1OJB-YH6BE-F5PAG-UD4D2', 5, NULL),
    ('S1DQR-B8RYV-P023X-5M502-W8N5K', 5, NULL),
    ('GIVNV-NLDSX-AS1T6-ELVD6-JVA6L', 5, NULL),
    ('SX9U0-EJEZE-OS5JK-20XMT-AT0LS', 5, NULL),
    ('0708E-RI6X9-TZE6O-XVULA-NTUOL', 5, NULL),
    ('5RP0T-06VC4-ELPMW-M3GQ6-L08M9', 5, NULL),
    ('CKJHA-1K6TV-WH1FX-DS7HX-OL0TX', 5, NULL),
    ('14PJ3-X5VS0-1H9B8-HH3WM-AZTN9', 5, NULL),
    ('BH8BT-PNLM1-F2O7Q-TCXKV-4E8I8', 6, NULL),
    ('V89PM-1C8XL-PMUP9-A8NY3-RCK81', 6, NULL),
    ('ATUKP-UFYG0-WW9UX-S33GT-Q7Y7M', 6, NULL),
    ('YBNQ1-IIVVN-H5PVP-6PHR7-XJP6V', 6, NULL),
    ('OCMVB-VXIHT-QOZS3-J53JV-1KAHN', 6, NULL),
    ('PNA0M-YGDKH-MBMNA-9H6MA-5V9W9', 6, NULL),
    ('FN7GW-EGL6R-HQQD7-QVG7O-EM29J', 6, NULL),
    ('VB2NO-DRJ7Y-TKH6X-2CGGT-KTC6M', 6, NULL),
    ('7DXR1-C089N-46MFR-12T6Z-ECLII', 6, NULL),
    ('YU3V6-AZ67A-E45HD-JHSLN-MGLFY', 6, NULL),
    ('SKRMB-FNGLA-E8WBB-244B4-H1NXI', 7, NULL),
    ('L7YJU-WVSZV-PFBEF-932ZK-0R7KY', 7, NULL),
    ('JJHF8-ECWYV-UPQ30-WUWH4-GN7GK', 7, NULL),
    ('AWAQQ-KT2IF-KI8HK-01R3P-5D95M', 7, NULL),
    ('GV3LW-7XEO1-YLVYE-96VP4-LM3VI', 7, NULL),
    ('CU8DO-TVERL-DFFU4-9DE2M-XAW9S', 7, NULL),
    ('X11DV-RS7X3-XJ6KR-3FB02-UJMI7', 7, NULL),
    ('26WBB-VWK34-WG9I9-B6SXR-IEA1I', 7, NULL),
    ('LPKDM-EHS8L-BY1T5-8MA8B-QHGZV', 7, NULL),
    ('U5U9V-6KL73-31478-Z080L-Q98QC', 7, NULL),
    ('IV40M-UDMUF-HKYM1-APNNO-WGQZE', 8, NULL),
    ('ZMDDM-EO7YT-LDP2R-WUP4H-XMS6C', 8, NULL),
    ('012JM-WQ3ER-2ESYC-G9IER-QJ8LQ', 8, NULL),
    ('N1CJE-7JNFO-J3U98-9BQPT-K9YAB', 8, NULL),
    ('084G0-F31JB-78JBJ-4O4WS-RU2YZ', 8, NULL),
    ('3YJO2-ER1YC-Q3BU6-NGDXU-Z5HUR', 8, NULL),
    ('TNBEU-50106-L2MZN-4WXBB-D2G4E', 8, NULL),
    ('8UP4Q-JMHPX-EOPQ6-UB76Q-D5QG7', 8, NULL),
    ('26LZZ-TXQQL-B6QE1-3GEDV-DGXAZ', 8, NULL),
    ('EO8O0-JI224-JCOKX-2QJA6-P36J7', 8, NULL),
    ('U65OI-HLJ10-5K0CX-9A0RD-ML958', 9, NULL),
    ('JUZJF-SSO04-5HX56-4F85I-GN8TY', 9, NULL),
    ('5RV3F-297VC-07HMN-KKOMY-Q5X1M', 9, NULL),
    ('GNC6G-R6O6X-MH830-HJ3BV-KP2NH', 9, NULL),
    ('0CEXK-E978Q-N91YG-7SFD8-8VHT5', 9, NULL),
    ('AK5ZE-Q0VEF-1Y8FG-KSVW8-JUJCV', 9, NULL),
    ('9MXM1-Z6WYP-5ELCE-7QWDL-QZH2S', 9, NULL),
    ('DUJ4Y-M0MSI-LXS9P-4C93U-ZQCIE', 9, NULL),
    ('NCMAX-VC1QF-GSLFT-NEJIW-AVN70', 9, NULL),
    ('8GA0L-JG1VG-9VPPT-T6LHL-PYPB3', 9, NULL),
    ('Z4BNS-I3DIM-KFTNO-UJWXN-2LAHB', 10, NULL),
    ('RH6SY-O0G83-VGVM9-7AH0R-SZ0RT', 10, NULL),
    ('NKXY7-WFMGJ-J2FHP-XSTWL-O1NAF', 10, NULL),
    ('LH8Y8-KWRCT-1U7FH-63V7B-D8MT0', 10, NULL),
    ('JC7IX-3ZLAQ-IGNZM-BD81T-J5RYO', 10, NULL),
    ('Z2P50-LYDWL-RI5VP-77P1F-C276R', 10, NULL),
    ('9MHJY-RX5ZV-HTXXX-QUN15-KMAY3', 10, NULL),
    ('0OEQ3-Q3TUG-LC4E4-J8DZE-W40RW', 10, NULL),
    ('4OJ30-U3CAM-LI6DJ-RRU46-1FP2E', 10, NULL),
    ('Z932K-CVVLY-UJ4KQ-EV04F-OVJKA', 10, NULL);

INSERT INTO payment_methods (provider, details, user_id)
VALUES
    ('Card', 'Credit Card ending in 1234', 9),
    ('Card', 'Credit Card ending in 5679', 13),
    ('PayPal', 'Account: james.c4rter@gmail.com', 9),
    ('Card', 'Credit Card ending in 4236', 8),
    ('Card', 'Credit Card ending in 6457', 7),
    ('Revolut', 'Account: skye.tune@hotmail.com', 11),
    ('PayPal', 'Account: skye.tune@hotmail.com', 11),
    ('Card', 'Credit Card ending in 4596', 14),
    ('PayPal', 'Account linked to tiagocunha@admin.com', 6),
    ('Card', 'Credit Card ending in 5412', 6);

INSERT INTO reviews(text, rating, product_id, user_id)
VALUES
    ('Great game, the best football experience so far. Highly recommend!', 4.5, 1, 6),
    ('Good gameplay, but could use more updates. Still enjoyable overall.', 3.8, 1, 2);

INSERT INTO shopping_cart(quantity, user_id, product_id)
VALUES
    (1, 15, 1),
    (2, 15, 2);
