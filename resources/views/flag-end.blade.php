<!DOCTYPE html>
<html>
<head>
    <title>Quiz Bandiere Finito</title>
</head>
<body>
    <h1>Hai completato il quiz delle bandiere!</h1>
    <p>Hai risposto correttamente a <strong>{{ $score }}</strong> domande su 3.</p>

    @if ($score == 3)
        <p>Sei un campione delle bandiere!</p>
    @elseif ($score >= 2)
        <p>Ottimo lavoro con le bandiere!</p>
    @elseif ($score >= 1)
        <p>Ci sei quasi... continua ad allenarti con le bandiere!</p>
    @else
        <p>Serve un po' di ripasso sulle bandiere!</p>
    @endif

    <a href="{{ route('flag.quiz') }}">Riprova quiz bandiere</a>
    <a href="{{ route('home') }}">Torna alla Home</a>
</body>
</html>
