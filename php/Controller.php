<?php

include_once "include.php";

class Controller {

   private static function nykyinenUrl() {
      return "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
   }
   private static function korvaaSivu($termi) {
      return preg_replace("/sivu=[[:alnum:]]*/", "sivu=$termi", self::nykyinenUrl());
   }

   public static function aja() {
      //TÄYDENNÄ
      if (!isset($_GET['sivu'])) {
         AloitusView::tulosta();
      } else if ($_GET['sivu'] == 'akirj') {
         AsiakasKirjautumisView::tulosta();
      }
   }

   public static function url($termi) {
      $url = "";
      if (  $termi == 'tuott' ||
            $termi == 'akirj') {
         $url = self::korvaaSivu($termi);
      }
      return $url;
   }
}

?>
