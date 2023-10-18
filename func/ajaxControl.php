<?php
ob_start();
include('func.php');
session_start();
$i = secureData($_GET['i']);
$r = secureData($_GET['r']);
$l = secureData($_GET['l']);
$u = secureData($_GET['u']);
switch($l){
	case 1:
		$name = secureData($_POST['name']);
		$password = secureData($_POST['password']);
		try{
			echo login($name,$password,$connect);
		}catch(Exception $e){
			echo 2;
		}
		break;
	case 2:
		if(logout() == 1){
			header("refresh:0;url=../index.html");
		}
		break;
	default:
		break;
}
switch($i){
	case 1:
		$name = secureData($_POST['name']);
		$lastName = secureData($_POST['lastName']);
		$phone_number = secureData($_POST['phone_number']);
		$address = secureData($_POST['address']);
		$user_name = secureData($_POST['user_name']);
		$password = secureData($_POST['password']);
		$type = 0;
		try{
			userAdd($name,$lastName,$phone_number,$address,$user_name,$password,$type,$connect);
			echo 1;
		}catch(Exception $e){
			echo 2;
		}
		break;
	case 2:
		$company_name = secureData($_POST["company_nameO"]);
		$address = secureData($_POST["addressO"]);
		$phone_number = secureData($_POST["phone_numberO"]);
		$user_name = secureData($_POST["user_nameO"]);
		$password = secureData($_POST["passwordO"]);
		$img = fopen($_FILES["img"]["tmp_name"], 'rb');
		$type = 1;		
		try{
			echo companyAdd($company_name,$address,$phone_number,$user_name,$password,$type,$img,$connect);
			echo 1;
		}catch(Exception $e){
			echo 2;
		}
		break;
	case 3:
		$pizzaName = secureData($_POST["pizzaName"]);
		$description = secureData($_POST["description"]);
		$price = secureData($_POST["price"]);
		$type = secureData($_POST["type"]);
		$img = fopen($_FILES["img"]["tmp_name"], 'rb');
		$companyID = companyInformation()[0];
		echo $companyID;
		try{
			echo addPizza($pizzaName,$description,$price,$type,$img,$companyID,$connect);
			echo 1;
		}catch(Exception $e){
			echo 2;
		}
		break;
	case 4:
		$food_id = secureData($_POST["food_id"]);
		$pieces = secureData($_POST["pieces"]);
		$specialRequest = secureData($_POST["specialRequest"]);
		try{
			echo addPizzaOrder($food_id,$pieces,$specialRequest,$connect);
			echo 1;
		}catch(Exception $e){
			echo 2;
		}
		break;
	default:
		break;
}

switch($r){
	case 1:
		$listPizza = read("select * from food",2,$connect);
		$i = 0;
		foreach($listPizza as $data){
			$i += 1;
			echo'
			<tr>
				<td>'.$i.'</td>
				<td>'.$data['name'].'</td>
				<td>'.$data['description'].'</td>
				<td>'.$data['price'].'</td>
				<td>'.$data['type'].'</td>
			</tr>';
		}
		break;
	case 2:
		$companyID = $_POST['companyID'];
		$listPizza = read("select f.food_id,f.description,f.name as food_name,f.price,f.type,f.img,c.name as company_name from food as f inner join company as c on f.companyid=c.company_id where c.company_id=".$companyID,2,$connect);
		foreach($listPizza as $data){
			echo'
			<div class="col-md-4 col-sm-6">
				<div class="wrapper">
					<div class="tab-content">
						<figure>
							<img src="imageblob.php?id='.$data['food_id'].'&t=1">
						</figure>
						<div class="sentence">
							<h3>'.$data['food_name'].'<span>'.$data['price'].' TL</span></h3>
							<h6>'.$data['company_name'].'</h6>
							<p>'.$data['description'].'</p>
						</div>
						<div class="rate-box" style="float: right;">
							<div class="plus">
								<a onclick="pizzaDetails('.$data['food_id'].')" data-bs-toggle="modal" data-bs-target="#exampleModal"><span class="flaticon-plus"></span></a>
							</div>
						</div>
					</div>
				</div>
			</div>';
		}
		break;
	case 3:
		$food_id = $_POST['food_id'];
		$listPizza = read("select f.food_id,f.description,f.name as food_name,f.price,f.type,f.img,c.name as company_name from food as f inner join company as c on f.companyid=c.company_id where food_id=".$food_id,2,$connect);
		foreach($listPizza as $data){
			echo'
			<div class="alert" role="alert" id="alert" style="display:none;">
            </div>
			<div class="col-md-12 col-sm-12">
				<div class="wrapper">
					<div class="tab-content">
						<div class="row">
							<div class="col-md-3">
								<figure>
									<img src="imageblob.php?id='.$data['food_id'].'&t=1">
								</figure>
							</div>
							<div class="col-md-9">
								<div class="sentence">
									<h3>'.$data['food_name'].'n<span style="float:right;">'.$data['price'].' TL</span></h3>
									<h6>'.$data['company_name'].'</h6>
									<p>'.$data['description'].'</p>
								</div>
								<label>Pieces</label>
								<input type="number" value="1" class="form-control" id="pieces">
								<label>Special Request</label>
								<textarea class="form-control" placeholder="i don\'t want to onion" id="specialRequest"></textarea>
								<input type="hidden" id="food_id" value="'.$data['food_id'].'">
							</div>
						</div>
					</div>
				</div>
			</div>';
		}
		break;
	case 4:
		$listOrder = read("select * from orderfood as ofood inner join food as f on f.food_id=ofood.food_id where f.companyid=".companyInformation()[0]." and ofood.status!=3 order by ofood.order_id desc",2,$connect);
		$i = 0;
		foreach($listOrder as $data){
			$i += 1;
			echo'
			<tr onclick="orderStatusFill('.$data['order_id'].')" data-bs-toggle="modal" data-bs-target="#exampleModal">
				<td>'.$i.'</td>
				<td>'.$data['name'].'</td>
				<td>'.$data['pieces'].'</td>
				<td>'.$data['type'].'</td>';
				if($data['status'] == 0){
					echo'
					<td>you get new order</td>';
				}else if($data['status'] == 1){
					echo'
					<td>Shipped</td>';
				}else if($data['status'] == 2){
					echo'
					<td>On the way</td>';
				}else if($data['status'] == 3){
					echo'
					<td>was delivered</td>';
				}
				$dateOrder = new DateTime($data['date']);
				echo'
				<td>'.$data['specialRequest'].'</td>
				<td>'.$dateOrder->format('d-m-Y H:i:s').'</td>
			</tr>';
		}
		break;
	case 5:
		$orderID = $_POST['orderID'];
		$listOrder = read("select ofood.order_id,f.name as food_name,f.price,com.name as company_name,f.description,ofood.status,f.food_id,c.phone_number as customer_phonenumber,c.name as customer_name,c.last_name as customer_lastname,c.address as customer_address from orderfood as ofood inner join food as f on f.food_id=ofood.food_id inner join user as u on u.user_id=ofood.user_id  inner join customer as c on c.user_id = u.user_id inner join company as com on com.company_id=f.companyid where ofood.order_id=".$orderID,2,$connect);
		foreach($listOrder as $data){
			echo'
			<div class="alert" role="alert" id="alert" style="display:none;">
            </div>
			<div class="col-md-12 col-sm-12">
				<div class="wrapper">
					<div class="tab-content">
						<div class="row">
							<div class="col-md-3">
								<figure>
									<img src="imageblob.php?id='.$data['food_id'].'&t=1">
								</figure>
							</div>
							<div class="col-md-9">
								<div class="sentence">
									<h3>'.$data['food_name'].'<span style="float:right;">'.$data['price'].' TL</span></h3>
									<h6>'.$data['company_name'].'</h6>
									<p>'.$data['description'].'</p>
								</div>
								<label>Pieces</label>
								<input type="number" value="1" class="form-control" id="pieces" disabled>
								<label>Special Request</label>
								<textarea class="form-control" placeholder="i don\'t want to onion" id="specialRequest" disabled></textarea>
								<label>Status</label>
								<select class="form-select" id="status">
									<option></option>';
									if($data['status'] == 0){
										echo'
										<option value="0" selected>you get new order</option>
										<option value="1">Shipped</option>
										<option value="2">On the way</option>
										<option value="3">was delivered</option>';
									}else if($data['status'] == 1){
										echo'
										<option value="0">you get new order</option>
										<option value="1" selected>Shipped</option>
										<option value="2">On the way</option>
										<option value="3">was delivered</option>';
									}else if($data['status'] == 2){
										echo'
										<option value="0">you get new order</option>
										<option value="1">Shipped</option>
										<option value="2" selected>On the way</option>
										<option value="3">was delivered</option>';
									}else if($data['status'] == 3){
										echo'
										<option value="0">you get new order</option>
										<option value="1">Shipped</option>
										<option value="2">On the way</option>
										<option value="3" selected>was delivered</option>';
									}else{
										echo'
										<option value="0">you get new order</option>
										<option value="1">Shipped</option>
										<option value="2">On the way</option>
										<option value="3">was delivered</option>';
									}
								echo'									
								</select>
								<input type="hidden" id="order_id" value="'.$orderID.'">
							</div>
						</div>
						<div class="row">
							<div class="col-md-12"><hr>
								<h3><u>Customer Information</u></h3>
								<div class="row">
									<div class="col-md-6 col-sm-6">
										<div class="content">
											<h5>Name and Surname</h5>
											<p>'.$data['customer_name'].' '.$data['customer_lastname'].'</p>
										</div>
									</div>
									<div class="col-md-6 col-sm-6">
										<div class="content">
											<h5>Phone Number</h5>
											<p>'.$data['customer_phonenumber'].'</p>
										</div>
									</div>
									<div class="col-md-6 col-sm-12">
										<div class="content">
											<h5>Address</h5>
											<p>'.$data['customer_address'].'</p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>';
		}
		break;
	case 6:
		$userID = $_SESSION["userID"];
		$listOrder = read("select * from orderfood as ofood inner join food as f on f.food_id=ofood.food_id where ofood.user_id=".$userID." order by ofood.order_id desc",2,$connect);
		$i = 0;
		foreach($listOrder as $data){
			$i += 1;
			echo'
			<tr>
				<td>'.$i.'</td>
				<td>'.$data['name'].'</td>';
				if($data['status'] == 0){
					echo'
					<td>you get new order</td>';
				}else if($data['status'] == 1){
					echo'
					<td>Shipped</td>';
				}else if($data['status'] == 2){
					echo'
					<td>On the way</td>';
				}else if($data['status'] == 3){
					echo'
					<td>was delivered</td>';
				}
				$dateOrder = new DateTime($data['date']);
				echo'
				<td>'.$data['specialRequest'].'</td>
				<td>'.$dateOrder->format('d-m-Y H:i:s').'</td>
			</tr>';
		}
		break;
	case 7:
		$listPizza = read("select * from food where companyid=".companyInformation()[0],2,$connect);
		$i = 0;
		foreach($listPizza as $data){
			$i += 1;
			echo'
			<tr>
				<td>'.$i.'</td>
				<td>'.$data['name'].'</td>
				<td>'.$data['description'].'</td>
				<td>'.$data['price'].'</td>
				<td>'.$data['type'].'</td>
			</tr>';
		}
		break;
	case 8:
		$listCompany = read("select * from company",2,$connect);
		foreach($listCompany as $data){
			echo'
			<div class="col-md-2 col-sm-3" onclick="location.href=\'booking.php?p=1&cId='.$data['company_id'].'\'" style="cursor:pointer;">
				<div class="wrapper">
					<div class="tab-content">
						<figure style="text-align: center !important;">
							<img src="imageblob.php?id='.$data['company_id'].'&t=2" height="60">
						</figure>
						<div class="sentence">
							<h3>'.$data['name'].'</h3>
							<h6>'.$data['address'].'</h6>
						</div>
					</div>
				</div>
			</div>';
		}
		break;
}
/*update */
switch($u){
	case 1:
		$order_id = $_POST['order_id'];
		$status = $_POST['status'];
		try{
			echo updateOrderStatus($order_id,$status,$connect);
			echo 1;
		}catch(Exception $e){
			echo 2;
		}
		break;
}

?>