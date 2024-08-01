<a data-toggle="modal" href="#modal-form-fund-transfer{{$id}}"><button class="btn btn-warning btn-icon" type="button"><i class="fa fa-info"></i></button></a>
<div id="modal-form-fund-transfer{{ $id }}" class="modal fade" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 630px !important;">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="m-t-none m-b">BFI Execute Payment Information</h3>
                        <hr>
                        <dl class="row m-t-md">
                            <dt class="col-md-5 text-left">Bank Transaction Id : </dt>
                            <dd class="col-md-7">{{ $bank_transaction_id == null ? 'Null' : $bank_transaction_id }}</dd>

                            <dt class="col-md-5 text-left">Bank Transaction Date : </dt>
                            <dd class="col-md-7">{{ $bank_transaction_date == null ? 'Null' : $bank_transaction_date }}</dd>

                            <dt class="col-md-5 text-left">Initiating Account : </dt>
                            <dd class="col-md-7">{{ $initiating_account == null ? 'Null' : $initiating_account }}

                            <dt class="col-md-5 text-left">Initiating Account Name : </dt>
                            <dd class="col-md-7">{{ $initiating_account_name == null ? 'Null' : $initiating_account_name }}

                            <dt class="col-md-5 text-left">Remarks : </dt>
                            <dd class="col-md-7">{{ $remarks == null ? 'Null' : $remarks }}


                        </dl>



                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
