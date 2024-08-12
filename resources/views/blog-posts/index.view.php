<?php require_once base_path('resources/views/components/header.php')?>


<div class="p-2 flex items-center gap-3">
`
    <?php require_once base_path('resources/views/components/side-bar.php')?>

    <?php if($_SERVER['REQUEST_URI'] === "/home/feed"):?>
    <?php require_once base_path('resources/views/components/main.php')?>

    <?php else : ?>
    <?php require_once base_path('resources/views/blog-posts/store.view.php')?>
    <?php endif;  ?>


    <?php require_once base_path('resources/views/components/top-stories.php')?>

</div>




<?php require_once base_path('resources/views/components/footer.php')?>

