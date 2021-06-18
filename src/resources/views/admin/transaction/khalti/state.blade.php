@if($khaltiTransaction->state == 'Success')
    <span class="badge badge-success">{{$khaltiTransaction->state}}</span>
    @elseif($khaltiTransaction->state == null)
    <span class="badge badge-danger">Null</span>
    @elseif($khaltiTransaction->state == 'Queued')
    <span class="badge badge-warning-light">{{$khaltiTransaction->state}}</span>
    @endif
