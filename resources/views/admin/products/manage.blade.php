@extends('admin.master')
@section('title')
    Hostel Manage | Hotel Management System
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
                <h4 class="page-title">Hostel Manage</h4>
            </div>
        </div>
    </div>
    <!-- end row -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="alternative-page-datatable" class="table table-striped dt-responsive nowrap w-100">
                        <thead>
                        <tr>
                            <th>S.N</th>
                            <th>Hostel Name</th>
                            <th>Location</th>
                            <th>Room Availability</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($hostels as $hostel)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$hostel->hostel_name}}</td>
                            <td>{{$hostel->location}}</td>
                            <td>{{$hostel->room_availability}}</td>
                            <td>
                                <img src="{{asset($hostel->image)}}" alt="" style="height: 80px; width: 100px">
                            </td>
                            <td>
                                @if($hostel->status == 1)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">In Active</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{route('hostel.edit', ['id' => $hostel->id])}}" class="btn btn-success btn-sm" title="Edit">
                                    <i class="ri-edit-box-fill"></i>
                                </a>
                                <button type="button" onclick="confirmDelete({{$hostel->id}});" class="btn btn-danger btn-sm" title="Delete">
                                    <i class="ri-chat-delete-fill"></i>
                                </button>

                                <form action="{{route('hostel.delete', ['id' => $hostel->id])}}" method="POST" id="hostelDeleteForm{{$hostel->id}}">
                                    @csrf
                                </form>
                                <script>
                                    function confirmDelete(hostelId) {
                                        var confirmDelete = confirm('Are you sure you want to delete this?');
                                        if (confirmDelete) {
                                            document.getElementById('hostelDeleteForm' + hostelId).submit();
                                        } else {
                                            return false;
                                        }
                                    }
                                </script>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>

@endsection



