/* Update user-modified values */
function updateValue(element, column_name, todo_id) {
	if (column_name === 'due_date' || column_name === 'todo_status') {
		var element_val = $(element).val(); // If updated value is a date, use val() to extract it...
	}
	else {
		var element_val = element.innerText; // ...Else, extract the value from the div's innerText
	}
	console.log(element_val)
	$.ajax({	// Live-update modified values in database
		url: 'val_update.php',
		type: 'POST',
		data: {
			value: element_val,
			column: column_name,
			id: todo_id
		},
		success: function (php_result) {
			console.log(php_result); // Log any errors or echos from the POST request
		}
	})
}

/* Due Date datepicker config */
$('.datepicker-input').datepicker({
	dateFormat: "yy-mm-dd", // Transform date into MySQL DATE format
	minDate: 0 // Don't allow dates before today
});