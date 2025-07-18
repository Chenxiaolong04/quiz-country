<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Over - Gioco dell'Impiccato</title>
</head>
<body>
    <div>
        <h1>Game Over!</h1>
        <h2>Hai finito le vite!</h2>
        
        <div>
            <h3>La parola era: {{ $word }}</h3>
        </div>
        
        <div>
            <p><strong>Parola:</strong> {{ $word }}</p>
            <p><strong>Errori commessi:</strong> {{ $wrongGuesses }}/6</p>
            <p><strong>Risultato:</strong> Sconfitta</p>
        </div>
        
        <div>
            <a href="{{ route('hangman.restart') }}">Riprova</a>
            <a href="{{ route('home') }}">Torna Home</a>
        </div>
    </div>
</body>
</html>
