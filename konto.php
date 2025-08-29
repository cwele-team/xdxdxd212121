<!DOCTYPE html>
<html lang="pl">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Moje Konto</title>
  <link rel="stylesheet" href="style.css?v=<?= filemtime('styles.css') ?>" />
  <link rel="icon" type="image/png" href="https://www.wfo.com.pl/wp-content/uploads/2015/11/wfo-100x33.png">
  <script src="https://unpkg.com/lucide@latest" defer></script>
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
        <a href="Filmy.html" class="nav-link">Filmy</a>
        <a href="Kategorie.html" class="nav-link">Kategorie</a>
        <a href="Lista do obejrzenia.html" class="nav-link">Lista do obejrzenia</a>
        <a href="biuro_licencyjne.html" class="nav-link">Biuro Licencyjne</a>
      </nav>
      <div class="nav-actions">
        <a href="Logowanie.html" class="btn btn-primary login-button">
          Zaloguj się
        </a>
      </div>
    </div>
  </header>

  <!-- Main Content -->
  <main class="account-main">
    <h1 class="account-title">Bezpieczeństwo</h1>

    <div class="account-box">
      <!-- Hasło -->
      <a href="index.html" class="account-row border-bottom full-click">
        <div class="account-icon-text">
          <i data-lucide="lock" class="icon-secondary"></i>
          <div>
            <span class="row-title">Hasło</span>
          </div>
        </div>
        <i data-lucide="chevron-right" class="icon-secondary"></i>
      </a>

      <!-- E-mail -->
      <a href="index.html" class="account-row full-click">
        <div class="account-icon-text">
          <i data-lucide="mail" class="icon-secondary"></i>
          <div>
            <span class="row-title">E-mail</span>
            <p class="row-sub">tutaj@email.com</p>
          </div>
        </div>
        <i data-lucide="chevron-right" class="icon-secondary"></i>
      </a>
    </div>

    <!-- Logout Button -->
    <button class="btn btn-primary logout-button" style="margin-top: 2rem; width: 100%;">
      <i data-lucide="log-out"></i>
      <span>Wyloguj się</span>
    </button>
  </main>

  <!-- Footer -->
  <?php include 'footer.php'; ?>

  <script src="shared.js?v=<?= filemtime('shared.js') ?>" defer></script>
  <script src="app.js?v=<?= filemtime('app.js') ?>" defer></script>
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const logoutButton = document.querySelector('.logout-button');

      logoutButton.addEventListener('click', () => {
        // Clear session cookie
        document.cookie = 'wfo_session=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';

        // Redirect to home page
        window.location.href = 'index.html';
      });
    });
  </script>
</body>
</html>
