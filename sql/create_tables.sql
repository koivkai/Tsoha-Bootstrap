 CREATE TABLE Voter (
	voterid SERIAL PRIMARY KEY,
	username varchar(20) NOT NULL,
	password varchar(20) NOT NULL,
	firstname varchar(20) NOT NULL,
	lastname varchar(20) NOT NULL,
	email varchar(254) NOT NULL
);

 CREATE TABLE Poll(
  pollid SERIAL PRIMARY KEY, 
  name varchar(50) NOT NULL, 
  startdate DATE not null,
  enddate DATE NOT NULL,
  visibility varchar(1) not null, -- A kaikki, T kärki, N ei mitään
  ownerid INTEGER REFERENCES Voter(voterid)
);


CREATE TABLE Option (
	optionid SERIAL PRIMARY Key,
	optionname varchar(100) NOT NULL,
	optiondesc varchar(400) NOT NULL,
	votesreceived INTEGER NOT null,
	parentpoll INTEGER REFERENCES Poll(pollid)
);

CREATE TABLE Vote (
	voteid SERIAL PRIMARY KEY,
	caster INTEGER REFERENCES Voter(voterid),
	castin INTEGER REFERENCES Poll(pollid),
	castdate DATE NOT NULL
);

