<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $uploadedFile = $_FILES['photo'];

    // Check for errors during the upload
    if ($uploadedFile['error'] === UPLOAD_ERR_OK) {
        $originalFileName = $uploadedFile['name'];
        $extension = pathinfo($originalFileName, PATHINFO_EXTENSION);

        // Generate a unique identifier for the new file name
        $randomName = uniqid() . '_' . bin2hex(random_bytes(8));

        $targetDirectory = 'uploads/';
        $targetFile = $targetDirectory . $randomName . '.' . $extension;

        // Move the uploaded file to the desired directory
        if (move_uploaded_file($uploadedFile['tmp_name'], $targetFile)) {
            echo 'File uploaded successfully!';
        } else {
            echo 'Error moving uploaded file to target directory.';
        }
    } else {
        echo 'Error during file upload. Error code: ' . $uploadedFile['error'];
    }
} else {
    echo 'Invalid request.';
}
?>
