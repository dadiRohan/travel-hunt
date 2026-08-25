<?php $__env->startSection('title', 'Explore Travels'); ?>

<?php $__env->startSection('content'); ?>
    <!-- Hero Section -->
    <div class="hero fade-in">
        <h1><i class="fas fa-globe"></i> Travel Hunt</h1>
        <p>Discover amazing travel stories from around the world</p>
    </div>

    <!-- Search and Filter -->
    <div class="row mb-4">
        <div class="col-md-8">
            <form action="<?php echo e(route('travels.index')); ?>" method="GET" class="d-flex gap-2">
                <input 
                    type="text" 
                    name="search" 
                    class="form-control" 
                    placeholder="Search travels..." 
                    value="<?php echo e($search ?? ''); ?>"
                >
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-search"></i> Search
                </button>
            </form>
        </div>
        <div class="col-md-4">
            <select class="form-select" onchange="window.location.href='<?php echo e(route('travels.index')); ?>?tag=' + this.value">
                <option value="">All Tags</option>
                <?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($tag->slug); ?>" <?php if($tag->slug == $tag): ?> selected <?php endif; ?>>
                        <?php echo e($tag->name); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
    </div>

    <!-- Travels Grid -->
    <?php if($travels->count() > 0): ?>
        <div class="row g-4">
            <?php $__currentLoopData = $travels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $travel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-lg-4 col-md-6 col-sm-12 fade-in">
                    <div class="card h-100">
                        <!-- Image -->
                        <?php if($travel->images->count() > 0): ?>
                            <img src="<?php echo e(asset('storage/' . $travel->images->first()->image_path)); ?>" 
                                 class="card-img-top" 
                                 alt="<?php echo e($travel->title); ?>">
                        <?php else: ?>
                            <div class="card-img-top" style="background: linear-gradient(135deg, #ff6b6b 0%, #4ecdc4 100%); display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-image" style="font-size: 3rem; color: white; opacity: 0.5;"></i>
                            </div>
                        <?php endif; ?>

                        <div class="card-body d-flex flex-column">
                            <!-- Title and Meta -->
                            <h5 class="card-title"><?php echo e(Str::limit($travel->title, 60)); ?></h5>
                            
                            <!-- Author -->
                            <p class="text-muted mb-2" style="font-size: 0.9rem;">
                                <i class="fas fa-user-circle"></i> <?php echo e($travel->user->name); ?>

                            </p>

                            <!-- Location -->
                            <?php if($travel->location): ?>
                                <p class="text-muted mb-2" style="font-size: 0.9rem;">
                                    <i class="fas fa-map-marker-alt"></i> <?php echo e($travel->location); ?>

                                </p>
                            <?php endif; ?>

                            <!-- Description -->
                            <p class="card-text flex-grow-1">
                                <?php echo e(Str::limit($travel->description, 100)); ?>

                            </p>

                            <!-- Tags -->
                            <?php if($travel->tags->count() > 0): ?>
                                <div class="mb-3">
                                    <?php $__currentLoopData = $travel->tags->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <span class="badge badge-secondary"><?php echo e($tag->name); ?></span>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            <?php endif; ?>

                            <!-- Stats -->
                            <div class="d-flex justify-content-between align-items-center mb-3" style="font-size: 0.9rem; color: #999;">
                                <span><i class="fas fa-heart"></i> <?php echo e($travel->likes()->count()); ?> Likes</span>
                                <span><i class="fas fa-comments"></i> <?php echo e($travel->comments()->count()); ?> Comments</span>
                            </div>

                            <!-- Actions -->
                            <a href="<?php echo e(route('travels.show', $travel->id)); ?>" class="btn btn-primary btn-sm w-100">
                                <i class="fas fa-eye"></i> View Details
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            <?php echo e($travels->links()); ?>

        </div>
    <?php else: ?>
        <div class="text-center py-5">
            <i class="fas fa-inbox" style="font-size: 3rem; color: #ccc;"></i>
            <p class="text-muted mt-3">No travels found. Why not create one?</p>
            <?php if(auth()->guard()->check()): ?>
                <a href="<?php echo e(route('travels.create')); ?>" class="btn btn-primary mt-3">
                    <i class="fas fa-plus"></i> Create Travel
                </a>
            <?php endif; ?>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\travel-hunt\resources\views/travels/index.blade.php ENDPATH**/ ?>