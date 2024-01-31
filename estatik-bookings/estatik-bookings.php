<?php
/*
Plugin Name: Estatik Bookings
Description: Custom plugin for booking management.
Version: 1.0
Author: Sviatoslav
*/

//custom post type
function estatik_create_booking_post_type() {
    register_post_type('booking',
        array(
            'labels' => array(
                'name' => __('Bookings'),
                'singular_name' => __('Booking'),
            ),
            'public' => true,
            'has_archive' => true,
            'supports' => array('title', 'editor'),
        )
    );
}
add_action('init', 'estatik_create_booking_post_type');

//metabox and custom fields
function estatik_booking_metabox() {
    add_meta_box(
        'estatik_booking_metabox',
        'Booking Details',
        'estatik_booking_metabox_callback',
        'booking',
        'normal',
        'default'
    );
}
add_action('add_meta_boxes', 'estatik_booking_metabox');

function estatik_booking_metabox_callback($post) {
    include(plugin_dir_path(__FILE__) . 'metabox-template.php');
}


//saving fields value
function estatik_save_booking_fields($post_id) {
    if (isset($_POST['start_date'])) {
        $start_date = sanitize_text_field($_POST['start_date']);
        update_post_meta($post_id, '_start_date', strtotime($start_date));
    }

    if (isset($_POST['end_date'])) {
        $end_date = sanitize_text_field($_POST['end_date']);
        update_post_meta($post_id, '_end_date', strtotime($end_date));
    }

    if (isset($_POST['address'])) {
        $address = sanitize_text_field($_POST['address']);
        update_post_meta($post_id, '_address', $address);
    }
}

add_action('save_post', 'estatik_save_booking_fields');

function estatik_enqueue_scripts() {
    wp_enqueue_script('jquery-ui-datepicker');
    wp_enqueue_style('jquery-ui-datepicker-style', 'https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css');
    wp_enqueue_script('estatik-datepicker-init', plugin_dir_url(__FILE__) . 'datepicker-init.js', array('jquery', 'jquery-ui-datepicker'), '1.0', true);
}
add_action('admin_enqueue_scripts', 'estatik_enqueue_scripts');










?>