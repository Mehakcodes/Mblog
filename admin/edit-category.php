<?php
include './partials/header.php';
if(isset($_GET['id'])){
    $id=filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT);
    $query="SELECT * FROM categories WHERE id=$id";
    $result=mysqli_query($connection,$query);
    if(mysqli_num_rows($result) == 1){
        $category=mysqli_fetch_assoc($result);
    }
}
?>

    <!-- FORM -->
    <section class="form-section">
        <div class="container form-section-container">
            <h2>Edit Category</h2>
    
            <form action="<?=ROOT_URL?>admin/edit-category-logic.php" method="post">
            
                <input type="hidden" name="id" value="<?=$category['id']?>" >
                <input type="text" name="title" value="<?=$category['title']?>" id="" placeholder="Title">
                <textarea rows="4" placeholder="Description" name="description"><?=$category['description']?></textarea>
                <button type="submit" class="btn" name="submit">Update Category</button>
            
            </form>
               
        </div>
    </section>

    <!-- FORM END -->

    
    <!-- FOOTER -->
   
    <?php
    include '../partials/footer.php';
    ?>
