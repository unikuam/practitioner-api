<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: DELETE');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Profiles.php';

  $database = new Database();
  $db = $database->connect();

  $profile = new Profiles($db);

  $data = json_decode(file_get_contents("php://input"));

  $profile->id = $data->id;

  if ($profile->delete()) {
    echo json_encode(
        array('status' => 200, 'message' => 'Profile Deleted Successfully.')
    );
  } else {
    echo json_encode(
        array('status' => 500, 'message' => 'Profile Not Deleted')
    );
  }