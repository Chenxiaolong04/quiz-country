<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gioco dell'Impiccato - Paesi</title>
</head>
<body>
    <div>
        <h1>Gioco dell'Impiccato - Paesi</h1>
        
        <div>
            <!-- Vite rimaste -->
            <h2>Vite rimaste: {{ $gameData['remainingAttempts'] }}/6</h2>
            
            <!-- Parola da indovinare -->
            <div>
                <h3>{{ $gameData['displayWord'] }}</h3>
            </div>
            
            <!-- Informazioni del gioco -->
            <div>
                <p>Errori: {{ $gameData['wrongGuesses'] }}/6</p>
                <p>Lettere provate: {{ count($gameData['guessedLetters']) }}</p>
            </div>
            
            <!-- Lettere indovinate -->
            @if(count($gameData['guessedLetters']) > 0)
            <div>
                <h4>Lettere provate:</h4>
                @foreach($gameData['guessedLetters'] as $letter)
                    <span>{{ $letter }} </span>
                @endforeach
            </div>
            @endif
            
            <!-- Messaggi -->
            @if(session('message'))
            <div>
                <p><strong>{{ session('message') }}</strong></p>
            </div>
            @endif
            
            @if(session('error'))
            <div>
                <p><strong>{{ session('error') }}</strong></p>
            </div>
            @endif
            
            <!-- Input per indovinare -->
            @if(!$gameData['isGameOver'])
            <div>
                <form action="{{ route('hangman.guess') }}" method="POST">
                    @csrf
                    <input type="text" name="letter" maxlength="1" placeholder="Inserisci una lettera" autofocus>
                    <button type="submit">Prova Lettera</button>
                </form>
            </div>
            @endif
        </div>
        
        <!-- Pulsanti di controllo -->
        <div>
            <a href="{{ route('hangman.restart') }}">Nuovo Gioco</a>
            <a href="{{ route('home') }}">Torna Home</a>
        </div>
    </div>

    <script>
        // Auto-focus sull'input
        document.addEventListener('DOMContentLoaded', function() {
            const input = document.querySelector('input[name="letter"]');
            if (input) {
                input.focus();
            }
        });
        
        // Converte automaticamente in maiuscolo
        document.querySelector('input[name="letter"]')?.addEventListener('input', function(e) {
            e.target.value = e.target.value.toUpperCase();
        });
    </script>
</body>
</html>