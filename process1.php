<?php 
//echo $_POSTI'name'; 
//echo '<br />'; 
//echo $_POST'email'); 
//Validation 
$error_fields= array(); 
if(! (isset ($_POST['name']) && !empty($_POST['name']))){
     $error_fields[] = "name"; 
	 }
if(! (isset ($_POST['email']) && filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL) )){
     $error_fields[] = "email"; 
	 }
 if(! (isset ($_POST['password']) && strlen($_POST['password']) > 5)){ 
     $error_fields[] = "password"; 
	 }
if($error_fields){
	header("Location: form.php?error_fields=".implode(",", $error_fields));
	exit; 
} 
//Connect to DB Sconn • myscili_connect("localhost", "root". 'iti", mblog"); 
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$conn=mysqli_connect("localhost", "root", "Jesus@2022", "vico89");
if (!$conn) {
	echo "Connection failed!";
}
else { echo "Dooooooooooooooooooooooooooooooooooooooooooooooooone"; }


//Escape any sepcial characters to avoid SQL Injection

$name = mysqli_escape_string($conn, $_POST['name']);
$email = mysqli_escape_string($conn, $_POST['email']);
$password = mysqli_escape_string($conn, $_POST['password']);
$address= mysqli_escape_string($conn, $_POST['address']);

//Insert the data
$query = "INSERT INTO users (name,email,password,address) VALUES ('$name', '$email',
'$password','$address')";
if (mysqli_query($conn, $query)){
echo "Thank you!, your information has been saved";
} 
else
	{
echo $query;
echo mysqli_error($conn);
}

mysqli_close($conn);