
var selectedSeats = [];
var selectedLoveSeats = [];

var lastSelectedSeat = null;
var lastSelectedLoveSeat = null;


function addSeat(n, button) {
	if (Contains(selectedSeats, n)) {
		//alert("Stoel is al geselecteerd!");
		RemoveFromArray(selectedSeats, n, button);

		if (lastSelectedSeat === n) 
		{
			lastSelectedSeat = null;
		}
	}
	else {
		if (lastSelectedSeat != null) 
		{
			if (n == (lastSelectedSeat++) || n == (lastSelectedSeat--)) 
			{
				selectedSeats.push(n);
				lastSelectedSeat = n;
				$(button).addClass("active");
				UpdateView();
			}
			else 
			{
				if (n == (lastSelectedSeat - 1)) {
        			selectedSeats.push(n);
					lastSelectedSeat = n;
					$(button).addClass("active");
					UpdateView();
    			}
    			else {			
        			//popup, are you sure?
					var seatnumDump = document.getElementById("seatnum");
					// var buttonDump = document.getElementById("thebutton");

					$("#ForceSeatButton").click(function(){ ForceSeat(n, button) });

					seatnumDump.innerHTML = n;
					// buttonDump.innerHTML = button;

					$('#confirmseat').modal({
  						show: true
					})
    			}
			}
		}
		else
		{
			selectedSeats.push(n);
			lastSelectedSeat = n;
			$(button).addClass("active")
			UpdateView();
		}
	}
}

function ForceSeat(n, button) {
    selectedSeats.push(n);
    lastSelectedSeat = n;
	$(button).addClass("active");
	document.getElementById("seatnum").innerHTML = "";
	UpdateView();

	FixArray();
	$('#ForceSeatButton').unbind();
}

function AddLoveSeat(n, button) {
	if (Contains(selectedLoveSeats, n)) {
		//alert("Love Seat is al geselecteerd!");
		RemoveFromArray(selectedLoveSeats, n, button);

		if (lastSelectedLoveSeat === n) {
			lastSelectedLoveSeat = null;
		}
	}
	else {
		// selectedLoveSeats.push(n);
		// $(button).addClass("active")
		// UpdateView();
		if (lastSelectedLoveSeat != null) {
			if ( n == (lastSelectedLoveSeat++) || n == (lastSelectedLoveSeat--)) 
			{
				selectedLoveSeats.push(n);
				lastSelectedLoveSeat = n;
				$(button).addClass("active");
				UpdateView();
			}
			else 
			{
				if (n == (lastSelectedLoveSeat - 1)) {
					selectedLoveSeats.push(n);
					lastSelectedLoveSeat = n;
					$(button).addClass("active");
					UpdateView();
				}
				else 
				{
					//popup, are you sure?
					var loveSeatNumDump = document.getElementById("loveseatnum");
					// var buttonDump = document.getElementById("thebutton");

					$("#ForceLoveSeatButton").click(function(){ ForceLoveSeat(n, button) });

					loveSeatNumDump.innerHTML = n;
					// buttonDump.innerHTML = button;

					$('#confirmloveseat').modal({
  						show: true
					})
				}
			}
		}
		else
		{
			selectedLoveSeats.push(n);
			lastSelectedLoveSeat = n;
			$(button).addClass("active")
			UpdateView();
		}
	}
}

function ForceLoveSeat(n, button) {
    selectedLoveSeats.push(n);
    lastSelectedLoveSeat = n;
	$(button).addClass("active");
	document.getElementById("loveseatnum").innerHTML = "";
	UpdateView();

	FixArray();
	$('#ForceLoveSeatButton').unbind();
}

function Taken() {
	//alert("Stoel al bezet!");
	$('#seattaken').modal({
  		show: true
	})
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

function FixArray() {
	var fixedArray = [];
	var fixedLoveArray = [];

	$.each(selectedSeats, function(i, el){
    	if($.inArray(el, fixedArray) === -1) fixedArray.push(el);
	});

	$.each(selectedLoveSeats, function(i, el){
    	if($.inArray(el, fixedLoveArray) === -1) fixedLoveArray.push(el);
	});

	selectedSeats = fixedArray;
	selectedLoveSeats = fixedLoveArray;

	UpdateView();
}

function Order() {
	FixArray();
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
        		// console.log(data);
        		$("body").html(data);
    		}
    	});
	}
	else 
	{
		// alert("U moet minimaal een stoel kiezen!");
		$('#pleaseselect1').modal({
  			show: true
		})
	}
}

function Clear() {
	$('#confirmclear').modal({
  		show: true
	})
}

function EraseSelection() {
	lastSelectedSeat = null;
	lastSelectedLoveSeat = null;

	selectedSeats.splice(0, selectedSeats.length);
   	selectedLoveSeats.splice(0, selectedLoveSeats.length);
	document.getElementById("selected").innerHTML = "";
	UpdateView();
	var active_elements = document.getElementsByClassName("active");
	for (var i = active_elements.length - 1; i >= 0; i--) {
		$(active_elements[i]).removeClass("active");
	}

	$('#ForceSeatButton').unbind();
	$('#ForceLoveSeatButton').unbind();
}