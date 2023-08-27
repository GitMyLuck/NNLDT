<?php
            
            include "views/head.php";
            include "php/funct.class.php";
            echo PHP_EOL . "<title>Control Panel</title>" . PHP_EOL;
            echo "</head>";
            echo PHP_EOL . "<body>" . PHP_EOL;
            // vengono prelevate user e password
            // che vengono passate alla funzione validate()
            // per essere sanitizzate
            $val = New Services();
            $psw = $val->validate($_POST["psw"]);
            $user = $val->validate($_POST["email"]);

            // vengono preparate le variabili per indirizzo assoluto
            $server = $_SERVER["HTTP_HOST"];
            $pag = "/index.php";
            $get = "?condition=invalid";
            $header = "Location: http://" . $server . $pag . $get . "";

            //  Apri la connessione con il DB
            use CPApp\CPSQLiteConnection;
            include "CPApp/SQLiteConnection.php";
            $conn = new CPSQLiteConnection();
      
            // controlla le credeziali iserite
            // e sanitizzate con la funzione validate() + inserimento
            // fra le virgolette nella query
            $users = array();
            $query = "SELECT * FROM users WHERE username='$user' AND psw='$psw'";
            $users = $conn->myCPQuery($query);

            // Distruggi connessione
            $conn = null;
            //var_dump($news);

            // controllo delle credenziali inserite
            
                if (!(count($users)>0))
                    {
                        //  ritorna alla pagina del login con la
                        //  dicitura "LOGIN ERRATO"
                        header($header);
                    }
                else
                    {
                        // indirizzamento alla pagina iniziale del control panel
                        header("Location: http://" . $server ."/general.php");
                        exit;
                    }
            

            

    ?>

    <h1>LOGIN EFFETTUATO</h1>
    <?php
        echo "<h1>User = " . $user . "</h1>" ;
        echo "<h1>PassWord = " . $psw . "</h1>" ;
    ?>

    
    </body>
    </html>