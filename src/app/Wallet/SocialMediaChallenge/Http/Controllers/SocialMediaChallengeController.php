<?php


namespace App\Wallet\SocialMediaChallenge\Http\Controllers;


use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Traits\CollectionPaginate;
use Illuminate\Http\Request;
use App\Models\SocialMediaChallenge;
use Illuminate\Support\Facades\View;

class SocialMediaChallengeController extends Controller
{


    public function view(Request $request)
    {

        $status = SocialMediaChallenge::groupBy('status')->pluck('status')->toArray();

        View::share('status', $status);

        $socialMediaChallenges = SocialMediaChallenge::filter($request)->paginate(20);

        return view('SocialMediaChallenge::view-social-media-challenge', compact('socialMediaChallenges'));
    }

    public function create(Request $request)
    {
        $socialMediaChallenges = SocialMediaChallenge::all();

        return view('SocialMediaChallenge::create-social-media-challenge', compact('socialMediaChallenges'));

    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'code' => ['required','unique:dpaisa.social_challenges']
            ]);
        }catch (\Exception $e){
//            dd('asd');
            return redirect()->back()->with('error', 'Failed to create. Social Media Challenge Code should be unique to each challenge.');
        }

        SocialMediaChallenge::create([
            'title' => $request->get('title'),
            'description' => $request->get('description'),
            'code' => $request->get('code'),
            'type' => $request->get('type'),
            'terms_and_conditions' => $request->get('terms_and_conditions'),
            'status' => $request->get('status'),
            'attempts_per_user' => $request->get('attempts_per_user'),
            'expired_at' => $request->get('expired_at'),
            'created_at' => $request->get('created_at'),
            'special1' => $request->get('special1'),
            'special2' => $request->get('special2'),
            'special3' => $request->get('special3'),
            'special4' => $request->get('special4'),

        ]);

        return redirect()->route('socialmediachallenge.view')->with('success', 'Social Media Challenge Added Successfully.');
    }

    public function delete($id)
    {
        $socialMediaChallenge = SocialMediaChallenge::findOrFail($id);

        $socialMediaChallenge->delete();

        return redirect()->route('socialmediachallenge.view')->with('success', 'Social Media Challenge Deleted Successfully.');
    }

    public function edit($id)
    {

        $socialMediaChallenge = SocialMediaChallenge::findOrFail($id);

        return view('SocialMediaChallenge::edit-social-media-challenge', compact('socialMediaChallenge'));
    }

    public function update(Request $request, $id)
    {

        $socialMediaChallenge = SocialMediaChallenge::findOrFail($id);

        $socialMediaChallenge = SocialMediaChallenge::where('id', $id)->update([
            'title' => $request->get('title'),
            'description' => $request->get('description'),
            'code' => $request->get('code'),
            'type' => $request->get('type'),
            'terms_and_conditions' => $request->get('terms_and_conditions'),
            'status' => $request->get('status'),
            'attempts_per_user' => $request->get('attempts_per_user'),
            'expired_at' => $request->get('expired_at'),
            'special1' => $request->get('special1'),
            'special2' => $request->get('special2'),
            'special3' => $request->get('special3'),
            'special4' => $request->get('special4'),
        ]);

        return redirect()->route('socialmediachallenge.view')->with('success', 'Updated successfully');
    }

}
