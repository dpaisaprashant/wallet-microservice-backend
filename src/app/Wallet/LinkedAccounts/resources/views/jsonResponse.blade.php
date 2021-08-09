<a data-toggle="modal" href="#modal-form-json-response{{$LinkedAccount->id}}">
    <button class="btn btn-warning btn-icon" type="button" title="Json Response"><i class="fa fa-info"></i></button>
</a>
<div id="modal-form-json-response{{$LinkedAccount->id}}" class="modal fade" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 750px !important;">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="m-t-none m-b">Json Response</h3>
                        <hr>
                        @if(!empty($LinkedAccount->json_response))
                        {{-- <dl class="row m-t-md">                        --}}
                            {{$LinkedAccount->json_response}}
                        {{-- </dl> --}}
                        @else
                            <dl class="text-left">No Data</dl>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>