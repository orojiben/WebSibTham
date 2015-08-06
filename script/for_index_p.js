
var user_checked = 0;
var login_c = 2;
function login()
{
	document.getElementById("msg_err_login").innerHTML = "";
	var username = document.getElementById("txt_user").value;
	var password = document.getElementById("txt_pass").value;
	//window.location.href = 'home';
		$.ajax({
		url: "http://www.nkaujhmono.com/db/login.php",
		dataType : 'text', 
		type : 'post',
		data : 	
		{ 	
			input_username: username,
			input_password : password,
			input_checked :user_checked
		},
		success: function(data){
			//alert(data);
			var data = data.substring(1);
			if(data=="yes"||data=="es")
			{

					parent.jQuery.fancybox.close();

			}
			else if(data=='email'||data=='mail')
			{
				document.getElementById("msg_err_login").innerHTML = "ยืนยันอีเมลล์ก่อน";
			}
			else if(data=='not-err'||data=='ot-err')
			{
				document.getElementById("msg_err_login").innerHTML = "ติดต่อระบบไม่ได้";
			}
			else 
			{
				document.getElementById("msg_err_login").innerHTML = "**ข้อมูลไม่ตรง**";
			}
									//alert(data);
		}
	});
}

function checked_login(checked)
{
	if(checked==true)
	{
		user_checked = 1;
	}
	else
	{
		user_checked = 0;
	}
}

function logout()
{
	window.location.href = 'http://www.nkaujhmono.com/logout';
}

function home()
{
	window.location.href = 'http://www.nkaujhmono.com/home';
}