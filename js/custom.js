$(document).ready(function(){
	$("#searchPlace").click(function(){
		$("#search-place").addClass("show").removeClass("hide");
		$("#direction-service").addClass("hide").removeClass("show");
      	$("#map").removeClass('minimize-map');
      	$("#right-panel").removeClass('show').addClass('hide');
      	$("#search-nearby").addClass("hide").removeClass("show");
        $(this).addClass('btn-custom');
        $("#directionService").removeClass('btn-custom');
        $("#searchNearby").removeClass('btn-custom');
        $("#dashboard").removeClass("marginer");
	});
	$("#directionService").click(function(){
		$("#direction-service").addClass("show").removeClass("hide");
		$("#search-place").addClass("hide").removeClass("show");
		$("#search-nearby").addClass("hide").removeClass("show");
        $(this).addClass('btn-custom');
        $("#searchNearby").removeClass('btn-custom');
        $("#searchPlace").removeClass('btn-custom');
	});
	$("#searchNearby").click(function(){
		$("#direction-service").addClass("hide").removeClass("show");
		$("#search-place").addClass("hide").removeClass("show");
		$("#search-nearby").addClass("show").removeClass("hide");
        $(this).addClass('btn-custom');
        $("#directionService").removeClass('btn-custom');
        $("#searchPlace").removeClass('btn-custom');
	});
	$("#inputRadius").on('input', function(){
		if($(this).val() > 50000){
			$(this).val(50000);
		}
	});
	$("#fblogin").click(function(){
		if($("#isFBLoggedIn").val() == ""){
			FB.login(function(response){
            	$("#isFBLoggedIn").val("logged");
            	$("#btn2 .buttonText").html("LOGOUT");
            	$("#buttonText2").html("ME");
            	FB.api('/me', function(response) {
            		alert("Welcome "+response.name+"! Thank you for logging in. Enjoy ecoTransit!");
            			$.get('core/init.php', {
            				id: response.id,
            				callTo: "login"
            			}, function(data){
            				
            			});
            	});

        	});

		}
		else{
			
			FB.logout(function(response) {
  		    	$("#isFBLoggedIn").val("");
  		    	$.get('core/init.php', {
            		id: response.id,
            		callTo: "logout"
            	}, function(data){
            		
            	});
  			});
		}
	});	

	$('#date_created').on('change', function() {
			
		var optionId = $(this).val();
	  	$.getJSON("core/Controller.php", {
	  		optionId: optionId,
	  		callTo: "compare"
	  	}, function(result){
	  		var data = [[],[]];
			$.each(result, function(i, field) {
				data[[i],[i]].push(field[0].smallcar);
				data[[i],[i]].push(field[0].mediumcar);
				data[[i],[i]].push(field[0].largecar);
				data[[i],[i]].push(field[0].electricity);
				data[[i],[i]].push(field[0].gas);
				data[[i],[i]].push(field[0].air);
				data[[i],[i]].push(field[0].train);
			});
			dataToGraph[1] = data[1];
			ShowGraph();
	  	});
	});
});