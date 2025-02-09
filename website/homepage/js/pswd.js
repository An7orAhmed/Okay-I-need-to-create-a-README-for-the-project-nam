var inputPswd = document.getElementById("pswd");
var gobtn = document.getElementById("psgo");
var pid = document.getElementById("pid");
var frm = document.getElementById("form");
var fa = document.getElementById("find");

  var PASSWORD = "billy";
  var PAINTENTID = "antor";

/*inputPswd.onfocus = function() {
document.getElementById("message").style.display = "block";
}
inputPswd.onblur = function() {
	 document.getElementById("message").style.display = "none";
}*/

gobtn.onclick = function() {

  if(inputPswd.value==PASSWORD && pid.value==PAINTENTID) {  
    document.getElementById("info").style.display = "block";
    document.getElementById("message").style.display = "none";
    form.style.display="none";
    localStorage.setItem('IOTHlogin','1');
  } 
  else{
  	document.getElementById("message").style.color = "red";
    document.getElementById("message").style.display = "block";
  }
  }
 fa.onclick = function(){
    window.location.reload();
   localStorage.clear();
 }
 function isLogin(){
  if(localStorage.getItem('IOTHlogin')==1){
    document.getElementById("info").style.display = "block";
    document.getElementById("message").style.display = "none";
    form.style.display="none";}
 }