<?php
/**
 * Booking Search Form Field Person Types
 *
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/booking/search-form/fields/persons-person-types.php.
 *
 * @var YITH_WCBK_Search_Form $search_form
 */

!defined( 'YITH_WCBK' ) && exit;

$person_types = YITH_WCBK()->person_type_helper->get_person_type_ids();
?>

<?php if ( $person_types && is_array( $person_types ) ) : ?>
    <?php foreach ( $person_types as $id ) : ?>

        <tr class="yith-wcbk-booking-search-form-row-person-types yith-wcbk-booking-search-form-row-person-type-<?php echo $id ?>">
            <td class="yith-wcbk-booking-search-form-label">
                <?php echo get_the_title( $id ) ?>
            </td>
            <td class="yith-wcbk-booking-search-form-input">
                <input type="number" class="yith-wcbk-booking-person-types yith-wcbk-booking-field" name="person_types[<?php echo $id ?>]" min="0" step="1"
                       data-person-type-id="<?php echo $id ?>"/>
            </td>
        </tr>
    <?php endforeach; ?>
<?php endif; ?>
