@extends('layouts.layout')

@section('title', 'Eco News')

@section('content')

<main>
    <section class="news-detail-header-section text-center">
        <div class="section-overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-12">
                    <h1 class="text-white">Eco News</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="news-section section-padding">
        <div class="container">
            <div class="row">

                <!-- BERITA -->
                <div class="col-lg-7 col-12" id="news-container">
                    @if($newsItems->isEmpty())
                        <p class="text-center text-muted mt-4">Belum ada berita tersedia.</p>
                    @endif

                    <!-- PESAN SAAT TIDAK ADA HASIL PENCARIAN -->
                    <div id="no-results-message" class="text-center text-muted mt-4" style="display: none;">
                        <p id="no-results-text">Kategori atau berita belum tersedia.</p>
                    </div>

                    @foreach($newsItems as $news)
                    <div class="news-block news-item">
                        <div class="news-block-top">
                            <a href="{{ route('econews.detail', ['id' => $news->id]) }}">
                                <img src="{{ $news->image ? asset('storage/' . $news->image) : 'https://picsum.photos/seed/' . urlencode($news->title) . '/600/400' }}" class="news-image img-fluid" alt="{{ $news->title }}" style="width: 100%; height: 400px; object-fit: none;">
                            </a>
                            <div class="news-category-block">
                                @foreach($news->categories as $category)
                                <a href="{{ route('econews.filter.category', ['id' => $category->id]) }}" class="category-block-link">
                                    {{ $category->name }}{{ !$loop->last ? ',' : '' }}
                                </a>
                                @endforeach
                            </div>
                        </div>
                        <div class="news-block-info">
                            <div class="d-flex mt-2">
                                <div class="news-block-date">
                                    <p><i class="bi-calendar4 custom-icon me-1"></i>{{ $news->published_at->format('F d, Y') }}</p>
                                </div>
                                <div class="news-block-author mx-5">
                                    <p><i class="bi-person custom-icon me-1"></i>By {{ $news->author->name }}</p>
                                </div>
                                <div class="news-block-comment">
                                    <p><i class="bi-chat-left custom-icon me-1"></i>{{ $news->comments_count ?? 0 }} Comments</p>
                                </div>
                            </div>
                            <div class="news-block-title mb-2">
                                <h4><a href="{{ route('econews.detail', ['id' => $news->id]) }}" class="news-block-title-link">{{ $news->title }}</a></h4>
                            </div>
                            <div class="news-block-body">
                                <p>{{ Str::limit($news->body, 150) }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- SIDEBAR -->
                <div class="col-lg-4 col-12 mx-auto mt-4 mt-lg-0">

                    <!-- FORM PENCARIAN -->
                    <form class="custom-form search-form mb-4" id="search-form" role="form">
                        <div class="input-group">
                            <input id="search-input" class="form-control" type="search" placeholder="Search" aria-label="Search">
                            <button type="submit" class="btn btn-success">
                                <i class="bi-search"></i>
                            </button>
                        </div>
                    </form>

                    <!-- BERITA TERBARU -->
                    <h5 class="mt-5 mb-3">Recent news</h5>
                    @foreach($recentNews->take(3) as $recent)
                    <div class="news-block news-block-two-col d-flex mt-4">
                        <div class="news-block-two-col-image-wrap">
                            <a href="{{ route('econews.detail', ['id' => $recent->id]) }}">
                                <img src="{{ $recent->image ? asset('storage/' . $recent->image) : 'https://picsum.photos/seed/' . urlencode($recent->title) . '/100/100' }}" class="news-image img-fluid" alt="{{ $recent->title }}" style="width: 100%; height: 100px; object-fit: cover;">
                            </a>
                        </div>
                        <div class="news-block-two-col-info ms-3">
                            <h6><a href="{{ route('econews.detail', ['id' => $recent->id]) }}" class="news-block-title-link">{{ $recent->title }}</a></h6>
                            <p><i class="bi-calendar4 custom-icon me-1"></i>{{ $recent->published_at->format('F d, Y') }}</p>
                        </div>
                    </div>
                    @endforeach

                    <!-- KATEGORI -->
                    <div class="category-block d-flex flex-column mt-4">
                        <h5 class="mb-3">Categories</h5>
                        @foreach($categories as $category)
                        <a href="{{ route('econews.filter.category', ['id' => $category->id]) }}" class="category-block-link {{ isset($selectedCategory) && $selectedCategory->id == $category->id ? 'active' : '' }}">
                            {{ $category->name }} <span class="badge">{{ $category->news_count }}</span>
                        </a>
                        @endforeach
                        @if(isset($selectedCategory))
                        <a href="{{ route('econews') }}" class="category-block-link text-danger mt-2">Clear Categories</a>
                        @endif
                    </div>

                    <!-- TAGS -->
                    <div class="tags-block mt-4">
                        <h5 class="mb-3">Tags</h5>
                        @foreach($tags as $tag)
                        <a href="{{ route('econews.filter.tag', ['id' => $tag->id]) }}" class="tags-block-link {{ isset($selectedTag) && $selectedTag->id == $tag->id ? 'active' : '' }}">
                            {{ $tag->name }}
                        </a>
                        @endforeach
                        @if(isset($selectedTag))
                        <a href="{{ route('econews') }}" class="tags-block-link text-danger mt-2">Clear Tags</a>
                        @endif
                    </div>

                    @if(isset($selectedTag) || isset($selectedCategory))
                    <div class="text-center mt-4">
                        <button onclick="window.location='{{ route('econews') }}'" class="btn btn-outline-danger">
                            Clear All Tags and Categories
                        </button>
                    </div>
                    @endif

                </div>

            </div>
        </div>
    </section>
</main>

<!-- STYLE AGAR ROUNDED SEARCH RAPIH -->
<style>
    #search-form .form-control {
        border-radius: 0.5rem 0 0 0.5rem;
    }

    #search-form .btn {
        border-radius: 0 0.5rem 0.5rem 0;
    }
</style>

<!-- SCRIPT JAVASCRIPT UNTUK PENCARIAN -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const searchForm = document.getElementById('search-form');
    const searchInput = document.getElementById('search-input');
    const newsItems = document.querySelectorAll('.news-item');
    const noResultsMsg = document.getElementById('no-results-message');
    const noResultsText = document.getElementById('no-results-text');

    function performSearch() {
        const searchTerm = searchInput.value.toLowerCase().trim();
        let foundAny = false;

        newsItems.forEach(item => {
            const title = item.querySelector('.news-block-title').textContent.toLowerCase();
            const body = item.querySelector('.news-block-body').textContent.toLowerCase();
            const categories = Array.from(item.querySelectorAll('.news-category-block a')).map(a => a.textContent.toLowerCase());

            if (
                searchTerm === '' ||
                title.includes(searchTerm) ||
                body.includes(searchTerm) ||
                categories.some(cat => cat.includes(searchTerm))
            ) {
                item.style.display = 'block';
                foundAny = true;
            } else {
                item.style.display = 'none';
            }
        });

        if (noResultsMsg && noResultsText) {
            if (!foundAny) {
                noResultsText.textContent = `Kategori atau berita dengan kata kunci "${searchTerm}" belum tersedia.`;
                noResultsMsg.style.display = 'block';
            } else {
                noResultsMsg.style.display = 'none';
            }
        }
    }

    searchForm.addEventListener('submit', function (event) {
        event.preventDefault();
        performSearch();
    });
});
</script>

@endsection
