/* Update user-modified values */
function updateValue(element, column_name, todo_id) {
    if (column_name === 'due_date' || column_name === 'todo_status') {
        // If updated value is a date, use val() to extract it...
        var element_val = $(element).val(); 
    }
    else {
        // ...Else, extract the value from the div's innerText
        var element_val = element.innerText; 
    }
    console.log(element_val)
    // Live-update modified values in database
    $.ajax({
        url: 'val_update.php',
        type: 'POST',
        data: {
            value: element_val,
            column: column_name,
            id: todo_id
        },
        // Log any output from the POST request
        success: function (php_result) {		
            console.log(php_result); 
        }
    })
}

/* Datepicker config (due_date) */
$('.datepicker-input').datepicker({
    // Transform date into MySQL DATE format
    dateFormat: "yy-mm-dd",
    // Don't allow dates before today
    minDate: 0
});