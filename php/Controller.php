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
      if (isset($_POST['uusiRyhma']) && $_SESSION['yllapitaja'] == true) {
         Model::uusiRyhma($_POST['uusiRyhma']);
      }
      if (isset($_POST['tuoteMuokkaus'])) {
         if (isset($_GET['tuote'])) {
            Model::muokkaaTuote( $_GET['tuote'],
                                 $_POST['nimi'],
                                 $_POST['hinta'],
                                 $_POST['esittely'],
                                 $_GET['ryhma'] );
         } else {
            Model::uusiTuote(    $_POST['nimi'],
                                 $_POST['hinta'],
                                 $_POST['esittely'],
                                 $_GET['ryhma'] );
         }
      }
      if (isset($_POST['tilaa'])) {
         if (isset($_GET['tilaus'])) {
            Model::muokkaaTilaus( $_GET['tilaus'],
                                 $_SESSION['tunnus'],
                                 $_GET['lento'],
                                 $_GET['tuote'],
                                 $_POST['kpl'] );
         } else {
            Model::tilaa(  $_SESSION['tunnus'],
                           $_GET['lento'],
                           $_GET['tuote'],
                           $_POST['kpl'] );
         }
      }

      //TÄYDENNÄ
      if (!isset($_GET['sivu'])) {
         AloitusView::tulosta();
      } else if ($_GET['sivu'] == 'akirj') {
         AsiakasKirjautumisView::tulosta();
      } else if ($_GET['sivu'] == 'ryhmat') {
         TuoteryhmaView::tulosta();
      } else if ($_GET['sivu'] == 'tuotteet') {
         TuotteetView::tulosta();
      } else if ($_GET['sivu'] == 'lennot') {
         LennotView::tulosta();
      } else if ($_GET['sivu'] == 'muokkaaTuote') {
         TuoteMuokkausView::tulosta();
      } else if ($_GET['sivu'] == 'tilaukset') {
         TilauksetView::tulosta();
      } else if ($_GET['sivu'] == 'tilaus') {
         TilausView::tulosta();
      }
   }

   public static function url($sivu, $valinta = null) {
      $parametrit = array();
      foreach ($_GET as $kentta => $arvo) {
         $parametrit[$kentta] = $arvo;
      }

      if ($sivu == 'aloit') {
         unset($parametrit['sivu']);
      }
      if ($sivu == 'ulos') {
         $parametrit = array();
      }
      if (  $sivu == 'ryhmat' ||
            $sivu == 'akirj' ||
            $sivu == 'ykirj' ||
            $sivu == 'lennot') {
         $parametrit['sivu'] = $sivu;
      }
      if ($sivu == 'tuotteet') {
         $parametrit['sivu'] = 'tuotteet';
         $parametrit['ryhma'] = $valinta;
      }
      if ($sivu == 'tilaukset') {
         $parametrit['sivu'] = 'tilaukset';
         $parametrit['lento'] = $valinta;
      }
      if ($sivu == 'muokkaaTuote' || $sivu == 'tilaus') {
         $parametrit['sivu'] = $sivu;
         if ($valinta != null) {
            $parametrit['tuote'] = $valinta;
         } else {
            unset($parametrit['tuote']);
         }
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
