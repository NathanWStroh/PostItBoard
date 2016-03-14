$(document).ready(function () {
    $('#tableOfPosts').DataTable();
    $('#tableOfPosts').colResizable({
        liveDrag: true,
        gripInnerHtml: "<div class='grip'></div>",
        draggingClass: "dragging"});

    $("#tableOfPosts td").tooltip({
 
        // each trashcan image works as a trigger
        tip: '#tooltip',
 
        // custom positioning
        position: 'center right',
 
        // move tooltip a little bit to the right
        offset: [0, 15],
 
        // there is no delay when the mouse is moved away from the trigger
        delay: 0
    });
});