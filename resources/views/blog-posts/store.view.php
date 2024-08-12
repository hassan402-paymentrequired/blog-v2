
<form class="flex-[3] h-screen "  method="POST" action="/home/feed/create">

    <h2 class="mt-10 text-center text-3xl font-bold leading-9 tracking-tight text-gray-300">Create a blog post</h2>
    <div class="space-y-12">
        <div class="sm:col-span-3">
            <label for="title" class="block text-sm font-medium leading-6 text-gray-400">Title</label>
            <div class="mt-2">
                <input type="text" name="title"
                       id="title"
                       autocomplete="title"
                       placeholder="title..."
                       class="block px-2 w-full rounded-md border-0 py-1.5 bg-gray-900  shadow-sm ring-1 ring-inset text-white ring-gray-700 placeholder:text-gray-400 outline-0  sm:text-sm sm:leading-6">
            </div>
        </div>

        <div class="sm:col-span-3">
            <label for="tag" class="block text-sm font-medium leading-6 text-gray-400">Tag (php, web, life)</label>
            <div class="mt-2">
                <input type="text" name="tag"
                       id="tag"
                       autocomplete="tag"
                       placeholder="tag..."
                       class="block px-2 w-full rounded-md border-0 py-1.5 bg-gray-900  shadow-sm ring-1 ring-inset text-white ring-gray-700 placeholder:text-gray-400 outline-0  sm:text-sm sm:leading-6">
            </div>
        </div>


        <div class="border-b border-gray-900/10 pb-4">

            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">

                <div class="col-span-full">
                    <label for="body" class="block text-sm font-medium leading-6 text-gray-400">Description</label>
                    <div class="mt-2">
                        <textarea
                            id="body"
                            name="body"
                            rows="3"
                            placeholder="text..."
                            class="block px-2 w-full rounded-md border-0 py-1.5 bg-gray-900 resize-none  shadow-sm ring-1 ring-inset text-white ring-gray-700 placeholder:text-gray-400 outline-0  sm:text-sm sm:leading-6 h-32"
                        ></textarea>
                    </div>
                    <p class="mt-3 text-sm leading-6 text-gray-600">Write a few sentences about your post.</p>
                    <?php if(isset($_SESSION['error']) ?? ''):  ?>
                        <h1 class="text-sm text-red-500 font-bold"><?php echo $_SESSION['error']?></h1>
                    <?php endif; ?>
                </div>
            </div>
        </div>


    </div>

    <div class="mt-6 flex items-center justify-end gap-x-6">
        <a href="/home/feed"  class="text-sm font-semibold leading-6 text-red-500">Cancel</a>
        <button type="submit" class="rounded-md bg-[#2b5876] px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
    </div>
</form>
