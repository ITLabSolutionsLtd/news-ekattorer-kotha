<!DOCTYPE html>
<html lang="en" class="loading">

  <head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
      <meta name="title" content="noindex">

      <title>Login | Ekattorer Kotha </title>

      <link rel="shortcut icon" type="image/png" href="<?= base_url('assets/panel/images/i-news.jfif') ?>">
      <link rel="stylesheet" type="text/css" href="<?= base_url('assets/app-assets/fonts/font-awesome/css/font-awesome.min.css'); ?>">
      <link rel="stylesheet" type="text/css" href="<?= base_url('assets/app-assets/css/app.css'); ?>">

      <style>
          .erp{background: #e51c1c; color: white; text-align: center; border-radius: 2px; padding: 5px 0;}
          @media(min-width: 991px) {
              .login-form { height: 0px;  }
              .login-form img { display: none; }
          }
          #error_msg p{
            background: #e51c1c; color: white; text-align: center; border-radius: 2px; padding: 5px 0;
          }
      </style>
      
      <script src='https://www.google.com/recaptcha/api.js'></script>
  </head>
  <!-- END : Head-->

  <!-- BEGIN : Body-->

  <body data-col="1-column" class=" 1-column layout-dark blank-page">
      <?php
    $login = array(
      'name'  => 'login',
      'id'  => 'login',
      'value' => set_value('login'),
      'maxlength'  => 80,
      'size'  => 30,
    );

    if ($login_by_username and $login_by_email) {
      $login_label = 'Email or login';
    } else if ($login_by_username) {
      $login_label = 'Login';
    } else {
      $login_label = 'Email';
    }

    $password = array('name' => 'password', 'id'  => 'password', 'size'  => 30,);
    $remember = array('name' => 'remember', 'id' => 'remember', 'value' => 1, 'checked' => set_value('remember'), 'style' => 'margin:0;padding:0',);
    $captcha = array('name' => 'captcha', 'id' => 'captcha', 'maxlength' => 8,);
    ?>
          <!-- ////////////////////////////////////////////////////////////////////////////-->
          <div class="wrapper">
              <div class="main-panel">
                  <div class="main-content">
                      <div class="content-wrapper">
                          <section id="login">
                              <div class="container-fluid">
                                  <div class="row full-height-vh m-0">
                                      <div class="col-12 d-flex align-items-center justify-content-center">
                                          <div class="card">
                                              <div class="card-content">
                                                  <div class="card-body login-img">
                                                      <div class="row  m-0">
                                                          <div class="col-lg-6 d-lg-flex align-content-center align-items-center d-none py-2 text-center align-middle" style="background: linear-gradient(360deg, black, transparent);">
                                                              <div style="display:block; justify-content: center; width: 400px; padding: 25px;">
                                                                  <a href="#"><img src="<?= base_url('images/ekattorer-kotha-logo.png') ?>" alt="" class="img-fluid " style=" width: 100%; "></a>
                                                              </div>
                                                          </div>

                                                          <div class="col-lg-6 col-md-12 bg-white px-4 pt-3">
                                                              <div class="login-form">
                                                                  <center>
                                                                      <img src="<?= base_url('images/ekattorer-kotha-logo.png') ?>" alt="" class="img-fluid mb-2 "  width="100%">
                                                                  </center>
                                                              </div>
                                                              <form class="login100-form validate-form" action='<?php echo base_url(); ?>auth/login' method='POST'>
                                                                  <h4 class="mb-2 card-title text-center">Login</h4>
                                                                  <p class="card-text mb-3">
                                                                      <hr>
                                                                  </p>
                                                                  <div id="error_msg" >
                                                                      <?php
                                                                            echo form_error($login['name']);
                                                                            echo form_error($password['name']);
                                                                            echo isset($errors[$password['name']]) ? $errors[$password['name']] : '';
                                                                      ?>
                                                                  </div>
                                                                  
                                                                    <?php if($Error_Message){ ?>
                                                                        <div>
                                                                            <p class="erp"><?php echo $Error_Message;?></p>
                                                                        </div>
                                                                    <?php } ?>

                                                                  <?php echo form_input($login, '', 'class="form-control mb-3" placeholder="Username"'); ?>
                                                                  <?php echo form_password($password, '', 'class="form-control mb-1 pwd  input-field" placeholder="Password"'); ?>

                                                                  <input type="checkbox" class="reveal mt-2 mb-3"> Show Password
                                                                  
                                                                  
                                                                  <br>
                                                                  <div class="g-recaptcha" data-sitekey="<?php echo $this->config->item('google_key') ?>"></div> 
                                                                  <br/>
                                                                  
                                                                  
                                                                  <div class="fg-actions text-right">
                                                                      <div class=" text-right">
                                                                          <button class="btn btn-primary" style="width: 100%">
                                                                              Sign In
                                                                          </button>
                                                                      </div>
                                                                  </div>
                                                                  <hr class="m-0">
                                                                  <center>
                                                                      <div class="social-login-options mt-3">
                                                                          <a href="https://itlabsolutions.com" target="_blank">
                                                                            <img src="<?= base_url('images/itlabsolutions.png') ?>" alt="" class="img-fluid mb-2" width="70" height="70">
                                                                          </a>
                                                                      </div>
                                                                      <div class="">
                                                                          <div class="option-login">
                                                                              <h6 class="text-decoration-none text-center">Developed by <a style="font-weight: bolder" href="https://www.itlabsolutions.com" target="_blank" ><strong>IT Lab Solutions Ltd.</strong></a> </h6>
                                                                          </div>
                                                                      </div>
                                                                  </center>
                                                              </form>
                                                          </div>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </section>
                      </div>
                  </div>
              </div>
          </div>
          <!-- ////////////////////////////////////////////////////////////////////////////-->

          <script src="<?= base_url('assets/app-assets/vendors/js/core/jquery-3.2.1.min.js') ?>" type="text/javascript"></script>
          <script src="<?= base_url('assets/app-assets/vendors/js/core/bootstrap.min.js') ?>" type="text/javascript"></script>

          <script>
              $(".reveal").on('click', function() {
                  var $pwd = $(".pwd");
                  if ($pwd.attr('type') === 'password') {
                      $pwd.attr('type', 'text');
                  } else {
                      $pwd.attr('type', 'password');
                  }
              });
          </script>


  </body>
</html>