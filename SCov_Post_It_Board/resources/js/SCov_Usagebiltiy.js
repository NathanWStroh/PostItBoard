$(document).ready(function ()
{
    function SortTable() {
        var rows = $('#tableOfPosts').get();

        rows.sort(function (a, b) {
            var A = $(a).children('td').eq(1).text().toUpperCase();
            var B = $(b).children('td').eq(1).text().toUpperCase();

            if (A < B) {
                return -1;
            }
            if (A > B) {
                return 1;
            }
            return 0;
        });

        $.each(rows, function (index, row) {
            $('#tableOfPosts').children('tbody').append(row);

        });
    }
    
    $('#createNewPostItButton').click(function(){
       alert('testing'); 
    });
    
}
);

