<?php 

require_once("./global_var.php");


session_start();
//echo "SESS: " . $_SESSION['auth'] ;
$errorMessage = "";

// Accesso non ancora autenticato
if( $_SESSION['auth'] != 1 ) {

	$name = $_POST['name'];
	$pass = $_POST['pass'];
	
	// Controllo, esiste almeno uno dei 2 campi
	if( isset($name) || isset($pass) )
	{
		// non esiste lo USERNAME - show LOGIN
		if( empty($name) ) { $errorMessage = "ERRORE: inserisci username!"; }
		// non esiste la PASSWORD - show LOGIN
		elseif( empty($pass) ) { $errorMessage = "ERRORE: inserisci password!";	}
	
		// ESISTONO entrambi e sono GIUSTI - REDIRECT
		elseif( $name == SMART_USERNAME && $pass == SMART_PASSWORD )
		{
			// Authentication successful - Set session
			session_start();
			$_SESSION['auth'] = 1;
			setcookie("username", $_POST['name'], time()+(84600*30));
			echo "<h1>Login effettuato! caricamento...</h1>";
			header('Refresh: 1; '. $_SERVER['PHP_SELF'] .'');
		}
		// ESISTONO entrambi e sono SBAGLIATI - show LOGIN
		else {
			$errorMessage = "ERRORE: username e/o password incorretti!";
		}
	} else {
		$errorMessage = "Inserisci username e password:";
	}
	
	
	// If no submission, display login form
	if($errorMessage != "") {
	?>
		<html>
		<head>
		<script src="./js/jquery-1.8.3.min.js" type="text/javascript" ></script>
		<script src="./js/throbber.js" type="text/javascript" ></script>
		<script type="text/javascript" src="./js/script_luci.js"></script>		
		
        <style>
		
			body {
				background-color:#FDFDFD;
				
			}
			
			#login {
				margin: auto;
				padding: 30px 0 0;
				width: 750px;			
			}
		
			form {
				background: none repeat scroll 0 0 #FFFFFF;
				border: 1px solid #E5E5E5;
				box-shadow: 0 14px 60px -1px rgba(200, 200, 200, 0.8);
				font-weight: normal;
				margin-left: 8px;
				padding: 26px 24px 46px;				
				border-radius: 25px 25px 25px 25px ;
				
			}
			
			h2 {
				color:#7bb383;
				font-family:Verdana, Geneva, sans-serif;
				font-size:34px;
				font-weight:bold;
				
			}
		
			.form_label {
				color: #AAAAAA;
				font-family: Arial,Helvetica,sans-serif;
				font-size: 40px;
				font-weight: 700;
				text-align: left;				
			}
			
			.form_input {
				color: #888888;
				font-family: Arial,Helvetica,sans-serif;
				font-size: 45px;
				font-weight: 700;
				text-align: left;
				width:100%;
				padding:10px;	
				
			}
			
			
			.login_button {
				color: #006600;
				border-radius: 15px 15px 15px 15px;
				border-width: 5px;
				cursor: pointer;
				font-family: Arial,Helvetica,sans-serif;
				font-size: 34px;
				font-weight: bold;
				height: 180px;
				margin: auto;
				width: 100%;
			}
			
			.login_button:hover {
				color: #00FF00;
			}

			.switch_button_run {
				color: #006600;
				border-radius: 15px 15px 15px 15px;
				border-width: 5px;
				cursor: pointer;
				font-family: Arial,Helvetica,sans-serif;
				font-size: 34px;
				font-weight: bold;
				height: 180px;
				margin: auto;
				width: 100%;
			}

			.switch_button_run:hover {
				color: #00FF00;
			}			
			
			#throbber_loader {
				width:100%;
				height:100%;
				position:absolute;
				left:0px;
				top:0px;
				background:	url("css/images/loader_bg.png")repeat ;
				vertical-align:central;
				text-align:center;
				display:none;
			}

			#throbber_loader img {
				padding-top:100px;

			}
			
		</style>
        </head>
		<body>
		<center>
        <div id="login">
            <h2><?php echo $errorMessage; ?></h2>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <br/>
            <div class="form_label">Utente: </div>
            <input type="text" name="name" class="form_input" value="<?php 
			if(isset($_COOKIE['username'])){echo $_COOKIE['username'];} 
			?>">
            <br/><br/><br/>
            <div class="form_label">Password: </div>
            <input type="password" name="pass" class="form_input">
            <br/><br/><br/>
            <input type="submit" name="submit" value="ACCEDI" class="login_button">
			<br/><br/><br/>
            <input type="button" onclick="apriCancelloFunction()" value="APRI CANCELLO" class="login_button" />
            </form>
        </div>
		</center>
		
<br/><br/>

<script type="text/javascript">

function apriCancelloFunction()
{
	//alert("apricancello");
	handleClickCancello();;
}

</script>
<div id="throbber_loader"><img src="css/images/ajax_loader.gif" alt="loading..." align="middle" /></div>
		
		</body>
		</html>
        
        
        
        
        
        
	<?php
	}
	
	die;
}






?>
