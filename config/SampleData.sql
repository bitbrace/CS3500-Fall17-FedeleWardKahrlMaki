/*
USE cs3500FinalProj;
Here is a datadump for our database mappings, feel free to add some mappings!
*/

/* Our current possible ticket states */
insert into stateMapping (stateName) values 
	('open'), 
	('closed'), 
	('pending'),
	('Being ignored');

/* Our current general problem categories for the user to pick from */
insert into problemMapping (probName) values 
	('I can''t find the outlet'),
	('My computer won''t start'), 
	('I''m lost'),
	('Blue Screen of Death (TM)'),
	('I accidentally deleted some files'),
	('Gravity stopped working'),
	('Hand stuck in toaster, send help'),
	('The inlaw''s are coming over'),
	('I see dead people...'),
	('Well you see, it all started when...');

/* Currently supported OS' for the 'getUserSystemInfo' file */
insert into OSMapping (osName) values 
	('Windows'),
	('Mac OS'), 
	('Linux'),  
	('Ubuntu'),
	('Mobile'),
	('Other');

/* Currently supported browsers for the 'getUserSystemInfo' file */
insert into browserMapping (browName) values 
	('Internet Explorer'), 
	('FireFox'), 
	('Safari'), 
	('Chrome'), 
	('Opera'),
	('Other');

/* Use these common words to help customize the suggestion */
insert into tagMapping (tag) values 
	('like'), 
	('the'), 
	('a'), 
	('my'), 
	('i'), 
	('tried'), 
	('to'), 
	('you');

insert into suggMapping (suggText) values 
	('Stop, just stop'), 
	('Find another profession'), 
	('Turn it off and on again'),
	('Have you considered not doing that?'),
	('On a full moon, take your computer to a cliff and bid it farewell'),
	('I can''t help you. In fact I''m sure no one can'),
	('Yes'),
	('Sounds tough. Well, I wish you the best of luck!'),
	('Not my problem'),
	('Do a barrel role!'),
	('Zerg rush'),
	('Use the force Luke'),
	('Call 1-800-STPDQUESTIONS'),
	('Alright, here''s what you''ve got to do...');

/*Below are some sample rows for the larger tables.
These are a little stricter, be careful with what you add...*/

insert into user (username, password) values 
	('admin', 'pswd'),
	('Jane', 'supersecret'),
	('John', 'help101');

insert into ticket (uid, tstate, pType, userDesc) values 
	(1, 1, 1, 'I dunno what to do!'), 
	(1, 2, 2, 'Stuck, plz help'),
	(2, 1, 3, 'I just started downloading everything!'),
	(2, 3, 4, 'I''m not the admin :('),
	(3, 2, 8, 'The robots are taking over!'),
	(3, 1, 9, 'Beep Boop, I am fine. No robots here.');

insert into solutionFilter (problem, OS, browser, tag, suggid) values 
	(1,1,1,1,1),
	(1,2,1,2,2),
	(1,3,2,3,3),
	(1,4,2,4,4),
	(1,5,3,5,5),
	(1,6,3,6,6),

	(2,1,1,7,7),
	(2,2,1,8,8),
	(2,3,2,7,9),
	(2,4,2,6,10),
	(2,5,3,5,11),
	(2,6,3,4,12),
	
	(3,1,1,3,13),
	(3,2,1,2,14),
	(3,3,2,1,1),
	(3,4,2,2,2),
	(3,5,3,3,3),
	(3,6,3,4,4),

	(4,1,1,5,5),
	(4,2,1,6,6),
	(4,3,2,7,7),
	(4,4,2,8,8),
	(4,5,3,7,9),
	(4,6,3,6,10),

	(5,1,1,5,11),
	(5,2,1,4,12),
	(5,3,2,3,13),
	(5,4,2,2,14),
	(5,5,3,1,1),
	(5,6,3,2,2),

	(6,1,1,3,3),
	(6,2,1,4,4),
	(6,3,2,5,5),
	(6,4,2,6,6),
	(6,5,3,7,7),
	(6,6,3,8,8),

	(7,1,1,7,9),
	(7,2,1,6,10),
	(7,3,2,5,11),
	(7,4,2,4,12),
	(7,5,3,3,13),
	(7,6,3,2,14),

	(8,1,1,1,1),
	(8,2,1,2,2),
	(8,3,2,3,3),
	(8,4,2,4,4),
	(8,5,3,5,5),
	(8,6,3,6,6),

	(9,1,1,7,7),
	(9,2,1,8,8),
	(9,3,2,7,9),
	(9,4,2,6,10),
	(9,5,3,5,11),
	(9,6,3,4,12),

	(10,1,1,3,13),
	(10,2,1,2,14),
	(10,3,2,1,1),
	(10,4,2,2,2),
	(10,5,3,3,3),
	(10,6,3,4,4);