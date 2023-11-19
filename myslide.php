<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
.mySlides {
    display: none;
    width: 100%;
    height: 40vh; /* 40% de la hauteur de la vue (viewport height) */
    object-fit: cover;
}
</style>
    <title>Document</title>
</head>
<body>
<img class="mySlides" src="image/OIP (2).jpg">
<img class="mySlides" src="image/OIP (3).jpg">
<img class="mySlides" src="image/OIP (4).jpg">
<img class="mySlides" src="image/OIP (5).jpg">
<img class="mySlides" src="image/OIP (6).jpg">
<img class="mySlides" src="image/OIP (7).jpg">
<img class="mySlides" src="image/OIP (8).jpg">
<img class="mySlides" src="image/OIP (9).jpg">
    <script>
        var slideIndex = 0;
        carousel();

        function carousel() {
        var i;
        var x = document.getElementsByClassName("mySlides");
        for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";
        }
        slideIndex++;
        if (slideIndex > x.length) {slideIndex = 1}
        x[slideIndex-1].style.display = "block";
        setTimeout(carousel, 3000); // Change image every 3 seconds
    }
    </script>  
</body>
</html>





