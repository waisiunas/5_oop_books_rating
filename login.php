<?php require_once './core/database.php' ?>

<?php
if (isset($_SESSION['user'])) {
	header('location: ./');
}
$email = "";
if (isset($_POST['submit'])) {
	$email = htmlspecialchars($_POST['email']);
	$password = htmlspecialchars($_POST['password']);

	if (empty($email)) {
		$error = "Enter your email!";
	} elseif (empty($password)) {
		$error = "Enter your password!";
	} else {
		$hashed_password = sha1($password);

		$response = $database->login($email, $hashed_password);
		if ($response === "admin") {
			header('location: ./admin/');
		} elseif ($response === "user") {
			header('location: ./user/');
		} elseif ($response === "failure") {
			$error = "Invalid login credentials!";
		} else {
			$error = "Something went wrong!";
		}
	}
}
?>
<!DOCTYPE html>
<html lang="en">

<?php
$title = "Login";
require_once './partials/head_main.php';
?>

<body>
	<main class="d-flex w-100">
		<div class="container d-flex flex-column">
			<div class="row vh-100">
				<div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
					<div class="d-table-cell align-middle">

						<div class="text-center mt-4">
							<h1 class="h2">Welcome back, Magicians</h1>
							<p class="lead">
								Sign in to your account to continue
							</p>
						</div>

						<div class="card">
							<div class="card-body">
								<div class="m-sm-4">
									<?php require_once('./partials/alerts.php'); ?>
									<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
										<div class="mb-3">
											<label for="email" class="form-label">Email</label>
											<input type="email" class="form-control" name="email" id="email" placeholder="Enter your email!" value="<?php echo $email ?>">
										</div>

										<div class="mb-3">
											<label for="password" class="form-label">Password</label>
											<input type="password" class="form-control" name="password" id="password" placeholder="Enter your password!">
										</div>

										<div class="mb-3">
											<input type="submit" name="submit" value="Login" class="btn btn-primary">
											<input type="reset" value="Reset" class="btn btn-dark">
										</div>

										<div>
											Do not have an account? <a href="./register.php">Register</a>
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

	<script src="./assets/js/app.js"></script>

</body>

</html>