<?php
$page_title = 'Edit product';
require_once('includes/load.php');
?>
<?php
$product = find_by_id('products', (int)$_GET['id']);
$media_name = find_media_name_by_product_id($product['id']);
$all_categories = find_all('categories');
$all_photo = find_all('media');
if (!$product) {
  $session->msg("d", "Missing product id.");
  redirect('product.php');
}
?>
<?php
if (isset($_POST['product'])) {
  $req_fields = array('product-title', 'product-categorie', 'product-quantity', 'buying-price', 'saleing-price');
  validate_fields($req_fields);

  if (empty($errors)) {
    $p_name  = remove_junk($db->escape($_POST['product-title']));
    $p_cat   = (int)$_POST['product-categorie'];
    $p_qty   = remove_junk($db->escape($_POST['product-quantity']));
    $p_buy   = remove_junk($db->escape($_POST['buying-price']));
    $p_sale  = remove_junk($db->escape($_POST['saleing-price']));
    if (is_null($_POST['product-photo']) || $_POST['product-photo'] === "") {
      $media_id = '0';
    } else {
      $media_id = remove_junk($db->escape($_POST['product-photo']));
    }
    $query   = "UPDATE products SET";
    $query  .= " name ='{$p_name}', quantity ='{$p_qty}',";
    $query  .= " buy_price ='{$p_buy}', sale_price ='{$p_sale}', categorie_id ='{$p_cat}',media_id='{$media_id}'";
    $query  .= " WHERE id ='{$product['id']}'";
    $result = $db->query($query);
    if ($result && $db->affected_rows() === 1) {
      $session->msg('s', "Product updated ");
      redirect('product.php', false);
    } else {
      $session->msg('d', ' Sorry failed to updated!');
      redirect('edit_product.php?id=' . $product['id'], false);
    }
  } else {
    $session->msg("d", $errors);
    redirect('edit_product.php?id=' . $product['id'], false);
  }
}

?>
<?php include_once('layouts/header.php'); ?>

<style>
  .input-group {
    display: block;
  }

  #preview-image {
    max-width: 150px;
    /* height: auto; */
    max-height: 150px;
  }
</style>

<div class="row">
  <div class="col-md-12">
    <?php echo display_msg($msg); ?>
  </div>
</div>
<div class="box-header">
  <div class="headertext">Edit Product</div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="panel">
      <div>
        <form method="post" class="inner-width" action="edit_product.php?id=<?php echo (int)$product['id'] ?>">
          <div class="form-groupInput">
            <label for="product-title">Product Name</label>
            <input type="text" class="form-control" name="product-title" id="product-title" value="<?php echo remove_junk($product['name']); ?>">
          </div>
          <div class="form-groupInput">
            <label for="product-categorie">Product Category</label>
            <select class="form-control" name="product-categorie" id="product-categorie">
              <option value=""> Select a category</option>
              <?php foreach ($all_categories as $cat) : ?>
                <option value="<?php echo (int)$cat['id']; ?>" <?php if ($product['categorie_id'] === $cat['id']) : echo "selected";
                                                                endif; ?>>
                  <?php echo remove_junk($cat['name']); ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-groupInput" style="height: auto; gap: 4px; margin-bottom: 4px;">
            <label for="product-photo">Product Image</label>
            <div class="input-group">
              <img id="preview-image" src="./uploads/products/<?php echo $media_name; ?>" alt="Preview Image">
            </div>
          </div>
          <div class="form-groupInput" style="height: auto; gap: 4px; margin-bottom: 4px;">
            <select class="form-control" name="product-photo" id="product-photo" onchange="handleSelectChange(event)">
              <option value=""> No image</option>
              <?php foreach ($all_photo as $photo) : ?>
                <option value="<?php echo (int)$photo['id']; ?>" <?php if ($product['media_id'] === $photo['id']) : echo "selected";
                                                                  endif; ?>>
                  <?php echo $photo['file_name'] ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-groupInput">
            <label for="product-quantity">Product Quantity</label>
            <input type="number" class="form-control" name="product-quantity" id="product-quantity" value="<?php echo remove_junk($product['quantity']); ?>">
          </div>
          <div class="form-groupInput">
            <div class="row">
              <div class="col-md-6">
                <label for="buying-price">Buying price</label>
                <input type="number" class="form-control" name="buying-price" id="buying-price" value="<?php echo remove_junk($product['buy_price']); ?>">
              </div>
              <div class="col-md-6">
                <label for="saleing-price">Selling price</label>
                <input type="number" class="form-control" name="saleing-price" id="saleing-price" value="<?php echo remove_junk($product['sale_price']); ?>">
              </div>
            </div>
          </div>
          <div class="group-btn" style="padding-top: 16px;">
            <form method="post"> <input type="hidden" name="confirm" value="yes">
              <a href="product.php" class="btn btn-default">Cancel</a>
              <button type="submit" name="product" class="btn btn-primary">Update</button>
            </form>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  function handleSelectChange(event) {
    var selectedOption = event.target.options[event.target.selectedIndex];
    var fileName = selectedOption.text;

    var fileURL = "uploads/products/" + fileName; // modify this to the actual path of your image directory

    // display the selected image in the img element
    document.getElementById('preview-image').src = fileURL;

    // display the selected image in the div element
    document.getElementById('img-preview').style.backgroundImage = 'url(' + fileURL + ')';

    // update the selected option text
    document.getElementById('selected-option').textContent = fileName;
  }
</script>

<?php include_once('layouts/footer.php'); ?>