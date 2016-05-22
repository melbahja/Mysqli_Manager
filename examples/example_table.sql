
CREATE TABLE `example_table` (
  `id` int(11) NOT NULL,
  `title` varchar(100) CHARACTER SET utf8 NOT NULL,
  `description` varchar(150) CHARACTER SET utf8 NOT NULL,
  `text` text CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


INSERT INTO `example_table` (`id`, `title`, `description`, `text`) VALUES
(1, ' title', ' desc', ' text');

ALTER TABLE `example_table`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `example_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
