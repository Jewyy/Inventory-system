<?php
  ob_start();
  require_once('includes/load.php');
  if($session->isUserLoggedIn(true)) { redirect('admin.php', false);}
?>
<?php include_once('layouts/header.php'); ?>
<div class="login-page" style="background-color: black; color: white;">
    <div class="text-center">
      <img src="asset/logo.svg" alt="logo-image" style="width: 200px; margin-top: 15px; color: black;">
      <h3 style="margin: 10px;">Login Panel</h3>
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
            <button type="submit" class="btn btn-primary">Login</button>
        </div>
    </form>
</div>
<?php include_once('layouts/footer.php'); ?>
