<?php
session_start();
ob_start();

include('dbConnect.php');
$dateTime = date('Y-m-d H:i:s');
/**/
function login($name,$password,PDO $pdo){
	$read = $pdo->prepare("select * from user where name=? and password=?");
	$read->bindParam(1,$name,PDO::PARAM_STR);
	$read->bindParam(2,$password,PDO::PARAM_STR);
	$pdo->beginTransaction();
	$read->execute();
	$pdo->commit();
	$totalData = $read->rowCount();
	if($totalData>0){
		$list = $read->fetch(PDO::FETCH_ASSOC);
		$_SESSION["key"] = md5($list['user_id'].$list['name']);
		$_SESSION["userID"] = $list['user_id'];
		$_SESSION["type"] = $list['type'];
		if($list['type'] != 0){
			echo 0;
		}else{
			echo 1;
		}
		//echo 1;
	}else{
		echo 2;
	}
}
function logout(){
	try{
		$_SESSION["key"] = null;
		$_SESSION["userID"] = null;
		$_SESSION["type"] = null;
		return 1;
	}catch(Exception $e){
		return 2;
	}
}

function secureData($data){
    $data = addslashes($data);
    $data = htmlspecialchars($data);
    $data = strip_tags($data);
    //$data = htmlentities($data);
    return $data;
}
function companyInformation(){
	global $connect;
	$_userID = $_SESSION["userID"];
	$list = read("select c.company_id,c.name as company_name,c.address as company_address,c.phone_number as company_phone_number from user as u inner join company as c on u.user_id = c.userid where u.user_id=".$_userID,1,$connect);
	$cInformation[0] = $list['company_id'];
	$cInformation[1] = $list['company_name'];
	$cInformation[2] = $list['company_address'];
	$cInformation[3] = $list['company_phone_number'];
	return $cInformation;
}
/*AddFunctions*/

function userAdd($name,$lastName,$phone_number,$address,$user_name,$password,$type,PDO $pdo){
	$userLastID = 0;
	$addUser = $pdo->prepare("insert into user(name, password,type) VALUES (?,?,?)");
	$addUser->bindParam(1,$user_name,PDO::PARAM_STR);
	$addUser->bindParam(2,$password,PDO::PARAM_STR);
	$addUser->bindParam(3,$type,PDO::PARAM_INT);
	$pdo->beginTransaction();
	$addUser->execute();
	$userLastID = $pdo->lastInsertId();
	$pdo->commit();

	$addCustomer = $pdo->prepare("insert into customer(phone_number, name, last_name, address,user_id) VALUES (?,?,?,?,?)");
	$addCustomer->bindParam(1,$phone_number,PDO::PARAM_STR);
	$addCustomer->bindParam(2,$name,PDO::PARAM_STR);
	$addCustomer->bindParam(3,$lastName,PDO::PARAM_STR);
	$addCustomer->bindParam(4,$address,PDO::PARAM_STR);
	$addCustomer->bindParam(5,$userLastID,PDO::PARAM_INT);
	$pdo->beginTransaction();
	$addCustomer->execute();
	$pdo->commit();
	//print_r($addLocation->errorInfo());
}
function companyAdd($company_name,$address,$phone_number,$user_name,$password,$type,$companyLogo,PDO $pdo){
	$userLastID = 0;
	$addUser = $pdo->prepare("insert into user(name, password,type) VALUES (?,?,?)");
	$addUser->bindParam(1,$user_name,PDO::PARAM_STR);
	$addUser->bindParam(2,$password,PDO::PARAM_STR);
	$addUser->bindParam(3,$type,PDO::PARAM_INT);
	$pdo->beginTransaction();
	$addUser->execute();
	$userLastID = $pdo->lastInsertId();
	$pdo->commit();
	//print_r($addUser->errorInfo());

	$addCompany = $pdo->prepare("insert into company(name, address, phone_number,company_img,userid) VALUES (?,?,?,?,?)");
	$addCompany->bindParam(1,$company_name,PDO::PARAM_STR);
	$addCompany->bindParam(2,$address,PDO::PARAM_STR);
	$addCompany->bindParam(3,$phone_number,PDO::PARAM_STR);
	$addCompany->bindParam(4,$companyLogo,PDO::PARAM_LOB);
	$addCompany->bindParam(5,$userLastID,PDO::PARAM_INT);
	$pdo->beginTransaction();
	$addCompany->execute();
	$pdo->commit();
	//print_r($addCompany->errorInfo());
	return 1;
}
function addPizza($pizzaName,$description,$price,$type,$img,$companyID,PDO $pdo){
	$addPizza = $pdo->prepare("insert into food(name, description, price,type,img,companyid) VALUES (?,?,?,?,?,?)");
	$addPizza->bindParam(1,$pizzaName,PDO::PARAM_STR);
	$addPizza->bindParam(2,$description,PDO::PARAM_STR);
	$addPizza->bindParam(3,$price,PDO::PARAM_STR);
	$addPizza->bindParam(4,$type,PDO::PARAM_STR);
	$addPizza->bindParam(5,$img,PDO::PARAM_LOB);
	$addPizza->bindParam(6,$companyID,PDO::PARAM_INT);
	$pdo->beginTransaction();
	$addPizza->execute();
	$pdo->commit();
	//print_r($addPizza->errorInfo());
}
function addPizzaOrder($food_id,$pieces,$specialRequest,PDO $pdo){
	$userid = $_SESSION["userID"];
	global $dateTime;
	$addPizzaOrder = $pdo->prepare("insert into orderfood(food_id, user_id, pieces,specialRequest,date) VALUES (?,?,?,?,?)");
	$addPizzaOrder->bindParam(1,$food_id,PDO::PARAM_INT);
	$addPizzaOrder->bindParam(2,$userid,PDO::PARAM_INT);
	$addPizzaOrder->bindParam(3,$pieces,PDO::PARAM_INT);
	$addPizzaOrder->bindParam(4,$specialRequest,PDO::PARAM_STR);
	$addPizzaOrder->bindParam(5,$dateTime,PDO::PARAM_STR);
	$pdo->beginTransaction();
	$addPizzaOrder->execute();
	$pdo->commit();
	//print_r($addPizzaOrder->errorInfo());
}
/*read */
function read($query,$process,PDO $pdo){
	switch($process){
		case 1:
			$read = $pdo->prepare($query);
			$pdo->beginTransaction();
			$read->execute();
			$pdo->commit();
			$list = $read->fetch(PDO::FETCH_ASSOC);
			break;
		case 2:
			$read = $pdo->prepare($query);
			$pdo->beginTransaction();
			$read->execute();
			$pdo->commit();
			$list = $read->fetchAll(PDO::FETCH_ASSOC);
			break;
		default:
			break;
	}
	return $list;
}
/*update */
function updateOrderStatus($order_id,$status,PDO $pdo){
	$updateOrderS = $pdo->prepare("update orderfood set status=? where order_id=?");
	$updateOrderS->bindParam(1,$status,PDO::PARAM_INT);
	$updateOrderS->bindParam(2,$order_id,PDO::PARAM_INT);
	$pdo->beginTransaction();
	$updateOrderS->execute();
	$pdo->commit();
	//print_r($updateOrderS->errorInfo());
}
?>