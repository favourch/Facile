<?php
if(!defined('FACILE')) {die('Sorry direct access to this file not allowed');}

include_facile('header',[
    'title' => $title,
    'meta_description'  => $meta_description,
    'meta_keywords'     => $meta_keywords
]);
?>

<section>
    <?=@$content;?>
</section>



<?php include_facile('footer'); ?>