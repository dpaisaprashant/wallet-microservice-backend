<?php $__env->startSection('content'); ?>

    <body>

        <div class="ibox-content">

            <h2>Add Khalti Services</h2>
            <form action="<?php echo e(route('store-service')); ?>" method="post">
                <?php echo csrf_field(); ?>
                <div class="form-group">
                    <label for="label">Label</label>
                    <input type="text" class="form-control" id="label" placeholder="Label" name="label" value="<?php echo e(old('label')); ?>">
                    <?php $__errorArgs = ['label'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="alert alert-danger"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" class="form-control" id="image" name="image">
                    <?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="alert alert-danger"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

           <div class="form-group">
            <label for="service">Wallet Service</label>
            <input type="text" class="form-control" id="service" placeholder="Enter services" name="service" value="<?php echo e(old('service')); ?>">
            <?php $__errorArgs = ['service'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="alert alert-danger"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

                
            <div class="form-group">
                    <label for="step">twoSteps</label>
                    <select name="step" id="step" class="form-control">
                        <option value="">Select step</option>
                        <option value="0">0</option>
                        <option value="1">1</option>
                    </select>
                    <?php $__errorArgs = ['step'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="alert alert-danger"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
                <div class="form-group">
                    <label for="forms">Forms</label>
                    <button type="button" id="addForm">Add Form</button>
                    <div id="formsContainer"></div>
                    <?php $__errorArgs = ['forms'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="alert alert-danger"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

<script>
    document.getElementById('addForm').addEventListener('click', function() {
        var formsContainer = document.getElementById('formsContainer');

        var formDiv = document.createElement('div');

        var formlabelInput = document.createElement('input');
        formlabelInput.setAttribute('name', 'forms[][formlabel]');
        formlabelInput.setAttribute('placeholder', 'Form Label');
        formDiv.appendChild(formlabelInput);

        var placeholderInput = document.createElement('input');
        placeholderInput.setAttribute('name', 'forms[][placeholder]');
        placeholderInput.setAttribute('placeholder', 'Placeholder');
        formDiv.appendChild(placeholderInput);

        var bebodyInput = document.createElement('input');
        bebodyInput.setAttribute('name', 'forms[][beBody]');
        bebodyInput.setAttribute('placeholder', 'beBody');
        formDiv.appendChild(bebodyInput);

        var inputDataTypeInput = document.createElement('input');
        inputDataTypeInput.setAttribute('name', 'forms[][inputDataType]');
        inputDataTypeInput.setAttribute('placeholder', 'Input Data Type');
        formDiv.appendChild(inputDataTypeInput);

        formsContainer.appendChild(formDiv);
    });
</script>

                <div>
                    <button class="btn btn-primary">Send</button>
                </div>


        </form>
    
    <br>
    <?php $__env->stopSection(); ?>


</body>

<?php if(session('status')): ?>
    <script>
        alert('<?php echo e(session('status')); ?>');
    </script>
<?php endif; ?>

<?php if(session('success')): ?>
    <script>
        alert('<?php echo e(session('success')); ?>');
    </script>
<?php endif; ?>

<?php if(session('error')): ?>
    <script>
        alert('<?php echo e(session('error')); ?>');
    </script>
<?php endif; ?>

<?php echo $__env->make('admin.layouts.admin_design', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/khalti/khalti_services.blade.php ENDPATH**/ ?>