
function imgURL() {
				var person = prompt("ใส่ URL ของรูปภาพ", valueOfURL);
				if (person != null) {
					valueOfURL = person;
					setCookie();
				}
			}
			