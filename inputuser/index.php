<?php
include("$_SERVER[DOCUMENT_ROOT]/core/init.php");
include("$_SERVER[DOCUMENT_ROOT]/includes/overall/OverallHeader.php");
?>

<div id="content">
	<?php include 'database.php';?>
	<?php
		if($_POST['submit']){ 
	
			// create a variable
			$Forename=$_POST['Forename'];
			$Surname=$_POST['Surname'];
			$Username=$_POST['Username'];
			$DofB=$_POST['DofB'];
			$Email=$_POST['Email'];
			$Postcode=$_POST['Postcode'];
			
			//Execute the query
			 
			mysqli_query($connect,"INSERT INTO Users(Forename,Surname,Username,DofB,Email,Postcode)
				VALUES('$Forename','$Surname','$Username','$DofB','$Email','$Postcode')");
				
			if(mysqli_affected_rows($connect) > 0){
				echo "<p>User Added</p>";
			}
			else {
				echo "User NOT Added<br />";
				echo mysqli_error ($connect);
			}
		}			
		else {
			echo '<h1>User Registration</h1><br/>
				<form method="post" action="';
			echo htmlspecialchars($_SERVER['PHP_SELF']);
			echo '"><label>Forename:</label><br/>
				<input type="text" required="required" name="Forename"/><br/>
				<label>Surname:</label><br/>
				<input type="text" required="required" name="Surname"/><br/>
				<label>Username:</label><br/>
				<input type="text" required="required" name="Username"/><br/>
				<label>DofB:</label><br/>
				<input type="date" required="required" name="DofB"/><br/>
				<label>Email:</label><br/>
				<input type="text" required="required" name="Email"/><br/>
				<label>Postcode:</label><br/>
				<input type="text" required="required" name="Postcode"/><br/><br/>
				<input type="submit" name="submit" value="Add User"/>
			</form>';
		}
	?>
	</div>
<?php
include("$_SERVER[DOCUMENT_ROOT]/includes/overall/OverallFooter.php");