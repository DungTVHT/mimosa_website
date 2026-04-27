<?php
!defined( 'YITH_WCBK' ) && exit();

?>

<h2><?php _ex( 'Integrations', 'Settings tab title', 'yith-booking-for-woocommerce' ); ?></h2>
<form method="post">
    <div id="yith-wcbk-integrations-tab-wrapper">
        <?php do_action( 'yith_wcbk_integrations_tab_contents' ) ?>
    </div>
</form>
