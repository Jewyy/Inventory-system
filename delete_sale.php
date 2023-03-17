<?php
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  // page_require_level(3);
?>
<?php
  $d_sale = find_by_id('sales',(int)$_GET['id']);
  if(!$d_sale){
    $session->msg("d","Missing sale id.");
    redirect('sales.php');
  }

  // Check if user confirmed the deletion
  if(isset($_POST['confirm']) && $_POST['confirm'] == 'yes') {
    $delete_id = delete_by_id('sales',(int)$d_sale['id']);
    if($delete_id){
      $session->msg("s","sale deleted.");
      redirect('sales.php');
  } else {
      $session->msg("d","sale deletion failed.");
      redirect('sales.php');
  }
  }
?>
<?php
  // $delete_id = delete_by_id('sales',(int)$d_sale['id']);
  // if($delete_id){
  //     $session->msg("s","sale deleted.");
  //     redirect('sales.php');
  // } else {
  //     $session->msg("d","sale deletion failed.");
  //     redirect('sales.php');
  // }
?>


<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-12">
    <?php echo display_msg($msg); ?>
  </div>
  <div class="col-md-6">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-trash"></span>
          <span>Are you sure you want to delete <?php echo remove_junk(ucfirst($sale['name'])); ?>?</span>
        </strong>
      </div>
      <div class="panel-body">
        <form method="post">
          <div class="form-group">
            <input type="hidden" name="confirm" value="yes">
            <button type="submit" class="btn btn-danger">Yes</button>
            <a href="sales.php" class="btn btn-default">No</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php include_once('layouts/footer.php'); ?>