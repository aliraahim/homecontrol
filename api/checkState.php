<?php
include '../connect.php';

$status = "";
$data = "";
$message = "";

if (isset($_GET['switch_id'])) {
    $switch_id= $_GET['switch_id'];
    $switch = @DB::queryFirstRow("SELECT * FROM states WHERE switch_id=%s", $switch_id);
    if ($switch != null) {
        $status = "success";
        $data= $switch['state'];
        $message = "";
    } else {
        $status = "failure";
        $data = "";
        $message = "No record against given ID";
    }
}
else {
    $status = "failure";
    $data = "";
    $message = "No ID provided";
}

$response = array('status' => $status);
$response['data'] = $data;
$response['message'] = $message;

echo json_encode($response);