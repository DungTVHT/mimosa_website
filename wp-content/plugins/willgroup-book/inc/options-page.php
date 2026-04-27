<?php
function willgroup_book_options_init() {
	/**
	 * Create options page
	 */
	if( function_exists('acf_add_options_page') ) {
		acf_add_options_page(array(
			'page_title' 	=> 'Tùy chọn',
			'menu_title'	=> 'Tùy chọn',
			'menu_slug' 	=> 'book_options',
			'capability'	=> 'edit_posts',
			'icon_url' 		=> 'dashicons-wordpress-alt',
			'id'			=> 'book_options',
			'post_id' 		=> 'book_options',
			'parent_slug'	=> 'edit.php?post_type=book_tour',
		));
	}

	/**
	 * Add book field group
	 */
	if( function_exists('acf_add_local_field_group') ) {
		
		acf_add_local_field_group(	array(
			'key'		=> 'book_options_settings',
			'title' 	=> __( 'Cài đặt', 'willgroup' ),
			'fields' 	=> array (
				array (
					'key'   		=> 'book_options_page_book_tour',
					'label' 		=> __( 'Trang đặt tour', 'willgroup' ),
					'name'  		=> 'book_options_page_book_tour',
					'type'  		=> 'post_object',
					'post_type'		=> array('page'),
					'allow_null'	=> 1,
					'wrapper'		=> array(
						'width'		=> '50',
					),
				),
				array (
					'key'   		=> 'book_options_page_thank_you',
					'label' 		=> __( 'Trang cám ơn', 'willgroup' ),
					'name'  		=> 'book_options_page_thank_you',
					'type'  		=> 'post_object',
					'post_type'		=> array('page'),
					'allow_null'	=> 1,
					'wrapper'		=> array(
						'width'		=> '50',
					),
				),
				array (
					'key'   		=> 'book_options_adult_age',
					'label' 		=> __( 'Tuổi người lớn', 'willgroup' ),
					'name'  		=> 'book_options_adult_age',
					'type'  		=> 'text',
					'wrapper'		=> array(
						'width'		=> '50',
					),
				),
				array (
					'key'   		=> 'book_options_child_age',
					'label' 		=> __( 'Tuổi trẻ em', 'willgroup' ),
					'name'  		=> 'book_options_child_age',
					'type'  		=> 'text',
					'wrapper'		=> array(
						'width'		=> '50',
					),
				),
				array (
					'key'   		=> 'book_options_infant_age',
					'label' 		=> __( 'Tuổi em bé', 'willgroup' ),
					'name'  		=> 'book_options_infant_age',
					'type'  		=> 'text',
					'wrapper'		=> array(
						'width'		=> '50',
					),
				),
				array (
					'key'   		=> 'book_options_payment_address',
					'label' 		=> __( 'Địa chỉ thanh toán', 'willgroup' ),
					'name'  		=> 'book_options_payment_address',
					'type'  		=> 'text',
					'wrapper'		=> array(
						'width'		=> '50',
					),
				),
				array (
					'key'   		=> 'book_options_book_tour_note',
					'label' 		=> __( 'Ghi chú đặt tour', 'willgroup' ),
					'name'  		=> 'book_options_book_tour_note',
					'type'  		=> 'textarea',
					'rows'			=> 5,
					'wrapper'		=> array(
						'width'		=> '50',
					),
				),
				array (
					'key'   		=> 'book_options_book_tour_terms',
					'label' 		=> __( 'Điều khoản đặt tour', 'willgroup' ),
					'name'  		=> 'book_options_book_tour_terms',
					'type'  		=> 'textarea',
					'rows'			=> 5,
					'wrapper'		=> array(
						'width'		=> '50',
					),
				),
				array (
					'key'   		=> 'book_options_bank_accounts',
					'label' 		=> __( 'Các tài khoản ngân hàng', 'willgroup' ),
					'name'  		=> 'book_options_bank_accounts',
					'type'  		=> 'wysiwyg',
				),
				array (
					'key' 		    => 'book_options_receiver_emails',
					'label'		    => __( 'Những email người nhận', 'willgroup' ),
					'name' 		    => 'book_options_receiver_emails',
					'type' 		    => 'repeater',
					'layout'	    => 'table',
					'button_label'  => __( 'Thêm', 'willgroup' ),
					'sub_fields'    => array (
						array (
							'key' 	=> 'book_options_receiver_email',
							'label' => __( 'Email người nhận', 'willgroup' ),
							'name' 	=> 'book_options_receiver_email',
							'type' 	=> 'email',
						),
					),
				),
				array (
					'key' 			=> 'book_options_admin_email_title',
					'label' 		=> __( 'Admin - Tiêu đề email', 'willgroup' ),
					'name' 			=> 'book_options_admin_email_title',
					'type' 			=> 'text',
				),
				array (
					'key' 			=> 'book_options_admin_email_content',
					'label' 		=> __( 'Admin - Nội dung email', 'willgroup' ),
					'name' 			=> 'book_options_admin_email_content',
					'type' 			=> 'wysiwyg',
					'instructions' 	=> 'Email tags: [book_id], [tour], [departure_date], [name], [address], [email], [phone_number], [number_adults], [number_children], [number_infants], [adult_price], [child_price], [infant_price], [payment_method], [message], [total], [time]',
				),
				array (
					'key' 			=> 'book_options_email_title',
					'label' 		=> __( 'Tiêu đề email', 'willgroup' ),
					'name' 			=> 'book_options_email_title',
					'type' 			=> 'text',
				),
				array (
					'key' 			=> 'book_options_email_content',
					'label' 		=> __( 'Nội dung email', 'willgroup' ),
					'name' 			=> 'book_options_email_content',
					'type' 			=> 'wysiwyg',
					'instructions' 	=> 'Email tags: [book_id], [tour], [departure_date], [name], [address], [email], [phone_number], [number_adults], [number_children], [number_infants], [adult_price], [child_price], [infant_price], [payment_method], [message], [total], [time]',
				),
				array (
					'label' 		=> __( 'Hướng dẫn', 'willgroup' ),
					'name' 			=> 'book_options_guide',
					'type' 			=> 'text',
					'readonly' 		=> 1,
					'default_value' => 'Các shortcodes: [willgroup_book_mini_tour], [willgroup_book_tour], [willgroup_book_thank_you]',
					'instructions' 	=> '1. Trên trang chi tiết tour nhúng shortcode [willgroup_book_mini_tour] vào nơi cần hiển thị form đặt tour<br>
										2. Tạo trang Đặt tour và nhúng shortcode [willgroup_book_tour] vào khung soạn thảo<br>
										3. Tạo trang Cám ơn và nhúng shortcode [willgroup_book_thank_you] vào khung soạn thảo<br>
										4. Trường Trang đặt tour bên trên chọn trang Đặt tour vừa tạo<br>
										5. Trường Trang cám ơn bên trên chọn trang Cám ơn vừa tạo<br>
										6. Điền đầy đủ thông tin vào các trường còn lại bên trên<br>
										Done.',
				),
			),
			'location' => array (
				array (
					array (
						'param'    => 'options_page',
						'operator' => '==',
						'value'    => 'book_options',
					),
				),
			),
			'position' => 'normal',
			'label_placement' => 'top',
		));
	}
}
add_action( 'init', 'willgroup_book_options_init' );