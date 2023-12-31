<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Edit Category</title>
</head>
<body>
<div class="container">
    <h1 class="mt-5">Edit Category</h1>
    <form method="post" action="/admin/categories/update/<?= $category['id'] ?>">
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" id="name" name="name" value="<?= $category['name'] ?>" class="form-control">
        </div>
        <div class="mb-3">
            <label for="sort" class="form-label">Sort</label>
            <input type="number" id="sort" name="sort" value="<?= $category['sort'] ?>" class="form-control" min="0" max="99" step="1">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
</body>
</html>
