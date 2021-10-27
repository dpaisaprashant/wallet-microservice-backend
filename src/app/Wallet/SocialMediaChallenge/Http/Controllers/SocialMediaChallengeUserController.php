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
        $challenge_status = SocialMediaChallengeUser::groupBy('challenge_status')->pluck('challenge_status')->toArray();
        View::share('challenge_status', $challenge_status);

        $socialMediaChallengeUsers = SocialMediaChallengeUser::with('socialMediaChallenge')->where('social_challenge_id', $id)->filter(request())->paginate(20);
//        $socialMediaChallengeWinner = SocialMediaChallengeWinner::with('challengeWinner')->where()->get();
        $socialMediaChallenge = SocialMediaChallenge::where('id', $id)->first();
        return view('SocialMediaChallenge::socialMediaChallengeUser/view-social-media-challenge-user', compact('socialMediaChallengeUsers', 'socialMediaChallenge'));
    }


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

        return redirect()->route('socialmediachallenge.user.edit', $socialMediaChallengeUser->socialMediaChallenge->id)->with('success', 'Updated successfully');
    }

    public function selectWinner(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required',
            'social_challenge_id' => 'required',
        ]);

        $socialMediaChallengeUser = SocialMediaChallengeUser::where('user_id', $request->get('user_id'));
        $socialMediaChallenge = SocialMediaChallenge::where('id', $request->get('social_challenge_id'));
        $challenge = $socialMediaChallenge->first();
        $socialChallengeWinner = SocialMediaChallengeWinner::all();

        $alreadyWon = SocialMediaChallengeWinner::where('user_id', $request->user_id)
            ->where('social_challenge_id', $request->social_challenge_id)
            ->first();
        if ($alreadyWon) {
            return redirect()->route('socialmediachallenge.view')->with('error', 'The user is already a winner of ' . $challenge['title']);
        }

        SocialMediaChallengeWinner::create([
            'social_challenge_id' => $request->get('social_challenge_id'),
            'user_id' => $request->get('user_id'),
            'won_at' => $request->get('won_at'),
            'description' => $request->get('description'),
        ]);

        return redirect()->route('socialmediachallenge.view')->with('success', 'The Winner for the ' . $challenge['title'] . ' has been crowned!');
    }

    public function selectWinnerRandom($id)
    {
        $alreadyWon=1;
        while($alreadyWon==1) {
            $socialMediaChallengeUser = SocialMediaChallengeUser::with('user')->where('social_challenge_id', $id)->get()->random(1)->first();
//        $socialChallengeWinner = SocialMediaChallengeWinner::all();
            $challengeTitle = $socialMediaChallengeUser->socialMediaChallenge->title;

            $alreadyWon = SocialMediaChallengeWinner::where('user_id', $socialMediaChallengeUser->user_id)
                ->where('social_challenge_id', $socialMediaChallengeUser->social_challenge_id)
                ->first();

            if ($alreadyWon) {
//            return  'The user is already a winner of ' . $challengeTitle.'. Try Again.';
                $alreadyWon = 1;
            } else {
                $alreadyWon = 0;
            }
        }
        return [
            "url" => route('socialmediachallenge.winner.random.add', $socialMediaChallengeUser->id),
            "user" => $socialMediaChallengeUser,
        ];
    }

    public function addToWinnersTable($id)
    {

        $socialMediaChallengeUser = SocialMediaChallengeUser::with('user','socialMediaChallenge')->where('id', $id)->first();

//        return $socialMediaChallengeUser;
        $challengeTitle = $socialMediaChallengeUser->socialMediaChallenge->title;

        SocialMediaChallengeWinner::create([
            'social_challenge_id' => $socialMediaChallengeUser->social_challenge_id,
            'user_id' => $socialMediaChallengeUser->user_id,
            'won_at' => Carbon::now()->format('Y-m-d'),
            'description' => 'The Lucky Winner of ' . $challengeTitle,
        ]);

        return $socialMediaChallengeUser;
    }

//    public function delete($id)
//    {
//        $socialMediaChallenge = SocialMediaChallengeUser::findOrFail($id);
//
//        $socialMediaChallenge->delete();
//
//        return redirect()->route('socialmediachallenge.view')->with('success', 'Social Media Challenge Deleted Successfully.');
//    }

}
