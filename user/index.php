<?php require_once '../core/database.php' ?>

<?php
$books = $database->show_all("books");
?>

<!DOCTYPE html>
<html lang="en">

<?php
$title = "Books";
require_once '../partials/head_panel.php';
?>

<body>
	<div class="wrapper">
		<?php require_once '../partials/sidebar_user.php' ?>

		<div class="main">
			<?php require_once '../partials/topbar.php' ?>

			<main class="content">
				<div class="container-fluid p-0">
					<div class="row">
						<div class="col-md-6">
							<h1 class="h3 mb-3">Books</h1>
						</div>
						<div class="col-md-6 text-end">
                            <a href="./add-rating.php" class="btn btn-outline-primary">Add Rating</a>
                        </div>
					</div>
					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-body">
									<?php
									if (count($books) > 0) { ?>
										<table class="table table-bordered m-0">
											<thead>
												<tr>
													<th>Sr. No.</th>
													<th>Title</th>
													<th>Author</th>
													<th>Price</th>
													<th>Description</th>
													<th>Picture</th>
													<th>Rating</th>
												</tr>
											</thead>

											<tbody>
												<?php
												$sr = 1;
												foreach ($books as $book) { ?>
													<tr>
														<td><?php echo $sr++; ?></td>
														<td><?php echo $book['title']; ?></td>
														<td><?php echo $book['author']; ?></td>
														<td><?php echo $book['price']; ?></td>
														<td><?php echo $book['description']; ?></td>
														<td>
															<img src="../assets/img/books/<?php echo $book['picture'] ?>" alt="Book picture" width="100">
														</td>
														<td>N/A (Stars)</td>
													</tr>
												<?php
												}
												?>
											</tbody>
										</table>
									<?php
									} else { ?>
										<div class="alert alert-info m-0">No record found!</div>
									<?php
									}
									?>
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