$(document).ready(function() {
    $(document).delegate('.ingredient_class input[type="checkbox"]','change',function() {
        $.pjax.reload({container: "#products_container"});
    })
});