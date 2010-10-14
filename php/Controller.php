<?php

include_once "include.php";

class Controller {

   const KANTA_URL = 'http://tsinnema.users.cs.helsinki.fi/tsoha/index.php';

   public static function aja() {
      if (isset($_POST['tunnus']) && isset($_POST['salasana'])) {
         if (!isset($_POST['yllapitaja'])) {
            Model::kirjaudu($_POST['tunnus'], $_POST['salasana']);
         }
      }
      if (isset($_POST['ulos'])) {
         Model::kirjauduUlos();
      }
      //TÄYDENNÄ
      if (!isset($_GET['sivu'])) {
         AloitusView::tulosta();
      } else if ($_GET['sivu'] == 'akirj') {
         AsiakasKirjautumisView::tulosta();
      }
   }

   public static function url($uudetParametrit) {
      $parametrit = array();
      foreach ($_GET as $kentta => $arvo) {
         $parametrit[$kentta] = $arvo;
      }

      if ($uudetParametrit['sivu'] == 'aloit') {
         unset($parametrit['sivu']);
      }
      if (  $uudetParametrit['sivu'] == 'tuott' ||
            $uudetParametrit['sivu'] == 'akirj') {
         $parametrit['sivu'] = $uudetParametrit['sivu'];
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
