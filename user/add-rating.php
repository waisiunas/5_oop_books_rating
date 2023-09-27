<?php require_once '../core/database.php' ?>

<?php
$books = $database->show_all("books");

$book_id = $rating = "";
if (isset($_POST['submit'])) {
    $book_id = htmlspecialchars($_POST['book_id']);
    $rating = htmlspecialchars($_POST['rating']);

    if (empty($book_id)) {
        $error = "Select a book!";
    } elseif (empty($rating)) {
        $error = "Rate the book!";
    } else {
        $user_id = $_SESSION['user']['id'];
        $data = [
            'book_id' => $book_id,
            'user_id' => $user_id,
            'stars' => $rating,
        ];
        
        $is_created = $database->create("ratings", $data);

        if ($is_created) {
            $success = "Magic has been spelled!";
        } else {
            $error = "Magic has become shopper!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<?php
$title = "Add Rating";
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
                            <h1 class="h3 mb-3">Add Rating</h1>
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
                                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
                                        <div class="mb-3">
                                            <label for="book_id" class="form-label">Books</label>
                                            <select name="book_id" id="book_id" class="form-select">
                                                <option value="">Select the book!</option>
                                                <?php
                                                foreach ($books as $book) { ?>
                                                    <option value="<?php echo $book['id'] ?>"><?php echo $book['title'] ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="rating" class="form-label">Rating</label>
                                            <select name="rating" id="rating" class="form-select">
                                                <option value="">Rate the book!</option>
                                                <?php
                                                for ($i = 1; $i <= 5; $i++) {
                                                    if ($rating == $i) { ?>
                                                        <option value="<?php echo $i ?>" selected><?php echo $i ?></option>
                                                    <?php
                                                    } else { ?>
                                                        <option value="<?php echo $i ?>"><?php echo $i ?></option>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </select>
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