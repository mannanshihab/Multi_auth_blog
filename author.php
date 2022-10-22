<?php include 'header.php'; ?>
    <div id="main-content">
      <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <div class="post-container">
                    <?php
                        include 'config.php';
                        if(isset($_GET['aid'])){
                            $auth_id = $_GET['aid'];
                        }
                        $sql1 = "SELECT * FROM post JOIN user 
                        ON post.author = user.user_id
                        WHERE post.author = {$auth_id}";

                        $result1 = mysqli_query($conn, $sql1) or die("Query Fail");
                        $row1 = mysqli_fetch_assoc($result1);
                    ?>
                  <h2 class="page-heading"><?= $row1 ['first_name']?></h2>
                    <?php
                        include 'config.php';
                        $limit = 3;
                        if( isset($_GET['page']) ){
                            $page = $_GET['page'];
                        }else{
                            $page = 1; 
                        }
                        $offset = ($page -1) *$limit;
                        $auth_id = $_GET['aid'];
                        $sql = "SELECT post.post_id, post.title, post.description, post.post_date, category.category_name, post.category, post.author, user.first_name,post.post_img FROM post
                        LEFT JOIN category ON post.category = category.category_id
                        LEFT JOIN user ON post.author = user.user_id
                        WHERE post.author = {$auth_id}
                        ORDER BY post.post_id DESC LIMIT {$offset},{$limit}";

                        $result = mysqli_query($conn, $sql) or die ("query fail");
                        $posts = $result;
                    ?>
                    <?php foreach ($posts as $post):?>
                        <div class="post-content">
                            <div class="row">
                                <div class="col-md-4">
                                    <a class="post-img" href="single.php?id=<?= $post ['post_id']?>"><img src="admin/upload/<?= $post ['post_img']?>" alt=""/></a>
                                </div>
                                <div class="col-md-8">
                                    <div class="inner-content clearfix">
                                        <h3><a href='single.php?id=<?= $post ['post_id']?>'>
                                            <?= $post ['title']?></a>
                                        </h3>
                                        <div class="post-information">
                                            <span>
                                                <i class="fa fa-tags" aria-hidden="true"></i>
                                                <a href='category.php?cid=<?= $post ['category']?>'>
                                                    <?= $post ['category_name']?>
                                                </a>
                                            </span>
                                            <span>
                                                <i class="fa fa-user" aria-hidden="true"></i>
                                                <a href='author.php?aid=<?= $post ['author']?>'><?= $post ['first_name']?></a>
                                            </span>
                                            <span>
                                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                                <?= $post ['post_date']?>
                                            </span>
                                        </div>
                                        <p class="description">
                                            <?= substr($post ['description'],0,100)."..." ?>
                                        </p>
                                        <a class='read-more pull-right' href='single.php?id=<?= $post ['post_id']?>'>read more</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach;?>
                    <ul class='pagination'>
                        <?php
                            if(mysqli_num_rows($result1) > 0){
                                
                                $total_records = mysqli_num_rows($result1);
                                $total_page = ceil( $total_records / $limit );
                                
                            
                                echo "<ul class='pagination admin-pagination'>";
                                if($page > 1){
                                    echo '<li>
                                        <a href="author.php?aid='.$auth_id.'&page='.($page - 1).'">Prev</a>
                                        </li>';
                                }
                                for($i = 1; $i<=$total_page; $i++){
                                    
                                    if($i == $page){
                                        $active = "active";
                                    }else{
                                        $active = "";
                                    }
                                    echo '<li class="'.$active.'">
                                            <a href="author.php?aid='.$auth_id.'&page='.$i.'">'.$i.'</a>
                                        </li>';
                                }
                            
                                if($total_page > $page ){
                                    echo '<li>
                                    <a href="author.php?aid='.$auth_id.'&page='.($page + 1).'">Prev</a>
                                    </li>';
                                }
                                echo "</ul>";
                            }
                        ?>
                    </ul>
                </div><!-- /post-container -->
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
      </div>
    </div>
<?php include 'footer.php'; ?>