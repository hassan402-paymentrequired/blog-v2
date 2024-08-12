<div class="flex-1 flex flex-col gap-5  p-3 overflow-auto h-screen border-r-[1px] border-gray-700 relative">
    <a href="/home/feed"
            class="p-2.5 mt-3 flex items-center bg-neutral-900 rounded-md px-4 duration-300 cursor-pointer hover:bg-neutral-600 text-white"
    >
        <i class='bx bxl-graphql'></i>
        <span class="text-[15px] ml-4 text-gray-200 font-bold">Home</span>
    </a>

    <a href="/home/feed/create"
            class="p-2.5 mt-3 flex items-center bg-neutral-900 rounded-md px-4 duration-300 cursor-pointer hover:bg-neutral-600 text-white"
    >
        <i class='bx bxl-graphql'></i>
        <span class="text-[15px] ml-4 text-gray-200 font-bold">Create post</span>
    </a>

    <form method="POST" action="/logout" class="p-2.5 mt-3 absolute bottom-4 flex items-center bg-neutral-900 rounded-md px-2 duration-300 cursor-pointer hover:bg-neutral-600 text-white">
        <button type="submit">
            <i class='bx bx-arrow-back'></i>
        <span class="text-[15px] ml-4 text-gray-200 font-bold">Log out</span>
        </button>
    </form>
</div>