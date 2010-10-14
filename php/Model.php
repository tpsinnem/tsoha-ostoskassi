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
         $_SESSION['yllapitaja'] = $yllapitaja;
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

}

?>
