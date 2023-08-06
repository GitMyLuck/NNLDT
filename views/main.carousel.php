
<div id="myCarousel" class="carousel slide mb-6" data-bs-ride="carousel" data-bs-theme="light">
    <div class="carousel-indicators">
      <?php
            // rileva il numero di notizie contenute nella tabella 'news'
            $num_news = count($news);
            for ($n = 0 ; $n < $num_news ; $n++)
            {
            // class 'active per i pulsanti di navigazione
            $active = "";
            ($n == 0)?$active = "class=\"active\"" : $active;

            $plus = $n + 1;

            echo <<<HEREDOC
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="$n" $active aria-current="true" aria-label="Slide $plus"></button>
HEREDOC;
          }

      ?>
    </div>
    <div class="carousel-inner">
    <?php
          $data = "";

          for ($n = 0 ; $n < $num_news ; $n++)
          {
            
          // testo introduttivo ... (parte del testo dell'articolo troncato
          // verso il 35 carattere o allo spazio immeditamente successivo)
          $longString = $news[$n]["testo"];
          $intro = substr($longString,0,strpos($longString,' ',35)) . " ...";
          
          $data = date('d/m/Y', $news[$n]["data"]);

          $active = "";
          ($n == 0)?$active = "active" : $active;
          // immagine
          $image = $news[$n]["id"];
          // titolo
          $title = $news[$n]["titolo"];
          // costruzione del carousel per le notizie
          echo <<<HEREDOC
                        <div class="carousel-item $active">
                          <div class="container">
                            <img class="carousel-img" src="images/image$image.jpg" alt="Immagine$image" title="Immagine$image">
                              <div class="carousel-caption text-start">
                                  <h1>$title</h1>
                                  <p class="opacity-75">$data</p>
                                  <p class="opacity-75">$intro</p>
                                  <p><a class="btn btn-lg btn-primary" href="#">Leggi ...</a></p>
                              </div> <!--  end class carousel-caption -->
                          </div><!--  end class container -->
                        </div><!--  end class carousel-item -->
HEREDOC;


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