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
$new = $conn->myCPQuery($query);

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
  </div>
    


      
      
  </div> <!-- fine  Container  -->