<?php

namespace App\Http\Controllers;

use Antoineaugusti\LaravelSentimentAnalysis\SentimentAnalysis;
use App\HistoryLog;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SentimentController extends Controller
{
    public function index(){
        $log = HistoryLog::all();
        $positive = 0;
        $neutral = 0;
        $negative = 0;
        foreach ($log as $data){
            if($data->result == 'positive') {
                $positive++;
            }elseif ($data->result == 'neutral'){
                $neutral++;
            }elseif ($data->result == 'negative'){
                $negative++;
            }
        }
        $resultAll = [
            'positive' => $positive,
            'neutral' => $neutral,
            'negative' => $negative,
        ];
        $log = HistoryLog::whereDate('created_at', Carbon::today())->get();
        $positive = 0;
        $neutral = 0;
        $negative = 0;
        foreach ($log as $data){
            if($data->result == 'positive') {
                $positive++;
            }elseif ($data->result == 'neutral'){
                $neutral++;
            }elseif ($data->result == 'negative'){
                $negative++;
            }
        }
        $resultDay = [
            'positive' => $positive,
            'neutral' => $neutral,
            'negative' => $negative,
        ];
        return view('index', compact(['resultAll', 'resultDay']));
    }

    public function analyzeView(){
        return view('welcome');
    }

    public function checkWord(Request $request){
        try{
            $sentiment = new SentimentAnalysis(storage_path('data/'));
            $word = $sentiment->decision($request->word);
            $history = new HistoryLog();
            $history->text = $request->word;
            $history->result = $word;
            $history->save();
            return [
                'success' => true,
                'decision' => $word
            ];
        }catch (\Exception $exception){
            return [
                'success' => false,
                'error' => $exception->getMessage()
            ];
        }
    }
}
