<?php

include_once "include.php";

class AloitusView extends View {

   public static function tulosta() {
      parent::alku();
      parent::valikko();
      parent::loppu();
   }
}

?>
