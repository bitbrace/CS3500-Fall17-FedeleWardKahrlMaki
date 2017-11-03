CREATE TABLE user (
	uid		INT PRIMARY KEY AUTO_INCREMENT,
	username	VARCHAR(50) NOT NULL,
	password	VARCHAR(50) NOT NULL
);

CREATE TABLE ticket (
	tid		INT PRIMARY KEY AUTO_INCREMENT,
	uid		INT FOREIGN KEY REFERENCES user(uid),
	tstate		INT FOREIGN KEY REFERENCES stateMapping(tstate),
	ptype		INT FOREIGN KEY REFERENCES problemMapping(pid),
	userDesc	TEXT,
	userTitle	TINYTEXT
);

CREATE TABLE stateMapping (
	tstate		INT PRIMARY KEY,
	stateName	VARCHAR(50)
);

CREATE TABLE problemMapping (
	pid		INT PRIMARY KEY AUTO_INCREMENT,
	probName	VARCHAR(20)
);

CREATE TABLE solutionFilter (
	solfid		INT PRIMARY KEY AUTO_INCREMENT,
	OS		INT FOREIGN KEY REFERENCES OSMapping(osid),
	browser		INT FOREIGN KEY REFERENCES browserMapping(browserid),
	problem		INT FOREIGN KEY REFERENCES problemMapping(pid),
	tag		INT FOREIGN KEY REFERENCES tagMapping(tagid),
	suggid		INT FOREIGN KEY REFERENCES suggMapping(suggid)
);

CREATE TABLE OSMapping (
	osid		INT PRIMARY KEY AUTO_INCREMENT,
	osName		VARCHAR(50)
);

CREATE TABLE browserMapping (
	browserid	INT PRIMARY KEY AUTO_INCREMENT,
	browName	VARCHAR(100)
);

CREATE TABLE tagMapping (
	tagid		INT PRIMARY KEY AUTO_INCREMENT,
	tag		VARCHAR(100)
);

CREATE TABLE suggMapping (
	suggid		INT PRIMARY KEY AUTO_INCREMENT,
	suggText	VARCHAR(100)
);
