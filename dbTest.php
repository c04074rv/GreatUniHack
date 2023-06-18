<?php$
testMsgs = true;  // true = On, false = Off.
$servername ="localhost";
$username   = "root";
$password   = "root";
$database   = "test";
$conn = mysqli_connect($servername, $username, $password, $database);
	
	if(!$conn)
		{die("Connection failed: " . mysqli_connect_error());}
	echo ("Connected successfully");
	$sql = "CREATE DATABASE test";
	doSQL($conn, $sql, $testMsgs);
	
	$sql = "
	CREATE TABLE user(
		userId INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		forename VARCHAR(30) NOT NULL,
		surname  VARCHAR(30) NOT NULL,
		email    VARCHAR(30) NOT NULL,
		password VARCHAR(128)NOT NULL)";
	
	doSQL($conn, $sql, $testMsgs);
	$sql = "INSERT INTO user (forename, surname, email, password)
			VALUES ('James', 'Kirk', 'kirk.j@sf.com', 'enterprise')  ";

	doSQL($conn, $sql, $testMsgs);
	$sql = "INSERT INTO user (forename, surname, email, password)
			VALUES ('Kathryn', 'Janeway', 'janeway.k@sf.com', 'voyager')  ";

	doSQL($conn, $sql, $testMsgs); 
	 $sql = "SELECT * FROM user";
	 $records = doSQL($conn, $sql, $testMsgs);
	 $output = "<table border='2'>
	 <th>User ID</th>
	 <th>Forename</th>
	 <th>Surname</th>
	 <th>Email</th>
	 <th>Password</th>";
	while ($row = $records->fetch_assoc())
		{$output .= "<tr><td>$row[userId]</td>
	<td>$row[forename]</td>
	<td>$row[surname]</td>
	<td>$row[email]</td>
	<td>$row[password]</td>
	</tr>";}
	$output .= "</table>";
	echo ($output);
	function doSQL($conn, $sql, $testMsgs)
		{if ($testMsgs)
		{echo ("<br><code>SQL: $sql</code>");
		 if ($result = $conn->query($sql))echo ("<code> -OK</code>");
		 else echo ("<code> -FAIL! " . $conn->error . " </code>");}
		 else $result = $conn->query($sql);
		 return $result;  }
?>
