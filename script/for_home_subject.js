function c_subject()
{
	document.getElementById("sub_select_chat").style.display = "none";
	document.getElementById("se_chat").style.color = "#ffffff";
	document.getElementById("se_subject").style.color = "#78c0b6";
	document.getElementById("se_entertainment").style.color = "#ffffff";
	document.getElementById("se_event").style.color = "#ffffff";
	document.getElementById("se_report").style.color = "#ffffff";
	se_chat= "#ffffff";
			 se_subject= "#78c0b6";
			 se_entertainment= "#ffffff";
			 se_event= "#ffffff";
			 se_report= "#ffffff";
	
	document.getElementById("sub_select_event_fm").style.display = "none";	
	document.getElementById("sub_select_subject").style.display = "block";	
}

function create_subject()
{
	if(id_user!="")
	{
		window.open("http://www.nkaujhmono.com/write_webboard?v=0&t=ww");
	}
	else
	{
		create_subject_none();
	}
}

function create_subject_none()
{
		
		$.fancybox.open({
			href : 'http://www.nkaujhmono.com/index_popup.php',
			type : 'iframe',
			width : 1300,
			height : 500,					
			padding : 5,
			autoSize:false,
			afterClose:function() 
			{ 
				location.reload();
			}
		});	
}

function load_subject_f()
{
	
	document.getElementById("sub_select_subject").innerHTML = ""
				+"<div class ='sss_hot'>"
					+"<div class ='sss_hot_head'>กระทู้ไลค์ประจำสัปดาห์"
						
					+"</div>"
					+"<div class ='sss_hot_w_head' id ='sss_hot'>"
					/*	+"<div class ='sss_hot_w'>"
						
						+"</div>"
						+"<div class ='sss_hot_w'>"
							
						+"</div>"
						+"<div class ='sss_hot_w'>"
							
						+"</div>"
						+"<div class ='sss_hot_w'>"
							
						+"</div>"*/
					+"</div>"
				+"</div>"
				+"<div class ='sss_create' id ='sss_create'>"
					+"<div class ='sss_create_go' onmouseup='create_subject()'><img class='c_web' alt='' src='images/create_w_h.png' height='45' width='180' />"
						
					+"</div>"
					+"<div class ='sss_create_score'>คะแนน: " + score
						
					+"</div>"
					+"<div class ='sss_create_nickname'>ฉายา: " + nickname
						
					+"</div>"
				+"</div>"
				+"<div class ='sss_read' >"
					+"<div class ='sss_hot_head'>กระทู้อ่านประจำสัปดาห์"
						
					+"</div>"
					+"<div class ='sss_hot_w_head' id ='sss_read'>"
						/*+"<div class ='sss_hot_w'>"
						
						+"</div>"
						+"<div class ='sss_hot_w'>"
							
						+"</div>"
						+"<div class ='sss_hot_w'>"
							
						+"</div>"
						+"<div class ='sss_hot_w'>"
							
						+"</div>"*/
					+"</div>"
					
				+"</div>"
			//	+"<div class ='sss_select' id ='sss_select'>"
				
			//	+"</div>"
				+"<div class ='sss_all' id ='sss_all'>"
					+"<div class ='sss_s'>"
						+"<input class ='txt_search' id ='txt_search' type='text' placeholder='ค้นหา' value='' >"
						+"<img class='image_search' id='image_search' alt='' src='images/search.png' height='23' width='23' onmouseup='load_subject_search()'/>"
					+"</div>"
					+"<div class ='sss_all_h' onmouseup='load_subject_all()'>กระทู้ใหม่ทั้งหมด"
					
					+"</div>"
					+"<div class ='sss_all_w' id ='sss_all_w'>"
					
					+"</div>"
				+"</div>";
	
}

function load_subject_search()
{
	if(document.getElementById("txt_search").value=="")
	{
		return;
	}
	$.ajax({
			type: "POST",
				url: "http://www.nkaujhmono.com/db/webboad_search.php",
				dataType: "text", 
				data: {input_search: document.getElementById("txt_search").value},
				 // Set the data type so jQuery can parse it for you
				success: function (data) {
					
					var get_sr = jQuery.parseJSON(data);
					
					var lsa_count;
					var txt_all_w;
					var title_all_w;
					document.getElementById("sss_all_w").innerHTML ="";
					for(lsa_count=0;lsa_count<get_sr.length;lsa_count++)
					{
						
						lsa_count_get_sr = get_sr[lsa_count];
						
						txt_all_w = replace_post_txt_r(lsa_count_get_sr.details);
						
						if(txt_all_w.length>200)
						{
							txt_all_w = txt_all_w.substring(0,200);
						}
						//alert();
						title_all_w = lsa_count_get_sr.title;
						if(title_all_w.length>100)
						{
							title_all_w = title_all_w.substring(0,100);
						}
						
						document.getElementById("sss_all_w").innerHTML +=""
						+"<div class ='sub_sss_all'>"
						+"<a class ='sss_all_t' href='http://www.nkaujhmono.com/webboard/w_"+lsa_count_get_sr.id_w+"' target='_blank'>"+title_all_w
						+"</a></br>"
						+"<a class ='sss_all_d' href='http://www.nkaujhmono.com/webboard/w_"+lsa_count_get_sr.id_w+"' target='_blank'>"+txt_all_w
						+"</a>"
						+"<div class ='sss_all_id'>ผู้ตั้งกระทู้: "+lsa_count_get_sr.name_user_w+"("+lsa_count_get_sr.xeem_user_w
						+") id:#"+lsa_count_get_sr.id_nhn+" เขียนเมื่อ: "+lsa_count_get_sr.time_w+" ถูกใจ: "+lsa_count_get_sr.score_like_w+" ตอบ: "+lsa_count_get_sr.count_reply+" เปิดอ่าน: "+lsa_count_get_sr.viewed_w+"</div>"
						+"</div>";
					}
					document.getElementById("sss_all_w").innerHTML +=""
						+"<div class ='sub_sss_all_f'>"

						+"</div>";
				},
				error: function()
				{
					alert("An error occoured!");
				}
		});
}

function load_subject_all()
{
	
	$.ajax({
			type: "POST",
				url: "http://www.nkaujhmono.com/db/webboad_all.php",
				dataType: "text", 
				data: {input_id: ''},
				 // Set the data type so jQuery can parse it for you
				success: function (data) {
					
					var get_sr = jQuery.parseJSON(data);
					
					var lsa_count;
					var txt_all_w;
					var title_all_w;
					document.getElementById("sss_all_w").innerHTML ="";
					for(lsa_count=0;lsa_count<get_sr.length;lsa_count++)
					{
						
						lsa_count_get_sr = get_sr[lsa_count];
						
						txt_all_w = replace_post_txt_r(lsa_count_get_sr.details);
						
						if(txt_all_w.length>200)
						{
							txt_all_w = txt_all_w.substring(0,200);
						}
						//alert();
						title_all_w = lsa_count_get_sr.title;
						if(title_all_w.length>100)
						{
							title_all_w = title_all_w.substring(0,100);
						}
						
						document.getElementById("sss_all_w").innerHTML +=""
						+"<div class ='sub_sss_all'>"
						+"<a class ='sss_all_t' href='http://www.nkaujhmono.com/webboard/w_"+lsa_count_get_sr.id_w+"' target='_blank'>"+title_all_w
						+"</a></br>"
						+"<a class ='sss_all_d' href='http://www.nkaujhmono.com/webboard/w_"+lsa_count_get_sr.id_w+"' target='_blank'>"+txt_all_w
						+"</a>"
						+"<div class ='sss_all_id'>ผู้ตั้งกระทู้: "+lsa_count_get_sr.name_user_w+"("+lsa_count_get_sr.xeem_user_w
						+") id:#"+lsa_count_get_sr.id_nhn+" เขียนเมื่อ: "+lsa_count_get_sr.time_w+" ถูกใจ: "+lsa_count_get_sr.score_like_w+" ตอบ: "+lsa_count_get_sr.count_reply+" เปิดอ่าน: "+lsa_count_get_sr.viewed_w+"</div>"
						+"</div>";
					}
					document.getElementById("sss_all_w").innerHTML +=""
						+"<div class ='sub_sss_all_f'>"

						+"</div>";
				},
				error: function()
				{
					alert("An error occoured!");
				}
		});
}

function load_subject_like()
{
	
	$.ajax({
			type: "POST",
				url: "http://www.nkaujhmono.com/db/webboad_all_like.php",
				dataType: "text", 
				data: {input_id: ''},
				 // Set the data type so jQuery can parse it for you
				success: function (data) {
					
					var get_sr = jQuery.parseJSON(data);
					
					var lsa_count;
					var txt_all_w;
					var title_all_w;
					for(lsa_count=0;lsa_count<get_sr.length;lsa_count++)
					{
						
						lsa_count_get_sr = get_sr[lsa_count];
						
						txt_all_w = replace_post_txt_r(lsa_count_get_sr.details);
						
						if(txt_all_w.length>150)
						{
							txt_all_w = txt_all_w.substring(0,150);
						}
						//alert();
						title_all_w = lsa_count_get_sr.title;
						if(title_all_w.length>100)
						{
							title_all_w = title_all_w.substring(0,100);
						}
						
						document.getElementById("sss_hot").innerHTML +=""
						+"<div class ='sss_hot_w'>"
						+"<a class ='sss_t' href='http://www.nkaujhmono.com/webboard/w_"+lsa_count_get_sr.id_w+"' target='_blank'>"+title_all_w
						+"</a></br>"
						+"<a class ='sss_d' href='http://www.nkaujhmono.com/webboard/w_"+lsa_count_get_sr.id_w+"' target='_blank'>"+txt_all_w
						+"</a>"
						+"<div class ='sss_id'>ผู้ตั้งกระทู้: "+lsa_count_get_sr.name_user_w+"("+lsa_count_get_sr.xeem_user_w
						+") id:#"+lsa_count_get_sr.id_nhn+" เขียนเมื่อ: "+lsa_count_get_sr.time_w+" ถูกใจ: "+lsa_count_get_sr.score_like_w+" ตอบ: "+lsa_count_get_sr.count_reply+" เปิดอ่าน: "+lsa_count_get_sr.viewed_w+"</div>"
						+"</div>"
					}
				},
				error: function()
				{
					alert("An error occoured!");
				}
		});
}

function load_subject_read()
{
	
	$.ajax({
			type: "POST",
				url: "http://www.nkaujhmono.com/db/webboad_all_read.php",
				dataType: "text", 
				data: {input_id: ''},
				 // Set the data type so jQuery can parse it for you
				success: function (data) {
					
					var get_sr = jQuery.parseJSON(data);
					
					var lsa_count;
					var txt_all_w;
					var title_all_w;
					for(lsa_count=0;lsa_count<get_sr.length;lsa_count++)
					{
						
						lsa_count_get_sr = get_sr[lsa_count];
						
						txt_all_w = replace_post_txt_r(lsa_count_get_sr.details);
						
						if(txt_all_w.length>150)
						{
							txt_all_w = txt_all_w.substring(0,150);
						}
						//alert();
						title_all_w = lsa_count_get_sr.title;
						if(title_all_w.length>100)
						{
							title_all_w = title_all_w.substring(0,100);
						}
						
						document.getElementById("sss_read").innerHTML +=""
						+"<div class ='sss_hot_w'>"
						+"<a class ='sss_t' href='http://www.nkaujhmono.com/webboard/w_"+lsa_count_get_sr.id_w+"' target='_blank'>"+title_all_w
						+"</a></br>"
						+"<a class ='sss_d' href='http://www.nkaujhmono.com/webboard/w_"+lsa_count_get_sr.id_w+"' target='_blank'>"+txt_all_w
						+"</a>"
						+"<div class ='sss_id'>ผู้ตั้งกระทู้: "+lsa_count_get_sr.name_user_w+"("+lsa_count_get_sr.xeem_user_w
						+") id:#"+lsa_count_get_sr.id_nhn+" เขียนเมื่อ: "+lsa_count_get_sr.time_w+" ถูกใจ: "+lsa_count_get_sr.score_like_w+" ตอบ: "+lsa_count_get_sr.count_reply+" เปิดอ่าน: "+lsa_count_get_sr.viewed_w+"</div>"
						+"</div>"
					}
				},
				error: function()
				{
					alert("An error occoured!");
				}
		});
}


function replace_post_txt_r(input_replace_post_txt)
{
	input_replace_post_txt = escapeHtml(input_replace_post_txt);
	input_replace_post_txt = input_replace_post_txt.replace(/\[b\]/g, "").replace(/\[\/b\]/g, "")
		.replace(/\[i\]/g, "").replace(/\[\/i\]/g, "")
		.replace(/\[u\]/g, "").replace(/\[\/u\]/g, "")
		.replace(/\[sup\]/g, "").replace(/\[\/sup\]/g, "")
		.replace(/\[sub\]/g, "").replace(/\[\/sub\]/g, "")
		.replace(/\[center\]/g, "").replace(/\[\/center\]/g, "")
		.replace(/\[right\]/g, "").replace(/\[\/right\]/g, "")
		.replace(/\[left\]/g, "").replace(/\[\/left\]/g, "")
		.replace(/\[youtube\]/g, "").replace(/\[\/youtube\]/g, "")
		.replace(/\[img\]/g, "").replace(/\[\/img\]/g, "");
	return input_replace_post_txt;
}


