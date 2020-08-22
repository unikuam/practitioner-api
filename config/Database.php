<?php

class Database {
    private $hostname = 'localhost';
    private $dbName = 'practitioner';
    private $username = 'root';
    private $port = '3308';
    private $password = '';
    private $connection;

    public function connect() {
      $this->connection = null;
      try { 
        $this->connection = new PDO('mysql:host=' . $this->hostname . ';port='.$this->port.';dbname=' . $this->dbName, $this->username, $this->password);
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      } catch(PDOException $e) {
        echo $e->getMessage();
        die;
      }
      return $this->connection;
    }
  }