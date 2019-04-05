<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/fontawesome-all.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/theme.css">
</head>
<body>
    <div class="form-body" class="container-fluid">
        <div class="row">
            <div class="form-holder">
                <div class="form-content">
                    <div class="form-items">
                        <div class="website-logo-inside">
                            <a href="index.html">
                                <div class="logo">
                                    <img class="logo-size" src="../source/img/kemhan.png" alt="">
                                </div>
                            </a>
                        </div>
                        <h3>Kementerian Pertahanan</h3>
                        <p>Border Monitoring System</p>
                        <div class="page-links">
                            <a href="#" class="active">Login</a>
                        </div>
                        <form action="../auth.php" method="post" name="Login_Form">
                            <input class="form-control" type="text" name="Username" placeholder="E-mail Address" required>
                            <input class="form-control" type="password" name="Password" placeholder="Password" required>
                            <?php if(isset($msg)){?>
                                    <?php echo $msg;?>

                             <?php } ?>
                            <div class="form-button">
                                <button id="submit" name="Submit" type="submit" class="ibtn">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/popper.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/main.js"></script>
</body>
</html>
