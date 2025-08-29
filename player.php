<!DOCTYPE html>
    <html lang="pl">
      <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Odtwarzacz - WFO</title>
        <meta name="description" content="Odtwarzacz filmów WFO - oglądaj filmy archiwalne w wysokiej jakości">
        <link rel="stylesheet" href="style.css" />
        <link
          rel="icon"
          type="image/png"
          href="https://wfomag.co/storage/2021/10/wfo_Logo_Red300ppi.png"
        />
        <script src="https://unpkg.com/lucide@latest" defer></script>
      </head>
      <body class="player-page">
        <!-- Skip to main content link for screen readers -->
        <a href="#main-content" class="skip-link">Przejdź do odtwarzacza</a>

        <!-- Overlay -->
        <div class="overlay-dark"></div>

        <!-- Navbar -->
        <header class="navbar" role="banner">
          <div class="navbar-container">
            <a href="index.html" class="logo">
              <img src="https://www.wfo.com.pl/wp-content/uploads/2015/11/WFO_LOGO_G%C5%82%C3%93WNE.png" alt="Logo WFO - Strona główna" class="logo-icon" style="width: 120px; height: 60px;">
            </a>

            <nav class="nav-links" role="navigation" aria-label="Nawigacja główna">
              <a href="index.html" class="nav-link">Strona Główna</a>
              <a href="Filmy.html" class="nav-link">Filmy</a>
              <a href="Kategorie.html" class="nav-link">Kategorie</a>
              <a href="Lista do obejrzenia.html" class="nav-link"
                >Lista do obejrzenia</a
              >
              <a href="biuro_licencyjne.html" class="nav-link">Biuro Licencyjne</a>
            </nav>

            <div class="nav-actions">
              <button class="icon-button search-toggle" aria-label="Otwórz wyszukiwarkę">
                <i data-lucide="search"></i>
              </button>

              <button class="icon-button menu-toggle" aria-label="Otwórz menu mobilne" aria-expanded="false">
                <i data-lucide="menu"></i>
              </button>

              <div class="user-info">
                <i data-lucide="user-circle"></i>
                <span class="user-login"></span>
                <button
                  class="btn btn-secondary login-button"
                  onclick="window.location.href='Logowanie.html'"
                >
                  Zaloguj się
                </button>
                <button
                  id="logoutBtn"
                  class="btn btn-secondary"
                  style="display: none;"
                >
                  Wyloguj
                </button>
              </div>
            </div>
          </div>

          <!-- Mobile Menu -->
          <div class="mobile-menu" role="navigation" aria-label="Menu mobilne">
            <nav class="mobile-nav" role="menu">
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

        <!-- Video Player Section -->
        <main id="main-content" class="player-container" role="main">
          <section class="video-player" aria-labelledby="video-title">
            <div id="moviePlayer" style="width: 100%; height: 400px; background: #000; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: #fff;">
              <div style="text-align: center;">
                <i data-lucide="play-circle" style="width: 64px; height: 64px; margin-bottom: 1rem; opacity: 0.5;"></i>
                <p style="opacity: 0.7;">Inicjalizacja odtwarzacza...</p>
              </div>
            </div>
          </section>
          <section class="movie-info" aria-labelledby="video-title">
            <div class="movie-info-header">
              <h1 id="movieTitle" class="featured-title" tabindex="0"></h1>
              <div class="movie-meta">
                <span id="movieRating" class="rating"></span>
                <span id="movieYear"></span>
                <span id="movieGenre"></span>
                <span id="movieAuthors" class="authors"></span>
              </div>
            </div>
            <p id="movieDescription" class="movie-description"></p>
            <!-- Moved button here -->
          </section>
        </main>

        <!-- Footer -->
        <?php include 'footer.php'; ?>

        <!-- JavaScript -->
        <script src="shared.js"></script>
        <script src="app.js"></script>
        <script src="player.js"></script>
      </body>
    </html>
