<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]> <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]> <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>Login Form</title>
  <link rel="stylesheet" type="text/css" href="jpanel_style/login_style.css">
  <script src="jpanel_script/jquery-1.11.3.min.js" language="javascript" ></script>
  <script>
  	$(document).ready(function(e) {
        $('#bottom_section').on('dblclick', function(e) {
			if (e.shiftKey || e.ctrlKey) {
			  window.open("http://jmade.net/?autor=Jahangir_Abdullaev", '_blank');
			}
		  
		});
    });
  </script>
  <!--[if lt IE 9]><script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
</head>
<body>
  <section class="container">
    <div class="login">
      <h1>Login JPANEL</h1>
      <form method="post" action="login_exec.php">
        <p><input type="text" name="login" value="" placeholder="Username or Email"></p>
        <p><input type="password" name="password" value="" placeholder="Password"></p>
        <p class="remember_me">
          <label>
            <input type="checkbox" name="remember_me" id="remember_me">
            Remember me on this computer
          </label>
        </p>
        <p class="submit"><input type="submit" name="do" value="Login"></p>
      </form>
    </div>

    <div class="login-help">
      <p>Forgot your password? <a href="index.php">Click here to reset it</a>.</p>
    </div>
  </section>

  <section class="about" style="background-color:#FFFFFF; background-image:none;" id="bottom_section">
  	<img src="jpanel_img/logo.png" />  
  </section>
  
</body>
</html>
