<?php 
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Profiles.php';

    $database = new Database();
    $db = $database->connect();
    $profile = new Profiles($db);

    //validation
    if (count($_GET) <= 0) {
        echo json_encode(
            array('status' => 503 , 'message' => 'No data provided.')
        );
        die();
    }

    //check if keys are valid or not
    $valid_column = array('error' => false, 'info'=> '');
    foreach($_GET as $key => $value) {
        if ($profile->columnExist($key)->rowCount() <= 0) {
            $valid_column['error'] = true;
            $valid_column['info'] = $key;
            break;
        }
    }

    if ($valid_column['error']) {
        echo json_encode(
            array('status' => 500 , 'message' => $valid_column['info'] . ' column does not exist.')
        );
        die();
    }
    $filter_type = (isset($_GET['filter_type'])) ? $_GET['filter_type'] : 'AND';
    $result = $profile->read(NULL, NULL, NULL, $_GET, $filter_type);
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