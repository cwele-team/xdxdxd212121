<?php
require_once 'db.php'; // Połączenie z bazą danych

$categories = [];
$formMessage = '';
$messageType = '';
$showAlert = false; // Nowa zmienna do kontrolowania wyświetlania alertu

// Logowanie do pliku
function log_debug($msg) {
    file_put_contents('debug.log', $msg . PHP_EOL, FILE_APPEND);
}

// ====== POBIERANIE KATEGORII (dla wyświetlenia formularza) ======
try {
    $sql = "SELECT id, string_techniczna FROM Kategorie_problemow ORDER BY string_techniczna ASC";
    $result = $conn->query($sql);

    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $categories[] = $row;
        }
    } else {
        $formMessage = 'Błąd podczas ładowania kategorii: ' . $conn->error;
        $messageType = 'error';
        log_debug("Błąd ładowania kategorii: " . $conn->error);
    }
} catch (Exception $e) {
    $formMessage = 'Wystąpił wyjątek podczas ładowania kategorii: ' . $e->getMessage();
    $messageType = 'error';
    log_debug("Wyjątek ładowania kategorii: " . $e->getMessage());
}

// ====== OBSŁUGA WYSYŁKI FORMULARZA (POST) ======
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $categoryName = $_POST['category'] ?? '';
    $email = $_POST['email'] ?? '';
    $description = $_POST['description'] ?? '';

    log_debug("=== NOWE ZGŁOSZENIE (POST) ===");
    log_debug("Kategoria: " . $categoryName);
    log_debug("Email: " . $email);
    log_debug("Opis: " . $description);

    // Walidacja
    if (empty($categoryName) || empty($email) || empty($description)) {
        $formMessage = 'Wszystkie pola są wymagane.';
        $messageType = 'error';
        log_debug("Walidacja nieudana: Puste pola.");
    } else {
        try {
            // Sprawdzenie czy kategoria istnieje i pobranie jej ID
            $stmt = $conn->prepare("SELECT id FROM Kategorie_problemow WHERE string_techniczna = ?");
            if (!$stmt) {
                throw new Exception("Błąd przygotowania SELECT: " . $conn->error);
            }

            $stmt->bind_param("s", $categoryName);
            $stmt->execute();
            $result = $stmt->get_result();
            $categoryRow = $result->fetch_assoc();
            $stmt->close();

            if (!$categoryRow) {
                $formMessage = 'Wybrana kategoria nie istnieje.';
                $messageType = 'error';
                log_debug("Kategoria nie istnieje: " . $categoryName);
            } else {
                $categoryId = $categoryRow['id'];
                log_debug("ID kategorii: " . $categoryId);

                // Wstawienie zgłoszenia do tabeli Zgloszenia
                $stmt = $conn->prepare("INSERT INTO Zgloszenia (kat_problemu, email, opis) VALUES (?, ?, ?)");
                if (!$stmt) {
                    throw new Exception("Błąd przygotowania INSERT: " . $conn->error);
                }

                $stmt->bind_param("iss", $categoryId, $email, $description);
                $executed = $stmt->execute();
                $stmt->close();

                if ($executed) {
                    $formMessage = 'Zgłoszenie zostało wysłane pomyślnie.';
                    $messageType = 'success';
                    $showAlert = true; // Ustaw flagę na true, aby wyświetlić alert
                    log_debug("Zgłoszenie zapisane OK.");
                    // Opcjonalnie: wyczyść pola formularza po sukcesie
                    $_POST['category'] = ''; // Clear selected category
                    $_POST['email'] = '';
                    $_POST['description'] = '';
                } else {
                    throw new Exception("Błąd wykonania INSERT: " . $conn->error);
                }
            }
        } catch (Exception $e) {
            $formMessage = 'Błąd serwera: ' . $e->getMessage();
            $messageType = 'error';
            log_debug("BŁĄD: " . $e->getMessage());
        }
    }
    log_debug("=== KONIEC ZGŁOSZENIA ===\n");
}

$conn->close(); // Zamknij połączenie z bazą danych po wszystkich operacjach
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pomoc - Wfo</title>
    <meta name="description" content="Strona pomocy WFO - zgłoś problem lub znajdź odpowiedzi na często zadawane pytania.">
    <link rel="stylesheet" href="style.css?v=2.6">
    <link rel="icon" type="image/png" href="https://www.wfo.com.pl/wp-content/uploads/2015/11/wfo-100x33.png">

    <script src="smooth-scroll.js?v=2.6"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="lock.js?v=2.6"></script>
    <script src="lock2.js?v=2.6"></script>
    <script src="https://unpkg.com/lucide@latest" defer></script>

</head>
<body>
    <!-- Skip to main content link for screen readers -->
    <a href="#main-content" class="skip-link">Przejdź do głównej zawartości</a>

    <!-- Navbar -->
    <header class="navbar" role="banner">
        <div class="navbar-container">
            <a href="index.html" class="logo">
                <img src="https://www.wfo.com.pl/wp-content/uploads/2015/11/wfo-100x33.png" alt="Logo WFO - Strona główna" class="logo-icon" style="width: 120px; height: 60px;">
            </a>

            <nav class="nav-links" role="navigation" aria-label="Nawigacja główna">
                <a href="index.html" class="nav-link">Strona Główna</a>
                <a href="Filmy.html" class="nav-link">Filmy</a>
                <a href="Kategorie.html" class="nav-link">Kategorie</a>
                <a href="Lista do obejrzenia.html" class="nav-link">Lista do obejrzenia</a>
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
                    <button class="btn btn-secondary login-button" onclick="window.location.href='Logowanie.html'">Zaloguj się</button>
                    <button id="logoutBtn" class="btn btn-secondary" style="display: none;">Wyloguj</button>
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

    <!-- Main Content -->
    <main id="main-content" role="main" class="help-page-main">
        <section class="help-section">
            <h1 class="help-title">Centrum Pomocy</h1>
            <p class="help-description">Wypełnij poniższy formularz, aby zgłosić problem lub zadać pytanie. Postaramy się odpowiedzieć jak najszybciej.</p>

            <form id="helpForm" class="help-form" action="pomoc.php" method="POST">
                <div class="form-group">
                    <label for="categorySelect">Wybierz kategorię problemu:</label>
                    <select id="categorySelect" name="category" required>
                        <?php if (empty($categories)): ?>
                            <option value="">Brak dostępnych kategorii</option>
                        <?php else: ?>
                            <option value="">-- Wybierz kategorię --</option>
                            <?php foreach ($categories as $cat): ?>
                                <option value="<?php echo htmlspecialchars($cat['string_techniczna']); ?>"
                                    <?php echo (isset($_POST['category']) && $_POST['category'] == $cat['string_techniczna']) ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($cat['string_techniczna']); ?>
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="emailInput">Twój adres e-mail:</label>
                    <input type="email" id="emailInput" name="email" placeholder="np. twoj.email@example.com" required value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">
                </div>

                <div class="form-group">
                    <label for="descriptionTextarea">Opisz swój problem:</label>
                    <textarea id="descriptionTextarea" name="description" rows="8" placeholder="Szczegółowo opisz problem, z którym się zmagasz..." required><?php echo htmlspecialchars($_POST['description'] ?? ''); ?></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Wyślij zgłoszenie</button>
                <?php if (!empty($formMessage)): ?>
                    <div id="formMessage" class="form-message <?php echo $messageType; ?>" role="alert" aria-live="polite" style="display: block;">
                        <?php echo htmlspecialchars($formMessage); ?>
                    </div>
                <?php endif; ?>
            </form>

        </section>
    </main>

    <!-- Footer -->
    <?php include 'footer.php'; ?>

    <script src="shared.js?v=2.6"></script>
    <script src="app.js?v=2.6"></script>

    <?php if ($showAlert): ?>
    <script>
        alert("Zgłoszenie zostało wysłane pomyślnie.");
        // Opcjonalnie, aby zapobiec ponownemu wyświetleniu alertu po odświeżeniu strony
        // Można przekierować użytkownika lub usunąć parametr z URL
        // window.location.href = window.location.pathname;
    </script>
    <?php endif; ?>
</body>
</html>
