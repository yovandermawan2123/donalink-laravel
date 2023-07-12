<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Category;
use App\Models\Donation;
use App\Services\Upload\UploadService;
use Illuminate\Http\Request;
use File;
use PDF;

class CampaignController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $campaigns = Campaign::get();
        return view('backend.campaign.index', [
            'campaigns' => $campaigns
        ]);
    }
    public function donations($id)
    {
        $campaign = Campaign::find($id);

        $donations = Donation::with(['campaign', 'user'])->where('campaign_id', $id)->get();
        return view('backend.donation.index', [
            'donations' => $donations,
            'campaign' => $campaign,
        ]);
    }

    public function print($id)
    {
        $campaign = Campaign::find($id);
        $donations = Donation::with(['campaign', 'user'])->where('campaign_id', $id)->get();
        $pdf = PDF::loadview('backend.donation.print',['donations'=>$donations, 'campaign' => $campaign]);
    	return $pdf->download('laporan-donasi.pdf');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::get();
        return view('backend.campaign.create', [
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'name' => 'required|max:255|unique:campaigns',
            'slug' => 'required|max:255|unique:campaigns',
            'category_id' => 'required',
            'target' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'description' => 'required',
        ]);

        $validatedData['target'] = preg_replace('/[^0-9]/', '', $validatedData['target']);

        if ($request->file('image')) {
            $file = (new UploadService())->saveFile($request->file('image'), 'images/campaigns');
            $validatedData['image'] = $file["name"];
        }

        $validatedData['status'] = 'Active';



        Campaign::create($validatedData);

        return redirect('/campaign')->with('success', 'Campaign has been Added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function show(Campaign $campaign)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $campaign = Campaign::where('id', $id)->first();
        $categories = Category::get();

        return view('backend.campaign.edit', [
            'campaign' => $campaign,
            'categories' => $categories,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'slug' => 'required|max:255',
            'category_id' => 'required',
            'target' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'description' => 'required',
        ]);

        $campaign = Campaign::find($id);

        

        $validatedData['target'] = preg_replace('/[^0-9]/', '', $validatedData['target']);

        if ($request->file('image')) {
            if (File::exists(public_path('/images/campaigns/' . $campaign->image))) {
                File::delete(public_path('/images/campaigns/' . $campaign->image));

                $file = (new UploadService())->saveFile($request->file('image'), 'images/campaigns');
            } else {
                $file = (new UploadService())->saveFile($request->file('image'), 'images/campaigns');
            }
            $validatedData['image'] = $file["name"];
          
        }

        $validatedData['status'] = 'Active';


        $campaign->update($validatedData);
        // Campaign::create($validatedData);

        return redirect('/campaign')->with('success', 'Campaign has been Edited!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function destroy(Campaign $campaign, $id)
    {
        $campaign = Campaign::find($id);

        if ($campaign->image != null) {
            if (File::exists(public_path('/images/campaigns/' . $campaign->image))) {
                File::delete(public_path('/images/campaigns/' . $campaign->image));
            }
            // else{
            //     dd('File does not exists.');
            // }
        }

        $campaign->delete();

        return redirect('/campaign')->with('success', 'Campaign has been deleted!');
    }
}
