function c_report()
{
	document.getElementById("sub_select_chat").style.display = "block";
	document.getElementById("sub_select_event_fm").style.display = "none";	
	document.getElementById("sub_select_subject").style.display = "none";
	document.getElementById('box_messages_chat').scrollTop = document.getElementById('messages_chat_write').scrollHeight;
	document.getElementById("se_chat").style.color = "#78c0b6";
	document.getElementById("se_subject").style.color = "#ffffff";
	document.getElementById("se_entertainment").style.color = "#ffffff";
	document.getElementById("se_event").style.color = "#ffffff";
	document.getElementById("se_report").style.color = "#ffffff";
	se_chat= "#78c0b6";
			 se_subject= "#ffffff";
			 se_entertainment= "#ffffff";
			 se_event= "#ffffff";
			 se_report= "#ffffff";
}