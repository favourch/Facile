<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?=htmlentities(@$title);?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="http://sharif.co/favicon.ico">
    <?=link_to_asset('css',['css/styles.css']);?>
</head>
<body>

<div class="wrapper center-text">
    <header>

        <h1 class="site-title"><?=@$header;?></h1>
        <p class="site-description"><?=@$body;?></p>
        <hr>
    </header>
    <div class="justify-text">

        <section>
            <p><a href="/"> Try home </a></p>
        </section>

    </div>

</div>

</body>
</html>