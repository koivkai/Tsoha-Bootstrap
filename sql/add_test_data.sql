INSERT INTO Poll (name, endDate, startDate) VALUES ('Testi', '2015-08-07', '2015-09-08');


INSERT INTO Voter (voterName, password, firstName, lastName, email) VALUES ('SnowMan99', 'salasana', 'John', 'Snow', 'JSnow@lolcats.com');

INSERT INTO Options (optionName, optionDesc, votesReceived, parentPoll) VALUES ('Pepsi', 'Pepsi, normaali pepsi ei light, zero tai muuta roskaa', 2000, 1);

INSERT INTO Vote (caster,castIn, castDate) VALUES (1, 1, '2015-03-22');
