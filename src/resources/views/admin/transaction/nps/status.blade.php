@if($npsLoadTransaction->status == 'COMPLETED')
    <span class="badge badge-primary">{{$npsLoadTransaction->status}}</span>
    @elseif($npsLoadTransaction->status == 'VALIDATED')
    <span class="badge badge-warning">{{$npsLoadTransaction->status}}</span>
@else
    <span class="badge badge-danger">{{$npsLoadTransaction->status}}</span>
    @endif
