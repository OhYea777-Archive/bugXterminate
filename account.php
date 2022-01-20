<?php
/**
 * bugXterminate
 *
 * bugXterminate is developed by Daxalon and is a free open source software licensed under the Apache 2.0 license.
 *
 * www.bugxterminate.com
 * www.daxalon.com
 *
 * 
 *  Copyright 2015 Daxalon
 *
 *  Licensed under the Apache License, Version 2.0 (the "License");
 *  you may not use this file except in compliance with the License.
 *  You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 *  Unless required by applicable law or agreed to in writing, software
 *  distributed under the License is distributed on an "AS IS" BASIS,
 *  WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 *  See the License for the specific language governing permissions and
 *  limitations under the License.
 */

require_once('includes/global.php');


?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $config['misc']['sitename']; ?></title>
</head>
<body>
<h4><?php echo $config['misc']['sitemotto']; ?></h4>
<?php


if ($user = bX_User::getUser())
{
	$user->createMenu();
}	
else
{
	echo 'You\'re not logged in!';
}


if (@isset($_GET['confirmcode']) && $db->fetchQuery('useractivations', 'token', $_GET['confirmcode'], 'uniqueid'))
{
	echo '
<form name="confirm" method="POST">
Password: <input type="password" name="pass1" /><br />
Confirm Password: <input type="password" name="pass2" /><br />
<button type="submit" name="conf">Update password!</button>
</form>';

	
	$pass1 = @$_POST['pass1'];
	$pass2 = @$_POST['pass2'];

	if (@isset($_POST['conf']))
	{
		bX_User::VerifyUserAccount(@$_GET['confirmcode'], $pass1, $pass2);
	}
}
else if (@isset($_GET['logout']) && $user->ValidateCSRF())
{
	$user->ProcessUserLogout();
	header('Location: ' . $_SERVER['PHP_SELF']);
}

?>

</body>
</html>