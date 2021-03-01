<div class="ibox ">
    <div class="ibox-title">
        <h5>NPAY Transaction Fee Settings (Currency in paisa)</h5>
        <div class="ibox-tools">
            <a class="collapse-link">
                <i class="fa fa-chevron-up"></i>
            </a>
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-wrench"></i>
            </a>
            <a class="close-link">
                <i class="fa fa-times"></i>
            </a>
        </div>
    </div>
    <div class="ibox-content">
        <div class="form-group  row">
            <label class="col-sm-2 col-form-label">NPay transaction fee</label>
            <div class="col-sm-10">
                <select class="form-control" name="tf_npay_type">
                    @if(!empty($settings['tf_npay_type']))
                        <option value="FLAT" @if($settings['tf_npay_type'] == 'FLAT') selected @endif>Flat</option>
                        <option value="PERCENTAGE" @if($settings['tf_npay_type'] == 'PERCENTAGE') selected @endif>Percentage</option>
                    @else
                        <option value="FLAT">Flat</option>
                        <option value="PERCENTAGE">Percentage</option>
                    @endif
                </select>
            </div>
        </div>

        <div class="form-group  row">
            <label class="col-sm-2 col-form-label">NPay Transaction value</label>
            <div class="col-sm-10">
                <input value="{{ $settings['tf_npay_value'] ?? ''}}" name="tf_npay_value" type="text" class="form-control">
            </div>
        </div>

        <div class="hr-line-dashed"></div>

        <div class="form-group row">
            <div class="col-sm-4 col-sm-offset-2">
                <button class="btn btn-primary btn-sm" type="submit">Save changes</button>
            </div>
        </div>
    </div>
</div>
