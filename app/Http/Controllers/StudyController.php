<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class StudyController extends Controller
{
    public function index(Request $request)
    {
        // Reset della sessione solo se non c'è una sessione attiva E non c'è l'azione
        $action = $request->query('action');
        if (!session()->has('study_history') && empty($action)) {
            session()->forget(['study_history', 'study_current_index']);
        }
        
        $response = Http::get('https://restcountries.com/v3.1/all?fields=name,capital,cca2');
        if (!$response->successful()) {
            abort(500, 'Errore nel recupero dei dati dei paesi');
        }
        $countries = $response->json();
        $filtered = array_filter($countries, function ($country) {
            return isset($country['capital'][0]) && isset($country['name']['common']) && isset($country['cca2']);
        });
        if (empty($filtered)) {
            abort(500, 'Nessun paese trovato');
        }

        $history = session('study_history', []);
        $currentIndex = session('study_current_index', -1);

        // Aggiungi un nuovo paese solo se non c'è l'azione (cioè quando clicchi "Nuova Nazione")
        if (empty($action)) {
            $randomCountry = $filtered[array_rand($filtered)];
            $history[] = [
                'country' => $randomCountry['name']['common'],
                'capital' => $randomCountry['capital'][0],
                'flag_code' => strtolower($randomCountry['cca2']),
            ];
            $currentIndex = count($history) - 1;
            session(['study_history' => $history, 'study_current_index' => $currentIndex]);
        }

        $currentCountry = $history[$currentIndex] ?? null;
        if (!$currentCountry) {
            abort(500, 'Errore nel recupero del paese corrente');
        }

        $question = "Capitale di " . $currentCountry['country'] . "?";
        $answer = $currentCountry['capital'];
        $flagUrl = "https://flagcdn.com/w160/{$currentCountry['flag_code']}.png";

        $canGoBack = $currentIndex > 0;
        $canGoForward = $currentIndex < count($history) - 1;

        return view('study', compact('question', 'answer', 'flagUrl', 'canGoBack', 'canGoForward'));
    }

    public function navigate(Request $request)
    {
        $currentIndex = session('study_current_index', -1);
        $history = session('study_history', []);
        $action = $request->input('action');

        if ($action === 'back' && $currentIndex > 0) {
            $currentIndex--;
        } elseif ($action === 'next' && $currentIndex < count($history) - 1) {
            $currentIndex++;
        }

        session(['study_current_index' => $currentIndex]);
        // Passa 'action' per evitare di aggiungere un nuovo paese
        return redirect()->route('study.index', ['action' => $action]);
    }
}