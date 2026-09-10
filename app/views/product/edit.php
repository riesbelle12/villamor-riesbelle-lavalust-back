<?php
$escape = static function ($value) {
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
};
$value = static function ($key) use ($product) {
    return is_object($product) ? ($product->{$key} ?? '') : ($product[$key] ?? '');
};
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <style><?php require __DIR__ . '/../../../public/assets/css/dahlia.css'; ?></style>
</head>
<body class="dahlia-page">
    <main class="dahlia-shell">
        <header class="dahlia-header"><div><p class="dahlia-kicker">Dahlia collection</p><h1>Refresh product</h1></div><div class="dahlia-flower" aria-hidden="true">✿</div></header>
        <section class="dahlia-card">
            <?php if (!empty($error)) : ?><p class="dahlia-error"><?= $escape($error) ?></p><?php endif; ?>
            <form class="dahlia-form" method="post" action="<?= $escape(site_url('/products/edit/' . $value('id'))) ?>">
                <label>Name <input name="product_name" type="text" value="<?= $escape($value('product_name')) ?>" required></label>
                <label>Description <textarea name="description"><?= $escape($value('description')) ?></textarea></label>
                <label>Price <input name="price" type="number" min="0" step="0.01" value="<?= $escape($value('price')) ?>" required></label>
                <label>Quantity <input name="quantity" type="number" min="0" step="1" value="<?= $escape($value('quantity')) ?>" required></label>
                <div class="dahlia-actions"><button type="submit">Update product</button><a class="dahlia-button secondary" href="<?= $escape(site_url('/products')) ?>">Back to products</a></div>
            </form>
        </section>
    </main>
</body>
</html>