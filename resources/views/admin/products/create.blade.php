@extends('admin.master')

@section('title')
    Product Create | Laravel pos
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
                <h4 class="page-title">Product Create</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('product.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <label  class="col-md-2 col-form-label">Product Name</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Product Name"/>
                                @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label  class="col-md-2 col-form-label">Product SKU</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control @error('sku') is-invalid @enderror" value="{{$sku}}" name="sku" placeholder="Product SKU"/>
                                @error('sku')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label  class="col-md-2 col-form-label">Product Unit</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control @error('unit') is-invalid @enderror" name="unit" placeholder="Product Unit (Ex. - kg, litter, pieces)"/>
                                @error('unit')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label  class="col-md-2 col-form-label">Product Unit Value</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control @error('unit_value') is-invalid @enderror" name="unit_value" placeholder="Product Unit Value (Ex. - 1kg, 3litters, 5pieces)"/>
                                @error('unit_value')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label  class="col-md-2 col-form-label">Selling Price</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control @error('selling_price') is-invalid @enderror" name="selling_price" placeholder="Selling Price"/>
                                @error('selling_price')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label  class="col-md-2 col-form-label">Purchase Price</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control @error('purchase_price') is-invalid @enderror" name="purchase_price" placeholder="Purchase Price"/>
                                @error('purchase_price')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label  class="col-md-2 col-form-label">Discount (%)</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control @error('discount') is-invalid @enderror" name="discount" placeholder="Discount (%)"/>
                                @error('discount')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label  class="col-md-2 col-form-label">Tax (%)</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control @error('tax') is-invalid @enderror" name="tax" placeholder="Tax (%)"/>
                                @error('tax')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-md-2 col-form-label">Image</label>
                            <div class="col-md-10">
                                <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" accept="image/*"/>
                                @error('image')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-md-2 col-form-label"></label>
                            <div class="col-md-10">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->
@endsection
