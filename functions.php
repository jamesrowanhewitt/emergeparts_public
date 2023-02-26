<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}

function pdo_connect_mysql() {
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'nodexlin_db_main';
    try {
    	return new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
    } catch (PDOException $exception) {
    	// If there is an error with the connection, stop the script and display the error.
    	exit('Failed to connect to database!');
    }
}


function template_header($title) {
echo <<<EOT

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>$title</title>
             <!-- Link rel -->
        <link rel="icon" href="favicon.ico">

        
            <!-- Required meta tags -->
	    <meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	
	    <!-- The page supports both dark and light color schemes,
	         and the page author prefers / default is light. -->
	    <meta name="color-scheme" content="light dark">
	
	    <!-- Replace the Bootstrap CSS with the
	         Bootstrap-Dark Variant CSS -->
	    <link href="https://cdn.jsdelivr.net/npm/bootstrap-dark-5@1.1.3/dist/css/bootstrap-dark.min.css" rel="stylesheet">
	
	    <!-- Optional Meta Theme Color is also supported on Safari and Chrome -->
	    <meta name="theme-color" content="#111111" media="(prefers-color-scheme: light)">
	    <meta name="theme-color" content="#eeeeee" media="(prefers-color-scheme: dark)">
	    
	</head>
	<body>
    
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        
        <a class="navbar-brand" href="home.php">&nbsp&nbspEmergeParts</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarScroll">
        <ul class="navbar-nav mr-auto my-2 my-lg-0 navbar-nav-scroll" style="max-height: 100px;">
            <li class="nav-item">
            <a href="home.php" class="btn btn-primary">Search</a>
            </li>
            <li class="nav-item">
                <a class="btn btn-success" href="create.php">Add part</a>
            </li>
            <li class="nav-item">
            <a class="btn btn-info" href="profile.php">Profile</a>
            </li>
            <li class="nav-item">
            <a class="btn btn-warning" href="csv-handler.php">Download All Parts CSV</a>
            </li>
            <li class="nav-item">
            <a class="btn btn-danger" href="logout.php">Logout</a>
            </li>
        </ul>
        
        </div>
    </nav>
    <div class="container">
EOT;
}
function template_footer() {
echo <<<EOT
    </div>
    </body>
    <br><br><br><br><br><br>

    <footer>
    <div class="card container">
    <div class="card-body">
    

      <!-- Copyright -->

        © 2022 Copyright:
        <a href="https://nodex.link/">Nodex.Link</a>
        <p>Developed by Jimmy for fun during a well lived coronavirus quarantine</p>
        <a class="btn btn-secondary" href="disclaimer.php">Disclaimer</a>
     
      <!-- Copyright -->
      
    </div>
    </div>
    </footer>
    <!-- bootstrap cdn -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    

</html>
EOT;
}
?>