    <!DOCTYPE html>
    <html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    </head>
    <body>

    <form method="post" action="/E_Commercenew/E_Commerce/routes.php?action=add_category">
        <div class="form-group">
            <label for="category_name">Category Name:</label>
            <input type="text" class="form-control" id="category_name" name="category_name" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Category</button>
    </form>
    <button>
    <a href="/E_Commercenew/E_Commerce/views/flow.html" class="button">Back</a>
    </button>
    </body>
    </html>