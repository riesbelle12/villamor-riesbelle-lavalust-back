<?php
$products = isset($products) && is_iterable($products) ? $products : [];
$escape = static function ($value) {
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
};
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <style><?php require __DIR__ . '/../../../public/assets/css/dahlia.css'; ?></style>
</head>
<body class="dahlia-page">
    <main class="dahlia-shell">
        <header class="dahlia-header">
            <div>
                <p class="dahlia-kicker">Dahlia collection</p>
                <h1>Products</h1>
                <p class="dahlia-subtitle">A bright little inventory garden, ready to grow.</p>
            </div>
            <div class="dahlia-actions">
                <a class="dahlia-button" href="<?= $escape(site_url('/products/create')) ?>">+ Create product</a>
                <a class="dahlia-button secondary" href="<?= $escape(site_url('/logout')) ?>">Logout</a>
            </div>
        </header>

        <section class="dahlia-card">
            <p class="dahlia-meta">Signed in as <strong><?= $escape($_SESSION['username'] ?? '') ?></strong></p>
            <?php if (empty($products)) : ?>
                <p class="dahlia-empty">No products found yet.</p>
            <?php else : ?>
            <div class="dahlia-table-wrap">
                <table>
            <thead>
                <tr><th>ID</th><th>Name</th><th>Description</th><th>Price</th><th>Quantity</th><th>Actions</th></tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product) : ?>
                    <?php
                    $id = is_object($product) ? ($product->id ?? '') : ($product['id'] ?? '');
                    $name = is_object($product) ? ($product->product_name ?? '') : ($product['product_name'] ?? '');
                    $description = is_object($product) ? ($product->description ?? '') : ($product['description'] ?? '');
                    $price = is_object($product) ? ($product->price ?? '') : ($product['price'] ?? '');
                    $quantity = is_object($product) ? ($product->quantity ?? '') : ($product['quantity'] ?? '');
                    ?>
                    <tr>
                        <td><?= $escape($id) ?></td>
                        <td><?= $escape($name) ?></td>
                        <td><?= $escape($description) ?></td>
                        <td><?= $escape($price) ?></td>
                        <td><?= $escape($quantity) ?></td>
                        <td>
                            <a href="<?= $escape(site_url('/products/edit/' . $id)) ?>">Edit</a>
                            <a href="<?= $escape(site_url('/products/delete/' . $id)) ?>">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
                </table>
            </div>
            <?php endif; ?>
        </section>
    </main>
</body>
</html>