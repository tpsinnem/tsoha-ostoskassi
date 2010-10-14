<?php

include_once "include.php";

Model::alku();
foreach($_POST as $kentta => $arvo) {
   echo($kentta." ".$arvo);
}
?>
<p>
   <form action="postTesti.php" method="post">
   <p>
      <label for="tunnus">Tunnus: </label>
         <input type="text" name="tunnus" /><br />
      <label for="salasana">Salasana: </label>
         <input type="password" name="salasana" /><br />
      <input type="submit" name="kirjaudu" value="Kirjaudu" />
   </p>
   </form>
</p>
