<?php require_once '../core/database.php' ?>

<?php
$book_title = $author = $price = $description = "";
if (isset($_POST['submit'])) {
    $book_title = htmlspecialchars($_POST['title']);
    $author = htmlspecialchars($_POST['author']);
    $price = htmlspecialchars($_POST['price']);
    $description = htmlspecialchars($_POST['description']);
    $picture = $_FILES['picture'];

    if (empty($book_title)) {
        $error = "Enter the book title!";
    } elseif (empty($author)) {
        $error = "Enter the book author!";
    } elseif (empty($price)) {
        $error = "Enter the book price!";
    } elseif ($picture['error'] != 0) {
        $error = "Select the picture!";
    } elseif (empty($description)) {
        $error = "Enter the book description!";
    } else {
        $name = $picture['name'];
        $tmp_name = $picture['tmp_name'];
        $extension_array = explode(".", $name);
        $extension = strtolower(end($extension_array));
        $allowed_extension = ['jpg, jpeg', 'png'];
        if (in_array($extension, $allowed_extension)) {
            $new_name = "ACI-" . microtime(true) . "." . $extension;
            $target_directory = "../assets/img/books/" . $new_name;
            if (move_uploaded_file($tmp_name, $target_directory)) {
                $data = [
                    'title' => $book_title,
                    'author' => $author,
                    'price' => $price,
                    'picture' => $new_name,
                    'description' => $description,
                ];

                $is_created = $database->create("books", $data);

                if ($is_created) {
                    $success = "Magic has been spelled!";
                } else {
                    $error = "Magic has become shopper!";
                }
            } else {
                $error = "Picture has failed to upload!";
            }
        } else {
            $error = "Only JPG, JPEG, and PNG are allowed!";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<?php
$title = "Add Book";
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
                            <h1 class="h3 mb-3">Add Book</h1>
                        </div>
                        <div class="col-md-6 text-end">
                            <a href="./" class="btn btn-outline-primary">Back</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <?php require_once "../partials/alerts.php"; ?>
                                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST" enctype="multipart/form-data">
                                        <div class="mb-3">
                                            <label for="title" class="form-label">Title</label>
                                            <input type="text" name="title" id="title" class="form-control" placeholder="Enter the book title!" value="<?php echo $book_title ?>">
                                        </div>

                                        <div class="mb-3">
                                            <label for="author" class="form-label">Author</label>
                                            <input type="text" name="author" id="author" class="form-control" placeholder="Enter the book author!" value="<?php echo $author ?>">
                                        </div>

                                        <div class="mb-3">
                                            <label for="price" class="form-label">Price</label>
                                            <input type="number" name="price" id="price" class="form-control" placeholder="Enter the book price!" value="<?php echo $price ?>">
                                        </div>

                                        <div class="mb-3">
                                            <label for="picture" class="form-label">Picture</label>
                                            <input type="file" name="picture" id="picture" class="form-control">
                                        </div>

                                        <div class="mb-3">
                                            <label for="description" class="form-label">Description</label>
                                            <textarea name="description" id="description" cols="30" rows="3" class="form-control" placeholder="Enter the book description!"><?php echo $description ?></textarea>
                                        </div>

                                        <div>
                                            <input type="submit" name="submit" class="btn btn-primary">
                                        </div>
                                    </form>
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