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
            Elenco News
          </button>
          <form class="d-flex" role="search" style="padding: 5px;">
              <input name="search" class="form-control me-2" type="search" placeholder="cerca" aria-label="Search">
              <button class="btn btn-primary" type="submit">cerca</button>
          </form>
  
          </h2>
          <div id="collapseList" class="accordion-collapse collapse show" data-bs-parent="#accordionList">
            <div class="accordion-body">' . PHP_EOL . PHP_EOL;

        $counter = 1;
        foreach ($list as $n)
        {
          // preparazione tooltip
          //$tooltip = "data-bs-toggle='tooltip' data-bs-title='seleziona'";
          $tooltip = "";
          
          //  assegnazione stato active al button attivo
          $selected = "\"";

          //  se il valore di $new_id = 1 cioè "DEFAULT" al primo giro assegna la prop SELECTED
          //  alla prima voce, oppure se il valore di $new_id é assegnato metti la voce corrispondente
          //  su selezionato
          (($n['id'] == $new_id) || ($new_id == 0 && $counter == 1))?$selected = "active\" aria-current=\"true\"" : $selected = "\"";

          // prepariamo il titolo
          $titolo = $this->searchEvident($n['titolo'], $search);
          $text .= '<button type="button" name="' . $n['id'] . '" class="list-group-item list-group-item-action ' . $selected . ' onclick="listClick($(this));"' . PHP_EOL;
          $text .= $tooltip . '>' .PHP_EOL;
          $text .= $titolo . '</button>' . PHP_EOL;
          $counter ++;
        }

        $text .= '</div>
        </div>
      </div>
    </div> <!-- fine  accordionList  -->';

        return $text;
    }


    //  Funzione che cerca nella stringa passata come argomento
    //  la ricorrenza della sottostringa (anch'essa passata come argomento)
    //  e restituisce la stringa originaria con la ricorrenza evidenziata 
    //  attraverso la classe "search-success"
    public function searchEvident( $string, $search )
					{
								$stringa = "";
								//trova la sequenza di caratteri
								$i = stripos( $string, $search );
								$ls = strlen( $search );
								$rest = (strlen ( $string ) - ( $ls + $i ));
								
								$stringa = substr( $string, 0, $i ) . "<span class='search-success'>" . $search . "</span>" . substr( $string, ($ls + $i), $rest);
								return $stringa;
					
					
					}

    public function disableState($stato)  {
        // viene selezionata la stringa "disabled" a seconda del valore di stato
        // passato   "read" o "write"
        $disabled = "";
        ($stato == "read" || $stato == "")? $disabled = "disabled" : $disabled;
        ($stato == "write" || $stato == "new")? $disabled = "" : $disabled;

        // la stringa viene restituita
        return $disabled;

    }
    public function creaSuperCelle($cols, $new, $headers, $state)
    {
      // $cols = numero delle colonne della tabella
      // $columns = array $colonna => valore
      // $headers = intestazione colonne (fornisce i nomi delle supercelle)
      // $state = indica lo stato per costruire la pagina

      
      //  contatore generale delle SuperCelle
      $counter = 0;

      //  numero di SuperCelle ($cols)
      //  elenco completo chiavi->valori delle SuperCelle
      //  per la notizia corrente  ($new)

      //  divido il totale SuperCelle per 3 (Tante sono le SuperCelle di una row)
      $rows = floor($cols / 3);
      //  qui depongo il resto
      $lasts = $cols - ($rows * 3);

      ($lasts != 0)?$rows++:$rows;

      //inizia il ciclo di creazione delle righe 
      $text = ""  . PHP_EOL;
      for( $r = 1; $r <= $rows; $r++) {
          $text .= '<div class="row">' . PHP_EOL;
            // all'interno inserisco le tre colonne che conterranno le SuperCelle
            for( $c = 1; $c <= 3; $c ++)  {
              if ( $counter < $cols) {
              // preparo eccezzione form testo
              $largTesto = "4";
              $campo = $headers[$counter];
              if ( ($c == 1 && $campo == "testo") || ($c == 2 && $campo == "testo"))
                  {
                    $largTesto = "8";
                    $c++;
                  }
              else if( ($c == 3 && $campo == "testo") )
                  {
                    $largTesto = "12";
                    $c=0;
                    $r++;                    
                  }
                // apertura riga
                $text .= Config::TAB1 . '<div class="col-sm-' . $largTesto . '">'  . PHP_EOL;
                // accordion
                $text .= Config::TAB2 .'<div class="accordion" id="accordion'  . $counter . '">' . PHP_EOL;
                // contenitore accordion
                $text .= Config::TAB3 . '<div class="accordion-item">' . PHP_EOL;
                //  intestazione accordion con titolo
                $text .= Config::TAB4 . '<h2 class="accordion-header">' . PHP_EOL;
                //  button intestazione accordion
                $text .= Config::TAB5 . '<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse' . $counter . '"
                aria-expanded="false" aria-controls="collapse' . $counter . '">' . PHP_EOL;
                // nome della SuperCella = nome colonna
                $text .= Config::TAB5 . ucfirst($campo) . PHP_EOL;
                // chiusura button intestazione
                $text .= Config::TAB5 . '</button>' . PHP_EOL;
                // chiusura intestazione accordion
                $text .= Config::TAB4 . '</h2><!-- fine Accordion Header -->' . PHP_EOL;
                //  corpo dell'accordion
                $text .= Config::TAB4 . '<div id="collapse' . $counter . '" class="accordion-collapse collapse" data-bs-parent="#accordion' . $counter . '">' . PHP_EOL;
                //  corpo vero e proprio
                $text .= Config::TAB5 . '<div class="accordion-body">' . PHP_EOL;

                // si preparano i parametri per chiamare la funzione di costruzione
                // della SuperCella
                $n = null;
                // caso read - write - default
                if ($state == "read" || $state == "write" || $state == "")  {
                  $header = $headers[$counter];
                  $n = $new[$header];
                }
                // qui andra' inserito per ogni SuperCella input del relativo 
                // dato da visualizzare, variare, cancellare
                // dato diverso per tipo diverso
                switch ($headers[$counter])  {
                          // in base al tipo usa una diversa function per la costruzione
                          case "data":
                            // tipo di dato data
                            $header = "data";
                            
                            $text .= Config::TAB6;
                            $text .= $this->SuperCellaData($state, $header, $n);
                          break;
                          case "testo":
                            $header = "testo";
                            
                            $text .= Config::TAB6;
                            $text .= $this->SuperCellaTesto($state, $header, $n);
                          break;
                          default :
                            // default running code here
                            $text .= Config::TAB6 . '<p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>' . PHP_EOL;

                }


                // chiusura del corpo accordion
                $text .= Config::TAB5 . '</div><!-- fine accordion-body -->' . PHP_EOL;
                $text .= Config::TAB4 . '</div><!-- fine accordion -->' . PHP_EOL;
                // chiusura contenitore accordion
                $text .= Config::TAB3 . '</div> <!-- fine  Accordion-item  -->' . PHP_EOL;
                // chiusura accordion
                $text .= Config::TAB2 .'</div> <!-- fine  accordion'  . $counter . ' -->' . PHP_EOL;
                // chiusura riga
                $text .= Config::TAB1  . '</div> <!-- fine  colonna -->'  . PHP_EOL;
                // incremento contatore
                $counter++;
               } // end if conteggio headers
            }
          $text .= '</div> <!--  fine class="row" -->' . PHP_EOL;
      }
      return $text;
      

    }

    //       data     
    public function SuperCellaData($stato, $key, $value) {
        // per stato "new" $value = today
        ($value == null || $value == "")?$date = date('Y-m-d', time()):$date = date('Y-m-d', $value);
       
        $disabled = $this->disableState($stato);

        // stringa istruzioni
        $istruzioni = "Data della notizia.";
        $newT = "";
          $newT = <<<EOT


          <form action="general.php" method="POST">
                  <div class="row">
                    <div class="instructions">$istruzioni</div>
                  </div>
              <hr>
                  <div class="row">
                    <label class="active" for="Standard$key">$key</label>
                    <input type="date" class="special-date" id="Standard$key" name="$key" value="$date" $disabled>
                  </div>
              <hr>
                  <div class="row">
                    <div class="col-sm-8">
                      <p>&nbsp;</p>
                    </div>
                    <div class="col-sm-4">
                      <button type="send" class="btn btn-primary special-button" id="sendButton" $disabled >invia</button>
                    </div>
                  </div>
          </form>
EOT;
        $newT .= PHP_EOL;
        return $newT;
      }// end of creaSuperCellaData

public function SuperCellaTesto($stato, $key, $value)   {
        $newT = "";
        $istruzioni = "Qui di seguito va inserito il testo della notizia...";
        $disabled = $this->disableState($stato);
        $newT = <<<EOT

        <form action="general.php" method="POST">
			<div class="row">
				<div class="instructions">$istruzioni.</div>
			</div>
        <hr>
			<div class="row">
				<textarea class="form-control" name="$key" aria-label="inserisci testo" $disabled >$value</textarea>
			</div>
        <hr>
			<div class="row">
					<div class="col-sm-4">
					<p>&nbsp;</p>
					</div>
					<div class="col-sm-4">
					<p>&nbsp;</p>
					</div>
					<div class="col-sm-4">
					<button type="send" class="btn btn-primary special-button" id="sendButton" $disabled>invia</button>
					</div>
			</div>
        </form>
EOT;

        return $newT;
      }

} // end of class

?>