<?php
// Проверяем, был ли запрос выполнен методом POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Проверяем, есть ли загруженное изображение и нет ли ошибок при загрузке
    if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
        // Создаем путь для сохранения изображения
        $uploadDir = 'uploads/img/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true); // Создаем папку, если ее нет
        }
        // Получаем имя и путь загруженного изображения
        $imageName = basename($_FILES['image']['name']);
        $imagePath = $uploadDir . $imageName;
        // Перемещаем изображение из временной директории в папку uploads/img
        if (move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
            // Возвращаем ссылку на загруженное изображение
            echo $imagePath;
        } else {
            echo 'Ошибка при перемещении изображения';
        }
    } else {
        echo 'Ошибка при загрузке изображения';
    }
} else {
    echo 'Неверный метод запроса';
}
?>