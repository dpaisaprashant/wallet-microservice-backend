<a style="margin-top: 5px;"
   class="btn btn-sm btn-primary m-t-n-xs"
   title="user profile" onclick="openForm()" id="BonusToMain">
    <i class="fa fa-exchange" style="color: white"> Transfer Bonus Balance To Main Balance</i>
</a>

<div id="myModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>

        <form method="post" action="{{route('bonusToMainBalanceTransfer',$user->id)}}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <dl class="row m-t-md">
                        <dt class="col-md-3 text-right">
                            <label for="amount">Amount:</label>
                        </dt>
                        <dd class="col-md-8">
                            <input type="number" class="form-control form-control-sm" name="amount" placeholder="Enter Amount" required>
                        </dd>

                        <dt class="col-md-3 text-right">
                            <label for="description">Description:</label>
                        </dt>
                        <dd class="col-md-8">
                            <textarea name="description"  id="description" cols="64" rows="5"></textarea>
                        </dd>
                        <br>
                        <dd class="col-md-11">
                            <button class="btn btn-primary btn-sm" type="submit" style="float: right;width: 100px;height: 40px;">
                                Submit
                            </button>
                        </dd>
                    </dl>
                </div>
            </div>
        </form>
    </div>
</div>


