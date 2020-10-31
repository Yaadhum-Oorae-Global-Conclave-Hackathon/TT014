var loginclick=document.querySelector('#dropbtn1');
var signupclick=document.querySelector("#dropbtn2");
var videoback=document.querySelector("#fullScreenDiv");
var loginform=document.getElementById("formlogin");
var signupform=document.getElementById("formsignup");
var logredsign=document.querySelector("#logredirectsign");
loginclick.addEventListener("click",function(){
	videoback.style.display="none";
	loginform.style.display="block";
});
signupclick.addEventListener("click",function(){
	videoback.style.display="none";
	signupform.style.display="block";
})
logredsign.addEventListener("click",function(){
	videoback.style.display="none";
	loginform.style.display="none";
	signupform.style.display="block";	
})