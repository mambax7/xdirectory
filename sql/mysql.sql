#
# Table structure for table `xdir_broken`
#

CREATE TABLE `xdir_broken` (
  `reportid` INT(5)           NOT NULL AUTO_INCREMENT,
  `lid`      INT(11) UNSIGNED NOT NULL DEFAULT '0',
  `sender`   INT(11) UNSIGNED NOT NULL DEFAULT '0',
  `ip`       VARCHAR(20)      NOT NULL DEFAULT '',
  PRIMARY KEY (`reportid`),
  KEY `lid` (`lid`),
  KEY `sender` (`sender`),
  KEY `ip` (`ip`)
)
  ENGINE = MyISAM
  AUTO_INCREMENT = 3;

# --------------------------------------------------------

#
# Table structure for table `xdir_cat`
#

CREATE TABLE `xdir_cat` (
  `cid`    INT(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `pid`    INT(5) UNSIGNED NOT NULL DEFAULT '0',
  `title`  VARCHAR(50)     NOT NULL DEFAULT '',
  `imgurl` VARCHAR(150)    NOT NULL DEFAULT '',
  PRIMARY KEY (`cid`),
  KEY `pid` (`pid`)
)
  ENGINE = MyISAM
  AUTO_INCREMENT = 154;

# --------------------------------------------------------

#
# Table structure for table `xdir_links`
#

CREATE TABLE `xdir_links` (
  `lid`       INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `cid`       INT(5) UNSIGNED  NOT NULL DEFAULT '0',
  `title`     VARCHAR(100)     NOT NULL DEFAULT '',
  `address`   VARCHAR(200)     NOT NULL DEFAULT '',
  `address2`  VARCHAR(100)     NOT NULL DEFAULT '',
  `city`      VARCHAR(80)      NOT NULL DEFAULT '',
  `state`     CHAR(2)          NOT NULL DEFAULT '',
  `zip`       VARCHAR(15)      NOT NULL DEFAULT '',
  `country`   VARCHAR(100)     NOT NULL DEFAULT '',
  `phone`     VARCHAR(35)      NOT NULL DEFAULT '(916)',
  `fax`       VARCHAR(35)      NOT NULL DEFAULT '',
  `email`     VARCHAR(100)     NOT NULL DEFAULT '',
  `url`       VARCHAR(250)     NOT NULL DEFAULT '',
  `logourl`   VARCHAR(60)      NOT NULL DEFAULT '',
  `submitter` INT(11) UNSIGNED NOT NULL DEFAULT '0',
  `status`    TINYINT(2)       NOT NULL DEFAULT '0',
  `date`      INT(10)          NOT NULL DEFAULT '0',
  `hits`      INT(11) UNSIGNED NOT NULL DEFAULT '0',
  `rating`    DOUBLE(6, 4)     NOT NULL DEFAULT '0.0000',
  `votes`     INT(11) UNSIGNED NOT NULL DEFAULT '0',
  `comments`  INT(11) UNSIGNED NOT NULL DEFAULT '0',
  `premium`   TINYINT(2)       NOT NULL DEFAULT '0',
  PRIMARY KEY (`lid`),
  KEY `cid` (`cid`),
  KEY `status` (`status`),
  KEY `title` (`title`(40))
)
  ENGINE = MyISAM
  AUTO_INCREMENT = 1336;

# --------------------------------------------------------

#
# Table structure for table `xdir_mod`
#

CREATE TABLE `xdir_mod` (
  `requestid`       INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `lid`             INT(11) UNSIGNED NOT NULL DEFAULT '0',
  `cid`             INT(5) UNSIGNED  NOT NULL DEFAULT '0',
  `title`           VARCHAR(100)     NOT NULL DEFAULT '',
  `address`         VARCHAR(100)     NOT NULL DEFAULT '',
  `address2`        VARCHAR(100)     NOT NULL DEFAULT '',
  `city`            VARCHAR(40)      NOT NULL DEFAULT '',
  `state`           CHAR(2)          NOT NULL DEFAULT '',
  `zip`             VARCHAR(20)      NOT NULL DEFAULT '',
  `country`         VARCHAR(100)     NOT NULL DEFAULT '',
  `phone`           VARCHAR(35)      NOT NULL DEFAULT '',
  `fax`             VARCHAR(100)     NOT NULL DEFAULT '',
  `email`           VARCHAR(100)     NOT NULL DEFAULT '',
  `url`             VARCHAR(250)     NOT NULL DEFAULT '',
  `logourl`         VARCHAR(150)     NOT NULL DEFAULT '',
  `premium`         CHAR(2)          NOT NULL DEFAULT '0',
  `description`     TEXT             NOT NULL,
  `modifysubmitter` INT(11) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`requestid`)
)
  ENGINE = MyISAM
  AUTO_INCREMENT = 1;

# --------------------------------------------------------

#
# Table structure for table `xdir_text`
#

CREATE TABLE `xdir_text` (
  `lid`         INT(11) UNSIGNED NOT NULL DEFAULT '0',
  `description` TEXT             NOT NULL,
  KEY `lid` (`lid`)
)
  ENGINE = MyISAM;

# --------------------------------------------------------

#
# Table structure for table `xdir_votedata`
#

CREATE TABLE `xdir_votedata` (
  `ratingid`        INT(11) UNSIGNED    NOT NULL AUTO_INCREMENT,
  `lid`             INT(11) UNSIGNED    NOT NULL DEFAULT '0',
  `ratinguser`      INT(11) UNSIGNED    NOT NULL DEFAULT '0',
  `rating`          TINYINT(3) UNSIGNED NOT NULL DEFAULT '0',
  `ratinghostname`  VARCHAR(60)         NOT NULL DEFAULT '',
  `ratingtimestamp` INT(10)             NOT NULL DEFAULT '0',
  PRIMARY KEY (`ratingid`),
  KEY `ratinguser` (`ratinguser`),
  KEY `ratinghostname` (`ratinghostname`)
)
  ENGINE = MyISAM
  AUTO_INCREMENT = 1;
