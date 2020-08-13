INSERT INTO `role_admin` (`admin_id`, `role_id`)
VALUES ((select id from admins where username = 'mostafa' LIMIT 1),
        (select id from roles where name = 'super_admin' LIMIT 1));
