<?php
$banner = Banner::getAll();
?>
@if ($banner->count() > 0)
<div class="slider-container">
    <div class="slider-container-row section" id="slider-posts">
        <div class="widget PopularPosts">
            <div class="widget-content">
                <div class="container">
                    <div class="row slider-width">
                        <div class="col-12 fbt-shape-container">
                            <div class="carousel slide carousel-fade card shadow-lg radius-10" data-interval="7500" data-ride="carousel"
                                id="carouselPopularPosts">
                                <div class="carousel-inner">
                                    @foreach ($banner as $row)
                                    <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                        <div class="post">
                                            <div class="post-content">
                                                <div class="fbt-item-thumbnail clearfix">
                                                    <a href="#">
                                                        <img alt="Banner Image" class="post-thumbnail" src="{{ Storage::url($row->image) }}">
                                                    </a>
                                                </div>
                                                <div class="card-img-overlay p-0">
                                                    <div class="row align-items-center justify-content-center">
                                                        <div class="col-xl-6 col-9 fbt-title-left">
                                                            <div class="fbt-shape-title fbt-title-caption p-5">
                                                                <h3 class="post-title display-4">
                                                                    <a class="text-white" href="#">
                                                                        {{ $row->title }}
                                                                    </a>
                                                                </h3>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-1 fbt-title-right"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach

                                </div>

                                <a class="carousel-control-prev" data-slide="prev" href="#carouselPopularPosts" role="button">
                                    <span aria-hidden="true" class="carousel-control-prev-icon"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" data-slide="next" href="#carouselPopularPosts" role="button">
                                    <span aria-hidden="true" class="carousel-control-next-icon"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                                <ol class="carousel-indicators">
                                    @foreach ($banner as $row)
                                    <li data-target="#carouselPopularPosts" data-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}"></li>
                                    @endforeach
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!-- .slider-container end-->
@endif