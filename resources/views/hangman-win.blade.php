<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hai Vinto! - Gioco dell'Impiccato</title>
    <link rel="stylesheet" href="{{ asset('css/hangman-win.css') }}">
</head>
<body>
    <div class="win-container">
        <div class="decorative-elements">
            <div class="sparkle"></div>
            <div class="sparkle"></div>
            <div class="sparkle"></div>
            <div class="sparkle"></div>
        </div>
        
        <div class="celebration-icon">🎉</div>
        <h1 class="win-title">Complimenti!</h1>
        <h2 class="win-subtitle">Hai indovinato la parola!</h2>
        
        <div class="word-reveal">
            {{ $word }}
        </div>
        
        <div class="win-stats">
            <div class="stat-row">
                <span class="stat-label">🎯 Parola:</span>
                <span class="stat-value">{{ $word }}</span>
            </div>
            <div class="stat-row">
                <span class="stat-label">📝 Tentativi totali:</span>
                <span class="stat-value">{{ $attempts }}</span>
            </div>
            <div class="stat-row">
                <span class="stat-label">⭐ Risultato:</span>
                <span class="stat-value highlight">Vittoria!</span>
            </div>
        </div>
        
        <div class="action-buttons">
            <a href="{{ route('hangman.restart') }}" class="action-btn play-again-btn">🔄 Gioca Ancora</a>
            <a href="{{ route('home') }}" class="action-btn home-btn">🏠 Torna Home</a>
        </div>
    </div>
</body>
</html>
