INSERT INTO Poll (name, endDate, startDate, visibility) VALUES ('Testi', '2015-10-07', '2015-09-08', 'A');


INSERT INTO Voter (username, password, firstName, lastName, email) VALUES ('SnowMan99', 'salasana', 'John', 'Snow', 'JSnow@lolcats.com');

INSERT INTO Option (optionName, optionDesc, votesReceived, parentPoll) VALUES ('Pepsi', 'Pepsi, normaali pepsi ei light, zero tai muuta roskaa', 2000, 1);

INSERT INTO Vote (caster,castIn, castDate) VALUES (1, 1, '2015-03-22');
