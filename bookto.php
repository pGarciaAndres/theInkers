<?php
	/* Set e-mail recipient */
	$myemail = "losinkers@gmail.com";

	/* Check all form inputs using check_input function */
	$name = check_input($_POST['name'], "Enter your name");
	$email = check_input($_POST['email']);
	$subject = "Reserva de camiseta";
	$size = check_input($_POST['size'], "Enter your size");
	$genre = check_input($_POST['genre'], "Enter your genre");
	$amount = check_input($_POST['amount'], "Enter amount");

	/* If e-mail is not valid show error message */
	if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $email))
	{
		show_error("E-mail address not valid");
	}
	/* Let's prepare the message for the e-mail */
	$message = "
	Nombre: $name
	E-mail: $email
	Asunto: Reserva de camiseta Los Inkers

	Talla: $size
	Genero: $genre
	Cantidad: $amount



        Mensaje enviado desde www.losinkers.com

	";

	/* Send the message using mail() function */
	mail($myemail, $subject, $message);

	/* Wait 3 seconds */
	sleep(3);

	/* Redirect visitor to the thank you page */
	header('Location: tienda');

	exit();

	/* Functions we used */
	function check_input($data, $problem='')
	{
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		if ($problem && strlen($data) == 0)
		{
			show_error($problem);
		}
		return $data;
	}

	function show_error($myError)
	{
	?>
	<html>
	<body>
	<p>Please correct the following error:</p>
	<strong><?php echo $myError; ?></strong>
	<p>Hit the back button and try again</p>
	</body>
	</html>
	<?php
	exit();
	}
?>