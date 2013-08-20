<?php
/**
 * Display a single page
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 */

get_header(); ?>

    <div id="primary">
            <div id="content" role="main">

            <?php if ( have_posts() ) : ?>

                <?php /* Start the Loop */ ?>
                <?php while ( have_posts() ) : the_post(); ?>

                    <?php get_template_part( 'content', 'page' ); ?>

                    <?php comments_template( '', true ); ?>

                <?php endwhile; ?>

            <?php else : ?>

                    <?php get_template_part( 'content', 'none' ); ?>

            <?php endif; ?>

            </div><!-- #content -->
        </div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer();
