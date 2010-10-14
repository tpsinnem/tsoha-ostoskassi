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
            <input type="text" name="tunnus" /><br />
         <label for="salasana">Salasana: </label>
            <input type="password" name="salasana" /><br />
         <input type="submit" value="Kirjaudu" />
      </p>
      </form>
      </div>
      <?php

   }
}

?>
