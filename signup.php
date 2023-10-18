<?php
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
                                <li><a href="login.php">Login</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header><br>
    <section class="bg-04" id="our-menu">
        <div class="container">
            <div class="row">
                <div class="col-12" style="text-align:center;">
                    <div class="heading">
                        <span>Signup</span>
                        <h2>You can signup</h2>
                        <p>To sign up to the system please fill one of these forms. For customers fill the first form and for restaurants fill the second one.</p>
                        <div class="alert" role="alert" id="alert" style="display:none;">
                            #
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header" style="text-align:left;">
                                        For User
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="leftLabel">Name</label>
                                                <input type="text" id="nameC" class="form-control"> 
                                            </div>
                                            <div class="col-md-6">
                                                <label class="leftLabel">Last Name</label>
                                                <input type="text" id="last_nameC" class="form-control"> 
                                            </div>
                                            <div class="col-md-6">
                                                <label class="leftLabel">Phone Number</label>
                                                <input type="text" id="phone_numberC" class="form-control"> 
                                            </div>
                                            <div class="col-md-6">
                                                <label class="leftLabel">Address</label>
                                                <input type="text" id="addressC" class="form-control"> 
                                            </div>
                                            <div class="col-md-6">
                                                <label class="leftLabel">User Name</label>
                                                <input type="text" id="user_nameC" class="form-control"> 
                                            </div>
                                            <div class="col-md-6">
                                                <label class="leftLabel">Password</label>
                                                <input type="password" id="passwordC" class="form-control"> 
                                            </div>
                                        </div><br>
                                        <input type="submit" class="form-control" value="SignUp" onclick="addUser()">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header" style="text-align:left;">
                                        For Company
                                    </div>
                                    <form method="post" id="companyA" name="companyA" onsubmit="return addCompany();">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="leftLabel">Company Name</label>
                                                <input type="text" name="company_nameO" id="company_nameO" class="form-control"> 
                                            </div>
                                            <div class="col-md-6">
                                                <label class="leftLabel">Address</label>
                                                <input type="text" name="addressO" id="addressO" class="form-control"> 
                                            </div>
                                            <div class="col-md-6">
                                                <label class="leftLabel">Phone Number</label>
                                                <input type="text" name="phone_numberO" id="phone_numberO" class="form-control"> 
                                            </div>
                                            <div class="col-md-6">
                                                <label class="leftLabel">User Name</label>
                                                <input type="text" name="user_nameO" id="user_nameO" class="form-control"> 
                                            </div>
                                            <div class="col-md-6">
                                                <label class="leftLabel">Password</label>
                                                <input type="password" name="passwordO" id="passwordO" class="form-control"> 
                                            </div>
                                            <div class="col-md-6">
                                                <label class="leftLabel">Company Logo</label>
                                                <input type="file" name="img" id="img" class="form-control">
                                            </div>
                                        </div><br>
                                        <input type="submit" class="form-control" value="SignUp">
                                    </div>
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <section>
    <script src="assets/js/jquery-3.2.1.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/plugins/owl.carousel.min.js"></script>
    <script src="assets/js/script.js"></script>
    <script src="assets/js/js.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>
</html>';
?>