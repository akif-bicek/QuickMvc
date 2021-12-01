<section id="primary" class="content-full-width"><!-- **Primary Starts Here** -->
    <div class="fullwidth-section"><!-- Full-width section Starts Here -->
        <div class="container">
            <div class="dt-sc-hr-invisible-small"></div>
            <div class="main-title">
                <h3> İletişim </h3>
                <p>Bizden daha fazla bilgi almak için veya görüşleriniz için lütfen iletişime geçiniz.</p>
            </div>
            <div class="dt-sc-hr-invisible-small">
                <?php echo decodeSecurity($contactContent);?>
            </div>
        </div>

        <div class="contact-section"><!-- **contact-section Starts Here** -->
            <div id="contact_map">
                <iframe src="https://www.google.com/maps/embed?pb=<?php echo $map; ?>" width="800" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
            <div class="dt-sc-contact-info">
                <h3>İletişim</h3>
                <div class="dt-sc-contact-details"><span class="fa fa-map-marker"></span> Adres: <?php echo $address; ?> </div>
                <div class="dt-sc-contact-details"><span class="fa fa-tablet"></span> Telefon: <?php echo $phone; ?> </div>
                <div class="dt-sc-contact-details"><span class="fa fa-envelope"></span> Email: <a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a> </div>
                <ul class="type3 dt-sc-social-icons">
                    <?php foreach (falseToArray($socials) as $social): ?>
                        <li class="<?php echo $social["Name"] ;?>"><a style="background-color: <?php echo decodeSecurity($social["BackgroundColor"]); ?>"  href="<?php echo $social["Link"] ;?>"> <?php echo decodeSecurity($social["Icon"]); ?> </a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div><!-- **contact-section Ends Here** -->
        <div class="dt-sc-hr-invisible-toosmall"></div>
        <div class="container">
            <div class="dt-sc-three-fourth column first animate" data-animation="fadeInDown" data-delay="100">
                <h3>Mesaj Gönder</h3>
                <form id="commentform" action="messagePost" method="post" novalidate="novalidate" name="enqform">
                    <input type="hidden" name="type" value="1">
                    <div class="column dt-sc-one-third first">
                        <p class="input-text">
                            <input class="input-field" type="text" required="" name="name" title="Lütfen Adınızı Giriniz" placeholder="Adınız *">
                        </p>
                    </div>
                    <div class="column dt-sc-one-third">
                        <p class="input-text">
                            <input class="input-field" type="email" required="" autocomplete="off" name="email" title="Lütfen Email Giriniz" placeholder="Emailiniz *">
                        </p>
                    </div>
                    <div class="column dt-sc-one-third">
                        <p class="input-text">
                            <input class="input-field" type="text" required="" name="phone" autocomplete="off" title="Lütfen Telefon Numarası Giriniz" placeholder="Telefonunuz *">
                        </p>
                    </div>
                    <p class="input-text">
                        <textarea class="input-field" required="" rows="3" cols="5" name="message" title="Lütfen Mesajınızı Giriniz" placeholder="Mesaj *"></textarea>
                    </p>

                    <p class="submit"> <input type="submit" value="Mesaj Gönder" name="submit" class="button"> </p>
                </form>
                <div id="ajax_contactform_msg"></div>
            </div>
        </div>
    </div><!-- Full-width section Ends Here -->
</section><!-- **Primary Ends Here** -->