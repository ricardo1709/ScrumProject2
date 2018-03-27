var url = "http://www.omdbapi.com/?i=tt3896198&apikey=11afb677&s=";
var results = [];
$("#movieName").keyup(function() {
	var title = document.getElementById("movieName").value;
	var preppedUrl = url + title;

    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

	// FixAjax();
    jQuery.get({
        dataType: "json",
        url: preppedUrl,
        data: {},
        success: function(data) {
            // var rawdata = JSON.parse(data);
            results = [];
            var rawdata = data;

            var searchdata = rawdata.Search;

            for (var i = searchdata.length - 1; i >= 0; i--) {
                results.push(searchdata[i].Title);
            }

            //SEND REQUEST TO PREPPED URL GET THE DATA DECODE AS JSON GET THE MOVIE TITLES SAVE TO RESULTS ARRAY

            document.getElementById("titles").innerHTML = "";

            for (var i = results.length - 1; i >= 0; i--) {
                var ul = document.getElementById("titles");
                var li = document.createElement("li");

                var a = document.createElement("a");
                a.appendChild(document.createTextNode(results[i]));
                a.setAttribute("onclick", "SelectResult('" + results[i] + "')")

                //document.createTextNode(results[i])
                li.appendChild(a);

                ul.appendChild(li);
            }
        }
    });  
});

function SelectResult(thename) {
    // document.getElementById("movieName").setAttribute('value', thename);
    $("#movieName").val(thename);
    document.getElementById("movieAddForm").submit();
}