<?php
/**
 * Format price
 */
function willgroup_format_price($price) {
   return number_format($price, 0, '', ',') . ' đ';
}

/**
 * Add child price to tab general product
 */
add_action( 'woocommerce_product_options_general_product_data', function() {
	$args = array(
		'id' 		  => 'product_child_price',
		'label' 	  => __( 'Giá trẻ em', 'willgroup' ),
	);
	woocommerce_wp_text_input( $args );

	$args = array(
		'id' 		  => 'product_infant_price',
		'label' 	  => __( 'Giá em bé', 'willgroup' ),
	);
	woocommerce_wp_text_input( $args );
});

/**
 * Save child price to tab general product
 */
add_action( 'woocommerce_process_product_meta', function($post_id) {
	$product = wc_get_product( $post_id );

	$value = isset( $_POST['product_child_price'] ) ? $_POST['product_child_price'] : 0;
	$product->update_meta_data( 'product_child_price', sanitize_text_field($value) );
	$product->save();

	$value = isset( $_POST['product_infant_price'] ) ? $_POST['product_infant_price'] : 0;
	$product->update_meta_data( 'product_infant_price', sanitize_text_field($value) );
	$product->save();
});

/**
 * Add product_cat field group
 */
if( function_exists('acf_add_local_field_group') ) {
	
	acf_add_local_field_group(	array(
		'key'		=> 'product_cat_settings',
		'fields' 	=> array (
			array (
				'key' 		    => 'product_cat_hide_book_tour',
				'label'		    => __( 'Ẩn đặt tour', 'willgroup' ),
				'name' 		    => 'product_cat_hide_book_tour',
				'type' 		    => 'true_false',
			),
		),
		'location' => array (
			array (
				array (
					'param'    => 'taxonomy',
					'operator' => '==',
					'value'    => 'product_cat',
				),
			),
		),
		'position' => 'normal',
		'label_placement' => 'left',
	));
}