document.addEventListener('DOMContentLoaded', function() {
    document.querySelector(".newMessage").addEventListener("click", function(){
        var element = document.querySelector(".popupWindow");
        var blur = document.getElementById("blur"); 
        element.classList.toggle("hidden");
        blur.classList.toggle("blur");
    }); 
})


