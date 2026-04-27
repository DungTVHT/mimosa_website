<?php
/**
 * Template options in WC Product Panel
 *
 * @var array $extra_costs The product extra costs
 */
!defined( 'YITH_WCBK' ) && exit; // Exit if accessed directly

$global_extra_cost_ids = YITH_WCBK()->extra_cost_helper->get_extra_costs();

?>

<div id="yith-wcbk-extra-costs__list">
    <?php

    foreach ( $global_extra_cost_ids as $extra_cost_id ) {
        $extra_cost_args = isset( $extra_costs[ $extra_cost_id ] ) ? $extra_costs[ $extra_cost_id ] : array( 'id' => $extra_cost_id );
        $extra_cost      = yith_wcbk_product_extra_cost( $extra_cost_args );

        yith_wcbk_get_view( 'product-tabs/utility/html-extra-cost.php', compact( 'extra_cost' ) );
    }

    ?>
</div>

<div class="yith-wcbk-settings-section__content__actions">
    <?php if ( current_user_can( 'create_' . YITH_WCBK_Post_Types::$extra_cost . 's' ) && current_user_can( 'edit_' . YITH_WCBK_Post_Types::$extra_cost . 's' ) ): ?>
        <span id="yith-wcbk-extra-costs__create-btn" class="yith-wcbk-admin-button yith-wcbk-admin-button--secondary yith-wcbk-admin-button--plus"><?php _e( 'Add a new cost', 'yith-booking-for-woocommerce' ) ?></span>


        <div id="yith-wcbk-extra-costs__create" class="yith-wcbk-settings-section-box yith-wcbk-settings-section-box--no-toggle">
            <div class="yith-wcbk-settings-section-box__title">
                <h3><?php _e( 'Add a new cost', 'yith-booking-for-woocommerce' ) ?></h3>
            </div>
            <div class="yith-wcbk-settings-section-box__content">

                <?php
                yith_wcbk_product_metabox_form_field( array(
                                                          'title'  => __( 'Extra cost name', 'yith-booking-for-woocommerce' ),
                                                          'fields' => array(
                                                              array(
                                                                  'type'  => 'text',
                                                                  'value' => '',
                                                                  'class' => 'yith-wcbk-fake-form-field',
                                                                  'data'  => array(
                                                                      'name'     => 'title',
                                                                      'required' => 'yes',
                                                                  )
                                                              )
                                                          )
                                                      ) );


                ?>

                <input type="hidden" class="yith-wcbk-fake-form-field" data-name="security" value="<?php echo wp_create_nonce( 'create-extra-cost' ) ?>">

                <div class="yith-wcbk-settings-section-box__content__actions yith-wcbk-right">
                    <span class="yith-wcbk-admin-button yith-wcbk-admin-button--secondary yith-wcbk-extra-costs__create-submit"><?php _e( 'Create', 'yith-booking-for-woocommerce' ) ?></span>
                </div>
            </div>
        </div>

        <script type="text/html" id="tmpl-yith-wcbk-extra-cost-row">
            <?php
            $extra_cost_id    = "{{ data.id }}";
            $extra_cost_title = "{{ data.title }}";
            $extra_cost_args  = array( 'id' => 0 );
            $extra_cost       = yith_wcbk_product_extra_cost( $extra_cost_args );
            yith_wcbk_get_view( 'product-tabs/utility/html-extra-cost.php', compact( 'extra_cost', 'extra_cost_id', 'extra_cost_title' ) );
            ?>
        </script>
    <?php endif; ?>
</div>