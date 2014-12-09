<?php
if((isset($_SESSION['login']))&&($_SESSION['login']==true))
{
echo "
<body>
<nav class=\"navbar navbar-default navbar-fixed-top\" role=\"navigation\"
		id=\"nav_bar\">
		<div class=\"container\">
			<div class=\"navbar-header\" id=\"navbar_header\">
				<button type=\"button\" class=\"navbar-toggle collapsed\"
					data-toggle=\"collapse\" data-target=\"#navbar\" aria-expanded=\"false\"
					aria-controls=\"navbar\">
					<span class=\"sr-only\">Toggle navigation</span> <span
						class=\"icon-bar\"></span> <span class=\"icon-bar\"></span> <span
						class=\"icon-bar\"></span>
				</button>
				<a class=\"navbar-brand\" href=\"../pages/index.php\">Answer</a>
			</div>
			<div id=\"navbar\" class=\"navbar-collapse collapse\">
				<ul class=\"nav navbar-nav\">
					<li><form class=\"navbar-form \" action=\"search.php\" method=\"post\">
							<input type=\"search\" class=\"form-control\" placeholder=\"Search...\" name=\"search_input\"></input>
							<button type=\"submit\" class=\"btn btn-primary\">Search</button>
						</form></li>
					<li><a href=\"../pages/index.php\">Home</a></li>
					<li><a href=\"../pages/article.php\">Article</a></li>
					<li class=\"dropdown\"><a href=\"#\" class=\"dropdown-toggle\"
						data-toggle=\"dropdown\">Settings <span class=\"caret\"></span></a>
						<ul class=\"dropdown-menu\" role=\"menu\">
							<li><a href=\"../pages/profile.php\">Profile</a></li>
							<li><a href=\"#\">Another action</a></li>
							<li><a href=\"#\">Something else here</a></li>
							<li class=\"divider\"></li>
							<li class=\"dropdown-header\">Nav header</li>
							<li><a href=\"#\">Separated link</a></li>
							<li><a href=\"#\">One more separated link</a></li>
						</ul></li>
				</ul>
				<ul class=\"nav navbar-nav navbar-right\">
					<li><button class=\"btn btn-primary\">".$_SESSION['Name']."</button></li>
					<li><button class=\"btn btn-primary\" id=\"logout_button\">Log Out</button></li>
					<li><button class=\"btn btn-primary\" id=\"post_button\" onclick=\"Jump_question()\">
					<span class=\"glyphicon glyphicon-question-sign\" aria-hidden=\"true\"></span>
					Add Questions</button>
				</ul>
			</div>
			<!--/.nav-collapse -->
		</div>
	</nav>
";

}
else
{
echo "
<!DOCTYPE html>
<html lang=\"en\">
<head>
<meta charset=\"utf-8\">
<meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
<meta name=\"description\" content=\"\">
<meta name=\"author\" content=\"\">
<title>Index of Answer</title>

<link href=\"http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css\" rel=\"stylesheet\">
<link href=\"../css/bootstrap.min.css\" rel=\"stylesheet\">
<link href=\"../css/index_site.css\" rel=\"stylesheet\">

</head>
<body>
<nav class=\"navbar navbar-default navbar-fixed-top\" role=\"navigation\"
		id=\"nav_bar\">
		<div class=\"container\">
			<div class=\"navbar-header\" id=\"navbar_header\">
				<button type=\"button\" class=\"navbar-toggle collapsed\"
					data-toggle=\"collapse\" data-target=\"#navbar\" aria-expanded=\"false\"
					aria-controls=\"navbar\">
					<span class=\"sr-only\">Toggle navigation</span> <span
						class=\"icon-bar\"></span> <span class=\"icon-bar\"></span> <span
						class=\"icon-bar\"></span>
				</button>
				<a class=\"navbar-brand\" href=\"../pages/index.php\">Answer</a>
			</div>
			<div id=\"navbar\" class=\"navbar-collapse collapse\">
				<ul class=\"nav navbar-nav\">
					<li><form class=\"navbar-form \">
							<input type=\"text\" class=\"form-control\" placeholder=\"Search...\">
							<button type=\"submit\" class=\"btn btn-primary\">Search</button>
						</form></li>
					<li><a href=\"../pages/index.php\">Home</a></li>
					<li><a href=\"../pages/article.php\">Article</a></li>
					<li class=\"dropdown\"><a href=\"#\" class=\"dropdown-toggle\"
						data-toggle=\"dropdown\">Settings <span class=\"caret\"></span></a>
						<ul class=\"dropdown-menu\" role=\"menu\">
							<li><a href=\"../pages/profile.php\">Profile</a></li>
							<li><a href=\"#\">Another action</a></li>
							<li><a href=\"#\">Something else here</a></li>
							<li class=\"divider\"></li>
							<li class=\"dropdown-header\">Nav header</li>
							<li><a href=\"#\">Separated link</a></li>
							<li><a href=\"#\">One more separated link</a></li>
						</ul></li>
				</ul>
				<ul class=\"nav navbar-nav navbar-right\">
					<li><button class=\"btn btn-primary\" id=\"login_button\">Login</button></li>					
					<li><button class=\"btn btn-primary\" id=\"signup_button\">Sign Up</button></li>
				</ul>
			</div>
			<!--/.nav-collapse -->
		</div>
	</nav>

";
}
?>
