<?php require_once '../core/database.php' ?>

<?php
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = htmlspecialchars($_GET['id']);
} else {
    header('location: ./');
}

$book = $database->show_single("books", $id);
$ratings = $database->show_many("ratings", "book_id", $id);
?>

<!DOCTYPE html>
<html lang="en">

<?php
$title = "Books";
require_once '../partials/head_panel.php';
?>

<body>
    <div class="wrapper">
        <?php require_once '../partials/sidebar_admin.php' ?>

        <div class="main">
            <?php require_once '../partials/topbar.php' ?>

            <main class="content">
                <div class="container-fluid p-0">
                    <div class="row">
                        <div class="col-md-6">
                            <h1 class="h3 mb-3">Books</h1>
                        </div>
                        <div class="col-md-6 text-end">
                            <a href="./" class="btn btn-outline-primary">Back</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row mb-3">
                                        <div class="col-md-4">
                                            <p class="border border-1 rounded p-2 m-0">
                                                Title: <?php echo $book['title'] ?>
                                            </p>
                                        </div>
                                        <div class="col-md-4">
                                            <p class="border border-1 rounded p-2 m-0">
                                                Author: <?php echo $book['author'] ?>
                                            </p>
                                        </div>
                                        <div class="col-md-4">
                                            <p class="border border-1 rounded p-2 m-0">
                                                Price: <?php echo $book['price'] ?>
                                            </p>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-12">
                                            <h3>Description: </h3>
                                            <p class="border border-1 rounded p-2 m-0">
                                                <?php echo $book['description']; ?>
                                            </p>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-12">
                                            <h3>Image: </h3>
                                            <img src="../assets/img/books/<?php echo $book['picture'] ?>" class="img-fluid" alt="Book picture">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-12">
                                            <h3>Rating: </h3>
                                            <?php
                                            if (count($ratings) > 0) {
                                                foreach ($ratings as $rating) { 
                                                    $user = $database->show_single("users", $rating['user_id']);
                                                    ?>
                                                    <div class="row mb-3">
                                                        <div class="col-6">
                                                            <p class="border border-1 rounded p-2 m-0">
                                                                Stars: <?php echo $rating['stars']; ?>
                                                            </p>
                                                        </div>
                                                        <div class="col-6">
                                                            <p class="border border-1 rounded p-2 m-0">
                                                                User: <?php echo $user['name']; ?>
                                                            </p>
                                                        </div>
                                                    </div>
                                                <?php
                                                }
                                            } else { ?>
                                                <div class="alert alert-info m-0">No rating found!</div>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
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