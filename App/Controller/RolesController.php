<?php
namespace App\Controller;
use App\Manager\ManagerRoles;
class RolesController extends ManagerRoles{
    public function addRoles(){
        header('Access-Control-Allow-Origin: *, Content-Type : application/json');
        $json = file_get_contents("php://input");
        $code = 200;
        $message = "";
        if($json){
            $data = json_decode($json, true);
            $this->setNom($data["nom"]);
            $this->create();
            $message = ['ok'=>'Le Role a ete ajoute en BDD' ];
        }
        else{
            $code = 400;
            $message = ["error"=>"le Json est invalide"];
        }
        http_response_code($code);
        echo json_encode($message,JSON_UNESCAPED_UNICODE);
    }
    public function findRolesById(){
        header('Access-Control-Allow-Origin: *, Content-Type : application/json');
        $code = 200;
        $message = "";
        if(isset($_GET["id"]) AND !empty($_GET["id"])){
            $data = $this->find($_GET["id"]);
            if($data){
                $message = $data;
            }
            else{
                $message = ['error'=>'Le role n\'existe pas en BDD'];
                $code = 400;
            }
        }
        else{
            $message = ['error'=>'param id vide'];
            $code = 400;
        }
        http_response_code($code);
        echo json_encode($message, JSON_UNESCAPED_UNICODE);
    }
    public function findAllRoles(){
        header('Access-Control-Allow-Origin: *, Content-Type : application/json');
        $code = 200;
        $message = "";
        $data = $this->findAll();
        if($data){
            $message = $data;
/*             var_dump($message);
            die; */
        }
        else{
            $message = ['error'=>'Le role n\'existe pas en BDD'];
            $code = 400;
        }
        http_response_code($code);
        echo json_encode($message,JSON_UNESCAPED_UNICODE);
    }
    public function updateRoles(){
        header('Access-Control-Allow-Origin: *, Content-Type : application/json');
        $json = file_get_contents("php://input");
        $code = 200;
        $message = "";
        if($json){
            $data = json_decode($json, true);
            $id = $data["id"];
            $this->setNom($data["nom"]);
            $this->update($id);
            $message = ['ok'=>'Le Role a ete mis a jour en BDD' ];
        }
        else{
            $code = 400;
            $message = ["error"=>"le Json est invalide"];
        }
        http_response_code($code);
        echo mb_convert_encoding(json_encode($message), "UTF-8", mb_list_encodings());
    }
}
?>