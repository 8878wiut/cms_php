<?php include "includes/admin_header.php"; ?>

<?php

if (isset($_SESSION['username'])) {
    $username_session = $_SESSION['username'];
    $sql = "SELECT * FROM users WHERE username = '$username_session'";
    $profile_query = mysqli_query($connection, $sql);

    while ($row = mysqli_fetch_assoc($profile_query)) {
        $user_id = $row['user_id'];
        $username = $row['username'];
        $password = $row['user_password'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_image = $row['user_image'];
        $user_email = $row['user_email'];
        $user_image = $row['user_image'];
        $user_role = $row['user_role'];
    }
}

?>

<?php

if (isset($_POST['edit_user'])) {
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_role = $_POST['user_role'];
    $user_image = $_FILES['user_image']['name'];
    $user_image_temp = $_FILES['user_image']['tmp_name'];
    $username = $_POST['username'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];


    move_uploaded_file($user_image_temp, "../images/$user_image");

    if (empty($user_image)) {
        $query = "SELECT * FROM users WHERE username = '$username_session'";
        $select_image = mysqli_query($connection, $sql);

        while ($row = mysqli_fetch_assoc($select_image)) {
            $user_image = $row['user_image'];
        }
    }

    $sql = "UPDATE users SET user_firstname = '$user_firstname', user_lastname = '$user_lastname', user_role = '$user_role', 
    user_image = '$user_image', username = '$username',
    user_email = '$user_email', user_password = '$user_password' WHERE username = '$username_session'";

    $update_user = mysqli_query($connection, $sql);

    if (!$update_user) {
        die("Query Failed" . mysqli_error($connection));
    }
}


?>

<div id="wrapper">

    <!-- Navigation -->
    <?php include "includes/admin_navigation.php"; ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">

                    <h1 class="page-header">
                        Welcome to Admin
                        <small>Ulube</small>
                    </h1>
                    <form action="" method="post" enctype="multipart/form-data">

                        <div class="form-group">
                            <label for="title">Firstname</label>
                            <input type="text" value="<?php echo $user_firstname; ?>" class="form-control" name="user_firstname">
                        </div>

                        <div class="form-group">
                            <label for="post_status">Lastname</label>
                            <input type="text" value="<?php echo $user_lastname; ?>" class="form-control" name="user_lastname">
                        </div>

                        <div class="form-group">
                            <label for="user_role">User Role</label>
                            <br>
                            <select name="user_role" id="user_role">
                                <option value="subscriber"><?php echo $user_role; ?></option>

                                <?php

                                if ($user_role == 'admin') {
                                    echo "<option value='subscriber'>subscriber</option>";
                                } else {
                                    echo "<option value='admin'>admin</option>";
                                }

                                ?>

                            </select>
                        </div>

                        <div class="form-group">
                            <label for="user_image">User Image</label>
                            <img width='100' src="../images/<?php echo $user_image; ?>" alt="">
                            <input type="file" name="user_image">
                        </div>

                        <div class="form-group">
                            <label for="post_tags">Username</label>
                            <input type="text" value="<?php echo $username; ?>" class="form-control" name="username">
                        </div>

                        <div class="form-group">
                            <label for="post_content">Email</label>
                            <input type="email" value="<?php echo $user_email; ?>" class="form-control" name="user_email">
                        </div>

                        <div class="form-group">
                            <label for="post_content">Password</label>
                            <input type="text" value="<?php echo $password; ?>" class="form-control" name="user_password">
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" name="edit_user" value="Update">
                        </div>

                    </form>
                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->
</div>

<?php include "includes/admin_footer.php"; ?>