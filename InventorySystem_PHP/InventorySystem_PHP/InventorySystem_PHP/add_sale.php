<?php 
  $page_title = 'Add Sale';
  require_once('includes/load.php');
  // Check what level user has permission to view this page
  page_require_level(3);
?>
<?php
  if (isset($_POST['add_sale'])) {
    $req_fields = array('s_id', 'quantity', 'price', 'total', 'date');
    validate_fields($req_fields);

    if (empty($errors)) {
      $p_id    = $db->escape((int)$_POST['s_id']);
      $s_qty   = $db->escape((int)$_POST['quantity']);
      $s_total = $db->escape($_POST['total']);
      $date    = $db->escape($_POST['date']);
      $s_date  = make_date();

      // Check if stock is sufficient
      $stock_query = "SELECT quantity, name FROM products WHERE id = '{$p_id}'";
      $stock_result = $db->query($stock_query);

      if ($stock_result && $db->num_rows($stock_result) > 0) {
        $stock_data = $db->fetch_assoc($stock_result);
        $current_stock = (int)$stock_data['quantity'];
        $product_name = $stock_data['name'];

        if ($current_stock <= 0) {
          $session->msg('d', "Sale cannot be added. Product '{$product_name}' is out of stock.");
          redirect('add_sale.php', false);
        } elseif ($s_qty > $current_stock) {
          $session->msg('d', "Sale quantity exceeds available stock for '{$product_name}'.");
          redirect('add_sale.php', false);
        } else {
          // Proceed with sale
          $sql  = "INSERT INTO sales (product_id, qty, price, date) VALUES ";
          $sql .= "('{$p_id}', '{$s_qty}', '{$s_total}', '{$s_date}')";

          if ($db->query($sql)) {
            update_product_qty($s_qty, $p_id);
            $session->msg('s', "Sale added successfully.");
            redirect('add_sale.php', false);
          } else {
            $session->msg('d', 'Sorry, failed to add the sale!');
            redirect('add_sale.php', false);
          }
        }
      } else {
        $session->msg('d', 'Invalid product selected.');
        redirect('add_sale.php', false);
      }
    } else {
      $session->msg("d", $errors);
      redirect('add_sale.php', false);
    }
  }
?>
<?php include_once('layouts/header.php'); ?>

<div class="row">
  <?php echo display_msg($msg); ?>
  <span style ="text-align: left;">
      <a href="admin.php" >Home </a>/
      <a href="sales.php" >Sales </a>/
      <a href="product.php" >Products </a>
      </span>
  <div class="col-md-6">
    <!-- Product search form -->
    <form method="post" action="ajax.php" autocomplete="off" id="sug-form">
      <div class="form-group">
      <span class="input-group-btn">
            <button type="submit" class="btn btn-primary">Find It</button>
          </span>
        <div class="input-group">
          <input type="text" id="sug_input" class="form-control" name="title" placeholder="Search for product name">
        </div>
        <div id="result" class="list-group"></div>
      </div>
    </form>
  </div>
</div>

<div class="row">
  <div class="col-md-12">
    <!-- Sales form -->
    <div class="panel panel-default">
      <div class="panel-heading clearfix">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>Add Sale</span>
        </strong>
      </div>
      <div class="panel-body">
        <form method="post" action="add_sale.php">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Item</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Total</th>
                <th>Date</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody id="product_info">
              <!-- Dynamically populated rows go here -->
            </tbody>
          </table>
        </form>
      </div>
    </div>
  </div>
</div>

<?php include_once('layouts/footer.php'); ?>
