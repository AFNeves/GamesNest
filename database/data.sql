-----------------------------------------
-- DATA INSERTION
-----------------------------------------

INSERT INTO users(first_name, last_name, username, email, password, is_admin)
VALUES
    ('John', 'Doe', 'johndoe', 'johndoe@lost.com', '$2y$10$70JFRa.wylskSh6qKhbhKeYmUW4cSlvMmw39FTKLTU.Qks5Ul3zv.', false),
    ('Afonso', 'Neves', 'ANeves', 'up202108884@up.pt', '$2y$10$pfYAIlSwza5FmEtG2ew/au2au31xcCkJ7S4MfF.TYUcKUyhrhH8dO', true),
    ('Andre', 'Pinto', 'APinto', 'up202108856@up.pt', '$2y$10$20iHYeHXrA5kiwYmEmXiUuaUZAtbI5AjyZ1E8jnojBOEb3qkxPzd6', true),
    ('Beatriz', 'Oliveira', 'BOliveira', 'up202204353@up.pt', '$2y$10$WmvpTW4v4NI5bfhP7oNgU..ke4z2YuYle64U0tIcquzYC13gheoAi', true),
    ('Victor', 'Velasco', 'VVelasco', 'up202401431@up.pt', '$2y$10$p3.VZLQEVWLGWHkSLQJMOuRVGP./X59APOfPaTkbH4gzwDIsCLujK', true),
    ('Tiago', 'Cunha', 'TCunhaAdmin', 'tiagocunha@admin.com', '$2y$10$gdAcxKsg8DgNHre2udlJceA4rG8iQu1ZyRDubrduelXZaJKystcu6', true), -- FETiago24CunhaUP
    ('Phyllys', 'Sweatland', 'psweatland60808', 'phyllys.sweatland@bellsouth.net', 'O7XuL!*71*!T8!*', false),
    ('Jena', 'Hush', 'jhush56742', 'jena.hush@hotmail.co.uk', '53*K#2o!%!#6', false),
    ('Sam', 'Beedon', 'sbeedon23501', 'sam.beedon@yahoo.com', '*y*&!k4$w1*N*4', false),
    ('Prissie', 'Novic', 'pnovic28758', 'prissie.novic@yahoo.com', '*%d4*!!#J#V!', false),
    ('Lorrie', 'Bartolommeo', 'lbartolommeo12345', 'lorrie.bartolommeo@example.com', '1!#*!#*!#*!#', false),
    ('James', 'Carter', 'jcarter21', 'james.c4rter@gmail.com', 'tobysplash82', false),
    ('Leroi', 'Naismith', 'lnaismith55963', 'leroi.naismith@gmail.com', 'r!n!*u0!U%4!', false),
    ('Skye', 'Tune', 'stune52338', 'skye.tune@hotmail.com', 'q&!2!lv*!&*!!', false),
    ('Tiago', 'Cunha', 'TCunhaClient', 'tiagocunha@client.com', '$2y$10$gdAcxKsg8DgNHre2udlJceA4rG8iQu1ZyRDubrduelXZaJKystcu6', false), -- FETiago24CunhaUP
    ('Sheffield', 'Errington', 'serrington44687', 'sheffield.errington@hotmail.com', '5!4*!*0!', false),
    ('Obadias', 'Shortt', 'oshortt18768', 'obadias.shortt@yahoo.com', '41%ze!X9', false),
    ('Iver', 'Lynn', 'ilynn42682', 'iver.lynn@yahoo.com', '9Y*s!c*Z#$$p', false);

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
    ('Fifa 25 Steam Europe', 'The Ultimate EA Football game experience', '', 'Game','Steam', 'Europe',49.99, 4.2, TRUE),
    ('Terraria Steam Europe', 'A cozy game to play by the fireplace', '', 'Game','Steam', 'Europe',14.99, 4.2, TRUE),
    ('PICO PARK Steam Europe', 'PICO PARK is a cooperaive local/online multiplayer action puzzle', '', 'Game', 'Steam', 'Europe', 4.99, 5, TRUE),
    ('Cities Skylines II Steam Europe', 'Create your own megapolis in the new Paradox sandbox game', '', 'Game', 'Steam', 'Europe', 69.99, 3.2, TRUE);

INSERT INTO orders(price, status, order_date, deliver_date, billing_address, user_id)
VALUES
    (49.99, 'Completed','2024-03-24 00:00:00', '2024-03-25 00:00:00', NULL,1),
    (14.99, 'Completed','2024-04-24 00:00:00', '2024-04-27 00:00:00', NULL,8),
    (74.98,'Completed','2024-10-27 00:00:00', '2024-10-28 00:00:00',NULL, 10);

INSERT INTO transactions(date,amount,provider, status,order_id)
VALUES
    ('2024-03-24 00:01:00', 49.99, 'PayPal', 'Completed', 1),
    ('2024-04-24 00:01:00', 14.99, 'PayPal', 'Completed', 2),
    ('2024-10-27 00:01:00', 74.98, 'PayPal', 'Completed',3);

INSERT INTO product_keys(key, order_id, product_id)
VALUES
    ('jhafuau81bak18', 1, 1),
    ('jjs18s8f71', 2, 2),
    ('kafmahn1',3, 4),
    ('jjak1iav1001',3, 3),
    ('afabfia131',NULL, 3);

INSERT INTO payment_methods (provider, details, user_id)
VALUES
     ('Card', 'Credit Card ending in 1234', 9),
     ('Card', 'Credit Card ending in 5679', 13),
     ('PayPal', 'Account: james.c4rter@gmail.com', 9),
     ('Card', 'Credit Card ending in 4236', 8),
     ('Card', 'Credit Card ending in 6457', 7),
     ('Revolut', 'Account: wthewheh@gmail.com', 11),
     ('PayPal', 'Account: efbewhew@gmail.com', 12),
     ('Card', 'Credit Card ending in 4596', 14),
     ('PayPal', 'Account linked to wethehe@gmail.com', 5),
     ('Card', 'Credit Card ending in 5412', 10);
