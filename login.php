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
                                <li><a href="signup.php">SignUP</a></li>                      
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
                <div class="col-12" style="text-align:center;" >
                    <div class="heading">
                        <span>Login</span>
                        <h2>You can login</h2>
                        <p>please enter the username and password to enter the system </p>
                        <div class="alert" role="alert" id="alert" style="display:none;">
                            #
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="leftLabel">Name</label>
                                <input type="text" id="name" class="form-control"> 
                            </div>
                            <div class="col-md-6">
                                <label class="leftLabel">Password</label>
                                <input type="password" id="password" class="form-control"> 
                            </div>
                        </div><br>
                        <input type="submit" onclick="loginUser()" class="form-control" value="Login">
                    </div>
                </div>
            </div>
        </div>
    </section>
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