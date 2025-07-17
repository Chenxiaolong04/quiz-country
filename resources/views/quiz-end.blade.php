<!DOCTYPE html>
<html>
<head>
    <title>Quiz Finito</title>
</head>
<body>
    <h1>Hai completato il quiz!</h1>
    <p>Hai risposto correttamente a <strong>{{ $score }}</strong> domande su 3.</p>

    @if ($score == 3)
        <p>Sei un campione della geografia! </p>
    @elseif ($score >= 2)
        <p>Ottimo lavoro!</p>
    @elseif ($score >= 1)
        <p>Ci sei quasi... continua ad allenarti!</p>
    @else
        <p>Serve un po' di ripasso!</p>
    @endif

    <a href="{{ url('/quiz') }}">Ricomincia</a>
</body>
</html>
