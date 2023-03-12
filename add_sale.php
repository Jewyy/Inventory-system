<?php
$page_title = 'Add Sale';
require_once('includes/load.php');

if(isset($_POST['add_sale'])){
  $req_fields = array('product_id','quantity','total','date');
  validate_fields($req_fields);

  if(empty($errors)){
    $product_id = (int)$db->escape($_POST['product_id']);
    $quantity = (int)$db->escape($_POST['quantity']);
    $total = $db->escape($_POST['total']);
    $date = date("Y-m-d", strtotime($_POST['date']));

    $sql  = "INSERT INTO sales (product_id, qty, price, date)";
    $sql .= " VALUES ('{$product_id}', '{$quantity}', '{$total}', '{$date}')";

    $result = $db->query($sql);
    if($result && $db->affected_rows() === 1){
      update_product_qty($quantity, $product_id);
      $session->msg('s',"Sale added.");
      redirect('sales.php', false);
    } else {
      $session->msg('d',' Sorry failed to add sale!');
      redirect('add_sale.php', false);
    }
  } else {
    $session->msg("d", $errors);
    redirect('add_sale.php',false);
  }
}

?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-6">
    <?php echo display_msg($msg); ?>
  </div>
</div>
<div class="box-header">
        <div class="headertext">Add Sales</div>
    </div>
<div class="row">
  <div class="col-md-12">
    <div class="panel">
      <!-- <div class="panel-heading clearfix"style="background-color: green;">
      
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>Add Sale</span>
       </strong>
       <div class="pull-right">
         <a href="sales.php" class="btn btn-primary">Show all sales</a>
       </div>
      </div> -->
      <div>
        <form method="post" action="add_sale.php" class="inner-width">
          <div class="form-groupInput">
            <label for="product_id">Product:</label>
            <select class="form-control" id="product_id" name="product_id">
              <?php
                $products = find_all('products');
                foreach($products as $product):
              ?>
              <option value="<?php echo (int)$product['id'] ?>">
                <?php echo $product['name'] ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-groupInput">
            <label for="quantity">Quantity:</label>
            <input type="text" class="form-control" id="quantity" name="quantity">
          </div>
          <div class="form-groupInput">
            <label for="total">Total:</label>
            <input type="text" class="form-control" id="total" name="total">
          </div>
          <div class="form-groupInput">
            <label for="date">Date:</label>
            <input type="date" class="form-control datepicker" id="date" name="date" data-date-format="">
          </div>
          
          <div class="group-btn" style="padding-top: 16px;">
            <form method="post"> <input type="hidden" name="confirm" value="yes">
                <a href="sales.php" class="btn btn-default">Cancel</a>
                <button type="submit" name="add_sale" class="btn btn-primary">Add Sale</button>
            </form>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php include_once('layouts/footer.php'); ?>
