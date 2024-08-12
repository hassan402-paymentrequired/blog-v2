
<?php require_once base_path('resources/views/components/header.php')?>

<div class="h-screen overflow-auto relative outline-0 max-w-4xl mx-auto" style="scrollbar-width: none">
        <?php foreach ($data as $post): ?>
            <div class="w-full  bg-neutral-800 mt-4 rounded parent">
                <div class="flex items-start px-4 py-6 ">
                    <div class="w-12 h-12 rounded-full flex items-center justify-center text-2xl font-bold mr-4 shadow bg-neutral-950">
                        <?php echo getFirstTwoLetters($post['username']) ?>

                    </div>
                    <div class="w-full">
                        <a href="/home/feed/show?id=<?php echo $post['id']?>">
                            <input type="hidden" name="id" value="<?php echo $post['id']?>">
                        <div class="flex items-center justify-between">
                            <h2 class="text-lg font-semibold text-gray-400 -mt-1"> <?php echo $post['username'] ?> </h2>
                            <small class="text-sm text-gray-300 px-3 py-1 border rounded"> <?php echo $post['tag'] ?> </small>
                        </div>
                        <p class="text-gray-300 text-sm mb-3"> <?php echo date('l, d F ', strtotime($post['created_at'])) ?> </p>
                        <div class="text-gray-300 font-bold text-xl mb-2">  <?php echo $post['title'] ?></div>

                        <p class="mt-3 text-gray-400 text-sm">
                            <?php echo $post['body'] ?>
                        </p>
                        </a>
                       
                    </div>
                </div>
           
                
            </div>
        <?php endforeach; ?>
    </div>

    <?php require_once base_path('resources/views/components/footer.php')?>
