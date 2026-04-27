<?php
!defined( 'ABSPATH' ) && exit; // Exit if accessed directly

/**
 * Class YITH_WCBK_Deposits_Integration
 *
 * @author  Leanza Francesco <leanzafrancesco@gmail.com>
 * @since   1.0.1
 */
class YITH_WCBK_Deposits_Integration extends YITH_WCBK_Integration {
    /** @var YITH_WCBK_Deposits_Integration */
    protected static $_instance;

    /**
     * Constructor
     *
     * @param bool $plugin_active
     * @param bool $integration_active
     * @access protected
     */
    protected function __construct( $plugin_active, $integration_active ) {
        parent::__construct( $plugin_active, $integration_active );

        if ( $this->is_active() ) {
            add_filter( 'yith_wcdp_is_deposit_enabled_on_product', array( $this, 'disable_deposit_on_bookings_requiring_confirmation' ), 10, 2 );

            add_action( 'yith_wcdp_booking_add_to_cart', array( $this, 'add_deposit_to_booking' ) );

            add_filter( 'yith_wcbk_product_form_get_booking_data', array( $this, 'add_deposit_price_to_booking_data' ), 10, 2 );

            add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
        }
    }

    /**
     * Disable deposits on booking products that requires confirmation
     *
     * @param bool $enabled
     * @param int  $product_id
     * @return bool
     * @since 2.1
     */
    public function disable_deposit_on_bookings_requiring_confirmation( $enabled, $product_id ) {
        /** @var WC_Product_Booking $product */
        $product = wc_get_product( $product_id );
        if ( $product && yith_wcbk_is_booking_product( $product ) && $product->is_confirmation_required() ) {
            $enabled = false;
        }
        return $enabled;
    }

    /**
     * @param array              $booking_data
     * @param WC_Product_Booking $product
     * @return array
     */
    public function add_deposit_price_to_booking_data( $booking_data, $product ) {
        $price              = $product->calculate_price( $_POST );
        $deposit_price      = YITH_WCDP_Premium()->get_deposit( yit_get_base_product_id( $product ), $price );
        $deposit_price_html = wc_price( $deposit_price );

        $booking_data[ 'deposit_price' ] = $deposit_price_html;

        return $booking_data;
    }

    /**
     * Add Deposits to Booking Products
     *
     * @param WC_Product_Booking $product
     */
    public function add_deposit_to_booking( $product ) {
        if ( !$product->is_confirmation_required() ) {
            add_action( 'woocommerce_before_add_to_cart_button', array( YITH_WCDP_Frontend_Premium(), 'print_single_add_deposit_to_cart_template' ) );
        }
    }

    /**
     * Enqueue scripts
     */
    public function enqueue_scripts() {
        $suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
        wp_register_script( 'yith-wcbk-integration-deposits-booking-form', YITH_WCBK_ASSETS_URL . '/js/integrations/deposits/deposits-booking-form' . $suffix . '.js', array( 'jquery' ), YITH_WCBK_VERSION, true );

        wp_enqueue_script( 'yith-wcbk-integration-deposits-booking-form' );

    }

}