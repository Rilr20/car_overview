<div class="wrap-main">

    <main>
        <article>
            <?php if ($page) : ?>
                <?php require $page["file"] ?>
            <?php else : ?>
                <p class="center">You have selected a page reference '<?= htmlentities($pageReference) ?>' that does not map to an actual page.</p>
            <?php endif; ?>
        </article>
    </main>
</div>