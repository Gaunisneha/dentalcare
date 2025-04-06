<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
 <?php   include("csslink.php") ?>
</head>
<body>
      <!-- Spinner Start -->
      <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary m-1" role="status">
            <span class="sr-only">Loading...</span>
        </div>
        <div class="spinner-grow text-dark m-1" role="status">
            <span class="sr-only">Loading...</span>
        </div>
        <div class="spinner-grow text-secondary m-1" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->
<?php   include("topbar.php") ?> 
<?php   include("header.php") ?> 
<?php   include("slider.php") ?> 
<?php   include("banner.php") ?>
<?php   include("price.php") ?>

<?php   include("offer.php") ?>
<?php   include("footer.php") ?> 
<?php include("jsslink.php") ?>
</body>
</html>