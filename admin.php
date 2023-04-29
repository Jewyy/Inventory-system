<?php
  $page_title = 'Admin Home Page';
  require_once('includes/load.php');  
  page_require_level(3);
?>
<?php
 $c_categorie     = count_by_id('categories');
 $c_product       = count_by_id('products');
 $c_sale          = count_by_id('sales');
 $c_user          = count_by_id('users');
 $products_sold   = find_higest_saleing_product('10');
 $recent_products = find_recent_product_added('5');
 $recent_sales    = find_recent_sale_added('5')
?>
<?php include_once('layouts/header.php'); ?>

<div class="row">
   <div class="col-md-6">
     <?php echo display_msg($msg); ?>
   </div>
</div>
  <div class="row">
    <div class="panel-heading">
        <strong>
          <span style="font-size:22pt;">All Categories</span>
       </strong>
      </div>
    </div>
	<a href="categorie.php" style="color:black;">
  <div class="panel-header">
 
    <div class="col-md-4">
       <div class="panel panel-box clearfix">
         <div class="panel-icon pull-left bg-red">
          <i class="glyphicon glyphicon-th-large"></i>
        </div>
        <div class="panel-value pull-right">
          <h2 class="margin-top"> <?php  echo $c_categorie['total']; ?> </h2>
          <p class="text-muted">Categories</p>
        </div>
       </div>
    </div>
	</a>
	
	<a href="product.php" style="color:black;">
    <div class="col-md-4">
       <div class="panel panel-box clearfix">
         <div class="panel-icon pull-left bg-blue2">
          <i class="glyphicon glyphicon-shopping-cart"></i>
        </div>
        <div class="panel-value pull-right">
          <h2 class="margin-top"> <?php  echo $c_product['total']; ?> </h2>
          <p class="text-muted">Products</p>
        </div>
       </div>
    </div>
	</a>
	
	<a href="sales.php" style="color:black;">
    <div class="col-md-4">
       <div class="panel panel-box clearfix">
         <div class="panel-icon pull-left bg-green">
          <i class="glyphicon glyphicon-usd"></i>
        </div>
        <div class="panel-value pull-right">
          <h2 class="margin-top"> <?php  echo $c_sale['total']; ?></h2>
          <p class="text-muted">Sales</p>
        </div>
       </div>
    </div>
	</a>
</div>
  
  <div class="row">
   <div class="col-md-4">
     <div class="panel panel-header" style="border-color:#FF7857">
       <div class="panel-heading" style="background-color:#FF7857;">
         <strong>
           <!-- <span class="glyphicon glyphicon-th"></span> -->
           <span style="font-size:20px; color:white">Highest Selling Products</span>
         </strong>
       </div>
       <div class="panel-body">
         <table class="table">
          <thead>
           <tr style="border-bottom:solid;  border-color:#D3D3D3; box-shadow:0px 2px 0px #E6E6E6">
             <th>Title</th>
             <th>Total Sold</th>
             <th>Total Quantity</th>
           <tr>
          </thead>
          <tbody>
            <?php foreach ($products_sold as  $product_sold): ?>
              <tr>
                <td><?php echo remove_junk(first_character($product_sold['name'])); ?></td>
                <td><?php echo (int)$product_sold['totalSold']; ?></td>
                <td><?php echo (int)$product_sold['totalQty']; ?></td>
              </tr>
            <?php endforeach; ?>
          <tbody>
         </table>
       </div>
     </div>
   </div>
   <div class="col-md-4">
      <div class="panel panel-header" style="border-color:#7a83ee">
        <div class="panel-heading" style="background-color:#7a83ee">
          <strong>
            <!-- <span class="glyphicon glyphicon-th"></span> -->
            <span style="font-size:20px; color:white">Latest sales</span>
          </strong>
        </div>
        <div class="panel-body">
          <table class="table">
       <thead>
         <tr style="border-bottom:solid;  border-color:#D3D3D3; box-shadow:0px 3px 0px #E6E6E6">
           <th class="text-center" style="width: 50px;">#</th>
           <th>Product Name</th>
           <th>Date</th>
           <th>Total Sale</th>
         </tr>
       </thead>
       <tbody>
         <?php foreach ($recent_sales as  $recent_sale): ?>
         <tr>
           <td class="text-center"><?php echo count_id();?></td>
           <td>
            <a href="edit_sale.php?id=<?php echo (int)$recent_sale['id']; ?>">
             <?php echo remove_junk(first_character($recent_sale['name'])); ?>
           </a>
           </td>
           <td><?php echo remove_junk(ucfirst($recent_sale['date'])); ?></td>
           <td>$<?php echo remove_junk(first_character($recent_sale['price'])); ?></td>
        </tr>

       <?php endforeach; ?>
       </tbody>
     </table>
    </div>
   </div>
  </div>
  <div class="col-md-4">
    <div class="panel panel-header"  style="border-color:#008060">
      <div class="panel-heading"  style="background-color:#008060">
        <strong>
          <!-- <span class="glyphicon glyphicon-th"></span> -->
          <span style="font-size:20px; color:white">Recently Added Products</span>
        </strong>
      </div>
      <div class="panel-body">
        <!-- <div class="list-group"> -->
          <?php foreach ($recent_products as  $recent_product): ?>
                <a class="list-group-item clearfix" href="edit_product.php?id=<?php echo    (int)$recent_product['id'];?>">
                    <h4 class="list-group-item-heading">
                    <?php if($recent_product['media_id'] === '0'): ?>
                        <img class="img-avatar img-circle" src="uploads/products/no_image.png" alt="">
                      <?php else: ?>
                      <img class="img-avatar img-circle" src="uploads/products/<?php echo $recent_product['image'];?>" alt="" />
                    <?php endif;?>
                    <?php echo remove_junk(first_character($recent_product['name']));?>
                      <span class="label label-warning pull-right">
                    $<?php echo (int)$recent_product['sale_price']; ?>
                      </span>
                    </h4>
                    <span class="list-group-item-text pull-right">
                    <?php echo remove_junk(first_character($recent_product['categorie'])); ?>
                  </span>
              </a>
          <?php endforeach; ?>
        <!-- </div> -->
      </div>
    </div>
  </div>
 </div>
  <div class="row">

  </div>



<?php include_once('layouts/footer.php'); ?>
