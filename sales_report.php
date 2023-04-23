<?php
  $page_title = 'Sale Report';
  require_once('includes/load.php');
  include_once('layouts/header.php'); 

?>
<script>
  $(document).ready(function() {
    // Prevent form submission
    $('#sales-report-form').on('submit', function(event) {
      event.preventDefault();

      // Get form data
      var formData = $(this).serialize();

      // Send AJAX request to sales_report_process.php
      $.ajax({
        url: 'sale_report_process.php',
        type: 'post',
        data: formData,
        success: function(response) {
          // Display response or perform other actions
          // e.g. display_msg(response);
          console.log(response);
        },
        error: function() {
          // Handle error
          // e.g. display_msg('Error occurred');
          console.log('Error occurred');
        }
      });
    });
  });
</script>

<style>
  body{
    font-family: 'Poppins','Helvetica Neue', Helvetica, Arial, sans-serif !important;
  }
  .content-center{
    display: flex;
    justify-content: center;
    max-width: 900px;
    width: 100%;
  }
</style>

<div class="row">
  <div class="col-md-6">
    <?php echo display_msg($msg); ?>
  </div>
</div>

<div class="row">
<div class="col-md-12">
  <div class="col-md-12">
    <div class="panel">
      <!-- <div class="panel-heading"></div> -->
      <div class="headertext">Sales Report</div>
      <div class="panel-body" style="padding: 15px 0px;">
          <form id="sales-report-form" class="clearfix" style="width:100%; max-width: 900px; margin: auto;"  method="post" action="">
            <div class="form-group ">
              <label class="form-label" style="margin-top:20px;">Date Range</label>
              <div class="input-group">
                <input type="text" autocomplete="off" class="datepicker form-control" name="start-date" placeholder="From">
                <span class="input-group-addon"><i class="glyphicon glyphicon-menu-right"></i></span>
                <input type="text" autocomplete="off" class="datepicker form-control" name="end-date" placeholder="To">
              </div>
            </div>
            <div class="form-group">
              <button type="submit" name="submit" class="btn btn-primary">Generate Report</button>
            </div>
          </form>
      </div>
    </div>
  </div>
</div>
</div>

<?php 
  if(isset($_POST['submit'])) {
    include('sale_report_process.php');
  }
include_once('layouts/footer.php'); ?>
