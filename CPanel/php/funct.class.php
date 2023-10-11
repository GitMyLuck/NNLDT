
<?php

class Services {

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


}
?>