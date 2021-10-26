@if($user->userType !=null)
    <span
        class="badge badge-success">User type : {{ optional($user->userType)->name }}</span><br>
@endif

@if($user->merchant != null)
    @if(optional($user->merchant->merchantType)->name == "normal")
        <span class="badge badge-primary">Merchant type : {{ optional($user->merchant->merchantType)->name }}</span>
        @elseif(optional($user->merchant->merchantType)->name == "reseller")
        <span class="badge badge-danger">Merchant type : {{ optional($user->merchant->merchantType)->name }}</span>
    @endif
    <br>
@endif
@if($user->agent != null && $user->isValidAgentOrSubAgent())
    <span class="badge badge-danger">Agent type :
        @if($user->agent != null)
            {{ optional($user->agent->agentType)->name }}
        @endif
    </span>
@endif
