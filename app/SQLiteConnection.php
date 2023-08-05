<?php
namespace App;
include "Config.php";
/**
 * SQLite connnection
 */
class SQLiteConnection {
    /**
     * PDO instance
     * var type 
     */
    private $pdo;

    /**
     * return in instance of the PDO object that connects to the SQLite database
     * @return \PDO
     */
        public function connect() {
            $dir = 'sqlite:' . Config::PATH_TO_SQLITE_FILE;
            
            try {
                    $this->pdo  = new \PDO($dir, null, null, null);
                    return $this->pdo;
            }catch(\PDOException $e)    {
                    $res = ("Connection failed: " . $e->message);
                    return $this->pdo;
            }

        }

        public function myQuery($query = null)
            {
                $dir = 'sqlite:' . Config::PATH_TO_SQLITE_FILE;
                try {
                        $this->pdo  = new \PDO($dir, null, null, null);
                        foreach ($this->pdo->query($query) as $row)
                    {
                        //echo $row["id"];
                    }
                        $this->pdo = null;
                        return $row;

                }catch(\PDOException $e)    {
                        $res = ("Connection failed: " . $e->message);
                        $this->pdo = null;
                        return $res;
                }
                
            }
           
          
    
}
?>