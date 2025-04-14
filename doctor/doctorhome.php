<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include("csslink.php"); ?>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f6f9;
            margin: 0;
            padding: 0;
        }
        .calendar-container {
            width: 90%;
            max-width: 900px;
            margin: 40px auto;
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        }
        h2 {
            text-align: center;
            color: #343a40;
            margin-bottom: 25px;
            font-size: 24px;
            font-weight: 600;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 10px;
            overflow: hidden;
        }
        th, td {
            border: 1px solid #dee2e6;
            padding: 18px;
            text-align: center;
            font-size: 16px;
        }
        th {
            background: #007bff;
            color: white;
            font-weight: bold;
        }
        td {
            transition: all 0.3s ease;
        }
        td:hover {
            background:rgb(238, 239, 233);
            cursor: pointer;
            transform: scale(1.05);
        }
        .booked {
            background-color: #dc3545;
            color: white;
            font-weight: bold;
            border-radius: 5px;
        }
        .booked:hover {
        background-color: #c82333; /* Darker red on hover */
        cursor: not-allowed; /* Indicate that the date is unavailable */
    }
        .nav-btns {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .nav-btns a {
            text-decoration: none;
            background: #007bff;
            color: white;
            padding: 12px 20px;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        .nav-btns a:hover {
            background: #0056b3;
            transform: scale(1.1);
        }
    </style>
    <?php 
    // session_start();
    include ("../class/dataclass.php");
    $dc=new dataclass();
    $totalappointment=$dc->counter("select count(*) from appointment");
    

    // $docid= $_SESSION['docid'] ; 
    // $docname= $_SESSION['docname'] ; 
    //  ?>
</head>
<body>
    
   <?php include("slider.php"); ?>
   <div class="content">
   <?php include("header.php"); ?>
   
  
   <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-line fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Total Appointment</p>
                                <h6 class="mb-0"><?php echo $totalappointment?></h6>
                            </div>
                        </div>
                    </div>

                    <?php

$month = isset($_GET['month']) ? $_GET['month'] : date('m');
$year = isset($_GET['year']) ? $_GET['year'] : date('Y');
$firstDayOfMonth = strtotime("$year-$month-01");
$daysInMonth = date('t', $firstDayOfMonth);
$startDay = date('N', $firstDayOfMonth);

// Fetch booked appointments
$query = "SELECT appdate, COUNT(*) AS total FROM appointment GROUP BY appdate";
$result = $dc->gettable($query);
$bookedDates = [];
while ($row = mysqli_fetch_assoc($result)) {
    $bookedDates[$row['appdate']] = $row['total'];
}
?>

<!-- 
<div class="calendar-container">
    <h2>Appointment Calendar</h2>
    <div class="nav-btns">
    <a href="?month=<?php echo ($month - 1); ?>&year=<?php echo $year; ?>">Prev</a>
    <strong><?php echo date('F Y', $firstDayOfMonth); ?></strong>
    <a href="?month=<?php echo ($month + 1); ?>&year=<?php echo $year; ?>">Next</a>
</div> -->
    <table>
        <tr>
            <th>Mon</th>
            <th>Tue</th>
            <th>Wed</th>
            <th>Thu</th>
            <th>Fri</th>
            <th>Sat</th>
            <th>Sun</th>
        </tr>
        <tr>
            <?php
            $day = 1;
            for ($i = 1; $i < $startDay; $i++) {
                echo "<td></td>";
            }
            while ($day <= $daysInMonth) {
                $date = "$year-$month-" . str_pad($day, 2, "0", STR_PAD_LEFT);
                $class = isset($bookedDates[$date]) ? 'booked' : '';
                echo "<td class='$class'>$day</td>";
                if (($day + $startDay - 1) % 7 == 0) echo "</tr><tr>";
                $day++;
            }
            ?>
        </tr>
    </table>
        </div>
</body>
</html>


<!--        
              <div class="container-fluid pt-4 px-4">
                <div class="bg-light text-center rounded p-4">
                   
                </div>
            </div> -->
            
            <?php include("footer.php"); ?>
   </div>
   
   <?php include("jslink.php"); ?>
</body>
</html>