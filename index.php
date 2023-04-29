<?php
  ob_start();
  require_once('includes/load.php');
  if($session->isUserLoggedIn(true)) { redirect('admin.php', false);}
?>

<?php $user = current_user(); ?>
<!DOCTYPE html>
<html lang="en">
  
<head>
    <meta charset="UTF-8">
    <title><?php if (!empty($page_title)) {
        echo remove_junk($page_title);
    } elseif (!empty($user)) {
        echo ucfirst($user['name']);
    } else {
        echo 'Inventory Management System';
    } ?>
    </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" />
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />
    <link rel="stylesheet" href="libs/css/main.css" />
  </head>
  <style>
    body{
      height: 100vh;
      margin: 0 auto;
      display: flex;
      background
    }
    .login-page{
      margin: auto;
      border-radius: 8px;
    }
    .btn-primary{
      /* background-color: #7A83EE */
    }

  </style>
  <body>
<div class="login-page" style="background-color: black; color: white;">
    <div class="text-center">
      <h3 style="font-weight:300; font-size: 16px; margin: 20px 0px 10px 0px;">Welcome To</h3>
      <img src="asset/logo.svg" alt="logo-image" style="width: 200px; margin-top: 15px; color: black;">
     </div>
     <?php echo display_msg($msg); ?>
      <form method="post" action="auth.php" class="clearfix">
        <div class="form-group">
              <label for="username" class="control-label">Username</label>
              <input type="name" class="form-control" name="username" placeholder="Username">
        </div>
        <div class="form-group">
            <label for="Password" class="control-label">Password</label>
            <input type="password" name= "password" class="form-control" placeholder="Password">
        </div>
        <div class="form-group">
            <button type="submit" style="width: 100%; margin: 12px 0px;" class="btn btn-primary">Login</button>
        </div>
    </form>
</div>
<?php include_once('layouts/footer.php'); ?>
