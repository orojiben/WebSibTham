
function djCallMusic(){
	chatObj2.getStatus();
	setInterval('chatObj2.updateChat()',2000);
				
}

function sendTextMusic()
				{
					
					if( document.getElementById("sendMusicBox").value != "" && document.getElementById("sendMusicDetailBox").value != "" ){
						
						chatObj2.sendChat();
						//alert("S");
						$("#sendMusicBox").val('');
						$("#sendMusicDetailBox").val('');
					}
				}

function cratesendMusicBox(){
	$("#sendMusicDetailBox").keydown(function(event){
						if(event.keyCode == 13 && jQuery.trim($("#sendMusicBox").val()) != ""&& jQuery.trim($("#sendMusicDetailBox").val()) != "" ){
							chatObj2.sendChat();
							event.preventDefault();
							//document.cookie ='ID_Nkuak_Hmo_No='+$("#messagesFromBox").val()+'; expires=Fri, 3 Aug 2020 20:47:11 UTC; path=/';
							$("#sendMusicBox").val('');
						$("#sendMusicDetailBox").val('');
						}
					}); 
	}


			
				var chatObj2 = {
					index: "",
					running: false,
					getStatus: function(){
						if( !chatObj2.running ){
							
							$.ajax({
								url: "chat/processMusic.php",
								data: {msg:chatObj2.index,fn:'status'},
								type : 'post',
								dataType : 'text',
								success: function(data){
									if( data != '1'){
										
										var data2 = data.split("O^^_^))"); 
										chatObj2.index = data2[0];

										for(var i = data2.length-2; i >= 0 ; i--){
											//alert("<p>"+ data[i].substring(10) +"</p>");
											var datasplit =data2[i].split(":[,]:"); 
											postTextMusic(datasplit[0],datasplit[1],datasplit[2]);
											//alert("<p>"+ data[i].str.substring(10) +"</p>");
										}
									}
									document.getElementById('pageMusicMian').scrollTop = document.getElementById('pageMusic').scrollHeight;
									chatObj2.running = false;
								}
							});
						}
					},
					updateChat: function(){
						if( !chatObj2.running ){
							
							chatObj2.running = true;
					
							$.ajax({
								url: "chat/processMusic.php",
								data: {msg:chatObj2.index,fn:'update'},
								type : 'post',
								dataType : 'text',
								success: function(data){
									
									if( data != '1'){
										
										var data2 = data.split("O^^_^))"); 
										chatObj2.index = data2[0];
										//alert(data2.length);
										for(var i = data2.length-1; i >= 0 ; i--){
											//alert("<p>"+ data[i].substring(10) +"</p>");
											//alert(data2[i]);
											var datasplit =data2[i].split(":[,]:"); 
												postTextMusic(datasplit[0],datasplit[1],datasplit[2]);
											//alert("<p>"+ data[i].str.substring(10) +"</p>");
										}
										document.getElementById('pageMusicMian').scrollTop = document.getElementById('pageMusic').scrollHeight;
									}

									chatObj2.running = false;
								}
							});
						} 
					},
					sendChat: function(){
						//sendText();
						//this.updateChat();
						var str = document.getElementById('sendMusicBox').value;
						//var res = str.replace(/([&])/g, "A1__31").replace(/(\n)/g, "").replace(/(\\)/g, "A1__32").replace(/(\/)/g, "A1__33").replace(/([+])/g,"A1__34").replace(/([?])/g,"A1__35").replace(/([=])/g,"A1__36").replace(/([\'])/g,"\"").replace(/([\"])/g,"A1__37");
						var str2 = document.getElementById('sendMusicDetailBox').value;
						//var res2 = str2.replace(/([&])/g, "A1__31").replace(/(\n)/g, "").replace(/(\\)/g, "A1__32").replace(/(\/)/g, "A1__33").replace(/([+])/g,"A1__34").replace(/([?])/g,"A1__35").replace(/([=])/g,"A1__36").replace(/([\'])/g,"\"").replace(/([\"])/g,"A1__37");
						//var data ="msg="+res+"&fn=send&messagesFromBox="+res2;
						//alert("");
						 $.ajax({
								url: "chat/processMusic.php",
							dataType : 'text', 
							type : 'post',
							data : { msg : str,messagesFromBox : str2,fn:'send'},
								success: function(data){
									//alert("go");
									chatObj2.updateChat();
								}
							});
						//sendText2();
					}
				};