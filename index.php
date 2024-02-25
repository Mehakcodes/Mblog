<?php
include 'partials/header.php';

//fetch featured post from databse
$featured_query="SELECT * FROM posts WHERE is_featured=1";
$featured_result=mysqli_query($connection,$featured_query);
$featured=mysqli_fetch_assoc($featured_result);

//fetch 9 posts from posts table
$query="SELECT * FROM posts ORDER BY date_time DESC LIMIT 9";
$posts= mysqli_query($connection,$query);
?>

<?php if(mysqli_num_rows($featured_result) == 1) : ?>
    <!-- FEATURED SECTION -->
    <section class="featured">
        <div class="container featured-container">
            <div class="post-thumbnail">
                <img src="./images/<?= $featured['thumbnail']?>" >
            </div>
            <div class="post-info">
                <?php
                //fetch category from category table using category_id of post
                $category_id=$featured['category_id'];
                $category_query="SELECT * FROM categories WHERE id=$category_id";
                $category_result=mysqli_query($connection,$category_query);
                $category=mysqli_fetch_assoc($category_result);
                ?>
                <a href="<?=ROOT_URL?>category-posts.php?id=<?=$featured['category_id']?>" class="category-button"><?= $category['title']?></a>
                <h2 class="post-title"><a href="<?=ROOT_URL?>post.php?id=<?=$featured['id']?>"><?= $featured['title']?></a></h2>
                <p class="post-body">
                    <?= substr($featured['body'],0,300)?>...
                </p>
                <div class="post-author">
                    <?php
                    //fetching author data
                    $author_id=$featured['author_id'];
                    $author_query="SELECT * FROM users WHERE id=$author_id";
                    $author_result= mysqli_query($connection,$author_query);
                    $author=mysqli_fetch_assoc($author_result);
                    ?>
                    <div class="post-author-avatar">
                        <img src="./images/<?=$author['avatar']?>">
                    </div>
                    <div class="post-author-info">
                        <h5>By: <?=$author['firstname']." ".$author['lastname']?></h5>
                        <small><?= date("M d, Y - H:i",strtotime($featured['date_time']))?></small>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- FEATURED SECTION END-->
<?php endif ?>
    
    <!-- POST SECTION -->

    <section class="posts <?= $featured ? '' :'section-extra-margin'?>">
        <div class="container posts-container">
            <?php while($post=mysqli_fetch_assoc($posts)) : ?>
                <article class="post">
                    <div class="post-thumbnail">
                        <img src="./images/<?=$post['thumbnail']?>">
                    </div>
                    <div class="post-info">
                        <?php
                        //fetch category from category table using category_id of post
                        $category_id=$post['category_id'];
                        $category_query="SELECT * FROM categories WHERE id=$category_id";
                        $category_result=mysqli_query($connection,$category_query);
                        $category=mysqli_fetch_assoc($category_result);
                        ?>
                        <a href="<?=ROOT_URL?>category-posts.php?id=<?=$post['category_id']?>" class="category-button"><?= $category['title']?></a>
                        <h3 class="post-title">
                            <a href="<?=ROOT_URL?>post.php?id=<?=$post['id']?>">
                                <?=$post['title']?>
                            </a>
                        </h3>
                        <p class="post-body">
                            <?= substr($post['body'],0,150)?>...
                        </p>
                        <div class="post-author">
                            <?php
                            //fetching author data
                            $author_id=$post['author_id'];
                            $author_query="SELECT * FROM users WHERE id=$author_id";
                            $author_result= mysqli_query($connection,$author_query);
                            $author=mysqli_fetch_assoc($author_result);
                            ?>
                            <div class="post-author-avatar">
                                <img src="./images/<?=$author['avatar']?>">
                            </div>
                            <div class="post-author-info">
                                <h5>By: <?=$author['firstname']." ".$author['lastname']?></h5>
                                <small><?= date("M d, Y - H:i",strtotime($post['date_time']))?></small>
                            </div>
                        </div>
                    </div>
            </article>
            <?php endwhile ?>
            
           
        
        </div>
        
    </section>

    <!-- POST SECTION END -->


    <!-- CATEGORY SECTION -->
    <section class="category-buttons">
        <div class="container category-buttons-container">
            <?php
            $all_categories_query="SELECT * FROM categories";
            $all_categories_result=mysqli_query($connection,$all_categories_query);
            ?>
            <?php while($category=mysqli_fetch_assoc($all_categories_result)) : ?>
                <a href="<?= ROOT_URL ?>category-posts.php?id=<?=$category['id']?>" class="category-button"><?=$category['title']?></a>
            <?php endwhile ?>
        </div>
    </section>
    <!-- CATEGORY SECTION END -->


    <?php
    include 'partials/footer.php';
    ?>

    
