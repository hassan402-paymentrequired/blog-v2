<?= require_once base_path('resources/views/components/header.php') ?>


<h1 class="text-center font-semibold">Enter the 4 digit OTP sent to your mail</h1>

<form class="flex items-center flex-col w-full max-w-3xl mx-auto h-screen" method="POST" action="/verify/otp">

    <div class="flex flex-col w-full">
        <label for="otp" class="text-sm font-bold my-2">OTP</label>
        <input type="text" name="otp"
            id="otp"
            autocomplete="otp"
            placeholder="otp..."
            class="block px-2 w-full rounded-md border-0 py-1.5 bg-gray-900  shadow-sm ring-1 ring-inset text-white ring-gray-700 placeholder:text-gray-400 outline-0  sm:text-sm sm:leading-6">
            <?php if(isset($_SESSION['otp']) ?? ''):  ?>
                        <h1 class="text-sm text-red-500 font-bold"><?php echo $_SESSION['otp']?></h1>
            <?php endif; ?>
    </div>

    <button type="submit" class="px-3 py-1 rounded bg-neutral-950 font-bold border my-5 ">send</button>
</form>

<?php require_once base_path('resources/views/components/footer.php') ?>