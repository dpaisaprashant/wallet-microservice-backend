<div class="ibox ">
    <div class="ibox-title">
        <h5>NEA Transaction Fee Settings (Currency in paisa)</h5>
    </div>
    <div class="ibox-content">

        @csrf
        <div class="form-group  row">
            <label class="col-sm-2 col-form-label">NEA type</label>
            <div class="col-sm-10">
                <select class="form-control" name="pp_tf_nea_type">
                    @if(!empty($settings['pp_tf_nea_type']))
                        <option value="FLAT" @if($settings['pp_tf_nea_type'] == 'FLAT') selected @endif>Flat</option>
                        <option value="PERCENTAGE" @if($settings['pp_tf_nea_type'] == 'PERCENTAGE') selected @endif>Percentage</option>
                    @else
                        <option value="FLAT">Flat</option>
                        <option value="PERCENTAGE">Percentage</option>
                    @endif
                </select>
            </div>
        </div>

        <div class="form-group  row">
            <label class="col-sm-2 col-form-label">NEA value</label>
            <div class="col-sm-10">
                <input value="{{ $settings['pp_tf_nea_value'] ?? ''}}" name="pp_tf_nea_value" type="text" class="form-control">
            </div>
        </div>

        <div class="hr-line-dashed"></div>

        <div class="form-group row">
            <div class="col-sm-4 col-sm-offset-2">
                @can('Paypoint setting update')
                    <button class="btn btn-primary btn-sm" type="submit">Save changes</button>
                @endcan
            </div>
        </div>
    </div>
</div>
