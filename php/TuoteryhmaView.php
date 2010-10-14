<?php

include_once "include.php";

class TuoteryhmaView extends View {

   public static function tulosta() {
      parent::valikko();
      $ryhmat = Model::tuoteryhmat();
      echo("<ul>\n");
      foreach ($ryhmat as $ryhma) {
         echo('<li><a href="'.Controller::url('tuotteet',$ryhma['id']).'">'.$ryhma['nimi']."</a></li>\n");
      }
      echo("</ul>\n");
   }
}

