<?php include 'backend/conn.php'; ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <meta name="description" content="LP SYSTEM">
        <meta name="robots" content="noindex, nofollow">
        <title>Login - LP System</title>

		<!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">

		<!-- Bootstrap CSS -->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">

        <!-- Fontawesome CSS -->
		<link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
		<link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">

		<!-- Main CSS -->
        <link rel="stylesheet" href="assets/css/style.css">

    </head>
    <body class="account-page">

		<!-- Main Wrapper -->
        <div class="main-wrapper">
			<div class="account-content">
				<div class="login-wrapper">
                    <div class="login-content">
                        <div class="login-userset">
                            <div class="login-logo ">
                                <img src="logo/lp_logo.png" alt="img">
                            </div>
                            <div class="login-userheading">
                                <h3>Sign In</h3>
                                <h4>Please login to your account</h4>
                            </div>
                            <form class="" action="./backend/login_check.php" method="post">
                               <div class="form-login">
                                    <label>user name</label>
                                    <div class="form-addons">
                                        <input type="text" name="uname" placeholder="Enter your User Name">
                                        <img src="assets/img/icons/mail.svg" alt="img">
                                    </div>
                                </div>
                                <div class="form-login">
                                    <label>Password</label>
                                    <div class="pass-group">
                                        <input type="password" name="upass" class="pass-input" placeholder="Enter your password">
                                        <span class="fas toggle-password fa-eye-slash"></span>
                                    </div>
                                </div>
                                <!-- <div class="form-login">
                                    <div class="alreadyuser">
                                        <h4><a href="forgetpassword.html" class="hover-a">Forgot Password?</a></h4>
                                    </div>
                                </div> -->
                                <div class="form-login">
                                    <button type="submit" class="btn btn-login">Sign In</button>
                                </div>
                            </form>

                        </div>
                    </div>
                    <div class="login-img">
                        <img src="assets/img/login.jpg" alt="img">
                    </div>
                </div>
			</div>
        </div>
		<!-- /Main Wrapper -->


    <!-- jQuery -->
        <script src="assets/js/jquery-3.6.0.min.js"></script>

        <!-- Feather Icon JS -->
    <script src="assets/js/feather.min.js"></script>

    <!-- Slimscroll JS -->
    <script src="assets/js/jquery.slimscroll.min.js"></script>

    <!-- Select2 JS -->
    <script src="assets/plugins/select2/js/select2.min.js"></script>
    <script src="assets/plugins/select2/js/custom-select.js"></script>

    <!-- Datatable JS -->
    <script src="assets/js/jquery.dataTables.min.js"></script>
    <script src="assets/js/dataTables.bootstrap4.min.js"></script>

    <!-- Bootstrap Core JS -->
        <script src="assets/js/bootstrap.bundle.min.js"></script>

    <!-- Owl JS Added-->
    <script src="assets/plugins/owlcarousel/owl.carousel.min.js"></script>



    <!-- Sweetalert 2 -->
    <script src="assets/plugins/sweetalert/sweetalert2.all.min.js"></script>
    <script src="assets/plugins/sweetalert/sweetalerts.min.js"></script>

    <!-- Custom JS -->

    <!-- Datetimepicker JS -->
    <script src="assets/js/moment.min.js"></script>
    <script src="assets/js/bootstrap-datetimepicker.min.js"></script>

    <!-- Chart JS -->
    <script src="assets/plugins/apexchart/apexcharts.min.js"></script>
    <script src="assets/plugins/apexchart/chart-data.js"></script>

    <script src="assets/js/script.js"></script>
    <script type="text/javascript">
    <?php if(isset($_SESSION['error'])){ ?>
    Swal.fire({
    title: "Oops!",
    text: "Invalid User Name Or Password",
    icon: "danger",
    timer: 10000,
    timerProgressBar: true,
    showConfirmButton: true
    });

    <?php unset($_SESSION['error']); } ?>
    </script>
    </body>
</html>
