
<div id="myCarousel" class="carousel slide mb-6" data-bs-ride="carousel" data-bs-theme="light">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
    <?php

          // rileva il numero di notizie contenute nella tabella 'news'
          $num_news = count($news);

          for ($n = 0 ; $n < $num_news ; $n++)
          {
            
          // testo introduttivo ... (parte del testo dell'articolo troncato
          // verso il 35 carattere o allo spazio immeditamente successivo)
          $longString = $news[$n]["testo"];
          $intro = substr($longString,0,strpos($longString,' ',35)) . " ...";
            
          $active = "";
          ($n == 0)?$active = "active" : $active;
          // costruzione del carousel per le notizie
          $text = "<div class=\"carousel-item " . $active . "\">" . PHP_EOL .
                  "<div class=\"container\">" . PHP_EOL .
                  "<img class=\"carousel-img\" src=\"images/image" . $news[$n]["id"] . ".jpg\" alt=\"Immagine" . $news[$n]["id"] . "\" title=\"Immagine" . $news[$n]["id"] . "\">" . PHP_EOL;

          $text .= "<div class=\"carousel-caption text-start\">" . PHP_EOL .
                   "<h1>" . $news[$n]["titolo"] . "</h1>" . PHP_EOL . 
                   "<p class=\"opacity-75\">" . $intro . "</p>" . PHP_EOL;

          $text .= "<p><a class=\"btn btn-lg btn-primary\" href=\"#\">Leggi ...</a></p>" . PHP_EOL .
                   "</div></div></div>" . PHP_EOL;

          
          echo $text;

          }
    ?>
    </div> <!-- end carousel-inner -->
    <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>