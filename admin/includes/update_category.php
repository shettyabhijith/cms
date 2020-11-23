<form action="#" method="post" >
                                <div class="form-group">
                                    <label for="cat_title_edit"> Edit Category</label>

                                <?php //getting category from db to update

                                if(isset($_GET['edit'])){
                                    $the_cat_id = $_GET['edit'];
                                    
                                    $query = "SELECT * FROM categories WHERE cat_id = $the_cat_id" ;
                                    $edit_query = mysqli_query($connection, $query) ;

                                    while($row = mysqli_fetch_assoc($edit_query)){
                                        $cat_id = $row['cat_id'];
                                        $cat_title = $row['cat_title'];
                                    
                                    ?>

                                <input type="text" class="form-control" name="cat_title" value=" <?php if(isset($cat_title)) {echo $cat_title ; }  ?>" />

                                <?php } } ?>

                                <?php 
                                    if(isset($_POST['update_category'])){

                                        $the_cat_title = $_POST['cat_title'];
                                        $query = "UPDATE categories SET cat_title = '{$the_cat_title}' WHERE cat_id = {$cat_id}" ;
                                        $update_category = mysqli_query($connection, $query);

                                        if(!$update_category){
                                            die('QUERY FAILED'. mysqli_error($connection)) ;
                                        }

                                    }

                                ?>

                                    
                                </div>

                                <div class="form-group">
                                    <input type="submit" name="update_category" class="btn btn-primary" value="Update Category" />
                                </div>

                                


                            </form>