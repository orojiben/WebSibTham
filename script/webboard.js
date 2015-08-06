
var m_thai = ['ม.ค.','ก.พ.','มี.ค.',' เม.ย','พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.','ต.ค.','พ.ย.','ธ.ค.'];
var m_eng = ['JAN','FEB','MAR','APR','MAY','JUN','JUL','AUG','SEP','OCT','NOV','DEC'];

function escapeHtml(text) {
	return text
		.replace(/&/g, "&amp;")
		.replace(/</g, "&lt;")
		.replace(/>/g, "&gt;")
		.replace(/"/g, "&quot;")
		.replace(/'/g, "&#039;")
		.replace(/\\/g, "&#92;");
}

function save_post()
{
	var title_post = '';
	document.getElementById("title_error").innerHTML="";
	document.getElementById("text_error").innerHTML="";
	document.getElementById("category_post_error").innerHTML="";

	if(f_t=='ww' ||(v=='1'&&f_t=='w'))
	{
		if(select_cp=='')
		{
			document.getElementById("category_post_error").innerHTML="กรุณาเลือกหมวดกระทู้";
			return;
		}
		title_post = document.getElementById("title_post").value;
		if(title_post.length<20)
		{
			document.getElementById("title_error").innerHTML="ตัวอักษรต้องมากกว่า 20 ตัวอักษร";
			return;
		}
		
	}
	
	if(v=='1')
	{
		//alert(v +" "+f_t);
		if(f_t=='w')
		{
			if(document.getElementById("text_post").value.length<50)
			{
				document.getElementById("text_error").innerHTML="ตัวอักษรต้องมากกว่า 50 ตัวอักษร";
				return;
			}
			var text_post_r = replace_post_txt_r(document.getElementById("text_post").value);
			if(text_post_r.length>100)
			{
				text_post_r = text_post_r.substring(0, 100);
			}
			$.ajax({
				url: "http://www.nkaujhmono.com/db/webboad_edit.php",
				dataType : 'text', 
				type : 'post',
				data : 	
				{ 	
					input_id_w: f_id,
					input_text_post: document.getElementById("text_post").value,
					input_title_post: title_post,
					input_text_post_r: text_post_r,
					input_select_cp: select_cp
				},
				success: function(data){
					//alert(data);
					parent.document.getElementById("title_w").innerHTML = escapeHtml(document.getElementById("title_post").value);
					parent.document.getElementById("txt_show_w").innerHTML = replace_post_txt(document.getElementById("text_post").value);
					parent.jQuery.fancybox.close();
				}
			});
		}
		else
		{
			if(document.getElementById("text_post").value.length<1)
			{
				document.getElementById("text_error").innerHTML="ตัวอักษรต้องมากกว่า 1 ตัวอักษร";
				return;
			}
			$.ajax({
				url: "http://www.nkaujhmono.com/db/webboad_edit2.php",
				dataType : 'text', 
				type : 'post',
				data : 	
				{ 	
					input_f_t: f_t,
					input_f_id: f_id,
					input_text_post: document.getElementById("text_post").value,
				},
				success: function(data){
					parent.document.getElementById("txt_"+f_t+"_"+f_id).innerHTML = replace_post_txt(document.getElementById("text_post").value);
					parent.jQuery.fancybox.close();
				}
			});
		}
	}
	else
	{
	
	//alert(f_t +" "+f_id+" "+ id_user);
		if(f_t=='ww' && document.getElementById("text_post").value.length<50)
		{
			document.getElementById("text_error").innerHTML="ตัวอักษรต้องมากกว่า 50 ตัวอักษร";
			return;
		}
		else if(document.getElementById("text_post").value.length<1)
		{
			document.getElementById("text_error").innerHTML="ตัวอักษรต้องมากกว่า 1 ตัวอักษร";
			return;
		}
		var text_post_r = replace_post_txt_r(document.getElementById("text_post").value);
		if(text_post_r.length>100)
		{
			text_post_r = text_post_r.substring(0, 100);
		}
		$.ajax({
				url: "http://www.nkaujhmono.com/db/webboad_post.php",
				dataType : 'text', 
				type : 'post',
				data : 	
				{ 	
					input_f_t: f_t,
					input_f_id: f_id,
					input_user: id_user,
					input_text_post: document.getElementById("text_post").value,
					input_title_post: title_post,
					input_text_post_r: text_post_r,
					input_select_cp: select_cp
				},
				success: function(data){
					//alert(f_t +" "+f_id+" "+ id_user+" "+data);
					var new_data = data.substr(1);
					//var get_sr = jQuery.parseJSON(new_data);
					//alert(new_data);
					if(f_t!='ww')
					{
						parent.date_event_reply = new_data;
						parent.jQuery.fancybox.close();
					}
					else
					{
										
						location.replace("http://www.nkaujhmono.com/webboard/w_"+parent.jQuery.parseJSON(new_data).value_id);
					}
					//alert(new_data);
					//if(data=="ok"||data==" ok")
					//{
						//alert(data);
						//$.fancybox.close();
						//parent.date_event_reply = f_t+"_"+;
						//parent.jQuery.fancybox.close();
					//}
					//parent.jQuery.fancybox.close();
					//alert(parent.webboard_id);
					//$.fancybox.close();
				},
				error: function()
				{
					alert("An error occoured!");
				}
			});
	}
}

function show_post(text_show,title_show,id_nhn,time_w,score_user_w,check_like_w,score_like_w,name_user_w,xeem_user_w)
{
	text_show = escapeHtml(text_show);
	var res = text_show.replace(/\[b\]/g, "<b>").replace(/\[\/b\]/g, "</b>")
		.replace(/\[i\]/g, "<i>").replace(/\[\/i\]/g, "</i>")
		.replace(/\[u\]/g, "<u>").replace(/\[\/u\]/g, "</u>")
		.replace(/\[sup\]/g, "<sup>").replace(/\[\/sup\]/g, "</sup>")
		.replace(/\[sub\]/g, "<sub>").replace(/\[\/sub\]/g, "</sub>")
		.replace(/\[center\]/g, "<center>").replace(/\[\/center\]/g, "</center>")
		.replace(/\[right\]/g, "<div align='right'>").replace(/\[\/right\]/g, "</div>")
		.replace(/\[left\]/g, "<div align='right'>").replace(/\[\/left\]/g, "</div>");
		
		res = urlYoutub(res);
		res = urlImg_w(res);
		
		//<a target="_blank" href="http://xn--82caaa5dbbb/" rel="nofollow">
		//<object width="600" height="471"
		//	data="http://www.youtube.com/v/XGSy3_Czz8k">
		//</object>
		//<embed width="600" height="471" src="http://www.youtube.com/v/XGSy3_Czz8k">
	//	alert("ben1");
		var check_delete_edit = '';
		if(id_nhn==id_user)
		{
			check_delete_edit ='<img class="delete_img" id="delete_img_w_'+webboard_id+'" alt="" src="http://www.nkaujhmono.com/images/delete.png" height="25" width="25" title="ลบ"  onmouseup="select_fancy_delete(this.id)";/>'
			+'<img class="edit_img" id="edit_img_w_'+webboard_id+'" alt="" src="http://www.nkaujhmono.com/images/edit.png" height="25" width="25" onmouseup="select_fancy_edit(this.id)"; title="แก้ไข"  />';
		}
		//alert(id_nhn+" "+id_user);
		document.getElementById("view_text_post").innerHTML = '<img class="profile_img" id="profile_img_w_'+webboard_id+'" alt="" src="http://www.nkaujhmono.com/img_user/'+id_nhn+'.jpg" height="50" width="50" />'
				+'<div class="txt_head" >'
				+'<span class="name_id">id: #'+id_nhn+'</span><span class="name">ชื่อ: '+name_user_w+'('+xeem_user_w+')</span>'
				+'<span class="score_nickname">คะแนน: '+score_user_w+'</span><span class="nickname">ฉายา: '+score_thai(score_user_w)+'</span><span class="time_post">โพสเมื่อ: '+date_thai(time_w)+'</span>'
				+'</div></br></br>'
				+'<div class="txt">'+'<div class = "title" id="title_w" >'+escapeHtml(title_show)+'</div><div id="txt_show_w">' + res+'</div></div>'
				+'<span id="score_like_w_'+webboard_id+'"  class="score_like sl"><img class="like_img" id="like_img_w_'+webboard_id+'_'+id_nhn+'" alt="" src="http://www.nkaujhmono.com/images/'+check_like_w+'.png" height="25" width="25" onmouseup="select_fancy_like(this.id);" /> <span id="s_like_img_w_'+webboard_id+'_'+id_nhn+'">'+score_like_w+'</span></span>'
				+'<img class="reply_img" id="reply_img_w_'+webboard_id+'" alt="" src="http://www.nkaujhmono.com/images/reply.png" height="25" width="25" onmouseup="select_fancy_reply(this.id);" title="ตอบกลับ" />'
				+'<img class="inf_img" id="inf_img_w_'+webboard_id+'" alt="" src="http://www.nkaujhmono.com/images/inf.png" height="25" width="25" title="แจ้งลบ" />'
				+check_delete_edit;
}

function replace_post_txt(input_replace_post_txt)
{
	input_replace_post_txt = escapeHtml(input_replace_post_txt);
	input_replace_post_txt = input_replace_post_txt.replace(/\[b\]/g, "<b>").replace(/\[\/b\]/g, "</b>")
		.replace(/\[i\]/g, "<i>").replace(/\[\/i\]/g, "</i>")
		.replace(/\[u\]/g, "<u>").replace(/\[\/u\]/g, "</u>")
		.replace(/\[sup\]/g, "<sup>").replace(/\[\/sup\]/g, "</sup>")
		.replace(/\[sub\]/g, "<sub>").replace(/\[\/sub\]/g, "</sub>")
		.replace(/\[center\]/g, "<center>").replace(/\[\/center\]/g, "</center>")
		.replace(/\[right\]/g, "<div align='right'>").replace(/\[\/right\]/g, "</div>")
		.replace(/\[left\]/g, "<div align='left'>").replace(/\[\/left\]/g, "</div>");
	input_replace_post_txt = urlImg(input_replace_post_txt);
	return urlYoutub(input_replace_post_txt)
}

function replace_post_txt_r(input_replace_post_txt)
{
	input_replace_post_txt = escapeHtml(input_replace_post_txt);
	input_replace_post_txt = input_replace_post_txt
		.replace(/\[b\]/g, "").replace(/\[\/b\]/g, "")
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

function view_post()
{
	
	var control = document.getElementById("text_post");
	var control_value = escapeHtml(control.value);
	//alert(control.value);
	var res = control_value.replace(/\[b\]/g, "<b>").replace(/\[\/b\]/g, "</b>")
		.replace(/\[i\]/g, "<i>").replace(/\[\/i\]/g, "</i>")
		.replace(/\[u\]/g, "<u>").replace(/\[\/u\]/g, "</u>")
		.replace(/\[sup\]/g, "<sup>").replace(/\[\/sup\]/g, "</sup>")
		.replace(/\[sub\]/g, "<sub>").replace(/\[\/sub\]/g, "</sub>")
		.replace(/\[center\]/g, "<center>").replace(/\[\/center\]/g, "</center>")
		.replace(/\[right\]/g, "<div align='right'>").replace(/\[\/right\]/g, "</div>")
		.replace(/\[left\]/g, "<div align='left'>").replace(/\[\/left\]/g, "</div>");
		
		res = urlYoutub(res);
		res = urlImg(res);
		//<a target="_blank" href="http://xn--82caaa5dbbb/" rel="nofollow">
		//<object width="600" height="471"
		//	data="http://www.youtube.com/v/XGSy3_Czz8k">
		//</object>
		//<embed width="600" height="471" src="http://www.youtube.com/v/XGSy3_Czz8k">
		if(f_t=='ww' || (f_t=='w'&&v=='1'))
		{
			document.getElementById("view_text_post").innerHTML = '<div class = "title">'+escapeHtml(document.getElementById("title_post").value)+'</div><br/>' + res;
		}
		else
		{
			document.getElementById("view_text_post").innerHTML =  res;
		}
}
		
function add_tag_text(value_tag)
{	
	var length_value_tag = value_tag.length;
	var control = document.getElementById("text_post");
	var oldStart = control.selectionStart;
	var oldEnd = control.selectionEnd;		
	var oldDirection = control.selectionDirection;
	var text_b = "["+value_tag+"]"+control.value.substr(oldStart,oldEnd-oldStart)+"[/"+value_tag+"]";
	control.setRangeText(text_b);
			
	control.focus();
	if(oldStart!=oldEnd)
	{
		oldStart = control.selectionStart = control.selectionStart + length_value_tag + 2;
		oldEnd = control.selectionEnd = control.selectionEnd - length_value_tag - 3;
		control.setSelectionRange(oldStart, oldEnd,oldDirection);
	}
	else
	{	
		control.selectionEnd = control.selectionStart = oldStart+text_b.length - length_value_tag - 3;
	}			
		//var res = control.value.replace(/\[b\]/g, "<b>").replace(/\[\/b\]/g, "</b>");
		//document.getElementById("viewDetails").innerHTML = res;
}

function urlYoutub(text) {
	
	var reg_html =/\[youtube\](?:https?:\/\/)?(?:www\.)?(?:youtube\.com(?:\/watch\?v=))([\w-]{11})\[\/youtube\]/g;
	
	//text.
	var buff_text = text;
	var list_url = new Array();
	var matchs =  buff_text.match(reg_html);
	if(matchs==null)
	{
		return text;
	}
	//alert(matchs);
	//for(var i_matchs=0;i_matchs<matchs.length;i_matchs++0
	/*while(true)
	{
		match = reg_html.exec(buff_text);
		//alert(match[0]);
		if(match==null)
		{
			break;
		}
		
		list_url.push(match[0]);
		alert(match[0]);
		count_url = buff_text.search(reg_html);
		alert()
		buff_text = buff_text.substr(count_url+match[0].length);
	}*/
	//alert();
	 buff_text = text;//.replace(/\[\/?youtube\]/g,'');
	var save_ner_url = '';
	var count_for_cut_end = 0;
	for(i_url = 0;i_url<matchs.length;i_url++)
	{
		//count_url = buff_text.search(reg_html);
		//str_new_for_add = buff_text.substr(0,count_url+list_url[i_url].length);
		//buff_text = buff_text.substr(count_url+list_url[i_url].length);
		//count_for_cut_end += count_url+list_url[i_url].length;
		str_re ='<div><embed width="600" height="471" src="'+matchs[i_url].replace('watch?v=','v/').replace(/\[\/?youtube\]/g,'')+'"></div>';
		//alert(matchs[i_url].replace('watch?v=','v/').replace(/\[\/?youtube\]/g,''))
		buff_text = buff_text.replace(matchs[i_url], str_re);
		//alert(buff_text)
	}
	//text = save_ner_url + text.substr(count_for_cut_end,text.length);
	//alert(buff_text);
	return buff_text;
}

function urlImg(text) {
	
	var reg_html =/\[img\](?:https?:\/\/)?(?:www\.)?\S+\.(?:png|gif|jpg)\[\/img\]/g;
	
	//text.
	var buff_text = text;
	var list_url = new Array();
	var matchs =  buff_text.match(reg_html);
	if(matchs==null)
	{
		return text;
	}
	//alert(matchs);
	//for(var i_matchs=0;i_matchs<matchs.length;i_matchs++0
	/*while(true)
	{
		match = reg_html.exec(buff_text);
		//alert(match[0]);
		if(match==null)
		{
			break;
		}
		
		list_url.push(match[0]);
		alert(match[0]);
		count_url = buff_text.search(reg_html);
		alert()
		buff_text = buff_text.substr(count_url+match[0].length);
	}*/
	//alert();
	 buff_text = text;//.replace(/\[\/?youtube\]/g,'');
	var save_ner_url = '';
	var count_for_cut_end = 0;
	for(i_url = 0;i_url<matchs.length;i_url++)
	{
		//count_url = buff_text.search(reg_html);
		//str_new_for_add = buff_text.substr(0,count_url+list_url[i_url].length);
		//buff_text = buff_text.substr(count_url+list_url[i_url].length);
		//count_for_cut_end += count_url+list_url[i_url].length;
		str_re ='<div><img src="'+matchs[i_url].replace(/\[\/?img\]/g,'')+'"/></div>';
		//alert(matchs[i_url].replace('watch?v=','v/').replace(/\[\/?youtube\]/g,''))
		buff_text = buff_text.replace(matchs[i_url], str_re);
		//alert(buff_text)
	}
	//text = save_ner_url + text.substr(count_for_cut_end,text.length);
	//alert(buff_text);
	return buff_text;
}

function urlImg_w(text) {
	
	var reg_html =/\[img\](?:https?:\/\/)?(?:www\.)?\S+\.(?:png|gif|jpg)\[\/img\]/g;
	
	//text.
	var buff_text = text;
	var list_url = new Array();
	var matchs =  buff_text.match(reg_html);
	if(matchs==null)
	{
		return text;
	}
	//alert(matchs);
	//for(var i_matchs=0;i_matchs<matchs.length;i_matchs++0
	/*while(true)
	{
		match = reg_html.exec(buff_text);
		//alert(match[0]);
		if(match==null)
		{
			break;
		}
		
		list_url.push(match[0]);
		alert(match[0]);
		count_url = buff_text.search(reg_html);
		alert()
		buff_text = buff_text.substr(count_url+match[0].length);
	}*/
	//alert();
	 buff_text = text;//.replace(/\[\/?youtube\]/g,'');
	var save_ner_url = '';
	var count_for_cut_end = 0;
	for(i_url = 0;i_url<matchs.length;i_url++)
	{
		//count_url = buff_text.search(reg_html);
		//str_new_for_add = buff_text.substr(0,count_url+list_url[i_url].length);
		//buff_text = buff_text.substr(count_url+list_url[i_url].length);
		//count_for_cut_end += count_url+list_url[i_url].length;
		str_re ='<div><img src="../'+matchs[i_url].replace(/\[\/?img\]/g,'')+'"/></div>';
		//alert(matchs[i_url].replace('watch?v=','v/').replace(/\[\/?youtube\]/g,''))
		buff_text = buff_text.replace(matchs[i_url], str_re);
		//alert(buff_text)
	}
	//text = save_ner_url + text.substr(count_for_cut_end,text.length);
	//alert(buff_text);
	return buff_text;
}


function add_em(select,id_for_add,id_post,txt,name_user,id_user_post,time_post,score_user,check_like,xeem_show_r,score_like)
{
	var element=document.getElementById(id_for_add);
	var check_delete_edit = '';
	if(select==0)
	{
		if(id_user_post==id_user)
		{
			check_delete_edit ='<img class="delete_img" id="delete_img_r_'+id_post+'" alt="" src="http://www.nkaujhmono.com/images/delete.png" height="25" width="25" title="ลบ" onmouseup="select_fancy_delete(this.id)";/>'
			+'<img class="edit_img" id="edit_img_r_'+id_post+'" alt="" src="http://www.nkaujhmono.com/images/edit.png" height="25" width="25" title="แก้ไข" onmouseup="select_fancy_edit(this.id)";/>';
		}
		element.innerHTML += '<div id="sub_'+id_post+'" class ="sub_main1">'
				+'<div id="sub_view_details_'+id_post+'" class ="txt_sub_detail">'
				+'<img class="profile_img" id="profile_img_r_'+id_user_post+'" alt="" src="http://www.nkaujhmono.com/img_user/'+id_user_post+'.jpg" height="50" width="50" />'
				+'<div class="sub_txt_head" >'
				+'<span class="name_id">id: #'+id_user_post+'</span><span class="name">ชื่อ: '+name_user+'('+xeem_show_r+')</span>'
				+'<span class="score_nickname">คะแนน: '+score_user+'</span><span class="nickname">ฉายา: '+score_thai(score_user)+'</span><span class="time_post">โพสเมื่อ: '+date_thai(time_post)+'</span>'
				+'</div></br></br>'
				+'<div class="txt" id="txt_r_'+id_post+'">'+ replace_post_txt(txt)+'</div>'
				+'<span id="score_like_r_'+id_post+'"  class="score_like"><img class="like_img" id="like_img_r_'+id_post+'_'+id_user_post+'" alt="" src="http://www.nkaujhmono.com/images/'+check_like+'.png" height="25" width="25" onmouseup="select_fancy_like(this.id);"/><span id="s_like_img_r_'+id_post+'_'+id_user_post+'"> '+score_like+'</span></span>'
				+'<img class="reply_img" id="reply_img_r_'+id_post+'" alt="" src="http://www.nkaujhmono.com/images/reply.png" height="25" width="25" onmouseup="select_fancy_reply(this.id);" title="ตอบกลับ"/>'
				+'<img class="inf_img" id="inf_img_r_'+id_post+'" alt="" src="http://www.nkaujhmono.com/images/inf.png" height="25" width="25" title="แจ้งลบ" />'
				+check_delete_edit
				+'</div></br></div>'
				+'</br>';
	}
	else{
		if(id_user_post==id_user)
		{
			check_delete_edit ='<img class="delete_img" id="delete_img_s_'+id_post+'" alt="" src="http://www.nkaujhmono.com/images/delete.png" height="25" width="25" title="ลบ" onmouseup="select_fancy_delete(this.id)";/>'
			+'<img class="edit_img" id="edit_img_s_'+id_post+'" alt="" src="http://www.nkaujhmono.com/images/edit.png" height="25" width="25" title="แก้ไข" onmouseup="select_fancy_edit(this.id)";/>';
		}
	element.innerHTML += '<div id="sub_sub_view_details_'+id_post+'" class ="txt_sub_sub_detail">'
				+'<img class="profile_img" id="profile_img_s_'+id_user_post+'" alt="" src="http://www.nkaujhmono.com/img_user/'+id_user_post+'.jpg" height="50" width="50" />'
				+'<div class="sub_sub_txt_head" >'
				+'<span class="name_id">id: #'+id_user_post+'</span><span class="name">ชื่อ: '+name_user+'('+xeem_show_r+')</span>'
				+'<span class="score_nickname">คะแนน: '+score_user+'</span><span class="nickname">ฉายา: '+score_thai(score_user)+'</span><span class="time_post">โพสเมื่อ: '+date_thai(time_post)+'</span>'
				+'</div></br></br>'
				+'<div class="txt" id="txt_s_'+id_post+'">'+replace_post_txt(txt)+'</div>'
				+'<span id="score_like_s_'+id_post+'"  class="score_like"><img class="like_img" id="like_img_s_'+id_post+'_'+id_user_post+'" alt="" src="http://www.nkaujhmono.com/images/'+check_like+'.png" height="25" width="25" onmouseup="select_fancy_like(this.id);"/><span id="s_like_img_s_'+id_post+'_'+id_user_post+'"> '+score_like+'</span></span>'
				+'<img class="inf_img" id="inf_img_s_'+id_post+'" alt="" src="http://www.nkaujhmono.com/images/inf.png" height="25" width="25" title="แจ้งลบ"/>'
				+check_delete_edit
				//+'<img class="reply_img" id="reply_img_s_'+id_post+'" alt="" src="http://www.nkaujhmono.com/images/reply.png" height="25" width="25" />'
				+'</div></br>';
	}
}

function load_post()
{
	$.ajax({
			type: "POST",
				url: "http://www.nkaujhmono.com/db/get_webboad.php",
				dataType: "text", 
				data: {input_webboard_id: webboard_id},
				 // Set the data type so jQuery can parse it for you
				success: function (data) {
					
					//var obj = jQuery.parseJSON( '[{ "name": "John","name2": [{}] }]' );
					var new_data = data.substr(1);
					//var dd = jQuery.parseJSON(data);
					//alert(obj[0].name2[0].name);
					//var s = '[{"id_rw":"2","id_nhn":"3","time_rw":"2015-04-29 00:00:00","details_rw":"I Love","liked_rw":"0","sr":[{"id_sr":"3","id_nhn_rs":"12","time_nhnwsr":"2015-04-29 00:00:00","details_srw":"hfkhfhflag","liked_srw":"0"}]},{"id_rw":"3","id_nhn":"12","time_rw":"2015-04-30 00:00:00","details_rw":"sssssssss","liked_rw":"0","sr":[{"id_sr":null,"id_nhn_rs":null,"time_nhnwsr":null,"details_srw":null,"liked_srw":null}]}]';

					//var obj2 = jQuery.parseJSON('[{"id_rw":"2","id_nhn":"3","time_rw":"2015-04-29 00:00:00","details_rw":"I Love","liked_rw":"0",
					//"sr":[{"id_sr":"3","id_nhn_rs":"12","time_nhnwsr":"2015-04-29 00:00:00","details_srw":"hfkhfhflag","liked_srw":"0"}]},{"id_rw":"3","id_nhn":"12","time_rw":"2015-04-30 00:00:00","details_rw":"sssssssss","liked_rw":"0","sr":[{"id_sr":null,"id_nhn_rs":null,"time_nhnwsr":null,"details_srw":null,"liked_srw":null}]}]');
					var get_sr = jQuery.parseJSON(new_data);
					if(get_sr.length==0)
					{
						return;
					}
					//alert(s.length+"  "+new_data.length);
					var get_sr_length =  get_sr.length;
					var get_ssr_length =  0;
					var issr = 0;
					var buff_sr;
					var buff_sr_mem = '';
					var buff_ssr;
					//alert(new_data);
					for(var isr = 0;isr< get_sr_length;isr++)
					{
						buff_sr = get_sr[isr];
						/*if(buff_sr_mem ==buff_sr.id_rw)
						{
							continue;
						}
						buff_sr_mem = buff_sr.id_rw;*/
						var like_r = 'like';
						if(id_user!=''&&id_user !=undefined)
						{
							var value_like_r = (","+buff_sr.user_like+",").indexOf(","+id_user+",");
							if(value_like_r>=0)
							{
								like_r = 'unlike';
							}
						}
						add_em(0,"main",buff_sr.id_rw,buff_sr.details_rw,buff_sr.name_show,buff_sr.id_nhn,buff_sr.time_rw,buff_sr.score,like_r,buff_sr.xeem_show,buff_sr.liked_rw);
						if(buff_sr.sr[0].id_sr==null)
						{
							continue;
						}
						get_ssr_length =  buff_sr.sr.length;
						for(issr = 0;issr< get_ssr_length;issr++)
						{
							buff_ssr = buff_sr.sr[issr];
							var like_s = 'like';
							if(id_user!=''&&id_user !=undefined)
							{
								var value_like_s = (","+buff_ssr.user_like+",").indexOf(","+id_user+",");
								if(value_like_s>=0)
								{
									like_s = 'unlike';
								}
							}
							add_em(1,"sub_"+buff_sr.id_rw,buff_ssr.id_sr,buff_ssr.details_srw,buff_ssr.name_show_s,buff_ssr.id_nhn_rs,buff_ssr.time_nhnwsr,buff_ssr.score_s,like_s,buff_ssr.xeem_show,buff_ssr.liked_srw);
						}
					}
				},
				error: function()
				{
					alert("An error occoured!");
				}
		});
		//alert("ben");
}

function load_webboard_first()
{
	$.ajax({
			type: "POST",
				url: "http://www.nkaujhmono.com/db/webboad.php",
				dataType: "text", 
				data: {input_webboard_id: webboard_id},
				 // Set the data type so jQuery can parse it for you
				success: function (data) {
					
					var get_sr = jQuery.parseJSON(data);
					if(get_sr.title=="")
					{
						document.getElementById("error").style.display = "block";
						return;
					}
					//alert(get_sr.score_like_w);
					document.getElementById("main").style.display = "block";
					var like = 'like';
					if(id_user!=''&&id_user !=undefined)
					{
						var value_like = (","+get_sr.user_like+",").indexOf(","+id_user+",");
						if(value_like>=0)
						{
							like = 'unlike';
						}
					}
					
					show_post(get_sr.details,get_sr.title,get_sr.id_nhn,
						get_sr.time_w,get_sr.score_user_w,like,get_sr.score_like_w,
						get_sr.name_user_w,get_sr.xeem_user_w);
						
					load_post();
				},
				error: function()
				{
					alert("An error occoured!");
				}
		});
		//alert("ben");
}

function date_thai(string_timg)
{
	
	var d_thai = new Date(string_timg);
	var gd_thai = d_thai.getDate()+"";
	var gh_thai = d_thai.getHours()+"";
	var gm_thai = d_thai.getMinutes()+"";
	var gs_thai = d_thai.getSeconds()+"";

	if(gd_thai.length==1)
	{
		gd_thai = "0"+gd_thai;
	}
	if(gh_thai.length==1)
	{
		gh_thai = "0"+gh_thai;
	}
	if(gm_thai.length==1)
	{
		gm_thai = "0"+gm_thai;
	}
	if(gs_thai.length==1)
	{
		gs_thai = "0"+gs_thai;
	}
	return gd_thai +" "+m_thai[parseInt(d_thai.getMonth())]+" "+d_thai.getFullYear() 
	+"  "+gh_thai+":"+gm_thai+":"+gs_thai;
}

function score_thai(score)
{
	if(score>2000)
	{
		return 'ปรมาจารย์ม้ง';
	}
	else if(score>1000)
	{
		return 'รองปรมาจารย์ม้ง';
	}
	else if(score>800)
	{
		return 'เด็กม้งขั้นเซียน';
	}
	else if(score>500)
	{
		return 'เด็กม้งผู้มีปัญญา';
	}
	else if(score>300)
	{
		return 'เด็กม้งผู้ขวนขวาย';
	}
	else if(score>100)
	{
		return 'เด็กม้ง';
	}
	else
	{
		return 'เด็กม้งน้อย';
	}
}

function select_fancy_reply(select_fancy)
{
	if(id_user ==undefined || id_user =="")
	{
		login_none();
		return;
	}
	//alert();
	if(select_fancy=="0")
	{
		$.fancybox.open({
			href : 'http://www.nkaujhmono.com/write_webboard.php?v=0&t=ww',
			type : 'iframe',
			width : 1300,
			height : 500,					
			padding : 5,
			autoSize:false
		});
		
	}
	else
	{
		var value_select_fancy = select_fancy.split("_");

		$.fancybox.open({
			href : 'http://www.nkaujhmono.com/write_webboard.php?v=0&t='+value_select_fancy[2]+'&id='+value_select_fancy[3],
			type : 'iframe',
			width : 1300,
			height : 500,					
			padding : 5,
			autoSize:false,
			afterClose:function() 
			{ 
				if(date_event_reply=='')
				{
					return;
				}
				var get_sr = jQuery.parseJSON(date_event_reply);
				if(get_sr.value=="ok")
				{
					if(get_sr.f_t=="w")
					{
						add_em(0,"main",get_sr.value_id,get_sr.text,
						name_show,id_user,get_sr.date,
						xeem_score,'like',xeem_show,'0');
					}
					else if(get_sr.f_t=="r")
					{
						add_em(1,"sub_"+get_sr.f_id,get_sr.value_id,get_sr.text,
						name_show,id_user,get_sr.date,
						xeem_score,'like',xeem_show,'0');
					}
				}
				
			}
		});
	}
	
}

function select_fancy_edit(select_fancy)
{

		var value_select_fancy = select_fancy.split("_");
		$.fancybox.open({
			href : 'http://www.nkaujhmono.com/write_webboard.php?v=1&t='+value_select_fancy[2]+'&id='+value_select_fancy[3],
			type : 'iframe',
			width : 1300,
			height : 500,					
			padding : 5,
			autoSize:false,
			afterClose:function() 
			{ 
			
			}
		});
		
}

function edit_post()
{
	if(v=='1')
	{
		//alert(v +" "+f_t);
		document.getElementById("button_ok").innerHTML = "แก้ไข";
		if(f_t=='w')
		{
			document.getElementById("title_post").style.display = "block";
			load_webboard_head();
		}
		else
		{
			load_webboard_head();//document.getElementById("text_post").value = parent.document.getElementById("edit_img_"+f_t+"_"+f_id).innerHTML;
		}
		
	}
}

function load_webboard_head()
{
	if(v=='1')
	{
		if(f_t=='w')
		{
			$.ajax({
				type: "POST",
					url: "http://www.nkaujhmono.com/db/webboad.php",
					dataType: "text", 
					data: {input_webboard_id: f_id},
					 // Set the data type so jQuery can parse it for you
					success: function (data) {
						
						var get_sr = jQuery.parseJSON(data);
						document.getElementById("title_post").value = get_sr.title;
						document.getElementById("text_post").value = get_sr.details;
					},
					error: function()
					{
						alert("An error occoured!");
					}
			});
		}
		else
		{
			$.ajax({
				type: "POST",
					url: "http://www.nkaujhmono.com/db/webboad_reply.php",
					dataType: "text", 
					data: {input_id: f_id,input_t: f_t},
					 // Set the data type so jQuery can parse it for you
					success: function (data) {
						
						var get_sr = jQuery.parseJSON(data);
						document.getElementById("text_post").value = get_sr.details;
					},
					error: function()
					{
						alert("An error occoured!");
					}
			});
		}
	}	//alert("ben");
}

var delete_ok = false;

function select_fancy_delete(select_fancy)
{

		var value_select_fancy = select_fancy.split("_");
		$.fancybox.open({
			href : 'http://www.nkaujhmono.com/delete_webboard.php?v=1&t='+value_select_fancy[2]+'&id='+value_select_fancy[3],
			type : 'iframe',
			width : 500,
			height : 500,					
			padding : 5,
			autoSize:false,
			afterClose:function() 
			{ 
				if(delete_ok)
				{
					location.reload();
				}
			}
		});	
}

function select_fancy_like(select_fancy)
{
	//alert(document.getElementById(select_fancy).src);
	if(id_user ==undefined || id_user =="")
	{
		login_none();
		return;
	}
	if(document.getElementById(select_fancy).src=="http://www.nkaujhmono.com/images/like.png" && id_user !=undefined)
	{
		//alert(id_user);
		var value_select_fancy = select_fancy.split("_");
		//alert(value_select_fancy[4]);
		//alert(id_user +"  "+value_select_fancy[2] +"  "+ value_select_fancy[3]);
		$.ajax({
				
				type: "POST",
					url: "http://www.nkaujhmono.com/db/webboad_like.php",
					dataType: "text", 
					data: {input_id_user: id_user,input_f_t: value_select_fancy[2],input_f_id: value_select_fancy[3]
							,input_id_nhn:value_select_fancy[4] },
					success: function (data) {
					//	alert(data.length +"_" +select_fancy);
						if(data.length==3)
						{
							document.getElementById(select_fancy).src="http://www.nkaujhmono.com/images/unlike.png";
							var s_w_update = parseInt(document.getElementById("s_"+select_fancy).innerHTML);
							s_w_update++;
							document.getElementById("s_"+select_fancy).innerHTML=" "+s_w_update;
							
						}

					},
					error: function()
					{
						alert("An error occoured!");
					}
			});
	}
}

function login_none()
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