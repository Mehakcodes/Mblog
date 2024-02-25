<?php
include './partials/header.php';
$query="SELECT * FROM categories ORDER BY title";
$categories=mysqli_query($connection,$query);
?>

    <section class="dashboard">
        
        <?php if(isset($_SESSION['add-category-success'])) : // if category was successfully added ?>
            <div class="alert-message success container">
                <p>
                    <?= $_SESSION['add-category-success'] ;
                    unset($_SESSION['add-category-success']);?>
                </p>
            </div>
        <?php endif ?>
        <?php if(isset($_SESSION['add-category'])) : //if there was an error in adding category ?>
            <div class="alert-message error container">
                <p>
                    <?= $_SESSION['add-category'] ;
                    unset($_SESSION['add-category']);?>
                </p>
            </div>
        <?php endif ?>
        <?php if(isset($_SESSION['edit-category-success'])) : // if category was successfully updated ?>
            <div class="alert-message success container">
                <p>
                    <?= $_SESSION['edit-category-success'] ;
                    unset($_SESSION['edit-category-success']);?>
                </p>
            </div>
        <?php endif ?>
        <?php if(isset($_SESSION['edit-category'])) : //if there was an error in updating category ?>
            <div class="alert-message error container">
                <p>
                    <?= $_SESSION['edit-category'] ;
                    unset($_SESSION['edit-category']);?>
                </p>
            </div>
        <?php endif ?>
        <?php if(isset($_SESSION['delete-category-success'])) : // if category was successfully deleted ?>
            <div class="alert-message success container">
                <p>
                    <?= $_SESSION['delete-category-success'] ;
                    unset($_SESSION['delete-category-success']);?>
                </p>
            </div>
        <?php endif ?>
        <?php if(isset($_SESSION['delete-category'])) : //if there was an error in deleting category ?>
            <div class="alert-message error container">
                <p>
                    <?= $_SESSION['delete-category'] ;
                    unset($_SESSION['delete-category']);?>
                </p>
            </div>
        <?php endif ?>
        <div class="container dashboard-container">
            <button id="show-sidebar-btn" class="sidebar-toggle"><i class="uil uil-angle-right-b"></i></button>
            <button id="hide-sidebar-btn" class="sidebar-toggle"><i class="uil uil-angle-left-b"></i></button>
            <aside>
                <ul>
                    <li>
                        <a href="add-post.php">
                            <i class="uil uil-pen"></i>
                            <h5>Add Post</h5>
                        </a>
                    </li>
                    <li>
                        <a href="index.php">
                            <i class="uil uil-postcard"></i>
                            <h5>Manage Post</h5>
                        </a>
                    </li>
                    <?php if(isset($_SESSION['user_is_admin'])): ?>
                    <li>
                        <a href="add-user.php">
                            <i class="uil uil-user-plus"></i>
                            <h5>Add User</h5>
                        </a>
                    </li>
                    <li>
                        <a href="manage-users.php">
                            <i class="uil uil-users-alt"></i>
                            <h5>Manage Users</h5>
                        </a>
                    </li>
                    <li>
                        <a href="add-category.php">
                            <i class="uil uil-edit"></i>
                            <h5>Add Category</h5>
                        </a>
                    </li>
                    <li>
                        <a href="manage-categories.php" class="active">
                            <i class="uil uil-list-ul"></i>
                            <h5>Manage Categories</h5>
                        </a>
                    </li>
                    <?php endif ?>
                </ul>
            </aside>

            <main>

                <h2> Manage Categories</h2>
                
                <?php if(mysqli_num_rows($categories)>0) :?>
                <table>
                    <thead>
                        <tr>
                            <th>
                                Title
                            </th>
                            <th>
                                Edit
                            </th>
                            <th>
                                Delete
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php while($category=mysqli_fetch_assoc($categories)) : ?>
                            <tr>
                                <td>
                                    <?=$category['title']?>
                                </td>
                                <td><a href="<?=ROOT_URL?>admin/edit-category.php?id=<?=$category['id']?>" class="btn sm">Edit</a></td>
                                <td><a href="<?=ROOT_URL?>admin/delete-category.php?id=<?=$category['id']?>"  class="btn sm danger">Delete</a></td>
                            </tr>
                        <?php endwhile ?>
                    </tbody>
                </table>
                <?php else : ?>
                    <div class="alert-message error"><?= 'No Categories Found'?></div>
                <?php endif ?>
            </main>

        </div>
    </section>

    
    <!-- FOOTER -->
   
    <?php
    include '../partials/footer.php';
    ?>
