@if(!empty($cellPayUserTransaction))
    <a data-toggle="modal" href="#Specials{{$cellPayUserTransaction->id}}"><button class="btn btn-warning btn-icon" type="button"><i class="fa fa-info"></i></button></a>
    <div id="Specials{{ $cellPayUserTransaction->id }}" class="modal fade" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <h3 class="m-t-none m-b">CellPay User-Transaction Specials Info For <br> Account: {{$cellPayUserTransaction->account}}</h3>
                            <hr>
                            <dl class="row m-t-md">
                                <dt class="col-md-3 text-right">Special 1: </dt>
                                <dd class="col-md-8">
                                    @if(!empty($cellPayUserTransaction->special1))
                                        {{ $cellPayUserTransaction->special1}}
                                    @else
                                        None
                                    @endif
                                </dd>

                                <dt class="col-md-3 text-right">Special 2: </dt>
                                <dd class="col-md-8">
                                    @if(!empty($cellPayUserTransaction->special2))
                                        {{ $cellPayUserTransaction->special2}}
                                    @else
                                        None
                                    @endif
                                </dd>

                                <dt class="col-md-3 text-right">Special 3: </dt>
                                <dd class="col-md-8">
                                    @if(!empty($cellPayUserTransaction->special3))
                                        {{ $cellPayUserTransaction->special3}}
                                    @else
                                        None
                                    @endif
                                </dd>

                                <dt class="col-md-3 text-right">Special 4: </dt>
                                <dd class="col-md-8">
                                    @if(!empty($cellPayUserTransaction->special4))
                                        {{ $cellPayUserTransaction->special4}}
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
