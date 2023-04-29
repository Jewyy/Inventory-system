<?php
$page_title = 'Add Product';
require_once('includes/load.php');
page_require_level(3);
$all_categories = find_all('categories');
$all_photo = find_all('media');
?>
<?php
if (isset($_POST['add_product'])) {
  $photo = new Media();
  $photo->upload($_FILES['file_upload']);
  if ($photo->process_media()) {
    $session->msg('s', 'photo has been uploaded.');
  } else {
    $session->msg('d', join($photo->errors));
  }
  $req_fields = array('product-title', 'product-categorie', 'product-quantity', 'buying-price', 'saleing-price');
  validate_fields($req_fields);
  if (empty($errors)) {
    $p_name  = remove_junk($db->escape($_POST['product-title']));
    $p_cat   = remove_junk($db->escape($_POST['product-categorie']));
    $p_qty   = remove_junk($db->escape($_POST['product-quantity']));
    $p_buy   = remove_junk($db->escape($_POST['buying-price']));
    $p_sale  = remove_junk($db->escape($_POST['saleing-price']));
    if (is_null($_POST['product-photo']) || $_POST['product-photo'] === "") {
      $media_id = '0';
    } else {
      $media_id = remove_junk($db->escape($_POST['product-photo']));
    }
    $date    = make_date();
    $query  = "INSERT INTO products (";
    $query .= " name,quantity,buy_price,sale_price,categorie_id,media_id,date";
    $query .= ") VALUES (";
    $query .= " '{$p_name}', '{$p_qty}', '{$p_buy}', '{$p_sale}', '{$p_cat}', '{$media_id}', '{$date}'";
    $query .= ")";
    $query .= " ON DUPLICATE KEY UPDATE name='{$p_name}'";
    if ($db->query($query)) {
      $session->msg('s', "Product added ");
      redirect('product.php', false);
    } else {
      $session->msg('d', ' Sorry failed to added!');
      redirect('product.php', false);
    }
  } else {
    $session->msg("d", $errors);
    redirect('add_product.php', false);
  }
}

?>
<?php include_once('layouts/header.php'); ?>

<style>
  /* #img-preview {
    display: none;
    width: 155px;
    margin-bottom: 20px;
  }

  #img-preview img {
    width: 10%;
    height: auto;
    display: block;
  } */

  #preview-image {
    max-width: 150px;
    /* height: auto; */
    max-height: 150px;
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

</style>

<div class="row">
  <div class="col-md-12">
    <?php echo display_msg($msg); ?>
  </div>
</div>
<div class="box-header">
  <div class="headertext">Add Product</div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="panel">
      <div>
        <form method="post" action="add_product.php" class="inner-width" enctype="multipart/form-data">
          <div class="form-groupInput">
            <label for="product-title">Product Name</label>
            <input type="text" class="form-control" name="product-title" id="product-title" placeholder="Enter Product Name">
          </div>
          <div class="form-groupInput">
            <label for="product-categorie">Product Category</label>
            <select class="form-control" name="product-categorie" id="product-categorie">
              <option value="">Select Product Category</option>
              <?php foreach ($all_categories as $cat) : ?>
                <option value="<?php echo (int)$cat['id'] ?>">
                  <?php echo $cat['name'] ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-groupInput" style="height: auto; gap: 4px; margin-bottom: 4px;">
            <label for="product-photo">Product Image</label>
            <div class="input-group">
              <img id="preview-image" src="" alt="Preview Image">
            </div>
          </div>
          <div class="form-groupInput" style="height: auto; gap: 4px; margin-bottom: 4px;">
            <select class="form-control" name="product-photo" id="product-photo" onchange="handleSelectChange(event)">
              <option value="">Select Product Photo</option>
              <?php foreach ($all_photo as $photo) : ?>
                <option value="<?php echo (int)$photo['id'] ?>">
                  <?php echo $photo['file_name'] ?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="form-groupInput">
            <label for="product-quantity">Product Quantity</label>
            <input type="number" class="form-control" name="product-quantity" id="product-quantity" placeholder="Product Quantity">
          </div>
          <div class="form-groupInput">
            <div class="row">
              <div class="col-md-6">
                <label for="buying-price">Buying Price</label>
                <input type="number" class="form-control" name="buying-price" id="buying-price" placeholder="Buying Price">
              </div>
              <div class="col-md-6">
                <label for="saleing-price">Selling Price</label>
                <input type="number" class="form-control" name="saleing-price" id="saleing-price" placeholder="Selling Price">
              </div>
            </div>
          </div>
          <div class="group-btn" style="padding-top: 16px;">
            <form method="post"> <input type="hidden" name="confirm" value="yes">
              <a href="product.php" class="btn btn-default">Cancel</a>
              <button type="submit" name="add_product" class="btn btn-primary">Add Product</button>
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