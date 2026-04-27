jQuery( document ).ready( function ( $ ) {
    "use strict";

    var yith_wcbk_availability_rules = {
        hasTime                 : false,
        init                    : function () {
            var self = yith_wcbk_availability_rules;

            $( document ).on( 'yith_wcbk_booking_product_duration_unit_changed', self.updateHasTime );

            $( document ).on( 'click yith_wcbk_admin_booking_availability_rule_type_change', '.yith-wcbk-availability-rule__type', self.changeFromToFieldsByType );
            $( '.yith-wcbk-availability-rules__new-rule' ).on( 'click', self.addRule );
            $( document ).on( 'click', '.yith-wcbk-availability-rules__delete-rule', self.deleteRule );

            $( '.yith-wcbk-availability-rules__expand-collapse' ).on( 'click', self.expandCollapseAll );

            $( document ).on( 'click', '.yith-wcbk-availability-rule__days-enabled, .yith-wcbk-availability-rule__times-enabled', function ( event ) {
                self.checkFieldVisibility( $( event.target ) );
            } );

            self.initAllRulesVisibility();
        },
        initAllRulesVisibility  : function () {
            $( '.yith-wcbk-availability-rule' ).each( function () {
                yith_wcbk_availability_rules.checkFieldVisibility( $( this ) );
            } );
        },
        updateHasTime           : function ( e, data ) {
            yith_wcbk_availability_rules.hasTime = data.has_time || false;

            yith_wcbk_availability_rules.initAllRulesVisibility();
        },
        changeFromToFieldsByType: function ( event ) {
            var radio           = $( event.target ),
                radio_container = radio.parent(),
                value           = radio_container.find( 'input[type=radio]:checked' ).val() || 'month',
                rule_container  = radio_container.closest( '.yith-wcbk-availability-rule' ),
                from_to_section = rule_container.find( '.yith-wcbk-availability-rule__from-to-row' ),
                month_fields    = from_to_section.find( '.yith-wcbk-month-range-select' ),
                date_fields     = from_to_section.find( '.yith-wcbk-admin-date-picker' );

            if ( 'custom' === value ) {
                date_fields.removeAttr( 'disabled' );
                month_fields.attr( 'disabled', 'disabled' );
                date_fields.parent().show();
            } else {
                month_fields.removeAttr( 'disabled' );
                date_fields.attr( 'disabled', 'disabled' );
                date_fields.parent().hide();
            }
        },
        addRule                 : function ( event ) {
            event.preventDefault();

            var button          = $( event.target ),
                template        = button.data( 'template' ),
                rules_container = button.closest( '.yith-wcbk-availability-rules' ),
                rules_list      = rules_container.find( '.yith-wcbk-availability-rules__list' ),
                index           = 1,
                new_rule;

            if ( rules_list.data( 'last-index' ) ) {
                index = rules_list.data( 'last-index' ) + 1;
            } else {
                index = rules_list.find( '.yith-wcbk-availability-rule' ).length || 0;
                index += 1;
            }

            rules_list.data( 'last-index', index );

            template = template.replace( new RegExp( '{{INDEX}}', 'g' ), index );
            new_rule = $( template );
            rules_list.append( new_rule );

            new_rule.find( '.yith-wcbk-admin-date-picker' ).yith_wcbk_datepicker();

            yith_wcbk_availability_rules.checkFieldVisibility( new_rule );
        },
        deleteRule              : function ( event ) {
            event.preventDefault();
            var rule = $( event.target ).closest( '.yith-wcbk-availability-rule' );
            rule
                .animate( { opacity: .3 }, 200 )
                .delay( 200 )
                .slideUp( 300, function () {
                    $( this ).remove()
                } );
        },
        checkFieldVisibility    : function ( element ) {
            var rule = $( element ).closest( '.yith-wcbk-availability-rule' ),
                days_enabled, times_enabled, times_enabled_container, bookable, days, times;

            if ( rule.length ) {
                days_enabled            = rule.find( '.yith-wcbk-availability-rule__days-enabled' );
                times_enabled           = rule.find( '.yith-wcbk-availability-rule__times-enabled' );
                times_enabled_container = times_enabled.closest( '.yith-wcbk-form-field__container' );
                bookable                = rule.find( '.yith-wcbk-availability-rule__bookable' );
                days                    = rule.find( '.yith-wcbk-availability-rule__day' );
                times                   = rule.find( '.yith-wcbk-availability-rule__day-time' );

                if ( days_enabled.is( ':checked' ) ) {
                    bookable.hide();
                    days.show();
                } else {
                    bookable.show();
                    days.hide();
                }

                if ( days_enabled.is( ':checked' ) && yith_wcbk_availability_rules.hasTime ) {
                    times_enabled_container.show();
                } else {
                    times_enabled_container.hide();
                }

                if ( days_enabled.is( ':checked' ) && yith_wcbk_availability_rules.hasTime && times_enabled.length && times_enabled.is( ':checked' ) ) {
                    times.show();
                } else {
                    times.hide();
                }

                rule.find( '.yith-wcbk-availability-rule__type' ).trigger( 'yith_wcbk_admin_booking_availability_rule_type_change' );
            }
        },
        expandCollapseAll       : function ( event ) {
            var button     = $( event.target ).closest( '.yith-wcbk-availability-rules__expand-collapse' ),
                rules_list = $( '.yith-wcbk-availability-rules__list' );

            if ( button.is( '.yith-wcbk-availability-rules__expand-collapse--collapse' ) ) {
                button.removeClass( 'yith-wcbk-availability-rules__expand-collapse--collapse' );
                rules_list.find( '.yith-wcbk-settings-section-box:not(.yith-wcbk-settings-section-box--closed) .yith-wcbk-settings-section-box__toggle' ).click();
            } else {
                button.addClass( 'yith-wcbk-availability-rules__expand-collapse--collapse' );
                rules_list.find( '.yith-wcbk-settings-section-box.yith-wcbk-settings-section-box--closed .yith-wcbk-settings-section-box__toggle' ).click();
            }
        }
    };

    yith_wcbk_availability_rules.init();
} );