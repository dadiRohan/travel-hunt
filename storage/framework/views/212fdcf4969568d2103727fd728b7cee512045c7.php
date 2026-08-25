<?php $__env->startSection('title', $travel->title); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <!-- Main Content -->
        <div class="col-lg-8">
            <div class="card fade-in">
                <!-- Image Carousel -->
                <?php if($travel->images->count() > 0): ?>
                    <div id="travelCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <?php $__currentLoopData = $travel->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="carousel-item <?php if($index === 0): ?> active <?php endif; ?>">
                                    <img src="<?php echo e(asset('storage/' . $image->image_path)); ?>" 
                                         class="d-block w-100" 
                                         alt="Slide <?php echo e($index + 1); ?>" 
                                         style="height: 400px; object-fit: cover;">
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>

                        <?php if($travel->images->count() > 1): ?>
                            <button class="carousel-control-prev" type="button" data-bs-target="#travelCarousel" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon"></span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#travelCarousel" data-bs-slide="next">
                                <span class="carousel-control-next-icon"></span>
                            </button>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <div class="card-body">
                    <!-- Header -->
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <h1 class="mb-2"><?php echo e($travel->title); ?></h1>
                            <div class="d-flex align-items-center gap-3 text-muted mb-3">
                                <span>
                                    <i class="fas fa-user-circle"></i> 
                                    <strong><?php echo e($travel->user->name); ?></strong>
                                </span>
                                <span>
                                    <i class="far fa-calendar"></i> 
                                    <?php echo e($travel->created_at->format('M d, Y')); ?>

                                </span>
                                <?php if($travel->location): ?>
                                    <span>
                                        <i class="fas fa-map-marker-alt"></i> 
                                        <?php echo e($travel->location); ?>

                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Edit/Delete buttons for owner -->
                        <?php if(auth()->guard()->check()): ?>
                            <?php if(auth()->user()->id === $travel->user_id): ?>
                                <div class="btn-group" role="group">
                                    <a href="<?php echo e(route('travels.edit', $travel->id)); ?>" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="<?php echo e(route('travels.destroy', $travel->id)); ?>" method="POST" style="display: inline;">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>

                    <!-- Tags -->
                    <?php if($travel->tags->count() > 0): ?>
                        <div class="mb-3">
                            <?php $__currentLoopData = $travel->tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a href="<?php echo e(route('travels.index', ['tag' => $tag->slug])); ?>" class="badge badge-secondary">
                                    <i class="fas fa-tag"></i> <?php echo e($tag->name); ?>

                                </a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php endif; ?>

                    <!-- Description -->
                    <p class="card-text" style="font-size: 1.05rem; line-height: 1.8; color: #555;">
                        <?php echo e($travel->description); ?>

                    </p>

                    <!-- Travel Date -->
                    <?php if($travel->travel_date): ?>
                        <p class="text-muted">
                            <i class="fas fa-calendar-check"></i> Travel Date: <?php echo e($travel->travel_date->format('F d, Y')); ?>

                        </p>
                    <?php endif; ?>

                    <!-- Engagement Stats -->
                    <hr>
                    <div class="d-flex justify-content-between mb-4" style="padding: 1rem 0;">
                        <div class="text-center">
                            <h5 id="likesCount"><?php echo e($travel->likes()->count()); ?></h5>
                            <small class="text-muted">Likes</small>
                        </div>
                        <div class="text-center">
                            <h5><?php echo e($travel->comments()->count()); ?></h5>
                            <small class="text-muted">Comments</small>
                        </div>
                        <div class="text-center">
                            <h5><?php echo e(count(explode(',', url()->current()))); ?></h5>
                            <small class="text-muted">Shares</small>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="d-flex gap-2 mb-4 flex-wrap">
                        <?php if(auth()->guard()->check()): ?>
                            <button class="btn-icon btn-like" id="likeBtn" onclick="toggleLike(<?php echo e($travel->id); ?>)">
                                <i class="fas fa-heart"></i>
                                <span id="likeText"><?php echo e(auth()->user()->hasLiked($travel->id) ? 'Liked' : 'Like'); ?></span>
                            </button>
                        <?php else: ?>
                            <a href="<?php echo e(route('login')); ?>" class="btn-icon btn-like">
                                <i class="fas fa-heart"></i> Like
                            </a>
                        <?php endif; ?>

                        <button class="btn-icon btn-comment" onclick="document.getElementById('commentForm').scrollIntoView({behavior: 'smooth'})">
                            <i class="fas fa-comment"></i> Comment
                        </button>

                        <div class="btn-group">
                            <button class="btn-icon" style="background-color: #e3f2fd; color: #2196F3;" onclick="shareToSocial('facebook')">
                                <i class="fab fa-facebook"></i>
                            </button>
                            <button class="btn-icon" style="background-color: #e0f2f1; color: #009688;" onclick="shareToSocial('twitter')">
                                <i class="fab fa-twitter"></i>
                            </button>
                            <button class="btn-icon" style="background-color: #fce4ec; color: #e91e63;" onclick="shareToSocial('whatsapp')">
                                <i class="fab fa-whatsapp"></i>
                            </button>
                            <button class="btn-icon" style="background-color: #f3e5f5; color: #9c27b0;" onclick="copyToClipboard()">
                                <i class="fas fa-link"></i>
                            </button>
                        </div>
                    </div>

                    <!-- All Images Gallery -->
                    <?php if($travel->images->count() > 1): ?>
                        <hr>
                        <h5 class="mb-3"><i class="fas fa-images"></i> Gallery</h5>
                        <div class="image-gallery">
                            <?php $__currentLoopData = $travel->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <img src="<?php echo e(asset('storage/' . $image->image_path)); ?>" 
                                     alt="Travel image" 
                                     class="rounded cursor-pointer" 
                                     onclick="scrollToImage(this)"
                                     style="width: 100%; height: 150px; object-fit: cover;">
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php endif; ?>

                    <!-- Comments Section -->
                    <div class="comments-section">
                        <h4><i class="fas fa-comments"></i> Comments (<?php echo e($travel->comments()->count()); ?>)</h4>

                        <?php if(auth()->guard()->check()): ?>
                            <!-- Comment Form -->
                            <form id="commentForm" action="<?php echo e(route('comments.store', $travel->id)); ?>" method="POST" class="mb-4">
                                <?php echo csrf_field(); ?>
                                <div class="input-group">
                                    <textarea 
                                        name="content" 
                                        class="form-control" 
                                        placeholder="Share your thoughts..." 
                                        rows="2"
                                        required
                                    ></textarea>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-paper-plane"></i> Post
                                    </button>
                                </div>
                            </form>
                        <?php else: ?>
                            <p class="alert alert-info mb-4">
                                <a href="<?php echo e(route('login')); ?>">Sign in</a> to comment on this travel!
                            </p>
                        <?php endif; ?>

                        <!-- Comments List -->
                        <?php $__empty_1 = true; $__currentLoopData = $travel->comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <div class="comment-item">
                                <div class="comment-header">
                                    <div>
                                        <strong class="comment-author"><?php echo e($comment->user->name); ?></strong>
                                        <small class="comment-time"><?php echo e($comment->created_at->diffForHumans()); ?></small>
                                    </div>
                                    <?php if(auth()->guard()->check()): ?>
                                        <?php if(auth()->user()->id === $comment->user_id): ?>
                                            <div class="btn-group btn-group-sm">
                                                <button class="btn btn-sm btn-link text-danger" onclick="deleteComment(<?php echo e($comment->id); ?>)">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                                <p class="comment-content"><?php echo e($comment->content); ?></p>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <p class="text-muted text-center py-4">No comments yet. Be the first to comment!</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Author Card -->
            <div class="card mb-4 fade-in">
                <div class="card-body text-center">
                    <h5>About the Traveler</h5>
                    <hr>
                    <h6><?php echo e($travel->user->name); ?></h6>
                    <p class="text-muted"><?php echo e($travel->user->travels()->count()); ?> travels shared</p>
                    <?php if(auth()->guard()->check()): ?>
                        <?php if(auth()->user()->id !== $travel->user_id): ?>
                            <a href="mailto:<?php echo e($travel->user->email); ?>" class="btn btn-primary btn-sm">
                                <i class="fas fa-envelope"></i> Contact
                            </a>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Related Travels -->
            <?php if($relatedTravels->count() > 0): ?>
                <div class="card fade-in">
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class="fas fa-compass"></i> Related Travels
                        </h5>
                        <hr>
                        <?php $__currentLoopData = $relatedTravels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $related): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="mb-3">
                                <a href="<?php echo e(route('travels.show', $related->id)); ?>" style="text-decoration: none;">
                                    <?php if($related->images->count() > 0): ?>
                                        <img src="<?php echo e(asset('storage/' . $related->images->first()->image_path)); ?>" 
                                             alt="<?php echo e($related->title); ?>" 
                                             style="width: 100%; height: 100px; object-fit: cover; border-radius: 6px; margin-bottom: 0.5rem;">
                                    <?php endif; ?>
                                    <h6 style="color: var(--dark); margin: 0;"><?php echo e(Str::limit($related->title, 40)); ?></h6>
                                    <small class="text-muted">by <?php echo e($related->user->name); ?></small>
                                </a>
                            </div>
                            <hr style="margin: 1rem 0;">
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script>
        function toggleLike(travelId) {
            <?php if(auth()->guard()->check()): ?>
                fetch(`/travels/${travelId}/like`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    const likeBtn = document.getElementById('likeBtn');
                    const likeText = document.getElementById('likeText');
                    const likesCount = document.getElementById('likesCount');
                    
                    if(data.liked) {
                        likeBtn.classList.add('liked');
                        likeText.textContent = 'Liked';
                    } else {
                        likeBtn.classList.remove('liked');
                        likeText.textContent = 'Like';
                    }
                    likesCount.textContent = data.likes_count;
                })
                .catch(error => console.error('Error:', error));
            <?php else: ?>
                window.location.href = '<?php echo e(route("login")); ?>';
            <?php endif; ?>
        }

        function deleteComment(commentId) {
            if(confirm('Delete this comment?')) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `/comments/${commentId}`;
                form.innerHTML = `
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                `;
                document.body.appendChild(form);
                form.submit();
            }
        }

        function shareToSocial(platform) {
            const url = encodeURIComponent(window.location.href);
            const title = encodeURIComponent('<?php echo e($travel->title); ?>');
            let shareUrl = '';

            switch(platform) {
                case 'facebook':
                    shareUrl = `https://www.facebook.com/sharer/sharer.php?u=${url}`;
                    break;
                case 'twitter':
                    shareUrl = `https://twitter.com/intent/tweet?url=${url}&text=${title}`;
                    break;
                case 'whatsapp':
                    shareUrl = `https://wa.me/?text=${title}%20${url}`;
                    break;
            }

            if(shareUrl) {
                window.open(shareUrl, '_blank', 'width=600,height=400');
            }
        }

        function copyToClipboard() {
            const url = window.location.href;
            navigator.clipboard.writeText(url).then(() => {
                alert('Link copied to clipboard!');
            }).catch(() => {
                prompt('Copy this link:', url);
            });
        }

        function scrollToImage(img) {
            document.getElementById('travelCarousel').scrollIntoView({behavior: 'smooth'});
        }

        // Set initial like button state
        document.addEventListener('DOMContentLoaded', function() {
            <?php if(auth()->check() && auth()->user()->hasLiked($travel->id)): ?>
                document.getElementById('likeBtn').classList.add('liked');
                document.getElementById('likeText').textContent = 'Liked';
            <?php endif; ?>
        });
    </script>

    <style>
        .btn-group {
            display: flex;
            gap: 0.25rem;
        }

        .carousel {
            border-radius: 12px 12px 0 0;
            overflow: hidden;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\travel-hunt\resources\views/travels/show.blade.php ENDPATH**/ ?>