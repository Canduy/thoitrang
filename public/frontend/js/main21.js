		// account
var LoginForm = document.getElementById("LoginForm");
		var RegForm = document.getElementById("RegForm");
		var Ind = document.getElementById("Ind");
				function register(){
					RegForm.style.transform = "translateX(0px)";
					LoginForm.style.transform = "translateX(0px)";
					Ind.style.transform = "translateX(100px)";
				}
				function login(){
					RegForm.style.transform = "translateX(300px)";
					LoginForm.style.transform = "translateX(300px)";
					Ind.style.transform = "translateX(0px)";
				}