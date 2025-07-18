<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Over - Gioco dell'Impiccato</title>
    <link rel="stylesheet" href="{{ asset('css/hangman-lose.css') }}">
</head>
<body>
    <div class="lose-container">
        <div class="decorative-elements">
            <div class="tear"></div>
            <div class="tear"></div>
        </div>
        
        <div class="game-over-icon">💀</div>
        <h1 class="lose-title">Game Over!</h1>
        <h2 class="lose-subtitle">Hai finito le vite!</h2>
        
        <div class="word-reveal">
            <h3>La parola era:</h3>
            <div class="revealed-word">{{ $word }}</div>
        </div>
        
        <div class="lose-stats">
            <div class="stat-row">
                <span class="stat-label">🎯 Parola:</span>
                <span class="stat-value">{{ $word }}</span>
            </div>
            <div class="stat-row">
                <span class="stat-label">❌ Errori commessi:</span>
                <span class="stat-value highlight">{{ $wrongGuesses }}/6</span>
            </div>
            <div class="stat-row">
                <span class="stat-label">📊 Risultato:</span>
                <span class="stat-value highlight">Sconfitta</span>
            </div>
        </div>
        
        <div class="encouragement">
            💪 Non arrenderti! Ogni tentativo ti rende più bravo. Riprova e vedrai che riuscirai a indovinare la prossima parola!
        </div>
        
        <div class="action-buttons">
            <a href="{{ route('hangman.restart') }}" class="action-btn try-again-btn">🔄 Riprova</a>
            <a href="{{ route('home') }}" class="action-btn home-btn">🏠 Torna Home</a>
        </div>
    </div>
</body>
</html>
