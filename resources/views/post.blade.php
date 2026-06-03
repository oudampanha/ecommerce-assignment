<!DOCTYPE html>
<html lang="en">

<head>
    <title>Upload Url from Google Drive</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>

    <div class="container-fluid p-5 bg-primary text-white text-center">
        <h1>My First Bootstrap Page</h1>
        <p>Resize this responsive page to see the effect!</p>
    </div>

    <div class="container mt-5">
        <form action="{{ route('post.upload.url') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3 mt-3">
                <label for="title" class="form-label">Title :</label>
                <input type="text" class="form-control" id="title" placeholder="Enter title" name="title">
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <input type="text" class="form-control" id="content" placeholder="Enter content" name="content">
            </div>
            <div class="mb-3">
                <label for="image_path" class="form-label">Image Url :</label>
                <input type="text" class="form-control" id="image_path" placeholder="Enter image_path"
                    name="image_path">
            </div>
            {{-- <div class="form-check mb-3">
                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" name="remember"> Remember me
                </label>
            </div> --}}
            <?php
            function extractDriveFileId($url)
            {
                // Use a regular expression to match the file ID pattern
                preg_match('/d\/([^\/]+)\//', $url, $matches);
                return $matches[1] ?? null;
            }

            $fileId1 = extractDriveFileId('https://drive.google.com/file/d/15hplySvbg8Ksnpo1khz8VliG7sjRNkCD/view?usp=drive_link');
            $fileId2 = extractDriveFileId('https://drive.google.com/file/d/11tG1z0l9UFkPE9iLnGRIYYpy47j9MRc6/view?usp=drive_link');
            $fileId3 = extractDriveFileId('https://drive.google.com/file/d/1Wy8M9NXIylmeuTcbBhawvcrUojUNbZ-y/view?usp=drive_link');
            $fileId4 = extractDriveFileId('https://drive.google.com/file/d/1bxXcHwqiAicjE8MMeDXHbcKZ8C-qkUH0/view?usp=drive_link');
            ?>
            <img src="https://drive.google.com/thumbnail?id={{ $fileId1 }}" alt="">
            <img src="https://drive.google.com/thumbnail?id={{ $fileId2 }}" alt="">
            <img src="https://drive.google.com/thumbnail?id={{ $fileId3 }}" alt="">
            <img src="https://drive.google.com/thumbnail?id={{ $fileId4 }}" alt="">
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

</body>

</html>
