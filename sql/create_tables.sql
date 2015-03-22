CREATE TABLE Poll(
  pollID SERIAL PRIMARY KEY, 
  name varchar(50) NOT NULL, 
  startDate DATE not null,
  endDate DATE NOT NULL
);

CREATE TABLE Voter (
	voterID SERIAL PRIMARY KEY,
	voterName varchar(20) NOT NULL,
	password varchar(20) NOT NULL,
	firstName varchar(20) NOT NULL,
	lastName varchar(20) NOT NULL,
	email varchar(254) NOT NULL
);

CREATE TABLE Options (
	optionID SERIAL PRIMARY Key,
	optionName varchar(100) NOT NULL,
	optionDesc varchar(400) NOT NULL,
	votesReceived INTEGER NOT null,
	parentPoll SERIAL REFERENCES Poll(pollID)
);

CREATE TABLE Vote (
	caster SERIAL REFERENCES Voter(voterID),
	castIn SERIAL REFERENCES Poll(pollID),
	castDate DATE NOT NULL,
	PRIMARY KEY(caster, CastIn)
);

