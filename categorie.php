<?php
  $page_title = 'All categories';
  require_once('includes/load.php');
  $all_categories = find_all('categories')
?>
<?php
 if(isset($_POST['add_cat'])){
   $req_field = array('categorie-name');
   validate_fields($req_field);
   $cat_name = remove_junk($db->escape($_POST['categorie-name']));
   if(empty($errors)){
      $sql  = "INSERT INTO categories (name)";
      $sql .= " VALUES ('{$cat_name}')";
      if($db->query($sql)){
        $session->msg("s", "Successfully Added New Category");
        redirect('categorie.php',false);
      } else {
        $session->msg("d", "Sorry Failed to insert.");
        redirect('categorie.php',false);
      }
   } else {
     $session->msg("d", $errors);
     redirect('categorie.php',false);
   }
 }
?>
<?php include_once('layouts/header.php'); ?>

  <div class="row">
     <div class="col-md-12">
       <?php echo display_msg($msg); ?>
     </div>
  </div>
   <div class="row">
    <div class="col-md-5">
      <div class="panel-header">
        <div class="panel-heading">
          <strong>
            <span style="font-size:22pt;">Add New Category</span>
         </strong>
        </div>
        <div class="panel-body" style="padding-top:22px">
          <form method="post" action="categorie.php">
            <div class="form-group" style="width:100%;">
                <input type="text" class="form-control" name="categorie-name" placeholder="Category Name">
            </div>
            <button type="submit" name="add_cat" class="btn btn-success"><img src="./asset/plus.svg">Add Category</button>
        </form>
        </div>
      </div>
    </div>
    <div class="col-md-7">
    <div class="panel-header">
      <div class="panel-heading">
        <strong>
          <span style="font-size:22pt;">All Categories</span>
       </strong>
      </div>
        <div class="panel-body">
          <table class="table">
            <thead>
                <tr style="border-bottom:solid;  border-color:#D3D3D3; box-shadow:0px 3px 0px #E6E6E6">
                    <th class="product-tab text-center" style="width: 100px;">No.</th>
                    <th class="product-tab">Categories</th>
                    <th class="product-tab text-center" style="width: 120px;">Actions</th>
                </tr>
            </thead>
            <tbody>
              <?php foreach ($all_categories as $cat):?>
                <tr>
                    <td class="text-center"><?php echo count_id();?></td>
                    <td><?php echo remove_junk(ucfirst($cat['name'])); ?></td>
                    <td class="text-center">
                      <div class="btn-group">
                        <a href="edit_categorie.php?id=<?php echo (int)$cat['id'];?>" class="btn btn-light" title="Edit" data-toggle="tooltip">
                          <img src="./asset/edit.svg">
                        </a>
                        <a href="delete_categorie.php?id=<?php echo (int)$cat['id'];?>" class="btn btn-light" title="Delete" data-toggle="tooltip">
                          <img src="./asset/trash.svg">
                        </a>
                      </div>
                    </td>

                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
       </div>
    </div>
    </div>
   </div>
  </div>
  <?php include_once('layouts/footer.php'); ?>
