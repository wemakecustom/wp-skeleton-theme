<?php
/**
 * Template Name: Front Page Template
 *
 * Description: A page template that provides a key component of WordPress as a CMS
 * by meeting the need for a carefully crafted introductory page. The front page template
 * in wpskeleton consists of a page content area for adding text, images, video --
 * anything you’d like -- followed by front-page-only widgets in one or two columns.
 */

get_header(); ?>

    <div id="primary">
            <div id="content" role="main">

            <?php if ( have_posts() ) : ?>

                <?php /* Start the Loop */ ?>
                <?php while ( have_posts() ) : the_post(); ?>

                    <?php get_template_part( 'content', get_post_format() ); ?>

                <?php endwhile; ?>

            <?php else : ?>

                    <?php get_template_part( 'content', 'none' ); ?>

            <?php endif; ?>

            </div><!-- #content -->
        </div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer();
