<?php
include './partials/header.php';
//get back data if invalid
$title=$_SESSION['add-category-data']['title'] ?? NULL;
$description=$_SESSION['add-category-data']['description'] ?? NULL;
unset($_SESSION['add-category-data']);
?>

    <!-- FORM -->
    <section class="form-section">
        <div class="container form-section-container">
            <h2>Add Category</h2>
           
            <?php if(isset($_SESSION['add-category'])) : ?>
                <div class="alert-message error ">
                    <p>
                        <?= $_SESSION['add-category'] ;
                        unset($_SESSION['add-category']);?>
                    </p>
                </div>
            <?php endif ?>

            <form action="<?= ROOT_URL?>admin/add-category-logic.php" method="post">
            
                <input type="text" name="title" id="" placeholder="Title" value="<?=$title?>">
               <textarea rows="4" name="description" placeholder="Description" value="<?=$description?>"></textarea>
                <button type="submit" name="submit" class="btn">Add Category</button>
            
            </form>
               
        </div>
    </section>

    <!-- FORM END -->

    <?php
    include '../partials/footer.php';
    ?>
