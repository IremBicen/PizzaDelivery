<?php
session_start();
ob_start();
error_reporting(0);
if($_SESSION["key"] != ""){
$p = $_GET['p'];
$companyIDP = $_GET['cId'];
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
                                <li><a href="booking.php?p=3">Order</a></li>                                                                                         
                                <li><a href="booking.php?p=2">History</a></li>
                                <li><a href="func/ajaxControl.php?l=2">Logout</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header><br>
    <section class="bg-04" id="our-menu">';
        switch($p){
            case 1:
                echo'
                <div class="container">
                    <div class="row">
                        <div class="col-12" style="text-align:center;">
                            <div class="heading">
                                <span>Menu</span>
                                <h2>Explore Pizza</h2>
                                <p> this page views the available  pizza types in the restaurant you chose , Check it now ! </p>
                            </div>
                        </div>
                        <div class="col-12">                    
                            <div class="row" id="pizzaList"> 
                            </div>
                        </div>
                    </div>
                </div>';
                break;
            case 2:
                echo'
                <div class="container">
                    <div class="row">
                        <div class="col-12" style="text-align:center;">
                            <div class="heading">
                                <span>History</span>
                                <h2>Order History</h2>
                                <p>the orders you have ordered </p>
                            </div>
                        </div>
                        <div class="col-12">                    
                            <div class="row" id="orderHistory">
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Pizza Name</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Special Request</th>
                                                <th scope="col">Order Date</th>
                                            </tr>
                                            </thead>
                                            <tbody id="orderHistoryRead">
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>';
                break;
            case 3:
                echo'
                <div class="container">
                    <div class="row">
                        <div class="col-12" style="text-align:center;">
                            <div class="heading">
                                <span>Pizza</span>
                                <h2>Restaurant</h2>
                                <p>Those are the restaurants available in the system , check them now </p>
                            </div>
                        </div>
                        <div class="col-12">                    
                            <div class="row" id="companyList"> 

                            </div>
                        </div>
                    </div>
                </div>';
                break;
            default:
                echo'
                <div class="container">
                    <div class="row">
                        <div class="col-12" style="text-align:center;">
                            <div class="heading" style="text-align:center;">
                                <span>Menu</span>
                                <h2>Explore Pizza</h2>
                                <p> This page views the available  pizza restaurant in the system , Check it now !</p>
                            </div>
                        </div>
                        <div class="col-12">                    
                            <div class="row" id="pizzaList"> 
                            </div>
                        </div>
                    </div>
                </div>';
                break;
        }
    echo'
    </section>
    <script src="assets/js/jquery-3.2.1.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/plugins/owl.carousel.min.js"></script>
    <script src="assets/js/script.js"></script>
    <script src="assets/js/js.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <script type="text/javascript">
        pizzaList('.$companyIDP.');
        orderHistoryRead();
        companyList();
    </script>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Food Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="pizzaDetails">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="pizzaOrder()">Order</button>
            </div>
            </div>
        </div>
    </div>
</body>
</html>';   
}else{
    header("refresh:0;url=login.php");
}
?>