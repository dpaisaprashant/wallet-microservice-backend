@if($user->userType !=null)
    <span
        class="badge badge-success">User type : {{ optional($user->userType)->name }}</span><br>
@endif

@if($user->merchant != null)
    <span class="badge badge-primary">Merchant type :
                                                    {{ $user->merchant->merchantType->name }}

                                            </span><br>
@endif
@if($user->agent != null)
    <span class="badge badge-danger">Agent type :
                                                    @if($user->agentType() != null)
            {{ $user->agentType() }}
        @endif
                                                </span>
@endif
