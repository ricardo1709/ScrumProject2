
var selectedSeats = [];
var selectedLoveSeats = [];

function addSeat(n, button) {
	if (Contains(selectedSeats, n)) {
		//alert("Stoel is al geselecteerd!");
		RemoveFromArray(selectedSeats, n, button);
	}
	else {
		selectedSeats.push(n);
		$(button).addClass("active")
		UpdateView();
	}
}

function AddLoveSeat(n, button) {
	if (Contains(selectedLoveSeats, n)) {
		//alert("Love Seat is al geselecteerd!");
		RemoveFromArray(selectedLoveSeats, n, button);
	}
	else {
		selectedLoveSeats.push(n);
		$(button).addClass("active")
		UpdateView();
	}
}

function Taken() {
	alert("Stoel al bezet!");
}

function Contains(thearray, theitem) {
	var con = false;

	for (var i = thearray.length - 1; i >= 0; i--) {
		if (thearray[i] == theitem) {
			con = true;
		}
	}
	return con;
}

function RemoveFromArray(thearray, theitem, button) {
	for (var i = thearray.length - 1; i >= 0; i--) {
		if (thearray[i] == theitem) {
			thearray.splice(i, 1);
		}
	}
	UpdateView();
	$(button).removeClass("active")
}

function UpdateView() {
	document.getElementById("selected").innerHTML = "";

	for (var i = selectedSeats.length - 1; i >= 0; i--) {
		var ul = document.getElementById("selected");
 		var li = document.createElement("li");
  		li.appendChild(document.createTextNode("Stoel " + selectedSeats[i]));
  		ul.appendChild(li);
	}

	for (var i = selectedLoveSeats.length - 1; i >= 0; i--) {
		var ul = document.getElementById("selected");
 		var li = document.createElement("li");
 		li.setAttribute("class", "love");
  		li.appendChild(document.createTextNode("Love Seat " + selectedLoveSeats[i]));
  		ul.appendChild(li);
	}
}

function Order() {
	if (selectedSeats.length > 0 || selectedLoveSeats.length > 0) {
		//POST NAAR LARAVEL?
		var locurl = document.getElementById("paylocation").innerHTML;

		FixAjax();
		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

		$.ajax({
        	type: 'POST',
        	url: locurl,
        	data: {sseats:selectedSeats, sloveseats:selectedLoveSeats, _token:CSRF_TOKEN},
        	cache: false,
        	success: function (data) {
        		console.log(data);
    		}
    	});
	}
	else 
	{
		alert("U moet minimaal een stoel kiezen!");
	}
}

function Clear() {
	var r = confirm("Alle stoelen deselecteren?");
	if (r == true) {
    	selectedSeats.splice(0, selectedSeats.length);
    	selectedLoveSeats.splice(0, selectedLoveSeats.length);
		document.getElementById("selected").innerHTML = "";
		UpdateView();
		var active_elements = document.getElementsByClassName("active");
		for (var i = active_elements.length - 1; i >= 0; i--) {
			$(active_elements[i]).removeClass("active");
		}
	} else {
    	alert("Cancelled");
	}
}