<?php


namespace App\Wallet\SocialMediaChallenge\Http\Controllers;


use App\Models\SocialMediaChallengeUser;
use App\Models\SocialMediaChallengeWinner;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Traits\CollectionPaginate;
use Illuminate\Http\Request;
use App\Models\SocialMediaChallenge;
use Illuminate\Support\Facades\View;

class SocialMediaChallengeUserController extends Controller
{
    public function view($id)
    {

//        $status = SocialMediaChallenge::groupBy('status')->pluck('status')->toArray();
//        View::share('status', $status);

        $socialMediaChallengeUsers = SocialMediaChallengeUser::with('socialMediaChallenge')->where('social_challenge_id', $id)->paginate(20);
//        $socialMediaChallengeWinner = SocialMediaChallengeWinner::with('challengeWinner')->where()->get();

        return view('SocialMediaChallenge::socialMediaChallengeUser/view-social-media-challenge-user', compact('socialMediaChallengeUsers'));
    }

//    public function store(Request $request)
//    {
//        SocialMediaChallengeUser::create([
//            'social_challenge_id' => $request->get('social_challenge_id'),
//            'user_id' => $request->get('user_id'),
//            'link' => $request->get('link'),
//            'embed_link' => $request->get('embed_link'),
//            'caption' => $request->get('caption'),
//            'challenge_status' => $request->get('challenge_status'),
//            'special1' => $request->get('special1'),
//            'special2' => $request->get('special2'),
//            'special3' => $request->get('special3'),
//            'special4' => $request->get('special4'),
//        ]);
//
//        return redirect()->route('socialmediachallenge.user.view')->with('success', 'Social Media Challenge Added Successfully.');
//    }
//
//    public function delete($id)
//    {
//        $socialMediaChallenge = SocialMediaChallengeUser::findOrFail($id);
//
//        $socialMediaChallenge->delete();
//
//        return redirect()->route('socialmediachallenge.view')->with('success', 'Social Media Challenge Deleted Successfully.');
//    }

    public function edit($id)
    {

        $socialMediaChallengeUser = SocialMediaChallengeUser::findOrFail($id);

        return view('SocialMediaChallenge::socialMediaChallengeUser/edit-social-media-challenge-user', compact('socialMediaChallengeUser'));
    }

    public function update(Request $request, $id)
    {

        $socialMediaChallengeUser = SocialMediaChallengeUser::findOrFail($id);

        SocialMediaChallengeUser::where('id', $id)->update([
            'link' => $request->get('link'),
            'embed_link' => $request->get('embed_link'),
            'caption' => $request->get('caption'),
            'challenge_status' => $request->get('challenge_status'),
            'facebook_link' => $request->get('facebook_link'),
            'special1' => $request->get('special1'),
            'special2' => $request->get('special2'),
            'special3' => $request->get('special3'),
            'special4' => $request->get('special4'),
        ]);

        return redirect()->route('socialmediachallenge.user.edit',$socialMediaChallengeUser->socialMediaChallenge->id)->with('success', 'Updated successfully');
    }

        public function selectWinner(Request $request)
    {
//        dd('here');

//        $socialMediaChallengeUser = SocialMediaChallengeUser::find($request->get('user_id'));
//        $socialMediaChallenge = SocialMediaChallenge::where($request->get('social_challenges_id'));
        SocialMediaChallengeWinner::create([
            'social_challenge_id' => $request->get('social_challenge_id'),
            'user_id' => $request->get('user_id'),
            'won_at' => $request->get('won_at'),
            'description' => $request->get('description'),
        ]);

        return redirect()->route('socialmediachallenge.view')->with('success', 'The Winner for the challenge has been crowned!');
    }

}
