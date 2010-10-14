<?php

include_once "include.php";

class TuoteryhmaView extends View {

   public static function tulosta() {
      parent::valikko();
      $ryhmat = Model::tuoteryhmat();
      if (!empty($ryhmat)) {
         echo("<ul>\n");
         foreach ($ryhmat as $ryhma) {
            echo('<li><a href="'.Controller::url('tuotteet',$ryhma['id']).'">'.$ryhma['nimi']."</a></li>\n");
         }
         echo("</ul>\n");
      }
      if ($_SESSION['yllapitaja']=true) {
         ?>
         <form action="<?php echo(Controller::url('ryhmat')); ?>" method="post">
            <input type="text" name="uusiRyhma" />
            <input type="submit" name="submit" value="Uusi ryhmä" />
         </form>
         <?php
      }
   }
}

