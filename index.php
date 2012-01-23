<?php 

$errors = array();
$name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
$message = filter_input(INPUT_POST, "message", FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
if($_SERVER["REQUEST_METHOD"] == "POST") { // When you first open the page you get the name error message because it is not submitted yet. 
// the $_SERVER global variable tells us whether the form has been posted (submitted) yet if it hasn't don't put up the error message
	if (empty($name)) {
	$errors["name"] = true;
	};
	if (mb_strlen($message) < 25) { // mb_strlen stands for multibyte string length which incoprorates accented characters as 1 character instead of 2
	$errors["message"] = true;
	};
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
	$errors["email"] = true;
	};
};

?>

<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Contact Form</title>
	<link href="css/general.css" rel="stylesheet">
</head>

<body>
<form method="post" action="index.php">
	<div class="name">
		<!-- Every Single input must have a label element associated with it with the attribute for attached to it. This creates an association with <input>-->
		<label for="name"> Name <?php if(isset($errors["name"])) : ?><strong>is required!</strong><?php endif ?> </label>
		<!--		Always put in the three fields type, id and name. id is referrenced by HTML name is referenced by php -->
		<input type="text" id="name" name="name" value="<?php echo $name; ?>" required>  <!--	the required parameter works in some browsers and causes a message to pop up saying the field is required when you submit the form -->	
	</div>
	<div class="email">
		<label for="email">E-Mail Address <?php if(isset($errors["email"])) : ?><strong>is not valid!</strong><?php endif ?></label>
		<input type="email" id="email" name="email" value="<?php echo $email; ?>" required>
	</div>
	<!--	the placeholder attribute puts text into the field that disappears when the cursor is placed in the field. it can be used in almost every input field -->	
	<div class="message">
		<label for="message">Message <?php if(isset($errors["message"])) : ?><strong>requires a minimum of 25 characters!</strong><?php endif ?></label>
		<textarea id="message" name="message" required> <?php echo $message; ?></textarea>
	</div>
	<div class="button">
		<button type="submit">Please press this button to send the Message</button>
	</div>

</form>





</body>
</html>