<a data-toggle="modal" href="#modal-form-specials{{$requestInfo->id}}">
    <button class="btn btn-warning btn-icon" type="button" title="Specials"><i class="fa fa-info"></i></button>
</a>
<div id="modal-form-specials{{$requestInfo->id}}" class="modal fade" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 750px !important;">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="m-t-none m-b">Specials</h3>
                        <hr>     
                        <dl class="row m-t-md">                            
                            <dt class="col-md-5 text-left" >Special 1 :</dt>
                            <dd class="col-lg-offset-1"></dd>
                            @if(!empty($requestInfo->special1))
                            <dd class="col-md-5 text-left">{{ $requestInfo->special1 }}</dd>                                                             
                            @else
                            <dd class="col-md-5 text-left">No Data</dd> 
                            @endif
                        </dl>
                        <dl class="row m-t-md">                            
                            <dt class="col-md-5 text-left" >Special 2 :</dt>
                            <dd class="col-lg-offset-1"></dd>
                            @if(!empty($requestInfo->special2))
                            <dd class="col-md-5 text-left">{{ $requestInfo->special2 }}</dd>                                                             
                            @else
                            <dd class="col-md-5 text-left">No Data</dd> 
                            @endif  
                        </dl>
                        <dl class="row m-t-md">                            
                            <dt class="col-md-5 text-left" >Special 3 :</dt>
                            <dd class="col-lg-offset-1"></dd>
                            @if(!empty($requestInfo->special3))
                            <dd class="col-md-5 text-left">{{ $requestInfo->special3 }}</dd>                                                             
                            @else
                            <dd class="col-md-5 text-left">No Data</dd> 
                            @endif  
                        </dl>
                        <dl class="row m-t-md">                            
                            <dt class="col-md-5 text-left" >Special 4 :</dt>
                            <dd class="col-lg-offset-1"></dd>
                            @if(!empty($requestInfo->special4))
                            <dd class="col-md-5 text-left">{{ $requestInfo->special4 }}</dd>                                                             
                            @else
                            <dd class="col-md-5 text-left">No Data</dd> 
                            @endif   
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>