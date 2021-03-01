<tr class="gradeC">
    <td>{{ $loop->index + ($allAudits->perPage() * ($allAudits->currentPage() - 1)) + 1 }}</td>
    <?php $date = explode(' ', $event->created_at) ?>
    <td>{{ $date[0] }}</td>
    <td>{{ $date[1] }}</td>
    <td>
        @if($event->status == 1 && $event->tmp_enabled === 0)
        <b style="color: green">USER SUCCESSFULLY LOGGED IN</b>
        @else
            <b style="color: red">USER LOGIN ATTEMPT FAIL</b>
        @endif
    </td>
    <td> --- </td>
    <td> --- </td>
    <td> --- </td>
    <td> --- </td>

    <td>Rs. {{ $event->current_balance }} </td>
    <td>
        <a data-toggle="modal" href="#modal-form-user-login-history{{$event->id}}"><button class="btn btn-warning btn-icon" type="button"><i class="fa fa-info"></i></button></a>

        <div id="modal-form-user-login-history{{ $event->id }}" class="modal fade" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <h3 class="m-t-none m-b">Login History Detailed Information</h3>
                                <hr>
                                <dl class="row m-t-md">
                                    <dt class="col-md-3 text-right">Public Id</dt>
                                    <dd class="col-md-8">{{ $event->public_ip }}</dd>

                                    <dt class="col-md-3 text-right">Server Id</dt>
                                    <dd class="col-md-8">{{ $event->server_ip }}</dd>

                                    <dt class="col-md-3 text-right">Device</dt>
                                    <dd class="col-md-8">{{ $event->device }}</dd>

                                    <dt class="col-md-3 text-right">User Agent</dt>
                                    <dd class="col-md-8">{{ $event->user_agent }}</dd>


                                    <dt class="col-md-3 text-right">Description</dt>
                                    <dd class="col-md-8">{{ $event->description }}</dd>

                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </td>
</tr>
