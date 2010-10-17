<?php

include_once "include.php";

class TilausView extends View {

   public static function tulosta() {
      parent::valikko();
      $tilaus = null;
      if (isset($_GET['tilaus'])) {
         $tilaus = Model::tilaus($_GET['tilaus']);
      }
      $lento = $_GET['lento'];
      $tuote = Model::tuote($_GET['tuote']);
      
      ?>
      <p>Lento <?php echo($lento); ?></p>
      <p><?php echo($tuote['nimi'].', '.$tuote['hinta'].'e'); ?></p>
      <form action="<?php echo(Controller::url('tuotteet',$_GET['ryhma'])); ?>" method="post">
      <p>
         <?php
         if ($tilaus != null) {
            echo('<input type="text" name="kpl" value="'.$tilaus['kpl'].'" />kpl<br />');
         } else {
            echo('<input type="text" name="kpl" />kpl<br />');
         }
         ?>
         <input type="submit" name="tilaa" value="Valmis" />
      </p>
      </form>
      <?php

   }
}

?>
