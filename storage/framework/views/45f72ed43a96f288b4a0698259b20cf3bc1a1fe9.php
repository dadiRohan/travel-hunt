<?php $__env->startSection('title', 'Edit Travel'); ?>

<?php $__env->startSection('content'); ?>
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card fade-in">
                <div class="card-body p-4">
                    <h2 class="card-title mb-4">
                        <i class="fas fa-edit"></i> Edit Travel Post
                    </h2>

                    <form action="<?php echo e(route('travels.update', $travel->id)); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>

                        <!-- Title -->
                        <div class="mb-4">
                            <label for="title" class="form-label">Travel Title *</label>
                            <input 
                                type="text" 
                                class="form-control <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                id="title" 
                                name="title" 
                                value="<?php echo e($travel->title); ?>"
                                required
                            >
                            <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <!-- Description -->
                        <div class="mb-4">
                            <label for="description" class="form-label">Travel Description *</label>
                            <textarea 
                                class="form-control <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                id="description" 
                                name="description" 
                                rows="5" 
                                required
                            ><?php echo e($travel->description); ?></textarea>
                            <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <!-- Location -->
                        <div class="mb-4">
                            <label for="location" class="form-label">Location</label>
                            <input 
                                type="text" 
                                class="form-control <?php $__errorArgs = ['location'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                id="location" 
                                name="location" 
                                value="<?php echo e($travel->location); ?>"
                            >
                            <?php $__errorArgs = ['location'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <!-- Travel Date -->
                        <div class="mb-4">
                            <label for="travel_date" class="form-label">Travel Date</label>
                            <input 
                                type="date" 
                                class="form-control <?php $__errorArgs = ['travel_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                id="travel_date" 
                                name="travel_date" 
                                value="<?php echo e($travel->travel_date?->format('Y-m-d')); ?>"
                            >
                            <?php $__errorArgs = ['travel_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <!-- Current Images -->
                        <div class="mb-4">
                            <label class="form-label">Current Photos</label>
                            <div class="image-gallery">
                                <?php $__currentLoopData = $travel->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="gallery-item position-relative">
                                        <img src="<?php echo e(asset('storage/' . $image->image_path)); ?>" alt="Travel image">
                                        <form action="<?php echo e(route('travels.delete-image', $image->id)); ?>" method="POST" style="display: inline;">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="delete-btn" onclick="return confirm('Delete this image?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>

                        <!-- Add More Images -->
                        <div class="mb-4">
                            <label for="new_images" class="form-label">Add More Photos (Max: 10)</label>
                            <div class="input-group">
                                <input 
                                    type="file" 
                                    class="form-control <?php $__errorArgs = ['new_images'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                    id="new_images" 
                                    name="new_images[]" 
                                    multiple 
                                    accept="image/*"
                                >
                                <span class="input-group-text">
                                    <i class="fas fa-images"></i>
                                </span>
                            </div>
                            <small class="text-muted d-block mt-2">
                                Supported formats: JPEG, PNG, GIF. Max size: 5MB per image.
                            </small>
                            <?php $__errorArgs = ['new_images'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback d-block"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            
                            <!-- Preview -->
                            <div id="imagePreview" class="image-gallery mt-3"></div>
                        </div>

                        <!-- Tags -->
                        <div class="mb-4">
                            <label for="tags" class="form-label">Select Tags</label>
                            <div class="row">
                                <?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-md-6 mb-2">
                                        <div class="form-check">
                                            <input 
                                                class="form-check-input" 
                                                type="checkbox" 
                                                id="tag_<?php echo e($tag->id); ?>" 
                                                name="tags[]" 
                                                value="<?php echo e($tag->id); ?>"
                                                <?php if($travel->tags->contains($tag->id)): ?> checked <?php endif; ?>
                                            >
                                            <label class="form-check-label" for="tag_<?php echo e($tag->id); ?>">
                                                <?php echo e($tag->name); ?>

                                            </label>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <?php $__errorArgs = ['tags'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback d-block"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <!-- Submit -->
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-save"></i> Update Travel
                            </button>
                            <a href="<?php echo e(route('travels.show', $travel->id)); ?>" class="btn btn-outline-secondary">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <style>
        #imagePreview {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
            gap: 1rem;
        }

        .preview-item {
            position: relative;
            border-radius: 8px;
            overflow: hidden;
            background: #f0f0f0;
        }

        .preview-item img {
            width: 100%;
            height: 100px;
            object-fit: cover;
        }

        .gallery-item {
            position: relative;
            border-radius: 8px;
            overflow: hidden;
            cursor: pointer;
        }

        .gallery-item img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .gallery-item:hover img {
            transform: scale(1.1);
        }

        .delete-btn {
            position: absolute;
            top: 5px;
            right: 5px;
            background-color: rgba(255, 0, 0, 0.8);
            color: white;
            border: none;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8rem;
            transition: all 0.3s ease;
        }

        .delete-btn:hover {
            background-color: rgba(255, 0, 0, 1);
        }
    </style>

    <script>
        document.getElementById('new_images').addEventListener('change', function(e) {
            const preview = document.getElementById('imagePreview');
            preview.innerHTML = '';

            Array.from(this.files).forEach((file, index) => {
                const reader = new FileReader();
                reader.onload = function(event) {
                    const div = document.createElement('div');
                    div.className = 'preview-item';
                    div.innerHTML = `
                        <img src="${event.target.result}" alt="Preview ${index + 1}">
                        <small style="position: absolute; bottom: 5px; left: 5px; color: white; background: rgba(0,0,0,0.7); padding: 2px 6px; border-radius: 3px;">${index + 1}</small>
                    `;
                    preview.appendChild(div);
                };
                reader.readAsDataURL(file);
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\travel-hunt\resources\views/travels/edit.blade.php ENDPATH**/ ?>