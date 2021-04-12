<html xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
<head>
    <link rel="stylesheet" href="/css/header.css"/>
    <link rel="stylesheet" href="/css/show-post.css"/>
</head>
<body>
<header class="main-header">
    <div>
        <a href="<?= route('home') ?>" class="brand-name">Sports daily</a>
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
                <?php echo auth()->name; ?>
            </li>
        </ul>
    </nav>
</header>
<main class="main-section">
    <section class="main-content">
        <?= $post->content ?>
    </section>

    <?php if (auth()->isAdmin) : ?>
        <section>
            <form action="<?= route('post/delete') ?>" method="post">
                <button class="delete-button" name="post_id" value="<?= $post->id ?>">Delete</button>
            </form>

            <a href="<?= route('update') ?>?post_id=<?= $post->id ?>" class="edit-button">
                Edit
            </a>
        </section>
    <?php endif; ?>


    <section class="comment-section">

        <h1>Add your comment</h1><br/><br/>

        <form method="post" action="<?= route('post-comments') ?>">
            <textarea rows="2" cols="30" name="comment" placeholder="Add new comments"></textarea>
            <br/><br/>

            <button name="post" value="<?= $post->id ?>">Add Comment</button>
        </form>


        <div class="all_comments">
            <?php foreach ($myComments as $comment) : ?>
                <div class="comment" style="background: #efefef; margin: 10px 0">
                    <div class="body">
                        <?= $comment['comment']; ?>
                    </div>

                    <div class="meta">
                        <small>
                            <?= $comment['name']; ?><span><?= $comment['created_at']; ?></span>
                        </small>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
</main>

</body>
</html>