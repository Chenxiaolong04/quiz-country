<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hai Vinto! - Gioco dell'Impiccato</title>
</head>
<body>
    <div>
        <h1>Complimenti! Hai Vinto!</h1>
        <h2>Hai indovinato la parola!</h2>
        
        <div>
            <h3>{{ $word }}</h3>
        </div>
        
        <div>
            <p><strong>Parola:</strong> {{ $word }}</p>
            <p><strong>Tentativi totali:</strong> {{ $attempts }}</p>
            <p><strong>Risultato:</strong> Vittoria!</p>
        </div>
        
        <div>
            <a href="{{ route('hangman.restart') }}">Gioca Ancora</a>
            <a href="{{ route('home') }}">Torna Home</a>
        </div>
    </div>
</body>
</html>
