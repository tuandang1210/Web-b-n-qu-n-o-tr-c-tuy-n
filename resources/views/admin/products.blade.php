@extends('admin.layout')

@section('content')


<h4>Products Management</h4>

<form method="GET" class="mb-3 d-flex" style="max-width:400px;">
    <input type="text" name="search_product" class="form-control me-2"
           placeholder="Tìm kiếm theo tên hoặc hãng"
           value="{{ request('search_product_admin') }}">
    <button type="submit" class="btn btn-primary">Search</button>
</form>

<button class="btn btn-success mb-3" data-bs-toggle="modal" 
data-bs-target="#addProductModal" enctype="multipart/form-data">
    Add New Product
</button>


<table class="table table-bordered">
    <thead class="table-dark">
        <tr>
            <th>Name</th><th>Brand</th><th>Price</th><th>Image</th><th>Action</th>
        </tr>
    </thead>

    <tbody>
        @foreach($products as $p)
        <tr>
            <td>{{ $p->name }}</td>
            <td>{{ $p->brand }}</td>
            <td>{{ $p->price }}$</td>
            <td>
                <img src="{{ asset($p->image) }}" width="80" class="mt-2">

            </td>
            <td>
                <form method="POST" action="{{ route('admin.products.delete', $p->product_id) }}">
                     {{ csrf_field() }} 
                    <button class="btn btn-danger btn-sm" onclick="return confirm('Xóa?')">
                        Delete
                    </button>
                </form>

                <button class="btn btn-success mb-3" data-bs-toggle="modal" 
                data-bs-target="#editProductModal{{ $p->product_id }}" 
                enctype="multipart/form-data">
                    Edit
                </button>
            </td>
          
        </tr>
        @endforeach
    </tbody>
</table>

@include('admin.modals.add_product')
  @include('admin.modals.edit_product')
@endsection
