<?php
$page_title = 'Add Product';
require_once('includes/load.php');
$all_categories = find_all('categories');
$all_photo = find_all('media');
?>
<?php
if (isset($_POST['add_product'])) {
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
  #img-preview {
    display: none;
    width: 155px;
    /* border: 2px solid #333; */
    margin-bottom: 20px;
  }

  #img-preview img {
    width: 100%;
    height: auto;
    display: block;
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

  .button{
    text-align: center;
  }
  .input-group{
    display: block;
  }
  .input-group-addon{
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
          <span>Add New Product</span>
        </strong>
      </div>
      <div class="panel-body">
        <div class="col-md-12">
          <form method="post" action="add_product.php" class="clearfix">
            <div class="form-group">
              <p class="topic"><b>Product Name</b></p>
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="glyphicon glyphicon-th-large"></i>
                </span>
                <input type="text" class="form-control" name="product-title" placeholder="Enter Product Name">
              </div>
            </div>
            <div class="form-group">
              <p class="topic"><b>Product Details</b></p>
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="glyphicon glyphicon-th-large"></i>
                </span>
                <input type="text" class="form-control" name="product-title" placeholder="Enter Product Details">
              </div>
            </div>
            <div class="form-group">
              <!-- <div class="row"> -->
              <!-- <div class="col-md-6"> -->
              <p class="topic"><b>Product Category</b></p>
              <select class="form-control" name="product-categorie">
                <option value="">Select Product Category</option>
                <?php foreach ($all_categories as $cat) : ?>
                  <option value="<?php echo (int)$cat['id'] ?>">
                    <?php echo $cat['name'] ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <!-- </div> -->
            <div class="form-group">
              <!-- <div class="col-md-6"> -->
              <p class="topic"><b>Product Photo</b></p>
              <div>
                <div id="img-preview"></div>
                <input type="file" accept="image/*" id="choose-file" name="choose-file" />
                <label for="choose-file">Select Photo</label>
              </div>
              <!-- <select class="form-control" name="product-photo">
                <option value="">Select Product Photo</option>
                <?php foreach ($all_photo as $photo) : ?>
                  <option value="<?php echo (int)$photo['id'] ?>">
                    <?php echo $photo['file_name'] ?></option>
                <?php endforeach; ?>
              </select> -->
              <!-- </div> -->
              <!-- </div> -->
            </div>

            <div class="form-group">
              <!-- <div class="col-md-4"> -->
              <p class="topic"><b>Product Quantity</b></p>
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="glyphicon glyphicon-shopping-cart"></i>
                </span>
                <input type="number" class="form-control" name="product-quantity" placeholder="Product Quantity">
              </div>
              <!-- </div> -->
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-md-6">
                  <p class="topic"><b>Buying Price</b></p>
                  <div class="input-group">
                    <span class="input-group-addon">
                      <i class="glyphicon glyphicon-usd"></i>
                    </span>
                    <input type="number" class="form-control" name="buying-price" placeholder="Buying Price">
                    <!-- <span class="input-group-addon">.00</span> -->
                  </div>
                </div>
                <div class="col-md-6">
                  <p class="topic"><b>Selling Price</b></p>
                  <div class="input-group">
                    <span class="input-group-addon">
                      <i class="glyphicon glyphicon-usd"></i>
                    </span>
                    <input type="number" class="form-control" name="saleing-price" placeholder="Selling Price">
                    <!-- <span class="input-group-addon">.00</span> -->
                  </div>
                </div>
              </div>
            </div>
            <div class="button">
              <button type="submit" name="add_product" class="btn btn-danger">Cancel</button>
              <button type="submit" name="add_product" class="btn btn-success">Add</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  const chooseFile = document.getElementById("choose-file");
  const imgPreview = document.getElementById("img-preview");

  chooseFile.addEventListener("change", function() {
    getImgData();
  });

  function getImgData() {
    const files = chooseFile.files[0];
    if (files) {
      const fileReader = new FileReader();
      fileReader.readAsDataURL(files);
      fileReader.addEventListener("load", function() {
        imgPreview.style.display = "block";
        imgPreview.innerHTML = '<img src="' + this.result + '" />';
      });
    }
  }
</script>

<?php include_once('layouts/footer.php'); ?>