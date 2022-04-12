const validateDates = () =>{
    var traveldate = document.getElementById("traveldate");
    var dates = new Date();
    var years = dates.getFullYear();
    var month = dates.getMonth() + 1;
    var day = dates.getUTCDate();
    var fulldate = years+ "-" + month + "-" + day;
    if(traveldate.value.trim() === ""){
        traveldate.style.borderColor = "red";
        return false;
    }else{
        var traveldates = document.getElementById("traveldate").value.trim();
        var dates1 = new Date(traveldates).getTime();
        var today = new Date(fulldate).getTime();
        if(dates1 < today){
           alert("Wrong date please make sure date is not less that today's date");
           return false;
        }else{
            
        }
    }
}
const closeForms = () =>{
     document.getElementById("absolute_form").style.display = "none";
}