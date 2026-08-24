( function( blocks, element, blockEditor, components, i18n ) {
    var el = element.createElement;
    var RichText = blockEditor.RichText;
    var InspectorControls = blockEditor.InspectorControls;
    var PanelBody = components.PanelBody;
    var TextControl = components.TextControl;
    var SelectControl = components.SelectControl;
    var __ = i18n.__;

    blocks.registerBlockType( 'yarbar/cta', {
        title: __( 'دکمه تماس (CTA)', 'yarbar' ),
        icon: 'megaphone',
        category: 'yarbar-components',
        attributes: {
            text: {
                type: 'string',
                default: 'تماس با یاربار'
            },
            url: {
                type: 'string',
                default: 'tel:'
            },
            style: {
                type: 'string',
                default: 'primary'
            }
        },

        edit: function( props ) {
            var attributes = props.attributes;
            var setAttributes = props.setAttributes;

            return el(
                'div',
                { className: props.className },
                el(
                    InspectorControls,
                    {},
                    el(
                        PanelBody,
                        { title: __( 'تنظیمات دکمه', 'yarbar' ) },
                        el( TextControl, {
                            label: __( 'آدرس لینک (URL)', 'yarbar' ),
                            value: attributes.url,
                            onChange: function( newUrl ) {
                                setAttributes( { url: newUrl } );
                            }
                        } ),
                        el( SelectControl, {
                            label: __( 'ظاهر دکمه', 'yarbar' ),
                            value: attributes.style,
                            options: [
                                { label: __( 'اصلی (نارنجی)', 'yarbar' ), value: 'primary' },
                                { label: __( 'ثانویه (خط‌دار)', 'yarbar' ), value: 'secondary' }
                            ],
                            onChange: function( newStyle ) {
                                setAttributes( { style: newStyle } );
                            }
                        } )
                    )
                ),
                el( RichText, {
                    tagName: 'span',
                    className: 'btn btn--' + attributes.style,
                    allowedFormats: [],
                    value: attributes.text,
                    onChange: function( newText ) {
                        setAttributes( { text: newText } );
                    },
                    placeholder: __( 'متن دکمه...', 'yarbar' )
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
    window.wp.components,
    window.wp.i18n
);