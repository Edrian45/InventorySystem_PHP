<?php $user = current_user(); ?>
<!DOCTYPE html>
  <html lang="en">
    <head>
    <meta charset="UTF-8">
    <title><?php if (!empty($page_title))
           echo remove_junk($page_title);
            elseif(!empty($user))
           echo ucfirst($user['name']);
            else echo "Inventory Management System";?>
    </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />
    <link rel="stylesheet" href="libs/css/main.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>
  <?php  if ($session->isUserLoggedIn(true)): ?>
    <header id="header">
      <div class="logo pull-left" style="background-image: url(https://scontent.fdvo2-1.fna.fbcdn.net/v/t39.30808-6/472271389_1116159323496301_1865747772688651438_n.jpg?stp=cp6_dst-jpg_tt6&_nc_cat=108&ccb=1-7&_nc_sid=833d8c&_nc_eui2=AeFY7arcNFyRSWeAbncUJVWbvaMSAsVd5Ae9oxICxV3kB1c0YwA_XGuG5w0rqLrDu7rrKVxbamn3VHwEA_kUswUj&_nc_ohc=g7eXQbd2OL8Q7kNvgEfzBsA&_nc_oc=AdhpGIUKwXCkB10-8_C9GGryYi8DzE3PXyNlBc89t-UlGO8NdmhLH-2o-0_DuW24ZLI&_nc_zt=23&_nc_ht=scontent.fdvo2-1.fna&_nc_gid=AaUF2uM-ofilK6BCJ8nJZ1l&oh=00_AYB8_fGeRxJrgTEQWc2LmK-jvOUEbFKDEll20tRQfBCxjw&oe=67ABC141); background-size: cover; background-position: center; background-repeat: no-repeat; color:yellow;">
      <img src="https://scontent.fdvo2-1.fna.fbcdn.net/v/t39.30808-6/471769555_1116203076825259_5913078955153600272_n.jpg?stp=cp6_dst-jpg_tt6&_nc_cat=102&ccb=1-7&_nc_sid=833d8c&_nc_eui2=AeH3s6F81p94EeWcQsHKMe7EM9l0Elr4zncz2XQSWvjOdwNtS0_5HSvY7LR8lLWYs-MkjNGAbwq4FJOBwVPmg7Iv&_nc_ohc=2eocB9P6vE4Q7kNvgEmH1Zy&_nc_oc=AdgwCl5nwvBbeKR9q1u05GXXzX7y_4kZJ2xhkvvwN28hRpphL8Czj4eBFB2rPX0LNHw&_nc_zt=23&_nc_ht=scontent.fdvo2-1.fna&_nc_gid=AHp3UTi5boFlQXz874xYU-T&oh=00_AYBgmYwy8lXVRij9Ozc-zz-aucy9OFi1V9z-_EQQqQWa9w&oe=67ABC9B8" style="width: 60px;height: 60px;border-radius: 10px; margin-right: 30px;">INIES MINI MART</div>
      <div class="header-content">
      <div class="header-date pull-left">
        <?php
          date_default_timezone_set(timezoneId: 'Asia/Manila'); // Set the timezone to Philippine time
        ?>
        <strong><?php echo date(format: "F j, Y, g:i a");?></strong>
      </div>
      <div class="pull-right clearfix">
        <ul class="info-menu list-inline list-unstyled">
          <li class="profile">
            <a href="#" data-toggle="dropdown" class="toggle" aria-expanded="false">
              <img src="uploads/users/<?php echo $user['image'];?>" alt="user-image" class="img-circle img-inline">
              <span><?php echo remove_junk(ucfirst($user['name'])); ?> <i class="caret"></i></span>
            </a>
            <ul class="dropdown-menu">
              <li>
                  <a href="profile.php?id=<?php echo (int)$user['id'];?>">
                      <i class="glyphicon glyphicon-user"></i>
                      Profile
                  </a>
              </li>
             <li>
                 <a href="edit_account.php" title="edit account">
                     <i class="glyphicon glyphicon-cog"></i>
                     Settings
                 </a>
             </li>
             <li class="last">
                 <a href="logout.php">
                     <i class="glyphicon glyphicon-off"></i>
                     Logout
                 </a>
             </li>
           </ul>
          </li>
        </ul>
      </div>
     </div>
    </header>
    <div class="sidebar">
      <?php if($user['user_level'] === '1'): ?>
        <!-- admin menu -->
      <?php include_once('admin_menu.php');?>

      <?php elseif($user['user_level'] === '2'): ?>
        <!-- Special user -->
      <?php include_once('special_menu.php');?>

      <?php elseif($user['user_level'] === '3'): ?>
        <!-- User menu -->
      <?php include_once('user_menu.php');?>

      <?php endif;?>

   </div>
</body>
<?php endif;?>

<div class="page">
  <div class="container-fluid">
