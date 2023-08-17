<?php
            
            include "views/head.php";
            echo PHP_EOL . "<title>Control Panel</title>" . PHP_EOL;
            echo "</head>";
            echo PHP_EOL . "<body>" . PHP_EOL;
            $user = $_POST["psw"];


    ?>

    <h1>LOGIN EFFETTUATO</h1>
    <?php
        echo "<h1>PassWord = " . $user . "</h1>" ;
    ?>

    
    </body>
    </html>