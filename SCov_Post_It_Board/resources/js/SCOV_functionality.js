$(document).ready(function () {

    $('.home').DataTable({
        "columnDefs": [
            {"width": "150px", "targets": 3},
            {"width": "150px", "targets": 7},
        ]
    });
	
	//var table = $('.home').DataTable({
	//	ajax: "data.json"
    //});
	
	//setInterval(function(){
		//table.ajax.reload();
	//}, 5000);
	
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
            placement: 'bottom'
        });
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
    $('textarea').keypress(function(event) {
    // Check the keyCode and if the user pressed Enter (code = 13) 
    // disable it
    if (event.keyCode === 13) {
        event.preventDefault();
    }});
});
