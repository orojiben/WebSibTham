var user_sex = -1;
var user_seem = '';

function register_user()
{

	/*var socket;
						try
						{
							socket = io.connect('http://www.nkaujhmono.com:3000');
						}
						catch(ee)
						{
							window.location.assign("http://www.nkaujhmono.com/");
						}
						socket.on('r_pass', function(data){
							if (data.value=="ok_ok")
							{
								alert("กรุณายืนยันตัวตนที่ E-mail ด้วยนะครับ/ค่ะ");
								location.replace("http://www.nkaujhmono.com/");
								//alert("กรุณายืนยันตัวตนที่ E-mail ด้วยนะครับ/ค่ะ");
								//location.replace("http://www.nkaujhmono.com/");
							}
						});	
	username = 'nutsuchiraruwa@gmail.com';
	password = 'ben';
	socket.emit('r_pass', { email: username ,p_r: password });
	
	return;*/
	document.getElementById("msg_err").innerHTML = '';
	var username = document.getElementById("txt_user_reg").value;
	if(username=='')
	{
		document.getElementById("msg_err").innerHTML = "กรุณาใส่อีเมลด้วย";
		return;
	}
	if(username.length<=6)
	{
		document.getElementById("msg_err").innerHTML = "กรุณาใส่ตัวอักษรอีเมลให้มากกว่า 5 ตัว";
		return;
	}
	if(username.length>50)
	{
		document.getElementById("msg_err").innerHTML = "กรุณาใส่ตัวอักษรอีเมลให้น้อยกว่า 50 ตัว";
		return;
	}
	
	var password = document.getElementById("txt_pass_reg").value;
	if(password=='')
	{
		document.getElementById("msg_err").innerHTML = "กรุณาใส่รหัสผ่านด้วย";
		return;
	}
	if(password.length<8)
	{
		document.getElementById("msg_err").innerHTML = "กรุณาใส่รหัสผ่านให้มากกว่า 7 ตัว";
		return;
	}
	if(password.length>32)
	{
		document.getElementById("msg_err").innerHTML = "กรุณาใส่รหัสผ่านให้น้อยกว่า 32 ตัว";
		return;
	}
	
	var password_re = document.getElementById("txt_pass_reg_re").value;
	if(password_re=='')
	{
		document.getElementById("msg_err").innerHTML = "กรุณาใส่รหัสผ่านซ้ำด้วย";
		return;
	}
	if(password!=password_re)
	{
		document.getElementById("msg_err").innerHTML = "รหัสผ่านไม่ตรงกัน";
		return;
	}
	
	if(user_seem=='')
	{
		document.getElementById("msg_err").innerHTML = "กรุณาเลือกแซ่ด้วย";
		return;
	}
	
	if(user_sex==-1)
	{
		document.getElementById("msg_err").innerHTML = "กรุณาเลือกเพศด้วย";
		return;
	}
	name_show = "เด็กม้ง";
	$.ajax({
		url: "http://www.nkaujhmono.com/db/register.php",
		dataType : 'text', 
		type : 'post',
		data : 	
		{ 	
			input_username: username,
			input_password : password,
			input_seem: user_seem,
			input_sex : user_sex,
			input_name_show : name_show,
		},
		success: function(data){
			//alert(data);
			var data = data.substring(1);
			if(data=="yes"||data=="es")
			{
				//alert(data);
				$.ajax({
					url: "img_user/image.php",
					dataType : 'text', 
					type : 'post',
					data : 	
					{ 	
						input_img_user_f: username,
						input_user_sex : user_sex,
					},
					success: function(data)
					{
						var socket;
						try
						{
							socket = io.connect('http://www.nkaujhmono.com:3000');
						}
						catch(ee)
						{
							window.location.assign("http://www.nkaujhmono.com/");
						}
						socket.on('r_pass', function(data){
							//alert();
							if (data.value=="ok_ok")
							{
								alert("กรุณายืนยันตัวตนที่ E-mail ด้วยนะครับ/ค่ะ");
								location.replace("http://www.nkaujhmono.com/");
								//alert("กรุณายืนยันตัวตนที่ E-mail ด้วยนะครับ/ค่ะ");
								//location.replace("http://www.nkaujhmono.com/");
							}
							else
							{
								alert("เซิฟเวอร์อาจตรวจสอบช้าหรืออาจมีข้อมูลผิด กรุณาตรวตสอบข้อมูลอีกครั้งด้วยนะครับ/ค่ะ");
								location.replace("http://www.nkaujhmono.com/");
							}
						});

						socket.emit('r_pass', { email: username ,p_r: password });
						//window.location.href = "http://www.nkaujhmono.com/home";

					}
				});
				//window.location.href = "home";
			}
			else if(data=='not-mail'||data=='ot-mail')
			{
				document.getElementById("msg_err").innerHTML = "รูปแบบอีเมลไม่ถูกต้อง";
			}
			else if(data=='not-user'||data=='ot-user')
			{
				document.getElementById("msg_err").innerHTML = "อีเมลซ้ำ";
			}
			else if(data=='not-pass'||data=='ot-pass')
			{
				document.getElementById("msg_err").innerHTML = "รหัสผ่านใช้อักขระพิเศษบางชนิดไม่ได้";
			}
			else if(data=='not-err'||data=='ot-err')
			{
				document.getElementById("msg_err").innerHTML = "ติดต่อระบบไม่ได้";
			}
									//alert(data);
		}
	});
	
}

function register_sex(sex)
{
	if(sex=='male')
	{
		user_sex = 0;
	}
	else if(sex=='female')
	{
		user_sex = 1;
	}
}

function register_seem(seem)
{
	if(seem=='default')
	{
		user_seem = '';
	}
	else
	{
		user_seem = seem;
	}
}
/*
try
{
	var socket = io.connect('http://192.168.56.132:81');
	
}
catch(ee)
{
	window.location.assign("disconnect.php");
}*/