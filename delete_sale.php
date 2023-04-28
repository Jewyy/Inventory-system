<?php
require_once('includes/load.php');
page_require_level(3);

$sale = find_by_id('sales', (int) $_GET['id']);
$product_name = find_product_name_by_sale_id($sale['id']);

if (!$sale) {
  $session->msg("d", "Missing sale id.");
  redirect('sales.php');
}

// Check if user confirmed the deletion
if (isset($_POST['confirm']) && $_POST['confirm'] == 'yes') {
  $delete_id = delete_by_id('sales', (int)$sale['id']);
  if ($delete_id) {
    $session->msg("s", "Sale " . $sale['name'] . " deleted.");
    redirect('sales.php');
  } else {
    $session->msg("d", "Sale deletion failed.");
    redirect('sales.php');
  }
}
?>


<?php include_once('layouts/header.php'); ?>
<style>
  .lightgray  {
    color: #909090;
  }
</style>
<div class="row">
  <div class="col-md-12">
    <?php echo display_msg($msg); ?>
  </div>
  <div class="col-md-6">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-trash"></span>
          <span class="lightgray">Are you sure you want to delete </span> "<?php echo remove_junk($product_name); ?>" ?
          <!-- <?php foreach ($sale as $sale) : ?>
             
          <?php endforeach; ?> -->
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