<?php
$page_title = 'All Image';
require_once('includes/load.php');
page_require_level(3);
?>
<?php $media_files = find_all('media'); ?>
<?php
if (isset($_POST['submit'])) {
  $photo = new Media();
  $photo->upload($_FILES['file_upload']);
  if ($photo->process_media()) {
    $session->msg('s', 'photo has been uploaded.');
    redirect('media.php');
  } else {
    $session->msg('d', join($photo->errors));
    redirect('media.php');
  }
}

?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-4">
    <?php echo display_msg($msg); ?>
  </div>

  <div class="col-md-12">
      <div class="col-md-4">
      <div class="headertext">Media</div>
        <form class="form-inline" style="width: 200px;" action="media.php" method="POST" enctype="multipart/form-data">
          <div class="wrapper">
            <div class="preview-box">
              <div class="img-preview" id="preview"></div>
              <div class="text">Please choose image, <br />to see a preview</div>
            </div>
          </div>
          <div style="flex-direction: row; display: flex; padding-left: 15px;">
            <label for="file_upload" class="btn btn-default">
              Choose a file
              <input type="file" name="file_upload" id="file_upload" multiple="multiple" style="display: none;">
            </label>
            <div style="padding-left: 40px;">
              <button type="submit" name="submit" class="btn btn-default" style="width: 80px;">Upload</button>
            </div>
          </div>
        </form>
      </div>
      <div class="col-md-7">
        <div>
          <table class="profuct-table" style="width:auto">
            <thead>
              <tr style="height:60px; text-align: center; border-bottom:solid;  border-color:#D3D3D3; box-shadow:0px 3px 0px #E6E6E6">
                <th class="product-tab" style="width: 10%; text-align: center;">No.</th>
                <th class="product-tab" style="width: 30%; text-align: center;">Photo</th>
                <th class="product-tab" style="width: 35%; text-align: center;">Photo Name</th>
                <th class="product-tab" style="width: 20%; text-align: center;">Photo Type</th>
                <th class="product-tab" style="width: 25%; text-align: center;">Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($media_files as $media_file) : ?>
                <tr class="list-inline">
                  <td class="text-center"><?php echo count_id(); ?></td>
                  <td class="text-center">
                    <img src="uploads/products/<?php echo $media_file['file_name']; ?>" class="img-thumbnail" />
                  </td>
                  <td class="text-center">
                    <?php echo $media_file['file_name']; ?>
                  </td>
                  <td class="text-center">
                    <?php echo $media_file['file_type']; ?>
                  </td>
                  <td class="text-center">
                    <a href="delete_media.php?id=<?php echo (int) $media_file['id']; ?>" class="btn btn-danger btn-xs" title="Edit">
                      <span class="glyphicon glyphicon-trash"></span>
                    </a>
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
<script>
  function imagePreview(fileInput) {
    if (fileInput.files && fileInput.files[0]) {
      var fileReader = new FileReader();
      fileReader.onload = function(event) {
        $('#preview').html('<img src="' + event.target.result + '" width="200" height="100"/>');
      };
      fileReader.readAsDataURL(fileInput.files[0]);
    }
  }

  $("#file_upload").change(function() {
    imagePreview(this);
  });
</script>
<style>
  .wrapper {
    height: 170px;
    width: 300px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-direction: row;
  }

  .wrapper .preview-box {
    position: relative;
    width: 100%;
    height: 150px;
    display: flex;
    text-align: center;
    align-items: center;
    justify-content: center;
    border-radius: 5px;
    border: 2px dashed #c2cdda;
  }

  .preview-box .img-preview {
    height: 100%;
    width: 100%;
    position: absolute;
  }

  .preview-box .img-preview img {
    height: 100%;
    width: 100%;
    border-radius: 5px;
  }

  .wrapper .preview-box .img-icon {
    font-size: 100px;
    background: linear-gradient(-135deg, #c850c0, #4158d0);
    background-clip: text;
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
  }

  .wrapper .preview-box .text {
    font-size: 18px;
    font-weight: 500;
    color: #5B5B7B;
  }

  .wrapper .input-data {
    height: 130px;
    width: 100%;
    ;
    display: flex;
    align-items: center;
    justify-content: space-evenly;
    flex-direction: column;
  }

  .wrapper .input-data #field {
    width: 100%;
    height: 50px;
    outline: none;
    font-size: 17px;
    padding: 0 15px;
    user-select: auto;
    border-radius: 5px;
    border: 2px solid lightgrey;
    transition: all 0.3s ease;
  }
</style>