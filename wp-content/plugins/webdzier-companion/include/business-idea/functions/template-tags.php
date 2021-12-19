<?php 
function business_idea_plugin_page_setup( $default_settings ) {
   $default_settings['parent_slug'] = 'themes.php';
   $default_settings['page_title']  = esc_html__( 'Business Idea Data' , 'business-idea' );
   $default_settings['menu_title']  = esc_html__( 'Import Demo Data' , 'business-idea' );
   $default_settings['capability']  = 'import';
   $default_settings['menu_slug']   = 'pt-one-click-demo-import';
   return $default_settings;
}
add_filter( 'pt-ocdi/plugin_page_setup', 'business_idea_plugin_page_setup' );

function business_idea_after_import_setup() {

    $main_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );

    set_theme_mod( 'nav_menu_locations', array(
            'primary' => $main_menu->term_id,
        )
    );

    $front_page_id = get_page_by_title( 'Home' );
    $blog_page_id  = get_page_by_title( 'Blog' );

    update_option( 'show_on_front', 'page' );
    update_option( 'page_on_front', $front_page_id->ID );
    update_option( 'page_for_posts', $blog_page_id->ID );
}
add_action( 'pt-ocdi/after_import', 'business_idea_after_import_setup' );

function business_idea_import_files() {
    return array(
        array(
            'import_file_name'           => 'Business Idea',
            'import_file_url'            => 'https://raw.githubusercontent.com/webdzier/business-idea-lite-demo/master/theme-contents.xml',
            'import_widget_file_url'     => 'https://raw.githubusercontent.com/webdzier/business-idea-lite-demo/master/theme-widgets.wie',
            'import_customizer_file_url' => 'https://raw.githubusercontent.com/webdzier/business-idea-lite-demo/master/theme-customizer-settings.dat',
        
            'import_preview_image_url'   => get_template_directory_uri() . '/screenshot.png',
            'import_notice'              => __( 'Please click on below "Import Demo Data" button to import theme contents, After you import this demo, Enjoy our <strong>Business Idea</strong> theme.', 'business-idea' ),
            'preview_url'                => 'http://www.webdzier.com/',
        ),
		 
    );
}
add_filter( 'pt-ocdi/import_files', 'business_idea_import_files' );