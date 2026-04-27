<?php
function willgroup_init_book_tour() {
	// Add book_tour post type
	register_post_type( 'book_tour',
		array ( 
			'labels' => array(
				'name' 				=> __( 'Đặt tour', 'willgroup' ),
				'singular_name' 	=> __( 'Đặt tour', 'willgroup' ),
				'menu_name' 		=> __( 'Đặt tour', 'willgroup' ),
				'name_admin_bar'    => __( 'Đặt tour', 'willgroup' ),
				'all_items'			=> __( 'Tất cả Đặt tour', 'willgroup' ),
				'add_new' 			=> __( 'Thêm Đặt tour', 'willgroup' ),
				'add_new_item' 		=> __( 'Thêm Đặt tour', 'willgroup' ),
				'edit_item' 		=> __( 'Sửa Đặt tour', 'willgroup' ),
			),
			'description' 		=> __( 'Đặt tour', 'willgroup' ),
			'menu_position' 	=> 10,
			'menu_icon' 		=> 'dashicons-calendar-alt',
			'capability_type' 	=> 'post',
			'public' 			=> false,
			'show_ui'			=> true,
			'has_archive' 		=> false,
			'supports' 			=> array(''),
		)
	);
	/**
	 * Add book field group
	 */
	if( function_exists('acf_add_local_field_group') ) {
		
		acf_add_local_field_group(	array(
			'key'		=> 'book_tour_information',
			'title' 	=> __( 'Thông tin', 'willgroup' ),
			'fields' 	=> array (
				array (
					'key'   		=> 'book_tour_status',
					'label' 		=> __( 'Trạng thái', 'willgroup' ),
					'name'  		=> 'book_tour_status',
					'type'  		=> 'text',
					'default_value' => __('Đang chờ đợi thanh toán', 'willgroup'),
					'required'		=> true,
					'show_column'	=> true,
				),
				array (
					'key'   		=> 'book_tour_name',
					'label' 		=> __( 'Họ và tên', 'willgroup' ),
					'name'  		=> 'book_tour_name',
					'type'  		=> 'text',
					'required'		=> true,
					'show_column'	=> true,
				),
				array (
					'key'   		=> 'book_tour_address',
					'label' 		=> __( 'Địa chỉ', 'willgroup' ),
					'name'  		=> 'book_tour_address',
					'type'  		=> 'text',
					'required'		=> true,
					'show_column'	=> true,
				),
				array (
					'key'   		=> 'book_tour_email',
					'label' 		=> __( 'Email', 'willgroup' ),
					'name'  		=> 'book_tour_email',
					'type'  		=> 'email',
					'required'		=> true,
					'show_column'	=> true,
				),
				array (
					'key'   		=> 'book_tour_phone',
					'label' 		=> __( 'Số điện thoại', 'willgroup' ),
					'name'  		=> 'book_tour_phone',
					'type'  		=> 'text',
					'required'		=> true,
					'show_column'	=> true,
				),
				array (
					'key'   		=> 'book_tour',
					'label' 		=> __( 'Tour', 'willgroup' ),
					'name'  		=> 'book_tour',
					'type'  		=> 'post_object',
					'post_type'		=> 'product',
					'required'		=> true,
				),
				array (
					'key'   		=> 'book_tour_departure_date',
					'label' 		=> __( 'Ngày khởi hành', 'willgroup' ),
					'name'  		=> 'book_tour_departure_date',
					'type'  		=> 'date_picker',
					'required'		=> true,
					'show_column'	=> true,
				),
				array (
					'key'   		=> 'book_tour_number_adults',
					'label' 		=> __( 'Số người lớn', 'willgroup' ),
					'name'  		=> 'book_tour_number_adults',
					'type'  		=> 'number',
					'min'			=> 1,
					'required'		=> true,
				),
				array (
					'key'   		=> 'book_tour_number_children',
					'label' 		=> __( 'Số trẻ em', 'willgroup' ),
					'name'  		=> 'book_tour_number_children',
					'type'  		=> 'number',
					'min'			=> 0,
				),
				array (
					'key'   		=> 'book_tour_number_infants',
					'label' 		=> __( 'Số em bé', 'willgroup' ),
					'name'  		=> 'book_tour_number_infants',
					'type'  		=> 'number',
					'min'			=> 0,
				),
				array (
					'key'   		=> 'book_tour_payment_method',
					'label' 		=> __( 'Phương thức thanh toán', 'willgroup' ),
					'name'  		=> 'book_tour_payment_method',
					'type'  		=> 'select',
					'choices'		=> array(
						''			=> __('Chọn', 'willgroup'),
						1			=> __('Thanh toán tại văn phòng của chúng tôi', 'willgroup'),
						2			=> __('Chuyển khoản qua ngân hàng', 'willgroup'),
						3			=> __('Thu tiền tận nơi', 'willgroup'),
					),
					'required'		=> true,
					'show_column'	=> true,
				),
				array (
					'key'   		=> 'book_tour_payment_address',
					'label' 		=> __( 'Địa chỉ thanh toán', 'willgroup' ),
					'name'  		=> 'book_tour_payment_address',
					'type'  		=> 'text',
				),
				array (
					'key'   		=> 'book_tour_message',
					'label' 		=> __( 'Tin nhắn', 'willgroup' ),
					'name'  		=> 'book_tour_message',
					'type'  		=> 'textarea',
				),
			),
			'location' => array (
				array (
					array (
						'param'    => 'post_type',
						'operator' => '==',
						'value'    => 'book_tour',
					),
				),
			),
			'position' => 'normal',
			'label_placement' => 'left',
		));
	}
}
add_action( 'init', 'willgroup_init_book_tour' );

// Add book_tour columns
function willgroup_book_tour_columns_head($cols) {		
	$cols = array_merge(
		array_slice( $cols, 0, 1, true ),
		array( 'book_id' => __( 'Book ID' , 'willgroup' ) ),
		array( 'name' => __( 'Họ và tên' , 'willgroup' ) ),
		array( 'address' => __( 'Địa chỉ' , 'willgroup' ) ),
		array( 'email' => __( 'Email' , 'willgroup' ) ),
		array( 'phone' => __( 'Điện thoại' , 'willgroup' ) ),
		array( 'tour' => __( 'Tour' , 'willgroup' ) ),
		array( 'departure_date' => __( 'Khởi hành' , 'willgroup' ) ),
		array( 'number_adults' => __( 'Người lớn' , 'willgroup' ) ),
		array( 'number_children' => __( 'Trẻ em' , 'willgroup' ) ),
		array( 'number_infants' => __( 'Em bé' , 'willgroup' ) ),
		array( 'payment_method' => __( 'Thanh toán' , 'willgroup' ) ),
		array( 'status' => __( 'Trạng thái' , 'willgroup' ) ),
		array( 'total' => __( 'Tổng' , 'willgroup' ) ),
		array_slice( $cols, 2, null, true )
	);
	return $cols;
}
function willgroup_book_tour_columns_content($col_name, $post_ID) {
	if ($col_name == 'book_id') {
		echo 'LBW' . $post_ID;
	}
	if ($col_name == 'name') {
		$value = get_field('book_tour_name', $post_ID);
		echo $value;
	}
	if ($col_name == 'address') {
		$value = get_field('book_tour_address', $post_ID);
		echo $value;
	}
	if ($col_name == 'email') {
		$value = get_field('book_tour_email', $post_ID);
		echo $value;
	}
	if ($col_name == 'phone') {
		$value = get_field('book_tour_phone', $post_ID);
		echo $value;
	}
	if ($col_name == 'tour') {
		$tour = get_field('book_tour', $post_ID);
		echo '<a href="' . get_edit_post_link($tour) . '">' . get_the_title($tour) . '</a>';
	}
	if ($col_name == 'departure_date') {
		$value = get_field('book_tour_departure_date', $post_ID);
		echo $value;
	}
	if ($col_name == 'number_adults') {
		$value = get_field('book_tour_number_adults', $post_ID);
		echo $value;
	}
	if ($col_name == 'number_children') {
		$value = get_field('book_tour_number_children', $post_ID);
		echo $value;
	}
	if ($col_name == 'number_infants') {
		$value = get_field('book_tour_number_infants', $post_ID);
		echo $value;
	}
	if ($col_name == 'payment_method') {
		$field = get_field_object('book_tour_payment_method', $post_ID);
		echo $field['choices'][$field['value']];
	}
	if ($col_name == 'status') {
		$value = get_field('book_tour_status', $post_ID);
		echo $value;
	}
	if ($col_name == 'total') {
		$tour = get_field('book_tour', $post_ID);
		$product = wc_get_product($tour);
		$adult_price = $product->get_price();
		$child_price = $product->get_meta('product_child_price');
		$infant_price = $product->get_meta('product_infant_price');
		$number_adults = get_field('book_tour_number_adults', $post_ID);
		$number_children = get_field('book_tour_number_children', $post_ID);
		$number_infants = get_field('book_tour_number_infants', $post_ID);
		$amount_adults = $adult_price * $number_adults;
		$amount_children = $child_price * $number_children;
		$amount_infants = $infant_price * $number_infants;
		echo willgroup_format_price($amount_adults + $amount_children + $amount_infants);
	}
}
add_filter('manage_book_tour_posts_columns', 'willgroup_book_tour_columns_head');
add_action('manage_book_tour_posts_custom_column', 'willgroup_book_tour_columns_content', 10, 2);