insert into lennot (tunnus) values
   ('abc'),
   ('xyz');

insert into henkilot (nimi, tunnus, salasana, yllapitaja) values
   ('Tapani Turska', 'tturska', '1c401339097ad6bda2c574046876f6c3', FALSE),
   ('Aino Ahven', 'aahven', '35285cc69522e65bcd4a82751c621428', FALSE),
   ('Heikki Hauki', 'hhauki', '91b96640cc0565f0065eb02c4fda530d', TRUE);

insert into paikkavaraukset (henkilo, lento, paikka) 
   select * from (
      (
         (select h.id from henkilot as h where h.tunnus = 'tturska') as a
         cross join
         (values ('abc', 'a123'),('xyz', 'b222')) as c
      )
   )
   union
   select * from (
      (
         (select h.id from henkilot as h where h.tunnus = 'aahven') as b
         cross join
         (values ('abc', 'a124')) as d
      )
   );

