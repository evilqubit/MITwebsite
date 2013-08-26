 $(document).ready(function(){ 

		var container = $('div.errorContainer');

		
		jQuery.validator.addClassRules('grade', { 
			  required:true,  
		      digits: true,
		      range : [1, 4], 
	    }); 

		$( "input" ).click(function() { 
			$(this).removeClass("error");
			});

		// validate the form when it is submitted
		var validator = $("#form").validate({
		
			errorContainer: container,
			errorLabelContainer: container, 
/* question[340][int]
		parent td	error * 
 */
			showErrors: function(errorMap, errorList) {
				console.log(errorMap);
				console.log(errorList);
			/*
		    container.html($.map(errorList, function (el) {
		        return el.message;
		    }).join(", "));
		    */
		 	var msg = 'Errors: ';
            $.each(errorMap,  function(name, value){
            	console.log(name);
            	console.log($( "input[value='"+ name +"']" ));
            	$( "input[name='"+ name +"']" ).addClass("error"); 
            	$( "input[name='"+ name +"']" ).focus();
               }
		   

            );

			if ( (Object.keys(errorList).length === 0))
			{
				container.hide();
			}
			else
			{
				container.show();
			}
		},
		
			
		});
 });