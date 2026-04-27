<?php        
       global $woocommerce;

       
        $this->countries        = new WC_Countries();
	    
	    $fields                 = $this->countries->get_address_fields( $this->countries->get_base_country(),'shipping_');
		$shipping_settings      = $this->shipping_settings;
		$shipping_settings      = array_filter($shipping_settings);
		$core_fields            = 'shipping_country,shipping_first_name,shipping_last_name,shipping_company,shipping_address_1,shipping_address_2,shipping_city,shipping_state,shipping_postcode';
		$requiredshipping_slugs = '';
		$country_fields         = 'shipping_country,shipping_state';	
		$address2_field         = 'shipping_address_1,shipping_address_2,shipping_city,shipping_state,shipping_postcode';
		
		$noticerowno2 = 1;
		
		if (isset($shipping_settings) && (sizeof($shipping_settings) >= 1)) { 
		   $conditional_fields_dropdown = $shipping_settings;
		} else {
		   $conditional_fields_dropdown = $fields;
		}
		 ?>
	
		 
		  <center><div class="panel-group pcfme-sortable-list" id="accordion" >
		   <?php if (isset($shipping_settings) && (sizeof($shipping_settings) >= 1)) { 
		    foreach ($shipping_settings as $key =>$field) { 
		      $this->show_fields_form($conditional_fields_dropdown,$key,$field,$noticerowno2,$this->shipping_settings_key,$requiredshipping_slugs,$core_fields,$country_fields,$address2_field);
		    $noticerowno2++;
		   } 
		   } else {
		 
		    foreach ($fields as $key =>$field) { 
		      $this->show_fields_form($conditional_fields_dropdown,$key,$field,$noticerowno2,$this->shipping_settings_key,$requiredshipping_slugs,$core_fields,$country_fields,$address2_field);
		    $noticerowno2++;
		 }
		 }
		  ?>
		<script>
		 var hash= <?php echo $noticerowno2; ?>;
		 jQuery(document).ready(function($) {
		  $(".checkout_field_width").select2({width: "250px" ,minimumResultsForSearch: -1}); 
          $(".checkout_field_visibility").select2({width: "250px" ,minimumResultsForSearch: -1});		  
          $(".row-validate-multiselect").select2({width: "250px" });  
          $(".checkout_field_conditional_showhide").select2({width: "100px",minimumResultsForSearch: -1 });  
          $(".checkout_field_conditional_parentfield").select2({width: "250px" });
          $(".checkout_field_type").select2({width: "250px" ,minimumResultsForSearch: -1}); 
		  $(".checkout_field_validate").select2({width: "250px" }); 
		  
		  $(".checkout_field_category").select2({width: "400px" });
		  $('.checkout_field_products').select2({
  		   ajax: {
    			url: ajaxurl, // AJAX URL is predefined in WordPress admin
    			dataType: 'json',
    			delay: 250, // delay in ms while typing when to perform a AJAX search
    			data: function (params) {
      				return {
        				q: params.term, // search query
        				action: 'pdfmegetajaxproductslist' // AJAX action for admin-ajax.php
      				};
    			},
    			processResults: function( data ) {
				var options = [];
				if ( data ) {
 
					// data is the array of arrays, and each of them contains ID and the Label of the option
					$.each( data, function( index, text ) { // do not forget that "index" is just auto incremented value
						options.push( { id: text[0], text: text[1]  } );
					});
 
				}
				return {
					results: options
				};
			},
			cache: true
		   },
		     minimumInputLength: 3 ,
			 width: "400px"// the minimum of symbols to input before perform a search
	       });
		 });
		 </script>
		</div> 
	
		 <div class="buttondiv">
           <input type="button" id="add-shipping-field" class="btn button-primary" style="float:left;" value="<?php _e('Add Shipping Field','pcn'); ?>">
	       <input type="button" style="float:right;" id="restore-shipping-fields" class="btn button-primary" value="<?php _e('Restore Default Fields','pcn'); ?>">
         </div>
		 
		</center> <?php
		
	     $this->show_new_form($conditional_fields_dropdown,$this->shipping_settings_key,$country_fields);
