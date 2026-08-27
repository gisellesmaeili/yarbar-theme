/**
 * YarBar Admin Settings Panel JavaScript (admin-settings.js)
 * Modern tabbed interface, interactive FAQ drag-and-drop board, and AJAX saving.
 */

( function() {
    'use strict';

    document.addEventListener( 'DOMContentLoaded', function() {
        var wrap = document.querySelector( '.yarbar-admin-wrap' );
        if ( ! wrap ) {
            return;
        }

        // 1. Tab Switching
        var tabBtns = wrap.querySelectorAll( '.yarbar-tab-btn' );
        var tabPanes = wrap.querySelectorAll( '.yarbar-tab-pane' );

        function switchTab( targetId ) {
            tabBtns.forEach( function( btn ) {
                var isActive = btn.getAttribute( 'data-tab' ) === targetId;
                btn.classList.toggle( 'is-active', isActive );
                btn.setAttribute( 'aria-selected', isActive ? 'true' : 'false' );
            } );

            tabPanes.forEach( function( pane ) {
                var isActive = pane.id === 'tab-pane-' + targetId;
                pane.classList.toggle( 'is-active', isActive );
            } );

            try {
                sessionStorage.setItem( 'yarbar_active_admin_tab', targetId );
            } catch ( e ) {}
        }

        tabBtns.forEach( function( btn ) {
            btn.addEventListener( 'click', function( e ) {
                e.preventDefault();
                var targetId = this.getAttribute( 'data-tab' );
                if ( targetId ) {
                    switchTab( targetId );
                }
            } );
        } );

        // Restore active tab
        try {
            var savedTab = sessionStorage.getItem( 'yarbar_active_admin_tab' );
            if ( savedTab && wrap.querySelector( '.yarbar-tab-btn[data-tab="' + savedTab + '"]' ) ) {
                switchTab( savedTab );
            }
        } catch ( e ) {}

        // 2. Toast Notifications
        var toastEl = document.getElementById( 'yarbar-toast' );
        var toastTimeout = null;

        function showToast( message, isSuccess ) {
            if ( ! toastEl ) return;
            if ( toastTimeout ) {
                clearTimeout( toastTimeout );
            }

            toastEl.textContent = message;
            toastEl.className = 'yarbar-toast ' + ( isSuccess ? 'is-success' : 'is-error' );
            toastEl.classList.add( 'is-visible' );

            toastTimeout = setTimeout( function() {
                toastEl.classList.remove( 'is-visible' );
            }, 4000 );
        }

        // 2.5 Dual Visual / Code Editor Modes
        wrap.querySelectorAll( '.yarbar-editor-container' ).forEach( function( container ) {
            var hiddenInput = container.querySelector( '.yarbar-editor-data' );
            var visualView  = container.querySelector( '.yarbar-editor-view.is-visual' );
            var codeView    = container.querySelector( '.yarbar-editor-view.is-code' );
            var parentGroup = container.closest( '.yarbar-form-group' );
            if ( ! parentGroup || ! hiddenInput ) return;

            var modeTabs = parentGroup.querySelectorAll( '.yarbar-mode-tab' );

            function syncFromVisual() {
                if ( visualView && codeView && hiddenInput ) {
                    var html = visualView.innerHTML;
                    codeView.value = html;
                    hiddenInput.value = html;
                }
            }

            function syncFromCode() {
                if ( visualView && codeView && hiddenInput ) {
                    var code = codeView.value;
                    visualView.innerHTML = code;
                    hiddenInput.value = code;
                }
            }

            if ( visualView ) {
                visualView.addEventListener( 'input', syncFromVisual );
                visualView.addEventListener( 'blur', syncFromVisual );
            }
            if ( codeView ) {
                codeView.addEventListener( 'input', syncFromCode );
                codeView.addEventListener( 'blur', syncFromCode );
            }

            modeTabs.forEach( function( tab ) {
                tab.addEventListener( 'click', function( e ) {
                    e.preventDefault();
                    var mode = this.getAttribute( 'data-mode' );
                    modeTabs.forEach( function( t ) {
                        t.classList.toggle( 'is-active', t === tab );
                    } );

                    if ( mode === 'code' ) {
                        syncFromVisual();
                        container.classList.add( 'mode-code' );
                        if ( codeView ) {
                            codeView.focus();
                        }
                    } else {
                        syncFromCode();
                        container.classList.remove( 'mode-code' );
                        if ( visualView ) {
                            visualView.focus();
                        }
                    }
                } );
            } );
        } );

        // 3. FAQ Board Management & Drag-and-Drop
        var faqBoard = wrap.querySelector( '.yarbar-faq-board' );

        function updateFaqCounters() {
            if ( ! faqBoard ) return;

            var cols = [ 'col1', 'col2' ];
            cols.forEach( function( colKey ) {
                var listEl = faqBoard.querySelector( '.yarbar-faq-items-list[data-column="' + colKey + '"]' );
                var badgeEl = faqBoard.querySelector( '.yarbar-count-badge[data-column="' + colKey + '"]' );
                if ( ! listEl || ! badgeEl ) return;

                var items = listEl.querySelectorAll( '.yarbar-faq-item' );
                var count = items.length;
                badgeEl.textContent = count + ' سوال (مجاز: ۱ تا ۱۰)';

                if ( count >= 1 && count <= 10 ) {
                    badgeEl.classList.remove( 'is-invalid' );
                    badgeEl.classList.add( 'is-valid' );
                } else {
                    badgeEl.classList.remove( 'is-valid' );
                    badgeEl.classList.add( 'is-invalid' );
                }

                // Update switch buttons label and icon
                items.forEach( function( item ) {
                    var switchBtn = item.querySelector( '.yarbar-btn-switch-col' );
                    if ( switchBtn ) {
                        var targetCol = ( colKey === 'col1' ) ? 'col2' : 'col1';
                        var targetName = ( colKey === 'col1' ) ? 'ستون ۲' : 'ستون ۱';
                        switchBtn.setAttribute( 'data-target-col', targetCol );
                        switchBtn.innerHTML = '⇄ انتقال به ' + targetName;
                    }
                } );
            } );
        }

        // Setup Drag and Drop events for a FAQ item
        var draggedItem = null;

        function attachItemEvents( item ) {
            item.setAttribute( 'draggable', 'true' );

            item.addEventListener( 'dragstart', function( e ) {
                draggedItem = this;
                this.classList.add( 'is-dragging' );
                e.dataTransfer.effectAllowed = 'move';
                e.dataTransfer.setData( 'text/plain', '' );
            } );

            item.addEventListener( 'dragend', function() {
                this.classList.remove( 'is-dragging' );
                draggedItem = null;
                wrap.querySelectorAll( '.yarbar-faq-item' ).forEach( function( el ) {
                    el.classList.remove( 'drag-over' );
                } );
                updateFaqCounters();
            } );

            item.addEventListener( 'dragover', function( e ) {
                e.preventDefault();
                e.dataTransfer.dropEffect = 'move';
                if ( draggedItem && draggedItem !== this ) {
                    this.classList.add( 'drag-over' );
                }
            } );

            item.addEventListener( 'dragleave', function() {
                this.classList.remove( 'drag-over' );
            } );

            item.addEventListener( 'drop', function( e ) {
                e.preventDefault();
                this.classList.remove( 'drag-over' );
                if ( ! draggedItem || draggedItem === this ) {
                    return;
                }

                var parentList = this.parentNode;
                var bounding = this.getBoundingClientRect();
                var offset = e.clientY - bounding.top;

                if ( offset > bounding.height / 2 ) {
                    parentList.insertBefore( draggedItem, this.nextSibling );
                } else {
                    parentList.insertBefore( draggedItem, this );
                }
                updateFaqCounters();
            } );

            // Delete item
            var delBtn = item.querySelector( '.yarbar-btn-delete-faq' );
            if ( delBtn ) {
                delBtn.addEventListener( 'click', function( e ) {
                    e.preventDefault();
                    var list = item.parentNode;
                    if ( list.querySelectorAll( '.yarbar-faq-item' ).length <= 1 ) {
                        showToast( 'هر ستون باید حداقل دارای ۱ سوال باشد. نمی‌توانید آخرین سوال را حذف کنید.', false );
                        return;
                    }
                    if ( confirm( 'آیا از حذف این سوال اطمینان دارید؟' ) ) {
                        item.remove();
                        updateFaqCounters();
                    }
                } );
            }

            // Move to other column
            var switchBtn = item.querySelector( '.yarbar-btn-switch-col' );
            if ( switchBtn ) {
                switchBtn.addEventListener( 'click', function( e ) {
                    e.preventDefault();
                    var targetCol = this.getAttribute( 'data-target-col' );
                    var targetList = faqBoard.querySelector( '.yarbar-faq-items-list[data-column="' + targetCol + '"]' );
                    var currentList = item.parentNode;

                    if ( currentList.querySelectorAll( '.yarbar-faq-item' ).length <= 1 ) {
                        showToast( 'هر ستون باید حداقل ۱ سوال داشته باشد. امکان انتقال آخرین سوال وجود ندارد.', false );
                        return;
                    }

                    if ( targetList ) {
                        if ( targetList.querySelectorAll( '.yarbar-faq-item' ).length >= 10 ) {
                            showToast( 'ستون مقصد به حداکثر مجاز (۱۰ سوال) رسیده است.', false );
                            return;
                        }
                        targetList.appendChild( item );
                        updateFaqCounters();
                    }
                } );
            }
        }

        // Initialize existing FAQ items
        if ( faqBoard ) {
            faqBoard.querySelectorAll( '.yarbar-faq-item' ).forEach( attachItemEvents );

            // Allow dropping onto empty list containers
            faqBoard.querySelectorAll( '.yarbar-faq-items-list' ).forEach( function( list ) {
                list.addEventListener( 'dragover', function( e ) {
                    e.preventDefault();
                    e.dataTransfer.dropEffect = 'move';
                } );

                list.addEventListener( 'drop', function( e ) {
                    e.preventDefault();
                    if ( draggedItem && draggedItem.parentNode !== this ) {
                        this.appendChild( draggedItem );
                        updateFaqCounters();
                    }
                } );
            } );

            // Add new FAQ item buttons
            wrap.querySelectorAll( '.yarbar-btn-add-faq' ).forEach( function( addBtn ) {
                addBtn.addEventListener( 'click', function( e ) {
                    e.preventDefault();
                    var colKey = this.getAttribute( 'data-column' );
                    var list = faqBoard.querySelector( '.yarbar-faq-items-list[data-column="' + colKey + '"]' );
                    if ( ! list ) return;

                    if ( list.querySelectorAll( '.yarbar-faq-item' ).length >= 10 ) {
                        showToast( 'حداکثر تعداد مجاز برای هر ستون ۱۰ سوال است.', false );
                        return;
                    }

                    var temp = document.createElement( 'div' );
                    temp.className = 'yarbar-faq-item';
                    temp.innerHTML =
                        '<div class="yarbar-faq-item-top">' +
                            '<span class="yarbar-faq-handle">' +
                                '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="9" cy="5" r="1"/><circle cx="9" cy="12" r="1"/><circle cx="9" cy="19" r="1"/><circle cx="15" cy="5" r="1"/><circle cx="15" cy="12" r="1"/><circle cx="15" cy="19" r="1"/></svg>' +
                                'جابه‌جایی' +
                            '</span>' +
                            '<div class="yarbar-faq-actions">' +
                                '<button type="button" class="yarbar-btn-switch-col" data-target-col="' + ( colKey === 'col1' ? 'col2' : 'col1' ) + '">⇄ انتقال به ' + ( colKey === 'col1' ? 'ستون ۲' : 'ستون ۱' ) + '</button>' +
                                '<button type="button" class="yarbar-btn-delete-faq" title="حذف سوال">' +
                                    '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 6h18m-2 0v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a2 2 0 012-2h4a2 2 0 012 2v2M10 11v6M14 11v6"/></svg>' +
                                '</button>' +
                            '</div>' +
                        '</div>' +
                        '<div class="yarbar-form-group">' +
                            '<label class="yarbar-label">عنوان سوال:</label>' +
                            '<input type="text" class="yarbar-input faq-q-input" placeholder="متن سوال را وارد کنید...">' +
                        '</div>' +
                        '<div class="yarbar-form-group">' +
                            '<label class="yarbar-label">پاسخ سوال:</label>' +
                            '<textarea class="yarbar-textarea faq-a-input" rows="3" placeholder="پاسخ کامل سوال را بنویسید..."></textarea>' +
                        '</div>';

                    list.appendChild( temp );
                    attachItemEvents( temp );
                    updateFaqCounters();

                    var qInput = temp.querySelector( '.faq-q-input' );
                    if ( qInput ) {
                        qInput.focus();
                    }
                } );
            } );

            updateFaqCounters();
        }

        // 4. AJAX Save Form Submission
        var saveBtns = wrap.querySelectorAll( '.yarbar-btn-save' );

        function handleSave( e ) {
            e.preventDefault();

            // Client-side validation: FAQ counts
            var col1List = wrap.querySelector( '.yarbar-faq-items-list[data-column="col1"]' );
            var col2List = wrap.querySelector( '.yarbar-faq-items-list[data-column="col2"]' );
            var col1Count = col1List ? col1List.querySelectorAll( '.yarbar-faq-item' ).length : 0;
            var col2Count = col2List ? col2List.querySelectorAll( '.yarbar-faq-item' ).length : 0;

            if ( col1Count < 1 || col1Count > 10 ) {
                showToast( 'خطا: ستون اول باید بین ۱ تا ۱۰ سوال داشته باشد. (تعداد فعلی: ' + col1Count + ')', false );
                switchTab( 'faq' );
                return;
            }
            if ( col2Count < 1 || col2Count > 10 ) {
                showToast( 'خطا: ستون دوم باید بین ۱ تا ۱۰ سوال داشته باشد. (تعداد فعلی: ' + col2Count + ')', false );
                switchTab( 'faq' );
                return;
            }

            // Sync all editor fields before gathering
            wrap.querySelectorAll( '.yarbar-editor-container' ).forEach( function( container ) {
                var hiddenInput = container.querySelector( '.yarbar-editor-data' );
                var visualView  = container.querySelector( '.yarbar-editor-view.is-visual' );
                var codeView    = container.querySelector( '.yarbar-editor-view.is-code' );
                if ( ! hiddenInput ) return;

                if ( container.classList.contains( 'mode-code' ) ) {
                    if ( codeView ) {
                        hiddenInput.value = codeView.value;
                        if ( visualView ) visualView.innerHTML = codeView.value;
                    }
                } else {
                    if ( visualView ) {
                        hiddenInput.value = visualView.innerHTML;
                        if ( codeView ) codeView.value = visualView.innerHTML;
                    }
                }
            } );

            // Gather settings
            var settings = {};

            // Text/Textarea/Select inputs with data-name
            wrap.querySelectorAll( 'input[data-name], textarea[data-name], select[data-name]' ).forEach( function( field ) {
                var name = field.getAttribute( 'data-name' );
                if ( name ) {
                    settings[ name ] = field.value;
                }
            } );

            // Gather FAQs
            settings.faqs = {
                col1: [],
                col2: []
            };

            if ( col1List ) {
                col1List.querySelectorAll( '.yarbar-faq-item' ).forEach( function( item ) {
                    var q = item.querySelector( '.faq-q-input' ) ? item.querySelector( '.faq-q-input' ).value : '';
                    var a = item.querySelector( '.faq-a-input' ) ? item.querySelector( '.faq-a-input' ).value : '';
                    settings.faqs.col1.push( { q: q, a: a } );
                } );
            }

            if ( col2List ) {
                col2List.querySelectorAll( '.yarbar-faq-item' ).forEach( function( item ) {
                    var q = item.querySelector( '.faq-q-input' ) ? item.querySelector( '.faq-q-input' ).value : '';
                    var a = item.querySelector( '.faq-a-input' ) ? item.querySelector( '.faq-a-input' ).value : '';
                    settings.faqs.col2.push( { q: q, a: a } );
                } );
            }

            // Lock save buttons
            saveBtns.forEach( function( btn ) {
                btn.disabled = true;
                btn.classList.add( 'is-loading' );
            } );

            var nonce = window.yarbarAdminData ? window.yarbarAdminData.nonce : '';
            var ajaxUrl = window.yarbarAdminData ? window.yarbarAdminData.ajaxUrl : window.ajaxurl;

            var formData = new FormData();
            formData.append( 'action', 'yarbar_save_settings' );
            formData.append( 'nonce', nonce );

            // Flatten settings into form data
            function appendObject( obj, prefix ) {
                for ( var key in obj ) {
                    if ( Object.prototype.hasOwnProperty.call( obj, key ) ) {
                        var propName = prefix ? prefix + '[' + key + ']' : key;
                        var val = obj[ key ];
                        if ( typeof val === 'object' && val !== null ) {
                            appendObject( val, propName );
                        } else {
                            formData.append( propName, val );
                        }
                    }
                }
            }

            appendObject( settings, 'settings' );

            fetch( ajaxUrl, {
                method: 'POST',
                body: formData,
                credentials: 'same-origin'
            } )
            .then( function( res ) {
                return res.json();
            } )
            .then( function( data ) {
                saveBtns.forEach( function( btn ) {
                    btn.disabled = false;
                    btn.classList.remove( 'is-loading' );
                } );

                if ( data && data.success ) {
                    showToast( data.data.message || 'تنظیمات با موفقیت ذخیره شد.', true );
                } else {
                    var msg = ( data && data.data && data.data.message ) ? data.data.message : 'خطایی در هنگام ذخیره تنظیمات رخ داد.';
                    showToast( msg, false );
                }
            } )
            .catch( function( err ) {
                saveBtns.forEach( function( btn ) {
                    btn.disabled = false;
                    btn.classList.remove( 'is-loading' );
                } );
                showToast( 'خطای ارتباط با سرور رخ داد.', false );
            } );
        }

        saveBtns.forEach( function( btn ) {
            btn.addEventListener( 'click', handleSave );
        } );

    } );
} )();
