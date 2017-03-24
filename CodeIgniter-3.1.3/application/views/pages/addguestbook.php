<?php
$host = "localhost"; 
$username = "root";
$password = "root";
$db_name = "Guestbook";
$table_name = "Nick_Guestbook";

//Connect to the server & database.

mysql_connect("$host", "$username", "$password") or die("Cannot connect to server. Sorry!");
mysql_select_db("$db_name") or die("Cannot connect to database. Sorry!");

$datetime = date("d-m-y h:i:s"); //Time Stamp

$sql = "INSERT INTO $table_name(name, email, description, datetime)VALUES('$name', '$email', '$comment', '$datetime')";
$result = mysql_query($sql);

//Check if query is successful
if($result){
	echo "Successful";
	echo "<br>";
	
// Link to view guestbook page
	echo "<a href='http://localhost:8888/ASL/CodeIgniter-3.1.3/index.php/viewguestbook'>View Guestbook</a>";

}else{
	echo "ERROR";
}
mysql_close();

?>