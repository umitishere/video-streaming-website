$(document).ready(() => {

    $(".navShowHide").on("click", () => {

        let main = $("#mainSectionContainer");
        let nav = $("#sideNavContainer");

        if (main.hasClass("leftPadding")) {
            nav.hide();
        } else {
            nav.show();
        }

        main.toggleClass("leftPadding");

    })

});