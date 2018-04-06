<div class="form-group <?php echo e($errors->has($input['name']) ? 'has-error' : ''); ?>">
    <?php if(isset($input['title'])): ?>
        <label for="<?php echo e($input['name']); ?>"><?php echo e($input['title']); ?></label>
    <?php endif; ?>
    <?php if($input['input'] === 'textarea'): ?>
        <textarea class="form-control" rows="<?php echo e($input['rows']); ?>" id="<?php echo e($input['name']); ?>" name="<?php echo e($input['name']); ?>" <?php if($input['required']): ?> required <?php endif; ?>><?php echo e(old($input['name'], $input['value'])); ?></textarea>
    <?php elseif($input['input'] === 'checkbox'): ?>
        <div class="checkbox">
            <label>
                <input id="<?php echo e($input['name']); ?>" name="<?php echo e($input['name']); ?>" type="checkbox" <?php echo e($input['value'] ? 'checked' : ''); ?>><?php echo e($input['label']); ?>

            </label>
        </div>
    <?php elseif($input['input'] === 'select'): ?>
        <select multiple required class="form-control" name="<?php echo e($input['name']); ?>[]" id="<?php echo e($input['name']); ?>">
            <?php $__currentLoopData = $input['options']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $title): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($id); ?>" <?php echo e(old($input['name']) ? (in_array($id, old($input['name'])) ? 'selected' : '') : ($input['values']->contains('id', $id) ? 'selected' : '')); ?>><?php echo e($title); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    <?php elseif($input['input'] === 'slider'): ?>
        <input class="slider" id="<?php echo e($input['name']); ?>" name="<?php echo e($input['name']); ?>" type="text" data-slider-min="<?php echo e($input['min']); ?>" data-slider-max="<?php echo e($input['max']); ?>" data-slider-step="1" data-slider-value="<?php echo e(old($input['name'], $input['value'])); ?>"/>
    <?php else: ?>
        <input type="text" class="form-control" id="<?php echo e($input['name']); ?>" name="<?php echo e($input['name']); ?>" value="<?php echo e(old($input['name'], $input['value'])); ?>" <?php if($input['required']): ?> required <?php endif; ?>>
    <?php endif; ?>
    <?php echo $errors->first($input['name'], '<span class="help-block">:message</span>'); ?>

</div>

