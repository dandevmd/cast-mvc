<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/nav.php') ?>
<?php require base_path('views/partials/banner.php') ?>

<main>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
        <p class="mb-6">
            <a href="/notes" class="text-blue-500 underline">go back...</a>
        </p>

        <p><?= htmlspecialchars($note['body']) ?></p>

        <div class="my-5 ">
        <a href="/note/edit?id=<?=$note['id']?>" class="text-sm text-white bg-purple-500 border rounded  py-1 px-2 hover:text-purple-500 hover:bg-white hover:border-purple-500 ">Edit</a>

        </div>
        <form class="mt-6" method="POST" action="/note">
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="id" value="<?= $note['id'] ?>">
            <button class="text-sm text-red-500 border rounded border-current py-1 px-2 hover:text-white hover:bg-red-500" type="submit">Delete</button>
        </form>
    </div>
</main>

<?php require base_path('views/partials/footer.php') ?>