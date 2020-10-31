// $(document).ready(function(){
// 	$("#bodi").one("load",getLocation);
// })
// function getLocation() {
// if (navigator.geolocation) {
// 	flag=0;
//     navigator.geolocation.getCurrentPosition(showPosition);
//   }
// }
// function showPosition(position) {
//    var srcloc="locationphp.php?lat="+ position.coords.latitude + 
//   "&long=" + position.coords.longitude;
//   alert(srcloc);
//   window.location.href=srcloc; 
// }
var questionSelect = document.querySelectorAll("#quesdisp");
var questionPanel = document.querySelector("#questions");
var answerPanel = document.querySelector("#answers");
for(var item of questionSelect){
	item.addEventListener("click",function(){
		var value = this.textContent.split(" ")[1];
		sr = 'questionfetch.php';
		sr+='?val='+value+'&msg=0';
		window.location.href=sr;
	})
}
var localChat = document.querySelector("#chatroom");
var localMessage = document.querySelector("#chatmessage");
var localMessageClose = document.querySelector("#chatmsgclose");
var messageText = document.querySelector("#messagetext");
var messageTrash = document.querySelector("#trashbutton");
var messageSend = document.querySelector("#sendbutton");
var messageForm = document.querySelector("#messagesend");
localChat.addEventListener("click",function(){
	localChat.style.display="none";
	localMessage.style.display="block";
})
localMessageClose.addEventListener("click",function(){
	localChat.style.display="block";
	localMessage.style.display="none";
})
messageTrash.addEventListener("click",function(){
	messageText.value="";
})
messageSend.addEventListener("click",function(){
	var url = "dashboard.php?msg=1&messagedata=";
	if(messageText.value.length>0){
	url=url+messageText.value;
	window.location.href=url;
}
else{
	window.location.href="dashboard.php?msg=0"
}
})
var menuToggle= document.querySelector(".menu-hamb");
var overlay = document.querySelector(".overlay");
var overlayMenu = document.querySelector(".overlay-menu");
menuToggle.addEventListener("click",function(){
	menuToggle.classList.toggle("change");
	overlayMenu.classList.toggle("show");
	overlay.classList.toggle("show");
})
myprofileContent = document.querySelector("#myprofile");
myprofile = document.querySelector("#myprofiletag");
menuques = document.querySelector("#menu-question");
menutop = document.querySelector("#menu-top");
menusearch = document.querySelector("#menu-search");
menuevent = document.querySelector("#menu-event");
askQuestions = document.querySelector("#askquestions");
topVotes = document.querySelector("#topvotes");
menuques.addEventListener("click",function(){
	questionPanel.style.display="block";
	askQuestions.style.display="block";
	topVotes.style.display="none";
	myprofileContent.style.display="none";
})
myprofile.addEventListener("click",function(){
	questionPanel.style.display="none";
	askQuestions.style.display="none";
	topVotes.style.display="none";
	myprofileContent.style.display="block";	
})
menutop.addEventListener("click",function(){
	questionPanel.style.display="none";
	askQuestions.style.display="none";
	topVotes.style.display="block";
	myprofileContent.style.display="none";
})
menusearch.addEventListener("click",function(){
	window.location.href="search.php"	
})
// menuevent.addEventListener("click",function(){
// 	questionPanel.style.display="none";
// 	askQuestions.style.display="none";
// 	topVotes.style.display="none";
// 	myprofileContent.style.display="none";
// })
