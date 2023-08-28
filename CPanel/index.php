<?php
            
            include "views/head.php";
            include "CPApp/Config.php";
            use CPApp\Config;
            echo PHP_EOL . "<title>" . Config::HOME_PAGE . "</title>" . PHP_EOL;
            echo "</head>";
            echo PHP_EOL . "<body>" . PHP_EOL;
            $result = "...";
            if ((isset ($_GET["condition"])) && ($_GET["condition"] == "invalid"))
            {
              $result = "Login non Valido";
            }
    ?>

<div class="container col-xl-10 col-xxl-8 px-4 py-5">
<div class="row align-items-center g-lg-5 py-5">
      <div class="col-lg-7 text-center text-lg-start">
        <h1 class="display-4 fw-bold lh-1 text-body-emphasis mb-3">Pannello di Controllo</h1>
        <p class="col-lg-10 fs-4">Inserisci le Tue credenziali per poter accedere al Pannello di Controllo, che permette di inserire, modificare o eliminare le notizie che riguardano il LuccaDeltaTeam®.</p>
      </div>
<main class="form-signin w-100 m-auto">
  <form action="login.php" method="post">
    <img class="mb-4" src="../images/Logo.png" alt="" height="67">
    <h1 class="h3 mb-3 fw-bold">LOGIN</h1>

    <div class="form-floating">
      <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com" required>
      <label for="floatingInput">Email</label>
    </div>
    <div class="form-floating">
      <input type="password" name="psw" class="form-control" id="floatingPassword" placeholder="Password" required>
      <label for="floatingPassword">Password</label>
    </div>

    <div class="form-check text-start my-3">
      <input class="form-check-input" type="checkbox" value="remember-me" id="flexCheckDefault">
      <label class="form-check-label" for="flexCheckDefault">
        RICORDAMI
      </label>
    </div>
    <div class="login-message"><?php echo $result; ?></div>
    <button class="btn btn-primary w-100 py-2" type="submit">INVIA</button>
    <p class="mt-5 mb-3 text-body-secondary">&copy; LuccaDeltaTeam ®2011–2023</p>
  </form>
</main>
</div> 
</div> 
     
</body>

</html>