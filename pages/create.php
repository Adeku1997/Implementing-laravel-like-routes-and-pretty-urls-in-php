<!Doctype html>
<html>
<head>
    <title></title>

    <link rel="stylesheet" href="/css/header.css"/>
    <link rel="stylesheet" href="/css/create.css"/>

</head>

<body>

<header class="main-header">
    <div>
        <a href="<?=route('home')?>" class="brand-name">Sports daily</a>
    </div>

    <nav class="main-nav">
        <ul class="main-nav__items">
            <li class="main-nav__item">
                <a href="<?= route('post') ?>">Add-Posts</a>
            </li>
            <li class="main-nav__item">
                <form action="<?= route('logout')?>" method="post">
                    <button>logout</button>
                </form>
            </li>
            <li class="main-nav__item">
                <?php echo auth()->name; ?>
            </li>
        </ul>
    </nav>
</header>

 <section class="create-form__section">
    <form method="Post" action="">
        <label>Title</label>
        <input type="text" name="title" value=""><?=$errors['title'] ?? "" ?><br/><br/>

        <textarea rows="10" cols="50" name="content"></textarea>
        <?=$errors['content'] ?? "" ?><br/><br/>


        <button type="submit" class="button">Add-Post</button>
    </form>
 </section>



</div>
</body>
</html>
