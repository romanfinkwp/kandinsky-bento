<?php

 function kandinskybento_fse_styles() {

    wp_enqueue_style(

        'kandinsky-bento-style',

        get_stylesheet_uri(),

        array(),

        wp_get_theme()->get( 'Version' )

    );

}

add_action( 'wp_enqueue_scripts', 'kandinskybento_fse_styles' );


if ( ! function_exists( 'kandinskybento_fse_setup' ) ) {

    function kandinskybento_fse_setup() {

        add_theme_support( 'wp-block-styles' );

        add_editor_style( 'style.css' );

    }

}

add_action( 'after_setup_theme', 'kandinskybento_fse_setup' );

remove_theme_support( 'core-block-patterns' );

add_filter( 'should_load_remote_block_patterns', '__return_false' );


if ( ! function_exists( 'kandinskybento_register_pattern_categories' ) ) {

    function kandinskybento_register_pattern_categories() {

        register_block_pattern_category(

            'kandinsky',

            array(

                'label' => __( 'Kandinsky', 'kandinsky-bento' ),

                'description' => __( 'Bento patterns. Use only inside the right column on the main page!', 'kandinsky-bento' ),

            )

        );

    }

}

add_action( 'init', 'kandinskybento_register_pattern_categories' );

function kandinskybento_setup_notice() {
    $notice_option_name = 'kandinskybento_setup_notice_dismissed';
    $is_dismissed = get_option( $notice_option_name );

    if ( ! $is_dismissed && current_user_can( 'edit_theme_options' ) ) {
        $image_url = get_template_directory_uri() . '/assets/img/me.png';
        $notice_text = '<img src="' . esc_url( $image_url ) . '" alt="' . esc_attr__( 'Roman Fink, the theme author', 'kandinsky-bento' ) . '" style="max-width: 100%;" />
        <div class="kandinskybento-notice-text">
        <h3 style="margin-top: 0px">'.__('Hi, I\'m Roman Fink, the developer of the Kandinsky Bento theme. I hope this theme helps you build your great website','kandinsky-bento').' 😉</h3>
        👉 '.__('If you enjoy using this theme, please take a moment to rate it on the WordPress repository:','kandinsky-bento').' <a href="https://wordpress.org/support/theme/kandinsky-bento/reviews/#new-post">'.__('Rate theme.','kandinsky-bento').'</a><br>
        <p style="margin: 5px 0 0;"><b>'.__('Just close this notice to hide it. All the best!','kandinsky-bento').'</b></p></div>';
        echo '<div id="kandinskybento-notice" class="notice notice-info is-dismissible">' . wp_kses_post( $notice_text ) . '</div>';
    }
}

add_action( 'admin_notices', 'kandinskybento_setup_notice' );


function kandinskybento_notice_script() {
    if ( ! wp_script_is( 'jquery', 'done' ) ) {
        wp_enqueue_script( 'jquery' );
    }

    wp_enqueue_script( 'kandinskybento-notice-script', get_template_directory_uri() . '/assets/js/admin-notice.js', array( 'jquery' ), wp_get_theme()->get( 'Version' ), true );
    wp_localize_script( 'kandinskybento-notice-script', 'kandinskybentoNotice', array( 'nonce' => wp_create_nonce( 'kandinskybento_dismiss_notice' ) ) );
}

add_action( 'admin_enqueue_scripts', 'kandinskybento_notice_script' );


function kandinskybento_enqueue_admin_styles() {
    $notice_option_name = 'kandinskybento_setup_notice_dismissed';
    $is_dismissed = get_option( $notice_option_name );
    if ( ! $is_dismissed ) {
        wp_enqueue_style( 'kandinskybento-admin-notice', get_template_directory_uri() . '/assets/css/admin-notice.css' );
    }
}

add_action( 'admin_enqueue_scripts', 'kandinskybento_enqueue_admin_styles' );


function kandinskybento_dismiss_notice() {
    check_ajax_referer( 'kandinskybento_dismiss_notice', 'nonce' );
    if ( current_user_can( 'edit_theme_options' ) ) {
        update_option( 'kandinskybento_setup_notice_dismissed', true );
    }
    wp_die();
}

add_action( 'wp_ajax_kandinskybento_dismiss_notice', 'kandinskybento_dismiss_notice' );

