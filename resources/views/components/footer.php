<script>
    const parent = document.querySelectorAll('.parent');
    const show_parent = document.querySelectorAll('.show_parent');
    const show = document.querySelectorAll('.show-comment');
    let show_btn = document.querySelector('.show_btn');
    let show_like = document.querySelector('.show_like');
    let show_count = document.querySelector('.show_count');





    parent.forEach(child => {
        const btn = child.querySelector('.commentBtn')
        const time = child.querySelector('.time')

        btn.addEventListener("click", () => {
            if (time.classList.contains('hidden')) {
                time.classList.remove('hidden')
            } else {
                time.classList.add('hidden')
            }
        })


        let d = child.querySelector('.pId').value
        let like_btn = child.querySelector('.btn');
        let count = child.querySelector('.count-v1');
        let commmentBtn = child.querySelector('.commmentBtn');
        let comment_post = child.querySelector('.comment-post');
        let post_id = child.querySelector('.postid');
        let comment_body = child.querySelector('.comment-body');


        
        $(document).ready(() => {


            $(commmentBtn).click(function() { 

                

                $.ajax({
                    type: 'POST',
                    url: '/home/comment/create',
                    data: {
                        postId: $(post_id).val(),
                        title: $(comment_post).val()
                    },
                    success: function(response, status) {
                        console.log(comment_body);
                        
                        comment_body += `
                         <div class=" flex gap-x-3 relative group rounded-lg hover:bg-gray-100 dark:hover:bg-white/10">

                            <div class="relative last:after:hidden after:absolute after:top-0 after:bottom-0 after:start-3.5 after:w-px after:-translate-x-[0.5px] after:bg-gray-200 dark:after:bg-neutral-700 dark:group-hover:after:bg-neutral-600">
                                <div class="relative z-10 size-7 flex justify-center items-center">
                                    <div class="size-2 rounded-full bg-white border-2 border-gray-300 group-hover:border-gray-600 dark:bg-neutral-800 dark:border-neutral-600 dark:group-hover:border-neutral-600"></div>
                                </div>
                            </div>

                            <div class="grow p-2 pb-8 flex justify-between">
                                <div>
                                <h3 class="flex gap-x-1.5 font-semibold text-gray-800 dark:text-white">
                                    title
                                </h3>
                                    <button type="button"
                                        class="mt-1 -ms-1 p-1 relative z-10 inline-flex items-center gap-x-2 text-xs rounded-lg border border-transparent text-gray-500 hover:bg-white hover:shadow-sm disabled:opacity-50 disabled:pointer-events-none dark:text-neutral-400 dark:hover:bg-neutral-800">
                                    <span class="flex shrink-0 justify-center items-center size-5 bg-white border border-gray-200 text-[10px] font-semibold uppercase text-gray-600 rounded-full dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400">
                                      hw
                                    </span>
                                    who
                                </button>
                                </div>

                            
                            </div>
                        </div>
                        `;
                    }
                })
            });

            $(like_btn).click(() => {
                $.post('/likes', {
                        post_id: d
                    },
                    (data, status) => {
                        count.innerHTML = data
                    }
                )
            })

        })




    })


    show_parent.forEach(parent => {
        let show_like_btn = parent.querySelector('.show_like_btn');
        let cid = parent.querySelector('.cid');
        let uid = parent.querySelector('.uid');
        let comment_body = parent.querySelector('.comment-body');


        $(document).ready(() => {


            $(show_like_btn).click(() => {
                $.post('/comment/delete', {
                        cid: $(cid).val(),
                        id: $(uid).val(),
                    },
                    (data, status) => {
                        console.log(status);

                    }
                )
            })



        })

    })


    $(document).ready(() => {
        $(show_btn).click(function() {

            $.ajax({
                type: 'POST',
                url: '/home/comment/create',
                data: {
                    postId: $('.show_id').val(),
                    title: $('.commenttt').val()
                },
                success: function(response) {
                    console.log(response)
                }
            })
        });

        $(show_like).click(() => {
            $.post('/likes', {
                    post_id: $('.show_post_id').val(),
                },
                (data, status) => {
                    show_count.innerHTML = data
                }
            )
        })
    })

</script>


<?php unset($_SESSION['error']) ?>
</body>

</html>