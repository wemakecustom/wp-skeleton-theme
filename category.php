<?php
/**
 * The template for displaying Category pages.
 *
 * Used to display archive-type pages for posts in a category.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 */

get_header(); ?>

    <section id="primary" class="site-content">
        <div id="content" role="main">

        <?php if ( have_posts() ) : ?>
            <header class="archive-header">
                <h1 class="archive-title"><?php printf( __( 'Category Archives: %s', 'wpskeleton' ), '<span>' . single_cat_title( '', false ) . '</span>' ); ?></h1>

            <?php if ( category_description() ) : // Show an optional category description ?>
                <div class="archive-meta"><?php echo category_description(); ?></div>
            <?php endif; ?>
            </header><!-- .archive-header -->

            <?php while ( have_posts() ) : the_post(); ?>

            <?php get_template_part( 'content', get_post_format() ); ?>

            <?php endwhile; ?>

        <?php else : ?>
            <?php get_template_part( 'content', 'none' ); ?>
        <?php endif; ?>

        </div><!-- #content -->
    </section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer();
