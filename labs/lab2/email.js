var shown = false;
function showhideEmail(){
	if (shown){
		document.getElementById('email').innerHTML = "show my email";
		shown = false;
	}else{

		var myemail = "<a href='mailto:gaddiat"+ "@" +

"ucmail.uc.edu'>gaddiat" + "@" + "ucmail.uc.edu</a>";

document.getElementById('email').innerHTML= myemail;

shown= true;
	}

}