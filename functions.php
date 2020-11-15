<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

function my_child_theme_locale() {
    load_child_theme_textdomain( 'kale', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'my_child_theme_locale' );

/*------------------------------
 Top Navigation
 ------------------------------*/

#add search form to nav
function jummys_kale_nav_items_wrap() {
    // default value of 'items_wrap' is <ul id="%1$s" class="%2$s">%3$s</ul>'
    // open the <ul>, set 'menu_class' and 'menu_id' values
    $wrap  = '<ul id="%1$s" class="%2$s">';
    // get nav items as configured in /wp-admin/
    $wrap .= '%3$s';
    // the static link
    $wrap .= jummys_kale_get_nav_search_item();
    // close the <ul>
    $wrap .= '</ul>';
    // return the result
    return $wrap;
}

function jummys_kale_get_nav_search_item(){
    return '<li class="search">' .
		do_shortcode('[wpdreams_ajaxsearchlite]') .
	/*
        <a href="javascript:;" id="toggle-main_search" data-toggle="dropdown"><i class="fa fa-search"></i></a>
        <div class="dropdown-menu main_search">
            <form name="main_search" method="get" action="'.esc_url(home_url( '/' )).'">
                <input type="text" name="s" class="form-control" placeholder="'. esc_attr(__('Type here','kale')).'" />
            </form>
        </div>*/
    '</li>';
}

#default nav top level pages
function jummys_kale_default_nav(){
    echo '<div class="navbar-collapse collapse">';
    echo '<ul class="nav navbar-nav">';
    $pages = get_pages();
    $n = count($pages);
    $i=0;
    foreach ( $pages as $page ) {
        $menu_name = esc_html($page->post_title);
        $menu_link = get_page_link( $page->ID );
        if(get_the_ID() == $page->ID) $current_class = "current_page_item current-menu-item";
        else { $current_class = ''; }
        $menu_class = "page-item-" . $page->ID;
        echo "<li class='page_item ".esc_attr($menu_class)." $current_class'><a href='".esc_url($menu_link)."'>".esc_html($menu_name)."</a></li>";
        $i++;
        if($n == $i){
            echo jummys_kale_get_nav_search_item();
        }
    }
    echo '</ul>';
    echo '</div>';
}
