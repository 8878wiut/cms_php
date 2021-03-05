<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Author</th>
            <th>Title</th>
            <th>Category</th>
            <th>Status</th>
            <th>Image</th>
            <th>Tags</th>
            <th>Comments</th>
            <th>Date</th>
            <th>Edit</th>
            <th>Delete</th>
            <th>Approve</th>
            <th>Unapprove</th>
        </tr>
    </thead>
    <tbody>

        <?php

        $sql = "Select * From posts";
        $query_posts = mysqli_query($connection, $sql);

        while ($row = mysqli_fetch_assoc($query_posts)) {
            $post_id = $row['post_id'];
            $post_title = $row['post_title'];
            $post_author = $row['post_author'];
            $post_category_id = $row['post_category_id'];
            $post_status = $row['post_status'];
            $post_image = $row['post_image'];
            $post_tags = $row['post_tags'];
            $post_comment_count = $row['post_comment_count'];
            $post_date = $row['post_date'];
            echo "<tr>";
            echo "<td>$post_id</td>";
            echo "<td>$post_author</td>";
            echo "<td>$post_title</td>";

            //showing category title not ID

            $sql = "SELECT * FROM categories WHERE cat_id = $post_category_id";
            $query_categories = mysqli_query($connection, $sql);


            confirmQuery($query_categories);

            while ($row = mysqli_fetch_assoc($query_categories)) {
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];

                echo "<td>$cat_title</td>";
            }



            echo "<td>$post_status</td>";
            echo "<td><img width='100' src='../images/$post_image'></td>";
            echo "<td>$post_tags</td>";
            echo "<td>$post_comment_count</td>";
            echo "<td>$post_date</td>";
            echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}' style='color: blue; text-decoration: none;'>Edit</a></td>";
            echo "<td><a href='posts.php?delete={$post_id}' style='color: red; text-decoration: none;'>Delete</a></td>";
            echo "<td><a href='posts.php?approve={$post_id}' style='color: blue; text-decoration: none;'>Approve</a></td>";
            echo "<td><a href='posts.php?unapprove={$post_id}' style='color: red; text-decoration: none;'>Unapprove</a></td>";
            echo "</tr>";
        }

        ?>

    </tbody>
</table>


<?php


if (isset($_GET['approve'])) {
    $the_post_id = $_GET['approve'];

    $sql = "UPDATE posts SET post_status = 'approved' WHERE post_id = $the_post_id";
    $unapprove_query = mysqli_query($connection, $sql);
    header("Location: posts.php");
}


if (isset($_GET['unapprove'])) {
    $the_post_id = $_GET['unapprove'];

    $sql = "UPDATE posts SET post_status = 'unapproved' WHERE post_id = $the_post_id";
    $unapprove_query = mysqli_query($connection, $sql);
    header("Location: posts.php");
}


if (isset($_GET['delete'])) {
    $the_post_id = $_GET['delete'];

    $sql = "DELETE FROM posts WHERE post_id = $the_post_id";
    $delete_query = mysqli_query($connection, $sql);
    header("Location: posts.php");
}

?>