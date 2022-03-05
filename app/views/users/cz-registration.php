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

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-9 col-md-12">
                <div class="row">
                    <div class="col-md-6 mx-auto">
                        <div class="mt-5">
                            <?php flash('create_success'); ?>
                            <h2>Create Admin</h2>
                            <p>Please complete all field to create admin</p>
                            <form action="<?php echo URLROOT; ?>/users/cz_admin" method="post">
                                <div class="form-group">
                                    <label for="name"><strong>First Name: <sup>*</sup></strong></label>
                                    <input type="text" name="firstName" class="form-control form-control <?php echo (!empty($data['first_name_err'])) ? 'is-invalid' : ''; ?>">
                                    <span class="invalid-feedback"><?php echo $data['first_name_err']; ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="old_password"><strong>Last Name: <sup>*</sup></strong></label>
                                    <input type="text" name="lastName" class="form-control form-control <?php echo (!empty($data['last_name_err'])) ? 'is-invalid' : ''; ?>">
                                    <span class="invalid-feedback"><?php echo $data['last_name_err']; ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="password"><strong>User Id: <sup>*</sup></strong></label>
                                    <input type="text" name="userId" class="form-control form-control <?php echo (!empty($data['user_id_err'])) ? 'is-invalid' : ''; ?>">
                                    <span class=" invalid-feedback"><?php echo $data['user_id_err']; ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="confirm_password"><strong>Password: <sup>*</sup></strong></label>
                                    <input type="text" name="password" class="form-control form-control <?php echo (!empty($data['password_err'])) ? 'is-invalid' : ''; ?>">
                                    <span class="invalid-feedback"><?php echo $data['password_err']; ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="confirm_password"><strong>Confirm Password: <sup>*</sup></strong></label>
                                    <input type="text" name="confirm_password" class="form-control form-control <?php echo (!empty($data['confirm_password_err'])) ? 'is-invalid' : ''; ?>">
                                    <span class="invalid-feedback"><?php echo $data['confirm_password_err']; ?></span>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <input type="submit" value="Create Admin" class="btn btn-success btn-block" name="btnCreate">
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script src="<?php echo URLROOT ?>/js/login.js"></script>


</body>

</html>