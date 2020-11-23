<?php include "includes/admin_header.php"  ?>


    <div id="wrapper">


        <!-- Navigation -->
<?php include "includes/admin_navigation.php" ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to Admin 

                            
                            <small><?php echo $_SESSION['username']; ?></small>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Blank Page
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->


                       
                <!-- /.row -->
                
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-file-text fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">

                                    <?php
                                        $query = "SELECT * FROM posts";
                                        $select_posts_query = mysqli_query($connection, $query);

                                        $post_counts = mysqli_num_rows($select_posts_query);

                                        echo "<div class='huge'>{$post_counts}</div>" ;
                                    ?>
                                
                                        <div>Posts</div>
                                    </div>
                                </div>
                            </div>
                            <a href="posts.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-comments fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">

                                    <?php
                                        $query = "SELECT * FROM comments";
                                        $select_comments_query = mysqli_query($connection, $query);

                                        $comment_counts = mysqli_num_rows($select_comments_query);

                                        echo "<div class='huge'>{$comment_counts}</div>" ;
                                    ?>
                                    
                                    <div>Comments</div>
                                    </div>
                                </div>
                            </div>
                            <a href="comments.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-user fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">

                                    <?php
                                        $query = "SELECT * FROM users";
                                        $select_users_query = mysqli_query($connection, $query);

                                        $user_counts = mysqli_num_rows($select_users_query);

                                        echo "<div class='huge'>{$user_counts}</div>" ;
                                    ?>

                                    
                                        <div> Users</div>
                                    </div>
                                </div>
                            </div>
                            <a href="users.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-list fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">

                                    <?php
                                        $query = "SELECT * FROM categories";
                                        $select_categories_query = mysqli_query($connection, $query);

                                        $category_counts = mysqli_num_rows($select_categories_query);

                                        echo "<div class='huge'>{$category_counts}</div>" ;
                                    ?>
                                        
                                        <div>Categories</div>
                                    </div>
                                </div>
                            </div>
                            <a href="categories.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /.row -->


                <?php
                    $query = "SELECT * FROM posts WHERE post_status = 'published' ";
                    $published_post_query = mysqli_query($connection, $query);
                    $published_post_count = mysqli_num_rows($published_post_query);


                    $query = "SELECT * FROM posts WHERE post_status = 'draft' ";
                    $draft_post_query = mysqli_query($connection, $query);
                    $draft_post_count = mysqli_num_rows($draft_post_query);


                    $query = "SELECT * FROM comments WHERE comment_status = 'unapproved' ";
                    $unapproved_comment_query = mysqli_query($connection, $query);
                    $unapproved_comment_count = mysqli_num_rows($unapproved_comment_query);


                    $query = "SELECT * FROM users WHERE user_role = 'subscriber' ";
                    $subscriber_query = mysqli_query($connection, $query);
                    $subscriber_count = mysqli_num_rows($subscriber_query);


           

                ?>


                <div class="row">
                <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Data', 'Count'],

            <?php

                $element_text = ['All Posts', 'Active Posts', 'Draft Posts', 'Comments', 'Pending Comments', 'Users', 'Subscriber', 'Categories'];
                $element_count = [$post_counts, $published_post_count, $draft_post_count, $comment_counts, $unapproved_comment_count, $user_counts, $subscriber_count, $category_counts];

                $element_text_length = count($element_text);
                
                for($i=0; $i< $element_text_length; $i++){
                    echo "['{$element_text[$i]}'" . "," . "{$element_count[$i]}],";
                }

            ?>
            


        //   ['Posts', 1000],
         
        ]);

        var options = {
          chart: {
            title: '',
            subtitle: '',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>

<div id="columnchart_material" style="width: auto; height: 500px;"></div>
                </div>


            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<?php include "includes/admin_footer.php" ?>





