<?php
   $extra_settings    = $this->extra_settings;
   $extra_settings    = array_filter($extra_settings);
?>
<table class="table">
    <tr>

	    <td><label for="estimate_name"><?php  echo esc_html__('Fields display on Thank You Page','pfcme'); ?></label></td>

	    <td>
			<select class="thankyou_fields_location" name="pcfme_extra_settings[thankyou_fields_location]"> 
			     <option value="after" <?php if (isset($extra_settings['thankyou_fields_location']) && ($extra_settings['thankyou_fields_location'] == "after")) { echo 'selected'; } ?>><?php  echo esc_html__('After Thank you Page ( woocommerce_thankyou hook )','pcfme'); ?></a>
				 <option value="before" <?php if (isset($extra_settings['thankyou_fields_location']) && ($extra_settings['thankyou_fields_location'] == "before")) { echo 'selected'; } ?>><?php  echo esc_html__('Before Thank you page ( woocommerce_before_thankyou hook )','pcfme'); ?></a>
			</select> 
	    </td>
	</tr>
</table>