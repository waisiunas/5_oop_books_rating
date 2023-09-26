<?php
if (isset($error) && !empty($error)) { ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?php
        echo $error;
        ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php
}

if (isset($success) && !empty($success)) { ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?php
        echo $success;
        ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php
}

if (isset($_SESSION['error']) && !empty($_SESSION['error'])) { ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?php
        echo $_SESSION['error'];
        ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php
unset($_SESSION['error']);
}

if (isset($_SESSION['success']) && !empty($_SESSION['success'])) { ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?php
        echo $_SESSION['success'];
        ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php
unset($_SESSION['success']);
}