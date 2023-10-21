<?php

include "views/head.php";
include "CPApp/SQLiteConnection.php";
include "php/bootstrap.layouts.php";
include "php/funct.class.php";
use CPApp\Config;

echo PHP_EOL . "<title>" . Config::GENERAL_PAGE . "</title>" . PHP_EOL;
echo "</head>";
echo PHP_EOL . "<body>" . PHP_EOL;

//  valore id della notizia di default
$new_id = 0;
//  eventuale valore id ricevuto con il $_GET 
if (isset($_GET["id"])){
  $new_id = $_GET["id"];
};
// valore search di default
$search = "";

//  eventuale valore ricerca passato con il $_GET
if (isset($_GET["search-news"])){
  // sanitizzo comunque il dato inserito nel form SEARCH
  $san_search = new Services();
  $search = $san_search->validate($_GET["search-news"]);
};

//  Apri la connessione con il DB
use CPApp\CPSQLiteConnection;
$conn = new CPSQLiteConnection();

//  Preleva Array "news" TUTTE LE NOTIZIE PER COMPILARE ELENCO
$news = array();
$query = "SELECT * FROM news WHERE titolo LIKE '%" . $search . "%';";
$news = $conn->myCPQuery($query);


//  Preleva la notizia indicata dall' $_GET
$new = array();
if ( $new_id == 0){
  // estrai la notizia con "id" più basso (valore di default)
  $query = "SELECT * FROM news ORDER BY 'id' LIMIT 1";
}else{
  // estrai la notizia con "id" passato con $_GET
    $query = "SELECT * FROM news WHERE id = " . $new_id . ";";
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

foreach ($new[0] as $key => $value) {
  if ( $key != "id" ) {
        $n[$key] = $value;
        $headers[$c] = $key;
        $c++;
  };
};
$num_cols = $c;
// Distruggi connessione
$conn = null;


?>
<div class="container-fluid">
  <div class="grid">
  <div class="row">
    <div class="col-sm-6" >
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

    <div class="col-sm-5" >
      <h1><?php echo ($new[0]["titolo"]);?></h1>
    </div>
    <p></p>
  </div> <!-- fine riga iniziale -->
  <?php
        // sezione che crea le SuperCelle per poter variare, creare notizie
        $super_celle = $layout->creaSuperCelle($num_cols, $n, $headers);
        echo ($super_celle);
  ?>
  <div class="row">
<p>&nbsp;</p><p>&nbsp;</p>
<hr>
<div class="col-sm-4">
  <div class="accordion" id="accordion158">
    <div class="accordion-item">
      <h2 class="accordion-header">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse158"
          aria-expanded="false" aria-controls="collapse158">
          Data
        </button>
      </h2>
      <div id="collapse158" class="accordion-collapse collapse" data-bs-parent="#accordion158">
        <div class="accordion-body">
        <form action="general.php" method="POST">
        <div class="row">
          <div>Qui vanno inserite le eventuali istruzioni.</div>
        </div>
        <hr>
        <div class="row">
        <label class="active" for="dateStandard">Data</label>
        <input type="date" class="special-date" id="dateStandard" name="data">
        </div>
        <hr>
        <div class="row">
        <div class="col-sm-4">
        <button type="send" class="btn btn-primary special-button" id="sendButton" >invia</button>
        </div>
        <div class="col-sm-4">
        <button type="send" class="btn btn-primary special-button" id="sendButton" >invia</button>
        </div>
        <div class="col-sm-4">
        <button type="send" class="btn btn-primary special-button" id="sendButton" >invia</button>
        </div>
        </div>
        </form>
        </div>
      </div>
    </div> <!-- fine  Accordion-item  -->
  </div> <!-- fine  accordion1  -->
</div> <!-- fine  colonna -->

</div> <!--  fine class="row" -->
<p>&nbsp;</p><p>&nbsp;</p> 
<p>&nbsp;</p><p>&nbsp;</p>
<p>&nbsp;</p><p>&nbsp;</p>
      
  </div> <!-- fine  Container  -->

  <?php
  if(isset($_POST["data"])) {  
        
        $data = "";
        (isset($_POST["data"]))?$data = $_POST["data"] : $data = "2023/05/17";
        $new_data = strtotime($data);
        
      
        $conn = new CPSQLiteConnection();

        //  UPDATE DATA 
        $query = "UPDATE news SET data = \"" . $new_data . "\" WHERE id = 5";
        $n = $conn->myCPQuery($query);
        // Distruggi connessione
        $conn = null;


    }

?>