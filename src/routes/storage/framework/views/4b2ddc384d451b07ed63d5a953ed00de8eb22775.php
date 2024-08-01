<?php if($type == 'dob'): ?>
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
                    <?php if(isset($DobBs)): ?>
                        <?php for($i = 2000;$i<2090;$i++): ?>
                            <?php if($DobBs['year'] == $i): ?>
                                <option value="<?php echo e($i); ?>" selected><?php echo e($i); ?></option>
                            <?php else: ?>
                                <option value="<?php echo e($i); ?>"><?php echo e($i); ?></option>
                            <?php endif; ?>
                        <?php endfor; ?>
                    <?php else: ?>
                        <?php for($i = 2000;$i<2090;$i++): ?>
                                <option value="<?php echo e($i); ?>"><?php echo e($i); ?></option>
                        <?php endfor; ?>
                    <?php endif; ?>

                </select>
            </div>
            <div class="col-md-4">
                <select name="monthDob" class="chosen-select">
                    <option value="" disabled selected>--- Select Month ---</option>

                    <?php if(isset($DobBs)): ?>

                        <?php if($DobBs['month'] == 1): ?>
                            <option value="1" selected>Baishak</option>
                        <?php else: ?>
                            <option value="1">Baishak</option>
                        <?php endif; ?>

                        <?php if($DobBs['month'] == 2): ?>
                            <option value="2" selected>Jestha</option>
                        <?php else: ?>
                            <option value="2">Jestha</option>
                        <?php endif; ?>

                        <?php if($DobBs['month'] == 3): ?>
                            <option value="3" selected>Asar</option>
                        <?php else: ?>
                            <option value="3">Asar</option>
                        <?php endif; ?>

                        <?php if($DobBs['month'] == 4): ?>
                            <option value="4" selected>Shrawan</option>
                        <?php else: ?>
                            <option value="4">Shrawan</option>
                        <?php endif; ?>

                        <?php if($DobBs['month'] == 5): ?>
                            <option value="5" selected>Bhadra</option>
                        <?php else: ?>
                            <option value="5">Bhadra</option>
                        <?php endif; ?>

                        <?php if($DobBs['month'] == 6): ?>
                            <option value="6" selected>Ashoj</option>
                        <?php else: ?>
                            <option value="6">Ashoj</option>
                        <?php endif; ?>

                        <?php if($DobBs['month'] == 7): ?>
                            <option value="7" selected>Kartik</option>
                        <?php else: ?>
                            <option value="7">Kartik</option>
                        <?php endif; ?>

                        <?php if($DobBs['month'] == 8): ?>
                            <option value="8" selected>Mangshir</option>
                        <?php else: ?>
                            <option value="8">Mangshir</option>
                        <?php endif; ?>

                        <?php if($DobBs['month'] == 9): ?>
                            <option value="9" selected>Poush</option>
                        <?php else: ?>
                            <option value="9">Poush</option>
                        <?php endif; ?>

                        <?php if($DobBs['month'] == 10): ?>
                            <option value="10" selected>Magh</option>
                        <?php else: ?>
                            <option value="10">Magh</option>
                        <?php endif; ?>

                        <?php if($DobBs['month'] == 11): ?>
                            <option value="11" selected>Falgun</option>
                        <?php else: ?>
                            <option value="11">Falgun</option>
                        <?php endif; ?>

                        <?php if($DobBs['month'] == 12): ?>
                            <option value="12" selected>Chaitra</option>
                        <?php else: ?>
                            <option value="12">Chaitra</option>
                        <?php endif; ?>

                    <?php else: ?>
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
                    <?php endif; ?>
                </select>
            </div>
            <div class="col-md-4">
                <select name="dayDob" class="chosen-select">
                    <option value="" disabled selected>--- Select Day ---</option>
                    <?php if(isset($DobBs)): ?>
                        <?php for($i = 1;$i<33;$i++): ?>
                            <?php if($DobBs['date'] == $i): ?>
                                <option value="<?php echo e($i); ?>" selected><?php echo e($i); ?></option>
                            <?php else: ?>
                                <option value="<?php echo e($i); ?>"><?php echo e($i); ?></option>
                            <?php endif; ?>
                        <?php endfor; ?>
                    <?php else: ?>
                        <?php for($i = 1;$i<33;$i++): ?>
                                <option value="<?php echo e($i); ?>"><?php echo e($i); ?></option>
                        <?php endfor; ?>
                    <?php endif; ?>
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
                   placeholder="Date of Birth" name="date_of_birth" autocomplete="off" value="<?php echo e($date_of_birth_formatted ?? ""); ?>">
        </div>
    </div>

<?php elseif($type == 'issueDate'): ?>
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
                    <?php if(isset($DateOfIssueBs)): ?>
                        <?php for($i = 2000;$i<2090;$i++): ?>
                            <?php if($DateOfIssueBs['year'] == $i): ?>
                                <option value="<?php echo e($i); ?>" selected><?php echo e($i); ?></option>
                            <?php else: ?>
                                <option value="<?php echo e($i); ?>"><?php echo e($i); ?></option>
                            <?php endif; ?>
                        <?php endfor; ?>
                    <?php else: ?>
                        <?php for($i = 2000;$i<2090;$i++): ?>
                                <option value="<?php echo e($i); ?>"><?php echo e($i); ?></option>
                        <?php endfor; ?>
                    <?php endif; ?>
                </select>
            </div>
            <div class="col-md-4">
                <select name="monthIssue" class="chosen-select">
                    <option value="" disabled selected>--- Select Month ---</option>
                    <?php if(isset($DateOfIssueBs)): ?>

                        <?php if($DateOfIssueBs['month'] == 1): ?>
                            <option value="1" selected>Baishak</option>
                        <?php else: ?>
                            <option value="1">Baishak</option>
                        <?php endif; ?>

                        <?php if($DateOfIssueBs['month'] == 2): ?>
                            <option value="2" selected>Jestha</option>
                        <?php else: ?>
                            <option value="2">Jestha</option>
                        <?php endif; ?>

                        <?php if($DateOfIssueBs['month'] == 3): ?>
                            <option value="3" selected>Asar</option>
                        <?php else: ?>
                            <option value="3">Asar</option>
                        <?php endif; ?>

                        <?php if($DateOfIssueBs['month'] == 4): ?>
                            <option value="4" selected>Shrawan</option>
                        <?php else: ?>
                            <option value="4">Shrawan</option>
                        <?php endif; ?>

                        <?php if($DateOfIssueBs['month'] == 5): ?>
                            <option value="5" selected>Bhadra</option>
                        <?php else: ?>
                            <option value="5">Bhadra</option>
                        <?php endif; ?>

                        <?php if($DateOfIssueBs['month'] == 6): ?>
                            <option value="6" selected>Ashoj</option>
                        <?php else: ?>
                            <option value="6">Ashoj</option>
                        <?php endif; ?>

                        <?php if($DateOfIssueBs['month'] == 7): ?>
                            <option value="7" selected>Kartik</option>
                        <?php else: ?>
                            <option value="7">Kartik</option>
                        <?php endif; ?>

                        <?php if($DateOfIssueBs['month'] == 8): ?>
                            <option value="8" selected>Mangshir</option>
                        <?php else: ?>
                            <option value="8">Mangshir</option>
                        <?php endif; ?>

                        <?php if($DateOfIssueBs['month'] == 9): ?>
                            <option value="9" selected>Poush</option>
                        <?php else: ?>
                            <option value="9">Poush</option>
                        <?php endif; ?>

                        <?php if($DateOfIssueBs['month'] == 10): ?>
                            <option value="10" selected>Magh</option>
                        <?php else: ?>
                            <option value="10">Magh</option>
                        <?php endif; ?>

                        <?php if($DateOfIssueBs['month'] == 11): ?>
                            <option value="11" selected>Falgun</option>
                        <?php else: ?>
                            <option value="11">Falgun</option>
                        <?php endif; ?>

                        <?php if($DateOfIssueBs['month'] == 12): ?>
                            <option value="12" selected>Chaitra</option>
                        <?php else: ?>
                            <option value="12">Chaitra</option>
                        <?php endif; ?>
                    <?php else: ?>
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
                    <?php endif; ?>
                </select>
            </div>
            <div class="col-md-4">
                <select name="dayIssue" class="form-control form-control-sm" class="chosen-select">
                    <option value="" disabled selected>--- Select Day ---</option>
                    <?php if(isset($DateOfIssueBs)): ?>
                        <?php for($i = 1;$i<33;$i++): ?>
                            <?php if($DateOfIssueBs['date'] == $i): ?>
                                <option value="<?php echo e($i); ?>" selected><?php echo e($i); ?></option>
                            <?php else: ?>
                                <option value="<?php echo e($i); ?>"><?php echo e($i); ?></option>
                            <?php endif; ?>
                        <?php endfor; ?>
                    <?php else: ?>
                        <?php for($i = 1;$i<33;$i++): ?>
                            <option value="<?php echo e($i); ?>"><?php echo e($i); ?></option>
                        <?php endfor; ?>
                    <?php endif; ?>
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
                   placeholder="Document Issue Date" name="c_issued_date" autocomplete="off" value="<?php echo e($date_of_issue_formatted ?? ""); ?>">
        </div>
    </div>
<?php endif; ?>








<?php /**PATH /var/www/html/resources/views/admin/user/datepicker.blade.php ENDPATH**/ ?>