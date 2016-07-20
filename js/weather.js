$(function(){
var monthNames = ["January", "February", "March", "April", "May", "June",
  "July", "August", "September", "October", "November", "December"
];
function addDaysFromNow(add){
	return new Date(Date.now() + add * 24*3600*1000).getDate();
}

var currentTemp;
Weather.getCurrent("Quezon City", function(current) {
  currentTemp = current.temperature();
  $("#temp").html(Weather.kelvinToFahrenheit(currentTemp).toFixed(2)+"&deg;F<br />"+Weather.kelvinToCelsius(currentTemp).toFixed(2)+"&deg;C");
  $("#currentCondition").html(current.conditions());
});
});