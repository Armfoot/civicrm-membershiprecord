
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- /*******************************************************
-- *
-- * create table to store membership terms/periods
-- *
-- *******************************************************/
DROP TABLE IF EXISTS `civicrm_membership_term`;
CREATE TABLE `civicrm_membership_term`(
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `membership_id` INT(10) UNSIGNED NOT NULL,
  `contact_id` INT(10) UNSIGNED NOT NULL,
  `contribution_id` INT(10) UNSIGNED NOT NULL,
  `start_date` DATETIME DEFAULT NULL,
  `end_date` DATETIME DEFAULT NULL,
  PRIMARY KEY(`id`),
  CONSTRAINT `FK_civicrm_membership` FOREIGN KEY(`membership_id`) REFERENCES `civicrm_membership`(`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_civicrm_contact` FOREIGN KEY(`contact_id`) REFERENCES `civicrm_contact`(`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_civicrm_contribution` FOREIGN KEY(`contribution_id`) REFERENCES `civicrm_contribution`(`id`) ON DELETE CASCADE
) ENGINE = InnoDB DEFAULT CHARSET = utf8 COLLATE = utf8_unicode_ci;

-- /*******************************************************
-- *
-- * update membership terms table with current memberships
-- *
-- *******************************************************/
LOCK TABLES `civicrm_membership_term` WRITE,
  `civicrm_membership` WRITE,
  `civicrm_membership_payment` WRITE,
  `civicrm_contribution` WRITE;
/*!40000 ALTER TABLE `civicrm_membership_term` DISABLE KEYS */;
/*!40000 ALTER TABLE `civicrm_membership` DISABLE KEYS */;
/*!40000 ALTER TABLE `civicrm_membership_payment` DISABLE KEYS */;
/*!40000 ALTER TABLE `civicrm_contribution` DISABLE KEYS */;
INSERT INTO `civicrm_membership_term` (
  `membership_id`,
  `contact_id`,
  `contribution_id`,
  `start_date`,
  `end_date`
) SELECT
    `civicrm_membership`.`id`,
    `civicrm_membership`.`contact_id`,
    `civicrm_membership_payment`.`contribution_id`,
    IFNULL(GREATEST(`receive_date`,`start_date`),`start_date`),
    `end_date`
  FROM `civicrm_membership`
  INNER JOIN `civicrm_membership_payment` ON `civicrm_membership`.`id` = `civicrm_membership_payment`.`membership_id`
  INNER JOIN `civicrm_contribution` ON `civicrm_contribution`.`id` = `civicrm_membership_payment`.`contribution_id`;
/*!40000 ALTER TABLE `civicrm_contribution` ENABLE KEYS */;
/*!40000 ALTER TABLE `civicrm_membership` ENABLE KEYS */;
/*!40000 ALTER TABLE `civicrm_membership_payment` ENABLE KEYS */;
/*!40000 ALTER TABLE `civicrm_membership_term` ENABLE KEYS */;
UNLOCK TABLES;


/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;