var select_cp = '';

function get_img()
{
	var file = document.getElementById('image_upload_input').files[0];
	var formData = new FormData();
	formData.append("image", file);
	//alert(file +"_"+id_user);
	var d = new Date();
	$.ajax({
		url: "img_w/image.php?id="+id_user+"&t="+d.getTime(),
		dataType : 'text', 
		type: "POST",
		data: formData,
		success: function (msg) 
		{
			
			if(msg=="file"||msg=="file "||msg==" file")
			{
				alert("ขนาดไฟล์ใหญ่เกิน 700k");
			}
			else if(msg!="")
			{
				//alert(msg);
				add_tag_img("img_w/"+msg);
			}
		},
		contentType: false,
		processData: false
	});
}

function add_tag_img(img_)
{	
	var length_value_tag = 3;
	var control = document.getElementById("text_post");
	var oldStart = control.selectionStart;
	var oldEnd = control.selectionEnd;		
	var oldDirection = control.selectionDirection;
	var text_b = "[img]"+img_+"[/img]";
	control.setRangeText(text_b);
			
	control.focus();
	control.selectionEnd = control.selectionStart = oldStart+text_b.length - length_value_tag - 3;
	
		//var res = control.value.replace(/\[b\]/g, "<b>").replace(/\[\/b\]/g, "</b>");
		//document.getElementById("viewDetails").innerHTML = res;
}


function select_category_post(cp)
{
	select_cp = cp;
}