-----------------------------------------
-- DATA INSERTION
-----------------------------------------

INSERT INTO users(first_name, last_name, username, email, password, profile_picture, preferred_address, is_admin)
VALUES ('Sir', 'Admin', 'adminUno', 'admin@example.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'images/default.png', row('Rua Mouzinho da Silveira, nº 13', 'Porto', 'Porto', '4050-430', 'Portugal', '910000000'),TRUE),
       ('Not', 'Admin', 'sadUser1', 'user@example.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'images/default.png', NULL,FALSE),
       ('André','Pinto', 'apinto', 'up202108856@fe.up.pt','$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W','images/default.png', NULL, TRUE);

INSERT INTO products(title,description, images, type, platform, region, price, rating, visibility)
VALUES ('Fifa 25 Steam Europe', 'The Ultimate EA Football game experience', '', 'Game','Steam', 'Europe',49.99, 4.2, TRUE),
       ('Terraria Steam Europe', 'A cozy game to play by the fireplace', '', 'Game','Steam', 'Europe',14.99, 4.2, TRUE),
       ('PICO PARK Steam Europe', 'PICO PARK is a cooperaive local/online multiplayer action puzzle', '', 'Game', 'Steam', 'Europe', 4.99, 5, TRUE),
       ('Cities Skylines II Steam Europe', 'Create your own megapolis in the new Paradox sandbox game', '', 'Game', 'Steam', 'Europe', 69.99, 3.2, TRUE);

INSERT INTO orders(price, status, order_date, deliver_date, billing_address, user_id)
VALUES (49.99, 'Completed','2024-03-24 00:00:00', '2024-03-25 00:00:00', NULL,1),
       (14.99, 'Completed','2024-04-24 00:00:00', '2024-04-27 00:00:00', NULL,2),
       (74.98,'Completed','2024-10-27 00:00:00', '2024-10-28 00:00:00',NULL, 3);

INSERT INTO transactions(date,amount,provider, status,order_id)
VALUES ('2024-03-24 00:01:00', 49.99, 'PayPal', 'Completed', 1),
       ('2024-10-27 00:01:00', 74.98, 'PayPal', 'Completed',3);

INSERT INTO product_keys(key, order_id, product_id)
VALUES ('jhafuau81bak18', 1, 1),
       ('jjs18s8f71', 2, 2),
       ('kafmahn1',3, 4),
       ('jjak1iav1001',3, 3),
       ('afabfia131',NULL, 3);
