<?php
// Database Connection
include("../class/dataclass.php");
include("csslink.php");

$dc = new dataclass();
$query = "SELECT * FROM feedback";
$tb = $dc->gettable($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Testimonial Slider</title>
    
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css">
    
    <style>
        .swiper-container {
            width: 80%;
            margin: auto;
            padding: 20px;
        }
        .swiper-slide {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .testimonial-name {
            font-weight: bold;
            margin-top: 10px;
        }
    </style>
</head>
<body>

    <div class="swiper-container">
        <div class="swiper-wrapper">
            <?php while ($rw = mysqli_fetch_array($tb)) { ?>
                <div class="swiper-slide">
                <img src="./img/<?php echo $rw['image']; ?>" alt="Girl in a jacket" >
                    <p>"<?php echo $rw['feedname']; ?>"</p>
                    </span>- <span class="testimonial-name">- <?php echo $rw['feedback']; ?></span>
                </div>
            <?php } ?>
        </div>

        <!-- Pagination & Navigation -->
        <div class="swiper-pagination"></div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
    
    <script>
        var swiper = new Swiper('.swiper-container', {
            loop: true,
            autoplay: { delay: 3000 },
            pagination: { el: '.swiper-pagination', clickable: true },
            navigation: { nextEl: '.swiper-button-next', prevEl: '.swiper-button-prev' },
        });
    </script>
<?php include("jsslink.php"); ?>
</body>
</html>
