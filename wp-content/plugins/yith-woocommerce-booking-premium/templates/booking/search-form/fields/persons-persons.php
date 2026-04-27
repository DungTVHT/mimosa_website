<?php
/**
 * Booking Search Form Field Persons
 *
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/booking/search-form/fields/persons-persons.php.
 *
 * @var YITH_WCBK_Search_Form $search_form
 */

!defined( 'YITH_WCBK' ) && exit;
?>

<tr class="yith-wcbk-booking-search-form-row-persons">
    <td class="yith-wcbk-booking-search-form-label">
        <?php _e( 'People', 'yith-booking-for-woocommerce' ); ?>
    </td>
    <td class="yith-wcbk-booking-search-form-input">
        <input type="number" class="yith-wcbk-booking-field" name="persons" min="0" step="1" />
    </td>
</tr>