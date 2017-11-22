USE cs3500FinalProj;

-- Here is a datadump for our database mappings, feel free to add some mappings!

insert into stateMapping (stateName) values ('open'), ('closed'), ('pending');

insert into problemMapping (probName) values ('i can''t find the outlet'), ('my computer won''t start'), ('i''m lost');

insert into OSMapping (osName) values ('Windows'), ('iOS'), ('Ubuntu'), ('kali');

insert into browserMapping (browName) values ('firefox'), ('chrome'), ('chromium'), ('internet explorer'), ('edge'), ('safari'), ('opera');

insert into tagMapping (tag) values ('like'), ('the'), ('a'), ('under'), ('my'), ('i'), ('tried'), ('to'), ('with');

insert into suggMapping (suggText) values ('stop'), ('find another profession'), ('turning it off and on again');

-- Below are some sample rows for the larger tables.
-- These are a little stricter, be careful with what you add...

-- insert into user (username, password) values ('admin', 'pswd'); -- using insecure login system

insert into user (uid, username, salt) values (1, 'admin', MD5('lorem ipsum dolor sit amet')); -- using secure login system
update user set password = SHA2(MD5(CONCAT('pswd', salt)), 512) where uid = 1;

insert into ticket (uid, tstate, pType, userDesc) values (1, 1, 1, 'i dunno what to do!'), (1, 2, 2, 'Stuck, plz help');

insert into solutionFilter (problem, OS, browser, tag, suggid) 
values 
(1,1,1,1,1),
(1,2,1,2,1),
(1,1,2,3,2),
(2,1,1,4,2),
(1,2,2,5,1),
(2,1,2,6,3),
(2,2,2,7,3);
