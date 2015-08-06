
	function check_in_home_permission()
	{

		if(name_user_db=='')
		{
				
				cook_name = getCookie(cook_name);
				cook_pass = getCookie(cook_pass);
				//alert(cook_name+" "+cook_pass);
				 $.ajax({
							url: "cookie_js.php",
							dataType : 'text', 
							type : 'post',
							data : { input_cook_name : cook_name,input_cook_pass : cook_pass},
								success: function(data){
									
									if(data=="0")
									{
										
									}
									else
									{
										block = '0';
										//alert(block);
										id_user_db = cook_name;
										var data_cook = data.split(",");
										xeem_user_db = data_cook[0];
										name_user_db = data_cook[1];
										score = data_cook[2];
									}
									in_home_permission();
									
								}
						});
		}
		else
		{
			in_home_permission();
		}
		
	}
	
	
	
	
	function in_home_permission()
	{

			 name_user = name_user_db;
			 xeem_user = xeem_user_db;
			 nickname = score_thai(parseInt(score));
			//alert(name_user);
			 id_user = id_user_db;
			 messages_send = '';
			 messages_color = '#003300';
			 messages_color_bg = '#BCF5A9';
			 img_user = 'img_user/'+id_user_db+'.jpg';
			 messages_time = '';
			 color_messages = 0;
			 color_messages_bg = 0;
			 myid = 0;
			 list_my_freinds;
			 load_subject_f();
			load_subject_all();
			load_subject_like();
			load_subject_read();
			 
			 
			document.getElementById("image_profile_chat_img").src = img_user;
			document.getElementById("profile_chat_name").innerHTML = name_user;
			document.getElementById("profile_chat_name").title = name_user;

			document.getElementById("profile_chat_xeem").innerHTML = "Xeem "+xeem_user;
			
			if(block=='0'){
				socket.on('receive_freinds_first', function(data){
					 rff_rows = data.value;
					list_my_freinds = new Array();
					 rff_rows_length = rff_rows.length;
					if(rff_rows_length==0)
					{
						return;
					}	
					for(i_rff_rows=rff_rows_length-1;i_rff_rows>=0;i_rff_rows--)
					{
						
						c_rff_rows = rff_rows[i_rff_rows];
						list_my_freinds.push(c_rff_rows.id_user_f);
						add_list_freind(c_rff_rows.name_show,c_rff_rows.id_user_f);
					}
					//alert(list_my_freinds);
					socket.emit('freinds_on',{ input_list_my_freinds:list_my_freinds});
					//messagesWrite(data.name,data.messages,data.img,data.color,data.color_bg,data.time);
				});
				
				socket.on('freinds_on', function(data){
					fo_rows = data.value;
					document.getElementById("number_on_alls").innerHTML = data.number_on_alls +" คน";
					var fo_rows_length = fo_rows.length;
					if(fo_rows_length==0)
					{
						return;
					}
					var elements_id;
					elements = document.getElementsByClassName("friends_chat_name_in_on");
					//alert(list_my_freinds);
					for(var i=0; i<elements.length; i++) 
					{
						elements_id = elements[i].id.split('_')[1];
						if(fo_rows[elements_id]=="on")
						{
							elements[i].style.color = '#00ff00';
							elements[i].title = "on-line";
						}
						else
						{
							elements[i].style.color = '#ff0000';
							elements[i].title = "off-line";
						}
					}
					/*for(i_fo_rows=0;i_fo_rows<fo_rows_length;i_fo_rows++)
					{
						//alert(i_fo_rows);
						c_fo_rows = fo_rows[i_fo_rows];
						//add_list_freind(c_fo_rows.name_show,c_fo_rows.id_user_f);
					}*/
					//messagesWrite(data.name,data.messages,data.img,data.color,data.color_bg,data.time);
				});
				setInterval(
					function(){
					socket.emit('freinds_on',{ input_list_my_freinds:list_my_freinds});
					socket.emit('my_stop_time_out');
				},20000);
				//my_f_time_out();
				//show_box_color_bg_messages();
				
				socket.emit('my_freinds',{ id_user_input:id_user});
				socket.emit('my_start_time_out');
				document.getElementById("profile_chat").style.display = "block";
				/*document.getElementById("send_messages_chat").style.display = "block";
				document.getElementById("emoimg_messages_chat").style.display = "block";
				document.getElementById("friends_chat").style.display = "block";*/
				
				
			}
		}
	