<?php
  $page_title = 'All Sale';
  require_once 'includes/load.php';
  // Check what level user has permission to view this page
  page_require_level(3);
?>
<?php
  $sales = find_all_sale();
?>
<?php include_once 'layouts/header.php'; ?>

<div class="row">
  <?php echo display_msg($msg); ?>
</div>
<span style ="text-align: left;">
      <a href="admin.php" >Home </a>/
      
      </span>
      <span style ="float: right; ">
      <a href="sales_report.php" >Sales Report</a>/
      <a href="monthly_sales.php" >monthly Sales</a>/
      <a href="daily_sales.php" >Daily Sales</a>
      </span>
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading clearfix">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>All Sales</span>
        </strong>
        <div class="pull-right">
          <a href="add_sale.php" class="btn btn-primary">Add Sale</a>
        </div>
      </div>
      <div class="panel-body">
        <table class="table table-bordered table-striped">
          <thead>
            <tr>
              <th class="text-center" style="width: 50px;">#</th>
              <th>Product Name</th>
              <th class="text-center" style="width: 15%;">Quantity</th>
              <th class="text-center" style="width: 15%;">Total</th>
              <th class="text-center" style="width: 15%;">Date</th>
              <th class="text-center" style="width: 100px;">Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($sales as $sale): ?>
              <tr>
                <td class="text-center"><?php echo count_id(); ?></td>
                <td><?php echo remove_junk($sale['name']); ?></td>
                <td class="text-center"><?php echo (int)$sale['qty']; ?></td>
                <td class="text-center"><?php echo remove_junk($sale['price']); ?></td>
                <td class="text-center">
                <?php echo date('Y-m-d', strtotime($sale['date'])); ?>
                </td>
                <td class="text-center">
                  <div class="btn-group">
                    <a href="edit_sale.php?id=<?php echo (int)$sale['id']; ?>" class="btn btn-warning btn-xs" title="Edit" data-toggle="tooltip">
                      <span class="glyphicon glyphicon-edit"></span>
                    </a>
                    <a href="delete_sale.php?id=<?php echo (int)$sale['id']; ?>" class="btn btn-danger btn-xs" title="Delete" data-toggle="tooltip">
                      <span class="glyphicon glyphicon-trash"></span>
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

<?php include_once 'layouts/footer.php'; ?>