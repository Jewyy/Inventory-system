<?php
  require_once('includes/load.php');
  $categorie = find_by_id('categories',(int)$_GET['id']);
  if(!$categorie){
    $session->msg("d","Missing Categorie id.");
    redirect('categorie.php');
  }
  if (isset($_POST['confirm']) && $_POST['confirm'] == 'yes') {
    $delete_id = delete_by_id('categories',(int)$categorie['id']);
    if($delete_id){
        $session->msg("s","Categorie deleted.");
        redirect('categorie.php');
    } else {
        $session->msg("d","Categorie deletion failed.");
        redirect('categorie.php');
    }
  }
?>
<?php include_once 'layouts/header.php'; ?>
<div class="content">
  <div class="box-header">
    <strong>
      <div class="panel-heading" style="font-size:22pt;">Delete category</div>
    </strong>
</div>
    <div class="max-width">
      <div class="content-text">Are you sure you want to delete “<?php echo remove_junk(ucfirst($categorie['name'])); ?>?”</div>
      <div class="group-btn">
        <form method="post"> <input type="hidden" name="confirm" value="yes">
          <a href="categorie.php" class="btn btn-default">Cancel</a>
          <button type="submit" class="btn btn-danger">Delete product</button>
        </form>
      </div>
    </div>
</div>
<?php include_once 'layouts/footer.php'; ?>
