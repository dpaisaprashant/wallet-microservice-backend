<a data-toggle="modal" href="#modal-form-json-response{{$socialMediaChallenge->id}}">
    <button class="btn btn-warning btn-icon btn-sm m-t-n-xs" type="button" title="Json Response"><i class="fa fa-info"></i></button>
</a>
<div id="modal-form-json-response{{$socialMediaChallenge->id}}" class="modal fade" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 750px !important;">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="m-t-none m-b">@if(!empty($socialMediaChallenge->title)){{$socialMediaChallenge->title}} @endif
                            Info</h3>
                        <hr>
                        @if(!empty($socialMediaChallenge->description)||!empty($socialMediaChallenge->special1) || !empty($socialMediaChallenge->special2) || !empty($socialMediaChallenge->special3) || !empty($socialMediaChallenge->special4) || !empty($socialMediaChallenge->terms_and_conditions))
                            @if(!empty($socialMediaChallenge->description))
                                <b>Description :</b> <br>
                                {{$socialMediaChallenge->description}}<br><br>
                            @endif
                            @if(!empty($socialMediaChallenge->terms_and_conditions))
                                <b>Terms and Conditions :</b> <br>
                                {{$socialMediaChallenge->terms_and_conditions}}<br><br>
                            @endif

                            @if(!empty($socialMediaChallenge->special1))
                                <b>Special 1 :</b> {{$socialMediaChallenge->special1}} <br>
                            @endif
                            @if(!empty($socialMediaChallenge->special2))
                                <b>Special 2 :</b>    {{$socialMediaChallenge->special2}}<br>
                            @endif
                            @if(!empty($socialMediaChallenge->special3))
                                <b>Special 3 :</b>  {{$socialMediaChallenge->special3}}<br>
                            @endif
                            @if(!empty($socialMediaChallenge->special4))
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
