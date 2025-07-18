<!-- resources/views/home.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Quiz Geografia - Home</title>
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
</head>
<body>
    <div class="home-container">
        <a href="{{ url('/login') }}" class="login-btn">Login</a>
        <div class="decorative-element"></div>
        <div class="world-icon">🌍</div>

        <h1 class="home-title">Quiz sulla Geografia</h1>
        <p class="home-subtitle">Metti alla prova le tue conoscenze geografiche</p>
        
        <div class="quiz-grid">
            <a href="{{ url('/quiz') }}" class="quiz-card capitals-card">
                <span class="quiz-icon">🏛️</span>
                <h3 class="quiz-title">Indovina la Capitale</h3>
                <p class="quiz-description">Conosci le capitali di tutti i paesi del mondo?</p>
            </a>
            
            <a href="{{ url('/flag-quiz') }}" class="quiz-card flags-card">
                <span class="quiz-icon">🚩</span>
                <h3 class="quiz-title">Indovina la Bandiera</h3>
                <p class="quiz-description">Riconosci le bandiere delle diverse nazioni?</p>
            </a>
            
            <a href="{{ url('/hang') }}" class="quiz-card hang-card">
                <span class="quiz-icon">🎯</span>
                <h3 class="quiz-title">Impiccato</h3>
                <p class="quiz-description">Gioca al classico gioco dell'impiccato sulla Geografia!</p>
            </a>

            <a href="{{ url('/study') }}" class="quiz-card hang-card">
                <span class="quiz-icon">📚</span>
                <h3 class="quiz-title">Studia</h3>
                <p class="quiz-description">Approfondisci le tue conoscenze geografiche!</p>
            </a>
        </div>
        
        <p class="footer-text">Scegli un quiz e inizia a giocare!</p>
    </div>
</body>
</html>
