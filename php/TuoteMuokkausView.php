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
            <input type="text" 
                   name="nimi" 
                   <?php
                     if ($tuote != null) {
                        echo('value="'.trim($tuote['nimi']));
                     }
                   ?>
             /><br />
         <label for="hinta">Hinta: </label>
            <input type="text" 
                   name="hinta" 
                   <?php
                     if ($tuote != null) {
                        echo('value="'.$tuote['hinta']);
                     }
                   ?>
             /><br />
         <label for="kuvaus">Kuvaus: </label>
            <textarea name="esittely">
            <?php
               if ($tuote != null) {
                  echo(trim($tuote['esittely']));
               }
            ?>
            </textarea><br />
         <input type="submit" name="tuoteMuokkaus" value="Valmis" />
      </p>
      </form>
      <?php

   }
}

?>
