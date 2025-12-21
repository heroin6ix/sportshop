<?php
class Router { // Создаем класс Router — это объект, который будет управлять маршрутами сайта
    private $routes = []; // Внутри создаём массив $routes, где будут храниться все маршруты (адрес → действие)

    // Метод add добавляет новый маршрут
    // $route — это URL (например "/products")
    // $controllerAction — это строка вида "ProductsController@index"
    public function add($route, $controllerAction) {
        // Записываем маршрут в массив
        $this->routes[$route] = $controllerAction;
    }
    public function dispatch($uri) { // dispatch — метод, который решает, какой контроллер вызвать, когда пользователь открыл страницу
        $uri = explode('?', $uri)[0];  // Отбрасываем часть после ? (например: /products?page=2 → /products)
        // Проверяем, есть ли такой маршрут в нашем списке
        if (array_key_exists($uri, $this->routes)) {
            // Разделяем строку "ProductsController@index" на:
            // $controller = ProductsController
            // $action = index
            [$controller, $action] = explode('@', $this->routes[$uri]);
            $controllerFile = "app/controllers/$controller.php"; // Формируем путь к файлу контроллера
            if (file_exists($controllerFile)){ // Проверяем, существует ли этот файл
                require_once $controllerFile; // Подключаем файл, чтобы можно было создать объект контроллера
                $obj = new $controller;  // Создаём объект контроллера (например: new ProductsController)
                $obj->$action();   // Вызываем метод контроллера (например: $obj->index())
            } else { 
                echo "Контроллер $controller не найден"; // Если файла нет — показываем ошибку
            }
        } else {
            http_response_code(404); 
            echo "Страница не найдена";   // Если маршрута нет — отправляем код 404
        }
    }
    public function debugRoutes() {
    return $this->routes; // предполагая, что routes — public или есть getter
}
}
?>