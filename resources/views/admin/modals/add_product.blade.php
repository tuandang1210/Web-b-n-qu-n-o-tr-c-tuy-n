<div class="modal fade" id="addProductModal">
  <div class="modal-dialog">
    <form method="POST" action="{{ route('admin.products.add') }}" class="modal-content">
      @csrf
      <div class="modal-header"><h5>Add New Product</h5></div>
      <div class="modal-body">

        <div class="mb-2">
          <label>Name</label>
          <input name="name" class="form-control" required>
        </div>

        <div class="mb-2">
          <label>Brand</label>
          <input name="brand" class="form-control" required>
        </div>

        <div class="mb-2">
          <label>Price</label>
          <input type="number" name="price" class="form-control" required>
        </div>

        <div class="mb-2">
            <label class="form-label">Image</label>
            <input type="file" name="image" class="form-control" id="imageInput">
            @if(isset($p) && $p->image)
                <img src="{{ asset($p->image) }}" width="80" class="mt-2" id="imagePreview">
            @else
                <img src="" width="80" class="mt-2" id="imagePreview" style="display:none;">
            @endif
        </div>

        <div class="mb-2">
          <label>Description</label>
          <textarea name="description" class="form-control"></textarea>
        </div>

      </div>

      <div class="modal-footer">
        <button class="btn btn-success">Add</button>
      </div>

    </form>
  </div>
</div>


