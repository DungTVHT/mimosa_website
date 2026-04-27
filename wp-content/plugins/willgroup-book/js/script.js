/**
 * Daterangepicker
 */
const dateToday = new Date();
document.querySelectorAll('.datetimepicker').forEach(function(item) {
	new Lightpick({
		field: item,
		numberOfMonths: 1,
		minDate: dateToday,
		startDate: dateToday,
		
	});
});

jQuery(function($) {

	/**
	 * Payment method collapse
	 */
	$('.willgroup-book-tour-payment-method [name="payment_method"]').on('change', function() {
		if ( $(this).is(':checked') ) {
			$('.willgroup-book-tour-payment-method-collapse').css('display', 'none');
			$(this).parents('.willgroup-book-tour-payment-method').next().css('display', 'block');
		}
	});
	$('.willgroup-book-tour-payment-method [name="payment_method"]').trigger('change');

	/**
	 * Form book select onchange
	 */
	$('[name="number_adults"], [name="number_children"], [name="number_infants"]').on('change keyup click', function(e) {
		var $this = $(this);
		var $form = $this.parents('form');
		var numberAdults = $form.find('[name="number_adults"]').val();
		var numberChildren = $form.find('[name="number_children"]').val();
		var numberInfants = $form.find('[name="number_infants"]').val();
		var adultPrice = $form.find('[name="number_adults"]').data('adult-price');
		var childPrice = $form.find('[name="number_children"]').data('child-price');
		var infantPrice = $form.find('[name="number_infants"]').data('infant-price');
		if (numberAdults != '' && numberAdults < 1) {
			numberAdults = 1;
			$form.find('[name="number_adults"]').val(numberAdults);
		}
		if (numberChildren != '' && numberChildren < 0) {
			numberChildren = 0;
			$form.find('[name="number_children"]').val(numberChildren);
		}
		if (numberInfants != '' && numberInfants < 0) {
			numberInfants = 0;
			$form.find('[name="number_infants"]').val(numberInfants);
		}

		$.ajax({
			type: 'GET',
			url: ajax.ajax_url,
			data: 'action=willgroup_calc' +
				  '&adult_price=' + adultPrice +
				  '&child_price=' + childPrice +
				  '&infant_price=' + infantPrice +
				  '&number_adults=' + numberAdults +
				  '&number_children=' + numberChildren +
				  '&number_infants=' + numberInfants,
			success: function( data, textStatus, jqXHR ) {
				$('.willgroup-number-adults').html(numberAdults);
				$('.willgroup-number-children').html(numberChildren);
				$('.willgroup-number-infants').html(numberInfants);
				$('.willgroup-amount-adults').html(data.amount_adults);
				$('.willgroup-amount-children').html(data.amount_children);
				$('.willgroup-amount-infants').html(data.amount_infants);
				$('[name="amount_total"]').val(data.amount_total);
				$('.willgroup-total').html(data.total);
			},
			error: function( jqXHR, textStatus, errorThrown ) {
				alert( errorThrown );
			}
		});
	});
	$('[name="number_adults"]').trigger('change');

	/**
	 * Form book tour
	 */
	$('.willgroup-form-book-tour').on('submit', function(e) {
		e.preventDefault();	
		var $this = $(this);
		$this.find('[type="submit"]').append(' <i class="fas fa-circle-notch fa-spin icon"></i>');
		$this.find('.willgroup-alert-result').remove();
		$.ajax({
			type: 'POST',
			url: ajax.ajax_url,
			data: $this.serialize(),
			success: function( data, textStatus, jqXHR ) {
				$this.find('[type="submit"]').find('.icon').remove();
				if( data.status == false ) {
					$this.append('<div class="willgroup-alert willgroup-alert-error willgroup-alert-result">' + data.message + '</div>');
				} else {
					window.location = data.url;
				}
			},
			error: function( jqXHR, textStatus, errorThrown ) {
				alert( jqXHR.responseText );
			}
		});
	});

	/**
	 * Quantity
	 */
	$('.willgroup-quantity').each(function() {
		var spinner = $(this),
		input = spinner.find('input[type="text"]'),
		btnUp = spinner.find('.willgroup-quantity-up'),
		btnDown = spinner.find('.willgroup-quantity-down'),
		min = input.attr('min'),
		max = input.attr('max');

		btnUp.click(function() {
			var oldValue = parseFloat(input.val());
			if ( oldValue >= max ) {
				var newVal = oldValue;
			} else {
				var newVal = oldValue + 1;
			}
			spinner.find('input').val(newVal);
			spinner.find('input').trigger('change');
		});

		btnDown.click(function() {
			var oldValue = parseFloat(input.val());
			if ( oldValue <= min ) {
				var newVal = oldValue;
			} else {
				var newVal = oldValue - 1;
			}
			spinner.find('input').val(newVal);
			spinner.find('input').trigger('change');
		});
	});
});