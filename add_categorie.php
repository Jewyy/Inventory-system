<?php
  $page_title = 'Add categorie';
  require_once('includes/load.php');
  page_require_level(3);
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
   <div class="col-md-12">
     <?php echo display_msg($msg); ?>
   </div>
     <div class="panel">
       <div class="panel-heading">
        <strong>
            <span style="font-size:22pt;">Add New Category</span>
        </strong>
       </div>
       <div class="panel-body" >
       <form method="post" action="categorie.php">
        <div class="row" style="align-items:center;">
            <div class="form-group" style="width:100%;">
                <div class="category-form">
                    <input type="text" class="form-control" name="categorie-name" placeholder="Category Name">
                </div>
            </div>
            <div class="group-btn">
                <a href="categorie.php" class="btn btn-default btn-danger">Cancel</a>
                <button type="submit" name="add_cat" class="btn btn-success"><img src="./asset/plus.svg"> Add Category</button>
            </div>
        </div>
       </form>
       </div>
     </div>

<?php include_once('layouts/footer.php'); ?>
