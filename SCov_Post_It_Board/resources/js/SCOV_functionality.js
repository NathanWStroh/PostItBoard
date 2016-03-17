$(document).ready(function () {

    $('.home').DataTable({
        "columnDefs": [
            {"width": "150px", "targets": 3},
            {"width": "150px", "targets": 7},
        ]
    });

    $('.team').DataTable({
    });

    $('.updatePageTable').DataTable({
        "columnDefs": [
            {"width": "150px", "targets": 3},
            {"width": "150px", "targets": 7},
            {"width": "60px", "targets": 8},
            {"width": "60px", "targets": 9}
        ]
    });

    $('.userSettings').DataTable({
    });

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

    $(function () {
        $("#from").datepicker({
            defaultDate: "+1w",
            changeMonth: true,
            numberOfMonths: 1,
            dateFormat: 'yy-mm-dd',
            onClose: function (selectedDate) {
                $("#to").datepicker("option", "minDate", selectedDate);
            }
        });
        $("#to").datepicker({
            maxDate: 0,
            defaultDate: "+1w",
            changeMonth: true,
            numberOfMonths: 1,
            dateFormat: 'yy-mm-dd',
            onClose: function (selectedDate) {
                $("#from").datepicker("option", "maxDate", selectedDate);
            }
        });
    });

});