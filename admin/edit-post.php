<?php
include './partials/header.php';

//fetch category from database
$query="SELECT * FROM categories";
$categories=mysqli_query($connection,$query);

//fetch post data from database
if(isset($_GET['id'])){
    $id=filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT);
    $query="SELECT * FROM posts WHERE id=$id";
    $result=mysqli_query($connection,$query);
    $post=mysqli_fetch_assoc($result);
} else {
    header('location:'.ROOT_URL.'admin/');
    die();
}

?>

    <!-- FORM -->
    <section class="form-section">
        <div class="container form-section-container">
            <h2>Edit Post</h2>
           
            <form action="<?=ROOT_URL?>admin/edit-post-logic.php" enctype="multipart/form-data" method="post">
            
                <input type="hidden" name="id"  value="<?=$post['id']?>">
                <input type="hidden" name="previous_thumbnail_name"  value="<?=$post['thumbnail']?>">
                <input type="text" name="title"  value="<?=$post['title']?>" placeholder="Title">
                <select name="category">
                    <?php while($category=mysqli_fetch_assoc($categories)) : ?>
                        <option value="<?=$category['id']?>"><?=$category['title']?></option>
                    <?php endwhile ?>
                </select>
                </select>
                <textarea rows="10" placeholder="Body" name="body"><?=$post['body']?></textarea>
                <div class="form-control inline">
                    <input type="checkbox" id="is-featured" name="is_featured" value="1" checked>
                    <label for="is-featured" >Featured</label>
                </div>
                <div class="form-control">
                    <label for="thumbnail">Change Thumbnail</label>
                    <input type="file" id="thumbnail" name="thumbnail">
                </div>
                <button type="submit" class="btn" name="submit">Update Post</button>
            
            </form>
               
        </div>
    </section>

    <!-- FORM END -->

    
    <!-- FOOTER -->
    
    <?php
    include '../partials/footer.php';
    ?>
