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
