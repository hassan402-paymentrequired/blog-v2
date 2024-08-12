<div class="flex-1 flex flex-col gap-5  p-1  h-screen " style="scrollbar-width: none">
    <h2 class="text-gray-300 font-bold text-sm text-start mb-3">Top stories</h2>
    <?php foreach ($data as $post): ?>
    <div class=" w-full">
        <div class=" bg-neutral-800 p-4 flex flex-col justify-between leading-normal">
            <div class="mb-4">
                <div class="text-gray-300 font-semibold text-sm "> <?php echo $post['post_title'] ?></div>
            </div>
            <div class="flex items-center">
                <div class="w-12 h-12 rounded-full flex items-center justify-center text-2xl font-bold mr-4 shadow bg-neutral-950">
                    <?php echo getFirstTwoLetters($post['username']) ?>

                </div>                <div class="text-sm">
                    <p class="text-gray-300 leading-none"> <?php echo $post['username'] ?></p>
                    <p class="text-gray-600"> <?php echo date('l, d F ', strtotime($post['post_created_at'])) ?></p>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>

</div>
