x<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">

		<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame
		Remove this if you use the .htaccess -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

		<meta name="viewport" content="width=device-width; initial-scale=1.0">

		<!-- Replace favicon.ico & apple-touch-icon.png in the root of your domain and delete these references -->
		<link rel="shortcut icon" href="/favicon.ico">
		<link rel="apple-touch-icon" href="/apple-touch-icon.png">
	</head>
	<body>
		<h1>Application Search pannel</h1>
		
		<form action="app_handle.php" class="" method="post">
			<table width="345" height="110" border="1" cellpadding="5" cellspacing="5">
				<tr>
					<td>Name</td>
					<td width="200">&nbsp;<input type="text" name="name"/> </td>
				</tr>
				<tr>
					<td>NIC</td>
					<td>&nbsp;<input type="text" name="nic" required/> </td>
				</tr>
			</table>
			<input type="submit" value="Search" />
			<input type="reset" value="clear" />
		</form>
	</body>
</html>


<?php
    //phpinfo();
    
    
    
    
?>