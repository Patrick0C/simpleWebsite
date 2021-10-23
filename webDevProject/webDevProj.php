<!doctype html>

  <?php
	// Begins the php session when the page is opened	
	session_start();
		
	// Connecting to the database
	$dbhost = "localhost";
	$dbuser = "root";
	$dbpassword = "";
	$dbname = "g00398246";
	
	$connection = mysqli_connect($dbhost,$dbuser,$dbpassword,$dbname);
		
	//Test if connection occoured
	if(mysqli_connect_errno()){
		die("DB connection failed: " .
			mysqli_connect_error() .
				" (" . mysqli_connect_errno() . ")"
				);
	}

	if (!$connection)
		{
			die('Could not connect: ' . mysqli_error());
		}
	?>

<html lang="en">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">


		<!-- Code taken from https://getbootstrap.com/docs/4.0/getting-started/introduction/ as part of the "Starter template" -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">

		<title>Chance & Counters</title>
	
		<style>
			
			/* Cystom styling for login buttons on the homepage and in the modal */
			/* Main components include a blue background with white text with rounded edges */
			.login {
				padding:0.3em 1.2em;
				margin:0 0.3em 0.3em 0;
				border-radius:2em;
				box-sizing: border-box;
				text-decoration:none;
				font-family:'Roboto',sans-serif;
				font-weight:300;
				color:#FFFFFF;
				background-color:#0dcaf0;
				text-align:center;
				transition: all 0.2s;
				position:relative;
			}
			
			/* Custom styling for the logout button on the homepage*/
			/* This button is identical to the "login" button except for two differences*/
			/* By default this class will not appear until the Display class is changed and the background colour is red */
			.logout{ padding:0.3em 1.2em;
				margin:0 0.3em 0.3em 0;
				border-radius:2em;
				box-sizing: border-box;
				text-decoration:none;
				font-family:'Roboto',sans-serif;
				font-weight:300;
				color:#FFFFFF;
				display: none;	
				text-align:center;
				transition: all 0.2s;
				position:relative;
			}
			
			
			/* Styling for the shoppong trolley icon*/
			/* the default size has been increased */
			.glyphicon {
				font-size: 50px;
			}
			
			
			/* The close modal button */
			/* Similar again to the "logout" class, this element however will display fully by default within the modal */
			#closeModal {
				padding:0.3em 1.2em;
				margin:0 0.3em 0.3em 0;
				border-radius:2em;
				box-sizing: border-box;
				text-decoration:none;
				font-family:'Roboto',sans-serif;
				font-weight:300;
				text-align:center;
				transition: all 0.2s;
				position:relative;
			}
			
			
			/* Styling for the "X" close button */
			/* This button has been styled to appear at the right side of the modal and to appear black in colour and larger than the default of "&times" */	
			#closeX {
				color: #aaaaaa;
				float: right;
				font-size: 28px;
				font-weight: bold;
			}


			/* Styling for the modal background */
			/* This modal style was taken from https://www.w3schools.com/howto/howto_css_modals.asp */
			.modal {
				display: none; /* Hidden by default */
				position: fixed; /* Stay in place */
				z-index: 1; /* Sit on top */
				padding-top: 100px; /* Location of the box */
				left: 0;
				top: 0;
				width: 100%; /* Full width */
				height: 100%; /* Full height */
				overflow: auto; /* Enable scroll if needed */
				background-color: rgb(0,0,0); /* Fallback color */
				background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
			}


			/* The modal content */
			.modal-content {
				background-color: #fefefe;
				margin: auto;
				padding: 20px;
				border: 1px solid #888;
				width: 80%;
			}
			/* End of code block */
			

			/* Custom styling for the jumbotron */
			/* This jumbotron has been styled with a grey background, centered text and with rounded corners */
			.jumbotron {
				background: center;
				background-size: cover;
				background-color: #D3D3D3;
				text-align: center;
				border-radius: 5px;	
			}
			
			/* Styling for the random button */
			/* This button the same values as "login" */ 
			#randomBtn {
				padding:0.3em 1.2em;
				margin:0 0.3em 0.3em 0;
				border-radius:2em;
				box-sizing: border-box;
				text-decoration:none;
				font-family:'Roboto',sans-serif;
				font-weight:300;
				color:#FFFFFF;
				background-color:#0dcaf0;
				text-align:center;
				transition: all 0.2s;
				width: 20%;
				position:relative;
			}
			
			/*Custom styyling for the images within the carousel */
			/* Their proportions have been altered to better suit the quality of all images included */
			.carousel-inner > .carousel-item > img {
				width:80%; height:450px; 
			} 
			
			
			/* The styling for all other images */
			/* These images have a slight border, with a width large enough to present the item but not enough to dominate the page entirely */
			#productImg {
				border: 1px solid #ddd;
				border-radius: 4px;
				padding: 5px;
				width: 250px;
				}
			
			/*Styling for the checkout table */
			/* This table is hidden by default and will only appear when a user is logged in */
			#checkoutTable{
				visibility: hidden;
			}
			
			/*Styling for the checout button */
			/* The button confirming purchase of items is hidden by default and will only appear when a user is logged in */
			#checkoutBtn {
				visibility:	hidden;
			}

		</style>
		
	</head>
		
	<!-- When the webpage is loaded/ refreshed, this function uses sessionStorage data to store that a user has logged in and will display the order summary and checkout button -->
	<body onload="refresh()">
	
		<!-- Simple navigation bar -->
		<!-- Navbar includes an image of the store logo with text and a login button -->
		<!-- sticky-top class has been added to keep this bar on the top of the screen regardless of scrolling -->
		<!-- Navbar background and theme set to dark to add contrast to the white image -->
		<nav class="navbar sticky-top navbar-expand-sm navbar-dark bg-dark">
			<div class="container-fluid">
			
				<!-- The image and text in the nav bar use an anchor tag which returns the user to the top of the current page -->
				<a class="navbar-brand" href="#top">
				<img src="images/storeLogo.jpg" alt="" width="60" height="60" class="d-inline-block align-text-top" id="navImg">
				Chance & Counters
				</a>
							
				<!-- These items in the navbar are stored in the far right -->
				<div class="navbar-nav ml-auto">
				
					<!-- This anchor element displays an icon of a shopping trolly and once clicked will scroll the user down to the order summary -->
					<a href="#checkoutTable">
						<span class="glyphicon">&#x1f6d2;</span> 
					</a>
					
					<!-- This button opens a modal allowing a user to login and then have the order summary and checkout button displayed -->
					<!-- This button appears exclusively from the "logout" button -->
					<button type="button" class="login" id="loginBtn" onClick="openModal()">Login</button>	
					
					<!-- This button will log a user out, hiding the order summary and checkout button preventing them from making any purchases -->
					<!-- This button appears exclusively from the "login" button -->
					<button type="button" class="logout  btn-danger" id="logoutBtn" onClick="logout()">Logout</button>	
				</div>
			</div>
		</nav>
		
		<!-- The following code block was taken from https://getbootstrap.com/docs/4.0/components/carousel/ -->
		<!-- Webpage carousel displaying upcoming games -->
		<div class="carousel slide" id="carouselCaptions" data-bs-ride="carousel">
		
			<!-- The carousel indicators allow a user to click on a button to view its corrosponding image -->
			<!-- The "active" class displays this image first -->
			<div class="carousel-indicators">
			<button type="button" data-bs-target="#carouselCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
			<button type="button" data-bs-target="#carouselCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
			<button type="button" data-bs-target="#carouselCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
			</div>
		  
		  <!-- Within this div are all of the images and related text which are displayed in the carousel -->
		<div class="carousel-inner">
			<div class="carousel-item active" >
			  <img src="images/setAWatch.png" class="d-block mx-auto" alt="Set a Watch">
			  <div class="carousel-caption d-none d-md-block">
				<h5>Set a Watch</h5>
				<p>The Kingdom is in grave danger. Powerful enemies are conspiring to resurrect the vile and powerful Unhallowed that your party has just slain.</p>
				<p>Set a Watch is a co-operative gane for 1-4 players.</p>
				<p> In-store from 30/07/2021 </p>
			  </div>
			</div>
				
			<div class="carousel-item">
			  <img src="images/theCrew.jpg" class="d-block mx-auto" alt="The Crew">
			  <div class="carousel-caption d-none d-md-block">
				<h5>The Crew: The Quest For Planet Nine</h5>
				<p>Winner of the 2020 Kennerspiel des Jahres,</p>
				<p>The Crew sets the players out as astronauts on an uncertain space adventure as a co-operative experience for 2-5 players.</p>
				<p>In-store from 05/08/2021 </p>
			  </div>
			</div>
				
			<div class="carousel-item">
			  <img src="images/ticketTR.jpg" class="d-block mx-auto" alt="Ticket To Ride: Europe">
			  <div class="carousel-caption d-none d-md-block">
				<h5>Ticket To Ride: Europe</h5>
				<p>Build train routes across Europe in this sequel to the hit family board game.</p>
				<p>In-store from 10/08/2021</p>
			  </div>
			</div>
		  </div>
			  
		<!-- The following buttons allow a user to click on either side of the carousel to move to the next or previous image in the carousel -->
		  <button class="carousel-control-prev" type="button" data-bs-target="#carouselCaptions" data-bs-slide="prev">
			<span class="carousel-control-prev-icon" aria-hidden="true"></span>
			<span class="visually-hidden">Previous</span>
		  </button>
			  
		  <button class="carousel-control-next" type="button" data-bs-target="#carouselCaptions" data-bs-slide="next">
			<span class="carousel-control-next-icon" aria-hidden="true"></span>
			<span class="visually-hidden">Next</span>
		  </button>
		</div>
		<!-- End of code block -->
		
		
		<?php
		// php block code taken from https://www.webslesson.info/2016/08/simple-php-mysql-shopping-cart.html
		// unsure as to working of this code
		if(isset($_POST["add_to_cart"])){
			if(isset($_SESSION["shopping_cart"])){
				$item_array_id = array_column($_SESSION["shopping_cart"], "item_id");
				if(!in_array($_GET["id"], $item_array_id)){
					$count = count($_SESSION["shopping_cart"]);
					$item_array = array(
						 'item_id' => $_GET["id"],
						 'item_name' => $_POST["hidden_name"],
						 'item_price' => $_POST["hidden_price"],
						 'item_quantity' => $_POST["quantity"]
						 );
					$_SESSION["shopping_cart"][$count] = $item_array;
				} 
			}else{
				$item_array = array(
					 'item_id' => $_GET["id"],
					 'item_name' => $_POST["hidden_name"],
					 'item_price' => $_POST["hidden_price"],
					 'item_quantity' => $_POST["quantity"]
					 );
				$_SESSION["shopping_cart"][0] = $item_array;
			}
		}
 
		if(isset($_GET["action"])){
			if($_GET["action"] == "delete"){
				foreach($_SESSION["shopping_cart"] as $keys => $values){
					if($values["item_id"] == $_GET["id"]){
						unset($_SESSION["shopping_cart"][$keys]);
						echo '<script>window.location="webDevProj.php"</script>';
					}
				}
			}
		}
		
		
		//Perform a database query which retrieves all stroed information from the products table
		$query = mysqli_query($connection,"SELECT * FROM products");
		
		?>
		
		<!-- This container class houses all of the returned data from the php query and displays them with a simple border 
		and with an add to cart button attached to each row -->
		<div class="container">
		
		<?php
		$query = "SELECT * FROM products ORDER BY id ASC";
		$query = mysqli_query($connection, $query);
		if(mysqli_num_rows($query) > 0) {
			while($row = mysqli_fetch_array($query)){
				?>
					
					<div class="row">
					
						<!-- This div class is part of Bootstrap's grid system. This class creates a medium width grid spanning across 12 columns -->
						<div class="col-md-12">
						<form method="post" action="webDevProj.php?action=add&id=<?php echo $row["id"]; ?>">
							<div class="row">
								<div class="col-lg-12">
									<div style="border:3px solid #5cb85c; background-color:whitesmoke; border-radius:5px; padding:14px;" align="center">
										<img src="images/<?php echo $row["img"]; ?>" class="img-responsive" id= "productImg"><br />
										
										<h4 class="text-info store"><?php echo $row["name"]; ?></h4>
						 
										<h4 class="text-danger store"> € <?php echo $row["price"]; ?></h4>
										
										<h4 class="text-info store"><?php echo $row["desc"]; ?></h4>
							 
										<input type="text" name="quantity" value="1" class="form-control" />
							 
										<input type="hidden" name="hidden_name" value="<?php echo $row["name"]; ?>" />
							 
										<input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>" />
							 
										<input type="submit" class="btn btn-success" name="add_to_cart" style="margin-top:5px;" value="Add to Cart"/>
											
									</div>
								</div>
							</div>
						</form>		
						</div>
					</div>
				
		<?php
			}
		}
		?>
		</div>
		
		<!-- This div contains a jumbotron displaying text and a button which a user can interact with to change the default text of the jumbotron to disply a random game selected from an array -->
		<div class="container justify">
			<div class="jumbotron">
			<h1>Game suggestion!</h1>

			<!-- This ID is used in order to change the default text using a DOM javascript function -->
			<div id="jumboText">			
				<p>Not sure what to buy? Let us choose for you</p>
				<p>Simply click the suggestion button and we'll do the rest!</p>
			</div>
			
			<!-- This ID is used to style the button. The function below is executed when a user clicks on this button -->
			<button type="button" id="randomBtn" onClick="gameSuggestion()">Try me!</button>
			</div>
		</div>
		
		<!-- Checkout table displaying order details -->
		<!-- This ID is used in order to hide the table before a user has successfully logged in -->
		<div id="checkoutTable">
			<div style="clear:both"></div>
			<br />
			<h3>Order Details</h3>
			
			<!-- This class creates a table which has a simple border and which will also adjust according to the size of the window. -->
			<table class="table table-bordered table-responsive">
			<!--<div class="table-responsive"> -->
				<tr>
					 <th width="40%">Item Name</th>
					 <th width="10%">Quantity</th>
					 <th width="20%">Price</th>
					 <th width="15%">Total</th>
					 <th width="5%">Action</th>
				</tr>
			
				<?php
				//This php code checks if any items were added to the cart and if so the item name, quantity ordered, item price and total price are displayed.
				//A "remove" option is also included which will delete the selected item from the cart
				if(!empty($_SESSION["shopping_cart"])){
				$total = 0;
				foreach($_SESSION["shopping_cart"] as $keys => $values){
				?>
				<tr>
					 <td><?php echo $values["item_name"]; ?></td>
					 <td><?php echo $values["item_quantity"]; ?></td>
					 <td>€ <?php echo $values["item_price"]; ?></td>
					 <td>€ <?php echo number_format($values["item_quantity"] * $values["item_price"], 2);?></td>
					 <td><a href="webDevProj.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span class="text-danger">Remove</span></a></td>
				</tr>
				<?php
				$total = $total + ($values["item_quantity"] * $values["item_price"]);
				}
				?>
				<tr>
					<td colspan="3" align="right">Total</td>
					<td align="right">€ <?php echo number_format($total, 2); ?></td>
					<td></td>
				</tr>

				<?php
				}
				?>
			</table>
			
			<!-- This code allows a user to purchase their items by clicking a checkout button.
			The ID used allows this button to appear once a user has logged in -->
			<div class="row justify-content-center">
				<button type="button" class="btn btn-success btn-lg btn-block" id="checkoutBtn" onclick="checkoutSuccess()">Checkout</button>
			</div>
			
		</div>
			
		
			
		<?php
		// This code closes the database connection
		mysqli_close($connection);
		
		?>
		
		
		<!-- This modal is used as a login screen for users which will appear when a user clicks the "login" button-->
		<!-- If all of the login details are correct the modal will close and the checkout option and order summary will appear -->
		<!-- Once logged in the user will then have the option to logout witht the "logout" button that also appears -->
		<!-- Email field = user@gmail.com -->
		<!-- Password field = pass -->

		<div class="modal" id="myModal">
			<div class="modal-content">
			<!--Modal Header -->
				<div class="modal-header">
					<!-- This ID is used to change the modal's text if a user inputs incorrect details into the login form-->
					<h4 class="modal-title" id="modalText">Please enter login details...</h4>
						
						<!-- This ID is used to style the "X" created with &times -->
						<!-- When pressed an will alert the user that they must login in order to purchase items -->
						<h3 id="closeX" onClick="closeBtn()">&times;</h3>
				</div>
				<form name="loginForm">
					<div class="modal-body">	
						<div class="form-group">
							
							<!-- This input box requires that a user enters an email i.e. must include an "@" symbol -->
							<!-- The user email is hardcoded as = user@gmail.com -->
							<label for="user">Email</label>
							<input type="email" class="form-control" id="user" placeholder="Enter your email address here..." required>
						</div>
						<div class="form-group">
							
							<!-- This input box requires that a user enters the correct password -->
							<!-- The user password is hardcoded as = pass -->
							<label for="pass">Password</label>
							<input type="password" class="form-control" id="pass" placeholder="Enter your password here..." required>
						</div>	
					</div>
					
					<div class="modal-footer">
					
						<!-- This button uses the "login" class to style the button. 
						This button is also used to initiate the form validation function which will check if all the login information was entered correctly -->
						<button type="button" class="login" onClick="formValidation()" >Login</button>
						<!-- This button is used to close the modal but will alert the user that they must login in order to purchase items -->
						<button type="button" class="close btn btn-danger" id="closeModal" onClick="closeBtn()">Close</button>
					</div>
				</form> 
			</div>
		</div>
		
		<script>
		
		// A variable for the login modal
		var modal = document.getElementById("myModal");

		// When the user clicks the button, open the modal 
		function openModal() {
		  modal.style.display = "block";
		};
		
		//When the user clicks the button, close the modal and send an alert to login before trying to purchase any items
		function closeBtn() {
			modal.style.display ="none";
			alert("Please sign in before adding items to cart...");
		};
			

		// When the user clicks anywhere outside of the modal, close it
		window.onclick = function(event) {
		  if (event.target == modal) {
			modal.style.display = "none";
		  }
		};
		
		
		
	
		// Check to see if the email and password were entered correctly, if so send an alert and reveal the checkout button and order summary
		// If successful, sessionStorage will store a string which will be used to maintain the page's structure when it is refreshed after items are added to the cart
		// If the email and/or password are incorrect, send an alert and change the text within the modal to display that the login attempt failed
		function formValidation(){
		
			
			var user = document.getElementById("user").value;
			var pass = document.getElementById("pass").value;
		
			
			if (user == "user@gmail.com" && pass == "pass"){ 
				alert("Welcome back!");
				document.getElementById("loginBtn").style.display="none";
				document.getElementById("logoutBtn").style.display="initial"
				modal.style.visibility="hidden";
				document.getElementById("checkoutTable").style.visibility="visible";
				document.getElementById("checkoutBtn").style.visibility="visible";
				sessionStorage.userLogin = "true";
				
				
			} else {
				alert("Login failed");
				modal.style.display = "block";
				document.getElementById("modalText").innerHTML = "<span style='color:red'>Please enter a valid email and password.</span>";
			}
		}
		
		// When clicked, this function alerts the user that they are logged out, and will hide the checkout button and table again
		// The login button will also reappear and the sessionStorage will now equal null
		function logout(){
			alert("You have successfully been logged out. We look forward to your next visit.")
			document.getElementById("loginBtn").style.display="initial";
			document.getElementById("logoutBtn").style.display="none"
			sessionStorage.userLogin = "";
			document.getElementById("checkoutTable").style.visibility="hidden";
			document.getElementById("checkoutBtn").style.visibility="hidden";
		}
		
			
		// On clicking this button an alert will appear
		function checkoutSuccess(){
			
			alert("Your order has been placed. Thank you for shopping with Chance & Counters!");
		}
		
		
		//This function will maintain the changes made by a successful login even if the page is refreshed 
		function refresh(){
			if(sessionStorage.getItem("userLogin")){
				document.getElementById("loginBtn").style.display="none";
				document.getElementById("checkoutTable").style.visibility="visible";
				document.getElementById("checkoutBtn").style.visibility="visible";
			}
		}
			
		//An array containing tll of the items available to purchase
		var randomArray = ["Root", "Coup", "Betrayal at House on the Hill"];
		
		// A variable containing a random result of the array
		var random = randomArray[Math.floor(Math.random() * randomArray.length)];
		
		// A function, that when executed will alter the jumbotron text to display a random result from the array
		function gameSuggestion(){
			
			document.getElementById("jumboText").innerHTML= "Why not try " + random +"?";
			document.getElementById("randomBtn").style.visibility="hidden";
		}
			
			
	
		</script>
	   

		<!-- Code taken from https://getbootstrap.com/docs/4.0/getting-started/introduction/ as part of the "Starter template" -->
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous">
		
		</script>
  </body>
</html>