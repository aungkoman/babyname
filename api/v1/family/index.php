<?php
ini_set("allow_url_fopen", true);
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
include('../../../lib/rb.php');
include('../../../config/conn.php');
include('../../../config/return_function.php');
include('../../../model/FAMILY.php');

$family = new FAMILY();
$method = $_SERVER['REQUEST_METHOD'];
switch ($method) {
	case 'POST':
        $request_data = $_POST;
        //print_r($request_data);
        $ops_type = (string) isset($request_data['ops_type']) ? filter_var($request_data['ops_type'], FILTER_SANITIZE_STRING) :  null;
        //echo $ops_type;
        switch ($ops_type){
            case 'register':
                $family->register($request_data);
                break;
            case 'selectAll':
                $family->selectAll($request_data);
                break;
            case 'selectByGender':
                $family->selectByGender($request_data);
                break;
            case 'selectByBirthdate':
                $family->selectByBirthdate($request_data);
                break;
            case 'selectByGenderBirthdate':
                $family->selectByGenderBirthdate($request_data);
                break;
            case 'update':
                $family->update($request_data);
                break;
            case 'delete':
                $family->delete($request_data);
                break;
            case 'guess':
                if(isset($request_data['gender']) && isset($request_data['birthdate'])){
                    $family->guessForGenderBirthdate($request_data);
                }else if(isset($request_data['gender'])){
                    $family->guessForGender($request_data);
                }else if(isset($request_data['birthdate'])){
                    $family->guessForBirthdate($request_data);
                } else{
                    $family->guess($request_data);
                }
                break;
            default :
                return_fail('unknow_ops_type',$ops_type);
                break;
        }
        break;
	default:
		# code...
		//echo "undefined method =>".$method;
		return_fail("unknow_method",$method);
		break;
}
?>