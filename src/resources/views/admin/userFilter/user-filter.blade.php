<div class="row">
    <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-title collapse-link">
                <h5>Filter {{$title}}</h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                </div>
            </div>
            <div class="ibox-content"
                 @if( empty($_GET) || (!empty($_GET['page']) && count($_GET) === 1)  ) style="display: none" @endif>
                <div class="row">
                    <div class="col-sm-12">
                        <form role="form" method="get">

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input type="text" name="name" placeholder="Enter User Name"
                                               class="form-control"
                                               value="{{ !empty($_GET['name']) ? $_GET['name'] : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input type="text" name="number" placeholder="Enter Contact Number"
                                               class="form-control"
                                               value="{{ !empty($_GET['number']) ? $_GET['number'] : '' }}">
                                    </div>
                                </div>


                                <div class="col-md-3">
                                    <input type="email" name="email" placeholder="Enter Email"
                                           class="form-control"
                                           value="{{ !empty($_GET['email']) ? $_GET['email'] : '' }}">
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <select data-placeholder="User Type ..." class="chosen-select"
                                                tabindex="2" name="user_type">
                                            <option value="" selected disabled>User Type...</option>
                                            @if(!empty($_GET['user_type']))
                                                <option value="all"
                                                        @if($_GET['user_type']  == 'all') selected @endif >All
                                                </option>
                                                <option value="normal"
                                                        @if($_GET['user_type']  == 'user') selected @endif >
                                                    User
                                                </option>
                                                <option value="agent"
                                                        @if($_GET['user_type']  == 'agent') selected @endif >
                                                    Agent
                                                </option>

                                            @else
                                                <option value="all">All</option>
                                                <option value="user">User</option>
                                                <option value="agent">Agent</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                {{--<div class="col-md-3">
                                    <div class="form-group">
                                        <select data-placeholder="Choose transaction status..."
                                                class="chosen-select" tabindex="2" name="sort">
                                            <option value="" selected disabled>Sort By...</option>
                                            @if(!empty($_GET['sort']))
                                                <option value="wallet_balance"
                                                        @if($_GET['sort']  == 'wallet_balance') selected @endif >
                                                    Wallet Balance
                                                </option>
                                                <option value="transaction_number"
                                                        @if($_GET['sort'] == 'transaction_number') selected @endif>
                                                    Transaction Number
                                                </option>
                                                <option value="transaction_payment"
                                                        @if($_GET['sort'] == 'transaction_payment') selected @endif>
                                                    Transaction Payment
                                                </option>
                                                <option value="transaction_loaded"
                                                        @if($_GET['sort'] == 'transaction_loaded') selected @endif>
                                                    Transaction Loaded
                                                </option>
                                            @else
                                                <option value="wallet_balance">Wallet Balance</option>
                                                <option value="transaction_number">Transaction Number</option>
                                                <option value="transaction_payment">Transaction Payment</option>
                                                <option value="transaction_loaded">Transaction Loaded</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>--}}


                                <div class="col-md-6" style="padding-bottom: 15px;">
                                    <label for="transaction_number">From User Registration Date</label>
                                    <div class="input-group date">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </span>
                                        <input id="date_load_from" type="text" class="form-control date_from"
                                               placeholder="From" name="from" autocomplete="off"
                                               value="{{ !empty($_GET['from']) ? $_GET['from'] : '' }}">
                                    </div>
                                </div>

                                <div class="col-md-6" style="padding-bottom: 15px;">
                                    <label for="transaction_number">To User Registration Date</label>
                                    <div class="input-group date">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </span>
                                        <input id="date_load_to" type="text" class="form-control date_to"
                                               placeholder="To" name="to" autocomplete="off"
                                               value="{{ !empty($_GET['to']) ? $_GET['to'] : '' }}">
                                    </div>
                                </div>


                                <div class="col-md-6" style="padding-bottom: 15px;">
                                    <label for="transaction_number">From User KYC Created Date</label>
                                    <div class="input-group date">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </span>
                                        <input id="date_load_from" type="text" class="form-control date_from"
                                               placeholder="From KYC Created Date" name="from_kyc_date" autocomplete="off"
                                               value="{{ !empty($_GET['from_kyc_date']) ? $_GET['from_kyc_date'] : '' }}">
                                    </div>
                                </div>

                                <div class="col-md-6" style="padding-bottom: 15px;">
                                    <label for="transaction_number">To User KYC Created Date</label>
                                    <div class="input-group date">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </span>
                                        <input id="date_load_to" type="text" class="form-control date_to"
                                               placeholder="To KYC Created Date" name="to_kyc_date" autocomplete="off"
                                               value="{{ !empty($_GET['to_kyc_date']) ? $_GET['to_kyc_date'] : '' }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="transaction_number">Transaction Number</label>
                                    {{--                                            <input type="text" name="transaction_number" class="ionrange_number">--}}
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="input-group date">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-dollar"></i>
                                                    </span>
                                                <input type="number" class="form-control"
                                                       placeholder="From Transaction Amount"
                                                       name="from_transaction_number" autocomplete="off"
                                                       value="{{ !empty($_GET['from_transaction_number']) ? $_GET['from_transaction_number'] : '' }}">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="input-group date">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-dollar"></i>
                                                    </span>
                                                <input type="number" class="form-control"
                                                       placeholder="To Transaction Amount"
                                                       name="to_transaction_number" autocomplete="off"
                                                       value="{{ !empty($_GET['to_transaction_number']) ? $_GET['to_transaction_number'] : '' }}">
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                </div>

                                <div class="col-md-6">
                                    <label for="wallet_balance">Wallet Balance</label>
                                    {{--                                            <input type="text" name="wallet_balance" class="ionrange_wallet_amount">--}}
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="input-group date">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-dollar"></i>
                                                    </span>
                                                <input type="number" class="form-control"
                                                       placeholder="From Wallet balance"
                                                       name="from_wallet_balance" autocomplete="off"
                                                       value="{{ !empty($_GET['from_wallet_balance']) ? $_GET['from_wallet_balance'] : '' }}">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="input-group date">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-dollar"></i>
                                                    </span>
                                                <input type="number" class="form-control"
                                                       placeholder="To Wallet balance" name="to_wallet_balance"
                                                       autocomplete="off"
                                                       value="{{ !empty($_GET['to_wallet_balance']) ? $_GET['to_wallet_balance'] : '' }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="transaction_amount">Transaction Payment</label>
                                    {{--                                            <input type="text" name="transaction_payment" class="ionrange_payment_amount">--}}
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="input-group date">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-dollar"></i>
                                                    </span>
                                                <input type="number" class="form-control"
                                                       placeholder="From Transaction payment"
                                                       name="from_transaction_payment" autocomplete="off"
                                                       value="{{ !empty($_GET['from_transaction_payment']) ? $_GET['from_transaction_payment'] : '' }}">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="input-group date">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-dollar"></i>
                                                    </span>
                                                <input type="number" class="form-control"
                                                       placeholder="To Transaction payment"
                                                       name="to_transaction_payment" autocomplete="off"
                                                       value="{{ !empty($_GET['to_transaction_payment']) ? $_GET['to_transaction_payment'] : '' }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="transaction_amount">Transaction Loaded</label>
                                    {{--                                            <input type="text" name="transaction_loaded" class="ionrange_loaded_amount">--}}
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="input-group date">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-dollar"></i>
                                                    </span>
                                                <input type="number" class="form-control"
                                                       placeholder="From Transaction loaded"
                                                       name="from_transaction_loaded" autocomplete="off"
                                                       value="{{ !empty($_GET['from_transaction_loaded']) ? $_GET['from_transaction_loaded'] : '' }}">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="input-group date">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-dollar"></i>
                                                    </span>
                                                <input type="number" class="form-control"
                                                       placeholder="To Transaction loaded"
                                                       name="to_transaction_loaded" autocomplete="off"
                                                       value="{{ !empty($_GET['to_transaction_loaded']) ? $_GET['to_transaction_loaded'] : '' }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <br><label>Phone Verification</label><br>
                                    <div class="form-group">
                                        <select data-placeholder="Phone Verification..." class="chosen-select"
                                                tabindex="2" name="verification">
                                            <option value="" selected disabled>Phone Verification...</option>
                                            @if(!empty($_GET['verification']))
                                                <option value="all"
                                                        @if($_GET['verification']  == 'all') selected @endif >
                                                    All
                                                </option>
                                                <option value="verified"
                                                        @if($_GET['verification']  == 'verified') selected @endif >
                                                    Verified
                                                </option>
                                                <option value="unverified"
                                                        @if($_GET['verification'] == 'unverified') selected @endif>
                                                    Unverified
                                                </option>
                                            @else
                                                <option value="all">All</option>
                                                <option value="verified">Verified</option>
                                                <option value="unverified">Unverified</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <br><label>Referral Code</label><br>
                                    <input type="text" class="form-control" placeholder="Referral Code"
                                           name="referral_code" autocomplete="off"
                                           value="{{ !empty($_GET['referral_code']) ? $_GET['referral_code'] : '' }}">
                                </div>
                                <div class="col-md-4">
                                    <br><label>Kyc Status</label><br>
                                    <div class="form-group">
                                        <select data-placeholder="Kyc Status..." class="chosen-select"
                                                tabindex="2" name="kyc_status">
                                            <option value="" selected disabled>Kyc Status...</option>
                                            @if(!empty($_GET['kyc_status']))
                                                <option value="all"
                                                        @if($_GET['kyc_status']  == 'all') selected @endif >All
                                                </option>
                                                <option value="verified"
                                                        @if($_GET['kyc_status']  == 'verified') selected @endif >
                                                    Accepted
                                                </option>
                                                <option value="unverified"
                                                        @if($_GET['kyc_status']  == 'unverified') selected @endif >
                                                    Rejected
                                                </option>
                                                <option value="pending"
                                                        @if($_GET['kyc_status'] == 'pending') selected @endif>
                                                    Pending
                                                </option>
                                                <option value="notfilled"
                                                        @if($_GET['kyc_status'] == 'notfilled') selected @endif>
                                                    Not filled
                                                </option>
                                            @else
                                                <option value="all">All</option>
                                                <option value="verified">Accepted</option>
                                                <option value="unverified">Rejected</option>
                                                <option value="pending">Pending</option>
                                                <option value="notfilled">Not filled</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>

                                    <div class="col-md-4">
                                        <div class="input-group date">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-home""></i>
                                                    </span>
                                            <select data-placeholder="Choose District..." class="chosen-select"  tabindex="2" name="district">
                                                <option value="" selected disabled>Select District ...</option>
                                                <option value="">All</option>
                                                @if(!empty($_GET['district']))
                                                    @foreach($districts as $district)
                                                        <option value="{{ $district }}" @if($_GET['district'] == $district) selected @endif>{{ $district }}</option>
                                                    @endforeach
                                                @else
                                                    @foreach($districts as $district)
                                                        <option value="{{ $district }}"> {{ $district }} </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                            </div>
                            <br>
                            <div>
                                <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit"
                                        {{--formaction="{{ route('user.view') }}"--}}><strong>Filter</strong></button>
                            </div>

                            <div>
                                <button id="excelBtn" class="btn btn-sm btn-warning float-right m-t-n-xs"
                                        type="submit" style="margin-right: 10px;"
                                        formaction="{{ route('user.excel') }}"><strong>Excel</strong></button>
                            </div>
                            @include('admin.asset.components.clearFilterButton')
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
