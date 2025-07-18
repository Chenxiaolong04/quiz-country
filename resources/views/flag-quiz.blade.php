<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Quiz Bandiera del Mondo</title>
    <link rel="stylesheet" href="css/FlagQuiz.css">
</head>
<body>
    
    <div class="quiz-container">
        <h1 class="quiz-title">Indovina la nazione dalla bandiera</h1>
        
        <div class="flag-container">
            <img class="flag-img" src="{{ $flag }}" alt="Bandiera" width="256" height="192">
        </div>
        
        <form class="quiz-form" method="POST" action="{{ route('flag.check') }}">
            @csrf
            <div class="options">
                @foreach ($options as $option)
                    <label class="option-item">
                        <input type="radio" name="answer" value="{{ $option['name']['common'] }}" class="option-radio" />
                        <span class="option-label">{{ $option['name']['common'] }}</span>
                    </label>
                @endforeach
            </div>
            <button class="submit-btn" type="submit">Invia</button>
        </form>
        
        @if(session('message'))
            <div class="feedback {{ session('success') ? 'success' : 'error' }}">
                {{ session('message') }}
            </div>
        @endif
    </div>
</body>
</html>
