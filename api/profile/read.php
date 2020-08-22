<?php 
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Profiles.php';

  $database = new Database();
  $db = $database->connect();
  $profile = new Profiles($db);

  $profile_id = (isset($_GET['id'])) ? $_GET['id'] : NULL;

  //validation
  if ($profile_id && (!is_numeric($profile_id) && $profile_id <= 0)) {
    echo json_encode(
      array('status' => 503 , 'message' => 'Please provide numeric id only.')
    );
    die();
  }

  $result = $profile->read(NULL, NULL, $profile_id);
  $num = $result->rowCount();
  $response = array();

  if ($num > 0) {
    $profiles = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
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
    $response['data'] = $profiles;
    echo json_encode($response);
  } else {
    echo json_encode(
      array('status' => 404, 'message' => 'No Profiles Found')
    );
  }