
CREATE TABLE `2022_article` (
  `Sno` int(11) NOT NULL UNIQUE KEY AUTO_INCREMENT,
  `ArticleID` varchar(50) NOT NULL PRIMARY KEY,
  `ArticleName` varchar(50) DEFAULT NULL,
  `CurrentStatus` int(11) DEFAULT '1',
  `Comments` long text(11) DEFAULT NULL,
  `CreatedOn` datetime DEFAULT current_timestamp(),
  `ModifiedOn` datetime DEFAULT current_timestamp(),
  `IsActive` int(11) DEFAULT 1,
  `IsDelete` int(11) DEFAULT 0
);


CREATE TABLE `2022_clients` (
  `Sno` int(11) NOT NULL UNIQUE KEY AUTO_INCREMENT,
  `ClientID` varchar(50) NOT NULL PRIMARY KEY,
  `ClientName` varchar(50) DEFAULT NULL,
  `MobileNo` int(12) DEFAULT NULL,
  `UserName` varchar(50) DEFAULT NULL,
  `PassWord` varchar(50) DEFAULT NULL,
  `CreatedOn` datetime DEFAULT current_timestamp(),
  `ModifiedOn` datetime DEFAULT current_timestamp(),
  `IsActive` int(11) DEFAULT 1,
  `IsDelete` int(11) DEFAULT 0
);


CREATE TABLE `2022_userlogin` (
  `Sno` int(11) NOT NULL UNIQUE KEY AUTO_INCREMENT,
  `UserID` varchar(50) NOT NULL PRIMARY KEY,
  `UserName` varchar(50) DEFAULT NULL,
  `PassWord` varchar(50) DEFAULT NULL,
  `CreatedOn` datetime DEFAULT current_timestamp(),
  `CreatedBy` varchar(50) DEFAULT NULL,
  `ModifiedOn` datetime DEFAULT current_timestamp(),
  `ModifiedBy` varchar(50) DEFAULT NULL,
  `IsActive` int(11) DEFAULT 1,
  `IsDelete` int(11) DEFAULT 0
);

