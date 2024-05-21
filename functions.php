<?php

 function kandinskybento_fse_styles() {

    wp_enqueue_style(

        'fse-style',

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

