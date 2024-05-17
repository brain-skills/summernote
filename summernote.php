<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $title = htmlspecialchars($_POST['title']);
        $content = $_POST['content'];
        // Handle file upload
        $imageUrl = '';
        if (isset($_FILES['image_url']) && $_FILES['image_url']['error'] == UPLOAD_ERR_OK) {
            $imageTmpPath = $_FILES['image_url']['tmp_name'];
            $imageName = basename($_FILES['image_url']['name']);
            $uploadDir = 'uploads/img/';
            // Ensure the upload directory exists
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            $imagePath = $uploadDir . $imageName;
            if (move_uploaded_file($imageTmpPath, $imagePath)) {
                $imageUrl = $imagePath;
            }
        }
        // Prepare the HTML content to be saved
        $htmlContent = "<h1>$title</h1><div>$content</div>";
        if ($imageUrl) {
            $htmlContent .= "<img src=\"$imageUrl\" alt=\"Uploaded Image\">";
        }
        // Save the content to a file
        file_put_contents('test.html', $htmlContent);

        echo "Data saved successfully!";
    } else {
        echo "Invalid request method!";
    }
?>
