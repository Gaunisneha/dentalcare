<!DOCTYPE html>
<html lang="en">
<head>
    <?php 
        session_start();
        include("../class/dataclass.php");
    ?>
    <?php
        $feedid = "";
        $feedname="";
        $feedback = "";
        $dc = new dataclass();
        $query = "";
        $msg = ""; 
    ?>
    
    <?php    
        if(isset($_POST['bsave'])){
            $feedname=$_POST['feedname'];
            $filename = $_FILES['image']['name'];
            $tmpname = $_FILES['image']['tmp_name'];
            $feedback = $_POST['feedback'];
            
            $query = "INSERT INTO `feedback`( `feedname`,`feedback`,`image`,`status`) VALUES ('$feedname','$feedback','$filename','panding')";
            $result = $dc->insertrecord($query);

            if (!$result) {
                $msg = "Record not feedback";
            }

            if ($result) {
                header('Location: mainhome.php');
                move_uploaded_file($tmpname, '../home/img/'.$filename);
            }
        }
       
    ?>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom styles for the form */
        body {
            background-color: #f8f9fa;
            padding-top: 50px;
        }

        .form-container {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 30px;
        }

        h2 {
            font-size: 2rem;
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
        }

        .form-label {
            font-weight: bold;
        }

        .form-control, .form-select, textarea {
            border-radius: 5px;
            box-shadow: none;
            border: 1px solid #ddd;
        }

        .form-control:focus, .form-select:focus {
            border-color: #5c7cfa;
            box-shadow: 0 0 0 0.25rem rgba(82, 153, 255, 0.25);
        }

        .btn-custom {
            width: 100%;
            padding: 12px;
            font-size: 1rem;
            border-radius: 5px;
        }

        .btn-success {
            background-color: #28a745;
            border: none;
        }

        .btn-danger {
            background-color: #dc3545;
            border: none;
        }

        .btn-success:hover {
            background-color: #218838;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }

        .text-center {
            text-align: center;
        }
    </style>
</head>
<body>

<div class="container form-container">
    <form action="#" method="POST" enctype="multipart/form-data">
        <h2>feedback Form</h2>
        <div class="row">

            <div class="col-md-6">

                <div class="mb-3">
                    <label class="form-label" for="feedname">Feed Name </label>
                    <input type="text" class="form-control" id="feedname" name="feedname" value='<?php echo $feedname ?>' autofocus>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="feedback">feedback</label>
                    <textarea class="form-control" id="feedback" name="feedback" rows="5"><?php echo $feedback ?></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="image">Image</label>
                    <input type="file" class="form-control" id="image" name="image">
                </div>
                
            </div>
        </div>

        <div class="text-center mt-4">
            <input type="submit" class="btn btn-success " name="bsave" value="Save">
          
        </div>
    </form>
    <?php echo $msg ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
