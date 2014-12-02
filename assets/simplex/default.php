<?php
if(!defined('FACILE')) {die('Sorry direct access to this file not allowed');}

include_facile('header',[
    'title' => $title,
    'meta_description'  => $meta_description,
    'meta_keywords'     => $meta_keywords
]);


?>

    <header>
        <div class="site-image">
            <img src="<?=@$site_img;?>" alt="That would be I.">
        </div>

        <h1 class="site-title"><?=@$site_title;?></h1>
        <p class="site-description"><?=@$site_description;?></p>
        <hr>
    </header>

    <div class="justify-text">

        <section>
            <?=@$section_who;?>
        </section>
        <section>
            <?=@$section_what;?>
        </section>

        <section>
            <?=@$section_projects;?>
        </section>
    </div>



<?php include_facile('footer'); ?>