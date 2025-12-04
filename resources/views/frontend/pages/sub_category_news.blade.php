@extends('frontend.master')
@section('content')
    <section class="rate__page">
        <div class="container-xl">
            <div class="row mt-3">
                <div class="col-lg-12">
                    <h6 class="h5 text-center news__title__inner-block">Под Категория - {{ $breadcat->title_ru }}</h6>
                </div>
            </div>


        </div>
    </section>
    <hr style="border-bottom:1px solid #78a5ff!important;">

  <div class="container-fluid" style="width: 80%;">
      <div class="row filter d-flex justify-content-center">
                  @forelse($news as $item)
                          <div class="card col-md-2 p-0 m-4" style="border: none !important;">
                              <img class="card-img" src="{{ asset($item->image) }}" alt="Bologna">
                              <h6 class="card-title">
                                  <a href="{{ url('news/details/'.$item->id.'/'.$item->slug) }}" style="color: #000; text-decoration: none; ">{{ $item->title_ru }}</a>
                              </h6>
                              <div class="card-footer text=black d-flex justify-content-between bg-transparent border-top-0">
                                  <div class="views ">
                                      @php
                                          $my_time = strtotime($item->created_at);
                                          $update_date = date('d.m.Y',$my_time);
                                      @endphp
                                      {{ $update_date }}
                                  </div>

                              </div>
                          </div>
                  @empty
              <div class="conversation-text">
                  <div class="ctext-wrap">
                      <p>No posted   </p>
                  </div>
              </div>
                  @endforelse

      </div>
  </div>


    <style>
        .card{
            background-color: #F1F6FE;
        }

        .card-img {
            border-radius: 20px;
            height: 300px ;
        }
    </style>

@endsection
