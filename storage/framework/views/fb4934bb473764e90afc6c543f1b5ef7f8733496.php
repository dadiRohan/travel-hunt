<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo e(config('app.name', 'Travel Hunt')); ?> - <?php echo $__env->yieldContent('title'); ?></title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        :root {
            --primary: #ff6b6b;
            --secondary: #4ecdc4;
            --dark: #1a1a1a;
            --light: #f8f9fa;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--light);
            color: #333;
        }

        /* Navigation */
        .navbar {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 1rem 0;
        }

        .navbar-brand {
            font-size: 1.8rem;
            font-weight: 700;
            color: white !important;
            letter-spacing: 0.5px;
        }

        .navbar-brand i {
            margin-right: 0.5rem;
        }

        .nav-link {
            color: white !important;
            margin-left: 1rem;
            font-weight: 500;
            transition: all 0.3s ease;
            position: relative;
        }

        .nav-link:hover {
            opacity: 0.8;
            transform: translateY(-2px);
        }

        .nav-link.active {
            border-bottom: 2px solid white;
        }

        .btn-primary {
            background-color: var(--primary);
            border-color: var(--primary);
            font-weight: 600;
            padding: 0.5rem 1.5rem;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: darken(#ff6b6b, 10%);
            border-color: darken(#ff6b6b, 10%);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 107, 107, 0.3);
        }

        .btn-secondary {
            background-color: var(--secondary);
            border-color: var(--secondary);
            font-weight: 600;
        }

        .btn-secondary:hover {
            background-color: darken(#4ecdc4, 10%);
            border-color: darken(#4ecdc4, 10%);
        }

        /* Container */
        .main-container {
            min-height: calc(100vh - 60px);
            padding: 2rem 0;
        }

        /* Cards */
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        }

        .card-img-top {
            height: 250px;
            object-fit: cover;
        }

        .card-body {
            padding: 1.5rem;
        }

        .card-title {
            font-size: 1.2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            color: var(--dark);
        }

        .card-text {
            color: #666;
            font-size: 0.95rem;
            line-height: 1.6;
        }

        /* Tags */
        .badge {
            padding: 0.4rem 0.8rem;
            font-weight: 500;
            border-radius: 20px;
            margin: 0.25rem;
            display: inline-block;
        }

        .badge-primary {
            background-color: var(--primary);
            color: white;
        }

        .badge-secondary {
            background-color: var(--secondary);
            color: white;
        }

        /* Buttons */
        .btn-icon {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }

        .btn-like {
            background-color: #ffe0e6;
            color: var(--primary);
        }

        .btn-like:hover,
        .btn-like.liked {
            background-color: var(--primary);
            color: white;
        }

        .btn-comment {
            background-color: #e8f4f8;
            color: var(--secondary);
        }

        .btn-comment:hover {
            background-color: var(--secondary);
            color: white;
        }

        /* Footer */
        footer {
            background-color: var(--dark);
            color: white;
            padding: 2rem;
            margin-top: 3rem;
            text-align: center;
        }

        /* Forms */
        .form-control,
        .form-select {
            border-radius: 8px;
            border: 1px solid #ddd;
            padding: 0.75rem 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.2rem rgba(255, 107, 107, 0.25);
        }

        .form-label {
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: var(--dark);
        }

        /* Alert */
        .alert {
            border-radius: 8px;
            border: none;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
        }

        /* Hero Section */
        .hero {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            color: white;
            padding: 4rem 0;
            margin-bottom: 2rem;
            border-radius: 12px;
            text-align: center;
        }

        .hero h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .hero p {
            font-size: 1.1rem;
            margin-bottom: 1.5rem;
            opacity: 0.95;
        }

        /* Image Gallery */
        .image-gallery {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 1rem;
            margin-bottom: 1rem;
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
            display: none;
            align-items: center;
            justify-content: center;
            font-size: 0.8rem;
            transition: all 0.3s ease;
        }

        .gallery-item:hover .delete-btn {
            display: flex;
        }

        .delete-btn:hover {
            background-color: rgba(255, 0, 0, 1);
        }

        /* Comments Section */
        .comments-section {
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 1px solid #ddd;
        }

        .comment-item {
            background-color: white;
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1rem;
            border-left: 3px solid var(--secondary);
        }

        .comment-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 0.5rem;
        }

        .comment-author {
            font-weight: 600;
            color: var(--dark);
        }

        .comment-time {
            font-size: 0.85rem;
            color: #999;
        }

        .comment-content {
            color: #555;
            line-height: 1.6;
            margin-bottom: 0.5rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .navbar-brand {
                font-size: 1.4rem;
            }

            .nav-link {
                margin-left: 0;
                padding: 0.5rem 0;
            }

            .hero h1 {
                font-size: 1.8rem;
            }

            .hero p {
                font-size: 1rem;
            }

            .card-img-top {
                height: 200px;
            }

            .image-gallery {
                grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
            }

            .main-container {
                padding: 1rem 0;
            }

            .page-title {
                font-size: 1.5rem;
            }
        }

        @media (max-width: 576px) {
            .navbar-brand {
                font-size: 1.2rem;
            }

            .nav-link {
                font-size: 0.9rem;
            }

            .hero {
                padding: 2rem 0;
            }

            .hero h1 {
                font-size: 1.5rem;
            }

            .hero p {
                font-size: 0.95rem;
            }

            .card-body {
                padding: 1rem;
            }

            .card-title {
                font-size: 1rem;
            }

            .btn-icon {
                padding: 0.4rem 0.8rem;
                font-size: 0.85rem;
            }
        }

        /* Animations */
        @keyframes  fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in {
            animation: fadeIn 0.5s ease;
        }

        /* Utilities */
        .text-muted {
            color: #999 !important;
        }

        .text-center {
            text-align: center;
        }

        .mt-4 {
            margin-top: 1.5rem !important;
        }

        .mb-4 {
            margin-bottom: 1.5rem !important;
        }

        .gap-2 {
            gap: 0.5rem;
        }

        .cursor-pointer {
            cursor: pointer;
        }
    </style>

    <?php echo $__env->yieldContent('styles'); ?>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?php echo e(route('travels.index')); ?>">
                <i class="fas fa-map"></i> Travel Hunt
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link <?php if(Route::currentRouteName() == 'travels.index'): ?> active <?php endif; ?>" href="<?php echo e(route('travels.index')); ?>">
                            <i class="fas fa-home"></i> Home
                        </a>
                    </li>
                    <?php if(auth()->guard()->check()): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo e(route('travels.create')); ?>">
                                <i class="fas fa-plus-circle"></i> Create Travel
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userMenu" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user"></i> <?php echo e(Auth::user()->name); ?>

                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userMenu">
                                <li><a class="dropdown-item" href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt"></i> Logout
                                </a></li>
                            </ul>
                            <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                                <?php echo csrf_field(); ?>
                            </form>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo e(route('login')); ?>">
                                <i class="fas fa-sign-in-alt"></i> Login
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo e(route('register')); ?>">
                                <i class="fas fa-user-plus"></i> Register
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="main-container">
        <div class="container">
            <?php if($errors->any()): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Errors:</strong>
                    <ul class="mb-0">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <?php if(session('success')): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle"></i> <?php echo e(session('success')); ?>

                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <?php echo $__env->yieldContent('content'); ?>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div class="container">
            <p>&copy; 2024 Travel Hunt. Share your adventures with the world!</p>
            <p class="text-muted">Built with <i class="fas fa-heart" style="color: var(--primary);"></i> using Laravel & Bootstrap</p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Auto-dismiss alerts after 5 seconds
        document.querySelectorAll('.alert').forEach(function(alert) {
            setTimeout(function() {
                alert.classList.remove('show');
                alert.remove();
            }, 5000);
        });
    </script>

    <?php echo $__env->yieldContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\travel-hunt\resources\views/layouts/app.blade.php ENDPATH**/ ?>