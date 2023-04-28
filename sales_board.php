<?php
  $page_title = 'Sales Borad';
  require_once('includes/load.php');
  include_once('layouts/header.php'); 
  page_require_level(3);
?>

<?php
 $year  = date('Y');
 $month = date('m');
 $day = date('d');
 $sales_daily = dailySales($year,$month,$day);
 $sales_monthly = monthlySales($year,$month);

  // Get the first and last date in the sales_monthly array
  $start_date_monthly = reset($sales_monthly);
  $end_date_monthly = end($sales_monthly);
  if (is_array($start_date_monthly) || is_array($end_date_monthly)){
    $results_monthly = find_sale_by_dates($start_date_monthly['date'],$end_date_monthly['date']);
  }
  else $results_monthly = 0;

  $start_date_daily = reset($sales_daily);
  $end_date_daily = end($sales_daily);
  if (is_array($start_date_daily) || is_array($end_date_daily))
    $results_daily = find_sale_by_dates($start_date_daily['date'],$end_date_daily['date']);
  else $results_daily = 0;
?>
<style>
  .show-grand-profit{
    flex-wrap: wrap; 
    display: flex; 
    align-content: center; 
  }
  .grand-profit-head{
    font-size: 22px;
    font-weight: bold;
    justify-content: center;
    border: 5px solid #8594A6;
    border-radius: 40px 20px;
    background-color: var(--Green);
    color: white;
  }
  .grand-profit-content{
    font-size:20px;
    justify-content: center;
  }
  .grand-profit-box{
    width: 50%; 
    height: 100px; 
    display: inherit; 
    justify-content: center;
  }
  .tab {
    cursor: pointer;
    text-align: center;
    margin: 10px 0;
    border: 1px solid #8594A6;
    width: 100%;
    height: 35px;
    display: flex;
    justify-content: center;
    align-items: center;
  }
  .contain-tab{
    display: flex;
    margin-top: 20px;
  }

  .active {
    background-color: var(--Green);
    color: white;
  }

  .content {
    display: none;
  }
</style>

<?php include_once('layouts/header.php'); ?>
<div class="row">
<div class="headertext">Sales Board</div>
  <div class="col-md-6">
    <?php echo display_msg($msg); ?>
  </div>
</div>
<div class="col-md-12">
<div class="contain-tab"> 
  <div class="tab" id="dailyTab">Daily</div>
  <div class="tab" id="monthlyTab">Monthly</div>
</div>
 
<div class="content" id="dailyContent">
<div class="row">
  <div class="col-md-12">
    <div class="panel">
      <!-- <div class="panel-heading clearfix"> -->
        <strong>
          <span style="font-size: 22px;">Daily Sales </span>
        </strong>
      <!-- </div> -->
        <div style="display: flex; margin: 50px 0px;">
          <div class="grand-profit-box">
            <div class="text-center show-grand-profit grand-profit-head" style="width: 30%;">Grand</div>
            <div class="text-center show-grand-profit grand-profit-content" style="width: 40%;"><?php echo number_format(total_price($results_daily)[0], 2);?></div>
            <div class="text-center show-grand-profit" style="width: fit-content;">Baht</div>
          </div>
          <div class="grand-profit-box">
            <div class="text-center show-grand-profit grand-profit-head" style="width: 30%;">Profit</div>
            <div class="text-center show-grand-profit grand-profit-content" style="width: 40%;"><?php echo number_format(total_price($results_daily)[1], 2);?></div>
            <div class="text-center show-grand-profit" style="width: fit-content;">Baht</div>
          </div>
        </div>
          <table class="table table-striped">
              <thead>
              <tr>
                  <th class="text-center product-tab" style="width: 50px;">#</th>
                  <th class="product-tab"> Product Name </th>
                  <th class="text-center product-tab" style="width: 15%;"> Quantity sold</th>
                  <th class="text-center product-tab" style="width: 15%;"> Total </th>
                  <th class="text-center product-tab" style="width: 15%;"> Date </th>
              </tr>
              </thead>
          <tbody>
            <?php foreach ($sales_daily as $sale):?>
            <tr>
              <td class="text-center"><?php echo count_id();?></td>
              <td><?php echo remove_junk($sale['name']); ?></td>
              <td class="text-center"><?php echo (int)$sale['qty']; ?></td>
              <td class="text-center"><?php echo remove_junk($sale['total_saleing_price']); ?></td>
              <td class="text-center"><?php echo $sale['date']; ?></td>
            </tr>
            <?php endforeach;?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<div class="content" id="monthlyContent">
<div class="row">
    <div class="col-md-12">
      <div class="panel">
        <!-- <div class="panel-heading clearfix"> -->
          <strong>
            <span style="font-size: 22px;">Monthly Sales</span>
          </strong>
        <!-- </div> -->
            <div style="display: flex; margin: 50px 0px;">
              <div class="grand-profit-box">
                <div class="text-center show-grand-profit grand-profit-head" style="width: 30%;">Grand</div>
                <div class="text-center show-grand-profit grand-profit-content" style="width: 40%;"><?php echo number_format(total_price($results_monthly)[0], 2);?></div>
                <div class="text-center show-grand-profit" style="width: fit-content;">Baht</div>
              </div>
              <div class="grand-profit-box">
                <div class="text-center show-grand-profit grand-profit-head" style="width: 30%;">Profit</div>
                <div class="text-center show-grand-profit grand-profit-content" style="width: 40%;"><?php echo number_format(total_price($results_monthly)[1], 2);?></div>
                <div class="text-center show-grand-profit" style="width: fit-content;">Baht</div>
              </div>
            </div>
          <table class="table table-striped">
            <thead>
            <tr>
                <th class="text-center product-tab" style="width: 50px;">#</th>
                <th class="product-tab"> Product Name </th>
                <th class="text-center product-tab" style="width: 15%;"> Quantity sold</th>
                <th class="text-center product-tab" style="width: 15%;"> Total </th>
                <th class="text-center product-tab" style="width: 15%;"> Date </th>
            </tr>
            
            </thead>
           <tbody>
             <?php foreach ($sales_monthly as $sale):?>
             <tr>
               <td class="text-center"><?php echo count_id2();?></td>
               <td><?php echo remove_junk($sale['name']); ?></td>
               <td class="text-center"><?php echo (int)$sale['qty']; ?></td>
               <td class="text-center"><?php echo remove_junk($sale['total_saleing_price']); ?></td>
               <td class="text-center"><?php echo $sale['date']; ?></td>
             </tr>
             <?php endforeach;?>
           </tbody>
         </table>
        </div>
      </div>
    </div>
</div>
</div>
<script>
    // Get the tabs and content elements
    var dailyTab = document.getElementById('dailyTab');
    var monthlyTab = document.getElementById('monthlyTab');
    var dailyContent = document.getElementById('dailyContent');
    var monthlyContent = document.getElementById('monthlyContent');
    
    // Set the initial active tab
    dailyTab.classList.add('active');
    dailyContent.style.display = 'block';
    
    // Add event listeners for tab clicks
    dailyTab.addEventListener('click', function() {
      dailyTab.classList.add('active');
      monthlyTab.classList.remove('active');
      dailyContent.style.display = 'block';
      monthlyContent.style.display = 'none';
    });
    
    monthlyTab.addEventListener('click', function() {
      monthlyTab.classList.add('active');
      dailyTab.classList.remove('active');
      monthlyContent.style.display = 'block';
      dailyContent.style.display = 'none';
    });
  </script>

<?php include_once('layouts/footer.php'); ?>
