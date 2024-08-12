<?php require_once base_path('resources/views/components/header.php') ?>
<div class="bg-transparent  overflow-hidden max-w-4xl mx-auto">
    <div>
        <div class="w-full p-5 border-b-[1px] text-3xl font-bold">
            Profile
        </div>

        <div class="w-full py-5 flex flex-col items-center justify-center space-y-3 border-b-[1px] relative">
            <a href="/profile/update" class="top-2 right-1 absolute text-xl font-bold p-2 border rounded">Update profile</a>
            <div class="size-10 rounded-full flex items-center justify-center ring-1 p-10 uppercase  text-4xl font-bold">
                <?php echo getFirstTwoLetters($_SESSION['user']['username']) ?? ''?>
            </div>
            <h1 class="text-3xl uppercase line-clamp-1"><?php echo $_SESSION['user']['username'] ?></h1>
            <h1 class="text-2xl uppercase line-clamp-1"><?php echo $_SESSION['user']['email'] ?></h1>
        </div>


        <h4 class="text-md font-medium leading-3 my-6">Your Blog posts</h4>
        <div class="flex flex-col gap-3">

            <?php foreach ($data as $post): ?>
            <div class="flex items-center justify-between gap-3 px-6 py-3  bg-neutral-800 rounded border w-full ">
                <div class="flex space-x-3">
                    <div class="size-8 rounded-full flex items-center justify-center text-lg bg-neutral-950 font-bold"> <?php echo getFirstTwoLetters($_SESSION['user']['username']) ?></div>

                    <a  href="/home/feed/show?id=<?php echo $post['id']?>" class="leading-3">
                        <p class=" text-sm font-bold text-slate-300"><?php echo $post['title'] ?></p>
                        <span class="text-xs text-slate-400"><?php echo $post['created_at'] ?></span>
                    </a>
                </div>

               <div class="space-x-4 ">
                   <a href="/home/feed/edit?id=<?php echo $post['id']?>" class="text-sm text-slate-300 font-bold px-4 py-1 rounded bg-gray-600 ">Edit</a>
                   <form method="POST" action="/home/feed/delete" class="inline-block" >
                    <input type="hidden" name="id" value="<?php echo $post['id'] ?>" id="">
                   <button class="text-sm text-slate-300 font-bold px-4 py-1 rounded bg-gray-600 ">Delete</button>
                   </form>
               </div>

            </>
            <?php endforeach; ?>


        </div>
    </div>
</div>

<?php require_once base_path('resources/views/components/footer.php') ?>
