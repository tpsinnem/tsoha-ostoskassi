<?php

include_once "include.php";

class LennotView extends View {

   public static function tulosta() {
      parent::valikko();
      $lennot = Model::lennot();
      if (!empty($lennot)) {
         echo("<ul>\n");
         foreach ($lennot as $lento) {
            echo( '<li><a href="'.
                  Controller::url('tilaukset',trim($lento['tunnus'])).
                  '">Lento '.$lento['tunnus']."</a></li>\n");
         }
         echo("</ul>\n");
      }
   }
}

