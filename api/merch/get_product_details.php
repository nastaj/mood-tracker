<?php
require_once '../../config/db_connect.php';

// Get id from URL request
$product_id = $_GET['id'] ?? null;

// Query merch items with average rating
$sql = "
SELECT 
    m.merch_id,
    m.name,
    m.price,
    m.stock_quantity,
    m.description,
    m.image_url,
    ROUND(AVG(r.rating), 1) AS avg_rating,
    COUNT(r.rating_id) AS rating_count
FROM merch m
LEFT JOIN merch_ratings r ON m.merch_id = r.merch_id
WHERE m.merch_id = ?
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();

// Generate HTML for each merch item
while ($item = $result->fetch_assoc()) {
    $availability = ($item['stock_quantity'] > 0) ? 'In Stock' : 'Out of Stock';

    // Calculate number of full stars, half star, and empty stars
    $avg_rating = floatval($item['avg_rating']);
    $full_stars = floor($avg_rating);
    $half_star = ($avg_rating - $full_stars) >= 0.5 ? 1 : 0;
    $empty_stars = 5 - $full_stars - $half_star;

    echo '      <!-- Product Image -->';
    echo '      <img src="' . htmlspecialchars($item['image_url']) . '" alt="' . htmlspecialchars($item['name']) . '" class="w-1/5 md:rounded-lg lg:cursor-pointer">';

    echo '      <!-- Product Details -->';
    echo '      <article class="p-6 mb-2 basis-2/5 lg:mb-0 xl:basis-2/6 ">';
    echo '          <span class="inline-block uppercase font-bold text-sm text-primary-orange tracking-wide mb-4">';
    echo '              Moodies';
    echo '          </span>';
    echo '<div class="flex items-center mb-2">';
    for ($i = 0; $i < $full_stars; $i++) {
        echo '<i class="fas fa-star text-yellow-400"></i>'; // full star
    }
    if ($half_star) {
        echo '<i class="fas fa-star-half-alt text-yellow-400"></i>'; // half star
    }
    for ($i = 0; $i < $empty_stars; $i++) {
        echo '<i class="far fa-star text-gray-300"></i>'; // empty star
    }
    echo '<span class="ml-2 text-sm text-gray-500">(' . ($item['rating_count'] ?? 0) . ' reviews)</span>';
    echo '</div>';
    echo '          <h1 class="text-3xl lg:text-4xl font-bold text-black leading-none mb-6 lg:mb-8">';
    echo '              ' . htmlspecialchars($item['name']) . '';
    echo '          </h1>';
    echo '<p class="text-green-600 text-sm font-semibold">' . $availability . '</p>';

    echo '          <p class="text-neutral-gray-1 mb-6 lg:mb-8">';
    echo '              ' . htmlspecialchars($item['description']) . '';
    echo '          </p>';

    echo '          <section class="flex justify-between items-center mb-6 lg:flex-col lg:items-start">';
    echo '              <div class="flex gap-4 lg:mb-2">';
    echo '                  <h2 class="text-3xl font-bold">€' . number_format($item['price'], 2) . '</h2>';
    echo '                  <!-- <span class="inline-block text-lg text-primary-orange font-bold bg-primary-pale px-3 py-1 rounded-md">';
    echo '                      50%';
    echo '                  </span> -->';
    echo '              </div>';

    echo '              <!-- <span class="text-lg text-neutral-gray-2 font-bold line-through">';
    echo '                  $250.00';
    echo '              </span> -->';
    echo '          </section>';

    echo '          <div class="flex flex-col lg:flex-row mb-12 lg:mb-0 lg:gap-6">';
    echo '              <div class="flex justify-between bg-neutral-gray-3 rounded-md px-5 py-3 mb-4 lg:basis-2/5 lg:mb-0">';
    echo '                  <button type="button" class="cursor-pointer" onclick="changeQuantity(\'decrease\')">';
    echo '                      <i class="fa-minus fa-solid text-primary-orange"></i>';
    echo '                  </button>';

    echo '                  <span id="quantity" class="font-bold text-lg" data-quantity="0">0</span>';

    echo '                  <button type="button" class="cursor-pointer" onclick="changeQuantity(\'increase\')">';
    echo '                      <i class="fa-plus fa-solid text-primary-orange"></i>';
    echo '                  </button>';
    echo '              </div>';

    echo '              <button
                         type="button"
                         id="btn-add-to-cart"
                         class="flex justify-center gap-4 items-center bg-primary-orange rounded-md px-5 py-3 lg:basis-3/5 hover:opacity-50 hover:drop-shadow-glow active:scale-95 transition-all cursor-pointer" data-merch-id="' . $item['merch_id'] . '">';

    echo '                    <svg width="22" height="20" xmlns="http://www.w3.org/2000/svg" class="inline-block">
                            <path
                                d="M20.925 3.641H3.863L3.61.816A.896.896 0 0 0 2.717 0H.897a.896.896 0 1 0 0 1.792h1l1.031 11.483c.073.828.52 1.726 1.291 2.336C2.83 17.385 4.099 20 6.359 20c1.875 0 3.197-1.87 2.554-3.642h4.905c-.642 1.77.677 3.642 2.555 3.642a2.72 2.72 0 0 0 2.717-2.717 2.72 2.72 0 0 0-2.717-2.717H6.365c-.681 0-1.274-.41-1.53-1.009l14.321-.842a.896.896 0 0 0 .817-.677l1.821-7.283a.897.897 0 0 0-.87-1.114ZM6.358 18.208a.926.926 0 0 1 0-1.85.926.926 0 0 1 0 1.85Zm10.015 0a.926.926 0 0 1 0-1.85.926.926 0 0 1 0 1.85Zm2.021-7.243-13.8.81-.57-6.341h15.753l-1.383 5.53Z"
                                fill="hsl(0, 0%, 100%)"
                                fillRule="nonzero"
                            />
                        </svg>';

    echo '                    <span class="text-white text-md font-bold">Add to cart</span>';
    echo '                </button>';
    echo '            </div>';
    echo '        </article>';
}

$stmt->close();
$conn->close();
?>
