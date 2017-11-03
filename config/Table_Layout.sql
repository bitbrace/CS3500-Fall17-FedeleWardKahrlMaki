CREATE DATABASE cs3500FinalProj;

USE cs3500FinalProj;

CREATE TABLE user (
	uid		INT AUTO_INCREMENT,
	username	VARCHAR(50) NOT NULL,
	password	VARCHAR(50) NOT NULL,
	PRIMARY KEY (uid)
);

CREATE TABLE OSMapping (
	osid		INT AUTO_INCREMENT,
	osName		VARCHAR(50),
	PRIMARY KEY (osid)
);

CREATE TABLE browserMapping (
	browserid	INT AUTO_INCREMENT,
	browName	VARCHAR(100),
	PRIMARY KEY (browserid)
);

CREATE TABLE tagMapping (
	tagid		INT AUTO_INCREMENT,
	tag		VARCHAR(100),
	PRIMARY KEY (tagid)
);

CREATE TABLE suggMapping (
	suggid		INT AUTO_INCREMENT,
	suggText	VARCHAR(100),
	PRIMARY KEY (suggid)
);

CREATE TABLE stateMapping (
	tstate		INT AUTO_INCREMENT,
	stateName	VARCHAR(50),
	PRIMARY KEY (tstate)
);

CREATE TABLE problemMapping (
	pid		INT AUTO_INCREMENT,
	probName	VARCHAR(20),
	PRIMARY KEY (pid)
);

CREATE TABLE ticket (
	tid		INT AUTO_INCREMENT,
	uid		INT,
	tstate		INT,
	ptype		INT,
	userDesc	TEXT,
	userTitle	TINYTEXT,
	PRIMARY KEY (tid),
	FOREIGN KEY (uid) REFERENCES user(uid)
		ON DELETE SET NULL
		ON UPDATE CASCADE,
	FOREIGN KEY (tstate) REFERENCES stateMapping(tstate)
		ON DELETE SET NULL
		ON UPDATE CASCADE,
	FOREIGN KEY (ptype) REFERENCES problemMapping(pid)
		ON DELETE SET NULL
		ON UPDATE CASCADE
);

CREATE TABLE solutionFilter (
	solfid		INT AUTO_INCREMENT,
	OS		INT,
	browser		INT,
	problem		INT,
	tag		INT,
	suggid		INT,
	PRIMARY KEY (solfid),
	FOREIGN KEY (OS) REFERENCES OSMapping(osid)
		ON DELETE SET NULL
		ON UPDATE CASCADE,
	FOREIGN KEY (browser) REFERENCES browserMapping(browserid)
		ON DELETE SET NULL
		ON UPDATE CASCADE,
	FOREIGN KEY (problem) REFERENCES problemMapping(pid)
		ON DELETE SET NULL
		ON UPDATE CASCADE,
	FOREIGN KEY (tag) REFERENCES tagMapping(tagid)
		ON DELETE SET NULL
		ON UPDATE CASCADE,
	FOREIGN KEY (suggid) REFERENCES suggMapping(suggid)
		ON DELETE SET NULL
		ON UPDATE CASCADE
);
