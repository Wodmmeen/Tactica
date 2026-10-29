<?php
declare(strict_types=1);

require __DIR__ . '/bootstrap.php';

$path = current_path();
$segments = $path === '' ? [] : explode('/', $path);
$page = $segments[0] ?? 'home';
$slug = $segments[1] ?? null;
$sub = $segments[2] ?? null;

switch ($page) {
    case '':
    case 'home':
        require __DIR__ . '/pages/home.php';
        break;

    case 'catalog':
        require __DIR__ . '/pages/catalog.php';
        break;

    case 'product':
        require __DIR__ . '/pages/product.php';
        break;

    case 'cart':
        require __DIR__ . '/pages/cart.php';
        break;

    case 'compare':
        require __DIR__ . '/pages/compare.php';
        break;

    case 'quiz':
        require __DIR__ . '/pages/quiz.php';
        break;

    case 'kit':
        require __DIR__ . '/pages/kit.php';
        break;

    case 'blog':
        if ($slug) {
            require __DIR__ . '/pages/blog-post.php';
        } else {
            require __DIR__ . '/pages/blog.php';
        }
        break;

    case 'checkout':
        if ($slug === 'success') {
            require __DIR__ . '/pages/checkout-success.php';
        } else {
            require __DIR__ . '/pages/checkout.php';
        }
        break;

    case 'favorites':
        require __DIR__ . '/pages/favorites.php';
        break;

    case 'about':
        require __DIR__ . '/pages/about.php';
        break;

    case 'delivery':
        require __DIR__ . '/pages/delivery.php';
        break;

    case 'warranty':
        require __DIR__ . '/pages/warranty.php';
        break;

    case 'contacts':
        require __DIR__ . '/pages/contacts.php';
        break;
      case 'account':
    if ($slug === 'orders') {
        require __DIR__ . '/pages/account-orders.php';
    } elseif ($slug === 'favorites') {
        // редирект на /favorites
        header('Location: /favorites');
        exit;
    } else {
        http_response_code(404);
        require __DIR__ . '/pages/404.php';
    }
    break;
    default:
        http_response_code(404);
        require __DIR__ . '/pages/404.php';
}