<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../resources/css/bootstrap.min.css">
    <link rel="stylesheet" href="../resources/css/authForm.css">
</head>

<body>
<div class="container" id="container">
    <div class="row vertical-offset-100">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row-fluid user-row">
                        <img src="../resources/images/client.png" class="img-responsive"
                             alt="User placeholder"/>
                    </div>
                </div>
                <div class="panel-body">
                    <form accept-charset="UTF-8" role="form" class="form-signin" autocomplete="off">
                        <fieldset>
                            <div class="text-center text-error">
                                <label class="panel-login"></label>
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Username" id="username">
                                <input class="form-control" placeholder="Password" id="password"
                                       type="password">
                            </div>
                            <input class="btn btn-lg btn-info btn-block" type="submit" id="login" value="Login">
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="../resources/js/jquery-3.2.1.min.js"></script>
<script src="../resources/js/bootstrap.min.js"></script>
<script src="../resources/js/authForm.js"></script>
</body>

</html>
