<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $data = [
            [
                "id" => 1,
                "title" => "Opening",
                "icon" => "<svg width=\"24\" height=\"24\" fill=\"none\" xmlns=\"http=>\/\/www.w3.org\/2000\/svg\"><path d=\"M9.144 20.782v-3.067c0-.777.632-1.408 1.414-1.413h2.875c.786 0 1.423.633 1.423 1.413v3.058c0 .674.548 1.222 1.227 1.227h1.96a3.46 3.46 0 0 0 2.444-1 3.41 3.41 0 0 0 1.013-2.422V9.866c0-.735-.328-1.431-.895-1.902l-6.662-5.29a3.115 3.115 0 0 0-3.958.071L3.467 7.963A2.474 2.474 0 0 0 2.5 9.867v8.703C2.5 20.464 4.047 22 5.956 22h1.916c.327.002.641-.125.873-.354.232-.228.363-.54.363-.864h.036Z\" fill=\"currentColor\"\/><\/svg>",
                "image" => "opening-1.jpg",
                "body" => "<div class=\"d-flex justify-content-center align-items-center\" style=\"height=> 100%;\">\r\n    <div style=\"width=> 100%\">\r\n      <div>\r\n        <div class=\"text-center animate__animated animate__fadeInDown animate__slower\">\r\n          <div class=\"editable mb-2\">Wedding Invitation<\/div>\r\n          <div class=\"editable font-accent color-accent h3 mb-3\">Abu &amp; Faizah<\/div>\r\n          <div class=\"animate__animated animate__fadeInDown animate__slower image-editable\"\r\n            style=\"height=> 160px; width=> 160px; margin=> auto; border-radius=> 100%; overflow=> hidden; margin-bottom=> 20px;\">\r\n            <img src=\"\/images\/no-image.jpg\" style=\"width=> 100%;height=> 100%;object-fit=> cover;\">\r\n          <\/div>\r\n        <\/div>\r\n        <div class=\"text-center\">\r\n          <div class=\"editable mb-4 animate__animated animate__fadeInUp animate__slower\">Kepada\r\n            Yth;<br>Bapak\/Ibu\/Saudara\/i<\/div>\r\n          <div id=\"guestNameSlot\"\r\n            class=\"editable color-accent h5 font-weight-bold mb-4 animate__animated animate__fadeInUp animate__slower\">\r\n            Tamu Undangan<\/div>\r\n          <button type=\"button\"\r\n            class=\"btn-open-invitation btn btn-primary rounded-pill mb-4 animate__animated animate__fadeInUp animate__slow\">Buka\r\n            Undangan<\/button>\r\n        <\/div>\r\n      <\/div>\r\n    <\/div>\r\n  <\/div>",
                "is_premium" => 0,
                "order" => 1,
                "created_at" => "2022-01-24T12=>04=>29.000000Z",
                "updated_at" => "2025-02-04T12=>28=>00.000000Z",
                "image_url" => "https=>//assets.satumomen.com/layouts/opening-1.jpg"
            ],
            [
                "id" => 2,
                "title" => "Opening",
                "icon" => "<svg width=\"24\" height=\"24\" fill=\"none\" xmlns=\"http:\/\/www.w3.org\/2000\/svg\"><path d=\"M9.144 20.782v-3.067c0-.777.632-1.408 1.414-1.413h2.875c.786 0 1.423.633 1.423 1.413v3.058c0 .674.548 1.222 1.227 1.227h1.96a3.46 3.46 0 0 0 2.444-1 3.41 3.41 0 0 0 1.013-2.422V9.866c0-.735-.328-1.431-.895-1.902l-6.662-5.29a3.115 3.115 0 0 0-3.958.071L3.467 7.963A2.474 2.474 0 0 0 2.5 9.867v8.703C2.5 20.464 4.047 22 5.956 22h1.916c.327.002.641-.125.873-.354.232-.228.363-.54.363-.864h.036Z\" fill=\"currentColor\"\/><\/svg>",
                "image" => "opening-5.jpg",
                "body" => "<div class=\"d-flex justify-content-center align-items-center flex-column\" style=\"\n    height: 100%;\n\">\n        <div style=\"width: 100%\" class=\"mb-5\"><div class=\"editable text-center mb-3 animate__animated animate__fadeInDown animate__slower\" style=\"font-size: 14.4px;\">THE WEDDING OF<\/div>\n<div style=\"height: 240px;width: 180px;overflow: hidden;margin-top: auto;border: 3px solid var(--inv-border);border-radius: 250px 250px 0 0;padding: 10px;\" class=\"image-editable mb-2 mx-auto animate__animated animate__zoomIn animate__slower\">\n        <img src=\"\/images\/no-image.jpg\" style=\"width: 100%;height: 100%;object-fit: cover;border-radius: 250px 250px 0 0;\" draggable=\"false\">\n      <\/div><div class=\"editable font-accent color-accent text-center animate__animated animate__fadeInDown animate__slower\" style=\"font-size: 34px;\">Rizki &amp; Nadya<\/div><\/div><div style=\"width: 100%\"><div class=\"text-center\">\n<div style=\"border-radius: 0.5rem;padding: 10px;max-width: 290px;margin: auto;\">\n<div class=\"editable mb-2 animate__animated animate__fadeInUp animate__slower\" style=\"font-size: 14.4px;\">Kepada Yth;<br>Bapak\/Ibu\/Saudara\/i<\/div>\n\n<div id=\"guestNameSlot\" class=\"editable color-accent h5 mb-2 font-weight-bold animate__animated animate__fadeInUp animate__slower\" style=\"font-size: 18px;\">Tamu Undangan<\/div>\n<\/div>\n<button type=\"button\" class=\"btn-open-invitation btn btn-primary rounded-pill animate__animated animate__fadeInUp animate__slow\" style=\"font-size: 14.4px;\">Open Invitation<\/button>\n <\/div><\/div><\/div>",
                "is_premium" => 0,
                "order" => 1,
                "created_at" => "2023-10-07T20:14:25.000000Z",
                "updated_at" => null,
                "image_url" => "https://assets.satumomen.com/layouts/opening-5.jpg"
            ],
            [
                "id" => 3,
                "title" => "Quotes",
                "icon" => "<svg width=\"24\" height=\"24\" fill=\"none\" xmlns=\"http:\/\/www.w3.org\/2000\/svg\"><path opacity=\".4\" d=\"M16.191 2H7.81C4.77 2 3 3.78 3 6.83v10.33C3 20.26 4.77 22 7.81 22h8.381C19.28 22 21 20.26 21 17.16V6.83C21 3.78 19.28 2 16.191 2\" fill=\"currentColor\"\/><path fill-rule=\"evenodd\" clip-rule=\"evenodd\" d=\"M8.08 6.65v.01a.78.78 0 0 0 0 1.56h2.989c.431 0 .781-.35.781-.791a.781.781 0 0 0-.781-.779H8.08Zm7.84 6.09H8.08a.78.78 0 0 1 0-1.561h7.84a.781.781 0 0 1 0 1.561Zm0 4.57H8.08c-.3.04-.59-.11-.75-.36a.795.795 0 0 1 .75-1.21h7.84c.399.04.7.38.7.79 0 .399-.301.74-.7.78Z\" fill=\"currentColor\"\/><\/svg>",
                "image" => "quotes-2.jpg",
                "body" => "<div class=\"d-flex justify-content-center align-items-center\" style=\"height: 100%;\">\r\n    <div style=\"width: 100%;\">\r\n      \r\n      <div class=\"text-left text-dark bg-white rounded p-4 shadow animate__animated animate__fadeInUp animate__slower\">\r\n        <div class=\"editable font-italic mb-3\">Ar Rum 21<\/div><div class=\"editable quotes\">Dan di antara tanda-tanda (kebesaran)-Nya ialah Dia menciptakan pasangan-pasangan untukmu dari jenismu sendiri, agar kamu cenderung dan merasa tenteram kepadanya, dan Dia menjadikan di antaramu rasa kasih dan sayang. Sungguh, pada yang demikian itu benar-benar terdapat tanda-tanda (kebesaran Allah) bagi kaum yang berpikir.<\/div>\r\n        \r\n      <\/div>\r\n    <\/div>\r\n  <\/div>",
                "is_premium" => 0,
                "order" => 2,
                "created_at" => "2022-01-24T12:11:19.000000Z",
                "updated_at" => null,
                "image_url" => "https://assets.satumomen.com/layouts/quotes-2.jpg
"
            ],
        ];

        $data = collect($data)->sortBy('order')->values()->all();

        return view('home', compact('data'));
    }
}
