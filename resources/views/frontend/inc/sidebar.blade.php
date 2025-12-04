<!-- Search Form Start -->
<div class="mb-5 wow slideInUp" data-wow-delay="0.1s">
    <div class="input-group">
        <input type="text" class="form-control p-3" placeholder="">
        <button class="btn px-4" style="background: linear-gradient(90deg,#01b4ee,#28348a); color: #fff"><i class="bi bi-search"></i></button>
    </div>
</div>
<!-- Search Form End -->

<div class="widget wow slideInUp">
    <div class="news">
        <div class="news-heading">
            <h4> 
						 @if(session()->get('lang') == 'ru') 
									Новости
							@elseif(session()->get('lang') == 'en') 
									News
							 @else 
									Ахбор
							 @endif
						</h4>
        </div>
        <hr>
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home"
                    type="button" role="tab" aria-controls="pills-home" aria-selected="true">
										 @if(session()->get('lang') == 'ru') 
											Последние
										 @elseif(session()->get('lang') == 'en') 
											Latest
										 @else 
											Охирин
										 @endif
										
										</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile"
                    type="button" role="tab" aria-controls="pills-profile"
                    aria-selected="false">
										@if(session()->get('lang') == 'ru') 
											Популярные
										 @elseif(session()->get('lang') == 'en') 
											Popular
										@else 
											Машҳур
										@endif
										</button>
            </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                @foreach ($latestNews as $news)
                    <div class="card mb-3" style="max-width: 540px; border: 0px solid rgba(0,0,0,0.125);">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <a href="{{ url('news/details/' . $news->id . '/' . $news->slug) }}"> <img
                                        src="{{ asset($news->image) }}" alt="{{ $news->title_ru }}"
                                        class="img-fluid rounded-start" style="height: 100%" /></a>
                            </div>
                            <div class="col-md-8">
                                <div class="card-body " style="padding: 0rem 1rem;">
                                    <h6 class="card-title">
                                        <a href="{{ url('news/details/' . $news->id . '/' . $news->slug) }}"
                                            style="color: #000">
                                            @if (session()->get('lang') == 'ru')
                                                {{ $news->title_ru }}
                                            @elseif(session()->get('lang') == 'en')
                                                {{ $news->title_en }}
                                            @else
                                                {{ $news->title_tj }}
                                            @endif
                                            <a />
                                            </h5>
                                            <p class="card-text">
                                                <small class="text-muted"> @php
                                                    $my_time = strtotime($news->post_date);
                                                    $update_date = date('d.m.Y', $my_time);
                                                @endphp
                                                    {{ $update_date }} </small>
                                            </p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach





            </div>
            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                @foreach ($popularNews as $news)
                    <div class="card mb-3" style="max-width: 540px; border: 0px solid rgba(0,0,0,0.125);">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <a href="{{ url('news/details/' . $news->id . '/' . $news->slug) }}"> <img
                                        src="{{ asset($news->image) }}" alt="{{ $news->title_ru }}"
                                        class="img-fluid rounded-start" style="height: 100%" /></a>
                            </div>
                            <div class="col-md-8">
                                <div class="card-body " style="padding: 0rem 1rem;">
                                    <h6 class="card-title">
                                        <a href="{{ url('news/details/' . $news->id . '/' . $news->slug) }}"
                                            style="color: #000">
                                            @if (session()->get('lang') == 'ru')
                                                {{ $news->title_ru }}
                                            @elseif(session()->get('lang') == 'en')
                                                {{ $news->title_en }}
                                            @else
                                                {{ $news->title_tj }}
                                            @endif
                                            <a />
                                            </h5>
                                            <p class="card-text">
                                                <small class="text-muted"> @php
                                                    $my_time = strtotime($news->post_date);
                                                    $update_date = date('d.m.Y', $my_time);
                                                @endphp
                                                    {{ $update_date }} </small>
                                            </p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach


            </div>
        </div>
    </div>
</div>
<hr>
<br>
<!-- Category Start -->

@php
    $categories = App\Models\Category::orderBy('id', 'ASC')
        ->limit(7)
        ->get();
@endphp


<div class="mb-5 wow slideInUp" data-wow-delay="0.1s">
    <div class="section-title section-title-sm position-relative pb-3 mb-4">
        <h3 class="mb-0">
				  @if (session()->get('lang') == 'ru')
						Категории
					@elseif(session()->get('lang') == 'en')
						Categories
					@else
						Категорияҳо
					@endif
		</h3>
    </div>
		<hr>
    <div class="link-animated d-flex flex-column justify-content-start">
        @foreach ($categories as $key => $category)
            <a class="h5 fw-semi-bold rounded py-2 px-3 mb-2"
                href="{{ url('news/category/' . $category->id . '/' . $category->category_slug) }}">
                <i class="bi bi-arrow-right me-2"></i>
                @if (session()->get('lang') == 'ru')
                    {{ $category->title_ru }}
                @elseif(session()->get('lang') == 'en')
                    {{ $category->title_en }}
                @else
                    {{ $category->title_tj }}
                @endif
            </a>
            @php
                $subcategories = App\Models\Subcategory::where('category_id', $category->id)
                    ->where('active', 'YES')
                    ->orderBy('title_ru', 'ASC')
                    ->get();
            @endphp
            <ul>
                @foreach ($subcategories as $subcat)
                    <li><a
                            href="{{ url('news/subcategory/' . $subcat->id . '/' . $subcat->sub_category_slug) }}">{{ $subcat->title_ru }}</a>
                    </li>
                @endforeach
            </ul>
        @endforeach
    </div>
</div>
<!-- Category End -->
