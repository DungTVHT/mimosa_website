<?php
/**
 * Calc
 */
function willgroup_calc() {
	$adult_price = $_GET['adult_price'];
	$child_price = $_GET['child_price'];
	$infant_price = $_GET['infant_price'];
	$number_adults = $_GET['number_adults'];
	$number_children = $_GET['number_children'];
	$number_infants = $_GET['number_infants'];

	$amount_adults = $adult_price * $number_adults;
	$amount_children = $child_price * $number_children;
	$amount_infants = $infant_price * $number_infants;
	$total = $amount_adults + $amount_children + $amount_infants;

	$amount_adults = willgroup_format_price($amount_adults);
	$amount_children = willgroup_format_price($amount_children);
	$amount_infants = willgroup_format_price($amount_infants);
	$total = willgroup_format_price($total);

	header('Content-Type: application/json');
	$result = array('amount_adults' => $amount_adults, 'amount_children' => $amount_children, 'amount_infants' => $amount_infants, 'total' => $total);
	
	echo json_encode($result);
	die();
}
add_action( 'wp_ajax_nopriv_willgroup_calc', 'willgroup_calc' );
add_action( 'wp_ajax_willgroup_calc', 'willgroup_calc' );

/**
 * Book tour
 */
function willgroup_book_tour_ajax() {
	$tour_id = $_POST['tour_id'];
	$departure_date = $_POST['departure_date'];
	$name = $_POST['name'];
	$address = $_POST['address'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$number_adults = $_POST['number_adults'];
	$number_children = $_POST['number_children'];
	$number_infants = $_POST['number_infants'];
	$message = $_POST['message'];
	$payment_method = $_POST['payment_method'];
	$payment_address = $_POST['payment_address'];
	$agree_terms = $_POST['agree_terms'];
	
	header('Content-Type: application/json');
	if ( $departure_date == '' ) {
		echo json_encode( array( 'status' => false, 'message'=> __( 'Bạn chưa chọn ngày khởi hành.', 'willgroup' ) ) );
		die();
	}
	if ( $name == '' ) {
		echo json_encode( array( 'status' => false, 'message'=> __( 'Bạn chưa nhập họ và tên.', 'willgroup' ) ) );
		die();
	}
	if ( $address == '' ) {
		echo json_encode( array( 'status' => false, 'message'=> __( 'Bạn chưa nhập địa chỉ.', 'willgroup' ) ) );
		die();
	}
	if ( $email == '' ) {
		echo json_encode( array( 'status' => false, 'message'=> __( 'Bạn chưa nhập email.', 'willgroup' ) ) );
		die();
	}
	if ( ! is_email( $email ) ) {
		echo json_encode( array( 'status' => false, 'message'=> __( 'Email của bạn không đúng.', 'willgroup' ) ) );
		die();
	}
	if ( $phone == '' ) {
		echo json_encode( array( 'status' => false, 'message'=> __( 'Bạn chưa nhập số điện thoại.', 'willgroup' ) ) );
		die();
	}
	if ( $number_adults == '' || $number_adults < 1 ) {
		echo json_encode( array( 'status' => false, 'message'=> __( 'Bạn chưa nhập số người lớn.', 'willgroup' ) ) );
		die();
	}
	if ( $payment_method == '' ) {
		echo json_encode( array( 'status' => false, 'message'=> __( 'Bạn chưa chọn phương thức thanh toán.', 'willgroup' ) ) );
		die();
	}
	if ( $agree_terms == '' ) {
		echo json_encode( array( 'status' => false, 'message'=> __( 'Bạn chưa đồng ý với các điều khoản trên.', 'willgroup' ) ) );
		die();
	}
		
	$book_id = wp_insert_post( array(
		'post_type'    => 'book_tour',
		'post_status'  => 'private',
		'meta_input'   => array(
			'book_tour' 	       		=> $tour_id,
			'book_tour_departure_date'  => $departure_date,
			'book_tour_name' 	       	=> $name,
			'book_tour_address' 	    => $address,
			'book_tour_email'           => $email,
			'book_tour_phone'  	        => $phone,
			'book_tour_number_adults'   => $number_adults,
			'book_tour_number_children' => $number_children,
			'book_tour_number_infants'  => $number_infants,
			'book_tour_payment_method'  => $payment_method,
			'book_tour_payment_address' => $payment_address,
			'book_tour_message' 	 	=> $message,
		)
	) );

	$product = wc_get_product($tour_id);
	$adult_price = $product->get_price();
	$child_price = $product->get_meta('product_child_price');
	$infant_price = $product->get_meta('product_infant_price');
	$amount_adults = $adult_price * $number_adults;
	$amount_children = $child_price * $number_children;
	$amount_infants = $infant_price * $number_infants;
	$total = $amount_adults + $amount_children + $amount_infants;

	if ( $payment_method == 1 ) {
		$payment_info = get_field('book_options_payment_address', 'book_options');
	} elseif ( $payment_method == 2 ) {
		$payment_info = get_field('book_options_bank_accounts', 'book_options');
	} elseif ( $payment_method == 3 ) {
		$payment_info = $payment_address;
	}

	$field = get_field_object('book_tour_payment_method', $book_id);
	$value = get_field('book_tour_payment_method', $book_id);
	$payment_method = $field['choices'][ $value ];

	// Send email for customer
	$body = get_field('book_options_email_content', 'book_options');
	$body = str_replace('[book_id]', 'LBW' . $book_id, $body);
	$body = str_replace('[tour]', get_the_title($tour_id), $body);
	$body = str_replace('[departure_date]', $departure_date, $body);
	$body = str_replace('[name]', $name, $body);
	$body = str_replace('[address]', $address, $body);
	$body = str_replace('[email]', $email, $body);
	$body = str_replace('[phone_number]', $phone, $body);
	$body = str_replace('[number_adults]', $number_adults, $body);
	$body = str_replace('[number_children]', $number_children, $body);
	$body = str_replace('[number_infants]', $number_infants, $body);
	$body = str_replace('[adult_price]', willgroup_format_price($adult_price), $body);
	$body = str_replace('[child_price]', willgroup_format_price($child_price), $body);
	$body = str_replace('[infant_price]', willgroup_format_price($infant_price), $body);
	$body = str_replace('[payment_method]', $payment_method, $body);
	$body = str_replace('[payment_info]', $payment_info, $body);
	$body = str_replace('[message]', $message, $body);
	$body = str_replace('[total]', willgroup_format_price($total), $body);
	$body = str_replace('[time]', date('h:i:s A, d-m-Y') , $body);
	$subject = get_field('book_options_email_title', 'book_options');
	$headers = array(
		'From: ' . get_option('admin_email'),
		'Reply-To: ' . get_option('admin_email'),
		'Content-Type: text/html; charset=UTF-8'
	);
	wp_mail( $email, $subject, $body, $headers );

	// Send email for admin
	$body = get_field('book_options_admin_email_content', 'book_options');
	$body = str_replace('[book_id]', 'LBW' . $book_id, $body);
	$body = str_replace('[tour]', get_the_title($tour_id), $body);
	$body = str_replace('[departure_date]', $departure_date, $body);
	$body = str_replace('[name]', $name, $body);
	$body = str_replace('[address]', $address, $body);
	$body = str_replace('[email]', $email, $body);
	$body = str_replace('[phone_number]', $phone, $body);
	$body = str_replace('[number_adults]', $number_adults, $body);
	$body = str_replace('[number_children]', $number_children, $body);
	$body = str_replace('[number_infants]', $number_infants, $body);
	$body = str_replace('[adult_price]', willgroup_format_price($adult_price), $body);
	$body = str_replace('[child_price]', willgroup_format_price($child_price), $body);
	$body = str_replace('[infant_price]', willgroup_format_price($infant_price), $body);
	$body = str_replace('[payment_method]', $payment_method, $body);
	$body = str_replace('[payment_info]', $payment_info, $body);
	$body = str_replace('[message]', $message, $body);
	$body = str_replace('[total]', willgroup_format_price($total), $body);
	$body = str_replace('[time]', date('h:i:s A, d-m-Y') , $body);
	$subject = get_field('book_options_admin_email_title', 'book_options');
	$headers = array(
		'From: ' . get_option('admin_email'),
		'Reply-To: ' . $email,
		'Content-Type: text/html; charset=UTF-8'
	);
	wp_mail( array_map('current', get_field('book_options_receiver_emails', 'book_options')), $subject, $body, $headers );

	setcookie('book_id', $book_id, time() + 86400, '/');
	$page_thank_you = get_field('book_options_page_thank_you', 'book_options');
	
	echo json_encode( array( 'status' => true, 'url' => get_permalink($page_thank_you) ) );
	die();
}
add_action( 'wp_ajax_nopriv_willgroup_book_tour_ajax', 'willgroup_book_tour_ajax' );
add_action( 'wp_ajax_willgroup_book_tour_ajax', 'willgroup_book_tour_ajax' );