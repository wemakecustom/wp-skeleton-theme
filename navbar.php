    <header id="navbar" role="banner">
        <hgroup>
            <h1 id="site-title"><span><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></span></h1>
            <h2 id="site-description"><?php bloginfo( 'description' ); ?></h2>
        </hgroup>
        <nav id="menu-main" role="navigation">
            <?php wp_nav_menu( array( 'theme_location' => 'main' ) ); ?>
        </nav>
    </header>
