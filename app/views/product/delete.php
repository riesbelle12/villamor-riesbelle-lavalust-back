<?php
$escape = static function ($value) {
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
};
$id = is_object($product) ? ($product->id ?? '') : ($product['id'] ?? '');
$name = is_object($product) ? ($product->product_name ?? '') : ($product['product_name'] ?? '');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Product</title>
    <style><?php require __DIR__ . '/../../../public/assets/css/dahlia.css'; ?></style>
</head>
<body class="dahlia-page">
    <main class="dahlia-shell">
        <header class="dahlia-header"><div><p class="dahlia-kicker">Dahlia collection</p><h1>Remove product</h1></div><div class="dahlia-flower" aria-hidden="true">✿</div></header>
        <section class="dahlia-card">
            <p class="dahlia-subtitle">Delete <strong><?= $escape($name) ?></strong> from your collection?</p>
            <form class="dahlia-actions" method="post" action="<?= $escape(site_url('/products/delete/' . $id)) ?>">
                <button class="danger" type="submit">Delete product</button>
                <a class="dahlia-button secondary" href="<?= $escape(site_url('/products')) ?>">Cancel</a>
            </form>
        </section>
    </main>
</body>
</html>