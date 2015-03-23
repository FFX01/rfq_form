<div id="section">
					<div id="rfq">
						<?php
							//define variables and set to empty values
							$nameErr = $emailErr = $phoneErr = $descriptionErr = $cust_typeErr = "";
							$name = $email = $phone = $company = $part_number = $description = $cust_type = "";
							
							if ($_SERVER["REQUEST_METHOD"] == "POST") {
								//check to make sure name input contains data and is only letters and white space
								if (empty($_POST["name"])) {
									$nameErr = "Name is required";	
								}
								else {
									$name = test_input($_POST["name"]);
									if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
										$nameErr = "Only letters and white space allowed";
									}
								}
								//check to make sure email input is contains data and is valid
								if (empty($_POST["email"])) {
									$emailErr = "Email is required";	
								}
								else {
									$email = test_input($_POST["email"]);
									if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
										$emailErr = "Invalid Email format";
									}
								}
								//check to make sure phone input contains data and is valid
								if (empty($_POST["phone"])) {
									$phoneErr = "Phone number is required";	
								}
								else {
									$phone = test_input($_POST["phone"]);
									if (!preg_match("/^(\d[\s-]?)?[\(\[\s-]{0,2}?\d{3}[\)\]\s-]{0,2}?\d{3}[\s-]?\d{4}$/i",$phone)) {
										$phoneErr = "Phone number is invalid";
									}
								}
								
								$company = test_input($_POST["company"]);
								$part_number = test_input($_POST["part_number"]);
								
								if (empty($_POST["description"])) {
									$descriptionErr = "Description is required";	
								}
								else {
									$description = test_input($_POST["description"]);
								}
								
								if (empty($_POST["cust_type"])) {
									$cust_typeErr = "Customer Type is required";	
								}
								else {
									$cust_type = test_input($_POST["cust_type"]);
								}
							}
								
							function test_input($data) {
								$data = trim($data);
								$data = stripslashes($data);
								$data = htmlspecialchars($data);
								return $data;}
							
							$msg = "Quote Request:\nFrom: $name\nCustomer Email: $email\nCustomer Phone: $phone\nCompany: $company\nPart Number: $part_number\nDescription: $description\nCustomer Type: $cust_type";
							
							$msg = wordwrap($msg,70);
							
							$to = "#@mail.com"; //use whatever mail address you would like the form to be sent to here
							
							$subject = "Quote Request from ..."; //this is the subject line. You can write whatever you want. Some spam filters will reject your message base on what you put here.
							
							$headers = "From: #@mail.com"; //This is the email header variable.
							
							mail($to,$subject,$msg,$headers); // this actually executes the sending of the Email.
						?>
						<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
							Name:<input type="text" name="name" value="<?php echo $name;?>">
							<span class="error">*<?php echo $nameErr;?></span>
							<br>
							E-Mail:<input type="text" name="email" value="<?php echo $email;?>">
							<span class="error">*<?php echo $emailErr;?></span>
							<br>
							Phone:<input type="text" name="phone" value="<?php echo $phone;?>">
							<span class="error">*<?php echo $phoneErr;?></span>
							<br>
							Company:<input type="text" name="company" value="<?php echo $company;?>">
							<br>
							Part Number:<input type="text" name="part_number">
							<br>
							Description:<textarea name="description" rows="5" cols="40"></textarea>
							<span class="error">*<?php echo $descriptionErr;?></span>
							<br>
							<input type="radio" name="cust_type" <?php if (isset($cust_type) && $cust_type == "end_user") echo "checked";?> value="end user">End User
							<input type="radio" name="cust_type" <?php if (isset($cust_type) && $cust_type == "reseller") echo "checked"?> value="reseller">Reseller
							<span class="error">*<?php echo $cust_typeErr;?></span>
							<br>
							<input type="submit" name="submit" value="submit">
						</form>
						<?php
							echo "<h2>Your Input</h2>";
							echo $name;
							echo "<br>";
							echo $email;
							echo "<br>";
							echo $phone;
							echo "<br>";
							echo $company;
							echo "<br>";
							echo $part_number;
							echo "<br>";
							echo $description;
							echo "<br>";
							echo $cust_type;
						?>
					</div>
