( function( blocks, element, blockEditor, i18n ) {
    var el = element.createElement;
    var RichText = blockEditor.RichText;
    var __ = i18n.__;

    blocks.registerBlockType( 'yarbar/faq-item', {
        title: __( 'سوال متداول', 'yarbar' ),
        icon: 'editor-help',
        category: 'yarbar-components',
        parent: [ 'yarbar/faq' ],
        attributes: {
            question: {
                type: 'string',
                default: ''
            },
            answer: {
                type: 'string',
                default: ''
            }
        },

        edit: function( props ) {
            var attributes = props.attributes;
            var setAttributes = props.setAttributes;

            return el(
                'div',
                { className: props.className + ' faq-item-editor' },
                el( RichText, {
                    tagName: 'h3',
                    className: 'faq-item__question',
                    allowedFormats: [],
                    value: attributes.question,
                    onChange: function( v ) { setAttributes( { question: v } ); },
                    placeholder: __( 'متن سوال...', 'yarbar' )
                } ),
                el( RichText, {
                    tagName: 'p',
                    className: 'faq-item__answer',
                    allowedFormats: [ 'core/bold', 'core/italic', 'core/link' ],
                    value: attributes.answer,
                    onChange: function( v ) { setAttributes( { answer: v } ); },
                    placeholder: __( 'متن پاسخ...', 'yarbar' )
                } )
            );
        },

        save: function() {
            return null;
        }
    } );
} )(
    window.wp.blocks,
    window.wp.element,
    window.wp.blockEditor,
    window.wp.i18n
);