const showless = (clickedids) =>{
    document.getElementsByClassName(clickedids)[0].style.display = "none";
    document.getElementById("detailed").innerText = "show more...";
}

const showmore = (clickedid2) =>{
    document.getElementsByClassName(clickedid2)[0].style.display = "block";
    document.getElementById("detailed").innerText = "show less...";

}