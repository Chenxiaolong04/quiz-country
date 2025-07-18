<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Login - Quiz Country</title>
    <link rel="stylesheet" href="{{ asset('css/Login.css') }}">
</head>
<body>
    <div class="login-container">
        <h1 class="login-title">Quiz Country</h1>
        
        <form class="login-form" method="POST" action="{{ route('login.store') }}">
            @csrf
            <div class="form-group">
                <label class="form-label" for="nickname">Inserisci il tuo Nickname:</label>
                <input 
                    type="text" 
                    id="nickname" 
                    name="nickname" 
                    class="form-input" 
                    placeholder="Es: GeoMaster123"
                    required
                    maxlength="255"
                >
            </div>
            
            <button type="submit" class="login-btn">Entra nel Quiz</button>
        </form>
        
        <div class="info-text">
            Se è la prima volta, verrà creato un nuovo profilo.<br>
            Altrimenti caricheremo i tuoi punteggi salvati!
        </div>
    </div>
</body>
</html>
