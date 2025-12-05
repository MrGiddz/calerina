<?php

namespace App\Http\Controllers\SEO;

use App\Helpers\Classes\Helper;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Services\Search\SerperDev;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use OpenAI\Laravel\Facades\OpenAI;
use App\Models\OpenAIGenerator;
use App\Models\UserOpenai;
use Illuminate\Support\Str;
use App\Services\SEO\SEOService;

class SeoController extends Controller
{	
	# seo tool	
	public function index(){
        return view('panel.user.seo-tool.index');
    }
	public function suggestKeywords(Request $request){
		$user = Auth::user();
		if ($user->remaining_words <= 0 and $user->remaining_words != -1) {
			$data = [
				'message' => ['You have no credits left. Please consider upgrading your plan.'],
			];
			return response()->json($data, 419);
		}
		$keywords = SEOService::getKeywords($request->keyword);
		return response()->json(['result' => $keywords])->header('Content-Type', 'application/json');
	}
	public function analyseArticle(Request $request){
		$user = Auth::user();
		if ($user->remaining_words <= 0 and $user->remaining_words != -1) {
			$data = [
				'message' => ['You have no credits left. Please consider upgrading your plan.'],
			];
			return response()->json($data, 419);
		}
		$analizingResult = SEOService::analiyzeWithAI($request);
		$percentage = $analizingResult['percentage'];
		$competitorList = $analizingResult['competitorList'];
		$longTailList = $analizingResult['longTailList'];
		return response()->json(['competitorList' => $competitorList, 'percentage'=> $percentage, 'longTailList' => $longTailList])->header('Content-Type', 'application/json');
	}
	public function improveArticle(Request $request){
		$user = Auth::user();
		if ($user->remaining_words <= 0 and $user->remaining_words != -1) {
			$data = [
				'message' => ['You have no credits left. Please consider upgrading your plan.'],
			];
			return response()->json($data, 419);
		}
		return SEOService::improveWithAI($request);
	}
	# article wizard
    public function generateKeywords(Request $request)
    {
        $user = Auth::user();
        if ($user->remaining_words <= 0 and $user->remaining_words != -1) {
            $data = [
                'message' => ['You have no credits left. Please consider upgrading your plan.'],
            ];

            return response()->json($data, 419);
        }
        try {
			$keywords = SEOService::getKeywords($request->topic);
            $jsonKeywords = collect($keywords)->map(function ($keyword) {
                return json_encode($keyword);
            });
            $jsonKeywords = "[\n".$jsonKeywords->implode(",\n")."\n]";
            return response()->json(['result' => $jsonKeywords])->header('Content-Type', 'application/json');
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }
    }
	public function genSearchQuestions(Request $request)
    {
        $user = Auth::user();
        if ($user->remaining_words <= 0 and $user->remaining_words != -1) {
            $data = [
                'message' => ['You have no credits left. Please consider upgrading your plan.'],
            ];
            return response()->json($data, 419);
        }
        try {
			$stringQuestions = SEOService::getSearchQuestions($request);
            return response()->json(['result' => $stringQuestions])->header('Content-Type', 'application/json');
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }
    }

	# admin seo helpers
    public function genSEO(Request $request)
    {
        $user = Auth::user();
        if ($user->type != 'admin') {
            return response()->json([
                'message' => 'You are not authorized to access this resource',
            ], 403);
        }
        try {
			$result = SEOService::generateSEO($request);
            return response()->json(['result' => $result])->header('Content-Type', 'application/json');
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}