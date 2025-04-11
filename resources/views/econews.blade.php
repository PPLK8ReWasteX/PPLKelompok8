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

                <div class="col-lg-7 col-12">
                    @foreach($newsItems as $news)
                    <div class="news-block">
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
                                    <p>
                                        <i class="bi-calendar4 custom-icon me-1"></i>
                                        {{ $news->published_at->format('F d, Y') }}
                                    </p>
                                </div>

                                <div class="news-block-author mx-5">
                                    <p>
                                        <i class="bi-person custom-icon me-1"></i>
                                        By {{ $news->author->name }}
                                    </p>
                                </div>

                                <div class="news-block-comment">
                                    <p>
                                        <i class="bi-chat-left custom-icon me-1"></i>
                                        {{ $news->comments_count ?? 0 }} Comments
                                    </p>
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