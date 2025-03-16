if(isset($_POST['bdelete']))
{
    $appid = $_POST['bdelete'];

    // Fetch user email before deleting
    $queryFetch = "SELECT emailid, patientname FROM appointment WHERE appid='$appid'";
    $resultFetch = $dc->getrow($queryFetch);
    
    if($resultFetch) {
        $userEmail = $resultFetch['emailid'];
        $patientName = $resultFetch['patientname'];

        // Insert notification
        $notificationMessage = "Dear $patientName, your appointment (ID: $appid) has been deleted by the admin.";
        $queryNotification = "INSERT INTO notifications (emailid, message, status) VALUES ('$userEmail', '$notificationMessage', 'unread')";
        $dc->saverecord($queryNotification);
    }

    // Delete the record
    $query = "DELETE FROM appointment WHERE appid='$appid'";
    $result = $dc->deleterecord($query);
    
    if($result)
    {
        $msg = "Record deleted successfully, and notification sent.";
    }
    else
    {
        $msg = "Record not deleted.";
    }
}
