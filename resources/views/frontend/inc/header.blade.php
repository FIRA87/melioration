@php 
    $siteSettings = App\Models\Setting::find(1); 
    $pagesNew = App\Models\Page::where('status', '1')->get();
@endphp

 <header class="header-section ">
        <div class="container">
            <div class="row">
                 <div class="col-12">
                    <nav class="navbar navbar-expand-xl nav-shadow" id="#navbar">
                        <a class="navbar-brand" href="/">

                            @if (session()->get('lang') == 'ru')
                             <img src="{{ asset('frontend/logo_ru.png') }}" class="logo" alt="logo" width="160">
                            @elseif(session()->get('lang') == 'en')
                             <img src="{{ asset('frontend/logo_en.png') }}" class="logo" alt="logo" width="160">
                            @else
                             <img src="{{ asset('frontend/logo_tj.png') }}" class="logo" alt="logo" width="160">
                             @endif    
                           

                        </a>
                        <a class="navbar-toggler" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                            <i class="bi bi-list"></i>
                        </a>

                        <div class="collapse navbar-collapse ms-auto " id="navbar-content">
                            <div class="main-menu">
                                <ul class="navbar-nav mb-lg-0 mx-auto">
                                       <li class="nav-item dropdown">                                       
                                          @if (session()->get('lang') == 'ru')
                                                <a href="{{ url('/') }}" class="nav-link nav-link">Главная</a>
                                            @elseif(session()->get('lang') == 'en')
                                                <a href="{{ url('/') }}" class="nav-link nav-link">Main</a>
                                            @else
                                                <a href="{{ url('/') }}" class="nnav-link nav-link">Асосӣ</a>
                                            @endif 
                                        </li>  
                                        @foreach ($pagesNew as $page)                                    
                                          <li class="nav-item dropdown">                                       
                                                <a class="nav-link " href="/page/{{ $page->url . '/' . $page->id }}">                                       
                                                    @if(session()->get('lang') == 'ru') 
                                                        {{ $page->title_ru }}
                                                        @elseif(session()->get('lang') == 'en') 
                                                            {{ $page->title_en }}
                                                        @else 
                                                        {{ $page->title_tj }}
                                                    @endif
                                                </a>
                                         </li> 
                                        @endforeach   
                                   </ul>
                                <div class="nav-right d-none d-xl-block">
                                    <div class="nav-right__search">
                                        <a href="javascript:void(0)" class="nav-right__search-icon btn_theme icon_box btn_bg_white"> <i class="bi bi-search"></i> <span></span> </a>    
                                         <a class="nav-link btn btn-sm" href="{{ route('tj.lang') }}" style="color: #fff;">Тоҷ</a>&nbsp;
                                         <a class="nav-link btn btn-sm" href="{{ route('ru.lang') }}" style="color: #fff;">Рус</a>&nbsp;
                                         <a class="nav-link btn btn-sm" href="{{ route('en.lang') }}" style="color: #fff;">Eng</a>&nbsp;
        
                                    </div>
                                    <div class="nav-right__search-inner">
                                        <div class="nav-search-inner__form">
                                          <form method="POST" id="search" class="inner__form" action="{{ route('news.search') }}">
                                             @csrf                                            
                                                 <div class="input-group">
                                                   @if (session()->get('lang') == 'ru')
                                                        <input type="text" class="form-control" placeholder="Поиск" name="search" required>
                                                    @elseif(session()->get('lang') == 'en')
                                                        <input type="text" class="form-control" placeholder="Search" name="search" required>
                                                    @else
                                                        <input type="text" class="form-control " placeholder="Ҷустуҷӯ" name="search" required>
                                                    @endif
                                                       <button type="submit" class="search_icon"><i class="bi bi-search"></i></button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>



                                </div>
                            </div>
                        </div>
                    </nav>
                </div>

            </div>
        </div>
    </header>

    <!-- Offcanvas More info-->
    <div class="offcanvas offcanvas-end " tabindex="-1" id="offcanvasRight">
        <div class="offcanvas-body custom-nevbar">
            <div class="row">
                <div class="col-md-7 col-xl-8">
                    <div class="custom-nevbar__left">
                        <button type="button" class="close-icon d-md-none ms-auto" data-bs-dismiss="offcanvas" aria-label="Close"><i class="bi bi-x"></i></button>
                        <ul class="custom-nevbar__nav mb-lg-0">
                            <li class="nav-item dropdown">                                       
                               @if (session()->get('lang') == 'ru')
                                    <a href="{{ url('/') }}" class="nav-link nav-link">Главная</a>
                                @elseif(session()->get('lang') == 'en')
                                    <a href="{{ url('/') }}" class="nav-linknav-link">Main</a>
                                @else
                                    <a href="{{ url('/') }}" class="nnav-link nav-link">Асосӣ</a>
                                @endif
                                   
                               
                            </li> 
                            @foreach ($pagesNew as $page)                                    
                              <li class="nav-item dropdown">                                       
                                <a class="nav-link " href="/page/{{ $page->url . '/' . $page->id }}">                                       
                                    @if(session()->get('lang') == 'ru') 
                                        {{ $page->title_ru }}
                                        @elseif(session()->get('lang') == 'en') 
                                            {{ $page->title_en }}
                                        @else 
                                        {{ $page->title_tj }}
                                    @endif
                                </a>
                             </li> 
                              @endforeach   
                                  
                        </ul>
                    </div>
                </div>
                <div class="col-md-5 col-xl-4">
                    <div class="custom-nevbar__right">
                        <div class="custom-nevbar__top d-none d-md-block">
                            <button type="button" class="close-icon ms-auto" data-bs-dismiss="offcanvas" aria-label="Close"><i class="bi bi-x"></i></button>
                            <div class="custom-nevbar__right-thumb mb-auto">
                                <img src="{{ asset('frontend/assets/images/logo.png') }}" alt="logo">
                            </div>
                        </div>
                        <ul class="custom-nevbar__right-location">
                            <li>
                                <p class="mb-2">Phone: </p>
                                <a href="tel:+123456789" class="fs-4 contact">{{ $siteSettings->phone }}</a>
                            </li>
                            <li class="location">
                                <p class="mb-2">Email: </p>
                                <a href="mailto:Info@gmail.com" class="fs-4 contact">{{ $siteSettings->email }} </a>
                            </li>
                            <li class="location">
                                <p class="mb-2">Location: </p>
                                <p class="fs-4 contact">  
                                 @if (session()->get('lang') == 'ru')
                                            {{ $siteSettings->street_ru }} &nbsp;
                                        @elseif(session()->get('lang') == 'en')
                                            {{ $siteSettings->street_en }} &nbsp;
                                        @else
                                            {{ $siteSettings->street_tj }} &nbsp;
                                        @endif
                                    </p>
                            </li>
                        </ul>
                        <ul class="d-flex justify-content-around"> 
                            <li> <a class="nav-link btn btn-sm" href="{{ route('tj.lang') }}" style="color: #fff;">Тоҷ</a>&nbsp;  </li>
                            <li>  <a class="nav-link btn btn-sm" href="{{ route('ru.lang') }}" style="color: #fff;">Рус</a>&nbsp; </li>
                            <li> <a class="nav-link btn btn-sm" href="{{ route('en.lang') }}" style="color: #fff;">Eng</a>&nbsp;</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

</header>