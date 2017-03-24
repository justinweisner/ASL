<table width="400" border="0" align="center" cellpadding="3" cellspacing="0">
	<tr>
		<td>
			<strong>View Guestbook | <a href="<?php echo base_url('index.php/guestbook') ?>">Sign Guestbook</a></strong>
		</td>
	</tr>
</table>
<br>


<?php 
$host = "localhost"; 
$username = "root";
$password = "root";
$db_name = "guestbook";
$table_name = "Nick_Guestbook";

//Connect to the server & database.

mysql_connect("$host", "$username", "$password") or die("Cannot connect to server. Sorry!");
mysql_select_db("$db_name") or die("Cannot connect to database. Sorry!");
$sql = "SELECT * FROM $table_name";
$result = mysql_query($sql);
while ($rows = mysql_fetch_array($result)){
?>

<table width="400" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#cccccc">
	<tr>
		<td>
			<table width="400" border="0" cellpadding="3" cellspacing="1" bgcolor="#ffffff">
				<tr>
					<td>#: </td>
					<td><? echo $rows['id']; ?></td>
				</tr>
				<tr>
					<td>Name: </td>
					<td><? echo $rows['name']; ?></td>
				</tr>
				<tr>
					<td>Email: </td>
					<td><? echo $rows['email']; ?></td>
				</tr>
				<tr>
					<td>Comment: </td>
					<td><? echo $rows['description']; ?></td>
				</tr>
				<tr>
					<td>Date: </td>
					<td><? echo $rows['datetime']; ?></td>
				</tr>
			</table>
		</td>
	</tr>
</table>

<?php	
}
mysql_close(); //Close Database connection
?>
