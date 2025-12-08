@foreach($products as $p)
<div class="modal fade" id="editProductModal{{ $p->product_id }}" tabindex="-1">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('admin.products.update', $p->product_id) }}" class="modal-content" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="modal-header">
                <h5 class="modal-title">Edit Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" value="{{ $p->name }}" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Brand</label>
                    <input type="text" name="brand" value="{{ $p->brand }}" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Price</label>
                    <input type="number" name="price" value="{{ $p->price }}" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Image</label>
                    <input type="file" name="image" class="form-control image-input">
                    <img src="{{ asset($p->image) }}" class="image-preview mt-2" width="80">

                </div>
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control">{{ $p->description }}</textarea>
                </div>
            </div>
            <div class="modal-footer">  
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </form>
    </div>
</div>
@endforeach
