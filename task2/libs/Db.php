<?php
class Db
{
    private $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
    private $options;
    private $driver;


    public function __construct($driver)
    {
        $this->options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ];
        $this->driver = new PDO($driver.":dbname=".DB_NAME.";host=".DB_HOST, DB_USER, DB_PASSWORD, $this->options);
    }

    public function generateInsert()
    {
        $id = $this->getLastIndex();
        $sql = "INSERT INTO task2 (id, name, description) VALUES";
        for ($i=$id+1; $i <= $id+1000; $i++) {
            $sql .= '(' . $i . ", '" . $this->randomText() . "', '" .$this->randomText().$this->randomText().$this->randomText()."'),\n";
        }
        $sql = substr($sql, 0, -2);
        $stmt = $this->driver->prepare($sql);
        $res = $stmt->execute();
    }

    function randomText()
    {
        for ($i = 0; $i < 250; $i++) {
            $n = rand(0, strlen($this->alphabet)-1);
            $text .= $this->alphabet[$n];
        }
        return $text;
    }

    private function getLastIndex()
    {
        $sql = "SELECT id FROM task2 ORDER BY id DESC LIMIT 1";
        $stmt = $this->driver->prepare($sql);
        $res = $stmt->execute();
        if ($res !== false){
            $result = $stmt->fetchAll();
            if(!empty($result)){
                return (int)$result[0]['id'];
            } else {
                return 0;
            }
        } else {
            return false;
        }
    }
}
