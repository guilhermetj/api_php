<?php


header('Content-Type: application/json');
header("Access-Control-Allow-Methods: GET,POST,PUT,DELETE");

require_once '../vendor/autoload.php';

use App\Controller\UserController;

if($_GET['url']) {
    $url = explode('/', $_GET['url']);
    $data = array();
    $id = null;
    $controller = null;

    $postdata = file_get_contents('php://input'); //pega o os dados passados na url
    parse_str($postdata, $data);
   
    if ($url[0] === 'api'){
        array_shift($url);

        $method = $_SERVER['REQUEST_METHOD']; //pega o metodo enviado e coloca em uma variavel

        if(isset($url[0])){
            $controller = $url[0];   //verifica se existe controller e coloca em uma variavel
        }
        if(isset($url[1])){
            $id = $url[1];   //verifica se existe id e coloca em uma variavel
        }


        $userController = new UserController();

        if ($method === 'GET') {
        // User 
            if ($controller === 'user'){
                if($id  == null){
                    $reponse = $userController->getAll();
                    echo json_encode(["result" => $reponse]);
                }else {
                    $reponse = $userController->get($id);
                    echo json_encode(["result" => $reponse]);
                }          
            }
            
        }

        if ($method === 'POST') {
            // User 
            if ($controller === 'user'){
                        $reponse = $userController->post();
                        echo json_encode(["result" => $reponse]);            
            }else {
                echo json_encode(["result" => "invalid"]);
            }
        }

        if ($method === 'DELETE') {
            // User 
            if ($controller === 'user' && isset($id)){
                        $reponse = $userController->delete($id);
                        echo json_encode(["result" => $reponse]);  
            }else {
                echo json_encode(["result" => "Id não encontrado"]);
            }

        }

        if ($method === 'PUT') {
            // User 
            if ($controller === 'user' && isset($id)){
                        $reponse = $userController->update($id, $data);
                        echo json_encode(["result" => $reponse]);  
            }else {
                echo json_encode(["result" => "Id não encontrado"]);
            }

        }
    }
}