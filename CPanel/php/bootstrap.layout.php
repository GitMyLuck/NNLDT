<?php
class bootLayout
{
    //Properties


    //Methods
    public function listGroup($list, $new_id)
    {
        $text = "";
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

        return $text;
    }

}
?>