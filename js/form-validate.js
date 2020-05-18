function required(control_id, feedback_id, errortext) {
	$('#' + feedback_id).empty();

	var value = $('#' + control_id).val();

	if (value == '') {
		$('#' + control_id).addClass('is-invalid');
		$('#' + feedback_id).append(errortext);
		return false;
	} else {
		$('#' + control_id).removeClass('is-invalid');
		return true;
	}
}

function error(control_id, feedback_id, errortext) {
	$('#' + feedback_id).empty();

	$('#' + control_id).addClass('is-invalid');
	$('#' + feedback_id).append(errortext);
}
