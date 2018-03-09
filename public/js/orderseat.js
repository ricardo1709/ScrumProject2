
var selectedSeats = [];
var selectedLoveSeats = [];

function addSeat(n, e) {
	if (Contains(selectedSeats, n)) {
		alert("Stoel is al geselecteerd!");
	}
	else {
		selectedSeats.push(n);
		UpdateView();
	}
}

function AddLoveSeat(n) {
	if (Contains(selectedLoveSeats, n)) {
		alert("Love Seat is al geselecteerd!");
	}
	else {
		selectedLoveSeats.push(n);
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
	if (selectedSeats.length > 0) {
		//POST NAAR LARAVEL?
		var locurl = document.getElementById("paylocation");

		$.ajax({
        	type: 'POST',
        	url: locurl,
        	data: {sseats:selectedSeats, sloveseats:selectedLoveSeats},
        	cache: false
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
	} else {
    	alert("Cancelled");
	}
}