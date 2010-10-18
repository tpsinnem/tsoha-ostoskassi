<?php

class Model {

   const CONN_STRING = 'host=localhost dbname=tsinnema user=tsinnema password=58bfa34cd0ca839d';

   private static function db() {
      return pg_connect(self::CONN_STRING);
   }

   public static function kirjaudu($tunnus, $salasana, $yllapitaja=false) {
      $result =   pg_query_params(  self::db(),
                                    'select salasana, yllapitaja from henkilot where tunnus = $1',
                                    array($tunnus)
                  );
      $oikeaSalasana = trim(pg_fetch_result($result, 'salasana'));
      $oikeaYllapitaja = false;
      if (trim(pg_fetch_result($result, 'yllapitaja')) == 't') {
         $oikeaYllapitaja = true;
      }

      if (  md5(trim($salasana)) === $oikeaSalasana &&
            !($yllapitaja==true && $oikeaYllapitaja==false) ) {
         $_SESSION['tunnus'] = $tunnus;
         $_SESSION['yllapitaja'] = $oikeaYllapitaja; // pelkka $yllapitaja jos erillinen kirjautuminen
         return true;
      } else {
         unset($_SESSION['tunnus']);
         unset($_SESSION['yllapitaja']);
         echo("<p>Kirjautuminen epäonnistui ".$tunnus.' '.$salasana.' '.md5($salasana)."</p>");
         return false;
      }
   }

   public static function kirjauduUlos() {
      unset($_SESSION['tunnus']);
      unset($_SESSION['yllapitaja']);
   }

   public static function tuoteryhmat() {
      $queryString = "select id, nimi from tuoteryhmat";
      $result = pg_query(self::db(), $queryString);
      return pg_fetch_all($result);
   }

   public static function uusiRyhma($nimi) {
      $queryString = "insert into tuoteryhmat (nimi) values ( $1 );";
      pg_query_params(self::db(), $queryString, array($nimi));
   }

   public static function tuotteet($ryhma) {
      $queryString = "  select
                           id, nimi, hinta, esittely
                        from 
                           tuotteet
                        where
                           tuoteryhma = $1";

      $result = pg_query_params(self::db(), $queryString, array($ryhma));
      return pg_fetch_all($result);
   }

   public static function tuote($id) {
      $queryString = "  select
                           nimi, hinta, tuoteryhma, esittely
                        from
                           tuotteet
                        where
                           id = $1";
      $result = pg_query_params(self::db(), $queryString, array($id));
      return pg_fetch_array($result);
   }

   public static function uusiTuote($nimi, $hinta, $esittely, $ryhma) {
      $queryString = "insert into tuotteet (nimi, hinta, esittely, tuoteryhma)
                        values ( $1, $2, $3, $4 );";
      pg_query_params(self::db(), $queryString, array($nimi, $hinta, $esittely, $ryhma));
   }

   public static function muokkaaTuote($id, $nimi, $hinta, $esittely, $ryhma) {
      $queryString = "  update tuotteet
                        set
                           nimi = $1,
                           hinta = $2,
                           esittely = $3,
                           tuoteryhma = $4
                        where
                           id = $5;";
      pg_query_params(self::db(), $queryString, array($nimi, $hinta, $esittely, $ryhma, $id));
   }

   public static function muokkaaTilaus($id, $henkilo, $lento, $tuote, $kpl) {
      $queryString = "  update tilaukset
                        set
                           kpl = $5
                        where
                           id = $1
                           and
                           henkilo = ( select h.id from henkilot as h
                                          where h.tunnus = $2 )
                           and
                           lento = $3
                           and
                           tuote = $4;";
      pg_query_params(self::db(), $queryString, array($id, $henkilo, $lento, $tuote, $kpl));
   }

   public static function tilaa($henkilo, $lento, $tuote, $kpl) {
      $queryString = "insert into tilaukset (henkilo, lento, tuote, kpl)
                        values (
                           (select h.id from henkilot as h where h.tunnus = $1),
                           $2, $3, $4);";
      pg_query_params(self::db(), $queryString, array($henkilo, $lento, $tuote, $kpl));
   }

   public static function tilaus($tilaus) {
      $queryString = "select t.kpl from tilaukset as t where t.id = $1;";
      pg_query_params(self::db(), $queryString, array($tilaus));
   }

   public static muokkaaTilaus($tilaus, $kpl) {
      $queryString = "  update tilaukset
                        set kpl = $2
                        where id = $1;";
      pg_query_params(self::db(), $queryString, array($tilaus, $kpl));
   }
                           

   public static function lennot() {
      if (!isset($_SESSION['yllapitaja']) || $_SESSION['yllapitaja'] == false) {
         $queryString = "  select
                              l.tunnus
                           from 
                              paikkavaraukset as pv,
                              lennot as l,
                              henkilot as h
                           where
                              h.tunnus = $1
                              and
                              pv.henkilo = h.id
                              and
                              pv.lento = l.tunnus;";
         $result = pg_query_params(self::db(), $queryString, array($_SESSION['tunnus']));
         return pg_fetch_all($result);
      } else {
         $queryString = "select tunnus from lennot;";
         $result = pg_query(self::db(), $queryString);
         return pg_fetch_all($result);
      }
   }

   public static function tilaukset($paikka) {
      $queryString = "  select
                           ti.id, tu.nimi, ti.kpl, ti.kpl*tu.hinta as hinta
                        from
                           tilaukset as ti,
                           tuotteet as tu,
                           paikkavaraukset as pv
                        where
                           pv.lento = $1
                           and
                           pv.paikka = $2
                           and
                           ti.lento = pv.lento
                           and
                           ti.henkilo = pv.henkilo
                           and
                           tu.id = ti.tuote;";
      $result = pg_query_params( self::db(),
                                 $queryString,
                                 array($_GET['lento'],$paikka) );
      return pg_fetch_all($result);
   }


   public static function tilaajienPaikat() {
      if (!isset($_SESSION['yllapitaja']) || $_SESSION['yllapitaja'] == false) {
         $queryString = "  select distinct
                              pv.paikka
                           from 
                              paikkavaraukset as pv,
                              tilaukset as t,
                              henkilot as h
                           where
                              pv.lento = $1
                              and
                              h.tunnus = $2
                              and
                              pv.henkilo = h.id
                              and
                              t.henkilo = h.id
                              and
                              t.lento = $1;";
         $result = pg_query_params( self::db(),
                                    $queryString,
                                    array($_GET['lento'], $_SESSION['tunnus']));
         return pg_fetch_all($result);
      } else {
         $queryString = "  select distinct
                              pv.paikka
                           from 
                              paikkavaraukset as pv,
                              tilaukset as t
                           where
                              pv.lento = $1
                              and
                              t.lento = $1;";
         $result = pg_query_params(self::db(), $queryString, array($_GET['lento']));
         return pg_fetch_all($result);
      }
   }


                     
                        

}

?>
