const showForms = (clicked_id) =>{
    var id1 = "history";
    var id2 = "password";
    var id3 = "username";
    var id4 = "photos";
    var id5 = "travel";
    var showhistory = document.getElementById("showhistory");
    var resetpassword = document.getElementById("resetpassword");
    var changeusername = document.getElementById("changeusername");
    var changephoto = document.getElementById("changephoto");
    var canceltravel = document.getElementById("canceltravel");
    if(clicked_id === id1){
        showhistory.style.display = "block";
        resetpassword.style.display = "none";
        changeusername.style.display = "none";
        changephoto.style.display = "none";
        canceltravel.style.display = "none";
    }else if(clicked_id === id2){
        showhistory.style.display = "none";
        resetpassword.style.display = "block";
        changeusername.style.display = "none";
        changephoto.style.display = "none";
        canceltravel.style.display = "none";
    }else if(clicked_id === id3){
        showhistory.style.display = "none";
        resetpassword.style.display = "none";
        changeusername.style.display = "block";
        changephoto.style.display = "none";
        canceltravel.style.display = "none";
    }else if(clicked_id === id4){
        showhistory.style.display = "none";
        resetpassword.style.display = "none";
        changeusername.style.display = "none";
        changephoto.style.display = "block";
        canceltravel.style.display = "none";
    }else if(clicked_id === id5){
        showhistory.style.display = "none";
        resetpassword.style.display = "none";
        changeusername.style.display = "none";
        changephoto.style.display = "none";
        canceltravel.style.display = "block";
    }
}

const validatePricing = () =>{
    let fromlocation = document.getElementById("fromlocation");
    let tolocation = document.getElementById("tolocation");
    if(fromlocation.value.trim() === "" || tolocation.value.trim() === "" ){
        if(fromlocation.value.trim() === ""){
            fromlocation.style.borderColor = "red";
            return false;
        }else if(tolocation.value.trim() === ""){
            tolocation.style.borderColor = "red";
            return false;
        }
    }
}

const removeErrors = (clicked) =>{
    document.getElementById(clicked).style.borderColor = "#98BEF5"
}


const validateDelete = () =>{
    var input = document.getElementById("deletetravel");
    if(input.value.trim() === ""){
        input.style.borderColor = "red";
        return false;
    }
}

const showless = (clickedids) =>{
    document.getElementsByClassName(clickedids)[0].style.display = "none";
    document.getElementById("detailed").innerText = "show more...";
}

const showmore = (clickedid2) =>{
    document.getElementsByClassName(clickedid2)[0].style.display = "block";
    document.getElementById("detailed").innerText = "show less...";

}