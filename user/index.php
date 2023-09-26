<?php require_once '../core/database.php' ?>

<!DOCTYPE html>
<html lang="en">

<?php
$title = "User Dashboard";
require_once '../partials/head_panel.php';
?>

<body>
	<div class="wrapper">
		<?php require_once '../partials/sidebar_user.php' ?>

		<div class="main">
			<?php require_once '../partials/topbar.php' ?>

			<main class="content">
				<div class="container-fluid p-0">
					<h1 class="h3 mb-3">User Dashboard</h1>
					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-body">
									User Dashboard Content
								</div>
							</div>
						</div>
					</div>
				</div>
			</main>

			<?php require_once '../partials/footer.php' ?>
		</div>
	</div>

	<script src="../assets/js/app.js"></script>
	<script>
		const dashboardMenuElement = document.querySelector("#dashboard-menu");
		dashboardMenuElement.classList.add("active");
	</script>

</body>

</html>