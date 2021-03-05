                    <form action="" method="post">
                            <div class="form-group">
                            <label for="cat_title">Edit Category</label>

                            <?php
                            
                                if (isset($_GET['edit'])) {

                                    $edit_cat_id = $_GET['edit'];

                                    $sql = "SELECT * FROM categories WHERE cat_id = $edit_cat_id";
                                    $query_categories = mysqli_query($connection, $sql);      

                                    while ($row = mysqli_fetch_assoc($query_categories)) {
                                        $cat_id = $row['cat_id'];
                                        $cat_title = $row['cat_title'];
                            ?>

                                <input value="<?php if (isset($cat_title)) {
                                    echo $cat_title;
                                } ?>" class="form-control" type="text" name="cat_title">

                            <?php }
                                    
                                }
                            ?>

                            <?php
                            
                            if (isset($_POST['update_cat'])) {
                                $edit_cat_title = $_POST['cat_title'];

                                $sql = "UPDATE categories SET cat_title = '$edit_cat_title' WHERE cat_id = '$cat_id'";
                                $query_update = mysqli_query($connection, $sql);

                                if (!$query_update) {
                                    die("Query Failed" . mysqli_error($connection));
                                }

                            }
                            
                            ?>

                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="update_cat" value="Update">
                            </div>
                        </form>