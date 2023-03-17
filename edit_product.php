<?php
$page_title = 'Edit product';
require_once('includes/load.php');
?>
<?php
$product = find_by_id('products', (int)$_GET['id']);
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
  #img-preview {
    display: none;
    width: 155px;
    /* border: 2px solid #333; */
    margin-bottom: 20px;
  }

  #img-preview img {
    width: 10%;
    height: auto;
    display: block;
  }

  #preview-image {
    max-width: 200px;
    /* height: auto; */
    max-height: 200px;
  }

  [type="file"] {
    height: 0;
    width: 0;
    overflow: hidden;
  }

  [type="file"]+label {
    font-family: sans-serif;
    padding: 10px 30px;
    /* border: 2px solid #f44336; */
    border-radius: 3px;
    border: 1px solid #8594A6;
    background-color: #fff;
    color: #8594A6;
    cursor: pointer;
    transition: all 0.2s;
  }

  [type="file"]+label:hover {
    background-color: #dbdbdb;
    color: #8594A6;
  }

  .button {
    text-align: center;
  }

  .input-group {
    display: block;
  }

  .input-group-addon {
    display: none;
  }
</style>


<div class="row">
  <div class="col-md-12">
    <?php echo display_msg($msg); ?>
  </div>
</div>
<div class="row">
  <div class="col-md-8">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>Edit Product</span>
        </strong>
      </div>
      <div class="panel-body">
        <div class="col-md-12">
          <form method="post" action="edit_product.php?id=<?php echo (int)$product['id'] ?>">
            <div class="form-group">
              <p class="topic"><b>Product Name</b></p>
              <input type="text" class="form-control" name="product-title" value="<?php echo remove_junk($product['name']); ?>">
            </div>
            <div class="form-group">
              <p class="topic"><b>Product Category</b></p>
              <select class="form-control" name="product-categorie">
                <option value=""> Select a categorie</option>
                <?php foreach ($all_categories as $cat) : ?>
                  <option value="<?php echo (int)$cat['id']; ?>" <?php if ($product['categorie_id'] === $cat['id']) : echo "selected";
                                                                  endif; ?>>
                    <?php echo remove_junk($cat['name']); ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="form-group">
              <p class="topic"><b>Product Image</b></p>
              <div class="input-group">
                <img id="preview-image" src="" alt="Preview Image">
              </div>
            </div>
            <div>
              <select class="form-control" name="product-photo" onchange="handleSelectChange(event)">
                <option value="">Select Product Photo</option>
                <?php foreach ($all_photo as $photo) : ?>
                  <option value="<?php echo (int)$photo['id'] ?>">
                    <?php echo $photo['file_name'] ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="form-group">
              <label for="qty">Product Quantity</label>
              <input type="number" class="form-control" name="product-quantity" value="<?php echo remove_junk($product['quantity']); ?>">
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-md-6">
                  <label for="qty">Buying price</label>
                  <input type="number" class="form-control" name="buying-price" value="<?php echo remove_junk($product['buy_price']); ?>">
                </div>
                <div class="col-md-6">
                  <label for="qty">Selling price</label>
                  <input type="number" class="form-control" name="saleing-price" value="<?php echo remove_junk($product['sale_price']); ?>">
                </div>
              </div>
            </div>
            <div class="button">
              <a href="product.php" class="btn btn-default btn-danger">Cancel</a>
              <button type="submit" name="product" class="btn btn-success">Update</button>
            </div>
          </form>
        </div>
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