function bascule(header) 
{ 
	if (document.getElementById(header).style.visibility == "hidden")
			document.getElementById(header).style.visibility = "visible"; 
	else	document.getElementById(header).style.visibility = "hidden"; 
} 