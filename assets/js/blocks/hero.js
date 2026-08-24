( function( blocks, element, blockEditor, i18n ) {
    var el = element.createElement;
    var RichText = blockEditor.RichText;
    var InnerBlocks = blockEditor.InnerBlocks;
    var __ = i18n.__;

    var CTA_TEMPLATE = [
        [ 'yarbar/cta', { text: 'تماس فوری', url: 'tel:', style: 'primary' } ],
        [ 'yarbar/cta', { text: 'درخواست مشاوره', url: '#contact', style: 'secondary' } ]
    ];

    blocks.registerBlockType( 'yarbar/hero', {
        title: __( 'هیرو (بخش ابتدایی صفحه)', 'yarbar' ),
        icon: 'align-center',
        category: 'yarbar-components',
        supports: {
            multiple: false
        },
        attributes: {
            eyebrow: {
                type: 'string',
                default: 'حمل و نقل مطمئن در سراسر ایران'
            },
            title: {
                type: 'string',
                default: 'اسباب‌کشی و باربری حرفه‌ای با یاربار'
            },
            description: {
                type: 'string',
                default: 'بسته‌بندی ایمن، حمل سریع، و تحویل بدون دغدغه — با تیم مجهز و بیمه کامل.'
            }
        },

        edit: function( props ) {
            var attributes = props.attributes;
            var setAttributes = props.setAttributes;

            return el(
                'section',
                { className: props.className + ' hero' },
                el(
                    'div',
                    { className: 'container hero__inner' },
                    el( RichText, {
                        tagName: 'span',
                        className: 'hero__eyebrow',
                        allowedFormats: [],
                        value: attributes.eyebrow,
                        onChange: function( v ) { setAttributes( { eyebrow: v } ); },
                        placeholder: __( 'متن کوچک بالای عنوان...', 'yarbar' )
                    } ),
                    el( RichText, {
                        tagName: 'h1',
                        className: 'hero__title',
                        allowedFormats: [],
                        value: attributes.title,
                        onChange: function( v ) { setAttributes( { title: v } ); },
                        placeholder: __( 'عنوان اصلی...', 'yarbar' )
                    } ),
                    el( RichText, {
                        tagName: 'p',
                        className: 'hero__description',
                        allowedFormats: [ 'core/bold', 'core/italic' ],
                        value: attributes.description,
                        onChange: function( v ) { setAttributes( { description: v } ); },
                        placeholder: __( 'توضیح کوتاه...', 'yarbar' )
                    } ),
                    el(
                        'div',
                        { className: 'hero__actions' },
                        el( InnerBlocks, {
                            template: CTA_TEMPLATE,
                            templateLock: 'all'
                        } )
                    )
                )
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
    window.wp.i18n
);