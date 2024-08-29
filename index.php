<?php

session_start();
include('connection.php');


if (isset($_POST['submit'])) {
    unset($_SESSION['invalid-email']);
    unset($_SESSION['invalid-password']);

    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($connection, $query);
    $record = mysqli_fetch_assoc($result);

    if ($record) {
        if ($record['password'] == $password) {
            if ($record['role'] == 'admin') {
                $_SESSION['id'] = $record['id'];
                $_SESSION['name'] = $record['name'];
                $_SESSION['email'] = $record['email'];
                header('Location: admin/admin.php');
                exit();
            } elseif ($record['role'] == 'user') {
                $_SESSION['id'] = $record['id'];
                $_SESSION['name'] = $record['name'];
                $_SESSION['email'] = $record['email'];
                header('Location: user/user.php');
                exit();
            } elseif ($record['role'] == 'teacher') {
                $_SESSION['id'] = $record['id'];
                $_SESSION['name'] = $record['name'];
                $_SESSION['email'] = $record['email'];
                header('Location: teacher/teacher.php');
                exit();
            }
        } else {
            $_SESSION['invalid-password'] = 'Invalid password';
        }
    } else {
        $_SESSION['invalid-email'] = 'Invalid email';
    }
    
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>SofticEra - Quiz Website</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">
    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">
    <!-- =======================================================
  * Template Name: NiceAdmin
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Updated: Apr 20 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>
<body>
    <main>
        
           <?php
             $_SESSION['welcome'] = 'if log in to as a student you will seen only tests , whenever if you log in admin & teachers you can see all test , categories, teachers and students';
             
           
           if (isset($_SESSION['welcome'])){ ?>
                    <div class="alert  alert-dismissible fade show py-3 my-2 text-center bg-primary bg-gradient" role="alert">
                        <?php echo $_SESSION['welcome']; ?>!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php
           }
           unset($_SESSION['welcome']);
           ?>
        <div class="container">
            <section class="section register min-vh-50 d-flex flex-column align-items-center justify-content-center py-2">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
                            <div class="d-flex justify-content-center py-4">
                                <a href="index.html" class="logo d-flex align-items-center w-auto">
                                    <img src="assets/img/logo.png" alt="">
                                    <span class="d-none d-lg-block">SofticEra</span>
                                </a>
                            </div><!-- End Logo -->
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="pt-4 pb-2">
                                        <?php
                                        if (isset($_SESSION['registered'])) { ?>
                                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                <?php echo $_SESSION['registered']; ?>!
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                        <?php
                                            unset($_SESSION['registered']);
                                        }
                                        ?>
                                        <?php
                                        if (isset($_SESSION['message'])) { ?>
                                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                <?php echo $_SESSION['message']; ?>!
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                        <?php
                                            unset($_SESSION['message']);
                                        }
                                        ?>
                                        <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                                        <p class="text-center small">Enter your username & password to login</p>
                                    </div>

                                    <form action="#" method="post" class="row g-3 needs-validation" novalidate>
                                        <div class="col-12">
                                            <label for="yourEmail" class="form-label">Email</label>
                                            <input type="email" name="email" class="form-control" id="yourEmail" required>
                                            <div class="invalid-feedback">Please enter your Email!</div>
                                        </div>
                                        <?php
                                        if (isset($_SESSION['invalid-email'])) { ?>
                                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                <?php echo $_SESSION['invalid-email']; ?>
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                        <?php
                                            unset($_SESSION['invalid-email']);
                                        }
                                        ?>
                                        <div class="col-12">
                                            <label for="yourPassword" class="form-label">Password</label>
                                            <input type="password" name="password" class="form-control" id="yourPassword" required>
                                            <div class="invalid-feedback">Please enter your password!</div>
                                        </div>
                                        <?php
                                        if (isset($_SESSION['invalid-password'])) { ?>
                                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                <?php echo $_SESSION['invalid-password']; ?>
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                        <?php
                                            unset($_SESSION['invalid-password']);
                                        }
                                        ?>
                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">
                                                <label class="form-check-label" for="rememberMe">Remember me</label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <input name="submit" value="Login" type="submit" class="btn btn-primary w-100">
                                        </div>
                                        <div class="col-12">
                                            <p class="small mb-0">Don't have an account? <a href="register.php">Create an account</a></p>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="credits">
                                <!-- All the links in the footer should remain intact. -->
                                <!-- You can delete the links only if you purchased the pro version. -->
                                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
                                Designed by <a href="https://www.instagram.com/_talha_official13">M Talha</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main><!-- End #main -->
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
    <!-- Vendor JS Files -->
    <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/chart.js/chart.umd.js"></script>
    <script src="assets/vendor/echarts/echarts.min.js"></script>
    <script src="assets/vendor/quill/quill.js"></script>
    <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>
    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>
</body>

</html>