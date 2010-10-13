<?php

include_once "include.php";

class Controller {

   private function nykyinenUrl() {
      return "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
   }
   private function korvaaSivu($termi) {
      return preg_replace("/sivu=[[:alnum:]]*/", "sivu=$termi", nykyinenUrl());
   }

   public function aja() {
      //TÄYDENNÄ
      if (!isset($_GET['sivu'])) {
         AloitusView::tulosta();
      } else if ($_GET['sivu'] == 'akirj') {
         AsiakasKirjautumisView::tulosta();
      }
   }

   public function url($termi) {
      $url = "";
      if (  $termi == 'tuott' ||
            $termi == 'akirj') {
         $url = korvaaSivu($termi);
      }
      return $url;
   }
}

?>
