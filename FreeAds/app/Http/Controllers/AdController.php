<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Ad;
use App\Picture;
use App\User;
use Illuminate\Http\Request;

class AdController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ads = Ad::orderBy('created_at', 'desc')->paginate(5);

        return view('ads/ads', compact('ads'));        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ads/new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Picture $picture)
    {


        $this->validate($request, [

            'pictures' => 'required',
            'pictures.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
    ]);

        $ad = new Ad();

        $ad->user_id = Auth::user()->id;
        $ad->title = $request->input('title');
        $ad->description = $request->input('description');
        $ad->price = $request->input('price');
        $ad->save();

        if($files = $request->file('pictures'))
        {
            foreach($files as $file)
            {

                $extension = $file->getClientOriginalExtension();
                $name = time() . '.' . $extension;
                $file->move('uploads/ad', $name);
                $pictures = $name;
                $picture::create( [
                    'ad_id' => $ad->id,
                    'name'=>  $pictures,
                    //you can put other insertion here
                ]);
            }
        }
        else {
            echo 'bad';
        }
                return redirect()->back()->with('message', 'Ad Send !');
                 

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function show(Ad $ad, Picture $picture)
    {
        $ad = Ad::where('id', $ad->id)->get();
        $picture = Picture::where('ad_id', $ad[0]->id)->get();

        return view('ads/ad', compact('ad', 'picture'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function edit(Ad $ad)
    {
        // findOrFail si lid n'es taps trouvé cette fonction renvoie une erreur 404
        $ad = Ad::findOrFail($ad->id);
        $picture = Picture::where('ad_id', $ad->id)->get();
        return view('ads/edit', compact('ad', 'picture'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ad $ad, Picture $picture)
    {

            $ad->update([
                'tite' => $request->title,
                'description' => $request->description,
                'price' => $request->price,
            ]);
            $ad->save();

            if ($files = $request->file('pictures')) {
            foreach($files as $file)
            {
                $extension = $file->getClientOriginalExtension();
                $name = time() . '.' . $extension;
                $file->move('uploads/ad', $name);
                $pictures = $name;
                $picture::create( [
                    'ad_id' => $ad->id,
                    'name'=>  $pictures,
                ]);
            }
        }
            
            return redirect()->back()->with('message', 'ad\'s updated!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ad $ad, Picture $picture)
    {
        $ad = Ad::find($ad->id);
        $picture = Picture::where('ad_id', $ad->id);
        $picture->delete();
        $ad->delete();

        return redirect('ad/ads')->with('success', 'Ad deleted !');
    }
}
