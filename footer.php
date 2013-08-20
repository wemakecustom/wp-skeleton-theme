    </div><!-- #main -->

    <footer id="footer" class="clearfix">
        <?php
            if (!is_404()) {
                get_sidebar('footer');
            }
        ?>
    </footer><!-- #colophon -->
</div><!-- #page -->
<?php wp_footer(); ?>
</body>
</html>
