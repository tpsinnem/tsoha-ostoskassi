<?php

include_once "include.php";

class TilausView extends View {

   public static function tulosta() {
      parent::valikko();
      $tilaus = null;
      $kpl = null;
      if (isset($_GET['tilaus'])) {
         $tilaus = Model::tilaus($_GET['tilaus']);
         $kpl = $tilaus['kpl'];
      }
      $lento = $_GET['lento'];
      $tuote = null;
      if (!isset($_GET['tilaus'])) {
         $tuote = Model::tuote($_GET['tuote']);
      } else {
         $tuote = Model::tuote($tilaus['id']);
      }
      var_dump($tuote);
      
      ?>
      <p>Lento <?php echo($lento); ?></p>
      <p><?php echo($tuote['nimi'].', '.$tuote['hinta'].'e'); ?></p>
      <form action="<?php echo(Controller::url('tilaukset',$_GET['lento'])); ?>" method="post">
      <p>
         <?php
         if ($kpl != null) {
            echo('<input type="text" name="kpl" value="'.$kpl.'" /> kpl<br />');
         } else {
            echo('<input type="text" name="kpl" /> kpl<br />');
         }
         ?>
         <input type="submit" name="tilaa" value="Valmis" />
         <?php
         if (isset($_GET['tilaus'])) {
            ?>
            <input type="submit" name="peruTilaus" value="Peru tilaus" />
            <?php
         }
         ?>
      </p>
      </form>
      <?php

   }
}

?>
