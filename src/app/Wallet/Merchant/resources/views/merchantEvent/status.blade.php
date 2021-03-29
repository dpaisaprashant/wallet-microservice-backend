@if($event->status == \App\Models\Merchant\MerchantEvent::STATUS_PROCESSING)
    <span class="badge badge-warning">{{ $event->status }}</span>
@elseif($event->status == \App\Models\Merchant\MerchantEvent::STATUS_ACCEPTED)
    <span class="badge badge-primary">{{ $event->status }}</span>
@else
    <span class="badge badge-danger">{{ $event->status }}</span>
@endif
