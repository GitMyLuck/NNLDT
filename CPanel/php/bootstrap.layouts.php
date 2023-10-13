<?php
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
              <input name="search-news" class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
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
}
?>