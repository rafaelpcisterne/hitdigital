$(function () {
    //MOBILE MENU
    $(".dash_main_header_menu").click(function () {
        if ($(".dash_nav").css("margin-left") === '-100%') {
            $(".dash_nav").css({"display": "block"}).animate({"margin-left": "0"}, 100).removeClass("dash_nav_hide_menu");
        } else {
            $(".dash_nav").css({"display": "none"}).animate({"margin-left": "-100%"}, 100).addClass("dash_nav_hide_menu");
        }
    });

    // CLOSE MENU
    $(".j_dash_nav_close").click(function (e) {
        e.preventDefault();
        $(".dash_nav").css({"display": "none"}).animate({"margin-left": "-100%"}, 100).addClass("dash_nav_hide_menu");
    });

    $(".j_nav_account").on("click", function (e) {
        e.preventDefault();
        e.stopPropagation();

        if ($(this).hasClass("active")) {
            $(".main_header_account_nav").animate({
                "opacity": "0",
                "padding": "0"
            }, 200, function () {
                $(this).css("display", "none");
            });
            $(this).removeClass("active");
        } else {
            $(this).addClass("active");
            // $(this).append(ul);
            $(".main_header_account_nav").animate({
                "opacity": "1",
                "padding": "10px"
            }).css("display", "block");
        }
    });

    // swiper slide ### home
    var slides = new Swiper('.swiper-container', {
        pagination: {
            el: '.swiper-pagination',
            dynamicBullets: true
        },
        autoplay: true,
        speed: 1000,
        loop: true,
    });

    // collopse
    $(".j_collapse").click(function (e) {
        e.preventDefault();
        var collapse = $(this);

        if ($(".j_collapse_icon").hasClass("icon-minus")) {
            $(".j_collapse_icon").addClass("icon-plus");
        }

        if (collapse.find(".j_collapse_box").is(":visible")) {
            collapse.find(".j_collapse_icon").removeClass("icon-minus").addClass("icon-plus");
            collapse.find(".j_collapse_box").slideUp(200);
        } else {
            collapse.find(".j_collapse_icon").removeClass("icon-plus").addClass("icon-minus");
            collapse.parent().find(".j_collapse_box").slideUp(200);
            collapse.find(".j_collapse_box").slideDown(200);
        }
    });

    // AJAX RESPONSE
    function ajaxMessage(icon, type, msgTitle, description) {
        // var ajaxMessage = $(message);

        // ajaxMessage.append("<div class='message_time'></div>");
        var box = $(".message_box");
        // var view = '<div class="message_modal"><div class="message_box radius-medium"><div class="message_close transition"><p class="radius-medium transition">Fechar</p><span class="icon-notext icon-times rounded transition"></span></div><div class="message ' + type + ' radius">' + message + '</div></div></div>';
        var view = '<div class="message_modal"><div class="message_box radius-medium ' + type + '"><div class="message_icon"><span class="rounded ' + icon + ' ' + type + ' icon-notext"></span></div><div class="message ' + type + '"><p>' + msgTitle + '</p><p>' + description + '</p></div><div class="message_button"><span class="btn btn-blue icon-check transition j_message_close">OK</span></div></div></div>';

        $(".message_modal_box").html(view);
        $(".message_modal").fadeIn(100, function () {
            box.effect("bounce", 400);
            box.append("<div class='message_time'></div>");
            $(".message_time").animate({"width": "100%"}, time * 1000, function () {
                $(this).parent().parent().remove().fadeOut(400);
            });
        });
    }

    var slides = new Swiper('.swiper-container', {
        pagination: {
            el: '.swiper-pagination',
            dynamicBullets: true
        },
        autoplay: true,
        speed: 1000,
        loop: true,
    });

    $('.tab_item').click(function () {
        if (!$(this).hasClass('active')) {
            var WcTab = $(this).attr('href');

            $('.tab_item').removeClass('active');
            $(this).addClass('active');

            $('.tab_content.active').fadeOut(200, function () {
                $(WcTab).fadeIn(300).addClass('active');
            }).removeClass('active');
        }

        if (!$(this).hasClass('active_go')) {
            return false;
        }
    });

    if ($('.mce_basic').length) {
        tinyMCE_basic();
    }

    //filter support
    $('.j_filter_support').click(function (e) {
        e.preventDefault();

        if ($('.dash_box_item.filter').is(':visible')) {
            $('.dash_box_item.filter').slideUp();
        } else {
            $('.dash_box_item.filter').slideDown();
        }
    });

    /*
     * IMAGE RENDER
     */
    $("[data-image]").change(function (e) {
        var changed = $(this);
        var file = this;

        if (file.files && file.files[0]) {
            var render = new FileReader();

            render.onload = function (e) {
                $(changed.data("image")).fadeTo(100, 0.1, function () {
                    $(this).attr("src", e.target.result)
                        .fadeTo(100, 1);
                });
            };
            render.readAsDataURL(file.files[0]);
        }
    });

    /*
     * BUTTON REGISTER DELETE
     */
    $("body").on("click", ".j_btn_delete:not(.link_disable)", function (e) {
        e.preventDefault();
        $(this).fadeOut(400, function () {
            $(this).parent().find(".j_btn_delete_confirm").css({
                "margin-right": "0",
                "display": "inline-block"
            }).fadeIn(400);
        });
    });

    /*
     * BUTTON CONFIRMATION REGISTER DELETE
     */
    $("body").on("click", ".j_btn_delete_confirm", function (e) {
        e.preventDefault();

        var id = $(this).data("id");
        var action = $(this).data("action");
        var url = $(this).data("url");

        //optional
        var bonus = $(this).data("bonus");
        var itemBox = $(this).parent().parent();

        $.post({
            type: "POST", url: url,
            data: "action=" + action + "&id=" + id + "&bonus=" + bonus,
            dataType: "json",
            beforeSend: function () {
                ajax_load("open");
            },
            success: function (response) {
                ajax_load("close");

                if (response.removeItem && response.removeItem.box) {
                    var iBox = $("." + response.removeItem.box + "[id=" + response.removeItem.id + "]");
                    iBox.fadeOut(400, function () {
                        $(this).remove();
                    });
                }

                if (response.removeItem && !response.removeItem.box) {
                    itemBox.fadeOut(400, function () {
                        $(this).remove();
                    });
                }

                if (response.message) {
                    var box = $(".message_box");
                    var view = '<div class="message_modal"><div class="message_box radius-medium ' + response.message.type + '"><div class="message_icon"><span class="rounded ' + response.message.icon + ' ' + response.message.type + ' icon-notext"></span></div><div class="message ' + response.message.type + '"><p>' + response.message.msgTitle + '</p><p>' + response.message.description + '</p></div><div class="message_button"><span class="btn btn-blue icon-check transition j_message_close">OK</span></div></div></div>';
                    $(".message_modal_box").html(view);
                    $(".message_modal").fadeIn(100, function () {
                        box.effect("bounce", 400);
                        box.append("<div class='message_time'></div>");
                        $(".message_time").animate({"width": "100%"}, 5000, function () {
                            $(this).parent().parent().remove().fadeOut(400);
                        });
                    });
                }

                if (response.redirect) {
                    window.location.href = response.redirect.url;
                }

                if (response.material) {
                    if (response.material.removeMaterial) {
                        $("." + response.material.box).slideUp(400)
                    }
                }
            }
        });
    })

    /*
     * BUTTON ACTIVE REGISTER
     */
    $(".j_btn_active").on("click", function (e) {
        e.preventDefault();
        var active = $("input[name=active]");

        if (active.val() === "1") {
            active.val("0");
            $(this).removeClass("btn-blue icon-check-box-checked").addClass("btn-gray icon-check-box-unchecked");
        } else {
            active.val("1");
            $(this).removeClass("btn-gray icon-check-box-unchecked").addClass("btn-blue icon-check-box-checked");
        }
    })

    $(".j_draf_annotation").on("click", function (e) {
        e.preventDefault();
        var id = $(this).data("id");
        var action = $(this).data("action");
        var url = $(this).data("url");

        $.post({
            type: "POST", url: url,
            data: "action=" + action + "&id=" + id,
            dataType: "json",
            beforeSend: function () {
                ajax_load("open");
            },
            success: function (response) {
                ajax_load("close");

                if (response.addItem) {
                    $("." + response.addItem.box).fadeTo("300", "0.5", function () {
                        $("." + response.addItem.box).fadeTo("300", "1").html(response.addItem.view);
                    });
                }

                if (response.message) {
                    var box = $(".message_box");
                    var view = '<div class="message_modal"><div class="message_box radius-medium ' + response.message.type + '"><div class="message_icon"><span class="rounded ' + response.message.icon + ' ' + response.message.type + ' icon-notext"></span></div><div class="message ' + response.message.type + '"><p>' + response.message.msgTitle + '</p><p>' + response.message.description + '</p></div><div class="message_button"><span class="btn btn-blue icon-check transition j_message_close">OK</span></div></div></div>';
                    $(".message_modal_box").html(view);
                    $(".message_modal").fadeIn(100, function () {
                        box.effect("bounce", 400);
                        box.append("<div class='message_time'></div>");
                        $(".message_time").animate({"width": "100%"}, 5000, function () {
                            $(this).parent().parent().remove().fadeOut(400);
                        });
                    });
                }
            }
        });
    });

    //MASK INPUTS
    $(".mask-date").mask('00/00/0000');
    $(".mask-datetime").mask('00/00/0000 00:00');
    $(".mask-month").mask('00/0000', {reverse: true});
    $(".mask-doc").mask('000.000.000-00', {reverse: true});
    $(".mask-card").mask('0000  0000  0000  0000', {reverse: true});
    $(".mask-money").mask('000.000.000.000.000,00', {reverse: true, placeholder: "0,00"});
    $(".mask-zipcode").mask('00000-000', {reverse: true});
    $(".mask-telephone").mask('(00) 0000-0000');
    $(".mask-cell").mask('(00) 00000-0000');
    $(".mask-phone").mask("(00) 0000-00000")
        .focusout(function (event) {
            var target, phone, element;
            target = (event.currentTarget) ? event.currentTarget : event.srcElement;
            phone = target.value.replace(/\D/g, '');
            element = $(target);
            element.unmask();
            if (phone.length > 10) {
                element.mask("(00) 00000-0000");
            } else {
                element.mask("(00) 0000-0000");
            }
        });

    function ajax_load(action) {
        ajax_load_div = $(".ajax_load");

        if (action === "open") {
            ajax_load_div.fadeIn(200).css("display", "flex");
        }

        if (action === "close") {
            ajax_load_div.fadeOut(200);
        }
    }
});

// TINYMCE INIT
tinyMCE.init({
    selector: "textarea.mce",
    language: 'pt_BR',
    menubar: false,
    theme: "modern",
    height: 132,
    skin: 'light',
    entity_encoding: "raw",
    theme_advanced_resizing: true,
    plugins: [
        "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
        "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
        "save table contextmenu directionality emoticons template paste textcolor media"
    ],
    toolbar: "styleselect | pastetext | removeformat |  bold | italic | underline | strikethrough | bullist | numlist | alignleft | aligncenter | alignright |  link | unlink | fsphpimage | code | fullscreen",
    style_formats: [
        {title: 'Normal', block: 'p'},
        {title: 'Titulo 3', block: 'h3'},
        {title: 'Titulo 4', block: 'h4'},
        {title: 'Titulo 5', block: 'h5'},
        {title: 'Código', block: 'pre', classes: 'brush: php;'}
    ],
    link_class_list: [
        {title: 'None', value: ''},
        {title: 'Blue CTA', value: 'btn btn_cta_blue'},
        {title: 'Green CTA', value: 'btn btn_cta_green'},
        {title: 'Yellow CTA', value: 'btn btn_cta_yellow'},
        {title: 'Red CTA', value: 'btn btn_cta_red'}
    ],
    setup: function (editor) {
        editor.addButton('fsphpimage', {
            title: 'Enviar Imagem',
            icon: 'image',
            onclick: function () {
                $('.mce_upload').fadeIn(200, function (e) {
                    $("body").click(function (e) {
                        if ($(e.target).attr("class") === "mce_upload") {
                            $('.mce_upload').fadeOut(200);
                        }
                    });
                }).css("display", "flex");
            }
        });
    },
    link_title: false,
    target_list: false,
    theme_advanced_blockformats: "h1,h2,h3,h4,h5,p,pre",
    media_dimensions: false,
    media_poster: false,
    media_alt_source: false,
    media_embed: false,
    extended_valid_elements: "a[href|target=_blank|rel|class]",
    imagemanager_insert_template: '<img src="{$url}" title="{$title}" alt="{$title}" />',
    image_dimensions: false,
    relative_urls: false,
    remove_script_host: false,
    paste_as_text: true
});

//FUNCTION TINYMCE BASIC
function tinyMCE_basic() {
    tinyMCE.init({
        selector: "textarea.mce_basic",
        language: 'pt_BR',
        menubar: false,
        theme: "modern",
        height: 200,
        skin: 'light',
        entity_encoding: "raw",
        theme_advanced_resizing: true,
        plugins: [
            "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
            "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
            "save table contextmenu directionality emoticons template paste textcolor media"
        ],
        toolbar: "styleselect | forecolor | backcolor | pastetext | removeformat |  bold | italic | underline | strikethrough | bullist | numlist |  link | unlink | fullscreen",
        content_css: "_css/tinyMCE.css",
        style_formats: [
            {title: 'Normal', block: 'p'},
            {title: 'Titulo 3', block: 'h3'},
            {title: 'Titulo 4', block: 'h4'},
            {title: 'Titulo 5', block: 'h5'},
            {title: 'Código', block: 'pre', classes: 'brush: php;'}
        ],
        link_class_list: [
            {title: 'None', value: ''},
            {title: 'Blue CTA', value: 'btn btn_cta_blue'},
            {title: 'Green CTA', value: 'btn btn_cta_green'},
            {title: 'Yellow CTA', value: 'btn btn_cta_yellow'},
            {title: 'Red CTA', value: 'btn btn_cta_red'}
        ],
        link_title: false,
        target_list: false,
        theme_advanced_blockformats: "h1,h2,h3,h4,h5,p,pre",
        media_dimensions: false,
        media_poster: false,
        media_alt_source: false,
        media_embed: false,
        extended_valid_elements: "a[href|target=_blank|rel|class]",
        imagemanager_insert_template: '<img src="{$url}" title="{$title}" alt="{$title}" />',
        image_dimensions: false,
        relative_urls: false,
        remove_script_host: false,
        paste_as_text: true
    });
}