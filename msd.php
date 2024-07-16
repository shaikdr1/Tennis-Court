<?php
$servername = "localhost";
$username = "root";
$password ="";
$dbname = "sdrtennis";
$conn = new mysqli( $servername, $username, $password, $dbname);
if($conn->connect_error){
    die ("connection failed:". $conn->connect_error);

}
$xvw = $_POST["sri"];
$vql = "SELECT time1,time2 FROM timetable WHERE date1 = ?";
$stmt = $conn->prepare($vql);
$stmt->bind_param("s",$xvw);
$stmt->execute();
$stmt->bind_result($time1, $time2);

while($stmt->fetch()){
    echo  $time1."    ";
    echo  $time2."<br>";
}
$stmt->close();
$conn->close();
echo "<a href='http://localhost/project/srm.html'>back to book</a>";
?>