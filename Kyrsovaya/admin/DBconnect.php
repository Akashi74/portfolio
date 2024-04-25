<?php
class Database
{
    private $host = "localhost";
    private $port = "3306";
    private $db_name = "real_estate";
    private $username = "root";
    private $password = "";
    private $charset = "utf8";
    public $pdo;
    private $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];
    public function connect_pdo()  //метод подключения БД
    {
        $this->pdo = NULL;
        try {
            $this->pdo = new PDO(
                "mysql:host=" . $this->host . ";
                            port=" . $this->port . ";  dbname=" . $this->db_name . ";  
                            charset=" . $this->charset,
                $this->username,
                $this->password,
                $this->options
            );
        } catch (PDOException $exception) {
            echo "Ошибка соединения: " . $exception->getMessage();
        }
        return $this->pdo;
    }
    public function close_connect()   //метод закрытия подключения БД
    {
        $this->pdo = NULL;
    }
    public function getInfPDO() //метод возврата PDO для разработчика
    {
        return $this->pdo;
    }
}
?>
