<a data-toggle="modal" href="#modal-form-json-response{{$socialMediaChallengeUser->id}}">
    <button class="btn btn-warning btn-icon btn-sm m-t-n-xs" type="button" title="Json Response"><i
            class="fa fa-info"></i></button>
</a>
<div id="modal-form-json-response{{$socialMediaChallengeUser->id}}" class="modal fade" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 750px !important;">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="m-t-none m-b">@if(!empty($socialMediaChallengeUser->user->name)){{$socialMediaChallengeUser->user->name}} @endif
                            Links</h3>
                        <hr>
                        @if(!empty($socialMediaChallengeUser->link))
                            <b>Name :</b> <br>
                            <a href="{{$socialMediaChallengeUser->link}}" target="_blank">{{$socialMediaChallengeUser->link}}</a><br><br>
                        @endif
                        @if(!empty($socialMediaChallengeUser->link))
                            <b>Mobile :</b> <br>
                            <a href="{{$socialMediaChallengeUser->link}}" target="_blank">{{$socialMediaChallengeUser->link}}</a><br><br>
                        @endif
                        @if(!empty($socialMediaChallengeUser->link))
                            <b>Challenge Title :</b> <br>
                            <a href="{{$socialMediaChallengeUser->link}}" target="_blank">{{$socialMediaChallengeUser->link}}</a><br><br>
                        @endif
                        @if(!empty($socialMediaChallengeUser->link))
                            <b>Win Description :</b> <br>
                            <a href="{{$socialMediaChallengeUser->link}}" target="_blank">{{$socialMediaChallengeUser->link}}</a><br><br>
                        @endif
                        @if(!empty($socialMediaChallengeUser->link))
                            <b>Win Description :</b> <br>
                            <a href="{{$socialMediaChallengeUser->link}}" target="_blank">{{$socialMediaChallengeUser->link}}</a><br><br>
                        @endif
                        @if(!empty($socialMediaChallengeUser->link))
                            <b>Win Description :</b> <br>
                            <a href="{{$socialMediaChallengeUser->link}}" target="_blank">{{$socialMediaChallengeUser->link}}</a><br><br>
                        @endif
                        @if(!empty($socialMediaChallengeUser->link))
                            <b>Win Description :</b> <br>
                            <a href="{{$socialMediaChallengeUser->link}}" target="_blank">{{$socialMediaChallengeUser->link}}</a><br><br>
                        @endif

                        @if(!empty($socialMediaChallengeUser->link)||!empty($socialMediaChallengeUser->special1) || !empty($socialMediaChallengeUser->special2) || !empty($socialMediaChallengeUser->special3) || !empty($socialMediaChallengeUser->special4) || !empty($socialMediaChallengeUser->embed_link) || !empty($socialMediaChallengeUser->facebook_link) )
                            @if(!empty($socialMediaChallengeUser->link))
                                <b>Link :</b> <br>
                                <a href="{{$socialMediaChallengeUser->link}}" target="_blank">{{$socialMediaChallengeUser->link}}</a><br><br>
                            @endif
                            @if(!empty($socialMediaChallengeUser->embed_link))
                                <b>Embed Link :</b> <br>
                                    <a href="{{$socialMediaChallengeUser->embed_link}}" target="_blank">{{$socialMediaChallengeUser->embed_link}}</a><br><br>
                            @endif
                            @if(!empty($socialMediaChallengeUser->facebook_link))
                                <b>Facebook Link :</b> <br>
                                    <a href="{{$socialMediaChallengeUser->facebook_link}}" target="_blank">{{$socialMediaChallengeUser->facebook_link}}</a><br><br>
                            @endif

                            @if(!empty($socialMediaChallengeUser->special1))
                                <b>Special 1 :</b> {{$socialMediaChallenge->special1}} <br>
                            @endif
                            @if(!empty($socialMediaChallengeUser->special2))
                                <b>Special 2 :</b>    {{$socialMediaChallenge->special2}}<br>
                            @endif
                            @if(!empty($socialMediaChallengeUser->special3))
                                <b>Special 3 :</b>  {{$socialMediaChallenge->special3}}<br>
                            @endif
                            @if(!empty($socialMediaChallengeUser->special4))
                                <b>Special 4 :</b>  {{$socialMediaChallenge->special4}}<br>
                            @endif
                        @else
                            <dl class="text-left">No Data</dl>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
