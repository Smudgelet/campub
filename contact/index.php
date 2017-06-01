<?php
session_start();
//error_reporting(-1);

include("$_SERVER[DOCUMENT_ROOT]/core/init.php");
include("$_SERVER[DOCUMENT_ROOT]/includes/overall/OverallHeader.php");


?>

 <div id="content">
    <?php
        $human = $_POST['human'];
	
		if ($_POST['submit']){
			$answer = $_SESSION['randa'] + $_SESSION['randb'];
			if ($human == $answer) {
				$name = $_POST['name'];
				$email = $_POST['email'];
				$message = $_POST['message'];
				$from = 'From:'. $_POST['name'].'<'. $_POST['email'].'>'; 
				$to = 'info@campub.co.uk'; 
				$subject = 'Web Enquiry';
				$body = "From: $name\n E-Mail: $email\n Message:\n $message";
				if (mail ($to, $subject, $body, $from)) { 
					echo '<p>Your message has been sent!</p>';
				}else { 
					echo '<p>Something went wrong, please try again!</p>'; 
				} 
			}
			else {
				echo '<p>You answered the anti-spam question incorrectly!</p>';
			}
		}
		
		# generate random numbers
		$randa = mt_rand(1,10);
		$randb = mt_rand(1,10);
		
		# store random numbers in a session
		$_SESSION["randa"] = $randa;
		$_SESSION["randb"] = $randb;
		
		
	?>
	<form method="post" action=<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>>
		<label>Name</label>
		<input name="name" placeholder="Type Here">
		
		<label>Email</label>
		<input name="email" type="email" placeholder="Type Here">
		
		<label>Message</label>
		<textarea name="message" placeholder="Type Here"></textarea>
		
		<label>*What is <?php echo $_SESSION['randa'],"+",$_SESSION['randb']; ?>? (Anti-spam)</label>			
		
		<input name="human" placeholder="Type Here">
		
		<input id="submit" name="submit" type="submit" value="Submit">
	</form>
</div>
<?php
include("$_SERVER[DOCUMENT_ROOT]/includes/overall/OverallFooter.php");