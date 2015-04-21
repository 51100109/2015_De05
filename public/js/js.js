//COMMENT
//

function postComment(idUser, isSoftware,idTarget,url) {
	var content = document.getElementById("commentBox").value;
	if (content.length == 0)
	{
		return;
	}
	var target = 1;
	if (isSoftware == 0)
	{
		target = 2;
	}
	
	var postStr = "id_user=" + idUser + "&content=" + content + "&target=" + target + "&id_target="+idTarget;
	
	var xmlhttp;
	if (window.XMLHttpRequest)
	  {// code for IE7+, Firefox, Chrome, Opera, Safari
	  xmlhttp=new XMLHttpRequest();
	  }
	else
	  {// code for IE6, IE5
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }

	xmlhttp.onreadystatechange=function()
	  {
	  if (xmlhttp.readyState==4 && xmlhttp.status==200)
	    {
//		  alert(xmlhttp.responseText);
		  location.reload(true);
	    }
	  }
	
	xmlhttp.open("POST",url,true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send(postStr);
	
	document.getElementById("commentBox").value = "";
}

function deleteComment(url)
{
	var xmlhttp;
	if (window.XMLHttpRequest)
	  {// code for IE7+, Firefox, Chrome, Opera, Safari
	  xmlhttp=new XMLHttpRequest();
	  }
	else
	  {// code for IE6, IE5
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }

	xmlhttp.onreadystatechange=function()
	  {
	  if (xmlhttp.readyState==4 && xmlhttp.status==200)
	    {
//		  alert(xmlhttp.responseText);
		  location.reload(true);
	    }
	  }
	
	xmlhttp.open("GET",url,true);
	xmlhttp.send();
}


//End comment