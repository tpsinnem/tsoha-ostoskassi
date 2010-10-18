<?php

include_once "include.php";

class TuoteMuokkausView extends View {

   public static function tulosta() {
      parent::valikko();
      $tuote = null;
      if (isset($_GET['tuote'])) {
         $tuote = Model::tuote($_GET['tuote']);
      }
      
      ?>
      <form action="<?php echo(Controller::url('tuotteet',$_GET['ryhma'])); ?>" method="post">
      <p>
         <label for="nimi">Nimi: </label>
            <?php
            if ($tuote != null) {
               echo('<input type="text" name="nimi" value="'.$tuote['nimi'].'" /><br />');
            } else {
               echo('<input type="text" name="nimi" /><br />');
            }
            ?>
         <label for="hinta">Hinta: </label>
            <?php
            if ($tuote != null) {
               echo('<input type="text" name="hinta" value="'.$tuote['hinta'].'" /><br />');
            } else {
               echo('<input type="text" name="hinta" /><br />');
            }
            ?>
         <label for="kuvaus">Kuvaus: </label>
            <?php
            if ($tuote != null) {
               echo('<textarea name="esittely">'.$tuote['esittely'].'</textarea><br />');
            } else {
               echo('<textarea name="esittely"></textarea><br />');
            }
            ?>
         <input type="submit" name="tuoteMuokkaus" value="Valmis" />
         <?php
         if ($_SESSION['yllapitaja']==true && isset($_GET['tuote']) {
            ?>
            <input type="submit" name="poistaTuote" value="Poista tuote" />
            <?php
         }
         ?>
      </p>
      </form>
      <?php

   }
}

?>
