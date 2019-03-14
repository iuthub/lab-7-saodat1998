<?php  

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include_once('functions.php');

$temp_email = $username = $fullname =  $email = $password =  $confirm_password = '';
$name_error = $email_error = $confirm_password_error = $lname_error = $temp_password = $password_error='';

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      
      if (empty($_POST["username"])) {
        $name_error = "Имя пользователя является обязательным для заполнения";
      } else {
        $username = sanitizeString($_POST["username"]);
        if (!preg_match("/^[A-Za-zА-Яа-пр-яЁё]+$/",$username)) {
        $name_error = "Пожалуйста, используйте только буквы"; 
      }
      }

      if (empty($_POST["fullname"])) {
        $lname_error = "Фамилия пользователя является обязательным для заполнения";
      } else {
        $fullname = sanitizeString($_POST["fullname"]);
        if (!preg_match("/^[A-Za-zА-Яа-пр-яЁё]+$/",$fullname)) {
        $lname_error = "Пожалуйста, используйте только буквы"; 
      }
      }
	
	 if (empty($_POST["email"])) {
        $email_error = "Электронная почта пользователя является обязательным для заполнения";
      } else {
         $email = sanitizeString($_POST["email"]);
         if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          $email_error = "Недействительный адрес электронной почты"; 
       }

     }

    if (empty($_POST["password"])) {
        $password_error = "Введите пароль";
      } else { 
         $password = sanitizeString($_POST["password"]);
      }
      

      if (empty($_POST["confirm_password"])) {
        $confirm_password_error = "confirm_password является обязательным для заполнения";
      } else {
         $confirm_password = sanitizeString($_POST["confirm_password"]);
         if ($password==$confirm_password) {
          $confirm_password_error = "Invalid password"; 
       }

     }

   


     if ( empty($name_error) && empty($email_error)&& empty($lname_error)&& empty($password_error))  {
  
        $query="INSERT INTO `users` (`username`, 
							         `email`, 
							         `password`, 
							         `fullname`, 
							         `dob`) 
         		VALUES ('$username', '$email', '$password', '$fullname', '2019-03-06');";
        
        $result = queryMysql($query);

        if($result){
          $_SESSION['email']=$email;
          $_SESSION['username']=$username;
          $_SESSION['fullname']=$fullname;
          $_SESSION['id']=$id;
          $_SESSION['password']=$password;
        
          // $s = 'Refresh:0; url='.SITE;
          // header($s);
        }

      }   
$connection->close();
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>My Blog - Registration Form</title>
		<link href="style.css" type="text/css" rel="stylesheet" />
	</head>
	
	<body>
		<?php include('header.php'); ?>

		<h2>User Details Form</h2>
		<h4>Please, fill below fields correctly</h4>
		<form action="register.php" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" name="vform">
				<ul class="form">
					<li>
						<label for="username">Username</label>
						<input type="text" name="username" id="username" name="username" value="<?php echo $username;?>" required/>
						<div class="val_error"><?php echo $name_error; ?></div>

					</li>
					<li>
						<label for="fullname">Full Name</label>
						<input type="text" name="fullname" id="fullname" name="fullname" value="<?php echo $fullname;?>" required/>
						<div class="val_error"><?php echo $lname_error; ?></div>
					</li>
					<li>
						<label for="email">Email</label>
						<input type="email" name="email" id="email" name="email" value="<?php echo $email;?>" />
						<div class="val_error"><?php echo $email_error; ?></div>
					</li>
					<li>
						<label for="pwd">Password</label>
						<input type="password" name="password" id="pwd" value="<?=$password;?>" required/>
						<div class="val_error"><?php echo $password_error; ?></div>
					</li>
					<li>
						<label for="confirm_pwd">Confirm Password</label>
						<input type="password" name="confirm_password" id="confirm_pwd" value="<?= $confirm_password;?>" required />
						<div class="val_error"><?php echo $confirm_password_error; ?></div>
					</li>
					<li>
						<input type="submit" value="Submit" /> &nbsp; Already registered? <a href="index.php">Login</a>
					</li>
				</ul>
		</form>
	</body>
</html>