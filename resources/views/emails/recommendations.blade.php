<!DOCTYPE html>
<html>
<head>
    <title>Рекомендации</title>
    <style>
        .main {
            display: flex;
            justify-content: space-between;

        }
        .main__logo {
            width: 10%;
        }
        .logo {
            width: 50%;
        }
        .header {
            display: flex;
            margin-top: 30px;
        }
        .header__list {
            border: 1px solid #000;
            margin-right: 8px;
        }
        .prewiev {
            width: 50%;
        }
        .prewiev__image {
            width: 200px;
            height: auto;
        }
        .content {
            text-align: center;
        }
        .content__main {
            font-weight: 700;
            font-size: 15px;
            color: #000;
        }
        .content__text {
            font-size: 15px;
            font-weight: 400;
            color: #919191ff;
        }
    </style>
</head>
<body>
    <div class="main">
        <div class="main__logo">
            <img src="https://disk.yandex.ru/d/lQSBjq2CLNPHmA" alt="" class="logo">
        </div>
        <h1 class="main__prewiev">Ваши персональные рекомендации</h1>
    </div>
    <div class="header">
        @foreach($recommendations as $recomendation)
            <div class="header__list">
                <div class="prewiev">
                    <img src="https://2.downloader.disk.yandex.ru/preview/f07492511edab1f2146f0a6d0a48733b1ebdb9f89729ef004d0d1223c5560eac/inf/uRUP78P5J18cd6c_TafXSMCxENc85CLP6hQ3INHg3rDLR9e57dLS724DJCcMpFdcPu7HHtdBWJJyEiH5ZPDehA%3D%3D?uid=1889900328&filename=i.jpg&disposition=inline&hash=&limit=0&content_type=image%2Fjpeg&owner_uid=1889900328&tknv=v3&size=1600x739" alt="" class="prewiev__image">
                </div>
                <div class="content">
                    <h2 class="content__main">{{ $recomendation->mark->name." ".$recomendation->model->model }}</h2>
                    <p class="content__text">{{ $recomendation->description}}</p>
                    <p class="content__text">{{ $recomendation->mileage."/".$recomendation->year }}</p>
                    <p class="content__text">{{ $recomendation->price." Р" }}</p>
                </div>
            </div>
        @endforeach
    </div>
    
    <p>С уважением,<br>Ваш сервис</p>
</body>
</html>