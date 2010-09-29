create table tilaukset (
   id       serial   PRIMARY KEY,
   henkilo  integer,
   lento    integer,
   tuote    integer  REFERENCES tuotteet(id),
   kpl      integer  NOT NULL,

   FOREIGN KEY (henkilo, lento) REFERENCES paikkavaraukset
);

create table paikkavaraukset (
   henkilo  integer  REFERENCES henkilot (id),
   lento    char(10) REFERENCES lennot(tunnus),
   paikka   char(10) NOT NULL,

   PRIMARY KEY (henkilo, lento),
   UNIQUE      (lento, paikka)
);

create table lennot (
   tunnus   char(10) PRIMARY KEY
);

create table tuotteet (
   id          integer     PRIMARY KEY,
   nimi        varchar(50) NOT NULL,
   hinta       integer     NOT NULL,
   esittely    text,
   tuoteryhma  integer     REFERENCES tuoteryhmat(id)
);

create table henkilot (
   id          integer     PRIMARY KEY,
   nimi        varchar(50) NOT NULL,
   tunnus      char(8)     UNIQUE NOT NULL,
   salasana    varchar(32) NOT NULL,
   yllapitaja  boolean     NOT NULL
);

create table tuoteryhmat (
   id    integer     PRIMARY KEY,
   nimi  varchar(20) NOT NULL
);
