<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Login &mdash; Dona-Link</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="../backend_template/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="../backend_template/modules/fontawesome/css/all.min.css">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="../backend_template/modules/bootstrap-social/bootstrap-social.css">

  <!-- Template CSS -->
  <link rel="stylesheet" href="../backend_template/css/style.css">
  <link rel="stylesheet" href="../backend_template/css/components.css">
<!-- Start GA -->
{{-- <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-94034622-3');
</script> --}}
<!-- /END GA --></head>

<body>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
            <div class="card card-success">
              <div class="card-header"><h4>Register</h4></div>

              <div class="card-body">
                <form method="POST" action="/register">
                  @csrf
                  <div class="row">
                    <div class="form-group col-6">
                      <label for="frist_name">First Name</label>
                      <input id="frist_name" type="text" class="form-control" name="name" autofocus>
                    </div>
                    <div class="form-group col-6">
                      <label for="last_name">Phone Number</label>
                      <input id="last_name" type="text" class="form-control" name="mobile">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" class="form-control" name="email">
                    <div class="invalid-feedback">
                    </div>
                  </div>

                  <div class="row">
                    <div class="form-group col-6">
                      <label for="password" class="d-block">Password</label>
                      <input id="password" type="password" class="form-control pwstrength" data-indicator="pwindicator" name="password">
                      <div id="pwindicator" class="pwindicator">
                        <div class="bar"></div>
                        <div class="label"></div>
                      </div>
                    </div>
                    <div class="form-group col-6">
                      <label for="password2" class="d-block">Password Confirmation</label>
                      <input id="password2" type="password" class="form-control" name="password-confirm">
                    </div>
                  </div>

                

                  <div class="form-group">
                    <button type="submit" class="btn btn-success btn-lg btn-block">
                      Register
                    </button>
                  </div>
                </form>

                <div class="mt-5 text-muted text-center">
                  Already have an account? <a href="/login">Login</a>
                </div>
              </div>
            </div>
            <div class="simple-footer">
              Copyright &copy; Dona-Link 2023
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <!-- General JS Scripts -->
  <script src="../backend_template/modules/jquery.min.js"></script>
  <script src="../backend_template/modules/popper.js"></script>
  <script src="../backend_template/modules/tooltip.js"></script>
  <script src="../backend_template/modules/bootstrap/js/bootstrap.min.js"></script>
  <script src="../backend_template/modules/nicescroll/jquery.nicescroll.min.js"></script>
  <script src="../backend_template/modules/moment.min.js"></script>
  <script src="../backend_template/js/stisla.js"></script>
  
  <!-- JS Libraies -->

  <!-- Page Specific JS File -->
  
  <!-- Template JS File -->
  <script src="../backend_template/js/scripts.js"></script>
  <script src="../backend_template/js/custom.js"></script>
</body>
</html>