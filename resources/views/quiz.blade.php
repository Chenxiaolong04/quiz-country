<!DOCTYPE html>
<html>
<head>
    <title>Quiz Geografico</title>
    <link rel="stylesheet" href="{{ asset('css/QuestQuiz.css') }}">
</head>
<body>
    <div class="quiz-container">
        <div class="decorative-element"></div>
        <div class="quiz-icon">🏛️</div>
        
        <div class="quiz-header">
            <div class="question-counter">Domanda {{ $quiz['count'] }} di 10</div>
            <div class="progress-bar">
                <div class="progress-fill" style="width: {{ ($quiz['count'] / 10) * 100 }}%"></div>
            </div>
            <h3 class="question-title">{{ $quiz['question'] }}</h3>
        </div>

        <form class="quiz-form" method="POST" action="{{ route('quiz.check') }}" onsubmit="return validateForm()">
            @csrf
            <div class="options-container">
                @foreach ($quiz['options'] as $option)
                    <label class="option-item">
                    <input type="radio" name="option" value="{{ $option }}" class="option-radio" required />
                    <span class="option-label">{{ $option }}</span>
                    </label>
                @endforeach
            </div>

            <div class="form-actions">
                <button class="action-btn submit-btn" type="submit">Invia</button>
                <a href="{{ url('/') }}" class="action-btn home-btn">Torna alla Home</a>
            </div>
        </form>
    </div>

    <script>
        function validateForm() {
            const options = document.querySelectorAll('input[name="option"]');
            let isSelected = false;
            
            for (let option of options) {
                if (option.checked) {
                    isSelected = true;
                    break;
                }
            }
            
            if (!isSelected) {
                alert('Per favore, seleziona una risposta prima di inviare!');
                return false;
            }
            
            return true;
        }
    </script>
</body>
</html>
