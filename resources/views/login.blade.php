<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Purple Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('template/assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/assets/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('css\bootstrap.min.css') }}" />
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('template/assets/css/style.css') }}">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{ asset('template/assets/images/favicon.ico') }}" />
  </head>
  <body>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth">
          <div class="row flex-grow">
            <div class="col-lg-4 mx-auto">
              <div class="auth-form-light text-left p-5">
                <div class="" style = "text-align: center;">
                  <img src="{{ asset('template/assets/images/profile4_23040.ico') }}">
                </div>
                <h5 class="font-weight-light">Veillez-vous connectez</h5>
                <form class="pt-3">
                    <div class="form-group row ml-1">
                        <label for="" class="col-md-5 col-form-label ">Votre email <b class="red" ></b> :</label>
                        <input type="email" class="form-control" id="email_client" placeholder="Email" name="email_client" value="" required>
                    </div>
                  <div class="mt-3" style = "text-align: center;">
                    <a class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn"  href="../../index.html">Suivant</a>
                  </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{ asset('template/assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('template/assets/js/off-canvas.js') }}"></script>
    <script src="{{ asset('template/assets/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('template/assets/js/misc.js') }}"></script>
    <!-- endinject -->
  </body>
</html>