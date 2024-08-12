<?php require_once base_path('resources/views/components/header.php') ?>
<div class="bg-transparent  overflow-hidden max-w-4xl mx-auto">
    <div>
        <div class="w-full p-5 border-b-[1px] text-3xl font-bold">
            Update Profile
        </div>

        <div class="flex flex-col space-y-7 w-full my-10 ">

            <form class="w-full  bg-gray-800 p-10 rounded" method="POST" action="/profile/update">
                <h1  class="px-5 self-center rounded text-2xl font-bold">Reset Info</h1>
                <div class="flex items-center justify-between">
                    <label for="password" class="block text-sm font-medium leading-6 py-3 text-gray-300">Username</label>
                </div>
                <div class="">
                    <input
                            id="text"
                            name="text"
                            type="text"
                            autocomplete="username"
                            value="<?php echo $_SESSION['user']['username'] ?>"
                            class="block px-2 w-full rounded-md border-0 py-1.5 bg-gray-900  shadow-sm ring-1 ring-inset text-white ring-gray-700 placeholder:text-gray-400 outline-0  sm:text-sm sm:leading-6">
                </div>
                <?php if (isset($_SESSION['error']) ?? ''): ?>
                    <h1 class="text-sm text-red-500 font-bold"><?php echo $_SESSION['error'] ?></h1>
                <?php endif; ?>


                <div class="flex items-center justify-between mt-4">
                    <label for="password" class="block text-sm font-medium leading-6 py-3 text-gray-300">Email</label>
                </div>
                <div class="">
                    <input
                            id="email"
                            name="email"
                            type="email"
                            autocomplete="email"
                            value="<?php echo $_SESSION['user']['email'] ?>"
                            class="block px-2 w-full rounded-md border-0 py-1.5 bg-gray-900  shadow-sm ring-1 ring-inset text-white ring-gray-700 placeholder:text-gray-400 outline-0  sm:text-sm sm:leading-6">
                </div>
                <?php if (isset($_SESSION['error']) ?? ''): ?>
                    <h1 class="text-sm text-red-500 font-bold"><?php echo $_SESSION['error'] ?></h1>
                <?php endif; ?>

                <button type="submit" class="px-5 py-1 rounded shadow border mt-5">Update</button>
            </form>


            <!--reset password -->
            <form method="POST" action="/password/reset" class="w-full  bg-gray-800 p-5 rounded">
                <h1  class="px-5 self-center py-1 rounded text-2xl font-bold mt-5">Reset password</h1>
                <div class="flex items-center justify-between mt-4">
                    <label for="password" class="block text-sm font-medium leading-6 py-3 text-gray-300">Email</label>
                </div>
                <div class="">
                    <input
                            id="email"
                            name="email"
                            type="email"
                            autocomplete="email"
                            value="<?php echo $_SESSION['user']['email'] ?>"
                            class="block px-2 w-full rounded-md border-0 py-1.5 bg-gray-900  shadow-sm ring-1 ring-inset text-white ring-gray-700 placeholder:text-gray-400 outline-0  sm:text-sm sm:leading-6">
                </div>
                <?php if (isset($_SESSION['error']) ?? ''): ?>
                    <h1 class="text-sm text-red-500 font-bold"><?php echo $_SESSION['error'] ?></h1>
                <?php endif; ?>
                <button type="submit" class="px-5 self-center py-1 rounded shadow border mt-5">Recover password</button>
            </form>
        </div>


    </div>

</div>
<?php require_once base_path('resources/views/components/footer.php') ?>
