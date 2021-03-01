@if(!empty($merchant->id))
<a data-toggle="modal" href="#modal-form-kyc-detail{{ $loop->index }}{{$merchant->id}}"><button class="btn btn-warning btn-icon" type="button"><i class="fa fa-info"></i></button></a>
<div id="modal-form-kyc-detail{{ $loop->index }}{{ $merchant->id }}" class="modal fade" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <dl class="row m-t-md">

                            @if(!empty($merchant->kyc))

                                @if($merchant->kyc->status == 1)
                                    <dt class="col-md-3 text-right" >Verification Status</dt>
                                    <dd class="col-md-8">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <i style="color: green;" class="fa fa-check"></i> Verified
                                            </div>
                                        </div>
                                    </dd>
                                @else
                                    <dt class="col-md-3 text-right" style="margin-top: auto; margin-bottom: auto;" >Verification Status</dt>
                                    <dd class="col-md-8" style="margin-top: auto; margin-bottom: auto;" >
                                        <div class="row">
                                            <div class="col-md-4">
                                               @include('admin.user.kyc.status', ['kyc' => $merchant->kyc])
                                            </div>
                                        </div>
                                    </dd>
                                @endif

                                <dt class="col-md-3 text-right">Date of Birth</dt>
                                <dd class="col-md-8">{{ $merchant->kyc->date_of_birth }}</dd>

                                <dt class="col-md-3 text-right">Gender</dt>
                                <dd class="col-md-8">
                                    @if($merchant->kyc->gender == 'm')
                                        Male
                                    @elseif($merchant->kyc->gender == 'f')
                                        Female
                                    @elseif($merchant->kyc->gender == 'o')
                                        Other
                                    @endif
                                </dd>

                                <dt class="col-md-3 text-right">Address</dt>
                                <dd class="col-md-8">{{ $merchant->kyc->municipality }}, {{ $merchant->kyc->district }}, Nepal</dd>

                                <dt class="col-md-3 text-right">Father's Name</dt>
                                <dd class="col-md-8">{{ $merchant->kyc->fathers_name }}</dd>

                                <dt class="col-md-3 text-right">Mother's Name</dt>
                                <dd class="col-md-8">{{ $merchant->kyc->mothers_name }}</dd>

                                <dt class="col-md-3 text-right">Grandfathers's Name</dt>
                                <dd class="col-md-8">{{ $merchant->kyc->grand_fathers_name }}</dd>

                                <dt class="col-md-3 text-right">Occupation</dt>
                                <dd class="col-md-8">{{ $merchant->kyc->occupation }}</dd>

                                <dt class="col-md-3 text-right">Identity Type</dt>
                                <dd class="col-md-8">{{ $merchant->kyc->documentationType() }}</dd>

                                <dt class="col-md-3 text-right">Identity Number</dt>
                                <dd class="col-md-8">{{ $merchant->kyc->id_no }}</dd>

                                <dt class="col-md-3 text-right">Identity Issue Date</dt>
                                <dd class="col-md-8">{{ date('M d, Y', strtotime($merchant->kyc->c_issued_date)) }}</dd>

                                <dt class="col-md-3 text-right">Identity Issue From</dt>
                                <dd class="col-md-8">{{ $merchant->kyc->c_issued_from }}</dd>
                            @else
                                <dt class="col-md-3 text-right" style="font-size: 16px;">KYC form not filled</dt>
                            @endif
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
