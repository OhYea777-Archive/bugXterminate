<link rel="stylesheet" href="assets/css/uikit.min.css" />
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/uikit.min.js"></script>

<!-- Codemirror and marked dependencies -->
<link rel="stylesheet" href="assets/css/codemirror.css">
<script src="assets/js/codemirror.js"></script>
<script src="assets/js/markdown.js"></script>
<script src="assets/js/overlay.js"></script>
<script src="assets/js/xml.js"></script>
<script src="assets/js/gfm.js"></script>
<script src="assets/js/marked.js"></script>

<!-- HTML editor CSS and JavaScript -->
<link rel="stylesheet" href="assets/css/components/htmleditor.css">
<script src="assets/js/components/htmleditor.js"></script>

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

error_reporting(-1);

if ($user = bX_User::getUserByID(2))
{
    echo '<textarea data-uk-htmleditor>...</textarea>';
}
else if ($user = bX_User::getUser())
{
    if (isset($_GET['logout']))
    {
        $user->ProcessUserLogout();
    }
}
else if (isset($_POST['sub']))
{
    if ($user = bX_User::LoginUser(@$_POST['unem'], @$_POST['pass']))
    {
        echo 'Logged in!<br>';
    }
    else
    {
        echo 'Invalid login!<br>';
    }
}
else if (isset($_GET['pass']))
{
    echo bX_Utils::HashPassword($_GET['pass']) . '<br>' . date($config['misc']['dateformat']) . '<br>';
}
else
{

?>

<form name="login" method="POST">
    Username or Email: <input type="text" name="unem" /><br />
    Password: <input type="password" name="pass" /><br />
    <button type="submit" name="sub">Login</button>
</form>

<br /><br /><br /><br /><br /><br />

<form name="register" method="POST">
    Firstname: <input type="text" name="first" /><br />
    Lastname: <input type="text" name="last" /><br />
    Username: <input type="text" name="user" /><br />
    <?php echo($config['security']['emailvalidation'] ? "" : 'Password: <input type="password" name="pass" /><br />'); ?>
    Email: <input type="email" name="email" /><br />
    <button type="submit" name="reg">Register</button>
</form>

<?php } ?>