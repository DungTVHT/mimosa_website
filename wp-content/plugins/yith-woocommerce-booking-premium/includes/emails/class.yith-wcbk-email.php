<?php
!defined( 'ABSPATH' ) && exit;

if ( !class_exists( 'YITH_WCBK_Email' ) ) :
    /**
     * Class YITH_WCBK_Email
     *
     * @author Leanza Francesco <leanzafrancesco@gmail.com>
     */
    abstract class YITH_WCBK_Email extends WC_Email {
        /** @var YITH_WCBK_Booking */
        public $object;

        /**
         * YITH_WCBK_Email constructor.
         */
        public function __construct() {
            parent::__construct();
        }

        /**
         * Handle multipart mail.
         *
         * @param PHPMailer $mailer
         *
         * @return PHPMailer
         */
        public function handle_multipart( $mailer ) {
            $include_ical = apply_filters( 'yith_wcbk_email_include_ical', $this->customer_email, $this );
            if ( $include_ical && $this->sending && 'multipart' === $this->get_email_type() && $this->object && $this->object->get_id() ) {
                $mailer->Ical = YITH_WCBK()->exporter->get_ics( $this->object->get_id() );
            }

            return parent::handle_multipart( $mailer );
        }

        /**
         * Get content html.
         *
         * @return string
         */
        public function get_content_html() {
            $params = array_merge( array(
                                       'booking'       => $this->object,
                                       'email_heading' => $this->get_heading(),
                                       'sent_to_admin' => !$this->is_customer_email(),
                                       'plain_text'    => false,
                                       'email'         => $this ),
                                   $this->get_extra_content_params()
            );

            return wc_get_template_html( $this->template_html, $params, '', $this->template_base );
        }

        /**
         * Get content plain.
         *
         * @return string
         */
        public function get_content_plain() {
            $params = array_merge( array(
                                       'booking'       => $this->object,
                                       'email_heading' => $this->get_heading(),
                                       'sent_to_admin' => !$this->is_customer_email(),
                                       'plain_text'    => true,
                                       'email'         => $this ),
                                   $this->get_extra_content_params()
            );

            return wc_get_template_html( $this->template_plain, $params, '', $this->template_base );
        }

        /**
         * do you need extra content params? If so, override me!
         *
         * @return array
         */
        public function get_extra_content_params() {
            return array();
        }

        /**
         * Get email subject.
         *
         * @since  2.0.0
         * @return string
         */
        public function get_default_subject() {
            return $this->subject;
        }

        /**
         * Get email heading.
         *
         * @since  2.0.0
         * @return string
         */
        public function get_default_heading() {
            return $this->heading;
        }

        /**
         * Initialise settings form fields.
         */
        public function init_form_fields() {
            $this->form_fields = array(
                'enabled'    => array(
                    'title'   => __( 'Enable/Disable', 'yith-booking-for-woocommerce' ),
                    'type'    => 'checkbox',
                    'label'   => __( 'Enable this email notification', 'yith-booking-for-woocommerce' ),
                    'default' => 'yes'
                ),
                'subject'    => array(
                    'title'       => __( 'Subject', 'yith-booking-for-woocommerce' ),
                    'type'        => 'text',
                    'description' => sprintf( __( 'This controls the email subject line. Leave blank to use the default subject: <code>%s</code>.', 'woocommerce' ), $this->subject ),
                    'placeholder' => $this->get_default_subject(),
                    'default'     => '',
                    'desc_tip'    => true
                ),
                'heading'    => array(
                    'title'       => __( 'Email Heading', 'yith-booking-for-woocommerce' ),
                    'type'        => 'text',
                    'description' => sprintf( __( 'This controls the main heading in the email notification. Leave blank to use the default heading: <code>%s</code>.', 'woocommerce' ), $this->heading ),
                    'placeholder' => $this->get_default_heading(),
                    'default'     => '',
                    'desc_tip'    => true
                ),
                'email_type' => array(
                    'title'       => __( 'Email type', 'yith-booking-for-woocommerce' ),
                    'type'        => 'select',
                    'description' => __( 'Choose which email format to send.', 'yith-booking-for-woocommerce' ),
                    'default'     => 'multipart',
                    'class'       => 'email_type wc-enhanced-select',
                    'options'     => $this->get_email_type_options(),
                    'desc_tip'    => true
                )
            );
        }
    }
endif;