<?php
  $page_title = 'Edit categorie';
  require_once('includes/load.php');
?>
<?php
  $categorie = find_by_id('categories',(int)$_GET['id']);
  if(!$categorie){
    $session->msg("d","Missing categorie id.");
    redirect('categorie.php');
  }
?>

<?php
if(isset($_POST['edit_cat'])){
  $req_field = array('categorie-name');
  validate_fields($req_field);
  $cat_name = remove_junk($db->escape($_POST['categorie-name']));
  if(empty($errors)){
       $sql = "UPDATE categories SET name='{$cat_name}'";
       $sql .= " WHERE id='{$categorie['id']}'";
     $result = $db->query($sql);
     if($result && $db->affected_rows() === 1) {
       $session->msg("s", "Successfully updated Categorie");
       redirect('categorie.php',false);
     } else {
       $session->msg("d", "Sorry! Failed to Update");
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
       <div class="text-center">
         <strong>
           <span style="font-size:22pt;">Editing <?php echo remove_junk(ucfirst($categorie['name']));?></span>
        </strong>
       </div>
       <div class="panel-body">
         <form method="post" action="edit_categorie.php?id=<?php echo (int)$categorie['id'];?>">
           <div class="category-form">
              <input type="text" class="category-input-form" name="categorie-name" value="<?php echo remove_junk(ucfirst($categorie['name']));?>">
           </div>
           <div class="group-btn">
              <button type="submit" name="edit_cat" class="btn btn-success" style="">Update categorie</button>
           </div>
       </form>
       </div>
     </div>





<?php include_once('layouts/footer.php'); ?>
