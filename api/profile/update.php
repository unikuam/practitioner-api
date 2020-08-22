<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Profiles.php';

  $database = new Database();
  $db = $database->connect();
  $profile = new Profiles($db);

  $data = json_decode(file_get_contents("php://input"));

  $profile->id = $data->id;
  $profile->name = $data->name;
  $profile->location = $data->location;
  $profile->description = $data->description;
  $profile->phone_number = $data->phone_number;
  $profile->profile_photo = $data->profile_photo;
  $profile->email = $data->email;

  if ($profile->update()) {
    echo json_encode(
        array('status' => 200, 'message' => 'Profile Updated Successfully.')
    );
  } else {
    echo json_encode(
        array('status' => 500, 'message' => 'Profile Not Updated')
    );
  }