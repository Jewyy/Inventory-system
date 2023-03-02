<?php
  $page_title = 'All Product';
  require_once('includes/load.php');
  $products = join_product_table();
?>
<?php include_once('layouts/header.php'); ?>
  <div class="row">
     <div class="col-md-12">
       <?php echo display_msg($msg); ?>
     </div>
     <header id="header">
      <div class="logo pull-left"> Inventory System</div>
      <div class="header-content">
      <div class="header-date pull-left">
        <h1>Welcome Inventory System</h1>
      </div>
     </div>
    </header>
    <div class="sidebar">
      <?php include_once('menu.php');?>
   </div>
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
         <div class="pull-right">
           <a href="add_product.php" class="btn btn-primary">Add New</a>
         </div>
        </div>
        <div class="panel-body">
          <table class=product-table">
            <thead>
              <tr style="height:60px; border-bottom:solid;  border-color:#D3D3D3; ">
                <th class="product-tab" style="width: 50px;">No.</th>
                <th class="product-tab" style="width: 50px;"> Photo</th>
                <th class="product-tab" style="width: 50px;" > Product Name </th>
                <th class="product-tab" style="width: 10%;"> Categories </th>
                <th class="product-tab product-tab" style="width: 10%;"> In-stock </th>
                <th class="product-tab" style="width: 10%;"> Buying Price </th>
                <th class="product-tab" style="width: 10%;"> Selling Price </th>
                <th class="product-tab" style="width: 10%;"> Product Add </th>
                <th class="product-tab" style="width: 15%;"> Action </th>
                
              </tr>
            </thead>
            <tbody>
              <?php foreach ($products as $product):?>
              <tr class="product-row-style">
                <td><?php echo count_id();?></td>
                <td>
                  <?php if($product['media_id'] === '0'): ?>
                    <img class="img-avatar img-circle" src="uploads/products/no_image.png" alt="">
                  <?php else: ?>
                  <img class="img-avatar img-circle" src="uploads/products/<?php echo $product['image']; ?>" alt="">
                <?php endif; ?>
                </td>
                <td> <?php echo remove_junk($product['name']); ?></td>
                <td> <?php echo remove_junk($product['categorie']); ?></td>
                <td> <?php echo remove_junk($product['quantity']); ?></td>
                <td> <?php echo remove_junk($product['buy_price']); ?></td>
                <td> <?php echo remove_junk($product['sale_price']); ?></td>
                <td> <?php echo read_date($product['date']); ?></td>
                <td>
                  <div class="btn-group">
                    <a href="edit_product.php?id=<?php echo (int)$product['id'];?>" class="btn btn-info btn-xs"  title="Edit" data-toggle="tooltip">
                      <span class="glyphicon glyphicon-edit"></span>
                    </a>
                    <a href="delete_product.php?id=<?php echo (int)$product['id'];?>" class="btn btn-danger btn-xs"  title="Delete" data-toggle="tooltip">
                      <span class="glyphicon glyphicon-trash"></span>
                    </a>
                  </div>
                </td>
              </tr>
             <?php endforeach; ?>
            </tbody>
          </tabel>
        </div>
      </div>
    </div>
  </div>
  <?php include_once('layouts/footer.php'); ?>
