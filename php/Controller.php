<?php

include_once "include.php";

class Controller {

   const KANTA_URL = 'http://tsinnema.users.cs.helsinki.fi/tsoha';

/*
   private static function nykyinenUrl() {
      return "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
   }
   private static function korvaaSivu($termi) {
      return preg_replace("#sivu=[[:alnum:]]*#", 'sivu=$termi', self::nykyinenUrl());
   }
*/

   public static function aja() {
      //TÄYDENNÄ
      if (!isset($_GET['sivu'])) {
         AloitusView::tulosta();
      } else if ($_GET['sivu'] == 'akirj') {
         AsiakasKirjautumisView::tulosta();
      }
   }

   public static function url($termi) {
      $parametrit = null;
      foreach ($_GET as $kentta => $arvo) {
         $parametrit[$kentta] = $arvo;
      }

      if (  $termi == 'tuott' ||
            $termi == 'akirj') {
         $parametrit['sivu'] = $termi;
         //$url = self::korvaaSivu($termi);
      }

      $parametriString = "";
      foreach ($parametrit as $kentta => $arvo) {
         if ($parametriString == "") {
            $parametriString .= '?';
         } else {
            $parametriString .= '&';
         }
         $parametriString .= $kentta.'='.$arvo;
      }


      $url = KANTA_URL.$parametriString;
      return $url;
   }
}

?>
