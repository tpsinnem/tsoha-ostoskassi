<?php

include_once "include.php";

const ROOT_URL = 'http://tsinnema.users.cs.helsinki.fi/tsoha/';

class Controller {

   public function aja() {
      //TÄYDENNÄ
      if (!isset($_GET['sivu'])) {
         AloitusView::tulosta();
      } else if ($_GET['sivu'] == 'akirj') {
         AsiakasKirjautumisView::tulosta();
      }
   }

   public function url($termi) {
      if ($termi == 'tuott') { //TÄYDENNÄ

}
