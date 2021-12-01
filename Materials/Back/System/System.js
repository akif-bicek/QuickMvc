window.onload = function() {
    let asyncImgs = document.getElementsByClassName("async");
    for (let i = 0; i < asyncImgs.length; i++) {
        let src = asyncImgs.item(i).getAttribute("data-src");
        asyncImgs.item(i).setAttribute("src", src);
    }
    let cssAsyncImg = document.getElementsByClassName("css-async");
    for (let x = 0; x < cssAsyncImg.length; x++) {
        let src = cssAsyncImg.item(x).getAttribute("data-src");
        cssAsyncImg.item(x).style.backgroundImage = "url('"+ src +"')";
    }
};