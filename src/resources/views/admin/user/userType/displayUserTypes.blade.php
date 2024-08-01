@if(!empty($user->userType))

    <span
        class="badge badge-success">User type : {{ optional($user->userType)->name }}</span><br>

@endif

@if(!empty($user->merchant ))
    @if(optional($user->merchant->merchantType)->name == "normal")
        <span class="badge badge-primary">Merchant type : {{ optional($user->merchant->merchantType)->name }}</span>
        @elseif(optional($user->merchant->merchantType)->name == "reseller")
        <span class="badge badge-danger">Merchant type : {{ optional($user->merchant->merchantType)->name }}</span>
    @endif
    <br>
@endif
@if(!empty($user->agent) && $user->isValidAgentOrSubAgent())
    <span class="badge badge-danger">Agent type :
        @if($user->agent != null)
            {{ optional($user->agent->agentType)->name }}
        @endif
    </span>
@endif
