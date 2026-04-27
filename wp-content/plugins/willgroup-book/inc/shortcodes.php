<?php
// Add shortcode book tour mini
function willgroup_book_mini_tour() { 
	global $product;

	$terms = get_the_terms($product->ID, 'product_cat');
	if ( !is_wp_error($terms) && !empty($terms) ) {
		foreach ( $terms as $value ) {
			if ( get_field('product_cat_hide_book_tour', 'term_' . $value->term_id) ) return;
		}
	}

	$adult_price = $product->get_price();
	$child_price = $product->get_meta('product_child_price');
	$infant_price = $product->get_meta('product_infant_price');
	$adult_price = !empty($adult_price) ? $adult_price : 0;
	$child_price = !empty($child_price) ? $child_price : 0;
	$infant_price = !empty($infant_price) ? $infant_price : 0;
	$page_book = get_field('book_options_page_book_tour', 'book_options');

	ob_start();
	?>
	<form class="willgroup-form-book-mini-tour" method="GET" action="<?php echo get_permalink($page_book); ?>">
		<input type="hidden" name="tour_id" value="<?php the_ID(); ?>"/>
		<input type="hidden" name="amount_total"/>
		<div class="willgroup-form-group">
			<label class="willgroup-form-label"><?php _e('Ngày khởi hành', 'willgroup'); ?></label>
			<div class="willgroup-form-input-group willgroup-departure">
				<span class="willgroup-form-input-group-text">
					<span class="fas fa-calendar"></span>
				</span>
				<input class="willgroup-form-input datetimepicker" type="text" name="departure_date"/>
			</div>
		</div>
		<div class="willgroup-form-group">
			<label class="willgroup-form-label">
				<span><?php _e('Người lớn', 'willgroup'); ?></span>	

				<?php if ( $age = get_field('book_options_adult_age', 'book_options') ) : ?>
					<small>(<?php echo $age; ?>)</small>
				<?php endif; ?>

				<span class="willgroup-form-book-mini-tour-price"><?php echo willgroup_format_price($adult_price); ?></span>
			</label>
			<div class="willgroup-form-input-group willgroup-quantity">
				<a class="willgroup-form-input-group-text willgroup-quantity-down" href="javascript:void(0);">
					<span class="fas fa-minus"></span>
				</a>
				<input class="willgroup-form-input" type="text" name="number_adults" min="1" step="1" value="1" data-adult-price="<?php echo $product->get_price(); ?>"/>
				<a class="willgroup-form-input-group-text willgroup-quantity-up" href="javascript:void(0);">
					<span class="fas fa-plus"></span>
				</a>
			</div>
		</div>
		<div class="willgroup-form-group">
			<label class="willgroup-form-label">
				<span><?php _e('Trẻ em', 'willgroup'); ?></span>	
				
				<?php if ( $age = get_field('book_options_child_age', 'book_options') ) : ?>
					<small>(<?php echo $age; ?>)</small>
				<?php endif; ?>

				<span class="willgroup-form-book-mini-tour-price"><?php echo willgroup_format_price($child_price); ?></span>
			</label>
			<div class="willgroup-form-input-group willgroup-quantity">
				<a class="willgroup-form-input-group-text willgroup-quantity-down" href="javascript:void(0);">
					<span class="fas fa-minus"></span>
				</a>
				<input class="willgroup-form-input" type="text" name="number_children" min="0" step="1" value="0" data-child-price="<?php echo $product->get_meta('product_child_price'); ?>"/>
				<a class="willgroup-form-input-group-text willgroup-quantity-up" href="javascript:void(0);">
					<span class="fas fa-plus"></span>
				</a>
			</div>
		</div>
		<div class="willgroup-form-group">
			<label class="willgroup-form-label">
				<span><?php _e('Em bé', 'willgroup'); ?></span>	
				
				<?php if ( $age = get_field('book_options_infant_age', 'book_options') ) : ?>
					<small>(<?php echo $age; ?>)</small>
				<?php endif; ?>

				<span class="willgroup-form-book-mini-tour-price"><?php echo willgroup_format_price($infant_price); ?></span>
			</label>
			<div class="willgroup-form-input-group willgroup-quantity">
				<a class="willgroup-form-input-group-text willgroup-quantity-down" href="javascript:void(0);">
					<span class="fas fa-minus"></span>
				</a>
				<input class="willgroup-form-input" type="text" name="number_infants" min="0" step="1" value="0" data-infant-price="<?php echo $product->get_meta('product_infant_price'); ?>"/>
				<a class="willgroup-form-input-group-text willgroup-quantity-up" href="javascript:void(0);">
					<span class="fas fa-plus"></span>
				</a>
			</div>
		</div>
		<div class="willgroup-total-wrapper">
			<span><?php _e('Tổng tiền', 'willgroup'); ?></span>
			<span class="willgroup-total"></span>
		</div>
		<button class="willgroup-button willgroup-button-block" type="submit">
			<?php _e('Đặt tour', 'willgroup'); ?>
		</button>
	</form>
	<?php
	return ob_get_clean();
}
add_shortcode( 'willgroup_book_mini_tour', 'willgroup_book_mini_tour' );

function willgroup_book_tour() {
	if ( empty($_GET['tour_id']) )
		return;
	$tour_id = $_GET['tour_id'];
	$tour_departure_date = $_GET['departure_date'];
	$product = wc_get_product($tour_id);

	ob_start();
	?>
	<form class="willgroup-form-book-tour" method="POST" action="">
		<input type="hidden" name="action" value="willgroup_book_tour_ajax"/>
		<input type="hidden" name="tour_id" value="<?php echo $tour_id; ?>"/>
		<input type="hidden" name="departure_date" value="<?php echo $tour_departure_date; ?>">
		<div class="willgroup-row willgroup-book-tour">
			<div class="willgroup-col-12 willgroup-col-sm-6 willgroup-book-tour-image" style="background-image: url(<?php echo get_the_post_thumbnail_url($tour_id, 'full'); ?>);"></div>
			<div class="willgroup-col-12 willgroup-col-sm-6 willgroup-book-tour-info">
				<h2 class="willgroup-book-tour-title"><?php echo get_the_title($tour_id); ?></h2>
				
                <?php if ( $tour_departure_date ) : ?>
					<div class="willgroup-book-tour-item">
						<span class="fas fa-calendar fa-fw willgroup-book-tour-item-icon"></span>
						<span class="willgroup-book-tour-item-text"><?php echo __('Ngày khởi hành') . ': ' . $tour_departure_date; ?></span>
					</div>
				<?php endif; ?>
                  
                <div class="willgroup-book-tour-item">
					<span class="fas fa-users fa-fw willgroup-book-tour-item-icon"></span>
					<span class="willgroup-book-tour-item-text">
						<?php echo __('Số lượng') . ': '; ?>
						<span class="willgroup-number-adults">0</span> <?php _e('Người lớn'); ?>
						<span>-</span>
						<span class="willgroup-number-children">0</span> <?php _e('Trẻ em'); ?>
						<span>-</span>
						<span class="willgroup-number-infants">0</span> <?php _e('Em bé'); ?>
					</span>
				</div>
				<div class="row">
					<div class="willgroup-col-12 willgroup-col-lg-4 willgroup-form-group">
						<label class="willgroup-form-label"><?php _e('Người lớn', 'willgroup'); ?></label>
						<div class="willgroup-form-input-group willgroup-quantity">
							<a class="willgroup-form-input-group-text willgroup-quantity-down" href="javascript:void(0);">
								<span class="fas fa-minus"></span>
							</a>
							<input class="willgroup-form-input" type="text" name="number_adults" min="1" step="1" value="<?php echo !empty($_GET['number_adults']) ? $_GET['number_adults'] : 1; ?>" data-adult-price="<?php echo $product->get_price(); ?>"/>
							<a class="willgroup-form-input-group-text willgroup-quantity-up" href="javascript:void(0);">
								<span class="fas fa-plus"></span>
							</a>
						</div>
						<span class="willgroup-amount-adults"></span>
					</div>
					<div class="willgroup-col-12 willgroup-col-lg-4 willgroup-form-group">
						<label class="willgroup-form-label">
							<?php _e('Trẻ em', 'willgroup'); ?>
						</label>
						<div class="willgroup-form-input-group willgroup-quantity">
							<a class="willgroup-form-input-group-text willgroup-quantity-down" href="javascript:void(0);">
								<span class="fas fa-minus"></span>
							</a>
							<input class="willgroup-form-input" type="text" name="number_children" min="0" step="1" value="<?php echo !empty($_GET['number_children']) ? $_GET['number_children'] : 0; ?>" data-child-price="<?php echo $product->get_meta('product_child_price'); ?>"/>
							<a class="willgroup-form-input-group-text willgroup-quantity-up" href="javascript:void(0);">
								<span class="fas fa-plus"></span>
							</a>
						</div>
						<span class="willgroup-amount-children"></span>
					</div>
					<div class="willgroup-col-12 willgroup-col-lg-4 willgroup-form-group">
						<label class="willgroup-form-label">
							<?php _e('Em bé', 'willgroup'); ?>
						</label>
						<div class="willgroup-form-input-group willgroup-quantity">
							<a class="willgroup-form-input-group-text willgroup-quantity-down" href="javascript:void(0);">
								<span class="fas fa-minus"></span>
							</a>
							<input class="willgroup-form-input" type="text" name="number_infants" min="0" step="1" value="<?php echo !empty($_GET['number_infants']) ? $_GET['number_infants'] : 0; ?>" data-infant-price="<?php echo $product->get_meta('product_infant_price'); ?>"/>
							<a class="willgroup-form-input-group-text willgroup-quantity-up" href="javascript:void(0);">
								<span class="fas fa-plus"></span>
							</a>
						</div>
						<span class="willgroup-amount-infants"></span>
					</div>
				</div>
				<div class="willgroup-book-tour-item">
					<span class="fas fa-dollar-sign fa-fw willgroup-book-tour-item-icon"></span>
					<span class="willgroup-book-tour-item-text">
						<?php echo __('Tổng giá tour') . ': '; ?>
						<span class="willgroup-total"></span>
					</span>
				</div>
			</div>
		</div>

		<?php if ( get_field('book_options_book_tour_note', 'book_options') ) : ?>
			<div class="willgroup-book-tour-note">
				<span class="fas fa-quote-left willgroup-book-tour-note-icon" style="color: #ccc; top: 0.75rem; left: 1rem;"></span>
				<div class="willgroup-book-tour-note-text"><?php echo nl2br(get_field('book_options_book_tour_note', 'book_options')); ?></div>
			</div>
		<?php endif; ?>

		<!---------- Step 1 ---------->
		<div class="willgroup-book-box">
			<div class="willgroup-book-box-header">
				<span class="willgroup-book-box-header-number">1</span>
				<span class="willgroup-book-box-header-title"><?php _e('Thông tin liên hệ', 'willgroup'); ?></span>
			</div>
			<div class="willgroup-book-box-content">
				<div class="willgroup-row">
					<div class="willgroup-col-12 willgroup-col-sm-6 willgroup-col-lg-4 willgroup-form-group">
						<label class="willgroup-form-label"><?php _e('Họ và tên', 'willgroup'); ?></label>
						<input class="willgroup-form-input" type="text" name="name"/>
					</div>
					<div class="willgroup-col-12 willgroup-col-sm-6 willgroup-col-lg-4 willgroup-form-group">
						<label class="willgroup-form-label"><?php _e('Số điện thoại', 'willgroup'); ?></label>
						<input class="willgroup-form-input" type="text" name="phone"/>
					</div>
					<div class="willgroup-col-12 willgroup-col-sm-6 willgroup-col-lg-4 willgroup-form-group">
						<label class="willgroup-form-label"><?php _e('Email', 'willgroup'); ?></label>
						<input class="willgroup-form-input" type="text" name="email"/>
					</div>
					<div class="willgroup-col-12 willgroup-form-group">
						<label class="willgroup-form-label"><?php _e('Địa chỉ', 'willgroup'); ?></label>
						<input class="willgroup-form-input" type="text" name="address"/>
					</div>
				</div>
				<div class="willgroup-form-group">
					<label class="willgroup-form-label"><?php _e('Tin nhắn', 'willgroup'); ?></label>
					<textarea class="willgroup-form-input" rows="3" name="message"></textarea>
				</div>
			</div>
		</div>

		<!---------- Step 2 ---------->
		<div class="willgroup-book-box">
			<div class="willgroup-book-box-header">
				<span class="willgroup-book-box-header-number">2</span>
				<span class="willgroup-book-box-header-title"><?php _e('Phương thức thanh toán', 'willgroup'); ?></span>
			</div>
			<div class="willgroup-book-box-content">
				<div class="willgroup-form-group willgroup-book-tour-payment-method">
					<input type="radio" id="payment-method-radio-1" class="willgroup-form-radio" name="payment_method" value="1">
					<label class="willgroup-form-label" for="payment-method-radio-1">
						<span class="fas fa-home fa-fw willgroup-book-tour-payment-method-icon"></span>
						<span class="willgroup-book-tour-payment-method-text">
							<strong><?php _e('Thanh toán tại văn phòng của chúng tôi', 'willgroup'); ?></strong>
							<small><?php _e('Qúy khách sẽ thanh toán sau khi hoàn tất quy trình đặt tour tại văn phòng', 'willgroup'); ?></small>
						</span>
					</label>
				</div>
				<div class="willgroup-book-tour-payment-method-collapse" style="display: none;">
					<div class="willgroup-book-tour-payment-address">
						<?php the_field('book_options_payment_address', 'book_options'); ?>		
					</div>
				</div>

				<div class="willgroup-form-group willgroup-book-tour-payment-method">
					<input type="radio" id="payment-method-radio-2" class="willgroup-form-radio" name="payment_method" value="2">
					<label class="willgroup-form-label" for="payment-method-radio-2">
						<span class="fas fa-bank fa-fw willgroup-book-tour-payment-method-icon"></span>
						<span class="willgroup-book-tour-payment-method-text">
							<strong><?php _e('Chuyển khoản qua ngân hàng', 'willgroup'); ?></strong>
							<small><?php _e('Qúy khách sẽ thanh toán bằng phương thức chuyển khoản qua tài khoản của công ty', 'willgroup'); ?></small>
						</span>
					</label>
				</div>
				<div class="willgroup-book-tour-payment-method-collapse" style="display: none;">
					<div class="willgroup-book-tour-bank-accounts">
						<?php the_field('book_options_bank_accounts', 'book_options'); ?>		
					</div>
				</div>

				<div class="willgroup-form-group willgroup-book-tour-payment-method">
					<input type="radio" id="payment-method-radio-3" class="willgroup-form-radio" name="payment_method" value="3">
					<label class="willgroup-form-label" for="payment-method-radio-3">
						<span class="fas fa-hand-holding-usd fa-fw willgroup-book-tour-payment-method-icon"></span>
						<span class="willgroup-book-tour-payment-method-text">
							<strong><?php _e('Thu tiền tận nơi', 'willgroup'); ?></strong>
							<small><?php _e('Qúy khách sẽ thanh toán bằng tiền mặt khi có nhân viên đến địa chỉ của quý khách thu tiền', 'willgroup'); ?></small>
						</span>
					</label>
				</div>
				<div class="willgroup-book-tour-payment-method-collapse" style="display: none;">
					<div class="form-group">
						<input class="form-control" type="text" name="payment_address" placeholder="<?php _e('Nhập địa chỉ của bạn', 'willgroup'); ?>"/>	
					</div>
				</div>
			</div>
		</div>

		<!---------- Step 3---------->
		<div class="willgroup-book-box">
			<div class="willgroup-book-box-header">
				<span class="willgroup-book-box-header-number">3</span>
				<span class="willgroup-book-box-header-title"><?php _e('Điều khoản đặt tour', 'willgroup'); ?></span>
			</div>
			<div class="willgroup-book-box-content">
				<div class="willgroup-book-tour-terms">
					<?php echo nl2br(get_field('book_options_book_tour_terms', 'book_options')); ?>
				</div>
				<input type="checkbox" class="willgroup-form-checkbox" id="agree-terms" name="agree_terms">
				<label class="willgroup-form-label" for="agree-terms">
					<?php _e('Tôi đồng ý với các điều khoản trên', 'willgroup'); ?>
				</label>
			</div>
		</div>

		<div class="willgroup-form-group nut-dat-tour">
			<button class="willgroup-button willgroup-book-tour-button" type="submit">
				<?php _e('Đặt tour ngay', 'willgroup'); ?>		
			</button>
		</div>
	</form>
	<?php
	return ob_get_clean();
}
add_shortcode( 'willgroup_book_tour', 'willgroup_book_tour' );

function willgroup_book_thank_you() {
	if ( empty($_COOKIE['book_id']) )
		return __('Phiên làm việc cho lượt book này đã hết hạn.', 'willgroup');

	$book_id = $_COOKIE['book_id'];
	$tour = get_field('book_tour', $book_id);
	$departure_date = get_field('book_tour_departure_date', $book_id);
	$name = get_field('book_tour_name', $book_id);
	$address = get_field('book_tour_address', $book_id);
	$email = get_field('book_tour_email', $book_id);
	$phone = get_field('book_tour_phone', $book_id);
	$number_adults = get_field('book_tour_number_adults', $book_id);
	$number_children = get_field('book_tour_number_children', $book_id);
	$number_infants = get_field('book_tour_number_infants', $book_id);
	$field = get_field_object('book_tour_payment_method', $book_id);

	if ( $field['value'] == 1 ) {
		$payment_info = get_field('book_options_payment_address', 'book_options');
	} elseif ( $field['value'] == 2 ) {
		$payment_info = get_field('book_options_bank_accounts', 'book_options');
	} elseif ( $field['value'] == 3 ) {
		$payment_info = get_field('book_tour_payment_address', $book_id);
	}

	$payment_method = $field['choices'][ $field['value'] ];
	$message = get_field('book_tour_message', $book_id);

	$product = wc_get_product($tour);
	$adult_price = $product->get_price();
	if($product->get_meta('product_child_price')!=""){
			$child_price = $product->get_meta('product_child_price');
		}else{
				$child_price =0;
		}
		if($product->get_meta('product_infant_price')!=""){
			$infant_price = $product->get_meta('product_infant_price');
		}else{
			$infant_price  =0;
		}


	if (is_numeric($adult_price) ){
		$amount_adults = $adult_price * $number_adults;
		}else{
	$amount_adults =0;
}

	if (is_numeric($child_price) ){
			
	$amount_children = $child_price * $number_children;
		}else{
		
	$amount_children = 0;
}
	if (is_numeric($amount_infants ) ){
$amount_infants = $infant_price * $number_infants;
		}else{
	$amount_infants =0;
}
		

	$total = $amount_adults + $amount_children + $amount_infants;

	

	$body = get_field('book_options_email_content', 'book_options');
	$body = str_replace('[book_id]', 'LBW' . $book_id, $body);
	$body = str_replace('[tour]', get_the_title($tour), $body);
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
	
	return $body;
}
add_shortcode( 'willgroup_book_thank_you', 'willgroup_book_thank_you' );