


<?= require_once base_path('resources/views/components/header.php') ?>
<div class="max-w-3xl mx-auto h-screen border-r border-l px-3 border-gray-500 ">
    <div class="w-full  bg-neutral-800 mt-4 rounded ">
        <div class="flex items-start px-4 py-6 ">
        <div class="w-12 h-12 rounded-full flex items-center justify-center text-2xl font-bold mr-4 shadow bg-neutral-950">
                        <?php echo getFirstTwoLetters($data['username']) ?>

                    </div>
            <div class="w-full">
                <div class="flex items-center justify-between">
                    <h2 class="text-lg font-semibold text-gray-400 -mt-1"> <?php echo $data['username'] ?> </h2>
                    <small class="text-sm text-gray-300 px-3 py-1 border rounded"> <?php echo $data['post_tag'] ?> </small>
                </div>
                <p class="text-gray-300 text-sm mb-3"> <?php echo $data['post_created_at'] ?> </p>
                <div class="text-gray-300 font-bold text-xl mb-2">  <?php echo $data['post_title'] ?></div>

                <p class="mt-3 text-gray-400 text-sm">
                    <?php echo $data['post_body'] ?>
                </p>
                <div class="mt-4 flex items-center space-x-4 cursor-pointer">

                        <!--====================like create ===================-->

                    <div class="flex mr-2 text-gray-500 text-sm myForm" >
                        <input type="hidden" value="<?php echo $data['post_id'] ?>" name="id" class="show_post_id">
                        <button type="submit" class="show_like">
                            <svg fill="none" viewBox="0 0 24 24" class="w-4 h-4 mr-1 text-red-500"
                                 stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                            </svg>
                        </button>
                        <span class="show_count"> <?php echo $data['like_count'] ?></span>
                    </div>

                    <div class="flex mr-2 text-gray-500 text-sm mr-8 cursor-pointer ">
                        <svg fill="none" viewBox="0 0 24 24" class="w-4 h-4 mr-1" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"/>
                        </svg>
                        <span>
                           <?php echo count(json_decode($data['comments'], true)) ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>


        <!--=========== comment ==================-->
        <div class="w-[90%] mx-auto mb-5 pb-2">
            <div class="flex items-center border-b border py-2 px-2">
                <input class="commenttt appearance-none bg-transparent border-none w-full text-gray-300 mr-3 py-1 px-2 leading-tight focus:outline-none"
                       type="text" placeholder="comment..." aria-label="comment" name="comments">
                <input type="hidden" value="<?php echo $data['post_id'] ?>" name="id" class="show_id">
                <button
                        class="flex-shrink-0 text-sm border  text-white py-1 px-2 rounded show_btn"
                        type="submit" name="comment">
                    post
                </button>
            </div>
            <?php if(isset($_SESSION['error']) ?? ''):  ?>
                <h1 class="text-sm text-red-500 font-bold"><?php echo $_SESSION['error']?></h1>
            <?php endif; ?>
        </div>


        <!--        start-->
        <!-- Timeline -->
        <div class="pl-5 pb-4 ">
            <!-- Heading -->
            <div class="ps-2 my-2 first:mt-0 ">
                <h3 class="text-xs font-medium uppercase text-gray-500 dark:text-neutral-400">
                    <?php echo $data['post_created_at'] ?>
                </h3>
            </div>


            <!-- End Heading -->

            <!-- Item -->
            <!-- End Item -->

            <?php foreach (json_decode($data['comments'], true) as $post_comment): ?>

                <!-- Item -->
                <div class="flex gap-x-3 relative group rounded-lg hover:bg-gray-100 dark:hover:bg-white/10 show_parent">

                    <!-- Icon -->
                    <div class="relative last:after:hidden after:absolute after:top-0 after:bottom-0 after:start-3.5 after:w-px after:-translate-x-[0.5px] after:bg-gray-200 dark:after:bg-neutral-700 dark:group-hover:after:bg-neutral-600">
                        <div class="relative z-10 size-7 flex justify-center items-center">
                            <div class="size-2 rounded-full bg-white border-2 border-gray-300 group-hover:border-gray-600 dark:bg-neutral-800 dark:border-neutral-600 dark:group-hover:border-neutral-600"></div>
                        </div>
                    </div>
                    <!-- End Icon -->

                    <!-- Right Content -->
                    <div class="grow p-2 pb-8 flex justify-between">
                        <div>
                            <h3 class="flex gap-x-1.5 font-semibold text-gray-800 dark:text-white">
                                <?php echo $post_comment['comment_title'] ?>
                            </h3>
                            <button type="button"
                                    class="mt-1 -ms-1 p-1 relative z-10 inline-flex items-center gap-x-2 text-xs rounded-lg border border-transparent text-gray-500 hover:bg-white hover:shadow-sm disabled:opacity-50 disabled:pointer-events-none dark:text-neutral-400 dark:hover:bg-neutral-800">
                                    <span class="flex shrink-0 justify-center items-center size-5 bg-white border border-gray-200 text-[10px] font-semibold uppercase text-gray-600 rounded-full dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400">
                                      <?php echo getFirstTwoLetters($post_comment['comment_username']) ?>
                                    </span>
                                <?php echo $post_comment['comment_username'] ?>
                            </button>
                        </div>

                        <?php if (isset($_SESSION['user']) && $_SESSION['user']['id'] === $post_comment['comment_user_id']): ?>
                            <div class="flex flex-col space-y-3">
                                <div class="size-8 rounded-full shadow bg-neutral-800 flex items-center justify-center">
                                    <input
                                     type="hidden"
                                     name="id"
                                     value="<?php echo $post_comment['comment_user_id'] ?>"
                                     class="uid">

                                    <input
                                     type="hidden" 
                                     name="cid" 
                                     value="<?php echo $post_comment['comment_id'] ?>"
                                     class="cid">

                                    <button class="show_like_btn">
                                        <i class='bx bx-trash'></i>
                                    </button>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    <!-- End Right Content -->
                </div>
                <!-- End Item -->
            <?php endforeach; ?>
            </div>

        <!-- End Timeline -->

        <!--        end-->
    </div>
</div>

<?php require_once base_path('resources/views/components/footer.php') ?>
