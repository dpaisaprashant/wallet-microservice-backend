<?php


namespace App\Wallet\SocialMediaChallenge\Http\Controllers;


use App\Models\SocialMediaChallengeWinner;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Traits\CollectionPaginate;
use Illuminate\Http\Request;
use App\Models\SocialMediaChallenge;
use Illuminate\Support\Facades\View;

class SocialMediaChallengeWinnerController extends Controller
{


    public function view(Request $request)
    {

        $socialMediaChallengeWinners = SocialMediaChallengeWinner::filter($request)->paginate(20);

        return view('SocialMediaChallengeWinner::view-social-media-challenge-winner',compact('socialMediaChallengeWinners'));
    }
}
