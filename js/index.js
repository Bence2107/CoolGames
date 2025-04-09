//index page scroll to about
const aboutBtn = document.querySelector(".wallpaper_content button");
const about = document.getElementById("about");
const header = document.querySelector("header");
let headerHeight = header.getBoundingClientRect().height;
aboutBtn.addEventListener("click", () => {

    let position = about.offsetTop-headerHeight;
    window.scrollTo({
        left:0,
        top: position,
    })
});

//index page aboutUs table display
const aboutUs = document.getElementById("aboutUs");
const tableDisplay = document.querySelector(".content table");
let clicks = 0;
aboutUs.addEventListener("click", () => {
    if(clicks === 0){
        tableDisplay.style.display = "table";
        tableDisplay.style.animationName = "fadeIn";
        tableDisplay.style.animationDuration = "2s";
        let position = tableDisplay.offsetTop-headerHeight;
        window.scrollTo({
            left:0,
            top: position,
        });
        clicks++;
    }
    else{
        tableDisplay.style.animationName = "fadeOut";
        tableDisplay.style.animationDuration = "1s";
        setTimeout(() => {
            tableDisplay.style.display = "none";
        }, 900);
        clicks--;
    }
});
