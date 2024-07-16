<?php
$servername = "localhost";
$username = "root";
$password ="";
$dbname = "sdrtennis";
$conn = new mysqli( $servername, $username, $password, $dbname);
if($conn->connect_error){
    die ("connection failed:". $conn->connect_error);

}


$hsf = $_POST["fgh"];
$jsf = $_POST["cde"];
$ksf = $_POST["vmp"];
$tuy = $_POST["rws"];


if((strtotime($jsf) < strtotime("04:00 PM")) || (strtotime($ksf) > strtotime("9:00 PM"))|| (strtotime($jsf) > strtotime($ksf))){
    print("invalid please check your slot<br>");
    echo "<a href='http://localhost/project/srm.html'>back to book</a>";
    exit();
}

$rmn = "SELECT date1, COUNT(*) as count FROM timetable  WHERE date1 = ? AND ((time1 >= ? and time1 <= ?) or (time1 <= ? and time2 >=?)) GROUP BY date1";
$result = $conn->prepare($rmn);
$result->bind_param("sssss",$hsf,$jsf, $ksf, $jsf, $jsf);
$result->execute();
$result->bind_result($gfc, $count);
$result->fetch();
$result->close();

if ($count <4){
$sql = "INSERT INTO timetable(id, date1, time1, time2) VALUES (?,?,?,?)";
$cba=$conn->prepare($sql);
$cba->bind_param("ssss" , $tuy, $hsf, $jsf, $ksf);
$cba->execute();
print("slot booked successfully<br>");
echo "<a href='http://localhost/project/sdr.html'>log out</a>";
$cba->close();
}
else{
    print("all the courts are filled<br>");
    echo "<a href='http://localhost/project/srm.html'>back to book</a>";
}



?>

