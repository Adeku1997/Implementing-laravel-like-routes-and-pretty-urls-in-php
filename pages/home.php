<!Doctype html>
<html>
<head>
    <title></title>
    <link rel="stylesheet" href="/css/header.css"/>
    <link rel="stylesheet" href="/css/home.css"/>
</head>
<body>

<header class="main-header">
    <div>
        <a href="#" class="brand-name">Sports daily</a>
    </div>

    <nav class="main-nav">
        <ul class="main-nav__items">

            <li class="main-nav__item">
                <?php if (auth()->isAdmin) : ?>
                   <a href="<?= route('post') ?>">Add-Posts</a>
                <?php endif;?>
            </li>



            <li class="main-nav__item">
                <form action="<?= route('logout')?>" method="post">
                    <button>logout</button>
                </form>
            </li>

            <li class="main-nav__item">
                 <?= auth()->name ?>
            </li>
        </ul>
    </nav>
</header>



<article class="main-article__section">
   <ul class="article-lists">
      <?php foreach ($posts as $post): ?>
          <li class="article-list">
             <a href="<?= route('show-post') ?>?post_id=<?= $post['id'] ?>">
                <?= $post['title'] ?>
             </a>
          </li>
      <?php endforeach; ?>
    </ul>
</article>
</body>
</html>