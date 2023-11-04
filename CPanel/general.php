<?php

include "views/head.php";
include "CPApp/SQLiteConnection.php";
include "php/bootstrap.layouts.php";
include "php/funct.class.php";
use CPApp\Config;

echo PHP_EOL . "<title>" . Config::GENERAL_PAGE . "</title>" . PHP_EOL;
echo "</head>";
echo PHP_EOL . "<body>" . PHP_EOL;

//  pagina general parametri $_GET
//  @param $_GET["id"]        $new_id     id della notizia che vogliamo mostrare
//  @param $_GET["search"]    $search     stringa di ricerca fra i titoli delle notizie
//  @param $_GET["state"]     $state      stato con cui viene preparata la pagina
//                                        "read" o "" stato sola lettura valore di default
//                                        "write" stato di variazione lettura scrittura
//                                        "new" stato di aggiunta record

//  valore di stato di default
$state = "";
//  preleva dalla stringa $_GET il valore dello stato ( se passato )
if (isset($_GET["state"])) {
  $state = $_GET["state"];
}
;
//  valore id della notizia di default
$new_id = 0;
//  eventuale valore id ricevuto con il $_GET 
if (isset($_GET["id"])) {
  $new_id = $_GET["id"];
}
;
// valore indice
$indice = 1;
if (isset($_GET["indice"])) {
  $indice = $_GET["indice"];
}
;

// valore search di default
$search = "";

// inizializzazione classe Services
$services = new Services();
//  eventuale valore ricerca passato con il $_GET
if (isset($_GET["search"])) {
  // sanitizzo comunque il dato inserito nel form SEARCH
  $search = $services->validate($_GET["search"]);
}
;

//  Apri la connessione con il DB
use CPApp\CPSQLiteConnection;

$conn = new CPSQLiteConnection();

//  Preleva Array "news" TUTTE LE NOTIZIE PER COMPILARE ELENCO
$news = array();
$query = "SELECT * FROM " . Config::TNAME . " WHERE titolo LIKE '%" . $search . "%';";
$news = $conn->myCPQuery($query);


//  Preleva la notizia indicata dall' $_GET
$new = array();
if ($new_id == 0) {
  // estrai la notizia con "id" più basso (valore di default)
  $query = "SELECT * FROM " . Config::TNAME . " ORDER BY 'id' LIMIT 1";
} else {
  // estrai la notizia con "id" passato con $_GET
  $query = "SELECT * FROM " . Config::TNAME . " WHERE id = " . $new_id . ";";

}
/// QUESTA E' LA NOTIZIA PRINCIPALE
$new = $conn->myCPQuery($query);

// creo elenco colonne notizia con relativi valori
// colonne
$headers = array();
// notizia
$n = array();
// numero di colonne
$c = 0;

foreach ($new[1] as $key => $value) {
  if ($key != "id" && $key != "indice") {
    $n[$key] = $value;
    $headers[$c] = $key;
    $c++;
  }
  ;
}
;

$num_cols = $c;
// Distruggi connessione
$conn = null;


?>
<div class="container-fluid">
  <div class="grid">
    <div class="row">
      <div class="col-sm-6">
        <div class="list-group">
          <?php
          $text = "";

          // viene invocata la classe che crea la list group
          $layout = new bootLayout();
          $text = $layout->listGroup($news, $new_id, $search);
          echo ($text);
          ?>

        </div><!-- fine elenco notizie -->
      </div>

      <div class="col-sm-6">
        <!-- dati notizia -->
        <?php $titolo = $layout->datiNews($state, $new, $indice);
        echo ($titolo);
        ?>
      </div>
      <p></p>
    </div> <!-- fine riga iniziale -->
    <div class="row">

      <div id="state-buttons" class="btn-group" role="group" aria-label="Basic radio toggle button group">
        <input type="radio" class="btn-check" name="btnstate" id="read" autocomplete="off" checked
          onclick="selectState($(this), 'read');">
        <label class="btn btn-outline-primary" for="read">
          <?php echo ($services->icon("fa-eye", "fa-xl")); ?>show
        </label>

        <input type="radio" class="btn-check" name="btnstate" id="write" autocomplete="off">
        <label class="btn btn-outline-primary" for="write" onclick="selectState($(this), 'write');">
          <?php echo ($services->icon("fa-pen", "fa-xl")); ?>modify
        </label>

        <input type="radio" class="btn-check" name="btnstate" id="new" autocomplete="off">
        <label class="btn btn-outline-primary" for="new" onclick="selectState($(this), 'new');">
          <?php echo ($services->icon("fa-file", "fa-xl")); ?>new
        </label>
      </div>
    </div> <!-- fine riga tipo di azione -->
    <p></p> <!-- spazio -->
    <div class="row">
      <div class="col-sm-8">
        <h2>
          <?php if ($state != "new") {
            echo ($new[1]["titolo"]);
          } ?>
        </h2>
      </div>
      <div class="col-sm-4">
        <div id="action-buttons" style="float:right;" class="btn-group" role="group"
          aria-label="Basic radio toggle button group">
          <input type="radio" class="btn-check" name="btnaction" id="close" autocomplete="off" checked
            onclick="selectAction($(this), 'close');">
          <label class="btn btn-outline-primary" for="close">
            <?php echo ($services->icon("fa-down-left-and-up-right-to-center", "fa-xl")); ?>close
          </label>
          <input type="radio" class="btn-check" name="btnaction" id="open" autocomplete="off"
            onclick="selectAction($(this), 'open');">
          <label class="btn btn-outline-primary" for="open">
            <?php echo ($services->icon("fa-up-right-and-down-left-from-center", "fa-xl")); ?>open
          </label>
          <input type="radio" class="btn-check" name="btnaction" id="search" autocomplete="off"
            onclick="selectAction($(this), 'search');">
          <label class="btn btn-outline-primary" for="search">
            <?php echo ($services->icon("fa-search", "fa-xl")); ?>search
          </label>
        </div>
      </div>
    </div> <!-- fine riga pulsantiera -->
    <p></p> <!-- spazio -->
    <?php
    // sezione che crea le SuperCelle per poter variare, creare notizie
    $super_celle = $layout->creaSuperCelle($num_cols, $new[1], $headers, $state);
    echo ($super_celle);
    ?>
    <div class="row">

    </div> <!--  fine class="row" -->
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>

  </div> <!-- fine  Container  -->
  <script type="text/javascript">
    $(document).ready(function (event) {
      // attiva tooltips
      //$('[data-bs-toggle="tooltip"]').tooltip();

      var stato = "<?php echo ($state); ?>";
      $('#' + stato).attr("checked", "true");

      // preleva il valore del parametro ['search']
      // se esiste non provocare lo scroll
      var par = (location.search.split('search=')[1] || '').split('&')[0];
      var search = (location.search.split('search=')[1]);

      if (par == "" && search == undefined) {
        var scroll = Math.floor($("#state-buttons").offset().top);

        $("html, body").animate({ scrollTop: scroll }, 100);
      }

      //  qui verranno implementati diversi comportamenti in base
      //  allo [stato]

    });
  </script>
  <?php

  $r = upload("data");
  $r = upload("testo");
  function upload($type)
  {
    
    if (isset($_POST[$type]) && isset($_POST["id"])) {

      $value = $_POST[$type];
      $id = $_POST["id"];
      // caso speciale "data"
      if ($type === "data")   {
      (isset($_POST["data"])) ? $data = $_POST["data"] : $data = "2023/05/17";
      $new_data = strtotime($data);
      $value = $new_data;
      }

      $conn = new CPSQLiteConnection();

      //  UPDATE 
      $n = $conn->myUpdate($type, $value, $id);
      var_dump($n);
      // Distruggi connessione
      $conn = null;
      return $conn;
    }
  }


  ?>