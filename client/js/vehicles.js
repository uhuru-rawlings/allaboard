const removeError = (clicked_id) =>{
    document.getElementById(clicked_id).style.borderColor = "#CED4DA";
}
const validateVehicles = () =>{
    let numberplate = document.getElementById("numberplate");
    let cartype = document.getElementById("cartype");
    let drivername = document.getElementById("drivername");
    let licence = document.getElementById("licence");

    if(numberplate.value.trim() === "" || cartype.value.trim() === "" || drivername.value.trim() === "" || licence.value.trim() ===""){
        if(numberplate.value.trim() === "" ){
            numberplate.style.borderColor = "red";
            return false;
        }else if(cartype.value.trim() === ""){
            cartype.style.borderColor = "red";
            return false;
        }else if(drivername.value.trim() === ""){
           drivername.style.borderColor = "red";
           return false;
        }else{
           licence.style.borderColor ="red";
           return false;
        }
    }
}