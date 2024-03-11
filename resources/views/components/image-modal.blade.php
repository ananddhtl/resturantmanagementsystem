<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalLabel">Choose a image</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row g-2">
                    @foreach ($all_images as $image)
                        <div class="col-lg-2 col-md-3 col-sm-4" onclick="selectImage('{{ $image->file_name }}')">
                            <img src="{{ asset('uploads/' . $image->file_name) }}" alt="{{ $image->file_title }}"
                                class="w-100" style="height: 150px; object-fit: cover;">
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                    id="modal-close-btn">Close</button>
            </div>
        </div>
    </div>
</div>
