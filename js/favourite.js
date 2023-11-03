function favourite(i,id,id_image){
    let favourite__btn = document.getElementById("favourite__btn_"+i);
    let computedStyle = window.getComputedStyle(favourite__btn);
    let color = computedStyle.color;
    console.log(color);
    if(color === "rgb(255, 0, 0)"){
            favourite__btn.style.color = "white";
            console.log("white");
            //         check_btn[i] = true;
        }else {
            favourite__btn.style.color = "red";
            console.log("red");
    //         check_btn[i] = false;
        }
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
        }
        };
        xhttp.open("GET", "TrangChu.php?i=" + i + "&id=" + id + "&id_image=" + id_image, true);
        xhttp.send();
}