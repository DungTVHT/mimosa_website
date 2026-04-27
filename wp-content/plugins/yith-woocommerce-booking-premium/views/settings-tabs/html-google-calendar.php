<?php
!defined( 'YITH_WCBK' ) && exit();
$google_calendar = YITH_WCBK_Google_Calendar::get_instance();

if ( isset( $_GET[ 'updated' ] ) ) {
    $message = !!$_GET[ 'updated' ] ? sprintf( __( 'Google Calendar: %s bookings updated!', 'yith-booking-for-woocommerce' ), $_GET[ 'updated' ] ) : __( 'Google Calendar: no booking to update!', 'yith-booking-for-woocommerce' );
    echo "<div id='message' class='updated notice is-dismissible'><p>{$message}</p></div>";
}

?>

<h2><?php _ex( 'Google Calendar', 'Settings tab title', 'yith-booking-for-woocommerce' ); ?></h2>
<div id="yith-wcbk-settings-tab-wrapper" class="google-calendar">
    <div class="yith-wcbk-settings-content">
        <?php $google_calendar->display() ?>
    </div>
</div>
<div id="yith-wcbk-settings-tab-google-calendar-secondary-panel">
    <div class="yith-wcbk-settings-content">
        <h3><?php _e( 'Settings', 'yith-booking-for-woocommerce' ) ?></h3>
        <form method="POST">
            <input type="hidden" name="yith-wcbk-google-calendar-action" value="save-settings">
            <?php echo $google_calendar->get_nonce() ?>
            <table class="striped">
                <tr>
                    <th>
                        <?php _e( 'Debug', 'yith-booking-for-woocommerce' ) ?>
                        <span class="description"><?php _e( 'select to enable debug', 'yith-booking-for-woocommerce' ) ?></span>
                    </th>
                    <td>
                        <?php $is_debug = $google_calendar->is_debug() ?>
                        <label class="yith-wcbk-switch">
                            <input type="checkbox" value="yes" name="settings[debug]" <?php checked( $is_debug ) ?>/>
                            <span class="yith-wcbk-switch-slider">&nbsp;</span>
                        </label>
                    </td>
                </tr>

                <tr>
                    <th>
                        <?php _e( 'Synchronize', 'yith-booking-for-woocommerce' ) ?>
                    </th>
                    <td>
                        <?php
                        $synchronize_settings  = array(
                            'creation'      => __( 'on booking creation', 'yith-booking-for-woocommerce' ),
                            'update'        => __( 'on booking update', 'yith-booking-for-woocommerce' ),
                            'status-update' => __( 'on booking status update', 'yith-booking-for-woocommerce' ),
                        );
                        $events_to_synchronize = $google_calendar->get_booking_events_to_synchronize();
                        ?>

                        <div id="yith-wcbk-google-calendar-settings-synchronize-booking-events-container">
                            <?php foreach ( $synchronize_settings as $key => $label ) : ?>
                                <div>
                                    <?php echo $label ?>
                                    <label class="yith-wcbk-switch">
                                        <input type="checkbox"
                                               name="settings[booking-events-to-synchronize][]" value="<?php echo esc_attr( $key ) ?>" <?php checked( in_array( $key, $events_to_synchronize ) ) ?>/>
                                        <span class="yith-wcbk-switch-slider">&nbsp;</span>
                                    </label>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </td>
                </tr>

                <tr>
                    <th>
                        <?php _e( 'Add note on sync', 'yith-booking-for-woocommerce' ) ?>
                        <span class="description"><?php _e( 'select to enable adding note to bookings on Google Calendar sync', 'yith-booking-for-woocommerce' ) ?></span>
                    </th>
                    <td>
                        <?php $add_note_on_sync_enabled = $google_calendar->is_add_note_on_sync_enabled(); ?>
                        <label class="yith-wcbk-switch">
                            <input type="checkbox" value="yes" name="settings[add-note-on-sync]" <?php checked( $add_note_on_sync_enabled ) ?>/>
                            <span class="yith-wcbk-switch-slider">&nbsp;</span>
                        </label>
                    </td>
                </tr>

                <tr>
                    <th></th>
                    <td>
                        <input type="submit" class="yith-wcbk-google-calendar-button" value="<?php _e( 'Save Settings', 'yith-booking-for-woocommerce' ) ?>">
                    </td>
                </tr>
            </table>
        </form>

        <?php if ( $google_calendar && $google_calendar->is_calendar_sync_enabled() ) :
            $actions = array(
                array(
                    'title' => __( 'Syncronize not syncronized bookings', 'yith-booking-for-woocommerce' ),
                    'label' => __( 'Sync bookings', 'yith-booking-for-woocommerce' ),
                    'url'   => YITH_WCBK()->google_calendar_sync->get_action_url( 'sync-new-bookings' )
                ),
                array(
                    'title' => __( 'Syncronize all bookings (Force)', 'yith-booking-for-woocommerce' ),
                    'label' => __( 'Force sync bookings', 'yith-booking-for-woocommerce' ),
                    'url'   => YITH_WCBK()->google_calendar_sync->get_action_url( 'force-sync-all-bookings' )
                )
            );
            ?>
            <h3><?php _e( 'Actions', 'yith-booking-for-woocommerce' ) ?></h3>
            <table class="striped">
                <?php
                foreach ( $actions as $action ) {
                    extract( $action );
                    /**
                     * @var $title
                     * @var $label
                     * @var $url
                     */
                    echo "<tr><th>$title</th><td><a href='$url' class='yith-wcbk-google-calendar-button'>$label</a></td></tr>";
                }

                ?>
            </table>
        <?php endif; ?>
    </div>

</div>
