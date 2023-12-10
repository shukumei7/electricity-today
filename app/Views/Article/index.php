<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <title>Articles</title>
</head>
<body>
<div class="container">
    <h1 class="mt-5">Articles</h1>
    <a href="/admin/articles/create" class="btn btn-primary mb-3">Create New Article</a>
    <?php foreach ($articles as $article): ?>
    <div class="card mb-3">
        <div class="card-body">
            <h2 class="card-title"><?= $article['title'] ?></h2>
            <div class="mb-3" role="group">
                <?php foreach ($article['categories'] as $category): ?>
                <a href="/admin/categories/edit/<?= $category['id'] ?>" class="btn btn-secondary"><?= $category['name'] ?></a>
                <?php endforeach; ?>
            </div>
            <div class="mb-3" role="group">
                <a href="/admin/articles/edit/<?= $article['id'] ?>" class="btn btn-warning">Edit</a>
                <a href="/admin/articles/delete/<?= $article['id'] ?>" class="btn btn-danger">Delete</a>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>
</body>
</html>
