<?php
/**
 * Plugin Name: WooCommerce Birthday Discount
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

if ( ! class_exists( 'WC_Birthday_Discount' ) ) :

class WC_Birthday_Discount {
    
    public function __construct() {
        add_action( 'wp', array( $this, 'birthday_discount' ) );
    }

    public function birthday_discount() {
        $users = get_users();

        foreach ( $users as $user ) {
            $user_id = $user->ID;
            $user_birthday = get_user_meta( $user_id, 'birthday', true ); // Assuming you're saving birthdays as user meta

            if ( $user_birthday ) {
                $birthday = date( 'm-d', strtotime( $user_birthday ) );
                $today = date( 'm-d' );

                if ( $birthday == $today ) {
                    $discount_code = $this->generate_discount_code( $user_id );
                    $this->send_discount_email( $user->user_email, $discount_code );
                }
            }
        }
    }

    public function generate_discount_code( $user_id ) {
        $discount_code = 'BDAY' . $user_id . '_' . date( 'Ymd' ); // Example discount code

        $coupon = array(
            'post_title'   => $discount_code,
            'post_content' => '',
            'post_status'  => 'publish',
            'post_author'  => 1,
            'post_type'    => 'shop_coupon'
        );

        $new_coupon_id = wp_insert_post( $coupon );

        update_post_meta( $new_coupon_id, 'discount_type', 'percent' );
        update_post_meta( $new_coupon_id, 'coupon_amount', 15 );
        update_post_meta( $new_coupon_id, 'individual_use', 'yes' );
        update_post_meta( $new_coupon_id, 'usage_limit', 1 );
        update_post_meta( $new_coupon_id, 'expiry_date', date( 'Y-m-d', strtotime( '+1 month' ) ) );

        return $discount_code;
    }

    public function send_discount_email( $email, $discount_code ) {
        $subject = 'Happy Birthday! Here\'s a special gift for you';
        $message = 'To celebrate your birthday, we\'re giving you a special 15% discount code: ' . $discount_code . '. This code is valid for one order only and expires in one month. Enjoy!';

        wp_mail( $email, $subject, $message );
    }
}

endif;

function wc_birthday_discount() {
    new WC_Birthday_Discount();
}

add_action( 'plugins_loaded', 'wc_birthday_discount' );
