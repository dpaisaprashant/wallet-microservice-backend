@if($type == 'dob')
    <label>
        <input type="radio" name="date_format" value="BS" class="form-control form-control-sm" onclick="showDobBS();">BS</label>
    <label>
        <input type="radio" name="date_format" value="AD" class="form-control form-control-sm" onclick="showDobAD();" checked="checked">
        AD</label>

    <div class="select" id="BS">
        <div class="row">
            <div class="col-md-4">
                <select name="yearDob" class="chosen-select">
                    <option value="" disabled selected>--- Select DOB ---</option>
                    @isset($DobBs)
                        @for($i = 2000;$i<2090;$i++)
                            @if($DobBs['year'] == $i)
                                <option value="{{$i}}" selected>{{$i}}</option>
                            @else
                                <option value="{{$i}}">{{$i}}</option>
                            @endif
                        @endfor
                    @else
                        @for($i = 2000;$i<2090;$i++)
                                <option value="{{$i}}">{{$i}}</option>
                        @endfor
                    @endisset

                </select>
            </div>
            <div class="col-md-4">
                <select name="monthDob" class="chosen-select">
                    <option value="" disabled selected>--- Select Month ---</option>

                    @isset($DobBs)

                        @if($DobBs['month'] == 1)
                            <option value="1" selected>Baishak</option>
                        @else
                            <option value="1">Baishak</option>
                        @endif

                        @if($DobBs['month'] == 2)
                            <option value="2" selected>Jestha</option>
                        @else
                            <option value="2">Jestha</option>
                        @endif

                        @if($DobBs['month'] == 3)
                            <option value="3" selected>Asar</option>
                        @else
                            <option value="3">Asar</option>
                        @endif

                        @if($DobBs['month'] == 4)
                            <option value="4" selected>Shrawan</option>
                        @else
                            <option value="4">Shrawan</option>
                        @endif

                        @if($DobBs['month'] == 5)
                            <option value="5" selected>Bhadra</option>
                        @else
                            <option value="5">Bhadra</option>
                        @endif

                        @if($DobBs['month'] == 6)
                            <option value="6" selected>Ashoj</option>
                        @else
                            <option value="6">Ashoj</option>
                        @endif

                        @if($DobBs['month'] == 7)
                            <option value="7" selected>Kartik</option>
                        @else
                            <option value="7">Kartik</option>
                        @endif

                        @if($DobBs['month'] == 8)
                            <option value="8" selected>Mangshir</option>
                        @else
                            <option value="8">Mangshir</option>
                        @endif

                        @if($DobBs['month'] == 9)
                            <option value="9" selected>Poush</option>
                        @else
                            <option value="9">Poush</option>
                        @endif

                        @if($DobBs['month'] == 10)
                            <option value="10" selected>Magh</option>
                        @else
                            <option value="10">Magh</option>
                        @endif

                        @if($DobBs['month'] == 11)
                            <option value="11" selected>Falgun</option>
                        @else
                            <option value="11">Falgun</option>
                        @endif

                        @if($DobBs['month'] == 12)
                            <option value="12" selected>Chaitra</option>
                        @else
                            <option value="12">Chaitra</option>
                        @endif

                    @else
                        <option value="1">Baishak</option>
                        <option value="2">Jestha</option>
                        <option value="3">Asar</option>
                        <option value="4">Shrawan</option>
                        <option value="5">Bhadra</option>
                        <option value="6">Ashoj</option>
                        <option value="7">Kartik</option>
                        <option value="8">Mangshir</option>
                        <option value="9">Poush</option>
                        <option value="10">Magh</option>
                        <option value="11">Falgun</option>
                        <option value="12">Chaitra</option>
                    @endisset
                </select>
            </div>
            <div class="col-md-4">
                <select name="dayDob" class="chosen-select">
                    <option value="" disabled selected>--- Select Day ---</option>
                    @isset($DobBs)
                        @for($i = 1;$i<33;$i++)
                            @if($DobBs['date'] == $i)
                                <option value="{{$i}}" selected>{{$i}}</option>
                            @else
                                <option value="{{$i}}">{{$i}}</option>
                            @endif
                        @endfor
                    @else
                        @for($i = 1;$i<33;$i++)
                                <option value="{{$i}}">{{$i}}</option>
                        @endfor
                    @endisset
                </select>
            </div>
        </div>
    </div>

    <div class="select" id="AD" style="display: block">
        <div class="input-group date">
                    <span class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </span>
            <input id="date_load_from" type="text" class="form-control date_from"
                   placeholder="Date of Birth" name="date_of_birth" autocomplete="off" value="{{$date_of_birth_formatted ?? ""}}">
        </div>
    </div>

@elseif($type == 'issueDate')
    <label>
        <input type="radio" name="date_format_issueDate" value="BS_issue" class="form-control form-control-sm"
               onclick="showIssueDateBS();">BS</label>
    <label>
        <input type="radio" name="date_format_issueDate" value="AD_issue" class="form-control form-control-sm"
               onclick="showIssueDateAD();" checked="checked"> AD</label>

    <div class="select" id="BS_issue">
        <div class="row">
            <div class="col-md-4">
                <select name="yearIssue" class="chosen-select">
                    <option value="" disabled selected>--- Select Year Issue ---</option>
                    @isset($DateOfIssueBs)
                        @for($i = 2000;$i<2090;$i++)
                            @if($DateOfIssueBs['year'] == $i)
                                <option value="{{$i}}" selected>{{$i}}</option>
                            @else
                                <option value="{{$i}}">{{$i}}</option>
                            @endif
                        @endfor
                    @else
                        @for($i = 2000;$i<2090;$i++)
                                <option value="{{$i}}">{{$i}}</option>
                        @endfor
                    @endisset
                </select>
            </div>
            <div class="col-md-4">
                <select name="monthIssue" class="chosen-select">
                    <option value="" disabled selected>--- Select Month ---</option>
                    @isset($DateOfIssueBs)

                        @if($DateOfIssueBs['month'] == 1)
                            <option value="1" selected>Baishak</option>
                        @else
                            <option value="1">Baishak</option>
                        @endif

                        @if($DateOfIssueBs['month'] == 2)
                            <option value="2" selected>Jestha</option>
                        @else
                            <option value="2">Baishak</option>
                        @endif

                        @if($DateOfIssueBs['month'] == 3)
                            <option value="3" selected>Asar</option>
                        @else
                            <option value="3">Asar</option>
                        @endif

                        @if($DateOfIssueBs['month'] == 4)
                            <option value="4" selected>Shrawan</option>
                        @else
                            <option value="4">Shrawan</option>
                        @endif

                        @if($DateOfIssueBs['month'] == 5)
                            <option value="5" selected>Bhadra</option>
                        @else
                            <option value="5">Bhadra</option>
                        @endif

                        @if($DateOfIssueBs['month'] == 6)
                            <option value="6" selected>Ashoj</option>
                        @else
                            <option value="6">Ashoj</option>
                        @endif

                        @if($DateOfIssueBs['month'] == 7)
                            <option value="7" selected>Kartik</option>
                        @else
                            <option value="7">Kartik</option>
                        @endif

                        @if($DateOfIssueBs['month'] == 8)
                            <option value="8" selected>Mangshir</option>
                        @else
                            <option value="8">Mangshir</option>
                        @endif

                        @if($DateOfIssueBs['month'] == 9)
                            <option value="9" selected>Poush</option>
                        @else
                            <option value="9">Poush</option>
                        @endif

                        @if($DateOfIssueBs['month'] == 10)
                            <option value="10" selected>Magh</option>
                        @else
                            <option value="10">Magh</option>
                        @endif

                        @if($DateOfIssueBs['month'] == 11)
                            <option value="11" selected>Falgun</option>
                        @else
                            <option value="11">Falgun</option>
                        @endif

                        @if($DateOfIssueBs['month'] == 12)
                            <option value="12" selected>Chaitra</option>
                        @else
                            <option value="12">Chaitra</option>
                        @endif
                    @else
                        <option value="1">Baishak</option>
                        <option value="2">Jestha</option>
                        <option value="3">Asar</option>
                        <option value="4">Shrawan</option>
                        <option value="5">Bhadra</option>
                        <option value="6">Ashoj</option>
                        <option value="7">Kartik</option>
                        <option value="8">Mangshir</option>
                        <option value="9">Poush</option>
                        <option value="10">Magh</option>
                        <option value="11">Falgun</option>
                        <option value="12">Chaitra</option>
                    @endisset
                </select>
            </div>
            <div class="col-md-4">
                <select name="dayIssue" class="form-control form-control-sm" class="chosen-select">
                    <option value="" disabled selected>--- Select Day ---</option>
                    @isset($DateOfIssueBs)
                        @for($i = 1;$i<33;$i++)
                            @if($DateOfIssueBs['date'] == $i)
                                <option value="{{$i}}" selected>{{$i}}</option>
                            @else
                                <option value="{{$i}}">{{$i}}</option>
                            @endif
                        @endfor
                    @else
                        @for($i = 1;$i<33;$i++)
                            <option value="{{$i}}">{{$i}}</option>
                        @endfor
                    @endisset
                </select>
            </div>
        </div>
    </div>


    <div class="select" id="AD_issue" style="display: block">
        <div class="input-group date">
                        <span class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </span>
            <input id="date_load_from" type="text" class="form-control date_from"
                   placeholder="Document Issue Date" name="c_issued_date" autocomplete="off" value="{{$date_of_issue_formatted ?? ""}}">
        </div>
    </div>
@endif








