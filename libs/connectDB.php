<?php

class Database
{

    private $dbh;
    public $error;

    private $stmt;

    public function __construct()
    {
        require_once "configs/config.php";

        $dsn = 'mysql:host=' . $db_config["host"] . ';dbname=' . $db_config["dbname"].";charset=utf8";
        $options = array(
            PDO::ATTR_PERSISTENT    => true,
            PDO::ATTR_ERRMODE       => PDO::ERRMODE_EXCEPTION,
						PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
        );
        try {
            $this->dbh = new PDO($dsn, $db_config["user"], $db_config["password"], $options);
        }
        catch(PDOException $e) {
            $this->error = $e->getMessage();
        }
    }

    public function query($query)
    {
        $this->stmt = $this->dbh->prepare($query);
    }

    public function bind($param, $value, $type = null)
    {
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }
        $this->stmt->bindValue($param, $value, $type);
    }

    public function execute(){
        return $this->stmt->execute();
    }

    public function resultset(){
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

		public function getJSON(){
					header("Content-type: application/json; charset=utf-8");
					$this->execute();
					$rows = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
					return json_encode($rows);
		}

    public function getArray(){
          $this->execute();
          $rows = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
          return $rows;
    }

    public function single(){
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function rowCount(){
        return $this->stmt->rowCount();
    }

    public function lastInsertId(){
        return $this->dbh->lastInsertId();
    }

    public function beginTransaction(){
        return $this->dbh->beginTransaction();
    }

    public function endTransaction(){
        return $this->dbh->commit();
    }

    public function cancelTransaction(){
        return $this->dbh->rollBack();
    }

    public function debugDumpParams(){
        return $this->stmt->debugDumpParams();
    }
}

?>
