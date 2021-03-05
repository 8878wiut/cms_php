<?php

    if (isset($_GET['p_id'])) {
        $the_post_id = $_GET['p_id'];
    }

$sql = "Select * From posts WHERE post_id = $the_post_id";
$edit_query_by_id = mysqli_query($connection, $sql);      

   while ($row = mysqli_fetch_assoc($edit_query_by_id)) {
       $post_id = $row['post_id'];
       $post_title = $row['post_title'];
       $post_author = $row['post_author'];
       $post_category_id = $row['post_category_id'];
       $post_status = $row['post_status'];
       $post_image = $row['post_image'];
       $post_tags = $row['post_tags'];
       $post_comment_count = $row['post_comment_count'];
       $post_date = $row['post_date'];
       $post_content = $row['post_content'];
   }

   if (isset($_POST['update_post'])) {

        $post_title = $_POST['title'];
        $post_author = $_POST['author'];
        $post_category_id = $_POST['post_category_id'];
        $post_status = $_POST['post_status'];
        $post_image = $_FILES['image']['name'];
        $post_image_temp = $_FILES['image']['tmp_name'];
        $post_tags = $_POST['post_tags'];
        $post_content = $_POST['post_content'];

        move_uploaded_file($post_image_temp, "../images/$post_image");

        if (empty($post_image)) {
            $query = "SELECT * FROM posts WHERE post_id = $the_post_id";
            $select_image = mysqli_query($connection, $sql);

            while ($row = mysqli_fetch_assoc($select_image)) {
                $post_image = $row['post_image'];
            }
        }

        $sql = "UPDATE posts SET post_title = '$post_title', post_category_id = '$post_category_id', post_author = '$post_author', 
        post_date = now(), post_image = '$post_image', post_content = '$post_content',
        post_tags = '$post_tags', post_status = '$post_status' WHERE post_id = $the_post_id";

        $update_post = mysqli_query($connection, $sql);

        confirmQuery($update_post);

        header("Location: posts.php");

   }

?>



<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="title" value="<?php echo $post_title; ?>">
    </div>

    <div class="form-group">
        <label for="post_category">Post Category Id</label>
        <br>
        <select name="post_category_id" id="post_category">
        
        <?php
        
            $sql = "SELECT * FROM categories";
            $query_categories = mysqli_query($connection, $sql);      

            
            confirmQuery($query_categories);

            while ($row = mysqli_fetch_assoc($query_categories)) {
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];

                echo "<option value='$cat_id'>$cat_title</option>";
                
            }
        ?>
        
        </select>
    </div>

    <div class="form-group">
        <label for="title">Post Author</label>
        <input type="text" class="form-control" name="author" value="<?php echo $post_author; ?>">
    </div>

    <div class="form-group">
        <label for="post_status">Post Status</label>
        <input type="text" class="form-control" name="post_status" value="<?php echo $post_status; ?>">
    </div>

    <div class="form-group">
        <label for="post_image">Post Image</label>
        <br>
        <img width='100' src="../images/<?php echo $post_image; ?>" alt="">
        <input type="file" name="image">
    </div>

    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags" value="<?php echo $post_tags; ?>">
    </div>

    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea name="post_content" class="form-control" id="" cols="30" rows="10"><?php echo $post_content; ?></textarea>
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="update_post" value="Update Post">
    </div>

</form>


