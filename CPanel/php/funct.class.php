<?php
use CPApp\CPSQLiteConnection;
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

  /**
   *  Summary of icon
   *  Metodo per inserire direttamente nella pagina html icona
   * @param   string    $type       il testo che richiama l'icona di FontAwesome (es. "fa-arrow-right")
   * @param   string    $size       la dimensione di Font Awesome (es. "fa-xl")
   * @return  string    $html       il testo html che serve per disegnare l'icona
   */
  public function icon($type, $size)
  {
    $html = '<i class="fa-solid ';
    $html .= $type . ' ' . $size . '"';
    $html .= '></i>&nbsp;';
    return $html;
  }

  /**
   * Summary of sendBtn               20231105-Avalon
   * @param     string    $disabled   stato di disabilità del button in base allo stato
   *                                  (read, write o new)
   * @return    string    $html       il testo html per disegnare il button
   */
  public function sendBtn($disabled)
  {
    $html = <<<EOT
                <div class="row">
                    <div class="col-sm-8">
                        <p>&nbsp;</p>
                    </div>
                    <div class="col-sm-4">
                        <button type="send" class="btn btn-primary special-button justify-content-md-end" id="sendButton" title="invia" $disabled >
                            <i class="fa-solid fa-arrow-fas fa-arrow-right fa-xl"></i>
                        </button>
                    </div>
                </div>
EOT;
    $html .= PHP_EOL;
    return $html;
  }


  /**
   * Summary of upload
   * @param     string      $type     tipo di input ("data", "testo", "firma", ecc.)
   * @param     array       $array    array intestazione POST
   * @return    null
   */
  public function upload($type, $array)
  {
    
    if (isset($array[$type]) && isset($array["id"])) {

      $value = $array[$type];
      $id = $array["id"];
      // caso speciale "data"
      if ($type === "data")   {
      (isset($array["data"])) ? $data = $array["data"] : $data = "2023/05/17";
      $new_data = strtotime($data);
      $value = $new_data;
      }

      $conn = new CPSQLiteConnection();

      //  UPDATE 
      $n = $conn->myUpdate($type, $value, $id);
      var_dump($n);
      // Distruggi connessione
      $conn = null;
      return $conn;
    }
  }
}
?>