const sendMessage= () =>{
    var message = document.getElementById("messages");
    if(message.value.trim() === ""){
        return false;
    }
}
const changecolor = () =>{
    var message = document.getElementById("messages").value.trim();
    if(message == ""){
        document.getElementsByClassName("imps")[0].id = "sends";
    }else{
        document.getElementsByClassName("imps")[0].id = "fas";
    }
    setTimeout(changecolor,100);
}
window.onload = changecolor;