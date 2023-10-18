<?php
header("Content-Type: image/jpeg");
include 'func/dbconnect.php';
$t = $_GET['t'];
$id = $_GET['id'];
switch($t){
    case 1:
        $read = $connect->prepare("select * from food where food_id=?");
        break;
    case 2:
        $read = $connect->prepare("select * from company where company_id=?");
        break;
    default:
        $read = $connect->prepare("select * from food where food_id=?");
        break;
}
$read->bindParam(1,$id);
$connect->beginTransaction();
$read->execute();
$connect->commit();
$list = $read->fetch(PDO::FETCH_ASSOC);
switch($t){
    case 1:
        echo $list['img'];
        break;
    case 2:
        echo $list['company_img'];
        break;
    default:
        echo $list['img'];
        break;
}

?>