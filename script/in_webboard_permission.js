	
	$(document).ready(function(){
				$("#se_chat").hover(function(){
					$("#se_chat").css("color", "#009900");
					},function(){
					$("#se_chat").css("color", se_chat);
				});
				$("#se_subject").hover(function(){
					$("#se_subject").css("color", "#009900");
					},function(){
					$("#se_subject").css("color", se_subject);
				});
			});
	
	function check_in_webboard_permission2()
	{

		if(username=='')
		{
				
				cook_name = getCookie(cook_name);
				cook_pass = getCookie(cook_pass);
				//alert(cook_name+" "+cook_pass);
				 $.ajax({
							url: "http://www.nkaujhmono.com/cookie_js.php",
							dataType : 'text', 
							type : 'post',
							data : { input_cook_name : cook_name,input_cook_pass : cook_pass},
								success: function(data){
									//alert(cook_name +" "+data);
									if(data=="0")
									{
										//location.replace("http://nkaujhmono.com");
									}
									else
									{
										username = cook_name;
										
										var data_cook = data.split(",");
										xeem_show = data_cook[0];
										name_show = data_cook[1];
										xeem_score = data_cook[2];
										id_user = username;
									}
									
								}
						});
		}
		else 
		{
			id_user = username;
			
		}
	}
	
	function check_in_webboard_permission()
	{
		
		if(username=='')
		{
				//alert(cook_name+" "+cook_pass);
				cook_name = getCookie(cook_name);
				cook_pass = getCookie(cook_pass);
				//alert(cook_name+" "+cook_pass);
				
				 $.ajax({
							url: "http://www.nkaujhmono.com/cookie_js.php",
							dataType : 'text', 
							type : 'post',
							data : { input_cook_name : cook_name,input_cook_pass : cook_pass},
								success: function(data){
									//alert(data +" "+cook_pass);
									if(data=="0")
									{
										location.replace("http://www.nkaujhmono.com");
									}
									else
									{
										id_user = cook_name;
										password = cook_pass;
									}
									
								}
						});
		}
		else 
		{
			id_user = username;
		}
		
		
	}