$(document).ready(function () {

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

    $(function () {
        $("body").tooltip({
            selector: '[data-toggle="tooltip"]',
            container: 'body',
            placement: 'bottom',
            fontsize: 'px'
        });
    });
});
