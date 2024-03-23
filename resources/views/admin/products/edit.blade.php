@extends('admin.master')
@section('title')
    Hostel Edit | Hotel Management System
@endsection

@section('body')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <form class="d-flex">
                        <div class="input-group">
                            <input type="text" class="form-control form-control-light" id="dash-daterange">
                            <span class="input-group-text bg-primary border-primary text-white">
                                                    <i class="mdi mdi-calendar-range font-13"></i>
                                                </span>
                        </div>
                        <a href="javascript: void(0);" class="btn btn-primary ms-2">
                            <i class="mdi mdi-autorenew"></i>
                        </a>
                        <a href="javascript: void(0);" class="btn btn-primary ms-1">
                            <i class="mdi mdi-filter-variant"></i>
                        </a>
                    </form>
                </div>
                <h4 class="page-title">Hostel Edit</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane show active" id="basic-form-preview">
                            <form action="{{route('hostel.update', ['id' => $hostel->id])}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-3">
                                    <label  class="col-md-2 col-form-label">Hostel Name</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control @error('hostel_name') is-invalid @enderror" value="{{$hostel->hostel_name}}" name="hostel_name" id="inputEmail3" placeholder="Enter Hostel Name"/>
                                        @error('hostel_name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-md-2 col-form-label">Hostel Location</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control @error('location') is-invalid @enderror" value="{{$hostel->location}}" name="location" id="inputEmail3" placeholder="Enter Hostel Location"/>
                                        @error('location')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-md-2 col-form-label">Single Room Quantity</label>
                                    <div class="col-md-10">
                                        <input type="number" class="form-control @error('single_room') is-invalid @enderror" value="{{$hostel->single_room}}" name="single_room" id="inputEmail3" placeholder="Enter Single Room Quantity"/>
                                        @error('single_room')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-md-2 col-form-label">Double Room Quantity</label>
                                    <div class="col-md-10">
                                        <input type="number" class="form-control @error('double_room') is-invalid @enderror" value="{{$hostel->double_room}}" name="double_room" id="inputEmail3" placeholder="Enter Double Room Quantity"/>
                                        @error('double_room')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-md-2 col-form-label">Description</label>
                                    <div class="col-md-10">
                                        <textarea type="text" name="description" id="summernote" class="form-control @error('description') is-invalid @enderror" placeholder="Enter Hostel Description" required>{{$hostel->description}}</textarea>
                                        @error('description')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label  class="col-md-2 col-form-label">Image</label>
                                    <div class="col-md-10">
                                        <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" id="inputEmail3" placeholder="Text Musk"/>
                                        <img src="{{asset($hostel->image)}}" class="mt-2" alt="" style="height: 100px;">
                                        @error('image')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputEmail3" class="col-2 col-form-label">Status</label>
                                    <div class="col-10">
                                        {{--                                        <input type="checkbox" id="switch1" name="status" @if($notice->status == 1) checked @endif data-switch="bool"/>--}}
                                        <input type="checkbox" id="switch1" class="form-control" value="1" @if($hostel->status == 1) checked @endif name="status" data-switch="bool"/>
                                        <label for="switch1" data-on-label="On" data-off-label="Off"></label>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputEmail3" class="col-2 col-form-label"></label>
                                    <div class="col-10">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div> <!-- end preview-->
                    </div> <!-- end tab-content-->

                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->

    <script>
        $('#summernote').summernote({
            tabsize: 2,
            height: 300
        });
    </script>

@endsection



