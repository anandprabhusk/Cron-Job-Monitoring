<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// get database connection
include_once '../config/database.php';

$database = new Database();
$db = $database->getConnection();


if(!$db)
{
    if(!empty($_POST)) {
        if(
            $_POST['host_name'] &&
            $_POST['host_ip'] &&
            $_POST['job_name'] &&
            $_POST['job_start_date'] &&
            $_POST['job_end_date'] &&
            $_POST['job_status'] &&
            $_POST['job_info'] 
//            &&
//            is_uploaded_file($_FILES['job_log_file']['tmp_name'])
        ) { 
            $rpt_host_name   = htmlspecialchars(strip_tags($_POST['host_name']));
            $rpt_host_ip     = htmlspecialchars(strip_tags($_POST['host_ip']));
            $rpt_job_name    = htmlspecialchars(strip_tags($_POST['job_name']));
            $rpt_start_date  = $_POST['job_start_date'];
            $rpt_end_date    = $_POST['job_end_date'];
            $rpt_job_status  = htmlspecialchars(strip_tags($_POST['job_status']));
            $rpt_job_info    = htmlspecialchars(strip_tags($_POST['job_info']));

            $select_sql = "SELECT id from cronjob order by id desc limit 1;";    
            $result_set = $database->query($select_sql);
            $id = 0;
            while($row = mysqli_fetch_array($result_set)) { 
                $id = $row['id'];
            }
            $id = $id + 1;            
            
            if (empty($_FILES['job_log_file'])) {
                $rpt_attachment_msg = NULL;
            } else {
                $tmp_file   = $_FILES['job_log_file']['tmp_name'];   //get file from client
                $file_name  = $_FILES['job_log_file']['name'];       //get file name
                
                $rpt_attachment_msg  = $id.".".$file_name;
                $file_name  = $id.".".$file_name;            

                $upload_dir = "../jobs/".$file_name;                       //upload file          

            }
            
                        
            $rpt_submitted_on  = date('Y-m-d H:i:s');                 
                        
            $sql = "INSERT INTO cronjob(host_name, host_ip, job_name, job_start_date, job_end_date, job_status, job_info, job_log_file, submitted_on) VALUES ";
            $sql .= "('{$rpt_host_name}','{$rpt_host_ip}','{$rpt_job_name}','{$rpt_start_date}','{$rpt_end_date}','{$rpt_job_status}','{$rpt_job_info}','{$rpt_attachment_msg}','{$rpt_submitted_on}')";
       
            
            if (empty($_FILES['job_log_file'])) {
                
                if($database->query($sql) ){
                    http_response_code(201);
                    echo json_encode(array("status code" => "201","id" => "{$id}","message" => "Data is successfully stored."));
                } else {
                    http_response_code(503);
                    echo json_encode(array("status code" => "503","message" => "Data Error. Unable to store data."));
                }            
            } else {
                
                if(move_uploaded_file($tmp_file,$upload_dir) && $database->query($sql) ){
                    http_response_code(201);
                    echo json_encode(array("status code" => "201","id" => "{$id}","message" => "Data is successfully stored."));
                } else {
                    http_response_code(503);
                    echo json_encode(array("status code" => "503","message" => "Data Error. Unable to store data."));
                }
            }
        } else {
            http_response_code(422);
            echo json_encode(array("status code" => "422","message" => "Incomplete data"));
        } 
    } else {
        echo "Required data is insufficient";
    } 
} else {
                    http_response_code(500);
                    echo json_encode(array("status code" => "500","message" => "Internal Server Error"));
}

?>