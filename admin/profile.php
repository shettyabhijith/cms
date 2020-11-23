<?php include "includes/admin_header.php" ; ?>

<?php 
    if(isset($_SESSION['username'])){
       $username = $_SESSION['username'];
        
        $query = "SELECT * FROM users WHERE username = '{$username}'";
        $select_user_profile_query = mysqli_query($connection, $query);

        while($row = mysqli_fetch_array($select_user_profile_query)){

            $user_firstname = $row['user_firstname'];
            $user_lastname = $row['user_lastname'];
            $user_email = $row['user_email'];
            $user_id = $row['user_id'];
            $user_role = $row['user_role'];
            $user_password = $row['user_password'];
         
        }
    }
?>

<?php 
    if(isset($_POST['update_user'])){
       
        $user_firstname = $_POST['user_firstname'];
        $user_lastname = $_POST['user_lastname'];
        $user_role = $_POST['user_role'];
        $username = $_POST['username'];
        $user_email = $_POST['user_email'];
        $user_password = $_POST['user_password'];
        
    $query = "UPDATE users SET user_firstname = '{$user_firstname}', user_lastname = '{$user_lastname}', user_role = '{$user_role}', username = '{$username}', user_email = '{$user_email}', user_password = '{$user_password}' WHERE username = '{$username}' ";
    
    $update_user_query = mysqli_query($connection, $query);

    if(!$update_user_query){
        die('Query Failed'. mysqli_error($update_user_query));
    }
}

?>

    <div id="wrapper">

        <!-- Navigation -->
<?php include "includes/admin_navigation.php" ; ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to Admin 
                            <small>Subheading</small>
                        </h1>
                       

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
                       

                    </div>
                </div>
                <!-- /.row -->



            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<?php include "includes/admin_footer.php" ; ?>
