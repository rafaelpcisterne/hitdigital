$(function () {
    $("form").submit(function (e) {
        e.preventDefault();

        var form = $(this);
        var action = form.attr("action");
        var data = form.serialize();

        form.ajaxSubmit({
            url: action,
            data: data,
            type: "post",
            dataType: "json",
            beforeSend: function (load) {
                ajax_load("open");
            },
            uploadProgress: function (event, position, total, completed) {
                var loaded = completed;
                var load_title = $(".ajax_load_box_title");
                load_title.text("Enviando (" + loaded + "%)");

                form.find("input[type='file']").val(null);
                if (completed >= 100) {
                    load_title.text("Aguarde, carregando...");
                }
            },
            success: function (su) {
                ajax_load("close");

                if (su.addItem) {
                    var event_box = (su.addItem.eventBox === "html" ?
                        $("." + su.addItem.box).fadeTo("300", "0.5", function () {
                            $(this).append(su.addItem.view).fadeTo('300', '1');
                        }) :
                        (su.addItem.eventBox === "append" ?
                            $("." + su.addItem.box).fadeTo("300", "0.5", function () {
                                $(this).append(su.addItem.view).fadeTo('300', '1');
                            }) :
                            $("." + su.addItem.box).fadeTo("300", "0.5", function () {
                                $(this).prepend(su.addItem.view).fadeTo('300', '1');
                            })));
                    var clear = su.addItem.clear;

                    $("." + su.addItem.box).find(".message_register").fadeOut(200, function () {
                        event_box;
                    });

                    if (clear) {
                        form.each(function () {
                            this.reset();
                        });
                    }
                }

                if (form.find(".j_btn_active.btn-blue").length) {
                    form.find(".j_btn_active:not(.formEdit)").removeClass("btn-blue icon-check-box-checked");
                    form.find(".j_btn_active:not(.formEdit)").addClass("btn-gray icon-check-box-unchecked");
                    form.find("input[name=active]:not(.formEdit)").val(0)
                }

                if (su.message) {
                    var box = $(".message_box");
                    var view = '<div class="message_modal"><div class="message_box radius-medium ' + su.message.type + '"><div class="message_icon"><span class="rounded ' + su.message.icon + ' ' + su.message.type + ' icon-notext"></span></div><div class="message ' + su.message.type + '"><p>' + su.message.msgTitle + '</p><p>' + su.message.description + '</p></div><div class="message_button"><span class="btn btn-blue icon-check transition j_message_close">OK</span></div></div></div>';
                    $(".message_modal_box").html(view);
                    // $(".login_form_callback").html(view);
                    $(".message_modal").fadeIn(100, function () {
                        box.effect("bounce", 400);
                        box.append("<div class='message_time'></div>");
                        $(".message_time").animate({"width": "100%"}, 5000, function () {
                            $(this).parent().parent().remove().fadeOut(400);
                        });
                    });

                    if (su.message.clear) {
                        form.each(function () {
                            this.reset();
                        });
                    }
                    if (su.message.clearTextarea) {
                        form.find("textarea").val("");
                    }
                }

                if (su.modal) {
                    $(".modal_box_content").fadeIn(400).css("display", "flex");
                    $("." + su.modal.file).fadeIn(400);
                }

                if (su.modalClose) {
                    $(".modal_box_content").fadeOut(400).css("display", "none");
                    $("." + su.modal.file).fadeOut(400).css("display", "none");
                }

                if (su.redirect) {
                    window.location.href = su.redirect.url;
                }
                if (su.reload) {
                    window.location.reload();
                }
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

    $("body").on("click", ".j_message_close", function () {
        $(".message_modal").fadeOut(400, function () {
            $(this).remove();
        });
    });
})
;