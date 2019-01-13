
<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
// Create connection, 127.0.0.1 for windows, localhost for linux
$conn = new mysqli("127.0.0.1", "yourusername", "yourpassword", "animals", 3307);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query("SELECT Species, Amount, Price, Owner FROM animals LIMIT 50");

$outp = "";
if ($result->num_rows > 0) {
  // output data of each row
  while($rs = $result->fetch_assoc()) {
    if ($outp != "") {$outp .= ",";}
    $outp .= '{"Species":"'. $rs["Species"] . '",';
    $outp .= '"Amount":"'  . $rs["Amount"]  . '",';
    $outp .= '"Price":"'   . $rs["Price"]   . '",';
    $outp .= '"Owner":"'   . $rs["Owner"]   . '"}';
  }
  $outp ='{"animals":['.$outp.']}';
} else {
    echo "0 results";
}
$conn->close();

echo($outp);
?>
