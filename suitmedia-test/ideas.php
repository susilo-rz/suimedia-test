<?php
// Gambar banner dinamis (CMS)
$image_url = "https://static.vecteezy.com/system/resources/thumbnails/026/510/205/small_2x/black-slate-background-ai-generated-photo.jpg";

// Ambil parameter user
$page = $_GET['pagenum'] ?? 1;
$size = $_GET['size'] ?? 10;
$sort = $_GET['sort'] ?? '-published_at';

// Panggil proxy (perhatikan: gunakan page, size, sort — TANPA [number])
$proxy_url = "http://localhost/suitmedia-test/proxy.php?page=$page&size=$size&sort=$sort";

// Ambil data dari API lewat proxy
$response = @file_get_contents($proxy_url);
$data = json_decode($response, true);

// Validasi jika gagal load data
if (!$data || !isset($data['data'])) {
    echo "<p class='text-red-500'>Gagal memuat data dari API.</p>";
    return;
}

$ideas = $data['data'];
$totalItems = $data['meta']['total'] ?? 0;
$totalPages = ceil($totalItems / $size);
?>


<!-- Banner -->
<section class="relative h-[400px] overflow-hidden">
    <div class="absolute top-0 left-0 w-full h-full z-0" style="clip-path: polygon(0 0, 100% 0, 100% 70%, 0 100%);">
        <img id="banner-image" src="<?= $image_url ?>" alt="Banner" class="w-full h-full object-cover" loading="lazy">
    </div>
    <div id="banner-text" class="relative z-10 flex items-center justify-center h-full flex-col text-white">
        <h1 class="text-4xl font-bold">Ideas</h1>
        <p class="">Where All Our Great Things Begin</p>
    </div>
</section>

<!-- Filter -->
<div class="flex justify-between items-center my-4">
    <div>
        <p class="text-sm text-gray-600">Showing <?= ($page - 1) * $size + 1 ?> - <?= min($page * $size, $totalItems) ?> of <?= $totalItems ?></p>
    </div>
    <form method="get" class="flex gap-4">
        <input type="hidden" name="p" value="ideas">
        <input type="hidden" name="pagenum" value="<?= $page ?>">

        <div>
            <label for="size" class="text-sm">Show per page:</label>
            <select name="size" id="size" onchange="this.form.submit()" class="border rounded px-2 py-1">
                <?php foreach ([10, 20, 50] as $val): ?>
                    <option value="<?= $val ?>" <?= $size == $val ? 'selected' : '' ?>><?= $val ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div>
            <label for="sort" class="text-sm">Sort by:</label>
            <select name="sort" id="sort" onchange="this.form.submit()" class="border rounded px-2 py-1">
                <option value="-published_at" <?= $sort == '-published_at' ? 'selected' : '' ?>>Newest</option>
                <option value="published_at" <?= $sort == 'published_at' ? 'selected' : '' ?>>Oldest</option>
            </select>
        </div>
    </form>
</div>

<!-- Card Grid -->
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
    <?php foreach ($ideas as $item): ?>
        <?php
        $image = $item['small_image']['url'] ?? 'https://via.placeholder.com/300x200';

        $title = $item['title'] ?? 'No Title';
        $published = isset($item['published_at'])
            ? date('j F Y', strtotime($item['published_at']))
            : '-';
        ?>
        <div class="bg-white rounded shadow overflow-hidden">
            <img src="<?= $image ?>"
                alt="<?= htmlspecialchars($title) ?>"
                loading="lazy"
                decoding="async"
                class="w-full h-[180px] object-cover aspect-video"
                onerror="this.src='https://via.placeholder.com/300x200.png?text=Image+Error'">
            <div class="p-4">
                <p class="text-xs text-gray-500"><?= $published ?></p>
                <h2 class="mt-1 text-base font-semibold leading-tight line-clamp-3 overflow-hidden h-[4.5em]"><?= $title ?></h2>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<!-- Pagination -->
<div class="flex justify-center items-center mt-6 gap-2">
    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
        <a href="?p=ideas&pagenum=<?= $i ?>&size=<?= $size ?>&sort=<?= $sort ?>"
            class="px-3 py-1 border <?= $i == $page ? 'bg-orange-500 text-white' : 'bg-white text-gray-700' ?> rounded hover:bg-orange-400">
            <?= $i ?>
        </a>
    <?php endfor; ?>
</div>

<!-- Parallax Script -->
<script src="assets/script.js"></script>

<!-- Tailwind Clamp -->
<style>
    .line-clamp-3 {
        display: -webkit-box;
        /* -webkit-line-clamp: 3; */
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>