<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .doc-preview {
            margin-top: 20px;
            padding: 15px;
            border: 1px solid #ccc;
            background-color: #f9f9f9;
            min-height: 300px;
            overflow: auto;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1>Profile Page</h1>
        <p><strong>Name:</strong> {{ Auth::user()->name }}</p>

        <h3>Recent Forms Converted</h3>
        @if($convertedForms->isEmpty())
            <p>You have not converted any forms yet.</p>
        @else
            <ul class="list-group">
                @foreach ($convertedForms as $form)
                <div>
                    <a href="{{ route('form.preview', $form->id) }}">{{ $form->nama_mitra }}</a>
                </div>
            @endforeach

            </ul>
        @endif

        <!-- Preview section -->
        <div id="docx-preview" class="doc-preview">
            <p>Select a form to preview the document content here.</p>
        </div>

        <a href="{{ route('form') }}" class="btn btn-primary mt-3">Back to Form</a>
    </div>

    <!-- jQuery for handling dynamic content loading -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.docx-link').on('click', function(e) {
                e.preventDefault();
                var fileUrl = $(this).data('file');

                // Load the DOCX file preview using AJAX
                $.get(fileUrl, function(response) {
                    if (response.file_url) {
                        // Create a download link or iframe for viewing the DOCX file
                        $('#docx-preview').html(
                            '<iframe src="' + response.file_url + '" width="100%" height="400px"></iframe>'
                        );
                    } else {
                        $('#docx-preview').html('File not found.');
                    }
                });
            });
        });
    </script>

</body>
</html>
