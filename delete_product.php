<?php
require_once 'includes/load.php';
$page_title = 'Delete Product';
page_require_level(3);

$products = join_product_table();
$product = find_by_id('products', (int) $_GET['id']);
if (!$product) {
    $session->msg('d', 'Missing Product id.');
    redirect('product.php');
    
}

// Check if user confirmed the deletion
if (isset($_POST['confirm']) && $_POST['confirm'] == 'yes') {
    $delete_id = delete_by_id('products', (int) $product['id']);
    if ($delete_id) {
        $session->msg('s', 'Product deleted.');
        redirect('product.php');
    } else {
        $session->msg('d', 'Product deletion failed.');
        redirect('product.php');
    }
}
?>
<?php include_once 'layouts/header.php'; ?>
<div class="content">
    <div class="box-header">
        <div class="headertext">Delete product</div>
    </div>
    <div class="max-width">
    <!-- <tbody>
          <?php foreach ($products as $product) : ?>
            <tr class="product-row-style">
              <td><?php echo count_id(); ?></td>
              <td>
                <?php if ($product["media_id"] === "0") : ?>
                  <img class="img-avatar img-circle" src="uploads/products/no_image.png" alt="">
                <?php else : ?>
                  <img class="img-avatar img-circle" src="uploads/products/<?php echo $product["image"]; ?>" alt="">
                <?php endif; ?>
              </td>
          <?php endforeach; ?>
        </tbody> -->
        <!-- <img style="width: 200px; height: 200px;  display: flex; align-items: center; background-color :aliceblue;"src="libs/images/food.png"
            alt=""> -->
            
        <img src="uploads/products/<?php echo $product['image']; ?>" style ="width:200px; height:200px;"alt="">
        <!-- <img class="img-avatar img-circle" src="uploads/products/<?php echo $product["image"]; ?>" alt=""> -->
        <div class="content-text">Are you sure you want to delete “<?php echo remove_junk(ucfirst($product['name'])); ?>?”</div>
        <div>
            <td class="text-center"> In-stock:<?php echo remove_junk($product['quantity']); ?></td>
            <td class="text-center">| Buying price:<?php echo remove_junk($product['buy_price']); ?></td>
            <td class="text-center">| Selling price:<?php echo remove_junk($product['sale_price']); ?></td>
        </div>
        <div class="group-btn">
            <form method="post"> <input type="hidden" name="confirm" value="yes">
                <a href="product.php" class="btn btn-default">Cancel</a>
                <button type="submit" class="btn btn-danger">Delete product</button>
            </form>
        </div>
        <!-- <div class="panel-body">
            <form method="post">
                <div class="form-group">
                    <input type="hidden" name="confirm" value="yes">
                    <a href="product.php" class="btn btn-default">Cancel</a>
                    <button type="submit" class="btn btn-danger">Delete product</button>
                </div>
            </form>
        </div> -->
    </div>
</div>
<!-- <div class="row">
  <div class="col-md-12">
    <?php echo display_msg($msg); ?>
  </div>
  <div class="col-md-6">
  <div class="headertext">Delete product</div>
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-trash"></span>
          <span class="text-content">Are you sure you wajhfnt to delete “<?php echo remove_junk(ucfirst($product['name'])); ?>?”</span>
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
</div> -->
<?php include_once 'layouts/footer.php'; ?>