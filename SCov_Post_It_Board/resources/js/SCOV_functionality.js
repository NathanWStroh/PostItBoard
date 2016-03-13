$(document).ready(function () {
    $('#tableOfPosts').DataTable();
    $('#tableOfPosts').colResizable({
        liveDrag: true,
        gripInnerHtml: "<div class='grip'></div>",
        draggingClass: "dragging"});
});