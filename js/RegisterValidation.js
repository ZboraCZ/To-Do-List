function submitRegisterForm(){
	username = document.getElementById("username");
$.ajax({
    type: "POST",
    url: "php/RegisterUser.php",	//"ajax/request.html"
    data: "username="+username,
    dataType:'JSON', 
    success: function(response){
		console.log(response);
		var myObj = response;/*JSON.parse(*//*)*/
        document.getElementById("error_message").innerHTML = myObj.name;
        // put on console what server sent back...
    }
});
}
