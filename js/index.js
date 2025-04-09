const aboutUS = document.getElementById("aboutUs");
const tableDisplay = document.querySelector(".content table");
let clicks = 0;
aboutUS.addEventListener("click", () => {
    if(clicks === 0){
        tableDisplay.style.display = "table";
        tableDisplay.style.animation = "fadeIn";
        tableDisplay.style.animationDuration = "2s";
        tableDisplay.scrollIntoView();
        clicks++;
    }
    else{
        tableDisplay.style.animation = "fadeOut";
        tableDisplay.style.animationDuration = "1s";
        setTimeout(() => {
            tableDisplay.style.display = "none";
        }, 900);
        clicks--;
    }
    
});
 