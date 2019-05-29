document.addEventListener('DOMContentLoaded', function() {
    document.querySelector(".newMessage").addEventListener("click", function(){
        var element = document.querySelector(".popupWindow");
        element.classList.toggle("hidden");
    }); 
})


