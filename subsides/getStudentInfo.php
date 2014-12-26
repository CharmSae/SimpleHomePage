<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
	</head>
<body>
<?php

require_once('./mysqli_connector.php');

$query = "SELECT id, name, email, phone, birth_date FROM students";

$response = @mysqli_query($dbc, $query);

if($response){

	echo '<table valign = "top" cellspacing="5" cellpadding="8"

		<tr><td align="left"><b>id</b></td>
			<td align="left"><b>name</b></td>
			<td align="left"><b>email</b></td>
			<td align="left"><b>phone</b></td>
			<td align="left"><b>birth_date</b></td></tr>';

		while($row = mysqli_fetch_array($response)){

			echo '<tr><td align = "left">'.
			$row['id']. '</td><td align="left">'.
			$row['name']. '</td><td align="left">'.
			$row['email']. '</td><td align="left">'.
			$row['phone']. '</td><td align="left">'.
			$row['birth_date']. '</td><td align="left">';

			echo '</tr>';
		}

		echo '</table>';

} else {

	echo "Couldn't issue database query ";

	echo mysqli_error($dbc);
}

mysqli_close($dbc);

?>
	<hr>
	<a href="http://subsides.hostei.com/index.php">메인화면</a>
</body>
</html>
