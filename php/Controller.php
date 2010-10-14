<?php

include_once "include.php";

class Controller {

   const KANTA_URL = 'http://tsinnema.users.cs.helsinki.fi/tsoha/index.php';

/*
   private static function nykyinenUrl() {
      return "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
   }
   private static function korvaaSivu($termi) {
      return preg_replace("#sivu=[[:alnum:]]*#", 'sivu=$termi', self::nykyinenUrl());
   }
*/

   public static function aja($post) {
      if (isset($post['tunnus']) && isset($post['salasana'])) {
         echo("<p>".$post['tunnus'].$post['salasana'].md5($post['salasana']));
         if (!isset($post['yllapitaja'])) {
            echo("<p>".$post['tunnus'].$post['salasana'].md5($post['salasana']));
            Model::kirjaudu($post['tunnus'], $post['salasana']);
         }
      }
      if (isset($post['ulos'])) {
         Model::kirjauduUlos();
      }
      //TÄYDENNÄ
      if (!isset($_GET['sivu'])) {
         AloitusView::tulosta();
      } else if ($_GET['sivu'] == 'akirj') {
         AsiakasKirjautumisView::tulosta();
      }
   }

   public static function url($termi = null) {
      $parametrit = array();
      foreach ($_GET as $kentta => $arvo) {
         $parametrit[$kentta] = $arvo;
      }

      if ($termi == 'aloit') {
         unset($parametrit['sivu']);
      }
      if (  $termi == 'tuott' ||
            $termi == 'akirj') {
         $parametrit['sivu'] = $termi;
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

      $url = self::KANTA_URL.$parametriString;
      return $url;
   }
}

?>
