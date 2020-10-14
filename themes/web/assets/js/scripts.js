$(function () {
    //MOBILE MENU
    $(".j_nav_mobile").click(function (e) {
        e.preventDefault();
        var menu = $(this);
        $(".main_header_nav").animate({"right": 0}, 200);
    });

    // CLOSE MENU
    $(".j_nav_close").click(function (e) {
        e.preventDefault();
        $(".main_header_nav").animate({"right": "-100%"}, 200);
    });

    /*
     * MODAL
     */
    $("[data-modalopen]").click(function (e) {
        var clicked = $(this);
        var modal = clicked.data("modalopen");
        $(".modal_box_content").fadeIn(400).css("display", "flex");
        $(modal).fadeIn(400);
    });

    $("[data-modalclose]").click(function (e) {
        if (e.target === this) {
            $(this).fadeOut(400);
            $(this).children().fadeOut(400);
        }
    });

    // modal open
    $("[data-modal]").click(function (e) {
        e.preventDefault();
        var modal = $(this).data("modal");
        $(modal).fadeIn(400).css("display", "flex");
    });
});