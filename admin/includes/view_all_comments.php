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
                                    <th>Delete</th>
                                    
                                </tr>
                            </thead>

                            <tbody>

                            <?php 

                                $query = "SELECT * FROM comments " ;
                                $select_comment = mysqli_query($connection, $query);

                                while($row = mysqli_fetch_assoc($select_comment)){
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


                                    // $query = "SELECT * FROM categories WHERE cat_id = $post_category ";
                                    // $select_category_id = mysqli_query($connection, $query);

                                    // while($row = mysqli_fetch_assoc($select_category_id)){
                                    //     $cat_id = $row['cat_id'];
                                    //     $cat_title = $row['cat_title'];
                                    // }

                                    echo "<td>$comment_email</td>";
                                    echo "<td>$comment_status</td>";


                                    $query = "SELECT * FROM posts WHERE post_id = $comment_post_id";
                                    $comment_query = mysqli_query($connection, $query);

                                    while($row = mysqli_fetch_assoc($comment_query)){

                                        $comment_post_title = $row['post_title'];
                                    }
                                    
                                    echo "<td><a href='../post.php?p_id=$comment_post_id'>$comment_post_title</a></td>";

                                    echo "<td>$comment_date</td>";
                                    echo "<td><a href='comments.php?approve=$comment_id'>Approve</td>";
                                    echo "<td><a href='comments.php?unapprove=$comment_id'>Unapprove</td>";
                                    echo "<td><a href='comments.php?delete=$comment_id'>Delete</td>";
                                    echo "</tr>" ;
                                }

                            ?>
                                
                            </tbody>
                        </table>

                        <!-- Approve Comments -->
                            <?php 
                            if(isset($_GET['approve'])){
                                $the_comment_id = $_GET['approve'];
                                $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = $the_comment_id";
                                $approve_query = mysqli_query($connection, $query);
                                header('Location:comments.php');
                                confirm_query($approve_query);
                            }
                        ?>


                        <!-- Unapprove Comments -->
                            <?php 
                            if(isset($_GET['unapprove'])){
                                $the_comment_id = $_GET['unapprove'];
                                $query = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = $the_comment_id";
                                $unapprove_query = mysqli_query($connection, $query);
                                header('Location:comments.php');
                                confirm_query($unapprove_query);
                            }
                        ?>

                        <!-- Delete Comments -->
                        <?php 
                            if(isset($_GET['delete'])){
                                $the_comment_id = $_GET['delete'];
                                $query = "DELETE FROM comments WHERE  comment_id = $the_comment_id";
                                $delete_query = mysqli_query($connection, $query);
                                header('Location:comments.php');
                                confirm_query($delete_query);
                            }
                        ?>