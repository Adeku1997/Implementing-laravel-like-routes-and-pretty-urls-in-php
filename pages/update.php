<!Doctype html>
<html>
<head>
    <title></title>

    <link rel="stylesheet" href="css/header.css">
</head>

<body>
<form method="Post" action="<?= route('update') ?>?post_id=<?= $article['id'] ?>">
    <label>Title</label>
    <input type="text" name="title" value="<?= $field['title'] ?? $article['title'] ?>">
    <?=$errors['title'] ?? "" ?>
    <br/><br/>

    <textarea rows="10" cols="50" name="content" ></textarea>
    <?=$errors['content'] ?? "" ?><br/><br/>

    <button type="submit">Edit-Post</button>
</form>



</body>
</html>
