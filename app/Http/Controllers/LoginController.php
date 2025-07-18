<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LoginController extends Controller
{
    private $usersFile = 'users.json';

    public function showLogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'nickname' => 'required|string|max:255'
        ]);

        $nickname = $request->input('nickname');
        $users = $this->getUsers();
        
        // Controlla se l'utente esiste
        if (isset($users[$nickname])) {
            // Utente esistente - carica i dati
            $userData = $users[$nickname];
            session([
                'user_nickname' => $nickname,
                'user_data' => $userData
            ]);
        } else {
            // Nuovo utente - crea i dati
            $userData = [
                'nickname' => $nickname,
                'data_creazione' => now()->format('Y-m-d H:i:s'),
                'punteggio_quiz' => 0,
                'punteggio_flag' => 0
            ];
            
            $users[$nickname] = $userData;
            $this->saveUsers($users);
            
            session([
                'user_nickname' => $nickname,
                'user_data' => $userData
            ]);
        }

        return redirect()->route('home');
    }

    public function logout()
    {
        session()->forget(['user_nickname', 'user_data']);
        return redirect()->route('login');
    }

    public function updateScore($type, $score)
    {
        $nickname = session('user_nickname');
        if (!$nickname) return;

        $users = $this->getUsers();
        if (isset($users[$nickname])) {
            if ($type === 'quiz') {
                $users[$nickname]['punteggio_quiz'] = max($users[$nickname]['punteggio_quiz'], $score);
            } elseif ($type === 'flag') {
                $users[$nickname]['punteggio_flag'] = max($users[$nickname]['punteggio_flag'], $score);
            }
            
            $this->saveUsers($users);
            session(['user_data' => $users[$nickname]]);
        }
    }

    private function getUsers()
    {
        if (!Storage::exists($this->usersFile)) {
            return [];
        }
        
        $content = Storage::get($this->usersFile);
        return json_decode($content, true) ?: [];
    }

    private function saveUsers($users)
    {
        Storage::put($this->usersFile, json_encode($users, JSON_PRETTY_PRINT));
    }
}