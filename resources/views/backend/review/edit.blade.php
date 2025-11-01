@extends('admin.admin_dashboard')
@section('heading', 'Video Create')

@section('admin')

    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="d-flex justify-content-between">
               <div> <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">   Edit Video</span> </h4></div>
                <div ><h5><a href="{{ route('all.video') }}">Back </a></h5></div>
            </div>


            <form method="POST" action="{{ route('update.video') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $video->id }}">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-4">
                            <h5 class="card-header">Video </h5>

                            <hr class="my-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3 ">
                                            <label for="title_ru" class="form-label">Заголовок RU</label>
                                            <input type="text" id="title_ru" class="form-control" name="title_ru" value="{{  $video->title_ru }}">
                                        </div>

                                        <div class="form-group mb-3 ">
                                            <label for="title_tj" class="form-label">Заголовок TJ</label>
                                            <input type="text" id="title_tj" class="form-control" name="title_tj" value="{{  $video->title_tj }}">
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="title_en" class="form-label">Заголовок EN</label>
                                            <input type="text" id="title_en" class="form-control" name="title_en" value="{{  $video->title_en }}">
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="video_url" class="form-label">Video URL *</label>
                                            <input class="form-control" type="text" id="video_url" name="video_url"  autofocus="" value="{{  $video->video_url }}">
                                        </div>

                                        <div class="mb-3 ">
                                            <label for="caption" class="form-label">Caption *</label>
                                            <input class="form-control" type="file" id="caption" name="caption"  autofocus="" value="{{  $video->caption }}">
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="showImage" class="form-label"></label>
                                            <img src="{{ asset($video->caption) }}"  class="rounded-circle avatar-lg img-thumbnail" alt="profile-image" id="showImage">
                                        </div>

                                    </div>
                                    <div class="col-md-6 form-group mb-3">

                                        <label for="status" class="form-label">Status</label>
                                        <select class="form-select" name="status" aria-invalid="false" >
                                            <option value="Yes" @if($video->status == 'Yes')  selected @endif>Yes</option>
                                            <option value="NO" @if($video->status == 'NO')  selected @endif >NO</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3 ">
                                            <label for="position" class="form-label">Position</label>
                                            <input class="form-control" type="text" id="position" name="position" autofocus="" value="{{  $video->position }}">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>


                </div>
                <div class="mt-2">
                    <button type="submit" class="btn btn-primary me-2">Update</button>
                </div>
            </form>
        </div>
    </div>


@endsection
