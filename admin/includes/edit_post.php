<?php 

    if(isset($_GET['p_id'])){

        $the_post_id = $_GET['p_id'];
        
        $query = "SELECT * FROM posts where post_id = '{$the_post_id}'";

        $select_edit_query = mysqli_query($connection, $query);

        while($row = mysqli_fetch_assoc($select_edit_query)){

        $post_category_id = $row['post_category_id'];
        $post_title = $row['post_title'];
        $post_author = $row['post_author'];
        $post_content = $row['post_content'];
        $post_image = $row['post_image'];
        $post_tags = $row['post_tags'];
        $post_comment_count = 4;
        $post_status = $row['post_status'];
           
        }
    }
?>

<?php 
    if(isset($_POST['update_post'])){
        $post_title = $_POST['title'];
        $post_category_id = $_POST['post_category_id'];
        $post_author = $_POST['post_author'];
        $post_status = $_POST['post_status'];

        $post_image = $_FILES['post_image']['name'];
        $post_image_temp = $_FILES['post_image']['tmp_name'];

        $post_tags = $_POST['post_tags'];
        $post_content = $_POST['post_content'];

        move_uploaded_file($post_image_temp, "../images/$post_image");

        if(empty($post_image)){

            $query = "SELECT * FROM posts WHERE post_id = $the_post_id ";
            $select_image = mysqli_query($connection, $query);

            $row = mysqli_fetch_assoc($select_image);
            $post_image = $row['post_image'];
        }
        
        $query = "UPDATE posts SET post_title = '{$post_title}', post_category_id = '{$post_category_id}', post_author = '{$post_author}', post_status = '{$post_status}', post_image = '{$post_image}', post_tags = '{$post_tags}', post_content = '{$post_content}' WHERE post_id = {$the_post_id}";
        $select_update_query = mysqli_query($connection, $query);


        if(!$select_update_query){
            die('query failed'. mysqli_error($connection));
        }
        
        echo "<h4 class='bg-success'>Post Updated Successfully" . " " . "<a href='../post.php?p_id={$the_post_id}'>View Post </a> or <a href='posts.php'>Edit More Posts</a></h4>";
    


    }
?>


<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="title">POST TITLE</label>
        <input type="text" class="form-control" name="title" value="<?php echo $post_title ; ?>"> 
    </div>

    <div class="form-group">
        <select name="post_category_id" id="">
            <?php
                $query = "SELECT * FROM categories";
                $select_category_query = mysqli_query($connection, $query);

                while($row= mysqli_fetch_assoc($select_category_query)){
                    $cat_id = $row['cat_id'];
                    $cat_title = $row['cat_title'];

                    echo "<option value='{$cat_id}'>{$cat_title}</option>";
                }
            ?>

        </select>
    </div>

    <div class="form-group">
        <label for="post_author">POST AUTHOR</label>
        <input type="text" class="form-control" name="post_author" value="<?php echo $post_author ; ?>"> 
    </div>


    <div class="form-group">
    <select name="post_status">
        <option value='<?php echo $post_status ; ?>'> <?php echo $post_status ; ?> </option>
        
        <?php
            if($post_status === 'published'){
                echo "<option value='draft'>Draft</option>";
            } else {
                echo "<option value='published'>Published</option>";
            }
        ?>
    </select>
    </div>


    <!-- <div class="form-group">
        <label for="post_status">POST STATUS</label>
        <input type="text" class="form-control" name="post_status" value="<?php echo $post_status ; ?>"> 
    </div> -->



    

    <div class="form-group">
        <img src="../images/<?php echo $post_image ; ?>" width="100px" >
        <input type="file" class="form-control" name="post_image">
    </div>

    <div class="form-group">
        <label for="post_tags">POST TAGS</label>
        <input type="text" class="form-control" name="post_tags" value="<?php echo $post_tags ; ?>"> 
    </div>

    <div class="form-group">
        <label for="post_content">POST CONTENT</label>
        <textarea class="form-control" name="post_content" cols="30" rows="10" ><?php echo $post_content ; ?></textarea> 
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update_post" value="Publish Post" > 
    </div>

</form>