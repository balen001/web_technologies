<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,initial-scale=1">
		<meta name="author" content="Nawshan">
		<meta name="description" content="TODO">
		<meta name="keywords" content="TODO">
		<link rel="prefetch" href="../_/logo.svg">
		<link rel="icon" href="../_/logo.svg">
		<title>Nawshan - Book Quote</title>
		<link rel="stylesheet" href="../style.css">
		<link rel="stylesheet" href="./sweetalert2.min.css">
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
				<a href="../#home">Home</a>
				<a href="../#contact">Contact</a>
				<a id="main" href="./">Book Free Quote</a>
			</nav>
		</header>

		<main>
			<section class="centered">
				<h2>Book a quote</h2>
				<form action= "" method="post">
					<label>
						Email Address<span class="highlight">*</span><br>
						<input type="email" placeholder="name@domain.com" name="email" required title="">
					</label>
					
					<label>
						First name<span class="highlight">*</span><br>
						<input type="text" name="fname" required pattern="(.|\s)*\S(.|\s)*" title="">
					</label>
					
					<label>
						Last name<span class="highlight">*</span><br>
						<input type="text" name="lname" required pattern="(.|\s)*\S(.|\s)*" title="">
					</label>
					
					<label>
						Date<span class="highlight">*</span><br>
						<input type="date" name="date" required title="">
					</label>
					
					<label>
						Description<br>
						<textarea name="desc" title="" rows="3" cols="30"></textarea>
					</label>
					
					<p><small><span class="highlight">*</span> Required</small></p>
					
					<input type="submit" value="Book" name="submit">
				</form>
			</section>
		</main>

		<section class="spacer"></section>

		<footer>
			<p><small>Copyright © 2023 Nawshan. All Rights Reserved</small></p>
		</footer>
	</body>
	
	<script src="./script.js" type="text/javascript"></script>
	<script src="./sweetalert2.min.js" type="text/javascript"></script>
	

	<script>
	if ( window.history.replaceState ) {
  			window.history.replaceState( null, null, window.location.href );
	}
	</script>
	




	





<?php

	$message = '';
	$icon = '';

    if(isset($_POST['submit'])){
    $firstName = $_POST['fname'];
    $lastName = $_POST['lname'];
    $email = $_POST['email'];
    $date = $_POST['date'];
    $desc = $_POST['desc'];




    //database connection

    $connection = new mysqli('localhost', 'root', '', 'webtechnologies');
    
    if($connection->connect_error){

		$message = 'Connection failed';
		$icon = 'error';
		
        die('Connection failed: '.$connection->connect_error);
    }
    else{


        


        //insert user statement
        $insertUser = "INSERT INTO user (Email,firstName,lastName) VALUES ('$email' ,'$firstName', '$lastName')";
        

        if (mysqli_query($connection, $insertUser)) {
            $last_id = $connection->insert_id;

            //insert quote statement
            $insertQuote = "INSERT INTO quote (date,LastUpdated,User_id, Description) VALUES ('$date', '$date', '$last_id', '$desc')";
            if(mysqli_query($connection, $insertQuote)){
				$icon = 'success';
                $message = 'Quote sent successfully';
            }
            else{
				$icon = 'error';
                $message = 'Failed to send the quote'.mysqli_error($connection);
            }

          } else {
			$icon = 'error';
			$message = 'Failed to send the quote'.mysqli_error($connection);
            
          }
          


          

        
        

       
    }


    mysqli_close($connection);
    

	echo "<script type='text/javascript'>
				Swal.fire({
					position: 'center',
					icon: '$icon',
					title: '$message',
					showConfirmButton: false,
					timer: 1500
				});
			</script>";
	

	
}





?>
	



</html>
