<?php
  $page_title = 'Admin Home Page';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
?>
<?php
 $c_categorie     = count_by_id('categories');
 $c_product       = count_by_id('products');
 $c_sale          = count_by_id('sales');
 $c_user          = count_by_id('users');
 $products_sold   = find_higest_saleing_product('5');
 $recent_products = find_recent_product_added('5');
 $recent_sales    = find_recent_sale_added('10')
?>
<?php include_once('layouts/header.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      display: flex;
      
      
    }
    .panel-icon {
      font-size: 2rem;
    }
    .panel-value h2 {
      margin-top: 10px;
    }
  </style>
</head>
<body>
<div class="container mt-4">
  <div class="row">
    <?php echo display_msg($msg); ?>
  </div>
  <div class="row">
    <!-- User Panel -->
    <div class="col-md-3 col-sm-6 mb-3">
      <a href="users.php" class="text-decoration-none text-dark">
        <div class="panel panel-box clearfix bg-light shadow-sm">
          <div class="panel-icon pull-left bg-secondary p-3">
            <i class="glyphicon glyphicon-user"></i>
          </div>
          <div class="panel-value pull-right">
            <h2><?php echo $c_user['total']; ?></h2>
            <p class="text-muted">Users</p>
          </div>
        </div>
      </a>
    </div>
    
    <!-- Categories Panel -->
    <div class="col-md-3 col-sm-6 mb-3">
      <a href="categorie.php" class="text-decoration-none text-dark">
        <div class="panel panel-box clearfix bg-light shadow-sm">
          <div class="panel-icon pull-left bg-danger p-3">
            <i class="glyphicon glyphicon-th-large"></i>
          </div>
          <div class="panel-value pull-right">
            <h2><?php echo $c_categorie['total']; ?></h2>
            <p class="text-muted">Categories</p>
          </div>
        </div>
      </a>
    </div>

    <!-- Products Panel -->
    <div class="col-md-3 col-sm-6 mb-3">
      <a href="product.php" class="text-decoration-none text-dark">
        <div class="panel panel-box clearfix bg-light shadow-sm">
          <div class="panel-icon pull-left bg-primary p-3">
            <i class="glyphicon glyphicon-shopping-cart"></i>
          </div>
          <div class="panel-value pull-right">
            <h2><?php echo $c_product['total']; ?></h2>
            <p class="text-muted">Products</p>
          </div>
        </div>
      </a>
    </div>

    <!-- Sales Panel -->
    <div class="col-md-3 col-sm-6 mb-3">
      <a href="sales.php" class="text-decoration-none text-dark">
        <div class="panel panel-box clearfix bg-light shadow-sm">
          <div class="panel-icon pull-left bg-success p-3 ">
            <i class="glyphicon glyphicon-usd"></i>
          </div>
          <div class="panel-value pull-right">
            <h2><?php echo $c_sale['total']; ?></h2>
            <p class="text-muted">Sales</p>
          </div>
        </div>
      </a>
    </div>
    <div class="col-md-4 col-sm-12 mb-4">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong><span class="glyphicon glyphicon-th"></span> 5 Highest Selling Products</strong>
        </div>
        <div class="panel-body">
          <table class="table table-striped table-bordered table-sm">
            <thead>
              <tr>
                <th>Title</th>
                <th>Total Sold</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($products_sold as  $product_sold): ?>
                <tr>
                  <td><?php echo remove_junk(first_character($product_sold['name'])); ?></td>
                  <td><?php echo (int)$product_sold['totalQty']; ?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="col-md-4 col-sm-12 mb-4">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong><span class="glyphicon glyphicon-th"></span> 10 Latest Sales</strong>
        </div>
        <div class="panel-body">
          <table class="table table-striped table-bordered table-sm">
            <thead>
              <tr>
                <th>#</th>
                <th>Product Name</th>
                <th>Date</th>
                <th>Total Sale</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($recent_sales as  $recent_sale): ?>
                <tr>
                  <td class="text-center"><?php echo count_id(); ?></td>
                  <td>
                    <a href="edit_sale.php?id=<?php echo (int)$recent_sale['id']; ?>">
                      <?php echo remove_junk(first_character($recent_sale['name'])); ?>
                    </a>
                  </td>
                  <td><?php echo remove_junk(ucfirst($recent_sale['date'])); ?></td>
                  <td>PHP<?php echo remove_junk(first_character($recent_sale['price'])); ?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="col-md-4 col-sm-12 mb-4">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong><span class="glyphicon glyphicon-th"></span> 5 Recently Added Products</strong>
        </div>
        <div class="panel-body">
          <div class="list-group">
            <?php foreach ($recent_products as  $recent_product): ?>
              <a class="list-group-item clearfix" href="edit_product.php?id=<?php echo (int)$recent_product['id']; ?>">
                <h4 class="list-group-item-heading">
                  <?php if($recent_product['media_id'] === '0'): ?>
                    <img class="img-avatar img-circle" src="uploads/products/no_image.png" alt="">
                  <?php else: ?>
                    <img class="img-avatar img-circle" src="uploads/products/<?php echo $recent_product['image']; ?>" alt="" />
                  <?php endif; ?>
                  <?php echo remove_junk(first_character($recent_product['name'])); ?>
                  <span class="label label-warning pull-right">PHP<?php echo (int)$recent_product['sale_price']; ?></span>
                </h4>
                <span class="list-group-item-text pull-right"><?php echo remove_junk(first_character($recent_product['categorie'])); ?></span>
              </a>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Recent Data Panels -->

  <!-- Product Table -->
  <div class="row">
  <?php
  $page_title = 'All Product';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(2);
  $products = join_product_table();
?>
<?php include_once('layouts/header.php'); ?>

  <div class="col-md-15">
    <div class="panel panel-default">
      <div class="panel-body">
      <div style="margin-bottom: 10px; text-align: center;">
            <a href="add_sale.php" class="btn btn-primary">Add sale</a>
          </div>
        <table class="table table-bordered">
          <thead>
            <tr>
              <th class="text-center" style="width: 10%; background-color:green;"> Categories </th>
              <th style="background-color:green;"> Product Title </th>
              <th class="text-center" style="width: 10%;background-color:green;"> Remaining Stock </th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($products as $product): ?>
              <tr>
                <td class="text-center"> <?php echo remove_junk($product['categorie']); ?></td>
                <td> <?php echo remove_junk($product['name']); ?></td>
                <td class="text-center">
                <?php
                    $quantity = remove_junk($product['quantity']); 
                    echo $quantity == 0 
                      ? '<span style="color: red; "><b>Out of Stock</b></span>' 
                      : $quantity; 
                  ?>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <?php include_once('layouts/footer.php'); ?>
<!-- Bootstrap JS and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
