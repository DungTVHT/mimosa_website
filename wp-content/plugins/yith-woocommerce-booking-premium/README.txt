=== YITH Booking and Appointment for WooCommerce Premium ===

== Changelog ==

= Version 2.1.3 - Released: May 23, 2019 =
* New - custom extra costs per product
* Update - plugin framework
* Fix - issue when sorting and managing price and availability rules
* Fix - prevent issue when creating booking from order with wrong data
* Fix - issue on booking edit page if the related product was deleted
* Fix - outlook issue for emails with iCal attached
* Fix - issue when creating booking services in product edit page
* Tweak - possibility to set the price to a specific value in Price Rules
* Tweak - UX improvement for price rules
* Tweak - UX improvement for availability rules
* Tweak - include check-in and check-out times when attaching iCal in emails
* Tweak - prevent notice in cart validation
* Tweak - prevent issues in product row actions
* Tweak - delete booking product cache after creating a new booking
* Tweak - improved style
* Dev - added yith_wcbk_show_user_info_in_pdf_only_for_admin filter
* Dev - added yith_wcbk_allow_creating_people_types_in_product_edit_page filter

= Version 2.1.2 - Released: Apr 23, 2019 =
* New - set decimal prices for services
* Fix - availability issue
* Fix - search form issue when searching for booking products with time on a specific date
* Fix - cancel bookings when resuming orders to prevent multiple paid bookings when the payment fails
* Fix - time condition if the from time is greater than the to time
* Tweak - allow to translate custom labels through WPML String Translations
* Tweak - fixed order awaiting payment issue in WooCommerce 3.6
* Tweak - fixed issue with minimum duration
* Tweak - use CRUD to save meta in orders
* Dev - added yith_wcbk_product_availability_rules_when_checking_for_availability filter
* Dev - PHPUnit Tests: deprecated get_booking_prop tests

= Version 2.1.1 - Released: Mar 29, 2019 =
* New - support to WooCommerce 3.6.0 RC 1
* Update - language files
* Update - YITH Booking theme 1.1.3
* Fix - integration with Multi Vendor: issue when associating a booking service to vendors
* Fix - price calculation with fixed duration
* Fix - prevent memory issues
* Tweak - check for booking availability directly in cart
* Tweak - added product link in error cart message
* Tweak - improved performances
* Dev - added yith_wcbk_request_confirmation_login_required_notice filter
* Dev - added yith_wcbk_booking_product_calculated_price_totals_formatted filter

= Version 2.1.0 - Released: Mar 18, 2019 =

* New - completely redesigned product settings panel to improve the plugin usability and to make it easier to set up booking products
* New - extra costs
* New - weekly discount
* New - monthly discount
* New - last minute discount
* New - extra price for every person added to a specified value
* New - possibility to show details about booking price totals on frontend
* New - create a people type directly in product page (via AJAX)
* New - create services directly in product page (via AJAX)
* New - multiply base price by number of people
* New - multiply fixed base fee by number of people
* New - tooltip in booking service shortcode
* Update - YITH Booking theme 1.1.2
* Update - language files
* Fix - WPML integration
* Fix - availability time range issue
* Fix - availability rule issue when overriding a non-bookable rule
* Fix - js date issue on calendar on due to Daylight Saving Time
* Fix - search form results when there are hourly and per-minute booking products
* Fix - removed arguments in product links in search form results on hourly and per-minute booking products
* Fix - cache issue on non-available dates with external service synchronization
* Fix - added service quantities when paying for booking that requires confirmation
* Fix - integration with YITH WooCommerce Deposits and Down Payments: prevent deposits on request confirmation bookings
* Fix - issue when counting people as separate booking
* Fix - person type counting issue in booking form when checking for availability
* Fix - person types issue in Booking form
* Fix - issue when translating 'View cart' text
* Fix - show people type only if published
* Tweak - improved Booking Form style
* Dev - WooCommerce CRUD for Booking products
* Dev - added yith_wcbk_booking_product_last_minute_discount_applied_on filter
* Dev - added yith_wcbk_booking_product_calculated_price_totals filter
* Dev - added yith_wcbk_product_get_not_available_dates filter


= Version 2.0.10 - Released: Feb 04, 2019 =

* Update - plugin framework
* Update - language files
* Fix - warning when saving product

= Version 2.0.9 - Released: Jan 16, 2019 =

* Update - YITH Booking theme 1.1.1
* Update - plugin framework
* Update - language files
* Fix - search form issue in combination with WPML
* Fix - issue when creating Bookings in Create Booking page in combination with WPML
* Fix - date format in orders for hourly and per-minute booking products
* Fix - integration with Multi Vendor: allow vendor to edit their own services
* Fix - cancelled by customer notification
* Fix - issues when searching for bookings when permalink structure is set to plain
* Fix - translation issue for day/days text
* Fix - month calendar issue
* Fix - calendar style issue
* Fix - sorting fields in Search Forms
* Fix - non well formed numeric value in Search form results
* Fix - allowed days in datepicker can be updated
* Fix - pagination and sorting when search form results are shown in shop page
* Tweak - set default people to empty in Search Forms
* Tweak - fixed calendar issue
* Tweak - duration unit strings to downcase
* Dev - added yith_wcbk_search_form_start_date_input_data filter
* Dev - added yith_wcbk_booking_product_calculated_price filter
* Dev - added yith_wcbk_booking_product_get_calculated_price_html filter
* Dev - added yith_wcbk_booking_product_get_price filter
* Dev - added yith_wcbk_format_duration function
* Dev - added yith_wcbk_booking_services_separator filter
* Dev - added yith_wcbk_booking_services_html filter
* Dev - added yith_wcbk_booking_services_html function

= Version 2.0.8 - Released: Dec 05, 2018 =

* New - support to WordPress 5
* New - search form results include booking products with time if there is at least one slot available in the selected dates
* New - possibility to hide services in Search Forms only
* New - set Geocode API key different by Google Maps API key to allow different restriction settings for the API keys
* Update - YITH Booking theme 1.1.0: support to WordPress 5 and Gutenberg, option to enable/disable product gallery in header through WP Customizer, improved style and so on...
* Update - language files
* Fix - YITH WooCommerce Request a Quote integration: display quantity for services in quotes
* Fix - issue when showing Booking Map in Quick View
* Fix - save _booking_id meta data in order items to prevent creation of multiple booking from the same order item
* Fix - display quantity for services in order item meta
* Fix - default value for timeselect
* Fix - service quantity issue for booking with 'request confirmation' option enabled
* Fix - add to cart validation for all day bookings
* Fix - error message in cart validation for max bookings per unit reached
* Fix - messages for non-available reasons
* Fix - check for bookings and booking product in cart when validating add-to-cart for max bookings per unit
* Fix - YITH Deposits integration: hide deposit form in widget when it's closed in mobile
* Fix - cache availability issue when saving global availability
* Fix - check for minimum people when checking for availability
* Fix - regenerate booking product data when booking status changes, if needed
* Fix - availability issue on translated booking products in combination with WPML
* Tweak - set order_item_id meta in bookings after creating orders for 'request confirmation' bookings
* Tweak - prevent warning with PHP 7
* Tweak - improved calendar when showing End Dates for booking with min duration set
* Tweak - fixed js issue with ECMAScript < 6
* Tweak - fixed minor issue when getting location by address with empty address
* Tweak - removed Search Form Results popup from the DOM when it's closed
* Tweak - added CSS class to duration fields based on duration type of the booking product
* Tweak - improved style
* Dev - PHPUnit Test - check for minimum people when checking for availability if 'count_persons_as_bookings' enabled
* Dev - PHPUnit Test - cost ranges
* Dev - added yith_wcbk_booking_product_create_availability_time_array_custom_time_slots filter
* Dev - added yith_wcbk_delete_data_for_booking_products function
* Dev - added yith_wcbk_sync_booking_product_prices function
* Dev - added yith_wck_booking_helper_count_booked_bookings_in_period_get_post_args filter
* Dev - added yith_wck_booking_helper_count_booked_bookings_in_period filter
* Dev - added yith_wcbk_cache_delete_{$object_type}_data action
* Dev - added yith_wcbk_cache_delete_object_data action
* Dev - added yith_wcbk_booking_product_after_regenerating_data action
* Dev - added yith_wcbk_cache_get_object_data_object_id filter
* Dev - added yith_wcbk_cache_get_object_data_{$object_type}_id filter
* Dev - fixed filter name 'yith_wcbk_booking_metabox_info_after_first_column'

= Version 2.0.7 - Released: Oct 23, 2018 =

* New - support to YITH WordPress Test Environment
* New - cost rule by time range
* New - 'Update non-available dates on loading (AJAX)' option, useful to prevent issues when using cache plugins
* New - added non-available reasons in messages
* New - possibility to include buffer in Time increment for hourly and per-minute booking with duration in fixed units
* Fix - issue when searching for category
* Fix - issue when searching for availability with types of people
* Fix - integration with Request a Quote
* Fix - prevent adding booking products in orders through 'Add products' box
* Fix - issue with external sync
* Tweak - fixed hide/show times with changing duration unit
* Tweak - prevent warnings since PHP 7.1
* Tweak - changed Booking name in Booking details on my account
* Tweak - stored booking product location to prevent too many requests for Google places
* Tweak - added 'bk-non-available-date' CSS class in datepicker
* Dev - added yith_wcbk_booking_get_name filter
* Dev - added yith_wcbk_logger_enabled filter
* Dev - added yith_wcbk_js_people_selector_params filter

= Version 2.0.6 - Released: Sep 27, 2018 =

* New - support to 3.5.0-beta.1
* New - option to automatically set paid bookings to complete
* New - possibility to show booking details in order items
* New - Completed Booking email
* New - booking form is auto-filled after clicking on product in search results shown in Shop Page
* New - possibility to edit 'Booking Services' label
* Fix - integration with YITH WooCommerce Request a Quote
* Fix - issues with old PHP versions
* Fix - issue when scrolling booking form on mobile
* Fix - removed people field for booking with no person
* Fix - calendar JS issue when Booking Search form is in Product Single page
* Fix - 'Show More Results' in Search Form results
* Fix - availability issue for 'All day' bookings when adding to cart
* Fix - timezone issue with Google Calendar by adding timezone information in iCal files
* Fix - cache issue with time availability on past dates if you book the product today
* Fix - duration label
* Update - Plugin Framework
* Update - language files
* Tweak - improved style of onoff fields in the table of types of people
* Tweak - split services in email into additional and included
* Tweak - fixed pricing issue when using variables
* Tweak - fixed enabling/disabling cache
* Tweak - fixed datepicker style in Create Booking page
* Tweak - fix product price sync
* Tweak - improved speed performance when searching for booking products through Search Forms
* Tweak - added possibility to set default category in Search Form shortcode
* Tweak - fixed footer action position in Booking PDF
* Tweak - show label instead of input field if min = max for booking duration
* Tweak - removed duplicated yith_wcbk_before_booking_form action
* Dev - added yith_wcbk_get_service_type_labels function
* Dev - added yith_wcbk_split_services_by_type function
* Dev - added yith_wcbk_booking_get_service_names filter
* Dev - added yith_wcbk_assets_bk_global_params filter
* Dev - added yith_wcbk_no_add_to_cart_for_selected_data filter
* Dev - added yith_wcbk_get_max_months_to_load function and filter
* Dev - added yith_wcbk_booking_form_service_info_html filter
* Dev - added yith_wcbk_order_parse_booking_data filter
* Dev - added yith_wcbk_order_get_booking_order_item_details filter
* Dev - added yith_wcbk_is_cache_enabled filter


= Version 2.0.5 - Released: Jul 23, 2018 =

* New - set quantity for Booking Services
* New - 45, 60, 90 minute steps
* New - Buffer between two bookings
* New - possibility to set the first available time as default selected
* New - possibility to search by tags in Booking Search Forms
* New - possibility to edit further labels such as From, To, Duration, Services, People, Total people
* New - French translation (thanks to Josselyn Jayant)
* Fix - added 'select people' label in people selector when no person was selected
* Fix - YITH WooCommerce Request a Quote support
* Fix - click on people selector label
* Fix - 'first available' date issue
* Fix - issue when sorting products by price
* Fix - available date issue in calendar
* Fix - issue with url when synching external bookings
* Fix - iCal import timezone offset
* Tweak - possibility to set values in booking form via query strings
* Update - YITH Booking theme
* Update - language files
* Tweak - improved style
* Tweak - prevent notices on Booking Create page
* Tweak - prevent sync URL issues with booking.com sync
* Tweak - fixed textdomain for untranslatable strings
* Tweak - added login link in notice for request confirmation booking
* Tweak - added option to enable/disable booking cache
* Tweak - added log when errors occur on getting Google Maps location coordinates
* Dev - added yith_wcbk_product_form_get_booking_data_available_args filter
* Dev - added yith_wcbk_cart_get_booking_data_from_request filter
* Dev - added yith_wcbk_before_create_booking_page action
* Dev - added yith_wcbk_calendar_booking_title filter
* Dev - added yith_wcbk_calendar_single_booking_data_booking_title filter
* Dev - added yith_wcbk_booking_get_title filter
* Dev - added yith_wcbk_booking_get_raw_title filter
* Dev - added yith_wcbk_request_confirmation_login_required filter
* Dev - added yith_wcbk_product_sync_price_before action
* Dev - added yith_wcbk_product_sync_price_after action
* Dev - added yith_wcbk_duration_minute_select_options filter
* Dev - added yith_booking_form_params filter
* Dev - added yith_wcbk_get_minimum_minute_increment function
* Dev - added yith_wcbk_get_minimum_minute_increment filter

= Version 2.0.4 - Released: Jun 20, 2018 =

* Fix - YITH Booking Theme package
* Fix - 'All day' booking end date
* Fix - issue with 'All day' bookings in calendar
* Fix - duration issue when saving 'all day' bookings
* Fix - availability in past for hourly and per-minute bookings
* Tweak - prevent issue with out-of-date PHP versions

= Version 2.0.3 - Released: Jun 12, 2018 =

* New - support to WPML Multi Currency
* New - possibility to set booking products as non-virtual to allow shipping for them
* New - added 'search for keyword' in Search Forms
* New - view Booking availability in calendar
* New - view booking calendar for each booking product
* New - 'Check min/max duration' option to choose whether it considers the minimum and maximum duration to show available dates in the calendar
* Fix - issue when adding to cart 'all day' bookings with fixed dates
* Fix - integration with YITH WooCommerce Catalog Mode
* Fix - integration with YITH WooCommerce Multi Vendor
* Fix - datepicker issue in Firefox
* Fix - issue when saving cost rules, including costs with variables
* Fix - style issues in mobile
* Fix - message issues in booking form
* Fix - availability issue with 'All day' booking products
* Fix - calendar issue on iOS devices
* Fix - hidden People details in PDF if the related booking doesn't have persons
* Tweak - added messages directly in Time select to improve usability
* Tweak - improved style
* Tweak - prevent issues when creating PDF
* Update - YITH Booking theme
* Update - Italian language
* Update - Dutch language
* Dev - added yith_wcbk_csv_fields filter
* Dev - added yith_wcbk_csv_field_value filter

= Version 2.0.2 - Released: May 24, 2018 =

* New - support to WordPress 4.9.6
* New - support to WooCommerce 3.4.0
* New - Privacy Policy Guide
* Update - YITH Booking theme 1.0.2
* Fix - style issue in date reange picker
* Tweak - improved frontend style

= Version 2.0.1 - Released: May 21, 2018 =

* Fix - datepicker arrow issue
* Fix - wrong textdomain in some strings
* Fix - unlimited 'max bookings per unit'
* Fix - prevent issue with some payment methods
* Fix - js messages issue in booking form
* Fix - widget transition in mobile
* Fix - calendar style in frontend
* Fix - style of Booking Form widget on mobile devices
* Update - YITH Booking theme
* Update - Dutch translation
* Update - Spanish translation
* Tweak - improved usability of Booking Form
* Tweak - improved style
* Tweak - fixed overlay z-index
* Tweak - duration as number field for mobile devices



= Version 2.0.0 - Released: May 09, 2018 =

* New - Hourly bookings
* New - Per minute bookings
* New - All Day bookings
* New - Google Calendar integration
* New - improved performance
* New - YITH Booking theme
* New - show booking form in widget
* New - daily calendar
* New - Booking Notes (private and customer ones) on backend
* New - ICS export
* New - synchronization through ICS files (Booking Sync tab)
* New - show external bookings, loaded by ICS files, on calendar
* New - possibility to set "allowed start days"
* New - possibility to count people as separated bookings
* New - calendar style on backend
* New - person type ranges in Booking cost rules
* New - booking availability stored by using transient to improve performance
* New - load not-available dates via AJAX on frontend to improve performance
* New - Background Processes
* New - plain email templates
* New - booking emails contain the iCal event, so Gmail, for example, will show it in the email
* New - "Disable day if no time is available" option
* New - booking style
* New - people selector
* New - unique date range picker
* New - possibility to hide included services in Booking product form
* New - booking_services shortcode
* New - print service descriptions in Booking Form
* New - option to automatically reject pending confirmation bookings after X days
* New - actions to confirm/reject pending confirmation bookings in New Booking email
* New - show 'non bookable' text in price if product is not bookable
* New - default start date depends on 'Allow booking no sooner than' option
* New - set First Time Available as default start date
* New - fill booking form fields automatically when clicking on product links (results of booking search form)
* New - show messages for Min and Max duration in booking form
* New - possibility to hide Booking Search Form widget in single product
* New - show login form if booking form is shown to logged users only
* New - Booking List Table style
* New - Logs
* New - PHPUnit tests
* Update - Italian language
* Fix - availability issue for max bookings per unit
* Fix - availability issue with fixed duration bookings
* Fix - availability in past and future
* Fix - issue in availability table when creating a new product
* Fix - not-available dates
* Fix - style of services in booking form
* Fix - enqueued jquery-ui style only in Booking pages
* Fix - show booking data in YITH WooCommerce Request a Quote emails
* Fix - datepickers as readonly to prevent opening keyboard in mobile
* Fix - date picker min and max date when calendar range picker is enabled
* Fix - tiptip style in Booking list
* Fix - responsive calendar style
* Fix - copy to clipboard issue with input fields
* Fix - booking services not shown in frontend for vendors
* Fix - issue in Booking creation on backend
* Fix - wp_query issue
* Fix - service column width in product list
* Fix - notices when getting results of booking search forms
* Fix - style in services
* Fix - availability dates issue
* Fix - non-available booking message on checkout
* Fix - Search Form style
* Fix - removing non-available booking from cart issue
* Fix - WPML issue when paying with PayPal
* Fix - PHP7 warning for non-numeric values for prices
* Fix - yith_wcbk_is_booking_product issue with post objects
* Fix - issue with price rules
* Fix - issue in PDF booking details
* Fix - hide people in cart, emails and booking details if booking products doesn't have people
* Fix - price saved as float to fix issues with comma separator
* Tweak - click on the datepicker icon to open the datepicker
* Tweak - added label for services (additional and included)
* Tweak - possibility to set Default Time Step and Default Start Time for daily calendar view
* Tweak - improved table style of cost and person type rules
* Tweak - changed status colors
* Tweak - new blockUI loader style
* Tweak - order item meta set to be unique
* Tweak - hidden add-to-cart-timestamp order item meta
* Tweak - sorting Booking Labels by name
* Tweak - new style in "create booking" page
* Tweak - prevent issues on add to cart
* Tweak - changed PDF font to Helvetica
* Tweak - removed unused PDF fonts
* Update - templates
* Update - language files
* Dev - added yith_wcbk_monthpicker JS function
* Dev - added yith_wcbk_datepicker JS function
* Dev - added yith_wcbk_print_field function
* Dev - added yith_wcbk_print_fields function
* Dev - added yith_wcbk_array_add function
* Dev - added yith_wcbk_array_add_after function
* Dev - added yith_wcbk_array_add_before function
* Dev - added yith_wcbk_create_complete_time_array function
* Dev - added yith_wcbk_create_date_field function
* Dev - replaced yith_wcbk_my_account_bookingss_column_ action with yith_wcbk_my_account_booking_column_
* Dev - added yith_wcbk_printer_print_field_args filter
* Dev - added yith_wcbk_printer_print_fields_args filter
* Dev - added yith_wcbk_my_account_booking_columns filter
* Dev - added yith_wcbk_pdf_file_name filter
* Dev - added yith_wcbk_csv_delimiter filter
* Dev - added yith_wcbk_csv_file_name filter
* Dev - added yith_wcbk_booking_get_duration_html filter
* Dev - added yith_wcbk_booking_product_create_availability_time_array_unit_increment filter
* Dev - added yith_wcbk_show_booking_form_to_logged_users_only_show_login_form filter
* Dev - added yith_wcbk_product_get_not_available_dates_before filter
* Dev - added yith_wcbk_google_calendar_add_note_in_booking_on_sync filter
* Dev - added yith_wcbk_booking_search_form_default_location_range filter
* Dev - added yith_wcbk_booking_actions_for_emails filter
* Dev - added yith_wcbk_booking_product_get_mark_action_url_allowed_statuses filter
* Dev - added yith_wcbk_booking_product_get_mark_action_url filter
* Dev - deprecated argument in YITH_WCBK_Booking::update_status method
* Dev - class refactoring
* Dev - template refactoring


= Version 1.0.15 - Released: Jan 30, 2018 =

* New - support to WooCommerce 3.3.0-rc2
* Update - Plugin Framework
* Fix - WPML integration
* Fix - enqueued frontend scripts only when needed
* Fix - service cost per person type issue when 'Multiply all costs by number of people' option is enabled
* Fix - booking creating issue in backend

= Version 1.0.14 - Released: Jan 10, 2018 =

* Update - Plugin Framework 3
* Fix - Multi Vendor integration: vendors can add services with the same name of the admin vendors
* Fix - issue when paying for request confirmation bookings
* Fix - booking map in WooCommerce tabs
* Fix - YITH WooCommerce Quick View integration
* Fix - WooCommerce 3.x notice
* Fix - google map issue
* Fix - error when creating booking
* Fix - error when creating booking from order
* Dev - added yith_wcbk_printer_print_field_args filter
* Dev - added yith_wcbk_ajax_booking_data_request filter
* Dev - added yith_wcbk_cart_booking_data_request filter
* Dev - added yith_wcbk_booking_get_formatted_date filter
* Dev - added yith_wcbk_booking_product_free_price_html filter
* Dev - added yith_wcbk_booking_search_form_default_location_range filter


= Version 1.0.13 - Released: Oct 11, 2017 =

* New - support to Support to WooCommerce 3.2.0 RC2
* New - dutch language
* Fix - YITH WooCommerce Catalog Mode integration
* Fix - term issue in combination with YITH WooCommerce Multi Vendor
* Fix - issue pdf booking details
* Fix - Booking WP table list responsive issue
* Fix - search form result sorting
* Fix - month localization through PHP date in month picker
* Fix - check if booking has persons when check if it has multiply costs by persons enabled
* Dev - added yith_wcbk_ajax_search_booking_products_query_args filter
* Dev - added yith_wcbk_ajax_search_booking_products_posts_per_page filter
* Dev - added YITH_WCBK_DOING_AJAX constant
* Dev - added YITH_WCBK_DOING_AJAX_FRONTEND constant
* Dev - added YITH_WCBK_DOING_AJAX_ADMIN constant
* Dev - added yith_wcbk_booking_can_be_ filter
* Dev - js refactoring booking-map: added yith_booking_map function

= Version 1.0.12 - Released: Aug 03, 2017 =

* New - automatically cancel booking if related order is cancelled
* New - added css classes in Booking form rows
* Tweak - added desc-tip in settings
* Update - language files
* Fix - multiple non-purchasable booking notices in cart
* Fix - removed empty select in Service edit page options
* Fix - button label in search form result
* Fix - booking availability if end date is missing
* Dev - added yith_wcbk_booking_form_dates_duration_label_html filter
* Dev - added yith_wcbk_get_duration_units filter
* Dev - added yith_wcbk_booking_product_single_service_cost_total filter
* Dev - added yith_wcbk_booking_product_calculate_service_costs filter
* Dev - added yith_wcbk_search_booking_products_no_bookings_available_text filter
* Dev - added yith_wcbk_search_booking_products_no_bookings_available_after action
* Dev - added yith_wcbk_calendar_single_booking_data_before action
* Dev - added yith_wcbk_calendar_single_booking_data_after action

= Version 1.0.11 - Released: Jun 27, 2017 =

* Fix - integration with YITH WooCommerce Request a Quote and YITH WooCommerce Multi Vendor
* Fix - duration display in booking form
* Fix - more than one booking in cart issue in combination with WPML
* Tweak - prevent error with old PHP version
* Tweak - prevent issue when creating PDF

= Version 1.0.10 - Released: May 11, 2017 =

* New - add to cart more than one booking product with the same configuration
* Fix - issue in combination with WPML
* Fix - search form issue in combination with WPML
* Fix - New Booking (Admin) email recipients
* Fix - select2 issue in Booking Search Forms with WooCommerce 3.0.x
* Tweak - prevent issue if Shop Manager rule doesn't exist
* Dev - added yith_wcbk_order_add_booking_details_in_order_item filter
* Dev - added yith_wcbk_search_booking_products_before_get_results action
* Dev - added yith_wcbk_search_booking_products_after_get_results action
* Dev - added yith_wcbk_search_booking_products_search_results filter

= Version 1.0.9 - Released: Mar 30, 2017 =

* Fix - search form result issue

= Version 1.0.8 - Released: Mar 23, 2017 =

* New - support to WooCommerce 3.0-RC1
* New - choose whether to show the search form results through popup or in shop page
* New - possibility to set start and end date labels
* New - New Booking email for admins
* New - New Booking email for vendors
* Fix - booking status vendor email issue
* Fix - date localization
* Dev - search form class refactoring
* Dev - added yith_wcbk_get_search_form function
* Dev - added yith_wcbk_search_booking_products_search_args filter

= Version 1.0.7 - Released: Feb 14, 2017 =

* New - integration with YITH WooCommerce Multi Vendor Premium 1.12.0
* New - integration with YITH WooCommerce Quick View Premium 1.1.5
* New - spanish language
* New - italian language
* Fix - add to cart validation issue with booking product already added to the cart
* Fix - add booking capabilities on plugin activation only
* Fix - cost per person number calculation
* Dev - improved integration classes

= Version 1.0.6 - Released: Jan 23, 2017 =

* New - set default start date
* New - backend datepicker flat design
* Update - language file
* Fix - added missing variable
* Fix - wrong textdomain
* Fix - duration display issue
* Dev - added action yith_wcbk_before_booking_form
* Dev - added filter yith_wcbk_show_booking_form

= Version 1.0.5 - Released: Jan 09, 2017 =

* New - booking calendar flat design in frontend
* New - hide booking form from non-logged users
* Fix - issue when all dates are available
* Fix - datepicker issue

= Version 1.0.4 - Released: Dic 06, 2016 =

* Fix - issue when showing info of booking related to a deleted order
* Fix - person type display issues

= Version 1.0.3 - Released: Nov 24, 2016 =

* New - WPML integration for booking products, people and services
* Fix - admin select style in cost table
* Dev - added filter yith_wcbk_booking_form_message_bookable_text

= Version 1.0.2 - Released: Opt 10, 2016 =

* Fix - integration with YITH WooCommerce Deposits and Down Payments Premium 1.0.4

= Version 1.0.1 - Released: Opt 04, 2016 =

* New - integration with YITH WooCommerce Request a Quote Premium 1.5.7
* New - integration with YITH WooCommerce Catalog Mode Premium 1.4.3
* New - integration with YITH WooCommerce Deposits and Down Payments Premium 1.0.3
* Fix - service saving issue
* Fix - booking_map shortcode issue
* Fix - pay after booking confirmation

= Version 1.0.0 - Released: Aug 31, 2016 =

* Initial release


== Dev Notes ==

= Folder structure =
    - assets                            plugin assets, such us CSS, JS and images
    - bin                               contains the sh file to install PHPUnit test
    - includes                          plugin class and function files
        - assets                        classes to handle assets in admin, frontend and both
        - background-process            classes to manage background processes
        - booking                       classes to manage the Booking object
        - emails                        email classes
        - integrations                  classes to manage plugin and theme integrations
        - libraries                     libraries used by the plugin
        - utils                         utilities
        - widgets                       classes to manage widgets
    - languages                         plugin language files
    - lib                               external libraries
    - plugin-fw                         the YITH plugin framework
    - plugin-options                    the plugin options shown in YITH Plugins > Booking
    - templates                         plugin templates (they can be overridden by the theme)
    - tests                             PHPUnit tests
    - views                             plugin views (backend, they cannot be overridden by the theme)
    - init.php                          start file
    - wpml-config.php                   WPML configuration file
    - yith-booking.zip                  ZIP package of YITH Booking theme

= Notes =

    - class names:
        classes that handles CPT are called YITH_WCBK_Obj_Post_Type_Admin (example YITH_WCBK_Booking_Post_Type_Admin)
        classes that handles taxonomies are called YITH_WCBK_Obj_Tax_Admin (example YITH_WCBK_Service_Tax_Admin)
        classes that allows to handle (get, set, search, etc...) something, such as CPT, are the Helpers (examples: YITH_WCBK_Service_Helper, YITH_WCBK_Person_Type_Helper, YITH_WCBK_Date_Helper )
    - on backend the Booking (and the Booking menu) is handled by the class includes/booking/class.yith-wcbk-booking-admin.php
        it calls:
          includes/booking/admin/class.yith-wcbk-booking-calendar.php           -> handle the Calendar on backend
          includes/booking/admin/class.yith-wcbk-booking-create.php             -> handle the booking creation on backend
          includes/booking/admin/class.yith-wcbk-booking-metabox.php            -> handle booking metaboxes
          includes/booking/admin/class.yith-wcbk-booking-post-type-helper.php   -> is the Helper of Booking Post Type
    - difference between templates (frontend, so they can be overridden by the theme) and views (backend, so they cannot be overridden)
    - the AJAX calls are fully handled by the YITH_WCBK_Ajax class

    [Italian]

    - nomenclatura classi:
            le classi che gestiscono i CPT si chiamano YITH_WCBK_Obj_Post_Type_Admin (esempio YITH_WCBK_Booking_Post_Type_Admin)
            le classi che gestiscono le tassonomie si chiamano YITH_WCBK_Obj_Tax_Admin (esempio YITH_WCBK_Service_Tax_Admin)
            le classi che permettono di gestire (get, set, search, etc...) qualcosa, come CPT, sono gli Helper (esempi: YITH_WCBK_Service_Helper, YITH_WCBK_Person_Type_Helper, YITH_WCBK_Date_Helper )
    - il booking sul backend (e il menu Booking) viene gestito dalla classe includes/booking/class.yith-wcbk-booking-admin.php
        essa richiama:
          includes/booking/admin/class.yith-wcbk-booking-calendar.php           -> gestisce il calendario a backend
          includes/booking/admin/class.yith-wcbk-booking-create.php             -> gestisce la creazione del booking a backend
          includes/booking/admin/class.yith-wcbk-booking-metabox.php            -> gestisce le metabox del booking
          includes/booking/admin/class.yith-wcbk-booking-post-type-helper.php   -> gestisce il post type del booking
    - differenza tra templates (frontend e quindi sovrascrivibili dal tema) e views (admin e quindi NON sovrascrivibili)
    - la parte AJAX viene gestita interamente dalla classe YITH_WCBK_Ajax