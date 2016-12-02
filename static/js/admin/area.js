var formBuilderAreaWatcher = (function () {

    'use strict';

    var self = {

        init: function () {

            var $formPresetElements = $('.pimcore_editable.pimcore_tag_select[id*="pimcore_editable_formPreset"]');

            $formPresetElements.each(function () {

                var panicAttemt = 0, panicShutDown = 20,
                    $el = $(this), $cmp, cmp;

                var interval = setInterval( function() {

                    if( panicAttemt > panicShutDown ) {
                        clearInterval( interval );
                    }

                    if(  $cmp === null || $cmp === undefined || $cmp.length === 0) {

                        $cmp = $el.find(' > div:first');
                        panicAttemt++;

                    } else {

                        clearInterval( interval );

                        //find extjs componente
                        cmp = self.findComponentByElement( $cmp[0] );

                        //watch drop down select event!
                        self.setupDropdownElement( $el, cmp );

                    }

                }, 100 );

            });

        },

        setupDropdownElement: function( $formPresetSelector, cmp ) {

            var $parent = $formPresetSelector.closest( '.configWindow'),
                toggle = function(v) {

                    if( v === 'custom') {
                        $parent.find('.preset-toggle').show();
                    } else {
                        $parent.find('.preset-toggle').hide();
                    }

                };

            if( cmp === null ) {
                console.warn( 'cmp not found');
                return false;
            }

            toggle( cmp.getValue() );

            cmp.on('select', function() {

                toggle( this.getValue() );

            });

        },

        findComponentByElement: function( node ) {

            var topmost = document.body, target = node, cmp;

            while (target && target.nodeType === 1 && target !== topmost)
            {
                cmp = Ext.getCmp(target.id);

                if (cmp) {
                    return cmp;
                }

                target = target.parentNode;
            }

            return null;
        }

    };

    return {

        init: self.init

    };

})();

$(function() {
    'use strict';
    formBuilderAreaWatcher.init();
});