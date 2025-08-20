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
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, viewport-fit=cover">

    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>
        <?php
        if (is_front_page() || is_home()) {
            bloginfo('name');
        } else {
            wp_title('', true, 'right');
        }
        ?>
    </title>



    <!-- Preconnect and Preload Resources -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- <?php if (file_exists(get_template_directory() . '/wp-content/uploads/2025/04/hero-2.jpg')): ?>
        <link rel="preload" as="image" href="<?php echo esc_url(get_site_url() . '/wp-content/uploads/2025/04/hero-2.jpg'); ?>" type="image/jpeg" />
    <?php endif; ?>
    <?php if (file_exists(get_template_directory() . '/wp-content/uploads/2025/04/hero-1.jpg')): ?>
        <link rel="preload" as="image" href="<?php echo esc_url(get_site_url() . '/wp-content/uploads/2025/04/hero-1.jpg'); ?>" type="image/jpeg" />
    <?php endif; ?> -->

    <!-- Favicon -->
    <?php if (get_site_icon_url()): ?>
        <link rel="icon" href="<?php echo esc_url(get_site_icon_url()); ?>" />
    <?php endif; ?>

    <?php wp_head(); ?>
</head>



<body <?php body_class(); ?>>
    <?php wp_body_open(); // WordPress body open hook 
    ?>
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
                                        alt="<?php esc_attr_e('Nayanta University', 'nayanta'); ?>">
                                <?php endif; ?>
                            </a>
                        </div>

                        <?php
                        // Only display navigation if not landing page or thank you page
                        if (! is_page_template('landing-page.php') && strpos($_SERVER['REQUEST_URI'], '/thankyou') === false) : ?>
                            <div class="col">
                                <!-- Mobile Navigation Toggle Buttons -->
                                <div class="row align-items-center justify-content-end d-xl-none">
                                    <div class="col-auto">
                                        <!-- <a href="javascript:void(0)" class="menu-toggle">
                                            <span class="line"></span>
                                            <span class="line"></span>
                                            <span class="line"></span>
                                        </a> -->
                                        <button class="menu-toggle" type="button" aria-label="Toggle menu">
                                            <span class="line"></span>
                                            <span class="line"></span>
                                            <span class="line"></span>
                                        </button>
                                    </div>
                                </div>

                                <!-- Main Navigation -->
                                <nav class="main-nav">
                                    <?php
                                    $menu_name = 'Header';
                                    $menu = wp_get_nav_menu_object($menu_name);

                                    if ($menu && !is_wp_error($menu)) {
                                        $menu_items = wp_get_nav_menu_items($menu->term_id);

                                        if ($menu_items && !is_wp_error($menu_items)) {

                                            // Build parent → children tree
                                            $menu_tree = [];
                                            foreach ($menu_items as $item) {
                                                $menu_tree[$item->menu_item_parent][] = $item;
                                            }

                                            // --- Utility Functions (guard against redeclare) ---
                                            if (!function_exists('nav_normalize_query')) {
                                                function nav_normalize_query($queryStr)
                                                {
                                                    if (empty($queryStr)) return '';
                                                    parse_str($queryStr, $q);
                                                    ksort($q);
                                                    $normalized = http_build_query($q, '', '&', PHP_QUERY_RFC3986);
                                                    return $normalized === '' ? '' : '?' . $normalized;
                                                }
                                            }

                                            if (!function_exists('nav_site_basepath')) {
                                                function nav_site_basepath()
                                                {
                                                    $p = wp_parse_url(home_url('/'), PHP_URL_PATH);
                                                    return $p ? rtrim($p, '/') . '/' : '/';
                                                }
                                            }

                                            if (!function_exists('nav_normalize_for_compare')) {
                                                function nav_normalize_for_compare($url)
                                                {
                                                    $parts = wp_parse_url($url);
                                                    $path  = isset($parts['path']) ? '/' . ltrim($parts['path'], '/') : '/';
                                                    $path  = rtrim($path, '/');
                                                    if ($path === '') $path = '/';
                                                    $base = nav_site_basepath();
                                                    if ($base !== '/' && strpos($path . '/', $base) === 0) {
                                                        $path = '/' . ltrim(substr($path, strlen(rtrim($base, '/'))), '/');
                                                        if ($path === '//') $path = '/';
                                                    }
                                                    $query = nav_normalize_query(isset($parts['query']) ? $parts['query'] : '');
                                                    return $path . $query;
                                                }
                                            }

                                            if (!function_exists('render_menu_items')) {
                                                function render_menu_items($parent_id, $menu_tree, $current_compare, $home_compare, $is_sub = false)
                                                {
                                                    if (empty($menu_tree[$parent_id])) return false;

                                                    echo $is_sub
                                                        ? '<ul class="submenu">'
                                                        : '<ul class="nav list-unstyled m-0 align-items-center justify-content-end">';

                                                    $any_active_here = false;

                                                    foreach ($menu_tree[$parent_id] as $item) {
                                                        $has_children = !empty($menu_tree[$item->ID]);
                                                        $item_compare = nav_normalize_for_compare($item->url);

                                                        // Fix homepage active state
                                                        // if (is_front_page() || is_home()) {
                                                        //     $is_active = ($item_compare === $home_compare);
                                                        // } else {
                                                        //     $is_active = ($item_compare === $current_compare);
                                                        // }
                                                        if (is_front_page() || is_home()) {
                                                            // Only mark the actual home menu item active, ignore others with "/"
                                                            $is_active = ($item_compare === $home_compare && $item->url === home_url('/'));
                                                        } else {
                                                            $is_active = ($item_compare === $current_compare);
                                                        }
                                                        // Debug: log URL comparisons
                                                        // error_log('Menu debug → Item: ' . $item->title
                                                        //     . ' | item_compare: ' . $item_compare
                                                        //     . ' | current_compare: ' . $current_compare
                                                        //     . ' | home_compare: ' . $home_compare
                                                        //     . ' | is_active: ' . ($is_active ? 'YES' : 'NO'));

                                                        // echo '<script>';
                                                        // echo 'console.log("Menu debug → Item: ' . esc_js($item->title)
                                                        //     . ' | item_compare: ' . esc_js($item_compare)
                                                        //     . ' | current_compare: ' . esc_js($current_compare)
                                                        //     . ' | home_compare: ' . esc_js($home_compare)
                                                        //     . ' | is_active: ' . ($is_active ? 'YES' : 'NO') . '");';
                                                        // echo '</script>';

                                                        // Render children recursively
                                                        $child_active = false;
                                                        $child_html = '';
                                                        if ($has_children) {
                                                            ob_start();
                                                            $child_active = render_menu_items($item->ID, $menu_tree, $current_compare, $home_compare, true);
                                                            $child_html = ob_get_clean();
                                                        }
                                                        if ($child_active) $is_active = true;

                                                        // Build li and a classes
                                                        $li_classes = [];
                                                        if ($has_children) $li_classes[] = 'has-submenu';
                                                        if ($is_active) $li_classes[] = 'active';
                                                        $li_attr = $li_classes ? ' class="' . esc_attr(implode(' ', $li_classes)) . '"' : '';

                                                        $link_classes = [];
                                                        $is_button = !empty($item->classes[0]) && strpos($item->classes[0], 'btn') !== false;
                                                        if ($is_button) $link_classes[] = 'btn btn-secondary';
                                                        if ($is_active) $link_classes[] = 'active';
                                                        $a_class = $link_classes ? ' class="' . esc_attr(implode(' ', $link_classes)) . '"' : '';

                                                        $target_attr = !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';

                                                        // Output menu item
                                                        echo '<li' . $li_attr . '>';
                                                        echo '<a href="' . esc_url($item->url) . '"' . $a_class . $target_attr . ' data-text="' . esc_attr($item->title) . '">'
                                                            . esc_html($item->title) .
                                                            '</a>';
                                                        if ($has_children) echo $child_html;
                                                        echo '</li>';

                                                        if ($is_active) $any_active_here = true;
                                                    }

                                                    echo '</ul>';
                                                    return $any_active_here;
                                                }
                                            }

                                            // Get current and home URL for active comparison
                                            $current_full    = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '/';
                                            $current_compare = nav_normalize_for_compare($current_full);
                                            $home_compare    = nav_normalize_for_compare(home_url('/'));

                                            render_menu_items(0, $menu_tree, $current_compare, $home_compare);
                                        }
                                    }
                                    ?>
                                </nav>
                            </div>
                        <?php endif; ?>




                    </div>
                </div>
            </header>