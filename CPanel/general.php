<?php
//  valore Id passato come parametro dalla chiamata
$new_id = 2;


include "views/head.php";
include "CPApp/SQLiteConnection.php";
use CPApp\Config;

echo PHP_EOL . "<title>" . Config::GENERAL_PAGE . "</title>" . PHP_EOL;
echo "</head>";
echo PHP_EOL . "<body>" . PHP_EOL;

//  Apri la connessione con il DB
use CPApp\CPSQLiteConnection;
$conn = new CPSQLiteConnection();

//  Preleva Array "news"   {es Titolo = $news['titolo']}
$news = array();
$query = "SELECT * FROM news";
$news = $conn->myCPQuery($query);

// Distruggi connessione
$conn = null;

?>
<div class="container-fluid">
  <div class="grid">
    <div class="col-sm-6" style="background-color: #5076a0;border-radius: 5px;">
      <h2> Elenco Notizie</h2>
      <!--  inserire qua il inputs  -->
      <div class="list-group">
        <?php
        $text = "";
        //  qui viene preparata la list group relativa alle notizie
        foreach ($news as $n)
        {
          // preparazione tooltip
          $tooltip = "data-bs-toggle='tooltip' data-bs-placement='right' data-bs-title='seleziona'";

          //  assegnazione stato active al button attivo
          $selected = "\"";
          ($n['id'] == $new_id)?$selected = "active\" aria-current=\"true\"" : $selected = "\"";

          $text .= '<button type="button" name="' . $n['id'] . '" class="list-group-item list-group-item-action ' . $selected . ' onclick="listClick($(this));"' . PHP_EOL;
          $text .= $tooltip . '>' .PHP_EOL;
          $text .= $n['titolo'] . '</button>' . PHP_EOL;

        }
        //exit(var_dump($news));
        echo ($text);
        ?>
        
      </div>
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