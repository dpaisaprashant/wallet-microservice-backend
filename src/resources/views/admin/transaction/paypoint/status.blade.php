@if(!empty($transaction->userExecutePayment) || count($transaction->userExecutePayment) !== 0)

    @foreach($transaction->userExecutePayment as $execute)
        @if($execute->code == 000)
            <?php $color = 'primary' ?>
            <span class="badge badge-primary">complete</span>
        @else
            <?php $color = 'danger' ?>
            <span class="badge badge-danger">failed</span>
        @endif
    @endforeach

    @if(count($transaction->userExecutePayment) === 0)
        <?php $color = 'danger' ?>
        <span class="badge badge-danger">failed</span>
    @endif

@else
    <?php $color = 'danger' ?>
    <span class="badge badge-danger">failed</span>
@endif
