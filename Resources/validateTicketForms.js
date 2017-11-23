window.onload = function() {
	
	// Get all of the buttons for the forms
	var subs = document.forms

	// Add an event listener to each to test the textarea
	for (var i = subs.length - 1; i >= 0; i--) {
		subs[i].addEventListener("submit", function(event){
		
			event.preventDefault();
			if (validate(event.currentTarget)==true){
				event.currentTarget.submit();
			}
		}, true );
	}
}

function validate(form) {
	
	// Test if this form has a userDesc input
	if(form.elements["userDesc"]){

		// get reference to the textarea
		var ref = form.elements["userDesc"];
		var err = ref.previousElementSibling.previousElementSibling;

		// If so, test it for special characters
		if (/[~`#$%\^&*+=\-\[\]\\';/{}|\\":<>\?]/.test(ref.value) == true){
			err.innerHTML = "Please only include Alpha-numeric characters"
			err.hidden = false;
			return false;
		}
	}
	return true;
}