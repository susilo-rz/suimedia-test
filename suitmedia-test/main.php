    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
        <title>Suit Media Test</title>
        <style>
            .navbar {
                transition: all 0.3s ease-in-out;
            }

            .navbar-hidden {
                transform: translateY(-100%);
                opacity: 0;
            }

            .navbar-visible {
                transform: translateY(0);
                opacity: 1;
                background-color: rgba(249, 115, 22, 0.95);
                backdrop-filter: blur(5px);
            }
        </style>
    </head>

    <body class=""> <!-- Padding top untuk mengkompensasi navbar fixed -->
        <nav id="navbar" class="navbar fixed w-full bg-orange-500 h-20 z-50 navbar-visible">
            <div class="flex justify-between items-center mx-20 h-full">
                <div>
                    <h2 class="text-white font-bold text-2xl">Suit Media</h2>
                </div>
                <div class="flex space-x-4">
                    <?php
                    $current_page = $_GET['p'] ?? 'work';
                    $nav_items = [
                        'work' => 'Work',
                        'about' => 'About',
                        'services' => 'Services',
                        'ideas' => 'Ideas',
                        'careers' => 'Careers',
                        'contact' => 'Contact'
                    ];

                    foreach ($nav_items as $page => $title) {
                        $is_active = $current_page === $page ? 'border-b-2 font-semibold' : '';
                        echo "<a href='?p=$page' class='px-1 py-2 text-sm font-medium text-white hover:border-b-2 $is_active'>$title</a>";
                    }
                    ?>
                </div>
            </div>
        </nav>

        <main class="mx-20">
            <?php include 'content.php'; ?>
        </main>

        <script src="assets/script.js"></script>
    </body>

    </html>