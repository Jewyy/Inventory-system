<?php
$page_title = 'Edit sale';
require_once 'includes/load.php';
// Checkin What level user has permission to view this page
//  page_require_level(3);
?>
<?php
$sale = find_by_id('sales', (int) $_GET['id']);
if (!$sale) {
    $session->msg('d', 'Missing product id.');
    redirect('sales.php');
}
?>
<?php $product = find_by_id('products', $sale['product_id']); ?>
<?php

if (isset($_POST['update_sale'])) {
    // $req_fields = ['title', 'quantity', 'price', 'total', 'date'];
    $req_fields = ['title', 'quantity', 'total', 'date'];
    validate_fields($req_fields);
    if (empty($errors)) {
        $p_id = $db->escape((int) $product['id']);
        $s_qty = $db->escape((int) $_POST['quantity']);
        $s_total = $db->escape($_POST['total']);
        $date = $db->escape($_POST['date']);
        $s_date = date('Y-m-d', strtotime($date));

        $sql = 'UPDATE sales SET';
        $sql .= " product_id= '{$p_id}',qty={$s_qty},price='{$s_total}',date='{$s_date}'";
        $sql .= " WHERE id ='{$sale['id']}'";
        $result = $db->query($sql);
        if ($result && $db->affected_rows() === 1) {
            update_product_qty($s_qty, $p_id);
            $session->msg('s', 'Sale updated.');
            // redirect('edit_sale.php?id='.$sale['id'], false);
            redirect('sales.php', false);
        } else {
            $session->msg('d', ' Sorry failed to updated!');
            redirect('sales.php', false);
        }
    } else {
        $session->msg('d', $errors);
        //  redirect('edit_sale.php?id='.(int)$sale['id'],false);
        redirect('add_sale.php', false);
    }
}

?>
<?php include_once 'layouts/header.php'; ?>
<div class="row">
    <div class="col-md-6">
        <?php echo display_msg($msg); ?>
    </div>

</div>
<div class="box-header">
    <div class="headertext">Edit Sales</div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="panel">
            <!-- <div class="panel-heading clearfix">
                <strong>
                    <span class="glyphicon glyphicon-th"></span>
                    <span>All Sales</span>
                </strong>
                <div class="pull-right">
                    <a href="sales.php" class="btn btn-primary">Show all sales</a>
                </div>
            </div> -->

            <div class="panel-body">
                <!-- <table class="table table-bordered"> -->
                <div>
                    <!-- <thead>
                        <th> Product title </th>
                        <th> Qty </th>
                        <th> Price </th>
                        <th> Total </th>
                        <th> Date</th>
                        <th> Action</th>
                    </thead> -->
                    <tbody id="product_info">
                        <tr>
                            <form method="post" action="edit_sale.php?id=<?php echo (int) $sale['id']; ?>">
                                <div class="form-groupInput">
                                    <td id="s_name">
                                        <label for="quantity">Product:</label>
                                        <input type="text" class="form-control" id="sug_input" name="title"
                                            value="<?php echo remove_junk($product['name']); ?>">
                                        <div id="result" class="list-group"></div>
                                    </td>
                                </div>
                                <div class="form-groupInput">
                                    <td id="s_qty">
                                        <label for="quantity">Quantity:</label>
                                        <input type="text" class="form-control" name="quantity"
                                            value="<?php echo (int) $sale['qty']; ?>">
                                    </td>
                                </div>
                                <!-- <div class="form-groupInput">
                                    <label for="quantity">Sale price:</label>
                                    <td id="s_price">
                                        <input type="text" class="form-control" name="price"
                                            value="<?php echo remove_junk($product['sale_price']); ?>">
                                    </td>
                                </div> -->
                                <div class="form-groupInput">
                                    <label for="quantity">Price:</label>
                                    <td>
                                        <input type="text" class="form-control" name="total"
                                            value="<?php echo remove_junk($sale['price']); ?>">
                                    </td>
                                </div>
                                <div class="form-groupInput">
                                    <label for="quantity">Date:</label>
                                    <td id="s_date">
                                        <input type="date" class="form-control datepicker" name="date"
                                            data-date-format="" value="<?php echo remove_junk($sale['date']); ?>">
                                    </td>
                                </div>
                                <!-- <td>
                                    <button type="submit" name="update_sale" class="btn btn-primary">Update
                                        sale</button>
                                </td> -->
                                <div class="group-btn" style="padding-top: 16px;">
                                    <form method="post"> <input type="hidden" name="confirm" value="yes">
                                        <a href="sales.php" class="btn btn-default">Cancel</a>
                                        <button type="submit" name="update_sale" class="btn btn-primary">Update
                                            sale</button>
                                    </form>
                                </div>
                            </form>
                        </tr>
                    </tbody>
                    <!-- </table> -->
                </div>

            </div>
        </div>
    </div>
</div>

<?php include_once 'layouts/footer.php'; ?>
