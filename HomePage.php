<!DOCTYPE html>
<html>
<head>
<title>Home page</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 
<html>
 
<head>

<title>Home page</title>

	<style>
		* {
			margin: 0;
			padding: 0;
		}

		.navbar {
			display: flex;
			align-items: center;
			justify-content: center;
			position: sticky;
			top: 0;
			cursor: pointer;
		}

		.background {
			background: black;
			background-blend-mode: darken;
			background-size: cover;
		}

		.nav-list {
			width: 70%;
			display: flex;
			align-items: center;
		}

		

		.nav-list li {
			list-style: none;
			padding: 26px 30px;
		}

		.nav-list li a {
			text-decoration: none;
			color: white;
		}

		.nav-list li a:hover {
			color: grey;
		}

		.rightnav {
			width: 30%;
			text-align: right;
		}

		#search {
			padding: 5px;
			font-size: 17px;
			border: 2px solid grey;
			border-radius: 9px;
		}

		.firstsection {
			background-color: white;
			height: 400px;
		}

		

		.box-main {
			display: flex;
			justify-content: left;
			align-items:center;
			color: black;
			max-width: 80%;
			margin: auto;
			height: 100%;
		}

		.firsthalf {
			width: 100%;
			display: flex;
			flex-direction: column;
			justify-content: left;
		}

		.secondhalf {
			width: 30%;
		}

		.secondhalf img {
			width: 70%;
			border: 4px solid white;
			border-radius: 150px;
			display: block;
			margin: auto;
		}

		.text-big {
			font-family: 'Piazzolla', serif;
			font-weight: bold;
			font-size: 35px;
		}

		.text-small {
			font-size: 18px;
		}

		.btn {
			padding: 8px 20px;
			margin: 7px 0;
			border: 2px solid white;
			border-radius: 8px;
			background: none;
			color: white;
			cursor: pointer;
		}

		.btn-sm {
			padding: 6px 10px;
			vertical-align: middle;
		}

		.section {
			height: 400px;
			display: flex;
			align-items: center;
			justify-content: center;
			max-width: 90%;
			margin: auto;
		}

		.section-Left {
			flex-direction: row-reverse;
		}

		.paras {
			padding: 0px 65px;
			height:540px
		}

		

		.center {
			text-align: center;
		}

		.text-footer {
			text-align: center;
			padding: 30px 0;
			font-family: 'Ubuntu', sans-serif;
			display: flex;
			justify-content: center;
			color: white;
		}
	</style>

    <title>
        Home page
    </title>
</head>
 
<body>
    <nav class="navbar background">
        <ul class="nav-list">
           <svg width="70" height="70">
    <image class="change-my-color" xlink:href="file:///C:/Users/Vaibhavi/OneDrive/Desktop/homepage/logo_2%20(1).svg" width="70" height="70"  >
</svg>
            <li><a href="#home">Home</a></li>
            <li><a href="#aboutus">About Us</a></li>
            <li><a href="#contactus">Contact us</a></li>
        </ul>
 
        <div class="rightNav">
            <input type="text" name="search" id="search">
            <button class="btn btn-sm">Search</button>
        </div>
    </nav>
 
    <section class="firstsection">
        <div class="box-main">
		<div class="thumbnail">
            <img src="bg.jpg">
        </div>
                 
            <div class="firstHalf">

                <h1 class="text-big" id="web">
                    Manage It.
                </h1>
		
                <p class="text-small">
                    Manage your employees using Manage It!
			
                </p>
		
 
 
            </div>
        </div>
    
 
   <div class="aboutuscontainer" style="padding:128px 16px;height:650px" id="about" >
  <h3 class="w3-center">ABOUT US</h3>
  <p class="w3-center w3-large">Key features of Manage It.</p>
  <div class="w3-row-padding w3-center" style="margin-top:64px">
    <div class="w3-quarter">
      <i class="fa fa-desktop w3-margin-bottom w3-jumbo w3-center"></i>
      <p class="w3-large">Responsive</p>
      <p>Using manage it HR can provide great response to the employees by handling and resolving their records and issues respectively.</p>
    </div>
    <div class="w3-quarter">
      <i class="fa fa-heart w3-margin-bottom w3-jumbo"></i>
      <p class="w3-large">Passion</p>
      <p>Enhancing the trust among admin ,HR and employees.</p>
    </div>
    <div class="w3-quarter">
      <i class="fa fa-diamond w3-margin-bottom w3-jumbo"></i>
      <p class="w3-large">Design</p>
      <p>Our design is user-friendly and provides simple interface to access the services.</p>
    </div>
    <div class="w3-quarter">
      <i class="fa fa-cog w3-margin-bottom w3-jumbo"></i>
      <p class="w3-large">Support</p>
      <p>We try to provide support to our users so that they can also be a part of us and we can enhance Manage It more. </p>
    </div>
  </div>
</div>
 
    <section class="section">
        <div class="paras">
            <h1 class="sectionTag text-big">Contact us</h1>
		<hr style="width:50px;" class="w3-round">
 
             <p>Do you want us to manage your employees? Fill out the form and fill me in with the details :) We love meeting new people!</p>
    <form>
      <div class="w3-section">
        <label>Name</label>
        <input class="w3-input w3-border" type="text" name="Name" required>
      </div>
      <div class="w3-section">
        <label>Email</label>
        <input class="w3-input w3-border" type="text" name="Email" required>
      </div>
      <div class="w3-section">
        <label>Message</label>
        <input class="w3-input w3-border" type="text" name="Message" required>
      </div>
      <button type="submit" class="w3-button w3-block w3-padding-large w3-black w3-margin-bottom">Send Message</button>
    </form>  
 
 
        </div>
 
        
    </section>
 
    <footer class="background">
        <p class="text-footer">
            Copyright ©-All rights are reserved
        </p>
 
 
    </footer>
</body>
 
</html>