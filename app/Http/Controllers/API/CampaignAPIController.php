<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use Illuminate\Http\Request;

class CampaignApiController extends Controller
{
    public function index()
    {
        $campaigns = Campaign::get();
        foreach ($campaigns as $key => $campaign) {
            $campaigns[$key]['total_collected'] = (int) $campaign->donations()->sum('amount');
            $campaigns[$key]['total_collected_percentage'] = $campaign->donations()->sum('amount') / $campaign->target * 100 > 100 ? 100 : round(($campaign->donations()->sum('amount') / $campaign->target * 100));
        }
        
        $response = [
            'statusCode' => 200,
            'body' => $campaigns
        ];

        return response()->json($response, 200);
    }
    public function show($slug)
    {
        $campaigns = Campaign::where('slug', $slug)->get();
        foreach ($campaigns as $key => $campaign) {
            $campaigns[$key]['total_collected'] = (int) $campaign->donations()->sum('amount');
            $campaigns[$key]['total_collected_percentage'] = $campaign->donations()->sum('amount') / $campaign->target * 100 > 100 ? 100 : round(($campaign->donations()->sum('amount') / $campaign->target * 100));
        }
        
        $response = [
            'statusCode' => 200,
            'body' => $campaigns
        ];

        return response()->json($response, 200);
    }
}
