<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

$url =
    "https://newsapi.org/v2/top-headlines?country=us&page=1&pageSize=5&apiKey=28fd4e028d8746b09625625701e3b512";
$data = http::get($url);
$news = $data["articles"];
?>

@vite(["resources/css/app.css"])

<table>
    <tr>
        <td>Title</td>
        <td>Author</td>
    </tr>

    @foreach ($news as $item)
        <tr>
            <td>{{ $item["title"] }}</td>
            <td>{{ $item["author"] }}</td>
        </tr>
    @endforeach
</table>
