<?php $user = current_user(); ?>
<!DOCTYPE html>
  <html lang="en">
    <head>
    <meta charset="UTF-8">
    <title><?php if (!empty($page_title))
           echo remove_junk($page_title);
            elseif(!empty($user))
           echo ucfirst($user['name']);
            else echo "Inventory Management System";?>
    </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />
    <link rel="stylesheet" href="libs/css/main.css" />
  </head>
  <body>
  <?php  if (true): ?>
    <header id="header">
      <div class="logo pull-left"> Inventory System</div>
      <div class="header-content">
      <!-- <div class="header-date pull-left">
        
      </div> -->
     </div>
    </header>
    <div class="sidebar">
      <?php include_once('admin_menu.php');?>
   </div>
<?php endif;?>

<div class="page">
  <div class="container-fluid">
