<?php

 function kandinsky_fse_styles() {

    wp_enqueue_style(

        'fse-style',

        get_stylesheet_uri(),

        array(),

        wp_get_theme()->get( 'Version' )

    );

}

add_action( 'wp_enqueue_scripts', 'kandinsky_fse_styles' );


if ( ! function_exists( 'kandinsky_fse_setup' ) ) {

    function kandinsky_fse_setup() {

        add_theme_support( 'wp-block-styles' );

        add_editor_style( 'style.css' );

    }

}

add_action( 'after_setup_theme', 'kandinsky_fse_setup' );

remove_theme_support( 'core-block-patterns' );

add_filter( 'should_load_remote_block_patterns', '__return_false' );


if ( ! function_exists( 'kandinsky_register_pattern_categories' ) ) {

    function kandinsky_register_pattern_categories() {

        register_block_pattern_category(

            'kandinsky',

            array(

                'label' => __( 'Kandinsky', 'kandinsky' ),

                'description' => __( 'Bento patterns. Use only inside the right column on the main page!', 'kandinsky' ),

            )

        );

    }

}

add_action( 'init', 'kandinsky_register_pattern_categories' );

