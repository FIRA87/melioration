@extends('admin.admin_dashboard')
@section('heading', 'Video Create')

@section('admin')

    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Add Video</span> </h4>
            <form method="POST" action="{{ route('store.video') }}" enctype="multipart/form-data">
                @csrf
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
                                           <input type="text" id="title_ru" class="form-control" name="title_ru">
                                       </div>

                                       <div class="form-group mb-3 ">
                                           <label for="title_tj" class="form-label">Заголовок TJ</label>
                                           <input type="text" id="title_tj" class="form-control" name="title_tj">
                                       </div>

                                       <div class="form-group mb-3">
                                           <label for="title_en" class="form-label">Заголовок EN</label>
                                           <input type="text" id="title_en" class="form-control" name="title_en">
                                       </div>
                                   </div>

                                  <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="video_url" class="form-label">Video URL *</label>
                                        <input class="form-control" type="text" id="video_url" name="video_url"  autofocus="">
                                    </div>

                                    <div class="mb-3 ">
                                        <label for="caption" class="form-label">Caption *</label>
                                        <input class="form-control" type="file" id="caption" name="caption"  autofocus="">
                                    </div>

                                    <div class="mb-3 ">
                                        <label for="position" class="form-label">Position</label>
                                        <input class="form-control" type="text" id="position" name="position" autofocus="">
                                    </div>

                                </div>
                                  <div class="col-md-12">
                                       <div class="form-group mb-3">
                                           <label for="status" class="form-label">Status</label>
                                           <select class="form-select"  name="status" aria-invalid="false" style="display: block">
                                               <option value="Yes" selected>Yes</option>
                                               <option value="No" >No</option>

                                           </select>
                                       </div>
                                   </div>
                                </div>
                            </div>

                        </div>
                    </div>


                </div>
                <div class="mt-2">
                    <button type="submit" class="btn btn-primary me-2">Save</button>
                </div>
            </form>
        </div>
    </div>


@endsection
