<?php

class Services
{

  // Properties


  // Methods

  public function validate($data)
  {
    // questa funzione sanitizza i dati passati come parametri
    // nei forms
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  // Metodo per inserire direttamente nella pagina html icona
  public function icon($type, $size)
  {
    $html = '<i class="fa-solid ';
    $html .= $type . ' ' . $size . '"';
    $html .= '></i>&nbsp;';
    return $html;
  }

  
}
?>