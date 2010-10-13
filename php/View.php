<?php

class View {

   public static function alku() {
      ?>

      <!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0//EN"
              "http://www.w3.org/TR/html4/strict.dtd">
      <html xmlns="http://www.w3.org/1999/xhtml">
      <head>
         <title>Tax-free -ostoskassi</title>
         <meta http-equiv="content-type" 
            content="text/html;charset=utf-8" />
      </head>
      <body>

      <?php
   }

   public static function loppu() {
      ?>

      </body>
      </html>

      <?php
   }



   public static function valikko() {
      // TÄYDENNÄ
      echo('<div class=\"valikko\">');
      echo('<a href="'.Controller::url('tuott').'">Tuotteet</a>');
      if (!isset($_SESSION['tunnus'])) {
         echo('<a href="'.Controller::url('akirj').'">Kirjaudu</a>');
      }
      echo('</div>');
   }
}

?>      
