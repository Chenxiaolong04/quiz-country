<!DOCTYPE html>
<html>
<head>
    <title>Quiz Capitali Finito</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{ asset('css/FlagEnd.css') }}">
</head>
<body>
    <div class="results-container">
        <h1 class="results-title">Hai completato il quiz delle capitali!</h1>
        <p class="score-text">Hai risposto correttamente a <span class="score-number">{{ $score }}</span> domande su 10.</p>

        @if ($score == 10)
            <div class="feedback-message">Sei un campione della geografia!</div>
        @elseif ($score >= 7)
            <div class="feedback-message">Ottimo lavoro!</div>
        @elseif ($score >= 3)
            <div class="feedback-message">Ci sei quasi... continua ad allenarti!</div>
        @else
            <div class="feedback-message">Serve un po' di ripasso!</div>
        @endif

        <div class="action-buttons">
            <a href="{{ route('quiz.show') }}" class="action-btn retry-btn">Riprova quiz capitali</a>
            <a href="{{ route('home') }}" class="action-btn home-btn">Torna alla Home</a>
        </div>
    </div>
</body>
</html>
