<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <title>Create Article</title>
</head>
<body>
<div class="container">
    <h1 class="mt-5">Create Article</h1>
    <a href="/admin/articles" class="btn btn-primary mb-3">Return</a>
    <form method="post" action="/admin/articles/store">
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" id="title" name="title" class="form-control">
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <textarea id="content" name="content" class="form-control"></textarea>
        </div>
        <div class="mb-3">
            <label for="categories" class="form-label">Categories</label>
            <select id="categories" name="categories[]" class="form-control" multiple>
                <!-- Options will be populated from the database -->
            </select>
            <small class="form-text text-muted">Hold down the Ctrl (windows) / Command (Mac) button to select multiple options.</small>
        </div>
        <div class="mb-3">
            <label for="new_categories" class="form-label">New Categories</label>
            <input type="text" id="new_categories" name="new_categories" class="form-control" placeholder="Enter new categories separated by comma">
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>
</body>
</html>
