<?php

include("config/db.php");
include("cmd/exec.php");

$db = new Database();
$str_conn = $db->getConnection();
$str_exe = new ExecSQL($str_conn);
$action= $_GET['cmd'];
$str_email = $_GET['email'];
$str_password = $_GET['password'];
$dataend =" WHERE email='$str_email' AND password='$str_password' ";


if($action =="login") {   
    $stmt = $str_exe->readone("tb_user",$dataend);  
    $numc = $str_exe->rowCount("tb_user",$dataend);
    
    if($numc != 0)
    {
        $status = array("LOGIN OK");
        $data_arr['rs'] = array();
        foreach($stmt as $row){
            $item = array(
                'firstname'=>$row['firstname'],
                'lastname'=> $row['lastname'],
                'email'=>$row['email']
            );      
            array_push($data_arr['rs'],$status,$item);
        } 
        echo json_encode($data_arr);   
    }    
    else
    {
        echo json_encode("NO.");
    }

}else{

}

?>