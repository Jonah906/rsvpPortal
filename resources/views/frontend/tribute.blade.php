@extends('frontend.layouts.app')

@section('content')
    <section class="services-section">
        <h2 style="text-align: center; text-decoration: underline; margin-bottom: 20px;">TRIBUTE</h2>

        <form id="frmtribute" method="POST">
            @csrf
            <div style="max-width: 700px; margin: auto;">
                <!-- Name Field -->
                <label for="name" style="display: block; margin-bottom: 5px; font-weight: bold;">Name:<span style="color:red">*</span></label>
                <input type="text" id="name" name="name" required placeholder="Enter your Name"
                       style="width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 5px;">

                <!-- Title Field -->
                <label for="title" style="display: block; margin-bottom: 5px; font-weight: bold;">Tribute Title:</label>
                <input type="text" id="title" name="title" placeholder="Tribute title (Optional)"
                       style="width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 5px;">

                <!-- Hidden input to store editor content -->
                <input type="hidden" name="tribute_content" id="tribute_content">

                <!-- Rich Text Editor -->
                <div id="editor" style="height: 200px; border: 1px solid #ccc; padding: 10px; border-radius: 5px;"></div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary"
                        style="display: block; margin: 20px auto; padding: 10px 20px; font-size: 16px; cursor: pointer;">
                    Submit Tribute
                </button>
            </div>
        </form>
    </section>
@endsection

@section('scripts')
    <!-- Quill JS & CSS -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        var quill = new Quill('#editor', {
            theme: 'snow',
            modules: {
                toolbar: [
                    [{'header': [1, 2, false]}],
                    ['bold', 'italic', 'underline'],
                    [{'list': 'ordered'}, {'list': 'bullet'}],
                    ['link', 'blockquote', 'code-block'],
                    [{'color': []}, {'background': []}],
                    [{'align': []}],
                    ['clean']
                ]
            }
        });

        $(document).ready(function () {
            $("#frmtribute").submit(function (event) {
                event.preventDefault();

                $("#tribute_content").val(quill.root.innerHTML);

                var formData = {
                    _token: "{{ csrf_token() }}", // Required for Laravel
                    name: $("#name").val().trim(),
                    title: $("#title").val().trim(),
                    tribute_content: $("#tribute_content").val().trim()
                };

                $.ajax({
                    type: "POST",
                    url: "{{ url('tribute/store') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        formData: formData
                    },
                    dataType: "json",
                    success: function (response) {
                        if (response.status === "success") {
                            Swal.fire({
                                title: "Processing...",
                                text: "Please wait while we save your tribute.",
                                icon: "info",
                                allowOutsideClick: false,
                                showConfirmButton: false,
                                didOpen: () => {
                                    Swal.showLoading();
                                }
                            });

                            setTimeout(() => {
                                Swal.fire({
                                    title: "Success!",
                                    text: "Tribute saved successfully.",
                                    icon: "success",
                                    confirmButtonText: "OK"
                                }).then(() => {
                                    location.reload();
                                });
                            }, 3000);
                        } else {
                            Swal.fire({
                                title: "Error!",
                                text: response.message,
                                icon: "error",
                                confirmButtonText: "Try Again"
                            });
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error("AJAX Error:", status, error);
                        Swal.fire({
                            title: "Oops!",
                            text: "An error occurred while saving your tribute.",
                            icon: "error",
                            confirmButtonText: "OK"
                        });
                    }
                });
            });
        });
    </script>
@endsection
