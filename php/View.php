<?php

class View {

   public static function valikko() {
      // TÄYDENNÄ
      echo('<div class=\"valikko\">');
      echo('<a href=\"'.Controller.url('tuott').'\">Tuotteet</a>');
      if (!isset($_SESSION['tunnus'])) {
         echo('<a href=\"'.Controller.url('akirj').'\">Kirjaudu</a>');
      }
      echo('</div>');
   }
}

?>      
