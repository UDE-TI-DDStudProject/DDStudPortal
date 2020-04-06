CREATE TABLE `test_auswahl`
(
  `equivalence_id` int
(15) NOT NULL,
  `personalid` int
(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON
UPDATE CURRENT_TIMESTAMP,
   UNIQUE KEY `UNIQUE_ROW`
(`equivalence_id`, `personalid`)
) ENGINE
=InnoDB DEFAULT CHARSET=utf8;