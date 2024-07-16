<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname ="sdrtennis";

$conn = new mysqli( $servername, $username, $password, $dbname);

if($conn->connect_error){
    die("connection failed:" . $conn->connect_error);
}

$vsc = $_POST["rbb"];
$gsf = $_POST["rcc"];
$sql = "SELECT lname, password FROM players WHERE lname = ?";
$bse = $conn->prepare($sql);
$value1 = $vsc;
$bse->bind_param("s", $value1);
$bse->execute();
$bse->store_result();
if($bse->num_rows === 1){
    $bse->bind_result( $nme, $pass);
    $bse->fetch();
    $bse->close();
    if($gsf === $pass){

    header("Location: http://localhost/project/srm.html");

    }
    else{
        echo "<p>your password is incorrect</p><br>";
        echo "<a href='http://localhost/project/sdr.html'>back to login</a>";
    }
}
else{
    echo "please register in the website in  order to login<br>";
    echo "<a href='http://localhost/project/sdr.html'>back to login</a>";
}


$conn->close();
?>