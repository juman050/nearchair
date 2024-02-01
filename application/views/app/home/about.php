<section class="nc-section">
    <div class="container">
        <header class="section-title">
            <h1>ABOUT US</h1>
        </header>
        <?php 
           $about_us = $system_data->about_us;
           echo html_entity_decode($about_us);
        ?>
    </div>
</section>