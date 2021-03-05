<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Author</th>
            <th>Comment</th>
            <th>Email</th>
            <th>Status</th>
            <th>In Response to</th>
            <th>Date</th>
            <th>Approve</th>
            <th>Unapprove</th>
            <!-- <th>Edit</th> -->
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>

        <?php

        $sql = "SELECT * FROM comments";
        $query_comments = mysqli_query($connection, $sql);

        while ($row = mysqli_fetch_assoc($query_comments)) {
            $comment_id = $row['comment_id'];
            $comment_post_id = $row['comment_post_id'];
            $comment_author = $row['comment_author'];
            $comment_content = $row['comment_content'];
            $comment_email = $row['comment_email'];
            $comment_status = $row['comment_status'];
            $comment_date = $row['comment_date'];
            echo "<tr>";
            echo "<td>$comment_id</td>";
            echo "<td>$comment_author</td>";
            echo "<td>$comment_content</td>";

            //showing category title not ID

            //    $sql = "SELECT * FROM categories WHERE cat_id = $post_category_id";
            //    $query_categories = mysqli_query($connection, $sql);      


            //    confirmQuery($query_categories);

            //    while ($row = mysqli_fetch_assoc($query_categories)) {
            //        $cat_id = $row['cat_id'];
            //        $cat_title = $row['cat_title'];

            //    echo "<td>$cat_title</td>";
            // }



            echo "<td>$comment_email</td>";
            echo "<td>$comment_status</td>";

            $sql = "SELECT * FROM posts WHERE post_id = $comment_post_id";
            $select_post_id = mysqli_query($connection, $sql);

            while ($row = mysqli_fetch_assoc($select_post_id)) {
                $post_id = $row['post_id'];
                $post_title = $row['post_title'];

                echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";
            }


            echo "<td>$comment_date</td>";
            echo "<td><a href='comments.php?approve=$comment_id' style='color: blue; text-decoration: none;'>Approve</a></td>";
            echo "<td><a href='comments.php?unapprove=$comment_id' style='color: red; text-decoration: none;'>Unapprove</a></td>";
            //    echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}' style='color: blue; text-decoration: none;'>Edit</a></td>";
            echo "<td><a href='comments.php?delete=$comment_id' style='color: red; text-decoration: none;'>Delete</a></td>";
            echo "</tr>";
        }

        ?>

    </tbody>
</table>


<?php

if (isset($_GET['approve'])) {
    $the_comment_id = $_GET['approve'];

    $sql = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = $the_comment_id";
    $approve_query = mysqli_query($connection, $sql);
    header("Location: comments.php");
}



if (isset($_GET['unapprove'])) {
    $the_comment_id = $_GET['unapprove'];

    $sql = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = $the_comment_id";
    $unapprove_query = mysqli_query($connection, $sql);
    header("Location: comments.php");
}


if (isset($_GET['delete'])) {
    $the_comment_id = $_GET['delete'];

    $sql = "DELETE FROM comments WHERE comment_id = $the_comment_id";
    $delete_query = mysqli_query($connection, $sql);
    header("Location: comments.php");
}

?>