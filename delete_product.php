<?php
  require_once('includes/load.php');
  $product = find_by_id('products',(int)$_GET['id']);
  if(!$product){
    $session->msg("d","Missing Product id.");
    redirect('product.php');
  }
  
  // Check if user confirmed the deletion
  if(isset($_POST['confirm']) && $_POST['confirm'] == 'yes') {
    $delete_id = delete_by_id('products',(int)$product['id']);
    if($delete_id){
      $session->msg("s","Product deleted.");
      redirect('product.php');
    } else {
      $session->msg("d","Product deletion failed.");
      redirect('product.php');
    }
  }
?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-12">
    <?php echo display_msg($msg); ?>
  </div>
  <div class="col-md-6">
  <div class="headertext">Delete product</div>
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-trash"></span>
          <span>Are you sure you want to delete <?php echo remove_junk(ucfirst($product['name'])); ?>?</span>
        </strong>
      </div>
      <div class="panel-body">
        <form method="post">
          <div class="form-group">
            <input type="hidden" name="confirm" value="yes">
            <a href="product.php" class="btn btn-default">Cancel</a>
            <button type="submit" class="btn btn-danger">Delete product</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php include_once('layouts/footer.php'); ?>