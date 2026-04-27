<?php
/**
 * Template options in WC Product Panel
 *
 * @author  Yithemes
 * @package YITH Booking and Appointment for WooCommerce Premium
 * @version 1.0.0
 * @var array  $price_rules
 * @var string $field_name
 */
!defined( 'YITH_WCBK' ) && exit; // Exit if accessed directly

?>
<div class="yith-wcbk-price-rules">
    <div class="yith-wcbk-settings-section-box__sortable-container yith-wcbk-price-rules__list">
        <?php foreach ( $price_rules as $index => $price_rule ) {
            yith_wcbk_get_view( 'product-tabs/utility/html-price-rule.php', compact( 'field_name', 'index', 'price_rule' ) );
        } ?>
    </div>
    <div class="yith-wcbk-settings-section__content__actions">
        <span class="yith-wcbk-admin-button yith-wcbk-admin-button--secondary yith-wcbk-admin-button--plus yith-wcbk-price-rules__new-rule" data-template="<?php
        $index      = '{{INDEX}}';
        $price_rule = new YITH_WCBK_Price_Rule();
        ob_start();
        yith_wcbk_get_view( 'product-tabs/utility/html-price-rule.php', compact( 'field_name', 'index', 'price_rule' ) );
        echo esc_attr( ob_get_clean() );
        ?>"><?php _e( 'Add new rule', 'yith-booking-for-woocommerce' ); ?></span>
    </div>

    <script type="text/html" id="tmpl-yith-wcbk-price-rule-condition">
        <?php
        $index            = "{{data.ruleIndex}}";
        $condition_index  = "{{data.conditionIndex}}";
        $_field_name      = "{$field_name}[{$index}]";
        $_field_id_prefix = "{$field_name}-id--{$index}__";
        $condition        = array( 'type' => 'custom', 'from' => '', 'to' => '' );;

        yith_wcbk_get_view( 'product-tabs/utility/html-price-rule-condition.php', array(
            'condition'                 => $condition,
            'index'                     => $index,
            'condition_index'           => $condition_index,
            'condition_type'            => $condition[ 'type' ],
            'condition_from'            => $condition[ 'from' ],
            'condition_to'              => $condition[ 'to' ],
            'condition_field_name'      => $_field_name . '[conditions][' . $condition_index . ']',
            'condition_field_id_prefix' => $_field_id_prefix . "condition-{$condition_index}__",
        ) );
        ?>
    </script>
</div>
