<?php
/**
 * Booking Search Form Field Categories
 *
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/booking/search-form/fields/categories.php.
 *
 * @var YITH_WCBK_Search_Form $search_form
 */

!defined( 'YITH_WCBK' ) && exit;

$booking_tag_args = array(
    'taxonomy'   => 'product_tag',
    'hide_empty' => true,
    'fields'     => 'id=>name'
);

$tags = YITH_WCBK()->wp->get_terms( $booking_tag_args );

if ( !!$tags ):
    ?>
    <tr class="yith-wcbk-booking-search-form-row-tags">
        <td class="yith-wcbk-booking-search-form-label">
            <?php _e( 'Tags', 'yith-booking-for-woocommerce' ); ?>
        </td>
        <td class="yith-wcbk-booking-search-form-input">
            <select name="tags[]" class="yith-wcbk-booking-tags yith-wcbk-select2" multiple>
                <?php foreach ( $tags as $id => $name ): ?>
                    <option value="<?php echo $id ?>"><?php echo $name ?></option>
                <?php endforeach; ?>
            </select>
        </td>
    </tr>

<?php endif; ?>