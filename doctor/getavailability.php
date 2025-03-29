<?php
include("../class/dataclass.php");
$dc = new dataclass();

$query = "SELECT a.id, a.date, a.start_time, a.end_time, a.status, d.docname
          FROM availability a
          JOIN dentist d ON a.docid = d.docid";

$result = $dc->getTable($query);

$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = [
        'id' => $row['id'],
        'docname' => $row['docname'],
        'date' => $row['date'],
        'start_time' => $row['start_time'],
        'end_time' => $row['end_time'],
        'status' => $row['status']
    ];
}

header('Content-Type: application/json');
echo json_encode($data, JSON_PRETTY_PRINT);
?>
