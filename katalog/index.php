<!DOCTYPE html>
<html lang="tr-TR">
<title>Sanat Etkinliği</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
    body,h1,h2,h3,h4,h5,span{font-family: "Raleway", sans-serif}
    .w3-third img{margin-bottom: -6px; cursor: pointer}
    .w3-third img:hover{opacity: 0.8}
    #iletisim .fa {
        padding: 20px;
        font-size: 30px;
        width: 30%;
        text-align: left;
        text-decoration: none;
        margin: 5px 2px;
        border-radius: 2%;
    }

    #iletisim .fa:hover {
        opacity: 0.7;
    }

    .fa-facebook {
        background: #3B5998;
        color: white;
    }
    .fa-instagram {
        background: #4c68d7;
        color: white;
    }
    #iletisim .fa-whatsapp {
        background: #25d366;
        color: white;
    }

    .float{
        position:fixed;
        width:213px;
        bottom:40px;
        right:20px;
        background-color:#25d366;
        color:#FFF;
        border-radius:50px;
        text-align:left;
        font-size:28px;
        box-shadow: 2px 2px 3px #999;
        z-index:100;
    }

    .my-float{
        margin-left: 16px;
    }
    .my-float span{
        font-size: 18px;
    }
    @media only screen and (max-width: 600px) {
        #iletisim .fa {
            width: 100%;
        }
    }
</style>
<body class="w3-light-grey w3-content" style="max-width:1600px">

<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-bar-block w3-white w3-animate-left w3-text-grey w3-collapse w3-top w3-center" style="z-index:3;width:300px;font-weight:bold" id="mySidebar"><br>
    <h3 class="w3-padding-64 w3-center"><b>SANAT<br>ETKİNLİĞİ</b></h3>
    <a href="javascript:void(0)" onclick="w3_close()" class="w3-bar-item w3-button w3-padding w3-hide-large">KAPAT</a>
    <a href="#" onclick="w3_close()" class="w3-bar-item w3-button">Katalog</a>
    <a href="#iletisim" onclick="w3_close()" class="w3-bar-item w3-button">İletişim</a>
</nav>

<!-- Top menu on small screens -->
<header class="w3-container w3-top w3-hide-large w3-white w3-xlarge w3-padding-16">
    <span class="w3-left w3-padding">SANAT ETKİNLİĞİ</span>
    <a href="javascript:void(0)" class="w3-right w3-button w3-white" onclick="w3_open()">☰</a>
</header>

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px">

    <!-- Push down content on small screens -->
    <div class="w3-hide-large" style="margin-top:83px"></div>

    <!-- Photo grid -->
    <div class="w3-row">
        <div class="w3-third">
            <?php
            $i = 1;
            while ($i <= 11){
                echo '<img src="resimler/'. $i .'.jpeg" style="width:100%" onclick="onClick(this)" alt="Sanat Etkinliği">';
                $i++;
            }
            ?>
        </div>

        <div class="w3-third">
            <?php
            while ($i <= 22){
                echo '<img src="resimler/'. $i .'.jpeg" style="width:100%" onclick="onClick(this)" alt="Sanat Etkinliği">';
                $i++;
            }
            ?>
        </div>

        <div class="w3-third">
            <?php
            while ($i <= 34){
                echo '<img src="resimler/'. $i .'.jpeg" style="width:100%" onclick="onClick(this)" alt="Sanat Etkinliği">';
                $i++;
            }
            ?>
        </div>
    </div>
    <!-- Modal for full size images on click-->
    <div id="modal01" class="w3-modal w3-black" style="padding-top:0" onclick="this.style.display='none'">
        <span class="w3-button w3-black w3-xlarge w3-display-topright">×</span>
        <div class="w3-modal-content w3-animate-zoom w3-center w3-transparent w3-padding-64">
            <img id="img01" class="w3-image">
            <p id="caption"></p>
        </div>
    </div>
    <!-- Contact section -->
    <div class="w3-container w3-dark-grey w3-center w3-text-light-grey w3-padding-32" id="iletisim">
        <h4><b>İletişim</b></h4>
        <hr class="w3-opacity">
        <h4>Sosyal Medya Hesapları</h4>
        <a href="https://www.facebook.com/gorsel.sanatlar.3939" class="fa fa-facebook"><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbspGörsel Sanatlar</span></a>
        <a href="https://www.instagram.com/sanat__etkinligi/" class="fa fa-instagram"><span>&nbsp;&nbsp;&nbsp;&nbsp;sanat__etkinliği</span></a>
        <a href="https://api.whatsapp.com/send?phone=905423969555" class="fa fa-whatsapp"><span>&nbsp;&nbsp;&nbsp;&nbsp;+90 542 396 95 55</span></a>
        <hr class="w3-opacity">
        <h4>Telefon</h4>
        <p><b>Hayrettin ERSAYAR</b> <br /> <a href="tel:+905423969555">+90 542 396 95 55</a></p>
        <h4>Adres</h4>
        <p>Şabaniye Mah. Hasan Bey Cad. No:185 Edremit/VAN</p>
    </div>

    <!-- Footer -->
    <div class="w3-black w3-center w3-padding-24"><a href="https://sanatetkinligi.com/" title="Sanat Etkinliği" target="_blank" class="w3-hover-opacity">sanatetkinligi.com</a></div>
    <!-- End page content -->
</div>
<a href="https://api.whatsapp.com/send?phone=905423969555" class="float" target="_blank">
    <i class="fa fa-whatsapp my-float"> <span>+90 542 396 95 55</span></i>
</a>
<script>
    // Script to open and close sidebar
    function w3_open() {
        document.getElementById("mySidebar").style.display = "block";
        document.getElementById("myOverlay").style.display = "block";
    }

    function w3_close() {
        document.getElementById("mySidebar").style.display = "none";
        document.getElementById("myOverlay").style.display = "none";
    }

    // Modal Image Gallery
    function onClick(element) {
        document.getElementById("img01").src = element.src;
        document.getElementById("modal01").style.display = "block";
        var captionText = document.getElementById("caption");
        captionText.innerHTML = element.alt;
    }

</script>


</body>
</html>
