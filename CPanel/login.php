<?php
            
            include "views/head.php";
            echo PHP_EOL . "<title>Control Panel</title>" . PHP_EOL;
            echo "</head>";
            echo PHP_EOL . "<body>" . PHP_EOL;
            $psw = $_POST["psw"];
            $user = $_POST["email"];
            //   Preleva le notizie e ponile in $news
             use CPApp\CPSQLiteConnection;
            include "CPApp/SQLiteConnection.php";
            $conn = new CPSQLiteConnection();
      
            // controlla le credeziali iserite
            $users = array();
            $query = "SELECT * FROM users";
            $users = $conn->myCPQuery($query);

            // Distruggi connessione
            $conn = null;
            //var_dump($news);

            // controllo delle credenziali inserite
            foreach($users as $key => $value)   {
                if (!!($s["username"] == $user))
                    {
                        header("Location: http://localhost:8000/index.php");
                    }
            }

    ?>

    <h1>LOGIN EFFETTUATO</h1>
    <?php
        echo "<h1>User = " . $user . "</h1>" ;
        echo "<h1>PassWord = " . $psw . "</h1>" ;
    ?>

    
    </body>
    </html>