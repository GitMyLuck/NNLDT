<?php
use CPApp\Config;

class bootLayout
{
  //Properties


  //Methods
  public function listGroup($list, $new_id, $search)
  {
    $text = '<div class="accordion" id="accordionList">
        <div class="accordion-item">
          <h2 class="accordion-header">
          <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseList" aria-expanded="true" aria-controls="collapse1">
            Elenco Notizie
          </button>
          <form class="d-flex" role="search" style="padding: 5px;">
              <input name="search" class="form-control me-2" type="search" placeholder="cerca" aria-label="Search">
              <button class="btn btn-primary" type="submit">cerca</button>
          </form>
  
          </h2>
          <div id="collapseList" class="accordion-collapse collapse show" data-bs-parent="#accordionList">
            <div class="accordion-body">' . PHP_EOL . PHP_EOL;

    $counter = 1;
    foreach ($list as $n) {
      // preparazione tooltip
      //$tooltip = "data-bs-toggle='tooltip' data-bs-title='seleziona'";
      $tooltip = "";

      //  assegnazione stato active al button attivo
      $selected = "\"";

      //  se il valore di $new_id = 1 cioè "DEFAULT" al primo giro assegna la prop SELECTED
      //  alla prima voce, oppure se il valore di $new_id é assegnato metti la voce corrispondente
      //  su selezionato
      (($n['id'] == $new_id) || ($new_id == 0 && $counter == 1)) ? $selected = "active\" aria-current=\"true\"" : $selected = "\"";

      // prepariamo il titolo
      $titolo = $this->searchEvident($n['titolo'], $search);
      $indice = $n['indice'];
      $text .= '<button type="button" id="' . $n['indice'] . '" name="' . $n['id'] . '" class="list-group-item list-group-item-action ' . $selected . ' onclick="listClick($(this));"' . PHP_EOL;
      $text .= $tooltip . '>' . PHP_EOL;
      $text .= $indice . ' - ' . $titolo . '</button>' . PHP_EOL;
      $counter++;
    }

    $text .= '</div>
        </div>
      </div>
    </div> <!-- fine  accordionList  -->';

    return $text;
  }

  //  Funzione che crea ed organizza i dati principali dela notizia
  /**
   * Summary of datiNews
   * @param   string  $stato
   * @param   array   $new
   * @return  string  $html
   */
  public function datiNews($stato, $new, $indice)
  {
    $html = "";
    // linea n° + titolo
    if ($stato != "new") {
      $html .= "<h1>";
      $html .= $indice . "  -  " . $new[1]["titolo"];
      $html .= "</h1>" . PHP_EOL;
      $html .= "<h2>";
      $html .= $new[1]["sottotitolo"];
      $html .= "</h2>" . PHP_EOL;
    }

    return $html;
  }


  //  Funzione che cerca nella stringa passata come argomento
  //  la ricorrenza della sottostringa (anch'essa passata come argomento)
  //  e restituisce la stringa originaria con la ricorrenza evidenziata 
  //  attraverso la classe "search-success"
  public function searchEvident($string, $search)
  {
    $stringa = "";
    //trova la sequenza di caratteri
    $i = stripos($string, $search);
    $ls = strlen($search);
    $rest = (strlen($string) - ($ls + $i));

    $stringa = substr($string, 0, $i) . "<span class='search-success'>" . $search . "</span>" . substr($string, ($ls + $i), $rest);
    return $stringa;


  }

  public function disableState($stato)
  {
    // viene selezionata la stringa "disabled" a seconda del valore di stato
    // passato   "read" o "write"
    $disabled = "";
    ($stato == "read" || $stato == "") ? $disabled = "disabled" : $disabled;
    ($stato == "write" || $stato == "new") ? $disabled = "" : $disabled;

    // la stringa viene restituita
    return $disabled;

  }
  public function creaSuperCelle($cols, $new, $headers, $state)
  {
    // $cols = numero delle colonne della tabella
    // $columns = array $colonna => valore
    // $headers = intestazione colonne (fornisce i nomi delle supercelle)
    // $state = indica lo stato per costruire la pagina

    //  creo istanza classe services
    include_once "funct.class.php";
    $service = new services();
    //  contatore generale delle SuperCelle
    $counter = 0;

    //  numero di SuperCelle ($cols)
    //  elenco completo chiavi->valori delle SuperCelle
    //  per la notizia corrente  ($new)

    //  divido il totale SuperCelle per 3 (Tante sono le SuperCelle di una row)
    $rows = floor($cols / 3);
    //  qui depongo il resto
    $lasts = $cols - ($rows * 3);

    ($lasts != 0) ? $rows++ : $rows;

    //inizia il ciclo di creazione delle righe 
    $text = "" . PHP_EOL;
    for ($r = 1; $r <= $rows; $r++) {
      $text .= '<div class="row">' . PHP_EOL;
      // all'interno inserisco le tre colonne che conterranno le SuperCelle
      for ($c = 1; $c <= 3; $c++) {
        if ($counter < $cols) {
          $largTesto = "4";
          $campo = $headers[$counter];

          // preparo eccezione form testo
          if (($c == 1 && $campo == "testo") || ($c == 2 && $campo == "testo")) {
            $largTesto = "8";
            $c++;
          } else if (($c == 3 && $campo == "testo")) {
            $largTesto = "12";
            $c = 0;
            $r++;
          }
          // fine eccezione form testo

          // apertura riga
          $text .= Config::TAB1 . '<div class="col-sm-' . $largTesto . '">' . PHP_EOL;
          // accordion
          $text .= Config::TAB2 . '<div class="accordion" id="accordion' . $counter . '">' . PHP_EOL;
          // contenitore accordion
          $text .= Config::TAB3 . '<div class="accordion-item">' . PHP_EOL;
          //  intestazione accordion con titolo
          $text .= Config::TAB4 . '<h2 class="accordion-header">' . PHP_EOL;
          //  button intestazione accordion
          $text .= Config::TAB5 . '<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse' . $counter . '"
                aria-expanded="false" aria-controls="collapse' . $counter . '">' . PHP_EOL;
          // nome della SuperCella = nome colonna
          $text .= Config::TAB5 . ucfirst($campo) . PHP_EOL;
          // chiusura button intestazione
          $text .= Config::TAB5 . '</button>' . PHP_EOL;
          // chiusura intestazione accordion
          $text .= Config::TAB4 . '</h2><!-- fine Accordion Header -->' . PHP_EOL;
          //  corpo dell'accordion
          $text .= Config::TAB4 . '<div id="collapse' . $counter . '" class="accordion-collapse show" data-bs-parent="#accordion' . $counter . '">' . PHP_EOL;
          //  corpo vero e proprio
          $text .= Config::TAB5 . '<div class="accordion-body">' . PHP_EOL;

          $id = $new["id"];
          $disabled = $this->disableState($state);
          $sendBtn = $service->sendBtn($disabled);
          //  inizio del form
          $text .= <<<EOT

                    <form action="general.php" method="POST">
                  
                      <div class="row">
EOT;

          // si preparano i parametri per chiamare la funzione di costruzione
          // dei contenuti della SuperCella
          $value = null;
          // caso read - write - default
          if ($state == "read" || $state == "write" || $state == "") {
            $header = $headers[$counter];
            $value = $new[$header];
          }
          // qui andra' inserito per ogni SuperCella input del relativo 
          // dato da visualizzare, variare, cancellare
          // dato diverso per tipo diverso
          switch ($headers[$counter]) {
            // in base al tipo usa una diversa function per la costruzione
            case "data":
              
              $text .= Config::TAB6;
              $text .= $this->SuperCellaData($disabled, $value, $id);
              break;
            case "testo":
              $text .= Config::TAB6;
              $text .= $this->SuperCellaTesto($disabled, $value, $id);
              break;
            case "data_evento":
              $text .= Config::TAB6;
              $text .= $this->SuperCellaDataEvento($disabled, $value, $id);
              break;
            case "titolo":
                $text .= Config::TAB6;
                $text .= $this->SuperCellaTitolo($disabled, $value, $id);
                break;
            default:
              // default running code here
              $text .= Config::TAB6 . '<p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>' . PHP_EOL;

          }

          //    chiusura della row contenuta nel form
          $text .= <<<EOT
                          <input type="hidden" name="id" value="$id">
                      </div>
                      <hr>
              $sendBtn
                </form>
EOT;

          $text .= PHP_EOL;
          // chiusura del corpo accordion
          $text .= Config::TAB5 . '</div><!-- fine accordion-body -->' . PHP_EOL;
          $text .= Config::TAB4 . '</div><!-- fine accordion -->' . PHP_EOL;
          // chiusura contenitore accordion
          $text .= Config::TAB3 . '</div> <!-- fine  Accordion-item  -->' . PHP_EOL;
          // chiusura accordion
          $text .= Config::TAB2 . '</div> <!-- fine  accordion' . $counter . ' -->' . PHP_EOL;
          // chiusura riga
          $text .= Config::TAB1 . '</div> <!-- fine  colonna -->' . PHP_EOL;
          // incremento contatore
          $counter++;
        } // end if conteggio headers
      }
      $text .= '</div> <!--  fine class="row" -->' . PHP_EOL;
    }
    return $text;


  }

  //       data     
  /**
   * Summary of SuperCellaData
   * @param   string  $disabled  valore di disabilità dato dallo stato dell'app (read, write, new)
   * @param   string  $value      valore in questo caso la data
   * @param   string  $id         id univoco del record per indirizzare variazione
   * @return  string  $newT..
   */
  public function SuperCellaData($disabled, $value, $id)
  {
    
    // per stato "new" $value = today
    ($value == null || $value == "") ? $date = date('Y-m-d', time()) : $date = date('Y-m-d', $value);

    
    $newT = <<<EOT

                          <label class="active" for="StandardData">Data</label>
                          <input type="date" class="special-date" id="StandardData" name="data" value="$date" $disabled>
EOT;

    $newT .= PHP_EOL;
    return $newT;
  } // end of creaSuperCellaData

  //       testo    
  /**
   * Summary of SuperCellaData
   * @param   string  $disabled  valore di disabilità dato dallo stato dell'app (read, write, new)
   * @param   string  $value      valore in questo caso il testo della notizia
   * @param   string  $id         id univoco del record per indirizzare variazione
   * @return  string  $newT..
   */
  public function SuperCellaTesto($disabled, $value, $id)
  {
    $newT = <<<EOT

                          <textarea class="form-control" name="testo" aria-label="inserisci testo" $disabled >$value</textarea>
EOT;

    return $newT;
  }


  //       data_evento    
  /**
   * Summary of SuperCellaDataEvento
   * @param   string  $disabled  valore di disabilità dato dallo stato dell'app (read, write, new)
   * @param   string  $value  valore data_evento
   * @param   string  $id     id univoco del record per indirizzare variazione
   * @return  string  $newT..
   */
  public function SuperCellaDataEvento($disabled, $value, $id)
  {
    
    // per stato "new" $value = today
    ($value == null || $value == "") ? $date = date('Y-m-d', time()) : $date = date('Y-m-d', $value);

    $newT = <<<EOT
                          <label class="active" for="StandardData">Data Evento</label>
                          <input type="date" class="special-date" id="StandardData" name="data_evento" value="$date" $disabled>
                    
EOT;
    $newT .= PHP_EOL;
    return $newT;
  } // end of creaSuperCellaDataEvento


  //       titolo    
  /**
   * Summary of SuperCellaDataEvento
   * @param   string  $disabled   valore di disabilità dato dallo stato dell'app (read, write, new)
   * @param   string  $value      valore titolo
   * @param   string  $id         id univoco del record per indirizzare variazione
   * @return  string  $newT..
   */
  public function SuperCellaTitolo($disabled, $value, $id)
  {
    
    $newT = <<<EOT

                <label for="titolo" class="active">Titolo Della Notizia</label>
                <input type="text" class="form-control special-date" name="titolo" id="titolo" placeholder="titolo.." value="$value">
EOT;

    return $newT;
  }
} // end of class

?>