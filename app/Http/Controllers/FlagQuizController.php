<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FlagQuizController extends Controller
{
    // Mostra il quiz
    public function quiz()
    {
        // Ottieni tutti i paesi dall'API REST Countries
        $response = Http::get('https://restcountries.com/v3.1/all');

        if (!$response->successful()) {
            abort(500, 'Errore nel recupero dei dati dei paesi');
        }

        $allCountries = $response->json();

        // Filtra i paesi che hanno i dati minimi necessari
        $filtered = array_filter($allCountries, function ($country) {
            return isset($country['name']['common'], $country['cca2']);
        });

        $countries = array_values($filtered); // reset chiavi array

        // Scegli il paese corretto
        $correct = $countries[array_rand($countries)];

        // Scegli 3 distrattori diversi dal corretto
        $distractors = [];
        while (count($distractors) < 3) {
            $random = $countries[array_rand($countries)];
            if (
                $random['name']['common'] !== $correct['name']['common'] &&
                !in_array($random['name']['common'], array_column($distractors, 'name', 'common'))
            ) {
                $distractors[] = $random;
            }
        }

        // Crea le opzioni e mescolale
        $options = array_merge([$correct], $distractors);
        shuffle($options);

        // Salva la risposta corretta in sessione
        session(['flag_correct' => $correct['name']['common']]);

        // Prepara URL bandiera
        $code = strtolower($correct['cca2']);
        $flagUrl = "https://flagcdn.com/256x192/{$code}.png"; // oppure .svg

        return view('flag-quiz', [
            'flag' => $flagUrl,
            'options' => $options,
        ]);
    }

    // Verifica la risposta dell'utente
    public function checkAnswer(Request $request)
    {
        $answer = $request->input('answer');
        $correct = session('flag_correct');

        if ($answer === $correct) {
            return redirect()->route('flag.quiz')->with('message', '✅ Risposta corretta!');
        } else {
            return redirect()->route('flag.quiz')->with('message', '❌ Risposta sbagliata. Riprova!');
        }
    }
}
