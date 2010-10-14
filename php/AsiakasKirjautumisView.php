<?php

include_once "include.php";

class AsiakasKirjautumisView extends View {

   public static function tulosta() {
      parent::valikko();
      
      ?>
      <div class="kirjautuminen">
      <form action="<?php echo(Controller::url('aloit')); ?>" method="post">
      <p>
         <label for="tunnus">Tunnus: </label>
            <input type="text" id="tunnus" /><br />
         <label for="salasana">Salasana: </label>
            <input type="password" id="salasana" /><br />
         <input type="submit" value="Kirjaudu" />
      </p>
      </form>
      </div>
      <?php

   }
}

?>
