# login

Login and user registration.
Registration confirmation by email.
Password recovery by email.

100% responsive.

Code: Bootstrap 5, Css, Php 8, Mysql.


-- table `session_login`

CREATE TABLE `session_login` (
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `user` varchar(50) NOT NULL,
  `pw` varchar(50) NOT NULL,
  `token` text NOT NULL,
  `estat` int(11) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `session_login`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `session_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;




