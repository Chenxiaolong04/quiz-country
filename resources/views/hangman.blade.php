<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gioco dell'Impiccato - Paesi</title>
    <link rel="stylesheet" href="{{ asset('css/hangman.css') }}">
</head>
<body>
    <div class="hangman-container">
        <div class="decorative-element"></div>
        <div class="game-icon">🎯</div>
        
        <h1 class="hangman-title">Gioco dell'Impiccato - Paesi</h1>
        
        <!-- Vite rimaste -->
        <div class="lives-display">
            ❤️ Vite rimaste: {{ $gameData['remainingAttempts'] }}/6
        </div>
        
        <!-- Parola da indovinare -->
        <div class="word-display">
            {{ $gameData['displayWord'] }}
        </div>
        
        <!-- Statistiche del gioco -->
        <div class="game-stats">
            <div class="stat-item">
                <div class="stat-label">Errori</div>
                <div class="stat-value">{{ $gameData['wrongGuesses'] }}/6</div>
            </div>
            <div class="stat-item">
                <div class="stat-label">Lettere provate</div>
                <div class="stat-value">{{ count($gameData['guessedLetters']) }}</div>
            </div>
        </div>
        
        <!-- Lettere indovinate -->
        @if(count($gameData['guessedLetters']) > 0)
        <div class="guessed-letters">
            <h4>Lettere provate:</h4>
            @foreach($gameData['guessedLetters'] as $letter)
                <span class="letter-badge">{{ $letter }}</span>
            @endforeach
        </div>
        @endif
        
        <!-- Messaggi -->
        @if(session('message'))
        <div class="message success">
            {{ session('message') }}
        </div>
        @endif
        
        @if(session('error'))
        <div class="message error">
            {{ session('error') }}
        </div>
        @endif
        
        <!-- Input per indovinare -->
        @if(!$gameData['isGameOver'])
        <div class="input-section">
            <form action="{{ route('hangman.guess') }}" method="POST" class="guess-form">
                @csrf
                <input type="text" name="letter" class="letter-input" maxlength="1" placeholder="?" autofocus>
                <button type="submit" class="guess-btn">Prova Lettera</button>
            </form>
        </div>
        @endif
        
        <!-- Pulsanti di controllo -->
        <div class="control-buttons">
            <a href="{{ route('hangman.restart') }}" class="control-btn restart-btn">🔄 Nuovo Gioco</a>
            <a href="{{ route('home') }}" class="control-btn home-btn">🏠 Torna Home</a>
        </div>
    </div>

    <script>
        // Auto-focus sull'input
        document.addEventListener('DOMContentLoaded', function() {
            const input = document.querySelector('.letter-input');
            if (input) {
                input.focus();
            }
        });
        
        // Converte automaticamente in maiuscolo
        document.querySelector('.letter-input')?.addEventListener('input', function(e) {
            e.target.value = e.target.value.toUpperCase();
        });
    </script>
</body>
</html>