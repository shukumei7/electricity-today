<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <title>Edit Article</title>
</head>
<body>
<div class="container">
    <h1 class="mt-5">Edit Article</h1>
    <a href="/admin/articles" class="btn btn-primary mb-3">Return</a>
    <form method="post" action="/admin/articles/update/<?= $article['id'] ?>">
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" id="title" name="title" value="<?= $article['title'] ?>" class="form-control">
        </div>
        <div class="mb-3">
            <label for="author" class="form-label">Author</label>
            <input type="text" id="author" name="author" value="<?= $article['author'] ?>" class="form-control">
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="text" id="author" name="image" value="<?= $article['image'] ?>" class="form-control">
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <textarea id="content" name="content" class="form-control"><?= $article['content'] ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
</body>
</html>
