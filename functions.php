<?php

function wpskeleton_setup()
{
    wpskeleton_load_theme_textdomain();

    // This theme styles the visual editor with editor-style.css to match the theme style.
    add_editor_style();

    // This theme uses wp_nav_menu() in one location.
    register_nav_menu( 'main', __( 'Main Menu', 'wpskeleton' ) );
}
add_action( 'after_setup_theme', 'wpskeleton_setup' );

/**
 * Make themes available for translation.
 * Translations can be added to the /languages/ directory of each theme.
 * The textdomain used in a theme must match its ID.
 *
 * For example:
 *   In the theme wpskeleton, translations are called using __('My String', 'wpskeleton')
 *   and the translations are written in wp-content/themes/wpskeleton/languages/
 *
 * To translate your strings use the POT Generator plugin.
 * It will generate and compile, for each locale activated in WPML:
 *   wp-content/themes/wpskeleton/languages/wpskeleton.pot
 *   wp-content/themes/wpskeleton/languages/fr_FR.po
 *   wp-content/themes/wpskeleton/languages/fr_FR.mo
 *
 * @uses load_theme_textdomain() For translation/localization support.
 */
function wpskeleton_load_theme_textdomain()
{
    $theme = wp_get_theme();

    do {
        $textdomain = $theme->get_stylesheet();
        load_theme_textdomain( $textdomain, $theme->get_stylesheet_directory() . '/languages' );
    } while ($theme = $theme->parent());
}

/**
 * Outputs HTML page title.
 * Used in wp_head action
 */
function wpskeleton_page_title()
{
        /*
     * Print the <title> tag based on what is being viewed.
     */
    global $page, $paged;

    // $title_settings = get_option('title_tagline');
    $separator = '|';
    $title = wp_title($separator, false, 'right');

    // Add the blog name.
    $title .= get_bloginfo('name');

    // Add the blog description for the home/front page.
    $site_description = get_bloginfo( 'description', 'display' );
    if ( $site_description && ( is_home() || is_front_page() ) )
        $title .= " $separator $site_description";

    // Add a page number if necessary:
    if ( $paged >= 2 || $page >= 2 )
        echo " $separator " . sprintf( __( 'Page %s', 'wpskeleton' ), max( $paged, $page ) );

    $title = apply_filters('wpskeleton_page_title', $title);
    $title = esc_html($title);

    echo "<title>$title</title>\n";
}
add_action('wp_head', 'wpskeleton_page_title', 1);

/**
 * Add meta elements to wp_head
 * Metas must be array containing props => value.
 * Ex:
 *   - array('charset' => 'utf-8')
 *   - array('name' => 'generator', 'content' => 'Wordpress')
 */
function wpskeleton_head_metas()
{
    $metas = array();
    $metas = apply_filters('wpskeleton_head_metas', $metas);

    foreach ($metas as $meta) {
        if (!empty($meta['ie'])) {
            $ie_str = $meta['ie'] === true ? 'if IE' : $meta['ie'];
            unset($meta['ie']);

            echo "<!--[$ie_str]>";
            h('meta', $meta, false);
            echo "<![endif]-->\n";
        } else {
            h('meta', $meta, false);
            echo PHP_EOL;
        }
    }
}
add_action('wp_head', 'wpskeleton_head_metas', 0);

/**
 * @return string representing the content attribute in the meta viewport
 */
function wpskeleton_meta_viewport()
{
    $viewport = array(
        'width' => 'device-width',
    );

    $viewport = apply_filters('wpskeleton_meta_viewport', $viewport);

    $content = array();
    foreach ($viewport as $key => $value) {
        $content[] = "$key=$value";
    }

    return implode(',', $content);
}

function wpskeleton_meta_defaults($metas)
{
    // Remove some existing
    remove_action('wp_head', 'noindex', 1);
    remove_action('wp_head', 'wp_generator');
    if (isset($GLOBALS['sitepress'])) {
        remove_action('wp_head', array($GLOBALS['sitepress'], 'meta_generator_tag'));
    }

    $metas[] = array('charset' => get_bloginfo('charset'));
    $metas[] = array('name' => 'viewport', 'content' => wpskeleton_meta_viewport());

    if ('0' == get_option('blog_public')) {
        $metas[] = array('name' => 'robots', 'content' => 'noindex,nofollow');
    }

    $metas[] = array('http-equiv' => "X-UA-Compatible", 'content' => "IE=edge", 'ie' => true);

    return $metas;
}
add_filter('wpskeleton_head_metas', 'wpskeleton_meta_defaults', 0);

function wpskeleton_link_pingback()
{
    h('link', array('rel' => 'pingback', 'href' => get_bloginfo('pingback_url')));
    echo PHP_EOL;
}
add_action('wp_head', 'wpskeleton_link_pingback');

function wpskeleton_layout_classes($classes)
{
    $layout = get_option('layout');
    if ($layout && isset($layout['layout'])) {
        switch ($layout['layout']) {
            case 'left':
                $classes[] = 'sidebar-left';
                $classes[] = 'sidebar-one';
                break;
            case 'right':
                $classes[] = 'sidebar-right';
                $classes[] = 'sidebar-one';
                break;
            case 'none':
                $classes[] = 'sidebar-none';
                break;
            case 'both':
                $classes[] = 'sidebar-both';
                break;
        }
    }

    return $classes;
}
add_filter('body_class', 'wpskeleton_layout_classes');
