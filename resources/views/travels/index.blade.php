@extends('layouts.app')

@section('title', 'Explore Travels')

@section('content')
    <!-- Hero Section -->
    <div class="hero fade-in">
        <h1><i class="fas fa-globe"></i> Travel Hunt</h1>
        <p>Discover amazing travel stories from around the world</p>
    </div>

    <!-- Search and Filter -->
    <div class="row mb-4">
        <div class="col-md-8">
            <form action="{{ route('travels.index') }}" method="GET" class="d-flex gap-2">
                <input 
                    type="text" 
                    name="search" 
                    class="form-control" 
                    placeholder="Search travels..." 
                    value="{{ $search ?? '' }}"
                >
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-search"></i> Search
                </button>
            </form>
        </div>
        <div class="col-md-4">
            <select class="form-select" onchange="window.location.href='{{ route('travels.index') }}?tag=' + this.value">
                <option value="">All Tags</option>
                @foreach($tags as $tag)
                    <option value="{{ $tag->slug }}" @if($tag->slug == $tag) selected @endif>
                        {{ $tag->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <!-- Travels Grid -->
    @if($travels->count() > 0)
        <div class="row g-4">
            @foreach($travels as $travel)
                <div class="col-lg-4 col-md-6 col-sm-12 fade-in">
                    <div class="card h-100">
                        <!-- Image -->
                        @if($travel->images->count() > 0)
                            <img src="{{ asset('storage/' . $travel->images->first()->image_path) }}" 
                                 class="card-img-top" 
                                 alt="{{ $travel->title }}">
                        @else
                            <div class="card-img-top" style="background: linear-gradient(135deg, #ff6b6b 0%, #4ecdc4 100%); display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-image" style="font-size: 3rem; color: white; opacity: 0.5;"></i>
                            </div>
                        @endif

                        <div class="card-body d-flex flex-column">
                            <!-- Title and Meta -->
                            <h5 class="card-title">{{ Str::limit($travel->title, 60) }}</h5>
                            
                            <!-- Author -->
                            <p class="text-muted mb-2" style="font-size: 0.9rem;">
                                <i class="fas fa-user-circle"></i> {{ $travel->user->name }}
                            </p>

                            <!-- Location -->
                            @if($travel->location)
                                <p class="text-muted mb-2" style="font-size: 0.9rem;">
                                    <i class="fas fa-map-marker-alt"></i> {{ $travel->location }}
                                </p>
                            @endif

                            <!-- Description -->
                            <p class="card-text flex-grow-1">
                                {{ Str::limit($travel->description, 100) }}
                            </p>

                            <!-- Tags -->
                            @if($travel->tags->count() > 0)
                                <div class="mb-3">
                                    @foreach($travel->tags->take(3) as $tag)
                                        <span class="badge badge-secondary">{{ $tag->name }}</span>
                                    @endforeach
                                </div>
                            @endif

                            <!-- Stats -->
                            <div class="d-flex justify-content-between align-items-center mb-3" style="font-size: 0.9rem; color: #999;">
                                <span><i class="fas fa-heart"></i> {{ $travel->likes()->count() }} Likes</span>
                                <span><i class="fas fa-comments"></i> {{ $travel->comments()->count() }} Comments</span>
                            </div>

                            <!-- Actions -->
                            <a href="{{ route('travels.show', $travel->id) }}" class="btn btn-primary btn-sm w-100">
                                <i class="fas fa-eye"></i> View Details
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            {{ $travels->links() }}
        </div>
    @else
        <div class="text-center py-5">
            <i class="fas fa-inbox" style="font-size: 3rem; color: #ccc;"></i>
            <p class="text-muted mt-3">No travels found. Why not create one?</p>
            @auth
                <a href="{{ route('travels.create') }}" class="btn btn-primary mt-3">
                    <i class="fas fa-plus"></i> Create Travel
                </a>
            @endauth
        </div>
    @endif
@endsection
