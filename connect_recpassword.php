<?php


require 'connection.php';
$conn    = Connect();
$strpassword   = $conn->real_escape_string($_POST['strpassword']);
$strpassword2 = $conn->real_escape_string($_POST['strpassword2']);
$strusername=$conn->real_escape_string($_POST['strusername']);


if($strpassword==$strpassword2){
	
$query   = "update usertbl set strpassword = '$strpassword' where strusername='$strusername'";
$success = $conn->query($query);

}

else{
	echo"Passwords do not match";
}
if (!$success) {
    die("Couldn't enter data: ".$conn->error);

}
$query   = mysqli_query($conn,"SELECT * FROM usertbl WHERE strusername='$strusername' AND strpassword='$strpassword' ");
$query1=mysqli_query($conn,"SELECT * FROM usertbl WHERE strusername='$strusername' and blnactive=0");
$query2=mysqli_query($conn,"SELECT * FROM usertbl WHERE strusername='$strusername' AND strpassword='$strpassword'" );
$rows=mysqli_num_rows($query);
$rows1=mysqli_num_rows($query1);
$rows2=mysqli_fetch_array($query2);

if($rows1==0){
	
if($rows==1){
	if($rows2['strRole']=='dev')
	{echo"Dev";
include("manageadminpage.php");}
else if($rows2['strRole']=='admin')
{echo"admin";
include("manageusers.php");}
	else if($rows2['strRole']=='user')
	{echo"user";
include("managestudent.php");}
	/**switch($rows2){
		case "dev":
	echo"Welcome Dev";
	include("manageadminpage.php");
	break;
	
	
		case "user":
	echo"Welcome user";
	include("manageusers.php");
	break;
	
				case"admin":
	echo"Welcome Admin";
	include("managestudent.php");
	break;
	default:
	echo"No user";
	}
	**/
	
}


}
else{
	echo"Please activate your account first";
}

$conn->close();

?>
