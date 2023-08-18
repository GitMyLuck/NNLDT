<?php
            
            include "views/head.php";
            echo PHP_EOL . "<title>Control Panel</title>" . PHP_EOL;
            echo "</head>";
            echo PHP_EOL . "<body>" . PHP_EOL;
    ?>
<main class="form-signin w-100 m-auto">
  <form action="login.php" method="post">
    <img class="mb-4" src="../images/Logo.png" alt="" height="67">
    <h1 class="h3 mb-3 fw-normal">Please Log in</h1>

    <div class="form-floating">
      <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com" required>
      <label for="floatingInput">Email address</label>
    </div>
    <div class="form-floating">
      <input type="password" name="psw" class="form-control" id="floatingPassword" placeholder="Password" required>
      <label for="floatingPassword">Password</label>
    </div>

    <div class="form-check text-start my-3">
      <input class="form-check-input" type="checkbox" value="remember-me" id="flexCheckDefault">
      <label class="form-check-label" for="flexCheckDefault">
        Remember me
      </label>
    </div>
    <button class="btn btn-primary w-100 py-2" type="submit">Log in</button>
    <p class="mt-5 mb-3 text-body-secondary">&copy; LuccaDeltaTeam ®2011–2023</p>
  </form>
</main>
        
     
</body>

</html>