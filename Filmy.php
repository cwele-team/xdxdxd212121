<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filmy - WFO</title>
    <link rel="stylesheet" href="style.css?v=<?= filemtime('styles.css') ?>">
    <link rel="icon" type="image/png" href="https://www.wfo.com.pl/wp-content/uploads/2015/11/wfo-100x33.png">
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body>
    <!-- Navbar -->
    <header class="navbar">
        <div class="navbar-container">
            <a href="index.html" class="logo">
                <img src="https://www.wfo.com.pl/wp-content/uploads/2015/11/wfo-100x33.png" alt="WFO Logo" class="logo-icon" style="width: 120px; height: 60px;">
            </a>

            <nav class="nav-links">
                <a href="index.html" class="nav-link">Strona Główna</a>
                <a href="Filmy.html" class="nav-link active">Filmy</a>
                <a href="Kategorie.html" class="nav-link">Kategorie</a>
                <a href="Lista do obejrzenia.html" class="nav-link">Lista do obejrzenia</a>
                <a href="biuro_licencyjne.html" class="nav-link">Biuro Licencyjne</a>
            </nav>

            <div class="nav-actions">
                <button class="icon-button search-toggle">
                    <i data-lucide="search"></i>
                </button>
                <a href="Logowanie.html" class="icon-button">
                    <i data-lucide="user-circle"></i>
                </a>
                <button class="icon-button menu-toggle">
                    <i data-lucide="menu"></i>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div class="mobile-menu">
            <nav class="mobile-nav">
                <a href="index.html" class="mobile-nav-link">
                    <i data-lucide="home"></i>
                    <span>Strona Główna</span>
                </a>
                <a href="Filmy.html" class="mobile-nav-link">
                    <i data-lucide="film"></i>
                    <span>Filmy</span>
                </a>
                <a href="Kategorie.html" class="mobile-nav-link">
                    <i data-lucide="list"></i>
                    <span>Kategorie</span>
                </a>
                <a href="Lista do obejrzenia.html" class="mobile-nav-link">
                    <i data-lucide="bookmark"></i>
                    <span>Lista do obejrzenia</span>
                </a>
                <a href="biuro_licencyjne.html" class="mobile-nav-link">
                    <i data-lucide="briefcase"></i>
                    <span>Biuro Licencyjne</span>
                </a>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main class="main-content">
        <div class="movies-container">
            <div class="movies-header">
                <h2>Wszystkie Filmy</h2>
            </div>
            <div class="movie-grid" id="movies-grid">
                <!-- Movies will be inserted here by JavaScript -->
            </div>
        </div>
    </main>

    <!-- Footer -->
    <?php include 'footer.php'; ?>

    <script src="shared.js?v=<?= filemtime('shared.js') ?>"></script>
    <script src="app.js?v=<?= filemtime('app.js') ?>"></script>
</body>
</html>
