function logout()
{
	window.location.href = 'logout';
}

function escapeHtml(text) {
	return text
		.replace(/&/g, "&amp;")
		.replace(/</g, "&lt;")
		.replace(/>/g, "&gt;")
		.replace(/"/g, "&quot;")
		.replace(/'/g, "&#039;")
		.replace(/\\/g, "&#92;");
}

function urlToTag(text) {
	var reg_html =/(?:(?:https?|ftp):\/\/)(?:\S+(?::\S*)?@)?(?:(?!10(?:\.\d{1,3}){3})(?!127(?:\.\d{1,3}){3})(?!169\.254(?:\.\d{1,3}){2})(?!192\.168(?:\.\d{1,3}){2})(?!172\.(?:1[6-9]|2\d|3[0-1])(?:\.\d{1,3}){2})(?:[1-9]\d?|1\d\d|2[01]\d|22[0-3])(?:\.(?:1?\d{1,2}|2[0-4]\d|25[0-5])){2}(?:\.(?:[1-9]\d?|1\d\d|2[0-4]\d|25[0-4]))|(?:(?:[a-z\u00a1-\uffff0-9]+-?)*[a-z\u00a1-\uffff0-9]+)(?:\.(?:[a-z\u00a1-\uffff0-9]+-?)*[a-z\u00a1-\uffff0-9]+)*(?:\.(?:[a-z\u00a1-\uffff]{2,})))(?::\d{2,5})?(?:\/)?/i;
	var list_url = new Array();
	
	var buff_text = text;
	while(true)
	{
		match = reg_html.exec(buff_text);
		if(match==null)
		{
			break;
		}
		list_url.push(match[0]);
		count_url = buff_text.search(reg_html);
		buff_text = buff_text.substr(count_url+match[0].length);
	}
	//alert();
	buff_text = text;
	var save_ner_url = '';
	var count_for_cut_end = 0;
	for(i_url = 0;i_url<list_url.length;i_url++)
	{
		count_url = buff_text.search(reg_html);
		str_new_for_add = buff_text.substr(0,count_url+list_url[i_url].length);
		buff_text = buff_text.substr(count_url+list_url[i_url].length);
		count_for_cut_end += count_url+list_url[i_url].length;
		str_re ='<a href="'+list_url[i_url]+'" target="_blank" >'+list_url[i_url]+'</a>';
		save_ner_url += str_new_for_add.replace(list_url[i_url], str_re);
	}
	text = save_ner_url + text.substr(count_for_cut_end,text.length);
	return text;
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