<?php include 'header.php'; ?>
    <div id="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <!-- post-container -->
                    <div class="post-container">
                        <?php
                            include 'config.php';
                            $post_id = $_GET['id'];
                            $sql = "SELECT post.post_id, post.title, post.description, post.post_date, category.category_name, post.category, post.author, user.first_name, post.post_img FROM post
                            LEFT JOIN category ON post.category = category.category_id
                            LEFT JOIN user ON post.author = user.user_id
                            WHERE post.post_id = {$post_id }" ;

                            $result = mysqli_query($conn, $sql) or die ("query fail");
                            $posts = $result;
                            $post = mysqli_fetch_assoc($result)
                        ?>
                        <div class="post-content single-post">
                            <h3> <?= $post ['title']?></h3>
                            <div class="post-information">
                                <span>
                                    <i class="fa fa-tags" aria-hidden="true"></i>
                                    <a href='category.php?cid=<?= $post ['category']?>'><?= $post ['category_name']?></a>
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
                            <img class="single-feature-image" src="admin/upload/<?= $post ['post_img']?>" alt=""/>
                            <p class="description">
                                <?= $post ['description']?>
                            </p>
                        </div>
                    </div>
                    <!-- /post-container -->
                </div>
                <?php include 'sidebar.php'; ?>
            </div>
        </div>
    </div>
<?php include 'footer.php'; ?>
