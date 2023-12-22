<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Content-Type: application/json; charset=UTF-8");

include_once 'init.php';


$data = json_decode(file_get_contents("php://input"));

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($data->action)) {

    switch ($data->action) {
        case 'create_account':
            $auth = new Authentication();

            if (isset($data->username, $data->email, $data->password)) {
                $auth->username = $data->username;
                $auth->email = $data->email;
                $auth->password = $data->password;

                if ($auth->userRegister()) {
                    http_response_code(200);
                    echo json_encode(["success" => true, 'message' => 'Account created successfully']);
                }
            } else {
                http_response_code(400);
                echo json_encode(["success" => false, 'message' => 'Invalid data. Username, email, and password are required']);
            }
            break;


        case 'login':

            $auth = new Authentication();

                $auth->username = $data->username;
                $auth->email = $data->email;
                $auth->password = $data->password;

                $auth->userLogin();

            break;

        case 'validateJWT':

            $jwt_obj = new JwtUtils();

            $jwt_obj->jwt = $data->jwt;

            $jwt_obj->validate();

            break;

        case 'create':
            // TODO: Add code to handle create operation for CRUD
            // Example: $data = $_POST['data'];
            // TODO: Insert the data into the database

            // Respond with a success message or appropriate response
            echo json_encode(['message' => 'Create operation successful']);
            break;

        case 'read':
            // TODO: Add code to handle read operation for CRUD
            // Example: Retrieve data from the database

            // Respond with the data or appropriate response
            echo json_encode(['data' => 'Read operation successful']);
            break;

        case 'update':
            // TODO: Add code to handle update operation for CRUD
            // Example: $id = $_POST['id']; $updatedData = $_POST['updatedData'];
            // TODO: Update the data in the database

            // Respond with a success message or appropriate response
            echo json_encode(['message' => 'Update operation successful']);
            break;

        case 'delete':
            // TODO: Add code to handle delete operation for CRUD
            // Example: $id = $_POST['id'];
            // TODO: Delete the data from the database

            // Respond with a success message or appropriate response
            echo json_encode(['message' => 'Delete operation successful']);
            break;

        default:
            http_response_code(400); // Bad Request
            echo json_encode(['error' => 'Invalid action']);
            break;
    }
} else {
    http_response_code(405); // Method Not Allowed
    echo json_encode(['error' => 'Method not allowed']);
}
