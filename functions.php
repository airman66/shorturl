<?php
function sendResponse($status = 200, $body = '', $content_type = 'application/json') {
    header('HTTP/1.1 ' . $status);
    header('Content-Type: ' . $content_type. "; charset=utf-8");
    echo json_encode($body);
    exit();
}