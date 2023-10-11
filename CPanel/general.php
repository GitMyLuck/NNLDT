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
$new_id = 1;
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

//  Preleva Array "news"   {es Titolo = $news['titolo']}
$news = array();
$query = "SELECT * FROM news WHERE titolo LIKE '%" . $search . "%';";
$news = $conn->myCPQuery($query);

// Distruggi connessione
$conn = null;


?>
<div class="container-fluid">
  <div class="grid">
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

    <p></p>
    <div class="row">
      <div class="col-sm-4">
        <div class="accordion" id="accordion1">
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1"
                aria-expanded="false" aria-controls="collapse1">
                Data Pubblicazione
              </button>
            </h2>
            <div id="collapse1" class="accordion-collapse collapse" data-bs-parent="#accordion1">
              <div class="accordion-body">
                <strong>This is the first item's accordion body.</strong> It is shown by default, until the collapse
                plugin adds the appropriate classes that we use to style each element. These classes control the overall
                appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with
                custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go
                within the <code>.accordion-body</code>, though the transition does limit overflow.
              </div>
            </div>
          </div> <!-- fine  Accordion-item  -->
        </div> <!-- fine  accordion1  -->
      </div> <!-- fine  colonna -->



      <div class="col-sm-4">
        <div class="accordion" id="accordion2">
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button class="accordion-button" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapse2" aria-expanded="true" aria-controls="collapse2">
                Titolo
              </button>
            </h2>
            <div id="collapse2" class="accordion-collapse collapse show" data-bs-parent="#accordion2">
              <div class="accordion-body">
                <!-- FORM Titolo  -->
                <form method="POST" name="titolo" class="row g-3">
                  <div class="col-auto">
                    <label for="staticTitolo" class="visually-hidden">Titolo</label>
                    <input type="text" readonly class="form-control-plaintext" id="staticTitolo"
                      value="Titolo della notizia">
                  </div>
                  <div class="col-auto">
                    <label for="inputTitolo" class="visually-hidden"></label>
                    <input type="text" class="form-control" name="titoloNotizia" id="inputTitolo"
                      placeholder="text here...">
                  </div>
                  <div class="col-auto">
                    <button type="submit" class="btn btn-primary mb-5">Invia</button>
                  </div>
                </form>
              </div>
            </div>
          </div> <!-- fine  Accordion-item  -->
        </div> <!-- fine  accordion2 -->
      </div> <!-- fine colonna accordion2 -->
    </div> <!-- fine riga accordions -->
  </div> <!-- fine  Container  -->