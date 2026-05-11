<?php
/**
 * The template for displaying product content within loops
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}

$out_of_stock = get_post_meta( $post->ID, '_stock_status', true ) == 'outofstock';

$classes   = array( 'product-small', 'col', 'has-hover' );
if ( $out_of_stock ) $classes[] = 'out-of-stock';

// Custom fields
$loai      = get_field( 'loai_san_pham' );
$thoi_gian = get_field( 'thoi_gian' );
$di_chuyen = get_field( 'di_chuyen' );
$dia_chi   = get_field( 'dia_chi' );

// Location: dùng noi_khoi_hanh nếu có, fallback sang di_chuyen hoặc dia_chi
$location = get_field( 'noi_khoi_hanh' );
if ( ! $location ) {
	if ( $loai == 'Khách sạn' ) {
		$location = $dia_chi;
	} else {
		$location = $di_chuyen;
	}
}

// Badge từ category
$badge = '';
$categories = get_the_terms( get_the_ID(), 'product_cat' );
if ( $categories && ! is_wp_error( $categories ) ) {
	$badge = $categories[0]->name;
	foreach ( $categories as $cat ) {
		if ( $cat->parent != 0 ) { $badge = $cat->name; break; }
	}
}
if ( ! $badge && $loai ) {
	$badge = ( $loai == 'Tour du lịch' ) ? 'Tour' : $loai;
}

// Giá hiển thị
$gia_giam = Gia_giam();
$gia_goc  = Gia_goc();
if ( $gia_giam != 0 ) {
	$gia_hien_thi = $gia_giam;
} elseif ( $gia_goc != 0 ) {
	$gia_hien_thi = $gia_goc;
} else {
	$gia_hien_thi = (float) $product->get_price();
}
?>

<div <?php fl_woocommerce_version_check( '3.4.0' ) ? wc_product_class( $classes, $product ) : post_class( $classes ); ?>>
<div class="col-inner">

<div class="tour-card-new">

	<div class="tour-card-image">
		<a href="<?php echo esc_url( get_the_permalink() ); ?>">
			<?php echo $product->get_image( 'woocommerce_thumbnail', array( 'class' => 'tour-card-img' ) ); ?>
		</a>

		<?php if ( $badge ) : ?>
		<span class="tour-card-badge"><?php echo esc_html( $badge ); ?></span>
		<?php endif; ?>

		<a href="<?php echo esc_url( get_the_permalink() ); ?>" class="tour-card-quickview">
			<i class="fa fa-eye" aria-hidden="true"></i> Xem nhanh
		</a>

		<?php if ( $out_of_stock ) : ?>
		<div class="tour-card-oos"><?php _e( 'Hết chỗ', 'woocommerce' ); ?></div>
		<?php endif; ?>
	</div>

	<div class="tour-card-body">

		<h3 class="tour-card-title">
			<a href="<?php echo esc_url( get_the_permalink() ); ?>"><?php the_title(); ?></a>
		</h3>

		<div class="tour-card-meta">
			<span class="tour-card-meta-item tour-card-location">
				<?php if ( $location ) : ?>
				<i class="fa fa-map-marker" aria-hidden="true"></i>
				<?php echo esc_html( $location ); ?>
				<?php endif; ?>
			</span>
			<?php if ( $thoi_gian ) : ?>
			<span class="tour-card-meta-item tour-card-duration">
				<i class="fa fa-clock-o" aria-hidden="true"></i>
				<?php echo esc_html( $thoi_gian ); ?>
			</span>
			<?php endif; ?>
		</div>

		<div class="tour-card-footer">
			<div class="tour-card-price">
				<span class="tour-card-price-label">Giá từ:</span>
				<strong class="tour-card-price-amount"><?php echo number_format( $gia_hien_thi ); ?>đ</strong>
			</div>
			<a href="<?php echo esc_url( get_the_permalink() ); ?>" class="tour-card-detail-btn">Xem chi tiết</a>
		</div>

	</div>

</div>

</div>
</div>
