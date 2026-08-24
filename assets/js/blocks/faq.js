( function( blocks, element, blockEditor, i18n, data, components ) {
    var el = element.createElement;
    var InnerBlocks = blockEditor.InnerBlocks;
    var useSelect = data.useSelect;
    var Notice = components.Notice;
    var __ = i18n.__;

    var FAQ_TEMPLATE = [
        [ 'yarbar/faq-item', { question: 'سوال اول اینجا قرار می‌گیرد', answer: 'پاسخ سوال اول اینجا قرار می‌گیرد.' } ],
        [ 'yarbar/faq-item', { question: 'سوال دوم اینجا قرار می‌گیرد', answer: 'پاسخ سوال دوم اینجا قرار می‌گیرد.' } ],
        [ 'yarbar/faq-item', { question: 'سوال سوم اینجا قرار می‌گیرد', answer: 'پاسخ سوال سوم اینجا قرار می‌گیرد.' } ]
    ];

    var MIN_ITEMS = 2;
    var MAX_ITEMS = 10;

    blocks.registerBlockType( 'yarbar/faq', {
        title: __( 'سوالات متداول (FAQ)', 'yarbar' ),
        icon: 'editor-help',
        category: 'yarbar-components',
        supports: {
            multiple: false
        },

        edit: function( props ) {
            var itemCount = useSelect( function( select ) {
                var innerBlocks = select( 'core/block-editor' ).getBlocks( props.clientId );
                return innerBlocks.length;
            }, [ props.clientId ] );

            var notice = null;
            if ( itemCount < MIN_ITEMS ) {
                notice = el( Notice, { status: 'warning', isDismissible: false },
                    __( 'حداقل ۲ سوال لازم است.', 'yarbar' ) );
            } else if ( itemCount >= MAX_ITEMS ) {
                notice = el( Notice, { status: 'warning', isDismissible: false },
                    __( 'حداکثر ۱۰ سوال مجاز است.', 'yarbar' ) );
            }

            return el(
                'section',
                { className: props.className + ' faq-editor' },
                el( 'h2', { className: 'section-heading' }, __( 'سوالات متداول', 'yarbar' ) ),
                notice,
                el( InnerBlocks, {
                    allowedBlocks: [ 'yarbar/faq-item' ],
                    template: FAQ_TEMPLATE,
                    templateInsertUpdatesSelection: false,
                    renderAppender: itemCount >= MAX_ITEMS ? false : InnerBlocks.ButtonBlockAppender
                } )
            );
        },

        save: function() {
            return el( InnerBlocks.Content );
        }
    } );
} )(
    window.wp.blocks,
    window.wp.element,
    window.wp.blockEditor,
    window.wp.i18n,
    window.wp.data,
    window.wp.components
);