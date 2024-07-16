<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname ="sdrtennis";
$conn = new mysqli( $servername, $username, $password, $dbname);

if($conn->connect_error){
    die("connection failed :". $conn->connect_error);
}
$sgh=$_POST["vbb"];
$fsh=$_POST["vcc"];
$sfh=$_POST["vdd"];
$srh=$_POST["phnno"];
$hrs=$_POST["uid"];

if($fsh===$sfh)
{
$fby = "SELECT * FROM players WHERE phno=? and lname=?";
$ryu = $conn->prepare($fby);
$ryu->bind_param("ss", $srh, $sgh);
$ryu->execute();
$ryu->store_result();

if($ryu->num_rows === 1){
$ryu->fetch();
$ryu->close();
$vnl ="UPDATE players SET password=? WHERE phno=? and lname=?";  
$hnl = $conn->prepare($vnl);
$hnl->bind_param("sss", $fsh, $srh, $sgh);
$hnl->execute();
$hnl->close();
print "your password is changed successfuly<br>";
echo "<a href='http://localhost/project/sdr.html'>back to login</a>";


exit();
}

$sql = "INSERT INTO players(lname, password, phno) values(?,?,?)";
$sbe = $conn->prepare($sql);
    $sbe->bind_param("sss", $sgh, $fsh, $srh);
    $sbe->execute();
    $sbe->close();


$vsr = "INSERT INTO idandname(name, userid) values(?,?)";
$vew = $conn->prepare($vsr);
    $vew->bind_param("ss", $sgh, $hrs);
    $vew->execute();
    $vew->close();
print "<p>you are successfully registered and ready for the login</p><br>";
echo "<a href='http://localhost/project/sdr.html'>back to login</a>";


}

else{
    print "invalid password<br>";
    echo "<a href='http://localhost/project/rgj.html'>back to register</a>";
}
?>