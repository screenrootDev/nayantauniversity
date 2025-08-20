<?php
/**
 * Header Template for Nayanta University Theme
 *
 * This file contains the header section of the theme, including meta tags, 
 * stylesheets, scripts, logo, and navigation menu.
 *
 * @package Nayanta_University
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=0, viewport-fit=cover">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <!-- Dynamic Page Title -->
    <title><?php if ( is_front_page() || is_home() ) { bloginfo( 'name' );} else { wp_title( '', true, 'right' ); 
        }
        ?></title>



    <!-- Meta Description -->
    <meta name="description" content="<?php bloginfo('description'); ?>">
    <meta property="og:locale" content="English (India)" />
	<meta property="og:type" content="website" />
	<meta property="og:title" content="<?php if (is_front_page()) { echo 'Nayanta University'; } else { echo wp_title('|', true, 'right'); } ?>" />
	<meta property="og:description" content="a multidisciplinary university, in Pune, India" />
	<meta property="og:url" content="<?php echo home_url(add_query_arg(null, null)); ?>" />
	<meta property="og:site_name" content="Nayanta University" />
	<meta property="article:modified_time" content="2025-04-25T07:16:13+00:00" />
	<meta property="og:image" content="<?php echo esc_url(get_site_url()); ?>/wp-content/uploads/2025/04/og-img.jpg" />
	<meta property="og:image:type" content="image/jpeg" />

    <!-- Preconnect and Preload Resources -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <?php if (file_exists(get_template_directory() . '/wp-content/uploads/2025/04/hero-2.jpg')): ?>
        <link rel="preload" as="image" href="<?php echo esc_url(get_site_url() . '/wp-content/uploads/2025/04/hero-2.jpg'); ?>" type="image/jpeg" />
    <?php endif; ?>
    <?php if (file_exists(get_template_directory() . '/wp-content/uploads/2025/04/hero-1.jpg')): ?>
        <link rel="preload" as="image" href="<?php echo esc_url(get_site_url() . '/wp-content/uploads/2025/04/hero-1.jpg'); ?>" type="image/jpeg" />
    <?php endif; ?>
    
    <!-- Favicon -->
    <?php if (get_site_icon_url()): ?>
        <link rel="icon" href="<?php echo esc_url(get_site_icon_url()); ?>" />
    <?php endif; ?>

    <!-- WordPress Head Hook -->
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); // WordPress body open hook ?>
    <div class="container container-width"></div>
    
    <div class="wrapper clearfix">
        <main class="main clearfix">
            <!-- Main Header Section -->
            <header class="header-main compensate-for-scrollbar">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <!-- Logo Section -->
                        <div class="col-auto">
                            <a href="<?php echo esc_url(get_site_url()); ?>" class="logo text-primary">
                                <?php
                                // Get logo fields from theme options
                                $header_logo = get_field('header_logo', 'option'); 
                                $sticky_header_logo = get_field('header_logo_sticky', 'option'); 
                                
                                // Display white logo if available
                                if (!empty($header_logo) && isset($header_logo['url'])): ?>
                                    <img class="white-logo" 
                                         src="<?php echo esc_url($header_logo['url']); ?>" 
                                         alt="<?php esc_attr_e('Nayanta University', 'nayanta'); ?>">
                                <?php endif; 
                                
                                // Display sticky/color logo if available
                                if (!empty($sticky_header_logo) && isset($sticky_header_logo['url'])): ?>
                                    <img class="color-logo" 
                                         src="<?php echo esc_url($sticky_header_logo['url']); ?>" 
                                         alt="<?php esc_attr_e('Nayanta University', 'nayanta'); ?>" 
                                    >
                                <?php endif; ?>
                            </a>
                        </div>
                        
                        <?php 
                        // Only display navigation if not on landing page
                        if (!is_page_template('landing-page.php') && strpos($_SERVER['REQUEST_URI'], '/thankyou') === false): ?>
                            <div class="col">
                                <!-- Mobile Navigation Toggle Buttons -->
                                <div class="row align-items-center justify-content-end d-xl-none">
                                    <!-- <div class="col-auto">
                                        <a href="javascript:void(0)" class="search-toggle">
                                            <i class="icon-search"></i>
                                        </a>
                                    </div> -->
                                    <div class="col-auto">
                                        <a href="javascript:void(0)" class="menu-toggle">
                                            <span class="line"></span>
                                            <span class="line"></span>
                                            <span class="line"></span>
                                        </a>
                                    </div>
                                </div>
                                
                                <!-- Main Navigation -->
                                <?php if (get_post_type() !== 'landing-page') : ?>
    <nav class="main-nav">
        <?php
        $menu_name = 'Header';
        $menu = wp_get_nav_menu_object($menu_name);

        if ($menu && !is_wp_error($menu)) {
            $menu_items = wp_get_nav_menu_items($menu->term_id);

            if ($menu_items && !is_wp_error($menu_items)) {
                // Organize items into a parent-child tree
                $menu_tree = [];
                foreach ($menu_items as $item) {
                    $menu_tree[$item->menu_item_parent][] = $item;
                }

                // Get current URL path for comparison
                $current_path = untrailingslashit(home_url(add_query_arg([], $wp->request ?? '')));

                // Recursive render function
                function render_menu_items($parent_id, $menu_tree, $current_path, $is_sub = false) {
                    if (!isset($menu_tree[$parent_id])) return;
                
                    echo $is_sub ? '<ul class="submenu">' : '<ul class="nav list-unstyled m-0 align-items-center justify-content-end">';
                
                    foreach ($menu_tree[$parent_id] as $item) {
                        $has_children = isset($menu_tree[$item->ID]);
                        $is_external = !empty($item->target);
                        $is_button = strpos($item->classes[0] ?? '', 'btn') !== false;
                
                        $item_url = untrailingslashit(parse_url($item->url, PHP_URL_PATH));
                        $current_url_path = untrailingslashit(parse_url($current_path, PHP_URL_PATH));
                        $is_active = ($item_url === $current_url_path) ? 'active' : '';
                
                        // Only submenu class goes to <li> now
                        $li_class = $has_children ? 'has-submenu' : '';
                        $li_attr = $li_class ? ' class="' . esc_attr($li_class) . '"' : '';
                
                        // Append active class to <a>
                        $link_classes = [];
                        if ($is_button) $link_classes[] = 'btn btn-secondary';
                        if ($is_active) $link_classes[] = 'active';
                
                        $class_attr = !empty($link_classes) ? ' class="' . esc_attr(implode(' ', $link_classes)) . '"' : '';
                        $target_attr = $is_external ? ' target="' . esc_attr($item->target) . '"' : '';
                        $data_text = !$is_button ? ' data-text="' . esc_attr($item->title) . '"' : '';
                
                        echo '<li' . $li_attr . '>';
                        echo '<a href="' . esc_url($item->url) . '"' . $class_attr . $target_attr . $data_text . '>' . esc_html($item->title) . '</a>';
                
                        // Recursively render children
                        if ($has_children) {
                            render_menu_items($item->ID, $menu_tree, $current_path, true);
                        }
                
                        echo '</li>';
                    }
                
                    echo '</ul>';
                }
                
                global $wp;
                $current_path = untrailingslashit(home_url(add_query_arg([], $wp->request ?? '')));

                render_menu_items(0, $menu_tree, $current_path);
            }
        }
        ?>
    </nav>
<?php endif; ?>



                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </header>
            