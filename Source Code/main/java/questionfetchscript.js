var likeButton=document.querySelector('.liked');
var dislikeButton=document.querySelector('.disliked');
likeButton.addEventListener("click",function(){
	var value = questionParticular.textContent.split(" ")[1];
	sr = 'questionvotes.php';
	sr+='?val='+value+'&act=1';
	window.location.href=sr;
})
dislikeButton.addEventListener("click",function(){
	var value = questionParticular.textContent.split(" ")[1];
	sr = 'questionvotes.php';
	sr+='?val='+value+'&act=0';
	window.location.href=sr;
})
var questionParticular = document.querySelector('#quesdisplay');