<?php
require_once "../db.php";
require_once "../functions.php";

$db = new DB();

if ($db->getInstance() === null) {
    sendResponse(500, ['message' => 'Не удалось подключиться к базе данных', "code" => 500]);
}

function generate_url(): string {
    $url = "/";
    $alphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    for ($x = 0; $x < 5; $x++) {
        $url = $url.str_split($alphabet)[array_rand(str_split($alphabet))];
    }
    return $url;
}

function generate_unique_url(): string
{
    global $db;
    try {
        $res = $db->getInstance()->query("SELECT * from links");
    } catch (PDOException $exception) {
        sendResponse(500, ['message' => "Не получить ссылки из БД", "code" => 500]);
    }

    $links = [];

    while($link = $res->fetch(PDO::FETCH_ASSOC)) {
        $links[] = $link;
    }

    while(true) {
        $found_in_DB = false;
        $url = generate_url();

        foreach($links as $link) {
            global $found_in_DB;
            if($url === $link["short"]) {
                $found_in_DB = true;
            }
        }

        if($found_in_DB) {
            continue;
        } else {
            return $url;
        }
    }

    return sendResponse(403, ['message' => 'Закончились пустые сокращённые ссылки', "code" => 403]);

}

$method = $_SERVER['REQUEST_METHOD'];

$input = json_decode(file_get_contents('php://input'), true);


if ($method === 'POST') {
    $redirectTo = $input['redirectTo'] ?? '';

    if (filter_var($redirectTo, FILTER_VALIDATE_URL) === FALSE) {
        sendResponse(400, ['message' => 'Неправильный url', "code" => 400]);
    }


    $url = generate_unique_url();

    try {
        $stmt = $db->getInstance()->prepare("INSERT INTO `links`(`id`, `short`, `redirect_to`) VALUES (NULL, '$url', :redirectTo)");
        $stmt->bindParam(':redirectTo', $redirectTo, PDO::PARAM_STR);
        $stmt->execute();
    } catch (PDOException $exception) {
        sendResponse(500, ['message' => "Не удалось записать ссылку в БД", "code" => 500]);
    }

    $response = [
        'status' => 'success',
        'message' => 'Ссылка создана',
        "url" => $url,
        "code" => 200
    ];

    sendResponse(200, $response);
} else {
    sendResponse(405, ['message' => 'Method Not Allowed', "code" => 405]);
}