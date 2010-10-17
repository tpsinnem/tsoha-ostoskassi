
<?php

include_once "include.php";

class TuotteetView extends View {

   public static function tulosta() {
      parent::valikko();
      $tuotteet = Model::tuotteet($_GET['ryhma']);
      if (!empty($tuotteet)) {
         echo("<dl>\n");
         foreach ($tuotteet as $tuote) {
            ?>
            <dt>
               <?php echo($tuote['nimi'].": ".$tuote['hinta']."e"); ?>
               <?php
                  if (  (  $_SESSION['yllapitaja']==false ||
                           !isset($_SESSION['yllapitaja'])  ) &&
                        isset($_GET['lento'])) {
                     echo(' <a href="'.Controller::url('tilaus', $tuote['id']).'">tilaa</a>');
                  } else if ($_SESSION['yllapitaja']==true) {
                     echo(' <a href="'.Controller::url('muokkaaTuote', $tuote['id']).'">muokkaa</a>');
                  }
               ?>
            </dt>
            <dd><?php echo($tuote['esittely']); ?></dd>
            <?php
         }
         echo("</dl>\n");
      }
      if ($_SESSION['yllapitaja']==true) {
         echo(' <a href="'.Controller::url('muokkaaTuote').'">Lisää uusi tuote</a>');
      }
   }
}

