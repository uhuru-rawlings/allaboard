const removeError = (clicked_id) =>{
    document.getElementById(clicked_id).style.borderColor = "#CED4DA";
    document.getElementById("error").style.display = "none"
}
const validateCompany = () =>{
    let compname = document.getElementById("company_name");
    let transport = document.getElementById("transport_mode");
    let description = document.getElementById("company_description");
    if(compname.value.trim() === "" || transport.value.trim() === "" || description.value.trim() === ""){
        if(compname.value.trim() === ""){
           compname.style.borderColor = "red";
           return false;
        }else if(transport.value.trim() === ""){
            transport.style.borderColor = "red";
            return false;
        }else{
            description.style.borderColor = "red";
            return false;
        }
    }
}