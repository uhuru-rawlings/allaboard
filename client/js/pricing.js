const validatePricing = () =>{
    var locationfrom = document.getElementById("fromlocation");
    var locationto = document.getElementById("tolocation");
    var pricing = document.getElementById("price");

    if(locationfrom.value.trim() === "" || locationto.value.trim() === "" || pricing.value.trim() === ""){
       if(locationfrom.value.trim() === ""){
           locationfrom.style.borderColor = "red";
           return false;
       }else if(locationto.value.trim() === ""){
           locationto.style.borderColor = "red";
           return false;
       }else{
          pricing.style.borderColor = "red";
          return false;
       }
    }else if(pricing.value.trim() < 10){
        pricing.style.borderColor = "red";
        return false;
    }else{
        return true;
    }
}
const removeError = (clicked_id) =>{
    document.getElementById(clicked_id).style.borderColor = "#CED4DA";
    document.getElementById("error").style.display = "none"
}
const validateCompany = () =>{
    let compname = document.getElementById("");
    let compname = document.getElementById("");
    let compname = document.getElementById("");
}