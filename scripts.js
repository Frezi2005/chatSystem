document.addEventListener('DOMContentLoaded', function() {
    document.querySelector(".newMessage").addEventListener("click", function(){
        var element = document.querySelector(".popupWindow");
        var body = document.getElementsByTagName("BODY")[0]; 
        element.classList.toggle("hidden");
        //body.classList.toggle("blur");
    }); 
})


