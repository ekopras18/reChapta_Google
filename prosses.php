
<?php
  // include 'connection.php';
  $mysqli = new mysqli("localhost","root","","contact");

  if ($_POST['name'] == '' || $_POST['email'] == '') {
    echo "nama dan email harus diisi";
  } else if ($_POST['g-recaptcha-response'] == '') {
    echo "recaptcha Harus diisi";
  } else {
    $captcha		= $_POST['g-recaptcha-response'];
    $secretKey		= "6Lc4qsYZAAAAAHKb4clBp99jFCdmaIOX2AoDE8Xz";
  	$ip 			= $_SERVER['REMOTE_ADDR'];
  	$response		= file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secretKey."&response=".$captcha."&remoteip=".$ip);
  	$responseKeys	= json_decode($response,true);

    if(intval($responseKeys["success"]) !== 1) {
  		echo '<h2>Wajib di isi recaptcha nya!(</h2>';
  	}else{
      $name = $_POST['name'];
      $email = $_POST['email'];

      $sql = "INSERT INTO `info`(`name`, `email`) VALUES ('$name', '$email')";
      if (mysqli_query($mysqli, $sql)) {
        echo "succsess";
      } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($mysqli);
      }
  	}
  }
 ?>
