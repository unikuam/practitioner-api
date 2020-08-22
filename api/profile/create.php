<?php 
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/Profiles.php';

    $database = new Database();
    $db = $database->connect();
    $profile = new Profiles($db);
    $response = array();

    $data = $_POST;
    $profile_photo = '';
    if (isset($_FILES['profile_photo'])) {
        $file_name = $_FILES['profile_photo']['name'];
        $file_size = $_FILES['profile_photo']['size'];
        $file_tmp = $_FILES['profile_photo']['tmp_name'];
        $file_type = $_FILES['profile_photo']['type'];
        $exploded = explode('.',$_FILES['profile_photo']['name']);
        $file_ext = end($exploded);
        
        $extensions= array("jpeg","jpg","png");
        
        if (in_array(strtolower($file_ext), $extensions) === false) {
            echo json_encode(
                array('status' => 500, 'message' => 'Please choose a JPEG or PNG file.')
            );
            die();
        }
        
        if ($file_size > 2097152){
            echo json_encode(
                array('status' => 500, 'message' => 'File size must be excately 2 MB')
            );
            die();
        }
        $upload_dir = "./images/" . $file_name;
        if (move_uploaded_file($file_tmp, $upload_dir)) {
            $profile_photo = $file_name;
        } else {
            echo json_encode(
                array('status' => 500, 'message' => 'File could not upload')
            );
            die();
        }
    }

    $profile->name = $data['name'];
    $profile->location = $data['location'];
    $profile->description = $data['description'];
    $profile->phone_number = $data['phone_number'];
    $profile->profile_photo = $profile_photo;
    $profile->email = $data['email'];

    if ($profile->create()) {
        echo json_encode(
            array('status' => 200, 'message' => 'Profile Created Successfully.')
        );
    } else {
        echo json_encode(
            array('status' => 500, 'message' => 'Profile Not Created')
        );
    }