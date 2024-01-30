 <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
 <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>



 <div class="modalDialog" style="display:none;">
     <iframe class="modalIframe" src="" frameborder="0" style="width:100%; height:100%;"></iframe>

 </div>

 <script>
(function($) {
    $(document).ready(function() {
        $(".openModal").on("click", function(e) {
            e.preventDefault();

            var url = $(this).attr("href");
            var title = "Quick Edit";

            var modalDialog = $(".modalDialog");
            var modalIframe = modalDialog.find(".modalIframe");

            modalDialog.dialog({
                autoOpen: false,
                modal: true,
                width: "auto",
                height: "auto",
                title: title,
                open: function() {
                    modalIframe.attr("src", url);
                },
                close: function() {
                    modalIframe.attr("src", "");
                    location.reload(true);
                }
            });



            modalDialog.dialog("open");
        });


    });
})(jQuery);
 </script>