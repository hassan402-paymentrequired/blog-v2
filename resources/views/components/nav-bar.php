<div class="flex items-center justify-between border-gray-800 h-16 bg-transparent px-3 space-x-4 border-b-[1px]">

    <div class="flex items-center flex-1">
        <a href="/home/feed" class="md:text-4xl  font-bold ml-5 text-xl"><i class='bx bx-group'></i></a>
    </div>

    <div class="flex-1">
        <form action="/search/posts" method="POST">
        <input type="text" class="bg-gray-900 text-gray-600 outline-0 rounded px-2 py-1.5 w-full" placeholder="Search..." name="search">
        </form>
    </div>

    <?php if(isset($_SESSION['user'])): ?>
    <ul class="flex items-center space-x-5 flex-1 justify-center">
        <li class="hover:text-gray-500 transition-colors transition-all transition text-sm"><a href="/home/feed">Feeds</a></li>
        <li class="hover:text-gray-500 transition-colors transition-all transition text-sm"><a href="https://laramic.com" class="text-base text-gray-500 font-['Pacifico']">made by laramic <i class='bx bx-right-top-arrow-circle'></i></a></li>

        <a href="/profile" class="w-8 h-8 p-5 rounded-full bg-cyan-600 uppercase text-2xl font-bold text-black flex items-center justify-center">
            <?php echo getFirstTwoLetters($_SESSION['user']['username']) ?? ''?>
        </a>
    </ul>
    <?php endif; ?>
</div>