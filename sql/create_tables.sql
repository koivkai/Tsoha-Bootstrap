 CREATE TABLE Poll(
  pollid SERIAL PRIMARY KEY, 
  name varchar(50) NOT NULL, 
  startDate DATE not null,
  endDate DATE NOT NULL,
  visibility varchar(1) not null -- A kaikki, T kärki, N ei mitään
);

CREATE TABLE Voter (
	voterID SERIAL PRIMARY KEY,
	username varchar(20) NOT NULL,
	password varchar(20) NOT NULL,
	firstName varchar(20) NOT NULL,
	lastName varchar(20) NOT NULL,
	email varchar(254) NOT NULL
);

CREATE TABLE Option (
	optionID SERIAL PRIMARY Key,
	optionName varchar(100) NOT NULL,
	optionDesc varchar(400) NOT NULL,
	votesReceived INTEGER NOT null,
	parentPoll INTEGER REFERENCES Poll(pollID)
);

CREATE TABLE Vote (
	caster INTEGER REFERENCES Voter(voterID),
	castIn INTEGER REFERENCES Poll(pollID),
	castDate DATE NOT NULL,
	PRIMARY KEY(caster, CastIn)
);

