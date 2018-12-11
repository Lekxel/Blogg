CREATE TABLE `blog_posts` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
`content` text COLLATE utf8_unicode_ci NOT NULL,
`comments` int(11) NOT NULL DEFAULT 0,
`author` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
`link` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
`created` datetime NOT NULL,
`updated` datetime NOT NULL,
PRIMARY KEY (`id`) );

CREATE TABLE `comments` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`post_id` int(11) NOT NULL,
`content` text COLLATE utf8_unicode_ci NOT NULL,
`author` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
`created` datetime NOT NULL,
PRIMARY KEY (`id`) );

CREATE TABLE `admin` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
`email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
`username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
`password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
`last_logged` datetime NOT NULL,
PRIMARY KEY (`id`) );


CREATE TABLE `site_settings` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`option_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
`option_value` text COLLATE utf8_unicode_ci,
PRIMARY KEY (`id`) );

INSERT INTO `site_settings` (`option_name`, `option_value`) VALUES
('site_name',"Blogg"),
('allow_comment',"TRUE");
