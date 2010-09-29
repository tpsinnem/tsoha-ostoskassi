insert into lennot (tunnus) values
   ('abc'),
   ('xyz');

insert into henkilot (nimi, tunnus, salasana, yllapitaja) values
   ('Tapani Turska', 'tturska', 'c496bb4c3721eba3fab43875c2bda51f', FALSE),
   ('Aino Ahven', 'aahven', 'a4bab155312d0159b35af2c5be1e2744', FALSE),
   ('Heikki Hauki', 'hhauki', '6a68561365c10a0aec215990e1cf7ffa', TRUE);

insert into paikkavaraukset (henkilo, lento, paikka) 
   select * from (
      (
         (select h.id from henkilot as h where h.tunnus = 'tturska')
         cross join
         (values ('abc', 'a123'),('xyz', 'b222'))
      )
      union
      (
         (select h.id from henkilot as h where h.tunnus = 'aahven')
         cross join
         (values ('abc', 'a124'))
      )
   );

