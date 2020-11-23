

<?php 
    if(isset($_POST['create_post'])){
        
        $post_category = $_POST['post_category'];
        $post_title = $_POST['title'];
        $post_author = $_POST['post_author'];

        $post_image = $_FILES['post_image']['name'];
        $post_image_temp = $_FILES['post_image']['tmp_name'];


        $post_content = $_POST['post_content'];
        $post_tags = $_POST['post_tags'];
        // $post_comment_count = 4;
        $post_status = $_POST['post_status'];

        $post_date = date('d-m-y');

        
        
        
        

        move_uploaded_file($post_image_temp, "../images/$post_image");
       
        $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_status)";   
        $query.= "VALUES ('{$post_category}', '{$post_title}', '{$post_author}', now(), '{$post_image}', '{$post_content}', '{$post_tags}', '{$post_status}')";

         $select_query = mysqli_query($connection, $query);

         confirm_query($select_query);

         $the_post_id = mysqli_insert_id($connection);

         echo "<h4 class='bg-success'>Post Created Successfully" . " " . "<a href='../post.php?p_id={$the_post_id}'>View Post </a> or <a href='posts.php'>Edit More Posts</a></h4>";

    }

?>

<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="title">POST TITLE</label>
        <input type="text" class="form-control" name="title"> 
    </div>

    <div class="form-group">
        <select name="post_category" id="">
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
        <input type="text" class="form-control" name="post_author"> 
    </div>



    <div class="form-group">
        

        <select name="post_status" id="">
            <option value="draft">Post Status</option>
            <option value="published">Publish</option>
            <option value="draft">Draft</option>
        </select>
    </div>

    <div class="form-group">
        <label for="post_image">POST IMAGE</label>
        <input type="file" class="form-control" name="post_image"> 
    </div>

    <div class="form-group">
        <label for="post_tags">POST TAGS</label>
        <input type="text" class="form-control" name="post_tags"> 
    </div>

    <div class="form-group">
        <label for="post_content">POST CONTENT</label>
        <textarea class="form-control" name="post_content" cols="30" rows="10" id="body"></textarea> 
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="create_post" value="Publish Post"> 
    </div>

</form>