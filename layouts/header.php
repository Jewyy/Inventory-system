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
  <body>
  <?php  if ($session->isUserLoggedIn(true)): ?>
    <header id="header">
      <div class="logo pull-left"> 
      <img src="asset/logo.svg" alt="logo-image" style="padding-left:22px;">
      </div>
      <div class="header-content">

      <div class="pull-right clearfix">
        <ul class="info-menu list-inline list-unstyled">
          <li class="profile">
            <a href="#" data-toggle="dropdown" class="toggle" aria-expanded="false">
              <span>testname</span>
              <img src="uploads/users/no_image.png" alt="user-image" class="img-circle img-inline">
              <!-- <span><i class="caret"></i></span> -->
            </a>
            <ul class="dropdown-menu">
             <li class="last">
                 <a href="logout.php">
                     <i class="glyphicon glyphicon-off"></i>
                     Logout
                 </a>
             </li>
           </ul>
          </li>
        </ul>
      </div>
     </div>
    </header>
    <div class="sidebar">
      <?php include_once('admin_menu.php');?>
   </div>
<?php endif;?>

<div class="page">
  <div class="container-fluid">
