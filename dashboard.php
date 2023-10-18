<?php
include 'func/dbConnect.php';
$p = $_GET['p'];
session_start();
ob_start();
if($_SESSION["key"] != ""){
echo'
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Restarant</title>
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/font/flaticon.css">
        <link rel="stylesheet" href="assets/css/plugins/owl.carousel.min.css">
        <link rel="stylesheet" href="assets/css/style.css" />
        <link rel="stylesheet" href="assets/css/css.css" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    </head>
<body>
    <header>
        <div class="main-nav">
            <div class="container">
                <div class="row">
                    <div class="menu-toggle"></div>
                    <div class="logo">
                        <img src="assets/images/logo/logo.png">
                    </div>
                    <div class="my-nav">
                        <div class="menu">
                            <ul>
                                <li><a href="index.html">Home</a></li>
                                <li><a href="dashboard.php?p=2">Orders</a></li>
                                <li><a href="dashboard.php?p=1">Add Pizza</a></li>
                                <li><a href="func/ajaxControl.php?l=2">Exit</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header><br>';
    switch($p){
        case 1:
            echo'
            <section class="bg-04" id="our-menu">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="heading">
                                <span>Add Pizza</span>
                                <h2>You can add new pizza</h2>
                                <p>Here restaurant can add pizza items to your menu </p>
                                <form method="post" id="pizzaA" name="pizzaA" onsubmit="return addPizza();">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="leftLabel">Pizza Name</label>
                                        <input type="text" name="pizzaName" id="pizzaName" class="form-control"> 
                                    </div>
                                    <div class="col-md-6">
                                        <label class="leftLabel">Description</label>
                                        <input type="text" name="description" id="description" class="form-control"> 
                                    </div>
                                    <div class="col-md-6">
                                        <label class="leftLabel">Price</label>
                                        <input type="text" name="price" id="price" class="form-control"> 
                                    </div>
                                    <div class="col-md-6">
                                        <label class="leftLabel">Type</label>
                                        <select id="type" name="type" id="type" class="form-control">
                                            <option value="Big">Big</option>
                                            <option value="Small">Small</option>
                                        <select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="leftLabel">Picture</label>
                                        <input type="file" name="img" id="img" class="form-control">
                                    </div>
                                    <input type="submit" class="form-control" style="margin-top:20px;">
                                </div><br>
                                </form>
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Pizza Name</th>
                                                <th scope="col">Description</th>
                                                <th scope="col">Price</th>
                                                <th scope="col">Type</th>
                                            </tr>
                                            </thead>
                                            <tbody id="pizzaRead">
                                            
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>';
            break;
        case 2:
            echo'
            <section class="bg-04" id="our-menu">
                <div class="container">
                    <div class="row">
                        <div class="col-12" style="text-align:center;" >
                            <div class="heading">
                                <span>Pizza Orders</span>
                                <h2>You can see orders</h2>
                                <p>the orders that  you received </p>
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Pizza Name</th>
                                                <th scope="col">Pieces</th>
                                                <th scope="col">Type</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Special Request</th>
                                                <th scope="col">Order Date</th>
                                            </tr>
                                            </thead>
                                            <tbody id="orderRead">
                                            
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>';
            break;
        default:
            break;
    }
    echo'
    <script src="assets/js/jquery-3.2.1.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/plugins/owl.carousel.min.js"></script>
    <script src="assets/js/script.js"></script>
    <script src="assets/js/js.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <script type="text/javascript">
        pizzaRead();
        orderRead();
    </script>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Food Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="orderDetails">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="updateOrderStatus()">Status Change</button>
            </div>
            </div>
        </div>
    </div>
</body>
</html>';
}else{
    header("refresh:0;url=index.html");
}
?>