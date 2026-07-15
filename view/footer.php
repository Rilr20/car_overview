<footer>
    <div class="divider"></div>
    <div class="footer-content">
        <p>&copy;<?= date('Y'); ?> RILR20</p>
        <a target="_blank" href="https://github.com/Rilr20/" target="_blank" rel="noopener noreferrer" class="github-link">
            GitHub
        </a>
    </div>
</footer>
<?php if (!empty($page["script"])): ?>
    <script src="<?= $page["script"] ?>"></script>
<?php endif; ?>
</body>

</html>