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
require_once('includes/htmlpurifier/HTMLPurifier.standalone.php');

?>
<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $config['misc']['sitename']; ?></title>

		<link rel="stylesheet" href="assets/css/uikit.min.css">
		<link rel="stylesheet" href="assets/css/codemirror.css">
		<link rel="stylesheet" href="assets/css/components/htmleditor.css">
		<script src="assets/js/jquery.min.js"></script>
		<script src="assets/js/uikit.min.js"></script>
		<script src="assets/js/codemirror.js"></script>
		<script src="assets/js/markdown.js"></script>
		<script src="assets/js/overlay.js"></script>
		<script src="assets/js/xml.js"></script>
		<script src="assets/js/gfm.js"></script>
		<script src="assets/js/marked.js"></script>
		<script src="assets/js/components/htmleditor.js"></script>
	</head>
	<body>
		<div class="uk-container uk-container-center uk-margin-top uk-margin-large-bottom">
			<nav class="uk-navbar uk-margin-large-bottom">
				<a class="uk-navbar-brand uk-hidden-small" href="index.php"><?php echo $config['misc']['sitename']; ?></a>
				<ul class="uk-navbar-nav uk-navbar-flip uk-hidden-small">
					<li>
						<a href="index.php">Login</a>
					</li>
				</ul>
				<div class="uk-navbar-brand uk-navbar-center uk-visible-small"><?php echo $config['misc']['sitename']; ?></div>
			</nav>

			<?php

			if (!empty($_GET['id']))
			{
				if (!empty($bug = bX_Bug::getBugById($_GET['id'])) && !empty($author = $bug->getAuthor()))
				{
					$date = new DateTime($bug->date_created);

					echo '
						<div class="uk-grid" data-uk-grid-margin>
							<div class="uk-width-medium-3-4">
								<article class="uk-article">
									<h1 class="uk-article-title">
										<a>' . $bug->title . '</a>
									</h1>

									<p class="uk-article-meta">Reported by ' . $author->firstName . ' ' . $author->lastName .  ' on ' . $date->format('d M Y') . '</p>

									<div>' . $bug->description . '</div>
								</article>
							</div>

							<div class="uk-width-medium-1-4">
								<div class="uk-panel uk-panel-box uk-text-center">
									<img class="uk-border-circle" width="120" height="120" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4NCjwhLS0gR2VuZXJhdG9yOiBBZG9iZSBJbGx1c3RyYXRvciAxNi4wLjQsIFNWRyBFeHBvcnQgUGx1Zy1JbiAuIFNWRyBWZXJzaW9uOiA2LjAwIEJ1aWxkIDApICAtLT4NCjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+DQo8c3ZnIHZlcnNpb249IjEuMSIgaWQ9IkViZW5lXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4Ig0KCSB3aWR0aD0iMTIwcHgiIGhlaWdodD0iMTIwcHgiIHZpZXdCb3g9IjAgMCAxMjAgMTIwIiBlbmFibGUtYmFja2dyb3VuZD0ibmV3IDAgMCAxMjAgMTIwIiB4bWw6c3BhY2U9InByZXNlcnZlIj4NCjxyZWN0IGZpbGw9IiNGRkZGRkYiIHdpZHRoPSIxMjAiIGhlaWdodD0iMTIwIi8+DQo8Zz4NCgk8cGF0aCBmaWxsPSIjRTBFMEUwIiBkPSJNMTA5LjM1NCw5OS40NzhjLTAuNTAyLTIuODA2LTEuMTM4LTUuNDA0LTEuOTAzLTcuODAxYy0wLjc2Ny0yLjM5Ny0xLjc5Ny00LjczMi0zLjA5My03LjAxMQ0KCQljLTEuMjk0LTIuMjc2LTIuNzc4LTQuMjE3LTQuNDU1LTUuODIzYy0xLjY4MS0xLjYwNC0zLjcyOS0yLjg4Ny02LjE0OC0zLjg0NmMtMi40MjEtMC45NTgtNS4wOTQtMS40MzgtOC4wMTctMS40MzgNCgkJYy0wLjQzMSwwLTEuNDM3LDAuNTE2LTMuMDIsMS41NDVjLTEuNTgxLDEuMDMyLTMuMzY3LDIuMTgyLTUuMzU1LDMuNDVjLTEuOTksMS4yNzEtNC41NzgsMi40MjEtNy43NjUsMy40NTENCgkJQzY2LjQxLDgzLjAzNyw2My4yMSw4My41NTIsNjAsODMuNTUyYy0zLjIxMSwwLTYuNDEtMC41MTUtOS41OTgtMS41NDZjLTMuMTg4LTEuMDMtNS43NzctMi4xODEtNy43NjUtMy40NTENCgkJYy0xLjk5MS0xLjI2OS0zLjc3NC0yLjQxOC01LjM1NS0zLjQ1Yy0xLjU4Mi0xLjAyOS0yLjU4OC0xLjU0NS0zLjAyLTEuNTQ1Yy0yLjkyNiwwLTUuNTk4LDAuNDc5LTguMDE3LDEuNDM4DQoJCWMtMi40MiwwLjk1OS00LjQ3MSwyLjI0MS02LjE0NiwzLjg0NmMtMS42ODEsMS42MDYtMy4xNjQsMy41NDctNC40NTgsNS44MjNjLTEuMjk0LDIuMjc4LTIuMzI2LDQuNjEzLTMuMDkyLDcuMDExDQoJCWMtMC43NjcsMi4zOTYtMS40MDIsNC45OTUtMS45MDYsNy44MDFjLTAuNTAyLDIuODAzLTAuODM5LDUuNDE1LTEuMDA2LDcuODM1Yy0wLjE2OCwyLjQyMS0wLjI1Miw0LjkwMi0wLjI1Miw3LjQ0DQoJCWMwLDEuODg0LDAuMjA3LDMuNjI0LDAuNTgyLDUuMjQ3aDEwMC4wNjNjMC4zNzUtMS42MjMsMC41ODItMy4zNjMsMC41ODItNS4yNDdjMC0yLjUzOC0wLjA4NC01LjAyLTAuMjUzLTcuNDQNCgkJQzExMC4xOTIsMTA0Ljg5MywxMDkuODU3LDEwMi4yOCwxMDkuMzU0LDk5LjQ3OHoiLz4NCgk8cGF0aCBmaWxsPSIjRTBFMEUwIiBkPSJNNjAsNzguMTZjNy42MiwwLDE0LjEyNi0yLjY5NiwxOS41Mi04LjA4OGM1LjM5Mi01LjM5Myw4LjA4OC0xMS44OTgsOC4wODgtMTkuNTE5DQoJCXMtMi42OTYtMTQuMTI2LTguMDg4LTE5LjUxOUM3NC4xMjYsMjUuNjQzLDY3LjYyLDIyLjk0Niw2MCwyMi45NDZzLTE0LjEyOCwyLjY5Ny0xOS41MTksOC4wODkNCgkJYy01LjM5NCw1LjM5Mi04LjA4OSwxMS44OTctOC4wODksMTkuNTE5czIuNjk1LDE0LjEyNiw4LjA4OSwxOS41MTlDNDUuODcyLDc1LjQ2NCw1Mi4zOCw3OC4xNiw2MCw3OC4xNnoiLz4NCjwvZz4NCjwvc3ZnPg0K" alt="">
									<h3>' . $author->firstName . ' ' . $author->lastName .  '</h3>
									<p>Username: <strong>' . $author->username .  '</strong></p>
								</div>
							</div>
						</div>
					';
				}
			}
			else if (isset($_GET['newbug']))
			{
				if ($user = bX_User::getUser())
				{
					echo '
						<form class="uk-form" method="post" action="bug.php">
							<div class="uk-form-row">
								<label for="desc" class="uk-form-label">Description:</label>
								<textarea data-uk-htmleditor name="desc" id="desc" required></textarea>
							</div>

							<div class="uk-form-row">
								<input class="uk-form-large" type="text" placeholder="Title" name="title" required>
							</div>

							<div class="uk-form-row">
								<div class="uk-form-controls">
									<select name="priority">
										<option>Low</option>
										<option>Medium</option>
										<option>High</option>
									</select>
								</div>
							</div>

							<div class="uk-form-row">
								<button type="submit" class="uk-button uk-button-large uk-button-primary" name="sub">Submit Bug</button>
							</div>
						</form>
					';
				}
			}
			else if (isset($_POST['sub']))
			{
				if (!empty($_POST['desc']) && !empty($_POST['title']) && !empty($_POST['priority']))
				{
					$priority = bX_Bug::LOW;

					switch ($_POST['priority'])
					{
						case 'Medium': $priority = bX_Bug::MEDIUM; break;
						case 'High': $priority = bX_Bug::HIGH; break;
					}

					if ($user = bX_User::getUser())
					{
						$purifierConfig = HTMLPurifier_Config::createDefault();

						$purifierConfig->set('CSS.AllowedProperties', []);

						$purifier = new HTMLPurifier($purifierConfig);
						$bug = new bX_Bug(htmlspecialchars($_POST['title']), $purifier->purify($_POST['desc']), $user, $priority);

						$bug->save();

						echo $bug->id;
					}
				}
			}

			?>
		</div>
	</body>
</html>