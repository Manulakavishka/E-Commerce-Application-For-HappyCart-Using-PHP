<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="icon" href="resources/img/logo.svg">
  <title>Happy Cart | Admins Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">


  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="plugins/toastr/toastr.min.css">

  <link rel="stylesheet" href="style.css">
</head>

<body class="hold-transition login-page" style="background-color: #74EBD5; background-image: linear-gradient(90deg,#74EBD5 0%,#9FACE6 100%);">
  <div class="alert alert-success d-none" id="alart">
  </div>
  <div class="col-6 vertical-center12">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <a href="index.php" class="h1"><b>Happy Cart</b></a>
      </div>
      <div class="card-body">
        <p class="login-box-msg">Welcome to Happy Cart Admins</p>

        <form action="index3.html" method="post">
          <div class="input-group mb-3">
            <input type="email" class="form-control" placeholder="Email" id="em">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <!-- /.col -->
            <div class="col-6">
              <button type="button" class="btn btn-primary btn-block swalDefaultWarning" onclick="adminVerification();">Send Verification Code to Login</button>
            </div>
            <div class="col-6">
              <button type="button" class="btn btn-warning btn-block swalDefaultWarning" onclick="backtologin();">Back to Customer Login</button>
            </div>
            <!-- /.col -->
          </div>
        </form>

      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.login-box -->

  <!-- modal -->
  <div class="modal" tabindex="-1" id="verificationModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Admin Verification</h5>
        </div>
        <div class="modal-body">
          <label class=" form-label">Enter the Verification code you got by an email</label>
          <input type="text" class=" form-control" id="vcode">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" onclick="verify();">Verify</button>
        </div>
      </div>
    </div>
  </div>
  <!-- modal -->


  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.min.js"></script>

  <!-- SweetAlert2 -->
  <script src="plugins/sweetalert2/sweetalert2.min.js"></script>
  <!-- Toastr -->
  <script src="plugins/toastr/toastr.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="dist/js/demo.js"></script>
  <!-- Page specific script -->

  <script src="bootstrap.js"></script>
  <script src="script.js"></script>

</body>

</html>