<section class="home-page">
    <h2>Üdvözöljük a Web-programozás I. projektoldalán!</h2>
    
    <article class="intro">
        <h3>A projekt bemutatása</h3>
        <p>
            Ez a weboldal a Front-controller tervezési minta alapján készült, 
            biztosítva a dinamikus tartalomkezelést és a reszponzív megjelenést. 
            Az oldal célja a PHP alapú webfejlesztés alapjainak bemutatása.
        </p>
        
        <img src="./images/finom_suti.jpg" alt="Projekt kép" class="intro-img">
    </article>

    <hr>

    <section class="videos">
        <h3>Bemutató videók</h3>
        <div class="video-grid">
            
            <div class="video-box">
                <h4>Saját videónk</h4>
                <video width="100%" controls>
                    <source src="./media/sajat_video.mp4" type="video/mp4">
                    A böngésző nem támogatja a videólejátszást.
                </video>
                <p><small>(Helyi forrásból származó, rövid bemutató)</small></p>
            </div>

            
            <div class="video-box">
                <h4>Külső forrás (YouTube)</h4>
                <div class="iframe-container">
                    <iframe width="100%" height="315" 
                        src="https://www.youtube.com/embed/NHrrADXLxEI"
                        title="YouTube video player" 
                        frameborder="0" 
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                        referrerpolicy="strict-origin-when-cross-origin" 
                        allowfullscreen>
                    </iframe>
                </div>
            </div>
        </div>
    </section>

    <hr>

    <section class="location">
        <h3>Hol találhatóunk?</h3>
        <p>Nyiregyháza közelében lévő cukrászda</p>
        <div class="map-container">
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2725.264251261327!2d19.68962037684063!3d46.9056159367468!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4743da19f85078a1%3A0x400c4290c1e11a0!2zS2Vjc2tlbcOpdCwgVsOhcm9zaM6hemE!5e0!3m2!1shu!2shu!4v1715174000000!5m2!1shu!2shu" 
                width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
    </section>
</section>