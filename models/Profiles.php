<?php
class Profiles {
    private $connection;
    private $table = 'profiles';
    private $dbName = 'practitioner';

    public $id_profile;
    public $name;
    public $location;
    public $description;
    public $profile_photo;
    public $gallary_photos;
    public $phone_number;
    public $email;
    public $date_created;
    public $date_updated;

    public function __construct($db) {
        $this->connection = $db;
    }

    public function read($page = NULL, $perPage = NULL, $profile_id = NULL, $filter_data = array(), $filter_type = 'AND') {
        $extras = '';
        if (isset($page)) {
          $extras = ' LIMIT '. $page .', '.$perPage;
        }
        if (isset($profile_id)) {
          $extras = ' WHERE id_profile = '. $profile_id;
        }
        if (isset($filter_data) && count($filter_data) > 0) {
          $extras = ' WHERE ';
          $count = 0;
          foreach ($filter_data as $key => $value) {
            $count++;
            if ($count == count($filter_data)) {
              $extras .= $key . ' LIKE "%'.$value . '%"';
            } else {
              $extras .= $key . ' LIKE "%'.$value .'%" '. $filter_type . ' ';
            }
          }
        }
        $query = 'SELECT id_profile, name, location, description, phone_number, email FROM ' . $this->table . $extras;
        $result = $this->connection->prepare($query);
        $result->execute();
        return $result;
    }

    public function columnExist($col_name) {
      $query = "SELECT * FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = '".$this->dbName."' AND TABLE_NAME = '".$this->table."' AND COLUMN_NAME = '".$col_name ."'";
      $result = $this->connection->prepare($query);
      $result->execute();
      return $result;
    }

    public function create() {
          $query = 'INSERT INTO ' . $this->table . ' 
            SET 
              name = :name, 
              location = :location, 
              description = :description, 
              profile_photo = :profile_photo,
              phone_number = :phone_number,
              email = :email';

          $result = $this->connection->prepare($query);

          $this->name = htmlspecialchars(strip_tags($this->name));
          $this->location = htmlspecialchars(strip_tags($this->location));
          $this->description = htmlspecialchars(strip_tags($this->description));
          $this->phone_number = htmlspecialchars(strip_tags($this->phone_number));
          $this->profile_photo = htmlspecialchars(strip_tags($this->profile_photo));
          $this->email = htmlspecialchars(strip_tags($this->email));

          $result->bindParam(':name', $this->name);
          $result->bindParam(':location', $this->location);
          $result->bindParam(':description', $this->description);
          $result->bindParam(':phone_number', $this->phone_number);
          $result->bindParam(':profile_photo', $this->profile_photo);
          $result->bindParam(':email', $this->email);

          if ($result->execute()) return true;
          printf("Error: %s.\n", $result->error);
          return false;
    }

    public function update() {
          $query = 'UPDATE ' . $this->table . ' 
            SET 
              name = :name, 
              location = :location, 
              description = :description, 
              profile_photo = :profile_photo,
              phone_number = :phone_number,
              email = :email
              WHERE id_profile = :id ';

          $result = $this->connection->prepare($query);
          $this->name = htmlspecialchars(strip_tags($this->name));
          $this->location = htmlspecialchars(strip_tags($this->location));
          $this->description = htmlspecialchars(strip_tags($this->description));
          $this->phone_number = htmlspecialchars(strip_tags($this->phone_number));
          $this->profile_photo = htmlspecialchars(strip_tags($this->profile_photo));
          $this->email = htmlspecialchars(strip_tags($this->email));
          $this->id_profile = htmlspecialchars(strip_tags($this->id));

          $result->bindParam(':name', $this->name);
          $result->bindParam(':location', $this->location);
          $result->bindParam(':description', $this->description);
          $result->bindParam(':phone_number', $this->phone_number);
          $result->bindParam(':profile_photo', $this->profile_photo);
          $result->bindParam(':email', $this->email);
          $result->bindParam(':id', $this->id_profile);

          if ($result->execute()) return true;
          printf("Error: %s.\n", $result->error);
          return false;
    }

    public function delete() {
          $query = 'DELETE FROM ' . $this->table . ' WHERE id_profile = :id';
          $result = $this->connection->prepare($query);

          $this->id = htmlspecialchars(strip_tags($this->id));
          $result->bindParam(':id', $this->id);

          if($result->execute()) return true;
          printf("Error: %s.\n", $result->error);
          return false;
    }
    
  }