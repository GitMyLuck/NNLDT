<?php
class bootLayout
{
    //Properties


    //Methods
    public function listGroup($list, $new_id)
    {
        $text = '<div class="accordion" id="accordionList">
        <div class="accordion-item">
          <h2 class="accordion-header">

            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseList"
              aria-expanded="true" aria-controls="collapse1">
              Elenco News
            </button>
          </h2>
          <div id="collapseList" class="accordion-collapse" data-bs-parent="#accordionList">
            <div class="accordion-body">' . PHP_EOL;

        foreach ($list as $n)
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

        $text .= '</div>
        </div>
      </div> <!-- fine  Accordion-item  -->
    </div> <!-- fine  accordion1  -->';

        return $text;
    }

}
?>