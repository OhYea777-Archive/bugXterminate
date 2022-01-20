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


//$db->executeQuery("INSERT INTO `users` (`firstname`, `lastname`, `username`, `password`, `level`) VALUES(?,?,?,?,?)", ['jack', 'taylor', 'jtaylor', 'passtemp', '0']);

$one = @$_POST['unem'];
$two = @$_POST['pass'];

$first1 = @$_POST['first'];
$last1 = @$_POST['last'];
$user1 = @$_POST['user'];
$pass1 = @$_POST['pass'];
$email1 = @$_POST['email'];
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $config['misc']['sitename']; ?></title>
</head>
<body>
<h4><?php echo $config['misc']['sitemotto']; ?></h4>

<?php
if (@isset($_POST['sub']))
{
	bX_User::LoginUser($one, $two);
}

if (@isset($_POST['reg']))
{
	if (isset($first1) && isset($last1) && isset($user1) && isset($email1))
	{
		bX_User::RegisterUser($first1, $last1, $user1, $pass1, $email1);
	}
}

if ($user = bX_User::getUser())
{
	$user->createMenu();
}
else
{
	echo '<form name="login" method="POST">
Username or Email: <input type="text" name="unem" /><br />
Password: <input type="password" name="pass" /><br />
<button type="submit" name="sub">Login</button>
</form>
<br /><br /><br /><br /><br /><br />
<form name="register" method="POST">
Firstname: <input type="text" name="first" /><br />
Lastname: <input type="text" name="last" /><br />
Username: <input type="text" name="user" /><br />
' . ($config['security']['emailvalidation'] ? "" : 'Password: <input type="password" name="pass" /><br />') . '
Email: <input type="email" name="email" /><br />
<button type="submit" name="reg">Register</button>
</form>';
}

?>

</body>
</html>
