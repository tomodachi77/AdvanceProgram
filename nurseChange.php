<?php 
include ("config.php");
include ("firebaseRDB.php");

$id = $_POST['id'];
$gender = $_POST['gender'];
$dateofborn = date('j-m-Y', strtotime($_POST['dateofborn']));
$address = $_POST['address'];
$degree = $_POST['degree'];
$image = $_POST['image'];

$rdb = new firebaseRDB($databaseURL);
if($image != ""){
$update = $rdb->update("/staffManager/nurse", $id,[
    "gender" => $gender,
    "datofborn" => $dateofborn,
    "address" => $address,
    "degree" => $degree,
    "image_url" => $image
]);
}
else{
$update = $rdb->update("/staffManager/nurse", $id,[
    "gender" => $gender,
    "datofborn" => $dateofborn,
    "address" => $address,
    "degree" => $degree
]);    
}
$result = json_decode($update, 1);
if(!isset($result['name'])){
    $_SESSION['success'] = "Lưu thành công.";
}else{
    $_SESSION['wrong'] = "Lưu thất bại.";
}
header("location: nurse.php");