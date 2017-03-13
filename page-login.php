<!DOCTYPE html>
<html lang="en">

<head>
	
	<title>Login</title>
	<meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible"/>
	<meta charset="utf-8"/>
	<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
  <link href="https://fonts.googleapis.com/css?family=Merriweather:400,400i,700|Open+Sans" rel="stylesheet">
	<link href="<?php echo plugins_url('custom-login-styles.css', __FILE__ ); ?>" rel="stylesheet">

</head>
<body class="login--10up">

  <section>
    <div class="login__flex--column">
      <div>
        <div class="login__flex--row">
          <div class="login__wrapper">
						<div class="login__logo">
							<span class="screen-reader">10up Logo</span>
						</div>
            <h1>Log in to Your Account</h1>
						<?php
						  // Display helpful error messages when needed
						  if(isset($_GET['login'])){
						    $login_status = $_GET['login'];
						  } else {
								$login_status = "okay";
							}
						  if ( $login_status === "failed" ){
						    echo '<p class="login__error"><strong>ERROR:</strong> Username and/or password is invalid.</p>';
						  }
						  elseif ( $login_status === "empty" ){
						    echo '<p class="login__error"><strong>ERROR:</strong> Username and/or password is empty.</p>';
						  }
							// Display the WordPress login form
							wp_login_form(array('redirect' => home_url()));
						?>
          </div>
        </div>
      </div>
    </div>
  </section>

</body>
</html>
