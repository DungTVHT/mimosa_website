jQuery(document).ready(function($) {
var pcfmecheckoutfield = $(".checkoutfield");

$("#add-billing-field").on("click", function () {
   var pcfmenewPanel = pcfmecheckoutfield.clone();
    hash++;
    pcfmenewPanel.find(".collapse").removeClass("in");
    pcfmenewPanel.find(".accordion-toggle").attr("href", "#pcfme" + (hash));
    pcfmenewPanel.find(".new-field-label").append(pcfmeadmin.checkoutfieldtext4 + hash);
		
	pcfmenewPanel.find(".checkoutfield").attr("id", "pcfme_list_items_" + (hash));
	pcfmenewPanel.find(".panel-collapse").attr("id", "pcfme" + (hash));
	 
         var randomnumber=Math.floor(Math.random()*1000);


    
	pcfmenewPanel.find(".checkout_field_type_new").attr("name", "pcfme_billing_settings[" + pcfmeadmin.checkoutfieldtext + randomnumber + "][type]");
	pcfmenewPanel.find(".checkout_field_label").attr("name", "pcfme_billing_settings[" + pcfmeadmin.checkoutfieldtext + randomnumber + "][label]");
	pcfmenewPanel.find(".checkout_field_label").attr("value", "" + pcfmeadmin.checkoutfieldtext4 + hash + "");     
	pcfmenewPanel.find(".checkout_field_width_new").attr("name", "pcfme_billing_settings[" + pcfmeadmin.checkoutfieldtext + randomnumber + "][width]");
	pcfmenewPanel.find(".checkout_field_required").attr("name", "pcfme_billing_settings[" + pcfmeadmin.checkoutfieldtext + randomnumber + "][required]");
	
	pcfmenewPanel.find(".checkout_field_clear").attr("name", "pcfme_billing_settings[" + pcfmeadmin.checkoutfieldtext + randomnumber + "][clear]");
	pcfmenewPanel.find(".checkout_field_placeholder").attr("name", "pcfme_billing_settings[" + pcfmeadmin.checkoutfieldtext + randomnumber + "][placeholder]");
	pcfmenewPanel.find(".pcfme_checkout_field_extraclass_new").attr("name", "pcfme_billing_settings[" + pcfmeadmin.checkoutfieldtext + randomnumber + "][extraclass]");
	pcfmenewPanel.find(".pcfme_checkout_field_option_values_new").attr("name", "pcfme_billing_settings[" + pcfmeadmin.checkoutfieldtext + randomnumber + "][options]");
	pcfmenewPanel.find(".checkout_field_visibility_new").attr("name", "pcfme_billing_settings[" + pcfmeadmin.checkoutfieldtext + randomnumber + "][visibility]");
	pcfmenewPanel.find(".checkout_field_products_new").attr("name", "pcfme_billing_settings[" + pcfmeadmin.checkoutfieldtext + randomnumber+ "][products][]");
	pcfmenewPanel.find(".add-condition-button").attr("keyno", "" + pcfmeadmin.checkoutfieldtext + randomnumber+ "");
	pcfmenewPanel.find(".conditional_fields_div_wrapper").addClass("conditional_fields_div_wrapper_" + pcfmeadmin.checkoutfieldtext + randomnumber+ "");
	pcfmenewPanel.find(".checkout_field_category_new").attr("name", "pcfme_billing_settings[" + pcfmeadmin.checkoutfieldtext + randomnumber+ "][category][]");
	pcfmenewPanel.find(".checkout_field_validate_new").attr("name", "pcfme_billing_settings[" + pcfmeadmin.checkoutfieldtext + randomnumber+ "][validate][]");
	pcfmenewPanel.find(".checkout_field_orderedition").attr("name", "pcfme_billing_settings[" + pcfmeadmin.checkoutfieldtext + randomnumber + "][orderedition]");
	pcfmenewPanel.find(".checkout_field_emailfields").attr("name", "pcfme_billing_settings[" + pcfmeadmin.checkoutfieldtext + randomnumber + "][emailfields]");
	pcfmenewPanel.find(".checkout_field_pdfinvoice").attr("name", "pcfme_billing_settings[" + pcfmeadmin.checkoutfieldtext + randomnumber + "][pdfinvoice]");
	pcfmenewPanel.find(".checkout_field_disable_past_dates").attr("name", "pcfme_billing_settings[" + pcfmeadmin.checkoutfieldtext + randomnumber + "][disable_past]");
	pcfmenewPanel.find(".checkout_field_editaddress").attr("name", "pcfme_billing_settings[" + pcfmeadmin.checkoutfieldtext + randomnumber + "][editaddress]");

	pcfmenewPanel.find(".checkout_field_width_new").select2({width: "250px",minimumResultsForSearch: -1});
	pcfmenewPanel.find(".checkout_field_visibility_new").select2({width: "250px",minimumResultsForSearch: -1});
	pcfmenewPanel.find(".checkout_field_conditional_showhide_new").select2({width: "70px",minimumResultsForSearch: -1});
	pcfmenewPanel.find(".checkout_field_conditional_parentfield_new").select2({width: "170px"});
	pcfmenewPanel.find(".checkout_field_type_new").select2({width: "250px",minimumResultsForSearch: -1});
	pcfmenewPanel.find(".checkout_field_validate_new").select2({width: "250px"});
	
    pcfmenewPanel.find(".checkout_field_category_new").select2({width: "400px" }); 
	
	pcfmenewPanel.find(".checkout_field_products_new").select2({
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
	

	
	pcfmenewPanel.find('.pcfme_checkout_field_option_values_new').tagEditor({
     delimiter: ',|', /* pipe and comma */
	 forceLowercase: false,
     placeholder: pcfmeadmin.optionplaceholder
    });
	
	pcfmenewPanel.find('.pcfme_checkout_field_extraclass_new').tagEditor({
      delimiter: ', ', /* space and comma */
      placeholder: pcfmeadmin.classplaceholder
    });


    var mgindex               = 1;


    pcfmenewPanel.find('.add-condition-button').on('click',function(){

    	


    	var fieldkey               = "" + pcfmeadmin.checkoutfieldtext + randomnumber + "";

    	var conditionalhtml        = '';

    	var mntype                 = "billing";

    	var selecthtml             = pcfmeadmin.billing_select;
  

        var showtext               = pcfmeadmin.showtext;
        var hidetext               = pcfmeadmin.hidetext;
        var valuetext              = pcfmeadmin.valuetext
        var equaltext              = pcfmeadmin.equaltext;

        var select1                = '<select class="checkout_field_conditional_showhide" name="pcfme_'+mntype+'_settings['+fieldkey+'][conditional]['+mgindex+'][showhide]"><option value="open" selected="">'+showtext+'</option><option value="hide">'+hidetext+'</option></select>';
        var span1                  = '<span class="pcfmeformfield"><strong>&emsp;'+valuetext+'&emsp;&nbsp;&nbsp;</strong></span>';
        var span2                  = '<span class="pcfmeformfield"><strong>&emsp;'+equaltext+'&emsp;</strong></span>';

        var input1                 = '&nbsp;&nbsp;<input type="text" class="checkout_field_conditional_equalto" name="pcfme_'+mntype+'_settings['+fieldkey+'][conditional]['+mgindex+'][equalto]" value="">';
        
        var deletei                = '&emsp;<span class="glyphicon glyphicon-trash pcfme-remove-condition"></span>';
        
        conditionalhtml           += '<div class="conditional-row">'+select1+''+span1+''+selecthtml+''+span2+''+input1+''+deletei+'</div>';

				 
				 
				 
 

    	$(this).parents('.checkout_field_conditional_tr').find('.conditional_fields_div_wrapper').append(conditionalhtml);

    	$(this).parents('.checkout_field_conditional_tr').find('.checkout_field_conditional_showhide').select2({
    		width: "100px",
    		minimumResultsForSearch: -1
    	});

    	$(this).parents('.checkout_field_conditional_tr').find('.checkout_field_conditional_parentfield').attr('name','pcfme_'+mntype+'_settings['+fieldkey+'][conditional]['+mgindex+'][parentfield]');

    	$(this).parents('.checkout_field_conditional_tr').find('.checkout_field_conditional_parentfield').select2({width: "250px" });
        
        
        mgindex++;


        $('.pcfme-remove-condition').on('click',function(){

           $(this).parents('.conditional-row').remove();
            

        });

    	pcfmenewPanel.find('.conditional_fields_div_wrapper').append(html);

    
    });
	
	
	$("#accordion").append(pcfmenewPanel.fadeIn());
	
	
});

$("#add-shipping-field").on("click", function () {
   var pcfmenewPanel = pcfmecheckoutfield.clone();
   hash++;
   pcfmenewPanel.find(".collapse").removeClass("in");
   pcfmenewPanel.find(".accordion-toggle").attr("href", "#pcfme" + (hash));
   pcfmenewPanel.find(".new-field-label").append(pcfmeadmin.checkoutfieldtext5 + hash);
    
		
	pcfmenewPanel.find(".checkoutfield").attr("id", "pcfme_list_items_" + (hash));
	pcfmenewPanel.find(".panel-collapse").attr("id", "pcfme" + (hash));
	
        var randomnumber2=Math.floor(Math.random()*1000);
        
	pcfmenewPanel.find(".checkout_field_type_new").attr("name", "pcfme_shipping_settings[" + pcfmeadmin.checkoutfieldtext2 + randomnumber2 + "][type]");
	pcfmenewPanel.find(".checkout_field_label").attr("name", "pcfme_shipping_settings[" + pcfmeadmin.checkoutfieldtext2 + randomnumber2 + "][label]");
	pcfmenewPanel.find(".checkout_field_label").attr("value", "" + pcfmeadmin.checkoutfieldtext5 + hash + "");
	pcfmenewPanel.find(".checkout_field_width_new").attr("name", "pcfme_shipping_settings[" + pcfmeadmin.checkoutfieldtext2 + randomnumber2 + "][width]");
	pcfmenewPanel.find(".checkout_field_required").attr("name", "pcfme_shipping_settings[" + pcfmeadmin.checkoutfieldtext2 + randomnumber2 + "][required]");
	
	pcfmenewPanel.find(".checkout_field_clear").attr("name", "pcfme_shipping_settings[" + pcfmeadmin.checkoutfieldtext2 + randomnumber2 + "][clear]");
	pcfmenewPanel.find(".checkout_field_placeholder").attr("name", "pcfme_shipping_settings[" + pcfmeadmin.checkoutfieldtext2 + randomnumber2 + "][placeholder]");
	pcfmenewPanel.find(".pcfme_checkout_field_extraclass_new").attr("name", "pcfme_shipping_settings[" + pcfmeadmin.checkoutfieldtext2 + randomnumber2 + "][extraclass]");
	pcfmenewPanel.find(".pcfme_checkout_field_option_values_new").attr("name", "pcfme_shipping_settings[" + pcfmeadmin.checkoutfieldtext2 + randomnumber2 + "][options]");
	pcfmenewPanel.find(".checkout_field_visibility_new").attr("name", "pcfme_shipping_settings[" + pcfmeadmin.checkoutfieldtext2 + randomnumber2 + "][visibility]");
	pcfmenewPanel.find(".checkout_field_products_new").attr("name", "pcfme_shipping_settings[" + pcfmeadmin.checkoutfieldtext2 + randomnumber2 + "][products][]");
	pcfmenewPanel.find(".add-condition-button").attr("keyno", "" + pcfmeadmin.checkoutfieldtext + randomnumber2+ "");
	pcfmenewPanel.find(".conditional_fields_div_wrapper").addClass("conditional_fields_div_wrapper_" + pcfmeadmin.checkoutfieldtext + randomnumber2+ "");
	pcfmenewPanel.find(".checkout_field_category_new").attr("name", "pcfme_shipping_settings[" + pcfmeadmin.checkoutfieldtext2 + randomnumber2 + "][category][]");
	pcfmenewPanel.find(".checkout_field_conditional_showhide_new").attr("name", "pcfme_shipping_settings[" + pcfmeadmin.checkoutfieldtext2 + randomnumber2+ "][conditional][showhide]");
	pcfmenewPanel.find(".checkout_field_conditional_parentfield_new").attr("name", "pcfme_shipping_settings[" + pcfmeadmin.checkoutfieldtext2 + randomnumber2+ "][conditional][parentfield]");
	pcfmenewPanel.find(".checkout_field_conditional_equalto_new").attr("name", "pcfme_shipping_settings[" + pcfmeadmin.checkoutfieldtext2 + randomnumber2+ "][conditional][equalto]");
	pcfmenewPanel.find(".checkout_field_validate_new").attr("name", "pcfme_shipping_settings[" + pcfmeadmin.checkoutfieldtext2 + randomnumber2 + "][validate][]");
	pcfmenewPanel.find(".checkout_field_orderedition").attr("name", "pcfme_shipping_settings[" + pcfmeadmin.checkoutfieldtext2 + randomnumber2 + "][orderedition]");
	pcfmenewPanel.find(".checkout_field_emailfields").attr("name", "pcfme_shipping_settings[" + pcfmeadmin.checkoutfieldtext2 + randomnumber2 + "][emailfields]");
	pcfmenewPanel.find(".checkout_field_pdfinvoice").attr("name", "pcfme_shipping_settings[" + pcfmeadmin.checkoutfieldtext2 + randomnumber2 + "][pdfinvoice]");
	pcfmenewPanel.find(".checkout_field_disable_past_dates").attr("name", "pcfme_shipping_settings[" + pcfmeadmin.checkoutfieldtext2 + randomnumber2 + "][disable_past]");
	pcfmenewPanel.find(".checkout_field_editaddress").attr("name", "pcfme_shipping_settings[" + pcfmeadmin.checkoutfieldtext2 + randomnumber2 + "][editaddress]");
	
	pcfmenewPanel.find(".checkout_field_width_new").select2({width: "250px",minimumResultsForSearch: -1});
	pcfmenewPanel.find(".checkout_field_visibility_new").select2({width: "250px",minimumResultsForSearch: -1});
	pcfmenewPanel.find(".checkout_field_conditional_showhide_new").select2({width: "70px",minimumResultsForSearch: -1});
	pcfmenewPanel.find(".checkout_field_conditional_parentfield_new").select2({width: "170px"});
	pcfmenewPanel.find(".checkout_field_type_new").select2({width: "250px",minimumResultsForSearch: -1});
	pcfmenewPanel.find(".checkout_field_validate_new").select2({width: "250px"});
	pcfmenewPanel.find(".checkout_field_products_new").select2({
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
    pcfmenewPanel.find(".checkout_field_category_new").select2({width: "400px" }); 
	
	pcfmenewPanel.find('.pcfme_checkout_field_option_values_new').tagEditor({
     delimiter: ',|', /* pipe and comma */
	 forceLowercase: false,
     placeholder: pcfmeadmin.optionplaceholder
    });
	
	pcfmenewPanel.find('.pcfme_checkout_field_extraclass_new').tagEditor({
      delimiter: ', ', /* space and comma */
	  
      placeholder: pcfmeadmin.classplaceholder
    });

    var mgindex                = 1;


    pcfmenewPanel.find('.add-condition-button').on('click',function(){


    	var fieldkey               = "" + pcfmeadmin.checkoutfieldtext2 + randomnumber2 + "";

    	var conditionalhtml        = '';

    	var mntype                 = "shipping";

    	var selecthtml             = pcfmeadmin.shipping_select;

        

        var showtext               = pcfmeadmin.showtext;
        var hidetext               = pcfmeadmin.hidetext;
        var valuetext              = pcfmeadmin.valuetext
        var equaltext              = pcfmeadmin.equaltext;

        var select1                = '<select class="checkout_field_conditional_showhide" name="pcfme_'+mntype+'_settings['+fieldkey+'][conditional]['+mgindex+'][showhide]"><option value="open" selected="">'+showtext+'</option><option value="hide">'+hidetext+'</option></select>';
        var span1                  = '<span class="pcfmeformfield"><strong>&emsp;'+valuetext+'&emsp;&nbsp;&nbsp;</strong></span>';
        var span2                  = '<span class="pcfmeformfield"><strong>&emsp;'+equaltext+'&emsp;</strong></span>';

        var input1                 = '&nbsp;&nbsp;<input type="text" class="checkout_field_conditional_equalto" name="pcfme_'+mntype+'_settings['+fieldkey+'][conditional]['+mgindex+'][equalto]" value="">';
        
        var deletei                = '&emsp;<span class="glyphicon glyphicon-trash pcfme-remove-condition"></span>';
        
        conditionalhtml           += '<div class="conditional-row">'+select1+''+span1+''+selecthtml+''+span2+''+input1+''+deletei+'</div>';

				 
				 
				 
 

    	$(this).parents('.checkout_field_conditional_tr').find('.conditional_fields_div_wrapper').append(conditionalhtml);

    	$(this).parents('.checkout_field_conditional_tr').find('.checkout_field_conditional_showhide').select2({
    		width: "100px",
    		minimumResultsForSearch: -1
    	});

    	$(this).parents('.checkout_field_conditional_tr').find('.checkout_field_conditional_parentfield').attr('name','pcfme_'+mntype+'_settings['+fieldkey+'][conditional]['+mgindex+'][parentfield]');

    	$(this).parents('.checkout_field_conditional_tr').find('.checkout_field_conditional_parentfield').select2({width: "250px" });
        
        
        mgindex++;


        $('.pcfme-remove-condition').on('click',function(){

           $(this).parents('.conditional-row').remove();
            

        });

    	pcfmenewPanel.find('.conditional_fields_div_wrapper').append(html);

    
    });

	
	$("#accordion").append(pcfmenewPanel.fadeIn());
	
	
});


$("#add-additional-field").on("click", function () {
   var pcfmenewPanel = pcfmecheckoutfield.clone();
    hash++;
    pcfmenewPanel.find(".collapse").removeClass("in");
    pcfmenewPanel.find(".accordion-toggle").attr("href", "#pcfme" + (hash));
    pcfmenewPanel.find(".new-field-label").append(pcfmeadmin.checkoutfieldtext6 + hash);
    
		
	pcfmenewPanel.find(".checkoutfield").attr("id", "pcfme_list_items_" + (hash));
	pcfmenewPanel.find(".panel-collapse").attr("id", "pcfme" + (hash));
	
        var randomnumber3=Math.floor(Math.random()*1000);
        
	pcfmenewPanel.find(".checkout_field_type_new").attr("name", "pcfme_additional_settings[" + pcfmeadmin.checkoutfieldtext3 + randomnumber3 + "][type]");
	pcfmenewPanel.find(".checkout_field_label").attr("name", "pcfme_additional_settings[" + pcfmeadmin.checkoutfieldtext3 + randomnumber3 + "][label]");
	pcfmenewPanel.find(".checkout_field_label").attr("value", "" + pcfmeadmin.checkoutfieldtext6 + hash + "");
	pcfmenewPanel.find(".checkout_field_width_new").attr("name", "pcfme_additional_settings[" + pcfmeadmin.checkoutfieldtext3 + randomnumber3 + "][width]");
	pcfmenewPanel.find(".checkout_field_required").attr("name", "pcfme_additional_settings[" + pcfmeadmin.checkoutfieldtext3 + randomnumber3 + "][required]");
	
	pcfmenewPanel.find(".checkout_field_clear").attr("name", "pcfme_additional_settings[" + pcfmeadmin.checkoutfieldtext3 + randomnumber3 + "][clear]");
	pcfmenewPanel.find(".checkout_field_placeholder").attr("name", "pcfme_additional_settings[" + pcfmeadmin.checkoutfieldtext3 + randomnumber3 + "][placeholder]");
	pcfmenewPanel.find(".pcfme_checkout_field_extraclass_new").attr("name", "pcfme_additional_settings[" + pcfmeadmin.checkoutfieldtext3 + randomnumber3 + "][extraclass]");
	pcfmenewPanel.find(".pcfme_checkout_field_option_values_new").attr("name", "pcfme_additional_settings[" + pcfmeadmin.checkoutfieldtext3 + randomnumber3 + "][options]");
	pcfmenewPanel.find(".checkout_field_visibility_new").attr("name", "pcfme_additional_settings[" + pcfmeadmin.checkoutfieldtext3 + randomnumber3 + "][visibility]");
	pcfmenewPanel.find(".checkout_field_products_new").attr("name", "pcfme_additional_settings[" + pcfmeadmin.checkoutfieldtext3 + randomnumber3 + "][products][]");
	pcfmenewPanel.find(".add-condition-button").attr("keyno", "" + pcfmeadmin.checkoutfieldtext + randomnumber3+ "");
	pcfmenewPanel.find(".conditional_fields_div_wrapper").addClass("conditional_fields_div_wrapper_" + pcfmeadmin.checkoutfieldtext + randomnumber3+ "");
	pcfmenewPanel.find(".checkout_field_category_new").attr("name", "pcfme_additional_settings[" + pcfmeadmin.checkoutfieldtext3 + randomnumber3 + "][category][]");
	pcfmenewPanel.find(".checkout_field_conditional_showhide_new").attr("name", "pcfme_additional_settings[" + pcfmeadmin.checkoutfieldtext3 + randomnumber3+ "][conditional][showhide]");
	pcfmenewPanel.find(".checkout_field_conditional_parentfield_new").attr("name", "pcfme_additional_settings[" + pcfmeadmin.checkoutfieldtext3 + randomnumber3+ "][conditional][parentfield]");
	pcfmenewPanel.find(".checkout_field_conditional_equalto_new").attr("name", "pcfme_additional_settings[" + pcfmeadmin.checkoutfieldtext3 + randomnumber3+ "][conditional][equalto]");
	pcfmenewPanel.find(".checkout_field_orderedition").attr("name", "pcfme_additional_settings[" + pcfmeadmin.checkoutfieldtext3 + randomnumber3 + "][orderedition]");
	pcfmenewPanel.find(".checkout_field_emailfields").attr("name", "pcfme_additional_settings[" + pcfmeadmin.checkoutfieldtext3 + randomnumber3 + "][emailfields]");
	pcfmenewPanel.find(".checkout_field_pdfinvoice").attr("name", "pcfme_additional_settings[" + pcfmeadmin.checkoutfieldtext3 + randomnumber3 + "][pdfinvoice]");
	pcfmenewPanel.find(".checkout_field_disable_past_dates").attr("name", "pcfme_additional_settings[" + pcfmeadmin.checkoutfieldtext3 + randomnumber3 + "][disable_past]");
	pcfmenewPanel.find(".checkout_field_editaddress").attr("name", "pcfme_additional_settings[" + pcfmeadmin.checkoutfieldtext3 + randomnumber3 + "][editaddress]");
	
	pcfmenewPanel.find(".checkout_field_width_new").select2({width: "250px",minimumResultsForSearch: -1});
	pcfmenewPanel.find(".checkout_field_visibility_new").select2({width: "250px",minimumResultsForSearch: -1});
	pcfmenewPanel.find(".checkout_field_conditional_showhide_new").select2({width: "70px",minimumResultsForSearch: -1});
	pcfmenewPanel.find(".checkout_field_conditional_parentfield_new").select2({width: "170px"});
	pcfmenewPanel.find(".checkout_field_type_new").select2({width: "250px",minimumResultsForSearch: -1});
	pcfmenewPanel.find(".checkout_field_products_new").select2({
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
    pcfmenewPanel.find(".checkout_field_category_new").select2({width: "400px" }); 
	
	pcfmenewPanel.find('.pcfme_checkout_field_option_values_new').tagEditor({
     delimiter: ',|', /* pipe and comma */
     forceLowercase: false,
     placeholder: pcfmeadmin.optionplaceholder
    });
	
	pcfmenewPanel.find('.pcfme_checkout_field_extraclass_new').tagEditor({
      delimiter: ', ', /* space and comma */
      placeholder: pcfmeadmin.classplaceholder
    });

    var mgindex                = 1;


    pcfmenewPanel.find('.add-condition-button').on('click',function(){

        

    	var fieldkey               = "" + pcfmeadmin.checkoutfieldtext3 + randomnumber3 + "";

    	var conditionalhtml        = '';

    	var mntype                 = "additional";

    	

    	var selecthtml             = pcfmeadmin.additional_select;
  

        var showtext               = pcfmeadmin.showtext;
        var hidetext               = pcfmeadmin.hidetext;
        var valuetext              = pcfmeadmin.valuetext
        var equaltext              = pcfmeadmin.equaltext;

        var select1                = '<select class="checkout_field_conditional_showhide" name="pcfme_'+mntype+'_settings['+fieldkey+'][conditional]['+mgindex+'][showhide]"><option value="open" selected="">'+showtext+'</option><option value="hide">'+hidetext+'</option></select>';
        var span1                  = '<span class="pcfmeformfield"><strong>&emsp;'+valuetext+'&emsp;&nbsp;&nbsp;</strong></span>';
        var span2                  = '<span class="pcfmeformfield"><strong>&emsp;'+equaltext+'&emsp;</strong></span>';

        var input1                 = '&nbsp;&nbsp;<input type="text" class="checkout_field_conditional_equalto" name="pcfme_'+mntype+'_settings['+fieldkey+'][conditional]['+mgindex+'][equalto]" value="">';
        
        var deletei                = '&emsp;<span class="glyphicon glyphicon-trash pcfme-remove-condition"></span>';
        
        conditionalhtml           += '<div class="conditional-row">'+select1+''+span1+''+selecthtml+''+span2+''+input1+''+deletei+'</div>';

				 
				 
				 
 

    	$(this).parents('.checkout_field_conditional_tr').find('.conditional_fields_div_wrapper').append(conditionalhtml);

    	$(this).parents('.checkout_field_conditional_tr').find('.checkout_field_conditional_showhide').select2({
    		width: "100px",
    		minimumResultsForSearch: -1
    	});

    	$(this).parents('.checkout_field_conditional_tr').find('.checkout_field_conditional_parentfield').attr('name','pcfme_'+mntype+'_settings['+fieldkey+'][conditional]['+mgindex+'][parentfield]');

    	$(this).parents('.checkout_field_conditional_tr').find('.checkout_field_conditional_parentfield').select2({width: "250px" });
        
        
        mgindex++;


        $('.pcfme-remove-condition').on('click',function(){

           $(this).parents('.conditional-row').remove();
            

        });

    	pcfmenewPanel.find('.conditional_fields_div_wrapper').append(html);

    
    });
	
	
	$("#accordion").append(pcfmenewPanel.fadeIn());
	
	
});


$("div.pcfme-sortable-list").sortable({
    opacity : 0.7
	
});

$(function() {
$('.checkout_field_type').live('change',function(){
    var typevalue1 = $(this).val();
	if ((typevalue1 == "datepicker") || (typevalue1 == "datetimepicker") || (typevalue1 == "daterangepicker") || (typevalue1 == "datetimerangepicker")) {
		$(this).parents('table:eq(0)').find('.disable_datepicker_tr').show();
	} else {
		$(this).parents('table:eq(0)').find('.disable_datepicker_tr').hide();
	}
});

$('.checkout_field_type_new').live('change',function(){
    var typevalue2 = $(this).val();
	if ((typevalue2 == "datepicker") || (typevalue2 == "datetimepicker") || (typevalue2 == "daterangepicker") || (typevalue2 == "datetimerangepicker")) {
		$(this).parents('table:eq(0)').find('.disable_datepicker_tr').show();
	} else {
		$(this).parents('table:eq(0)').find('.disable_datepicker_tr').hide();
	}
});

$('.checkout_field_visibility').live('change',function(){
    var visibilityvalue2 = $(this).val();
	if (visibilityvalue2 == "product-specific") {
		$(this).parents('table:eq(0)').find('.checkout_field_category_tr').hide();
		$(this).parents('table:eq(0)').find('.checkout_field_conditional_tr').hide();
		$(this).parents('table:eq(0)').find('.checkout_field_products_tr').show();
	} else if (visibilityvalue2 == "category-specific") {
		$(this).parents('table:eq(0)').find('.checkout_field_products_tr').hide();
		$(this).parents('table:eq(0)').find('.checkout_field_conditional_tr').hide();
		$(this).parents('table:eq(0)').find('.checkout_field_category_tr').show();
	} else if (visibilityvalue2 == "field-specific") {
		$(this).parents('table:eq(0)').find('.checkout_field_products_tr').hide();
		$(this).parents('table:eq(0)').find('.checkout_field_category_tr').hide();
		$(this).parents('table:eq(0)').find('.checkout_field_conditional_tr').show();
	
	} else {
		$(this).parents('table:eq(0)').find('.checkout_field_category_tr').hide();
		$(this).parents('table:eq(0)').find('.checkout_field_products_tr').hide();
		$(this).parents('table:eq(0)').find('.checkout_field_conditional_tr').hide();
	}
});

$('.checkout_field_visibility_new').live('change',function(){
    var visibilityvalue2 = $(this).val();
	if (visibilityvalue2 == "product-specific") {
		$(this).parents('table:eq(0)').find('.checkout_field_category_tr').hide();
		$(this).parents('table:eq(0)').find('.checkout_field_conditional_tr').hide();
		$(this).parents('table:eq(0)').find('.checkout_field_products_tr').show();
	} else if (visibilityvalue2 == "category-specific") {
		$(this).parents('table:eq(0)').find('.checkout_field_products_tr').hide();
		$(this).parents('table:eq(0)').find('.checkout_field_conditional_tr').hide();
		$(this).parents('table:eq(0)').find('.checkout_field_category_tr').show();
	} else if (visibilityvalue2 == "field-specific") {
		$(this).parents('table:eq(0)').find('.checkout_field_products_tr').hide();
		$(this).parents('table:eq(0)').find('.checkout_field_category_tr').hide();
		$(this).parents('table:eq(0)').find('.checkout_field_conditional_tr').show();
	
	} else {
		$(this).parents('table:eq(0)').find('.checkout_field_category_tr').hide();
		$(this).parents('table:eq(0)').find('.checkout_field_products_tr').hide();
		$(this).parents('table:eq(0)').find('.checkout_field_conditional_tr').hide();
	}
});



$('.pcfme_checkout_field_option_values').tagEditor({
    delimiter: ',|', /* pipe and comma */
	forceLowercase: false,
    placeholder: pcfmeadmin.optionplaceholder
});

$('.pcfme_checkout_field_extraclass').tagEditor({
    delimiter: ', ', /* space and comma */
    placeholder: pcfmeadmin.classplaceholder
});

});



$(document).on('click', '.glyphicon-remove-circle', function () {

   var result = confirm(pcfmeadmin.removealert);
   if (result==true) {
     $(this).parents('.panel').get(0).remove();
   }
   });

$("#restore-billing-fields").on('click',function() {
   var result2 = confirm(pcfmeadmin.restorealert);
   if (result2 == true) {
     
     $.ajax({
            data: {action: "restore_billing_fields" },
            type: 'POST',
            url: ajaxurl,
            success: function( response ) { 
			  window.location.reload();
			}
        });
   }
});

$("#restore-shipping-fields").on('click',function() {
   var result3 = confirm(pcfmeadmin.restorealert);
   if (result3 == true) {
     
     $.ajax({
            data: {action: "restore_shipping_fields" },
            type: 'POST',
            url: ajaxurl,
            success: function( response ) { 
			  window.location.reload();
			}
        });
   }
});


    

    $('.add-condition-button').on('click',function(event){
        
        event.preventDefault();

        event.mnindex       = $(this).attr("mnindex");

    	var fieldkey        = $(this).attr("keyno");

    	var html            = '';

    	event.mntype        = $(this).attr("mntype");

    	

    	if (event.mntype) {

    	    switch(event.mntype) {

                case "billing":
                    var selecthtml = pcfmeadmin.billing_select;
                break;

                case "shipping":
                    var selecthtml = pcfmeadmin.shipping_select;
                break;

                case "additional":
                    var selecthtml = pcfmeadmin.additional_select;
                break;
            }
        }

        var showtext   = pcfmeadmin.showtext;
        var hidetext   = pcfmeadmin.hidetext;
        var valuetext  = pcfmeadmin.valuetext
        var equaltext  = pcfmeadmin.equaltext;

        var select1  = '<select class="checkout_field_conditional_showhide" name="pcfme_'+event.mntype+'_settings['+fieldkey+'][conditional]['+event.mnindex+'][showhide]"><option value="open" selected="">'+showtext+'</option><option value="hide">'+hidetext+'</option></select>';
        var span1    = '<span class="pcfmeformfield"><strong>&emsp;'+valuetext+'&emsp;&nbsp;&nbsp;</strong></span>';
        var span2    = '<span class="pcfmeformfield"><strong>&emsp;'+equaltext+'&emsp;</strong></span>';

        var input1   = '&nbsp;&nbsp;<input type="text" class="checkout_field_conditional_equalto" name="pcfme_'+event.mntype+'_settings['+fieldkey+'][conditional]['+event.mnindex+'][equalto]" value="">';
        
        var deletei  = '&emsp;&nbsp;<span class="glyphicon glyphicon-trash pcfme-remove-condition"></span>';
        
        html        += '<div class="conditional-row">'+select1+''+span1+''+selecthtml+''+span2+''+input1+''+deletei+'</div>';

				 
				 
				 
 

    	$(this).parents('.checkout_field_conditional_tr').find('.conditional_fields_div_wrapper').append(html);

    	$(this).parents('.checkout_field_conditional_tr').find('.checkout_field_conditional_showhide').select2({
    		width: "100px",
    		minimumResultsForSearch: -1
    	});

    	

    	$(this).parents('.checkout_field_conditional_tr').find('.checkout_field_conditional_parentfield option[value='+fieldkey+']').remove();

    	$(this).parents('.checkout_field_conditional_tr').find('.checkout_field_conditional_parentfield').attr('name','pcfme_'+event.mntype+'_settings['+fieldkey+'][conditional]['+event.mnindex+'][parentfield]');

    	$(this).parents('.checkout_field_conditional_tr').find('.checkout_field_conditional_parentfield').select2({width: "250px" });
        
        
        event.mnindex++;

        $(this).attr("mnindex",event.mnindex);


        $('.pcfme-remove-condition').on('click',function(){

           $(this).parents('.conditional-row').remove();
            

        });
    });



    $('.pcfme-remove-condition').on('click',function(){

           $(this).parents('.conditional-row').remove();
            

    });
    

    $('.thankyou_fields_location').select2({ 
    	minimumResultsForSearch: -1,
    	width:"400px" });
    


 
});



