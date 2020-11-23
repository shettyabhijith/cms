<?php 

    if(isset($_GET['edit_user'])){
       $the_user_id = $_GET['edit_user'];

       $query = "SELECT * FROM users WHERE user_id = $the_user_id";
       $select_user_query = mysqli_query($connection, $query);

       while($row = mysqli_fetch_assoc($select_user_query)){
        $user_id = $row['user_id'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];

        $user_role = $row['user_role'];

        $username = $row['username'];
        $user_email = $row['user_email'];
        $user_password = $row['user_password'];

       }
    }








    if(isset($_POST['update_user'])){

        
        $user_firstname = $_POST['user_firstname'];
        $user_lastname = $_POST['user_lastname'];

        $user_role = $_POST['user_role'];

        $username = $_POST['username'];
        $user_email = $_POST['user_email'];
        $user_password = $_POST['user_password'];

        // $query = "UPDATE posts SET user_firstname = '{$user_firstname}', user_lastname = '{$user_lastname}', user_role = '{$user_role}', username = '{$username}', user_email = '{$user_email}', user_password = '{$user_password}' WHERE user_id = {$user_id}";

        $query = "UPDATE users SET user_firstname = '{$user_firstname}', user_lastname = '{$user_lastname}', user_role = '{$user_role}', username = '{$username}', user_email = '{$user_email}', user_password = '{$user_password}' WHERE user_id = {$user_id}";

        $update_user_query = mysqli_query($connection, $query);

       
        if(!$update_user_query){
            die('query failed'. mysqli_error($connection));
        }
    }

?>

<form action="" method="post" enctype="multipart/form-data">


    <div class="form-group">
        <label for="first_name">First name</label>
        <input type="text" class="form-control" name="user_firstname" value="<?php echo $user_firstname; ?>"> 
    </div>

    <div class="form-group">
        <label for="last_name">Last Name</label>
        <input type="text" class="form-control" name="user_lastname" value="<?php echo $user_lastname; ?>"> 
    </div>


  

    <div class="form-group">
        <select name="user_role" id="">
            <option value="<?php echo $user_role; ?>"><?php echo $user_role; ?></option>

            <?php 
                if($user_role == 'admin'){
                    echo "<option value='subscriber'>Subscriber</option>" ;
                } else {
                    echo "<option value='admin'>Admin </option>" ;
                }
           ?>

        </select>
    </div>

    

    <!-- <div class="form-group">
        <label for="post_image"></label>
        <input type="file" class="form-control" name="post_image"> 
    </div> -->

    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" name="username" value="<?php echo $username; ?>"> 
    </div>

    <div class="form-group">
        <label for="user_email">Email</label>
        <input type="email" class="form-control" name="user_email" value="<?php echo $user_email; ?>"> 
    </div>

    <div class="form-group">
        <label for="user_password">Password</label>
        <input type="password" class="form-control" name="user_password" value="<?php echo $user_password; ?>"> 
    </div>
    

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update_user" value="Update User"> 
    </div>

</form>
