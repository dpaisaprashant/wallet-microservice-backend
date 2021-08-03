@if(!empty($cellPayUserTransaction))
    <a data-toggle="modal" href="#Errors{{$cellPayUserTransaction->id}}"><button class="btn btn-warning btn-icon" type="button"><i class="fa fa-info"></i></button></a>
    <div id="Errors{{ $cellPayUserTransaction->id }}" class="modal fade" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <h3 class="m-t-none m-b">CellPay User-Transaction Errors Info For <br> Account: {{$cellPayUserTransaction->account}}</h3>
                            <hr>
                            <dl class="row m-t-md">
                                <dt class="col-md-3 text-right">Error Code: </dt>
                                <dd class="col-md-8">
                                    @if(!empty($cellPayUserTransaction->error_code))
                                        {{ $cellPayUserTransaction->error_code}}
                                    @else
                                        None
                                    @endif
                                </dd>

                                <dt class="col-md-3 text-right">Error Data: </dt>
                                <dd class="col-md-8">
                                    @if(!empty($cellPayUserTransaction->error_data))
                                        {{ $cellPayUserTransaction->error_data}}
                                    @else
                                        None
                                    @endif
                                </dd>

                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
