$(document).ready(function(){	

		// html for task buttons
	    var box = "<span class=\"glyphicon glyphicon-unchecked \" data-toggle=\"tooltip\" title=\"mark as done\"  onmouseover=\"\" style=\"cursor: pointer;\"></span>";
	    var checkedbox = "<span  class=\"glyphicon glyphicon-check \" data-toggle=\"tooltip\" title=\"mark as done\"  onmouseover=\"\" style=\"cursor: pointer;\"></span>";
	    var edit ="<span  class=\"glyphicon glyphicon-pencil spmodal \" data-toggle=\"modal\" data-target=\"#editModal\"  onmouseover=\"\" style=\"cursor: pointer;\"></span>";
	    var del ="<span  class=\"glyphicon glyphicon-remove \" data-toggle=\"tooltip\" title=\"delete task\"  onmouseover=\"\" style=\"cursor: pointer;\"></span>";


		// arrays to help format date
		var months = ["January","Febuary","March","April","May","June","July","August","September","October","November","December"];
		var days = [null, "1st", "2nd", "3rd", "4th", "5th", "6th", "7th", "8th", "9th", "10th", "11th", "12th", "13th", "14th", "15th", "16th",
		"17th", "18th", "19th", "20th","21st", "22nd", "23rd", "24th", "25th", "26th", "27th", "28th", "29th", "30th", "31st"];

		//  start page with current date selected
		var date = new Date();
		$( "#datepicker" ).datepicker("setDate", date);
		updatePanelHeadings(date.getDate(), $.datepicker.iso8601Week(date), date.getMonth(), date.getFullYear());
		updateListNames(date.getDate(), $.datepicker.iso8601Week(date), date.getMonth(), date.getFullYear());
		updatePanelContent(date.getDate(), $.datepicker.iso8601Week(date), date.getMonth(), date.getFullYear());

		// enable tooltips
		$('[data-toggle="tooltip"]').tooltip(); 

		// create datepicker widget
		$( function () {
			$( "#datepicker" ).datepicker(

			{
	            // dropdown menus for month and year
	            changeMonth: true,
	            changeYear: true,

	            // when user selects a date
	            onSelect: function(selected,evnt) {

	            	// set variables from datepicker date selected
	            	var date = $(this).datepicker('getDate');
	            	var day  = date.getDate();  
	            	var month = date.getMonth();             
	            	var year =  date.getFullYear();
	            	var week = $.datepicker.iso8601Week(date);

	            	// set panel headings
	            	updatePanelHeadings(day, week, month, year);

	            	// set list names for form entry
	            	updateListNames(day, week, month, year);

	            	// fill content panels with users tasks from given date
	            	updatePanelContent(day, week, month, year);
	            }
	        });
		});

	   // function to set list names for form entry
	   function updateListNames(day, week, month, year){
	   	$('#quarter_list').val(getQuarter(month) + " Quarter"+', ' + year); 
	   	$('#week_list').val('Week ' + week);      
	   	$('#day_list').val(days[day] + ' of ' + months[month] + ' ' + year);    
	   }

	   	// function to fill panel headings
	   	function updatePanelHeadings(day, week, month, year){
	   		$('#quarter-heading').text(getQuarter(month) + " Quarter"+', ' + year); 
	   		$('#week-heading').text('Week ' + week);      
	   		$('#day-heading').text(days[day] + ' of ' + months[month] + ' ' + year);    
	   	}

	    // function that queries database and fills content panels
	    function updatePanelContent(day, week, month, year){

	    	

	    	// empty task lists
	    	$('#quarter-content').empty();
	    	$('#week-content').empty();
	    	$('#day-content').empty();

	    	// AJAX to populate quarter panel
	    	$.ajax({
	    		type: 'GET',
	    		url: "scripts/php/gettasks.php",
	    		data: 'list_name='+getQuarter(month) + " Quarter"+', ' + year,
	    		cache: false,
	    		success: function(result) {
	    			var taskArray = JSON.parse(result);
	    			var i;
	    			for (i = 0; i < taskArray.length; i++) {


	    				if(taskArray[i]['task_done'] == 1){
	    					var task = $("<div class = \"task quarter-task\" style=\"background-color: #4CAF50;\"></div>").html(taskArray[i]['task_text'] + edit  + checkedbox +  del  );
	    					$('#quarter-content').append(task);
	    				}
	    				else{
	    					var task = $("<div class = \"task quarter-task\"></div>").html(taskArray[i]['task_text']  + edit + box +  del);
	    					$('#quarter-content').append(task);
	    				}

	    			}
	    			

	    		},
	    	});

	    	// AJAX to populate week panel
	    	$.ajax({
	    		type: 'GET',
	    		url: "scripts/php/gettasks.php",
	    		data: 'list_name='+'Week ' + week,
	    		cache: false,
	    		success: function(result) {
	    			var taskArray = JSON.parse(result);
	    			var i;
	    			for (i = 0; i < taskArray.length; i++) {

	    				if(taskArray[i]['task_done'] == 1){
	    					var task = $("<div class = \"task week-task\" style=\"background-color: #4CAF50;\"></div>").html(taskArray[i]['task_text'] + edit  + checkedbox +  del );
	    					$('#week-content').append(task);
	    				}
	    				else{
	    					var task = $("<div class = \"task week-task\"></div>").html(taskArray[i]['task_text'] + edit  + box +  del);
	    					$('#week-content').append(task);
	    				}
	    			}
	    			

	    		},
	    	});

	  		// AJAX to populate day panel
	  		$.ajax({
	  			type: 'GET',
	  			url: "scripts/php/gettasks.php",
	  			data: 'list_name='+days[day] + ' of ' + months[month] + ' ' + year,
	  			cache: false,
	  			success: function(result) {
	  				var taskArray = JSON.parse(result);
	  				var i;
	  				for (i = 0; i < taskArray.length; i++) {

	  					if(taskArray[i]['task_done'] == 1){
	  						var task = $("<div class = \"task day-task\" style=\"background-color: #4CAF50;\"></div>").html(taskArray[i]['task_text'] + edit  + checkedbox +  del );
	  						$('#day-content').append(task);
	  					}
	  					else{
	  						var task = $("<div class = \"task day-task\"></div>").html(taskArray[i]['task_text'] + edit  + box + del);
	  						$('#day-content').append(task);
	  					}

	  				}
	  			},
	  		});
	  		
	  	}

	  	// function to delete tasks
	  	function deleteTask(task_text, list_name){
	  		$.ajax({
	  			type: 'GET',
	  			url: "scripts/php/deletetask.php",
	  			data: {'list_name': list_name, 'task_text': task_text},
	  			cache: false,
	  			success: function() {

					// set variables from datepicker date selected
					var date = $("#datepicker").datepicker('getDate');
					var day  = date.getDate();  
					var month = date.getMonth();             
					var year =  date.getFullYear();
					var week = $.datepicker.iso8601Week(date);

					// update panel content again
					updatePanelContent(day, week, month, year);
				},
			});
	  	}

	  	// function to mark a task as complete
	  	function markAsComplete(task_text, list_name){
	  		$.ajax({
	  			type: 'GET',
	  			url: "scripts/php/markascomplete.php",
	  			data: {'list_name': list_name, 'task_text': task_text},
	  			cache: false,
	  			success: function() {

					// set variables from datepicker date selected
					var date = $("#datepicker").datepicker('getDate');
					var day  = date.getDate();  
					var month = date.getMonth();             
					var year =  date.getFullYear();
					var week = $.datepicker.iso8601Week(date);

					// update panel content again
					updatePanelContent(day, week, month, year);
				},
			});
	  	}
	  	
	    // function to get quarter from given month
	    function getQuarter(month)
	    {
	    	if(month == 0 || month < 3 )
	    	{
	    		return '1st';
	    	}
	    	if(month > 2 && month < 6 )
	    	{
	    		return '2nd';
	    	}
	    	if(month > 5 && month < 9 )
	    	{
	    		return '3rd';
	    	}
	    	if(month > 8 && month < 12 )
	    	{
	    		return '4th';
	    	}
	    }

		// event listener for remove button
		$(document).on( 'click', '.glyphicon-remove', function(){

			// get the task text and panel heading
			var task = $(this).parent().text();
			var list = $(this).parents('.panel').children(".panel-heading").text();

			deleteTask(task , list);
		} );

		// event listener for mark as complete button
		$(document).on( 'click', '.glyphicon-unchecked', function(){

			// get the task text and panel heading
			var task = $(this).parent().text();
			var list = $(this).parents('.panel').children(".panel-heading").text();

			markAsComplete(task , list);
		} );

		// event listener for mark as complete button
		$(document).on( 'click', '.glyphicon-check', function(){

			// get the task text and panel heading
			var task = $(this).parent().text();
			var list = $(this).parents('.panel').children(".panel-heading").text();

			markAsComplete(task , list);
		} );

		// event listener for edit task button
		$(document).on( 'click', '.glyphicon-pencil', function(){

			// get the task text and panel heading
			var task = $(this).parent().text();
			var list = $(this).parents('.panel').children(".panel-heading").text();

			$('#edittext').val(task);
			$('#task_text').val(task);
			$('#editlist').val(list);


		} );

	}); 

