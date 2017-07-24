<?php
require_once "../context.php";

if (getLoggedInUser() != null && !issetGET("logout")) {
    redirect("home.php");
}

$errorMessage = issetGET("errors") ? "Invalid username or password" : "";
$logoutMessage = issetGET("logout") ? "Successfully logged out" : "";

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/common.css">
    <link rel="stylesheet" href="../assets/css/authForm.css">
</head>

<body>
<div class="container" id="container">
    <div class="row vertical-offset-100">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row-fluid user-row">
                        <img src="../assets/images/client.png" class="img-responsive"
                             alt="User placeholder"/>
                    </div>
                </div>
                <div class="panel-body">
                    <form accept-charset="UTF-8" action="../index.php" method="POST" class="form-signin" autocomplete="off">
                        <fieldset>
                            <div class="login-info text-center">
                                <label class="panel-login text-danger"><?=$errorMessage?></label>
                                <label class="panel-login text-success"><?=$logoutMessage?></label>
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Username" name="username" type="text" required="required">
                                <input class="form-control" placeholder="Password" name="password" type="password" required="required">
                            </div>
                            <input class="btn btn-lg btn-info btn-block" type="submit" id="login" value="Login" name="login-submit">
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="../assets/js/jquery-3.2.1.min.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>
<script src="../assets/js/jqueryExtensions.js"></script>
<script src="../assets/js/authForm.js"></script>

</body>

</html>
