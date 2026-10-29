<?php
declare(strict_types=1);

$data = require __DIR__ . '/data/products.php';
$blogPosts = require __DIR__ . '/data/blog.php';
function get_blog_posts(): array {
    global $blogPosts;
    return $blogPosts;
}

function e(?string $s): string {
    return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8');
}

function money(int|float $n): string {
    return number_format((float)$n, 0, '.', ' ') . ' ₽';
}

function current_path(): string {
    return trim(parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/', '/');
}
function get_products(): array {
    global $data;
    return $data['products'];
}

function get_categories(): array {
    global $data;
    return $data['categories'];
}

function find_product(string $slug): ?array {
    foreach (get_products() as $p) {
        if ($p['slug'] === $slug) return $p;
    }
    return null;
}

function products_by_category(?string $catSlug): array {
    $all = get_products();
    if ($catSlug === null) return $all;
    return array_values(array_filter($all, fn($p) => $p['category_slug'] === $catSlug));
}

function filter_products(array $products, array $filters): array {
    return array_values(array_filter($products, function ($p) use ($filters) {
        if (!empty($filters['steel']) && $p['steel'] !== $filters['steel']) return false;
        if (!empty($filters['brand']) && $p['brand'] !== $filters['brand']) return false;
        if (!empty($filters['weight_max']) && $p['weight_g'] > (int)$filters['weight_max']) return false;
        if (!empty($filters['price_min']) && $p['price'] < (int)$filters['price_min']) return false;
        if (!empty($filters['price_max']) && $p['price'] > (int)$filters['price_max']) return false;
        if (!empty($filters['in_stock']) && !$p['in_stock']) return false;
        return true;
    }));
}

function sort_products(array $products, string $sort): array {
    usort($products, function ($a, $b) use ($sort) {
        return match ($sort) {
            'price_asc'  => $a['price'] <=> $b['price'],
            'price_desc' => $b['price'] <=> $a['price'],
            'new'        => $b['id'] <=> $a['id'],
            'weight_asc' => $a['weight_g'] <=> $b['weight_g'],
            default      => $b['id'] <=> $a['id'],
        };
    });
    return $products;
}