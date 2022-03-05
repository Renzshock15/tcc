<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITENAME ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/all.js" integrity="sha384-xymdQtn1n3lH2wcu0qhcdaOpQwyoarkgLVxC/wZ5q7h9gHtxICrpcaSUfygqZGOe" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
    <link rel="stylesheet" href="<?php echo URLROOT ?>/css/login.css">
    <!--<link rel="stylesheet" href="bootstrap\css\bootstrap.min.css">-->

</head>

<body>

    <div class="container-fluid bg">
        <div class="page-logo">
            <img src="<?php echo URLROOT; ?>/images/zoneclaudians.svg" width="250" alt="">
        </div>
        <div class="row justify-content-center">
            <form class="form-container" method="post" id="loginForm" action="<?php echo URLROOT; ?>/users/login">
                <?php if (!empty($data['errorMsg'])) : ?>
                    <div class="login-errors" id="error"><strong>LOGIN FAILED: </strong><?php echo $data['errorMsg']; ?></div>
                <?php endif; ?>
                <div class="form-logo">
                    <img src="<?php echo URLROOT; ?>/images/tcclogo.png" width="100px" height="100px" alt="">
                </div>
                <div class="form-group mt-2 border-bottom">
                    <div class="input-group-prepend">
                        <div class="input-group-text txticon"><i class="fa fa-user" aria-hidden="true"></i></div>
                        <input class="txt" type="text" class="form-control" id="student-no" name="txtstudent-no" aria-describedby="emailHelp" placeholder="Student No. / Employee Id.">
                    </div>
                </div>
                <div class="form-group mt-5 border-bottom">
                    <div class="input-group-prepend">
                        <div class="input-group-text txticon"><i class="fa fa-lock" aria-hidden="true"></i></div>
                        <input class="txt" type="password" class="form-control" id="student-password" name="txtpassword" placeholder="Password">
                        <div class="input-group-text txticon"><span onclick="readPassword()"><i class="fa fa-eye" aria-hidden="true" id="hide1"></i><i class="fa fa-eye-slash" aria-hidden="true" id="hide2"></i></span></div>
                    </div>
                </div>
                <div class="form-group form-check text-white mt-4">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Remember me</label>
                </div>
                <button type="submit" class="btn btn-success btn-block mt-4" name="btn-login">Login</button>
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script src="<?php echo URLROOT ?>/js/login.js"></script>

    <?php require APPROOT . '/views/inc/logineffects.php'; ?>
</body>

</html>