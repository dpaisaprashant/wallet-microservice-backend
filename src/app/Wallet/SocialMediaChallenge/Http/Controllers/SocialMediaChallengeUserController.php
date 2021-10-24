<?php


namespace App\Wallet\SocialMediaChallenge\Http\Controllers;


use App\Models\SocialMediaChallengeUser;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Traits\CollectionPaginate;
use Illuminate\Http\Request;
use App\Models\SocialMediaChallenge;
use Illuminate\Support\Facades\View;

class SocialMediaChallengeUserController extends Controller
{
    public function view(Request $request)
    {

//        $status = SocialMediaChallenge::groupBy('status')->pluck('status')->toArray();
//        View::share('status', $status);

        $socialMediaChallengeUsers = SocialMediaChallengeUser::filter($request)->paginate(20);

        return view('SocialMediaChallenge::socialMediaChallengeUser/view-social-media-challenge-user',compact('socialMediaChallengeUsers'));
    }

    public function create(Request $request)
    {
        $socialMediaChallengeUsers = SocialMediaChallengeUser::all();

        return view('SocialMediaChallenge::socialMediaChallengeUser/create-social-media-challenge-user',compact('socialMediaChallengeUsers'));

    }

    public function store(Request $request)
    {
        SocialMediaChallengeUser::create([
            'social_challenge_id' => $request->get('social_challenge_id'),
            'user_id' => $request->get('user_id'),
            'link' => $request->get('link'),
            'embed_link' => $request->get('embed_link'),
            'caption' => $request->get('caption'),
            'challenge_status' => $request->get('challenge_status'),
            'special1' => $request->get('special1'),
            'special2' => $request->get('special2'),
            'special3' => $request->get('special3'),
            'special4' => $request->get('special4'),
        ]);

        return redirect()->route('socialmediachallenge.user.view')->with('success','Social Media Challenge Added Successfully.');
    }

    public function delete($id)
    {
        $socialMediaChallenge = SocialMediaChallengeUser::findOrFail($id);

        $socialMediaChallenge->delete();

        return redirect()->route('socialmediachallenge.view')->with('success','Social Media Challenge Deleted Successfully.');
    }

    public function edit($id){

        $socialMediaChallenge = SocialMediaChallengeUser::findOrFail($id);

        return view('SocialMediaChallenge::edit-social-media-challenge', compact('socialMediaChallenge'));
    }

    public function update(Request $request, $id){

        $socialMediaChallenge = SocialMediaChallengeUser::findOrFail($id);

        $socialMediaChallenge = SocialMediaChallengeUser::where('id', $id)->update([
            'social_challenge_id' => $request->get('social_challenge_id'),
            'user_id' => $request->get('user_id'),
            'link' => $request->get('link'),
            'embed_link' => $request->get('embed_link'),
            'caption' => $request->get('caption'),
            'challenge_status' => $request->get('challenge_status'),
            'special1' => $request->get('special1'),
            'special2' => $request->get('special2'),
            'special3' => $request->get('special3'),
            'special4' => $request->get('special4'),
        ]);

        return redirect()->route('socialmediachallenge.view')->with('success','Updated successfully');
    }

}
