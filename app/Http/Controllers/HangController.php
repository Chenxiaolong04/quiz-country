<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Country;

class HangController extends Controller
{
    public function hang()
    {
        // Inizializza un nuovo gioco
        $this->initializeGame();
        
        $gameData = $this->getGameData();
        return view('hangman', compact('gameData'));
    }

    public function guess(Request $request)
    {
        $letter = strtoupper($request->input('letter'));
        
        // Validazione della lettera
        if (!$letter || strlen($letter) !== 1 || !ctype_alpha($letter)) {
            return redirect()->route('hangman')->with('error', 'Inserisci una lettera valida!');
        }

        // Controlla se la lettera è già stata tentata
        $guessedLetters = session('guessed_letters', []);
        if (in_array($letter, $guessedLetters)) {
            return redirect()->route('hangman')->with('error', 'Hai già tentato questa lettera!');
        }

        // Aggiunge la lettera ai tentativi
        $guessedLetters[] = $letter;
        session(['guessed_letters' => $guessedLetters]);

        $word = session('hangman_word');
        $wrongGuesses = session('wrong_guesses', 0);

        // Controlla se la lettera è presente nella parola
        if (strpos($word, $letter) !== false) {
            // Lettera corretta
            $message = 'Bravo! La lettera "' . $letter . '" è presente!';
        } else {
            // Lettera sbagliata
            $wrongGuesses++;
            session(['wrong_guesses' => $wrongGuesses]);
            $message = 'Mi dispiace, la lettera "' . $letter . '" non è presente.';
        }

        // Controlla se il gioco è finito
        if ($this->isGameWon()) {
            return redirect()->route('hangman.win');
        } elseif ($wrongGuesses >= 6) {
            return redirect()->route('hangman.lose');
        }

        $gameData = $this->getGameData();
        return view('hangman', compact('gameData'))->with('message', $message);
    }

    public function win()
    {
        $word = session('hangman_word');
        $attempts = count(session('guessed_letters', []));
        
        return view('hangman-win', compact('word', 'attempts'));
    }

    public function lose()
    {
        $word = session('hangman_word');
        $wrongGuesses = session('wrong_guesses', 0);
        
        return view('hangman-lose', compact('word', 'wrongGuesses'));
    }

    public function restart()
    {
        // Reset del gioco
        session()->forget(['hangman_word', 'guessed_letters', 'wrong_guesses']);
        return redirect()->route('hangman');
    }

    private function initializeGame()
    {
        // Inizializza solo se non c'è già un gioco in corso
        if (!session()->has('hangman_word')) {
            $country = $this->getRandomCountry();
            session([
                'hangman_word' => strtoupper($country),
                'guessed_letters' => [],
                'wrong_guesses' => 0
            ]);
        }
    }

    private function getRandomCountry()
    {
        $country = Country::inRandomOrder()->first();
        return $country ? $country->name : 'ITALIA';
    }

    private function getGameData()
    {
        $word = session('hangman_word');
        $guessedLetters = session('guessed_letters', []);
        $wrongGuesses = session('wrong_guesses', 0);

        // Crea la parola con le lettere indovinate
        $displayWord = '';
        for ($i = 0; $i < strlen($word); $i++) {
            $letter = $word[$i];
            if ($letter === ' ') {
                $displayWord .= ' ';
            } elseif (in_array($letter, $guessedLetters)) {
                $displayWord .= $letter;
            } else {
                $displayWord .= '_';
            }
            if ($i < strlen($word) - 1) {
                $displayWord .= ' ';
            }
        }

        return [
            'word' => $word,
            'displayWord' => $displayWord,
            'guessedLetters' => $guessedLetters,
            'wrongGuesses' => $wrongGuesses,
            'remainingAttempts' => 6 - $wrongGuesses,
            'isGameOver' => $wrongGuesses >= 6 || $this->isGameWon()
        ];
    }

    private function isGameWon()
    {
        $word = session('hangman_word');
        $guessedLetters = session('guessed_letters', []);

        for ($i = 0; $i < strlen($word); $i++) {
            $letter = $word[$i];
            if ($letter !== ' ' && !in_array($letter, $guessedLetters)) {
                return false;
            }
        }
        return true;
    }
}

?>