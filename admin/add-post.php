<?php
include './partials/header.php';

//fetch category from database
$query="SELECT * FROM categories";
$categories=mysqli_query($connection,$query);

// get back from form data if form was invalid
$title=$_SESSION['add-post-data']['title'] ?? null;
$body=$_SESSION['add-post-data']['body'] ?? null;

//delete form data dession
unset($_SESSION['add-post-data']);
?>
    <!-- FORM -->
    <section class="form-section">
        <div class="container form-section-container">
            <h2>Add Post</h2>
            <?php if(isset($_SESSION['add-post'])) :?>
                <div class="alert-message error">
                <p>
                    <?= $_SESSION['add-post'];
                    unset($_SESSION['add-post']);
                    ?>
                </p>
                </div>
            <?php endif ?>
            

            <form action="<?=ROOT_URL?>admin/add-post-logic.php" enctype="multipart/form-data" method="post">
            
                <input type="text" name="title" id="" placeholder="Title" value="<?=$title?>">
                <select name="category">
                    <?php while($category=mysqli_fetch_assoc($categories)) : ?>
                        <option value="<?=$category['id']?>"><?=$category['title']?></option>
                    <?php endwhile ?>
                </select>
                <textarea rows="10" placeholder="Body" name="body"><?=$body?></textarea>
                <?php if (isset($_SESSION['user_is_admin'])) : //only admin can feature post?>
                    <div class="form-control inline">
                        <input type="checkbox" id="is-featured"  name="is_featured" value="1" checked>
                        <label for="is_featured" >Featured</label>
                    </div>
                <?php endif ?>
                <div class="form-control">
                    <label for="thumbnail">Add Thumbnail</label>
                    <input type="file" name="thumbnail" id="thumbnail" >
                </div>
                <button type="submit" name="submit" class="btn">Add Post</button>
            
            </form>
               
        </div>
    </section>

    <!-- FORM END -->

    
    <!-- FOOTER -->
    
    <?php
    include '../partials/footer.php';
    ?>
