<?php

	session_start();

	
	$connection = new mysqli('localhost', 'root', '', 'webtechnologies');
		
	if($connection->connect_error){
		die('Connection failed: '.$connection->connect_error);
	}
	else{

		if(empty($_SESSION['username']) || empty($_SESSION['password'])){
		

			header('Location: ../login/index.html');
		

		}

		else{
			
			//admin login statement
			$login = "SELECT * FROM admin where Username = '$_SESSION[username]' AND Password = '$_SESSION[password]'";
			$result = mysqli_query($connection, $login);

			if(mysqli_num_rows($result)){
			
			}
	
			else{
				header('Location: ../login/index.html');
			}
		}

	}

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,initial-scale=1">
		<meta name="author" content="Nawshan">
		<link rel="prefetch" href="../_/logo.svg">
		<link rel="icon" href="../_/logo.svg">
		<title>Nawshan - Admin</title>
		<link rel="stylesheet" href="../style.css">
		<link rel="stylesheet" href="./style.css">
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Barlow+Semi+Condensed&display=swap" rel="stylesheet">
		
	</head>

	<body>
		<header>
			<section id="identity">
				<img src="../_/logo.svg">
				<a href="../"><h1>Nawshan</h1></a>
			</section>

			<nav>
				<a href="../#home" >Home</a>
				<a href="../#contact">Contact</a>
				<a id="main" href="../quote">Book Free Quote</a>
			</nav>
			
		</header>

		<main>
			<?php
			
			echo "<section>
			<h2>Admin</h2>
			<p>Logged in as ".$_SESSION["name"] ."</p>
			</section>";
			
			?>
			
			
			<section>
			<h2>Quotes</h2>
				
				<section class="quotes">
					<?php



						$connection = new mysqli('localhost', 'root', '', 'webtechnologies');
							
						if($connection->connect_error){
							die('Connection failed: '.$connection->connect_error);
						}
						else{

							$quoteStatement = "SELECT * FROM quote";
							$result = mysqli_query($connection, $quoteStatement);


							$date = date('Y-m-d');


							if(mysqli_num_rows($result) > 0){
								
								while($row = mysqli_fetch_assoc($result)){

									$userStatement = "SELECT * FROM user where id = '$row[User_id]'";
									$user = mysqli_query($connection, $userStatement);
									$userRow = mysqli_fetch_assoc($user);


									echo "<section class='glass-card'>
											<section>
												<p class='quote-desc'>$row[Description]</p>
											</section>
											<section class='stretcher'>
												<section>
													<h3>$userRow[firstName] $userRow[lastName]</h3>
													<p>
														<noscript>
															<a href='mailto:$userRow[Email]' title='Open in mail app'>✉️</a>
														</noscript>
														<a onclick='navigator.clipboard.writeText(`$userRow[Email]`);' hidden title='Copy to clipboard'>✉️</a>
														$userRow[Email]
													</p>
												</section>
												<form action='' method='post' class='spacing'>
													<input type='hidden' name='userid' value='$userRow[ID]'>
													<input type='hidden' name='quoteid' value='$row[ID]'>
													<section class='quote-footer'>
														<input type='date' name='date' value='$row[date]' min='$date' required title=''>
														<input type='submit' name='submit' value='Save'>
														<input type='submit' name='submit' value='Delete'>
													</section>
												</form>
											</section>
										</section>";

										


										}


									}

									
							

								}
							
					
					if(isset($_POST['submit'])){ //check if form was submitted
					
						if($_POST['submit'] == 'Delete'){
							$deleteStatement = "DELETE FROM quote WHERE ID = $_POST[quoteid];";
							$deleteStatement .= "DELETE FROM user WHERE ID = $_POST[userid]";
							$user = mysqli_multi_query($connection, $deleteStatement);
							
							echo "<script>
							window.location.href= 'index.php';
							</script>";

						}
						else if($_POST['submit'] == 'Save'){
							
							$updateQuote = "UPDATE quote SET date = '$_POST[date]' WHERE ID = $_POST[quoteid];";
							mysqli_query($connection, $updateQuote);
							

							echo "<script>
							window.location.href= 'index.php';
							</script>";
							
						}

						else if($_POST['submit'] == 'Sign out'){
							session_destroy();
							echo "<script>
							window.location.href= '../login/index.html';
							</script>";
						}
						
						
					}
					?>

					

				</section>
			</section>
		</main>

		<section class="spacer"></section>

		<footer>
			<p><small>Copyright © 2023 Nawshan. All Rights Reserved</small></p>

			<!-- sign out button -->
			<form method=post action="">
				<input class = "button" type='submit' style="margin-left: 1em;" name='submit' value='Sign out'>
			</form>


		</footer>

		
		
		
	</body>
	
	<script src="./script.js" type="text/javascript"></script>
</html>
