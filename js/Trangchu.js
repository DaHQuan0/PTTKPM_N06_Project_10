let check = false;  
// var rect = element.getBoundingClientRect();

function click_btn_menu(){
    let main = document.getElementById("main");
    let menu = document.getElementById("menu");
    let bgrmain = document.getElementById("bgr-main");
    let translate = document.getElementsByClassName("translate");
    if(check == true){
        check = false;
        menu.style.transform = "translateX(-256px)";
        // main.style.setProperty('--margin-left','0px')
        for(let i = 0 ; i < translate.length;i++){
            translate[i].style.animationDuration = "0.5s";
            translate[i].style.animationName = "example";
        }                
        bgrmain.style.display = "none";
    }
    else if(check== false){
        check = true;
        menu.style.transform = "translateX(0)";
        // main.style.setProperty('--margin-left','256px')

        for(let i = 0 ; i < translate.length;i++){
            translate[i].style.animationDuration = "1s";
            translate[i].style.animationName = "example1";
            
        }
        bgrmain.style.display = "block";
        bgrmain.style.opacity = 0.8;
    }

}


