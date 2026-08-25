@extends('layouts.app')

@section('title', 'Create Travel')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card fade-in">
                <div class="card-body p-4">
                    <h2 class="card-title mb-4">
                        <i class="fas fa-plane"></i> Create New Travel Post
                    </h2>

                    <form action="{{ route('travels.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Title -->
                        <div class="mb-4">
                            <label for="title" class="form-label">Travel Title *</label>
                            <input 
                                type="text" 
                                class="form-control @error('title') is-invalid @enderror" 
                                id="title" 
                                name="title" 
                                placeholder="e.g., A Week in Paris" 
                                value="{{ old('title') }}"
                                required
                            >
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="mb-4">
                            <label for="description" class="form-label">Travel Description *</label>
                            <textarea 
                                class="form-control @error('description') is-invalid @enderror" 
                                id="description" 
                                name="description" 
                                rows="5" 
                                placeholder="Tell us about your travel experience..." 
                                required
                            >{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Location -->
                        <div class="mb-4">
                            <label for="location" class="form-label">Location</label>
                            <input 
                                type="text" 
                                class="form-control @error('location') is-invalid @enderror" 
                                id="location" 
                                name="location" 
                                placeholder="e.g., Paris, France" 
                                value="{{ old('location') }}"
                            >
                            @error('location')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Travel Date -->
                        <div class="mb-4">
                            <label for="travel_date" class="form-label">Travel Date</label>
                            <input 
                                type="date" 
                                class="form-control @error('travel_date') is-invalid @enderror" 
                                id="travel_date" 
                                name="travel_date" 
                                value="{{ old('travel_date') }}"
                            >
                            @error('travel_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Images Upload -->
                        <div class="mb-4">
                            <label for="images" class="form-label">Upload Photos * (Min: 1, Max: 10)</label>
                            <div class="input-group">
                                <input 
                                    type="file" 
                                    class="form-control @error('images') is-invalid @enderror" 
                                    id="images" 
                                    name="images[]" 
                                    multiple 
                                    accept="image/*"
                                    required
                                >
                                <span class="input-group-text">
                                    <i class="fas fa-images"></i>
                                </span>
                            </div>
                            <small class="text-muted d-block mt-2">
                                Supported formats: JPEG, PNG, GIF. Max size: 5MB per image.
                            </small>
                            @error('images')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                            @error('images.*')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                            
                            <!-- Preview -->
                            <div id="imagePreview" class="image-gallery mt-3"></div>
                        </div>

                        <!-- Tags -->
                        <div class="mb-4">
                            <label for="tags" class="form-label">Select Tags</label>
                            <div class="row">
                                @foreach($tags as $tag)
                                    <div class="col-md-6 mb-2">
                                        <div class="form-check">
                                            <input 
                                                class="form-check-input" 
                                                type="checkbox" 
                                                id="tag_{{ $tag->id }}" 
                                                name="tags[]" 
                                                value="{{ $tag->id }}"
                                                @if(in_array($tag->id, old('tags', []))) checked @endif
                                            >
                                            <label class="form-check-label" for="tag_{{ $tag->id }}">
                                                {{ $tag->name }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            @error('tags')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Submit -->
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-share"></i> Share Your Travel
                            </button>
                            <a href="{{ route('travels.index') }}" class="btn btn-outline-secondary">
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
    </style>

    <script>
        document.getElementById('images').addEventListener('change', function(e) {
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
@endsection
