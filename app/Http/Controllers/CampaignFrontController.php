<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Donation;
use App\Services\Midtrans\CreateSnapTokenService;
use Illuminate\Http\Request;

class CampaignFrontController extends Controller
{
    public function detail($slug)
    {
        $campaign = Campaign::with(['comments'])->where('slug', $slug)->first();
        $categories = Category::paginate(4);
        $related = Campaign::where('category_id', $campaign->category_id)->latest()->paginate(4);

        return view('frontend.campaign.detail', [
            'campaign' => $campaign,
            'categories' => $categories,
            'related' => $related,
        ]);
    }

    public function store_donation(Request $request)
    {

        $validatedData = $request->validate([
            'amount' => 'required',
       
        ]);
        $validatedData['amount'] = preg_replace('/[^0-9]/', '', $validatedData['amount']);

        $data = new Donation();
        $data->user_id = $request->user_id;
        $data->campaign_id = $request->campaign_id;
        $data->invoice_number = 'INV-DL-'.date('Ymdhis').'-'. $request->user_id;
        $data->amount = $validatedData['amount'] ;
        $data->status = "paid";
        $data->save();

        $id = $data->id;

        $snapToken = $data->snap_token;
        if (is_null($snapToken)) {
            $midtrans = new CreateSnapTokenService($data);
            $snapToken = $midtrans->getSnapToken();
            Donation::where("id", $id)->update(['snap_token' => $snapToken]);
        }
        
        return response()->json([
            'status' => 'success',
            'message' => 'Pembelian berhasil dilakukan.',
            'data' => Donation::find($id)
        ]);
    }

    public function comment(Request $request)
    {
        $data = new Comment();
        $data->user_id = $request->user_id;
        $data->campaign_id = $request->campaign_id;
        $data->comment = $request->comment;
        $data->save();

        return redirect()->back()->with('success', 'New Campaign Added!');

       
       
    }

    public function allCampaign(Request $request)
    {
        // $category = $request->query('category');
       
        if ($request->query('category')) {
            $category = Category::where('slug', $request->query('category'))->first();
            $campaigns = Campaign::where('category_id', $category->id)->get();
        } else {
            $campaigns = Campaign::get();
        }

        $categories = Category::get();
        
        return view('frontend.campaign.index', [
            'campaigns' => $campaigns,
            'categories' => $categories,
        ]);
    }
    public function allCategory()
    {
        $categories = Category::get();
        return view('frontend.category.index', [
            'categories' => $categories
        ]);
    }
    public function myDonation()
    {
        $donations = Donation::where('user_id', auth()->user()->id)->get();
        return view('frontend.campaign.mydonation', [
            'donations' => $donations
        ]);
    }

    
}
