<a data-toggle="modal" href="#modal-form-transaction-remarks{{$NPSAccountLinkLoad->id}}">
    <button class="btn btn-warning btn-icon" type="button" title="Transaction Remarks"><i class="fa fa-info"></i></button>
</a>
<div id="modal-form-transaction-remarks{{$NPSAccountLinkLoad->id}}" class="modal fade" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 750px !important;">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="m-t-none m-b">Transaction Remarks</h3>
                        <hr>
                        @if(!empty($NPSAccountLinkLoad->transaction_remarks || $NPSAccountLinkLoad->transaction_remarks_2 || $NPSAccountLinkLoad->transaction_remarks_3))
                            @if(!empty($NPSAccountLinkLoad->transaction_remarks))
                            <dl class="m-t-none m-b">
                                <dl class="text-left">{{$NPSAccountLinkLoad->transaction_remarks}}</dl>
                            </dl>
                            @endif
                            @if(!empty($NPSAccountLinkLoad->transaction_remarks_2))
                            <dl class="m-t-none m-b">
                                <dl class="text-left">{{$NPSAccountLinkLoad->transaction_remarks_2}}</dl>
                            </dl>
                            @endif
                            @if(!empty($NPSAccountLinkLoad->transaction_remarks_3))
                            <dl class="m-t-none m-b">
                                <dl class="text-left">{{$NPSAccountLinkLoad->transaction_remarks_3}}</dl>
                            </dl>
                            @endif                        
                        @else
                            <dl class="m-t-none m-b">No Data</dl>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



