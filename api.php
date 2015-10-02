<?php

include('connection.php');

$jsonString = file_get_contents('php://input');
$jsonObj = json_decode($jsonString, true);
$data = $jsonObj;

if($data["mode"] == "login")
    {
		$name=$data['user_name'];
		$pass=$data['password'];
		
		$result = mysqli_query($mysqli,"SELECT user_id,user_name FROM pro1 where user_name='$name' and password='$pass'");
		
		$arrResponse = array();	
		while($row = mysqli_fetch_assoc($result)) 
		{
			 $arrResponse[] = $row;
		}	
		
		if (!empty($arrResponse))
        {
        	$response = array(
                    "status" => 1,
                    "message" => "Success",
                    "response" => $arrResponse
                );
        }
        else
        {
         	$response = array(
                    "status" => 0,
                    "message" => "No Data found",
					"response" => $arrResponse
                );
        }
	}
	elseif($data["mode"] == "getprofile")
    {
		$id=$data['user_id'];
		
		
		$result = mysqli_query($mysqli,"SELECT * FROM pro1 where user_id=$id");
	
		$arrResponse = array();	
		while($row = mysqli_fetch_assoc($result)) 
		{
			 $arrResponse[] = $row;
		}	
		
		if (!empty($arrResponse))
        {
        	$response = array(
                    "status" => 1,
                    "message" => "Success",
                    "response" => $arrResponse
                );
        }
        else
        {
         	$response = array(
                    "status" => 0,
                    "message" => "No Data found",
					"response" => $arrResponse
                );
        }
	}
	
else
	{
		 $response = array(
                    "status" => 0,
                    "message" => "Invalid Mode",
					"response" => ''
                );
	}
	echo json_encode($response);
 ?>
