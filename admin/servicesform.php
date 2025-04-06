<?php 
session_start();
include("../class/dataclass.php");

// Initialize variables
$serviceid = isset($_SESSION['servicid']) ? $_SESSION['servicid'] : "";
$servicename = "";
$price = "";
$docid = "";

$dc = new dataclass();
$query = "";
$msg = "";

// If the transaction is 'update', fetch existing data
if (isset($_SESSION['trans']) && $_SESSION['trans'] == 'update' && !empty($serviceid)) {
    $query = "SELECT * FROM services WHERE serviceid='$serviceid'";
    $rw = $dc->getrow($query);
    
    if ($rw) {
        $servicename = $rw['servicename'];
        $price = $rw['price'];
        $docid = $rw['docid'];
    }
}

// Handle form submission
if (isset($_POST['bsave'])) {
    $servicename = isset($_POST['servicename']) ? $_POST['servicename'] : "";
    $price = isset($_POST['price']) ? $_POST['price'] : "";
    $docid = isset($_POST['docid']) ? $_POST['docid'] : "";

    if (isset($_SESSION['trans'])) {
        if ($_SESSION['trans'] == 'new') {
            $query = "INSERT INTO `services` (servicename, price, docid, status) 
                      VALUES ('$servicename', '$price', '$docid', 'Pending')";
            $result = $dc->insertrecord($query);
        } elseif ($_SESSION['trans'] == 'update') {
            $query = "UPDATE services SET servicename='$servicename', price='$price', docid='$docid' 
                      WHERE serviceid='$serviceid'";
            $result = $dc->updaterecord($query);
        }
    
        if ($result) {
            header('Location:showservices.php');
            exit();
        } else {
            $msg = "Record not saved";
        }
    }
}

?>
<?php    
        if(isset($_POST['bcancel']))
        {
            $_SESSION['trans']='cancel';
            header ('location:showservices.php');
        
        }

       
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dentist Service Form</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
        .form-control {
            border: 1px solid black;
        }
    </style>
</head>
<body>

<div class="content">
    <form action="#" method="POST">
        <main id="main" class="container">
            <section class="section dashboard">
                <div class="row">
                    <div class="row m-5">
                        <div class="col-md-4"></div>
                        <div class="col-md-8">
                            <h2 class="ps-4">Dentist Form</h2>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="row-md-3">
                                <label class="col-md-3 col-form-label">Service Name</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="servicename" value="<?php echo $servicename ?>" autofocus>
                                </div>
                            </div>

                            <div class="row-md-3">
                                <label class="col-md-3 col-form-label">Price</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="price" value="<?php echo $price ?>">
                                </div>
                            </div>
                            
                            <div class="row-md-3">
                                <label class="col-md-3 col-form-label">Doctor ID</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="docid" value="<?php echo $docid ?>">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 text-center">
                            <input type="submit" class="btn btn-success m-3" name="bsave" value="Save">
                            <input type="submit" class="btn btn-danger m-3" name="bcancel" value="Cancel">
                        </div>
                    </div>
                </div>
            </section>       
        </main>
    </form>
</div>

</body>
</html>
