<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class StudyController extends Controller
{
    public function index(Request $request)
{
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

    if (!$request->has('action')) {
        $randomCountry = $filtered[array_rand($filtered)];
        $history[] = [
            'country' => $randomCountry['name']['common'],
            'capital' => $randomCountry['capital'][0],
            'flag_code' => strtolower($randomCountry['cca2']), // aggiunto codice bandiera
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
    $flagUrl = "https://flagcdn.com/w160/{$currentCountry['flag_code']}.png"; // URL bandiera

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