var edit_and_ok = 0;
var id_f_buff = 0;
var name_f_buff = '';
var my_freided = 0;

function back_profile()
{
	document.getElementById("btn_profile_chat").style.display = "block";
	document.getElementById("btn_profile_add").style.display = "none";
	change_profile();
}

function change_profile()
{

	document.getElementById("image_profile_chat_img").src = img_user;
	document.getElementById("profile_chat_name").innerHTML = name_user;
	document.getElementById("profile_chat_name").title = name_user;
	document.getElementById("profile_chat_xeem").innerHTML = "Xeem "+ xeem_user;
	
}

function friend_profile(id_f)
{
	//alert(id_f);
	if(id_f!=id_user)
	{
		$.ajax({
			url: "db/get_data_freinds.php",
			dataType : 'text', 
			type : 'post',
			data : 	
			{ 	
				input_freinds: id_f,
				input_user: id_user
			},
			success: function(data){
				//var returnedData = JSON.parse(data);
				//alert(data);
				my_freided_buff = data.split('_')[0];
				xeem_f = data.split('_')[1];
				name_f = data.substr(my_freided_buff.length+1+xeem_f.length+1);
				my_freided = parseInt(my_freided_buff);
				if(xeem_f!='')
				{
					id_f_buff = id_f;
					//my_freided = id_f;
					document.getElementById("btn_profile_chat").style.display = "none";
					document.getElementById("btn_profile_add").style.display = "block";
					document.getElementById("image_profile_chat_img").src = "img_user/"+id_f+".jpg";
					document.getElementById("profile_chat_name").innerHTML = name_f;
					document.getElementById("profile_chat_name").title = name_f;
					document.getElementById("profile_chat_xeem").innerHTML = "Xeem "+ xeem_f;
					name_f_buff = name_f;
					if(my_freided==0)
					{
						document.getElementById("btn_profile_add").innerHTML = "ลบเพื่อน";
					}
					else
					{
						document.getElementById("btn_profile_add").innerHTML = "เพิ่มเพื่อน";
					}
					//window.location.href = "home";
				}						//alert(my_freided);
			}
		});
		
	}
	else
	{
		back_profile();
	}
	
}

function friend_profile2(id_f)
{
	//alert(id_f);
	id_f = parseInt(id_f.substr(4));
	if(id_f!=id_user)
	{
		$.ajax({
			url: "db/get_data_freinds.php",
			dataType : 'text', 
			type : 'post',
			data : 	
			{ 	
				input_freinds: id_f,
				input_user: id_user
			},
			success: function(data){
				//var returnedData = JSON.parse(data);
				//alert(data);
				my_freided_buff = data.split('_')[0];
				xeem_f = data.split('_')[1];
				name_f = data.substr(my_freided_buff.length+1+xeem_f.length+1);
				
				my_freided = parseInt(my_freided_buff);
				if(xeem_f!='')
				{
					id_f_buff = id_f;
					//my_freided = id_f;
					document.getElementById("btn_profile_chat").style.display = "none";
					document.getElementById("btn_profile_add").style.display = "block";
					document.getElementById("image_profile_chat_img").src = "img_user/"+id_f+".jpg";
					document.getElementById("profile_chat_name").innerHTML = name_f;
					document.getElementById("profile_chat_name").title = name_f;
					document.getElementById("profile_chat_xeem").innerHTML = "Xeem "+ xeem_f;
					name_f_buff = name_f;
					if(my_freided==0)
					{
						document.getElementById("btn_profile_add").innerHTML = "ลบเพื่อน";
					}
					else
					{
						document.getElementById("btn_profile_add").innerHTML = "เพิ่มเพื่อน";
					}
					//window.location.href = "home";
				}						//alert(my_freided);
			}
		});
		
	}
	else
	{
		back_profile();
	}
	
}

function add_list_freind(name_alf,id_alf)
{
	document.getElementById("friends_chat").innerHTML += '<div class ="friends_chat_name"  id="alf_'+id_alf+'" onmouseup="friend_profile2(this.id)">'+
				'<img class="friends_chat_name_img" alt=""  src="img_user/'+id_alf+'.jpg" height="20" width="20"/>'+
				'<span class="friends_chat_name_in">'+name_alf+'</span><span class="friends_chat_name_in_on" id="onoff_'+id_alf+'" title="off-line">●</span></div>';
}

function add_freind_profile()
{
	
	if(my_freided==0)//a0 = เป็นเพื่อน 1= ไม่เป็น
	{
		//alert(id_f_buff);
		$.ajax({
			url: "db/del_my_freinds.php",
			dataType : 'text', 
			type : 'post',
			data : 	
			{ 	
				input_user: id_user,
				input_freinds: id_f_buff
			},
			success: function(data){
				//alert(data);
				location.reload();
			}						//alert(data);
		});

	}
	else
	{
	//alert(id_user+" "+id_f_buff);
	$.ajax({
			url: "db/add_my_freinds.php",
			dataType : 'text', 
			type : 'post',
			data : 	
			{ 	
				input_user: id_user,
				input_freinds: id_f_buff
			},
			success: function(data){

				/*var data = data.substring(1);
				if(data=="yes"||data=="es")
				{
					
				}*/
				
				add_list_freind(name_f_buff,id_f_buff);
				list_my_freinds.push(id_f_buff);
				socket.emit('freinds_on',{ input_list_my_freinds:list_my_freinds});
				my_freided = 0;
				document.getElementById("btn_profile_add").innerHTML = "เพื่อน";
			}						//alert(data);
		});
	}
}

function edit_and_ok_profile()
{
	if(edit_and_ok==0)
	{
		edit_and_ok = 1;
		document.getElementById("image_profile_chat_upload").style.display = "block";
		document.getElementById("image_profile_chat_upload_input").style.display = "block";
		document.getElementById("profile_chat_name").style.display = "none";
		document.getElementById("profile_chat_name_for_edit").style.display = "block";
		document.getElementById("profile_chat_name_for_edit").focus();
		document.getElementById("profile_chat_name_for_edit").value = document.getElementById("profile_chat_name").innerHTML;
		document.getElementById("btn_profile_chat").innerHTML = "ตกลง";
	}
	else if(edit_and_ok==1)
	{
		var name_value_new = document.getElementById("profile_chat_name_for_edit").value;
		name_value_new = escapeHtml(name_value_new);
		name_value_new = urlToTag(name_value_new);
		$.ajax({
			url: "db/profile.php",
			dataType : 'text', 
			type : 'post',
			data : 	
			{ 	
				input_name: name_value_new,
				input_id: id_user
			},
			success: function(data){
				edit_and_ok = 0;
				document.getElementById("profile_chat_name").style.display = "block";
				document.getElementById("profile_chat_name").innerHTML = data;
				document.getElementById("profile_chat_name_for_edit").style.display = "none";
				document.getElementById("image_profile_chat_upload").style.display = "none";
				document.getElementById("image_profile_chat_upload_input").style.display = "none";
				document.getElementById("btn_profile_chat").innerHTML = "แก้ไข";
			}
		});
		
	}
}

function get_img_edit()
{
	var file = document.getElementById('image_profile_chat_upload_input').files[0];
	var formData = new FormData();
	formData.append("image", file);
	var imageType = /image.*/;
	$.ajax({
		url: "img_user/edit_image.php?id="+id_user,
		dataType : 'text', 
		type: "POST",
		data: formData,
		success: function (msg) 
		{
			//alert();
			var setImg = 'data:image/png;base64,'+msg;
			document.getElementById('image_profile_chat_img').src = setImg;
		},
		contentType: false,
		processData: false
	});
}

//document.getElementById("myAnchor").focus();