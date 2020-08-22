<?php 
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Profiles.php';

  $database = new Database();
  $db = $database->connect();
  $profile = new Profiles($db);
  $response = array();

  if (isset($_GET['page'])) {
      $page = $_GET['page'];
      $per_page_data = isset($_GET['per_page']) ? $_GET['per_page'] : 5;

      //validation
      if ((!is_numeric($page) && $page <= 0) || (!is_numeric($per_page_data) && $per_page_data <= 0)) {
        echo json_encode(
            array('status' => 503 , 'message' => 'Please provide numeric data only.')
          );
          die();
      }

      $start = ($page * $per_page_data) - $per_page_data;
      $result = $profile->read($start, $per_page_data);
      $num = $result->rowCount();
      if ($num > 0) {
        $profiles = array();
    
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
          extract($row);
    
          $profile = array(
            'id' => $id_profile,
            'name' => $name,
            'location' => $location,
            'description' => html_entity_decode($description),
            'phone_number' => $phone_number,
            'email' => $email,
          );
    
          array_push($profiles, $profile);
        }
        $response['status'] = 200;
        $response['message'] = 'Success';
        $response['page'] = $page;
        $response['result_per_page'] = $per_page_data;
        $response['data'] = $profiles;
        echo json_encode($response);
      } else {
        echo json_encode(
          array('status' => 404 , 'message' => 'No Profiles Found')
        );
      }
  } else {
    echo json_encode(
        array('status' => 500, 'message' => 'Insufficient params provided.')
      );
  }

  