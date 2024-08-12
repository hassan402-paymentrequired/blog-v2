<?= require_once base_path('resources/views/components/header.php') ?>

<h1 class="text-3xl text-center my-3 uppercase">reset password</h1>


<form class="w-full  bg-gray-800 p-10 rounded max-w-3xl mx-auto" method="POST" action="/reset/password">
                <h1  class="px-5 self-center rounded text-2xl font-bold">Reset Info</h1>
                <div class="flex items-center justify-between">
                    <label for="password" class="block text-sm font-medium leading-6 py-3 text-gray-300">New password</label>
                </div>
                <div class="">
                    <input
                            id="password-1"
                            name="password-1"
                            type="password"
                            autocomplete="password"
                            class="block px-2 w-full rounded-md border-0 py-1.5 bg-gray-900  shadow-sm ring-1 ring-inset text-white ring-gray-700 placeholder:text-gray-400 outline-0  sm:text-sm sm:leading-6">
                </div>
                <?php if (isset($_SESSION['password']) ?? ''): ?>
                    <h1 class="text-sm text-red-500 font-bold"><?php echo $_SESSION['password'] ?></h1>
                <?php endif; ?>


                <div class="flex items-center justify-between mt-4">
                    <label for="password" class="block text-sm font-medium leading-6 py-3 text-gray-300">Confirm new password</label>
                </div>
                <div class="">
                    <input
                            id="password-2"
                            name="password-2"
                            type="password"
                            autocomplete="password"
                            class="block px-2 w-full rounded-md border-0 py-1.5 bg-gray-900  shadow-sm ring-1 ring-inset text-white ring-gray-700 placeholder:text-gray-400 outline-0  sm:text-sm sm:leading-6">
                </div>
                <?php if (isset($_SESSION['password']) ?? ''): ?>
                    <h1 class="text-sm text-red-500 font-bold"><?php echo $_SESSION['password'] ?></h1>
                <?php endif; ?>

                <button type="submit" class="px-5 py-1 rounded shadow border mt-5">Update</button>
            </form>

<?php require_once base_path('resources/views/components/footer.php') ?>