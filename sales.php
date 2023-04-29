<?php
  $page_title = 'All sale';
  require_once('includes/load.php');
  page_require_level(3);
?>
<?php
$sales = find_all_sale();
?>
<?php include_once('layouts/header.php'); ?>

<style>
  .sales-tab {
    color: #8594A6;
    font-style: SemiBold;
  }

  .sales-table {
    border: none;
    padding-bottom: 50px;
    padding-top: 100px;
    padding-left: 200px;
  }

  .sales-row-style {
    font-style: Label Regular;
    height: 100px;
  }

  .display-font-table {
    color: #434486;
    font-weight: bold;
  }
</style>

<div class="row">
  <div class="col-md-12">
    <?php echo display_msg($msg); ?>
  </div>
  <div class="clearfix">
    <div class="pull-left">
      <div class="headertext">
        Manage Sales
      </div>
    </div>
    <div class="pull-right">
      <a href="add_sale.php" class="btn btn-success"> <img src="./asset/plus.svg">Add Sales</a>
    </div>
  </div>
  <input style="width:100%; height:30px; margin-top: 25px; margin-bottom: 25px;" type="text" id="search" placeholder="Search...">
  <div class="col-md-12">
    <div style="background-color: white;">
      <table class="sales-table">
        <thead>
          <tr style="height:60px; border-bottom:solid;  border-color:#D3D3D3; box-shadow:0px 3px 0px #E6E6E6">
            <th class="sales-tab" style="width: 20px;">No.</th>
            <th class="sales-tab" style="width: 25px;"> Product name </th>
            <th class="sales-tab" style="width: 5%;"> Quantity</th>
            <th class="sales-tab" style="width: 5%;"> Date </th>
            <th class="sales-tab" style="width: 5%;"> Actions </th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($sales as $sale) : ?>
            <tr class="sales-row-style">
              <td><?php echo count_id(); ?></td>
              <td><?php echo remove_junk($sale['name']); ?></td>
              <td class="display-font-table"><?php echo (int)$sale['qty']; ?></td>
              <td style="font-weight:bold;"><?php echo $sale['date']; ?></td>
              <td>
                <div class="btn-group" style="padding-left: 15px;">
                  <a href="edit_sale.php?id=<?php echo (int)$sale['id']; ?>" class="btn btn-light" title="Edit" data-toggle="tooltip">
                    <img src="./asset/edit.svg">
                  </a>
                  <a href="delete_sale.php?id=<?php echo (int)$sale['id']; ?>" class="btn btn-light" title="Delete" data-toggle="tooltip">
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
<?php include_once('layouts/footer.php'); ?>
<script>
  $(document).ready(function() {
    $("#search").on("keyup", function() {
      var value = $(this).val().toLowerCase();
      $("tbody tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });
  });
</script>