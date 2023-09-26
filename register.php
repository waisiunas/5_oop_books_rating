<?php require_once './core/database.php' ?>

<?php
$name = $email = "";

if (isset($_POST['submit'])) {
	$name = htmlspecialchars($_POST['name']);
	$email = htmlspecialchars($_POST['email']);
	$password = htmlspecialchars($_POST['password']);
	$password_confirmation = htmlspecialchars($_POST['password_confirmation']);

	if (empty($name)) {
		$error = "Enter your name!";
	} elseif (empty($email)) {
		$error = "Enter your email!";
	} elseif (empty($password)) {
		$error = "Enter your password!";
	} elseif ($password !== $password_confirmation) {
		$error = "Your password does not match!";
	} else {
		if ($database->is_email_already_exists($email)) {
			$error = "Email already exists!";
		} else {
			$data = [
				'name' => $name,
				'email' => $email,
				'password' => sha1($password),
				'type' => "User",
			];

			$is_registered = $database->create("users", $data);
			if ($is_registered) {
				$name = $email = "";
				$success = "User has been successfully registered!";
			} else {
				$error = "User has failed to register!";
			}
		}
		// $sql = "SELECT * FROM `users` WHERE `email` = '$email'";
		// $result = $conn->query($sql);

		// if ($result->num_rows === 0) {
		// 	$hashed_password = sha1($password);
		// 	$sql = "INSERT INTO `users`(`name`, `email`, `password`) VALUES ('$name', '$email', '$hashed_password')";
		// 	$result = $conn->query($sql);
		// 	if ($result) {
		// 		$success = "Magic has been spelled!";
		// 	} else {
		// 		$error = "Magic has failed to spell!";
		// 	}
		// } else {
		// 	$error = "Email already exists!";
		// }
	}
}
?>
<!DOCTYPE html>
<html lang="en">

<?php
$title = "Register";
require_once './partials/head_main.php';
?>

<body>
	<main class="d-flex w-100">
		<div class="container d-flex flex-column">
			<div class="row vh-100">
				<div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
					<div class="d-table-cell align-middle">

						<div class="text-center mt-4">
							<h1 class="h2">Get started</h1>
							<p class="lead">
								Start the best possible user experience for you.
							</p>
						</div>

						<div class="card">
							<div class="card-body">
								<div class="m-sm-4">
									<?php require_once('./partials/alerts.php'); ?>

									<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
										<div class="mb-3">
											<label for="name" class="form-label">Name</label>
											<input type="text" class="form-control" name="name" id="name" placeholder="Enter your name!" value="<?php echo $name ?>">
										</div>

										<div class="mb-3">
											<label for="email" class="form-label">Email</label>
											<input type="email" class="form-control" name="email" id="email" placeholder="Enter your email!" value="<?php echo $email ?>">
										</div>

										<div class="mb-3">
											<label for="password" class="form-label">Password</label>
											<input type="password" class="form-control" name="password" id="password" placeholder="Enter your password!">
										</div>

										<div class="mb-3">
											<label for="password_confirmation" class="form-label">Password Confirmation</label>
											<input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Confirm your password!">
										</div>

										<div class="mb-3">
											<input type="submit" name="submit" value="Register" class="btn btn-primary">
											<input type="reset" value="Reset" class="btn btn-dark">
										</div>

										<div>
											Already have an account? <a href="./login.php">Login</a>
										</div>
									</form>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</main>

	<script src="js/app.js"></script>

</body>

</html>