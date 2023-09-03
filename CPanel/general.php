<?php
            
            include "views/head.php";
            include "CPApp/Config.php";
            use CPApp\Config;
            echo PHP_EOL . "<title>" . Config::GENERAL_PAGE . "</title>" . PHP_EOL;
            echo "</head>";
            echo PHP_EOL . "<body>" . PHP_EOL;
?>
<div class="container-fluid">
<div class="text-center">
  <div class="spinner-border" role="status">
    
  </div>
</div>
<div class="grid">
<div class="col" style="background-color: blue;border-radius: 5px;">
<h2>  Elenco Notizie</h2>
<!--  inserire qua il inputs  -->
<div class="list-group">
  <button type="button" class="list-group-item list-group-item-action active" aria-current="true">
    Button selezionato
  </button>
  <button type="button" class="list-group-item list-group-item-action">Altra notizia</button>
  <button type="button" class="list-group-item list-group-item-action">Titolo altra notizia ancora</button>
  <button type="button" class="list-group-item list-group-item-action">ancora una notizia...</button>
  <!--<button type="button" class="list-group-item list-group-item-action" disabled>A disabled button item</button>-->
</div>
</div> 

<p></p>

<div class="col">
<div class="accordion" id="accordionExample">
  <div class="accordion-item">
    <h2 class="accordion-header">
      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="false" aria-controls="collapse1">
        Data Pubblicazione
      </button>
    </h2>
    <div id="collapse1" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
      <div class="accordion-body">
        <strong>This is the first item's accordion body.</strong> It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
      </div>
    </div>
  </div>    <!-- fine  Accordion-item  -->
  <div class="accordion-item">
    <h2 class="accordion-header">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2" aria-expanded="false" aria-controls="collapse2">
        Titolo
      </button>
    </h2>
    <div id="collapse2" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
      <div class="accordion-body">
      <!-- FORM Titolo  -->
      <form method="POST" name="titolo" class="row g-3">
            <div class="col-auto">
            <label for="staticTitolo" class="visually-hidden">Titolo</label>
            <input type="text" readonly class="form-control-plaintext" id="staticTitolo" value="Titolo della notizia">
          </div>
          <div class="col-auto">
            <label for="inputTitolo" class="visually-hidden"></label>
            <input type="text" class="form-control" name="titoloNotizia" id="inputTitolo" placeholder="text here...">
          </div>
          <div class="col-auto">
            <button type="submit" class="btn btn-primary mb-3">Invia</button>
          </div>
      </form>
      </div>
    </div>
  </div>    <!-- fine  Accordion-item  -->
  <div class="accordion-item">
    <h2 class="accordion-header">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3" aria-expanded="false" aria-controls="collapse3">
        Sottotitolo
      </button>
    </h2>
    <div id="collapse3" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
      <div class="accordion-body">
        <strong>This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
      </div>
    </div>
  </div>    <!-- fine  Accordion-item  -->
  <div class="accordion-item">
    <h2 class="accordion-header">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse4" aria-expanded="false" aria-controls="collapse4">
        Testo
      </button>
    </h2>
    <div id="collapse4" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
      <div class="accordion-body">
        <strong>This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
      </div>
    </div>
  </div>    <!-- fine  Accordion-item  -->
  <div class="accordion-item">
    <h2 class="accordion-header">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse5" aria-expanded="false" aria-controls="collapse5">
        Data Evento
      </button>
    </h2>
    <div id="collapse5" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
      <div class="accordion-body">
        <strong>This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
      </div>
    </div>
  </div>    <!-- fine  Accordion-item  -->
  <div class="accordion-item">
    <h2 class="accordion-header">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse6" aria-expanded="false" aria-controls="collapse6">
        Firma
      </button>
    </h2>
    <div id="collapse6" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
      <div class="accordion-body">
        <strong>This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
      </div>
    </div>
  </div>    <!-- fine  Accordion-item  -->
</div>  <!-- fine  Accordion  -->
</div>  <!-- fine  Accordion Row  -->
</div>
</div>  <!-- fine  Container  -->