<?php
            
            include "views/head.php";
            include "php/funct.class.php";
            echo PHP_EOL . "<title>Control Panel</title>" . PHP_EOL;
            echo "</head>";
            echo PHP_EOL . "<body>" . PHP_EOL;
            $val = New Services();
            $psw = $val->validate($_POST["psw"]);
            $user = $val->validate($_POST["email"]);
            //  Apri la connessione con il DB
            use CPApp\CPSQLiteConnection;
            include "CPApp/SQLiteConnection.php";
            $conn = new CPSQLiteConnection();
      
            // controlla le credeziali iserite
            $users = array();
            $query = "SELECT * FROM users WHERE username='$user' AND psw='$psw'";
            $users = $conn->myCPQuery($query);

            // Distruggi connessione
            $conn = null;
            //var_dump($news);

            // controllo delle credenziali inserite
            
                if (!(count($users)>0))
                    {
                        header("Location: http://localhost:8000/index.php?condition=invalid");
                    }
            

            

    ?>

    <h1>LOGIN EFFETTUATO</h1>
    <?php
        echo "<h1>User = " . $user . "</h1>" ;
        echo "<h1>PassWord = " . $psw . "</h1>" ;
    ?>

    
    </body>
    </html>