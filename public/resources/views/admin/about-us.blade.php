@extends('layouts')

@section('content')
<div class="page-inner">
    <!-- Page Header with Breadcrumb -->
    <div class="d-flex justify-content-between align-items-center py-3 flex-wrap border-bottom mb-4">
        <div class="d-flex align-items-center">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">Settings</li>
                    <li class="breadcrumb-item active" aria-current="page">About Us</li>
                </ol>
            </nav>
        </div>
        <div class="d-flex gap-2">
            <button class="btn btn-outline-secondary" onclick="showNotif()">
                <i class="fa fa-eye me-2"></i> Preview
            </button>
            <button class="btn btn-sta" onclick="showNotif()">
                <i class="fa fa-save me-2"></i> Save Changes
            </button>
        </div>
    </div>

    <div class="row">
        <!-- Main Content Column -->
        <div class="col-lg-8">
            <!-- Page Information Section -->
            <div class="card shadow-sm rounded-3 mb-4">
                <div class="card-header bg-custom-navy border-bottom py-3">
                    <h5 class="mb-0 fw-semibold text-white">Page Information</h5>
                </div>
                <div class="card-body p-4">
                    <div class="mb-3">
                        <label for="about-title" class="form-label fw-medium">Title</label>
                        <input type="text" class="form-control" placeholder="Enter Page Title">
                    </div>
                    <div class="mb-0">
                        <label for="page-slug" class="form-label fw-medium">URL Slug</label>
                        <div class="input-group">
                            <span class="input-group-text">{{ url('/') }}/</span>
                            <input type="text" class="form-control" placeholder="">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Page Content Section -->
            <div class="card shadow-sm rounded-3 mb-4">
                <div class="card-header bg-white border-bottom py-3 bg-custom-navy">
                    <h5 class="mb-0 fw-semibold text-white">Page Content</h5>
                </div>
                <div class="card-body p-0">
                    <!-- Quill Toolbar Section-->
                    <div id="quill-toolbar" class="ql-toolbar ql-snow px-3 py-2 rounded-top border-bottom bg-light d-flex flex-wrap gap-2 sticky-top" style="z-index: 1;">
                        <span class="ql-formats">
                            <select class="ql-header" title="Heading">
                                <option value="1">Heading 1</option>
                                <option value="2">Heading 2</option>
                                <option value="3">Heading 3</option>
                                <option value="4">Heading 4</option>
                                <option value="5">Heading 5</option>
                                <option value="6">Heading 6</option>
                                <option value="" selected>Paragraph</option>
                            </select>
                        </span>
                        <span class="ql-formats">
                            <button class="ql-bold" title="Bold"></button>
                            <button class="ql-italic" title="Italic"></button>
                            <button class="ql-underline" title="Underline"></button>
                            <button class="ql-strike" title="Strikethrough"></button>
                        </span>
                        <span class="ql-formats">
                            <button class="ql-list" value="ordered" title="Ordered List"></button>
                            <button class="ql-list" value="bullet" title="Bullet List"></button>
                            <button class="ql-indent" value="-1" title="Outdent"></button>
                            <button class="ql-indent" value="+1" title="Indent"></button>
                        </span>
                        <span class="ql-formats">
                            <button class="ql-link" title="Insert Link"></button>
                            <button class="ql-image" title="Insert Image"></button>
                            <button class="ql-video" title="Insert Video"></button>
                        </span>
                        <span class="ql-formats">
                            <select class="ql-color" title="Text Color"></select>
                            <select class="ql-background" title="Background Color"></select>
                        </span>
                        <span class="ql-formats">
                            <button class="ql-align" value="" title="Align Left"></button>
                            <button class="ql-align" value="center" title="Align Center"></button>
                            <button class="ql-align" value="right" title="Align Right"></button>
                            <button class="ql-align" value="justify" title="Justify"></button>
                        </span>
                        <span class="ql-formats">
                            <button class="ql-clean" title="Clear Formatting"></button>
                        </span>
                        <span class="ql-formats ms-auto d-flex gap-1">
                            <button id="undo-btn" class="btn btn-sm btn-light border" title="Undo">
                                <i class="fas fa-undo"></i>
                            </button>
                            <button id="redo-btn" class="btn btn-sm btn-light border" title="Redo">
                                <i class="fas fa-redo"></i>
                            </button>
                        </span>
                    </div>

                    <!-- Quill Editor -->
                    <div id="quill-editor" class="border-0 p-4" style="min-height: 350px;">
                    </div>
                    <hr class="my-0">
                    <div class="d-flex justify-content-between align-items-center p-4">
                        <span class="text-muted">Word Count: <span id="word-count">0</span> words</span>
                        <span class="text-muted">Character Count: <span id="character-count">0</span> characters</span>
                    </div>
                </div>
            </div>

            <!-- SEO Settings -->
            <div class="card shadow-sm rounded-3 mb-4">
                <div class="card-header bg-white border-bottom py-3 bg-custom-navy">
                    <h5 class="mb-0 fw-semibold text-white">SEO Settings</h5>
                </div>
                <div class="card-body p-4">
                    <div class="mb-3">
                        <label for="meta-title" class="form-label fw-medium">Meta Title</label>
                        <input type="text" class="form-control" placeholder="Enter meta title">
                    </div>
                    <div class="mb-3">
                        <label for="meta-description" class="form-label fw-medium">Meta Description</label>
                        <textarea class="form-control" rows="3" placeholder="Enter meta description"></textarea>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar Column -->
        <div class="col-lg-4">
            <!-- Publish Card -->
            <div class="card shadow-sm rounded-3 mb-4">
                <div class="card-header bg-white border-bottom py-3 bg-custom-navy">
                    <h5 class="mb-0 fw-semibold text-white">Publish</h5>
                </div>
                <div class="card-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-medium">Visibility</label>
                        <select class="form-select">
                            <option value="public" selected>Public</option>
                            <option value="private">Private</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-medium">Publish Date</label>
                        <input class="form-control" type="datetime-local" >
                    </div>
                </div>
            </div>

            <!-- Featured Image Card -->
            <div class="card shadow-sm rounded-3 mb-4">
                <div class="card-header bg-white border-bottom py-3 bg-custom-navy">
                    <h5 class="mb-0 fw-semibold text-white">Featured Image</h5>
                </div>
                <div class="card-body p-4">
                    <div class="border-dashed rounded-3 p-4 text-center bg-light mb-3" style="cursor: pointer;" onclick="openFileInput()">
                        <div id="featured-image-placeholder">
                            <i class="far fa-image fa-3x text-muted mb-3"></i>
                            <p class="mb-1 text-muted">Click to upload featured image</p>
                        </div>
                        <img src="" class="img-fluid rounded d-none" alt="Featured image preview" id="image-preview">
                        <input type="file" class="d-none" accept="image/*" id="image-input" onchange="previewImage(event)">
                    </div>
                    <div class="mb-3 d-flex justify-content-center">
                        <button class="btn btn-sm btn-outline-danger d-none" id="remove-btn" onclick="removeImage()">Remove Image</button>
                    </div>
                    <div class="mb-3">
                        <label for="image-alt-text" class="form-label fw-medium">Alt Text</label>
                        <input type="text" class="form-control" placeholder="Describe the image for accessibility">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script>
    function showNotif(){
        swal({
            title: "Work in progress",
            text: "This feature is not available yet",
            type: "info",
        });
    }
    function openFileInput(){
        document.getElementById("image-input").click();
    }
    function previewImage(event){
        var reader = new FileReader();
        reader.onload = function(){
            var image = document.getElementById("image-preview");
            image.src = reader.result;
            image.classList.remove('d-none');
            document.getElementById("remove-btn").classList.remove('d-none');
            document.getElementById("featured-image-placeholder").classList.add('d-none');
        };
        reader.readAsDataURL(event.target.files[0]);
    }
    function removeImage(){
        var image = document.getElementById("image-preview");
        image.src = "";
        image.classList.add('d-none');
        document.getElementById("image-input").value = "";
        document.getElementById("remove-btn").classList.add('d-none');
        document.getElementById("featured-image-placeholder").classList.remove('d-none');
    }
    document.addEventListener('DOMContentLoaded', function() {
        var quillEditor = document.getElementById('quill-editor');
        quillEditor.addEventListener('input', updateCounts);

        function updateCounts() {
            var text = quillEditor.innerText || '';
            var words = text.trim().split(/\s+/).filter(Boolean);
            var wordCount = words.length;
            var characterCount = text.length;
            document.getElementById('word-count').innerText = wordCount;
            document.getElementById('character-count').innerText = characterCount;
        }
    });
</script>

