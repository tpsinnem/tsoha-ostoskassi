<?php

include_once "include.php";

class TilauksetView extends View {

   public static function tulosta() {
      parent::valikko();
      echo('<p>Lento '.$_GET['lento'].'</p>');
      $tilaajienPaikat = Model::tilaajienPaikat();
      //$tilaukset = Model::tilaukset();
      if (!empty($tilaukset)) {
         echo("<dl>\n");
         foreach ($tilaajienPaikat as $paikka) {
            echo('<dt>Paikka '.$paikka.'</dt>');
            echo("<dd>\n");
            $tilaukset = Model::tilaukset($paikka);
            $yhteishinta = 0;
            echo("<ul>\n");
            foreach ($tilaukset as $tilaus) {
               //tähän tulisi sisällyttää tilauksen muokkaus sekä poisto
               echo('<li>'.
                     $tilaus['nimi'].' '.
                     $tilaus['kpl'].'kpl '.
                     $tilaus['hinta']."e</li>\n");
               $yhteishinta += $tilaus['hinta'];
            }
            echo("<p>Yhteensä ".$yhteishinta."e</p>\n");
            echo("</dd>\n");
         }
         echo("</dl>\n");
         if (  (!isset($_SESSION['yllapitaja'])) ||
               ($_SESSION['yllapitaja'] == false)  ) {
            echo('<p><a href="'.
                  Controller::url('tuotteet').
                  '">Tee uusi tilaus</a></p>'."\n");
         }
      }
   }
}

