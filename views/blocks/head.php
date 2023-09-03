<!doctype html>
<html lang="it" data-bs-theme="light">
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.112.5">

    <!--<link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/carousel/">-->
    <script src="assets/dist/js/bootstrap.bundle.min.js" type="text/javascript"></script>
    <script src="scripts/jquery-2.1.4.min.js" type="text/javascript"></script>
    <script src="assets/js/color-modes.js" type="text/javascript"></script>

    <!-- Custom styles for this template -->
    <link href="scss/starter.css" rel="stylesheet">
    <link href="css/main-layout.css" rel="stylesheet">
    <link href="css/carousel.css" rel="stylesheet">
    <link href="css/news.css" rel="stylesheet">
    <link href="css/footer.css" rel="stylesheet">

    <?php
      //   Preleva le notizie e ponile in $news
      use App\SQLiteConnection;
      include "app/SQLiteConnection.php";
      $conn = new SQLiteConnection();
      
      // preleva le notizie dalla tabella news  
      $news = array();
      $query = "SELECT * FROM news";
      $news = $conn->myQuery($query);
      
      // Distruggi connessione
      $conn = null;
      //var_dump($news);
    ?>