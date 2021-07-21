<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
        <link type="text/css" rel="stylesheet" href="{{ URL::asset('css/style.css') }}">
</head>
<body>
<section class="news-header">
    <div>
        <div class="news-header-items">
            <div class="news-header-item">
                <span><em>14:36</em> - 6 сентября</span>
                <p>
                    Предложения сформированы по запросу минсельхоза рф №1324/7434 от 24.11.2017, на основании опроса …
                </p>
            </div>
            <div class="news-header-item">
                <span><em>14:36</em> - 6 сентября</span>
                <p>
                    Предложения сформированы по запросу минсельхоза рф №1324/7434 от 24.11.2017, на основании опроса …
                </p>
            </div>
            <div class="news-header-item">
                <span><em>14:36</em> - 6 сентября</span>
                <p>
                    Предложения сформированы по запросу минсельхоза рф №1324/7434 от 24.11.2017, на основании опроса …
                </p>
            </div>
            <div class="news-header-item">
                <span><em>14:36</em> - 6 сентября</span>
                <p>
                    Предложения сформированы по запросу минсельхоза рф №1324/7434 от 24.11.2017, на основании опроса …
                </p>
            </div>
        </div>
    </div>
</section>

<header>
    <div>
        <div class="header">
            <!--                <a href="javascript:" class="header-logo">
                                <img src="@/assets/img/logo-n-centered.png" alt="logo"/>
            &lt;!&ndash;                    <img src="@/assets/img/logo-small-cl.png" alt="logo"/>&ndash;&gt;
                            </a>-->
            <a href="javascript:" class="header-logo-sm">
                <p>торг экспресс
                    <span>Фермерская торговая площадка №1 в России</span>
                </p>
            </a>
            <nav class="header-nav">
                <ul>
                    <li class="active"><a href="{{route('news')}}">Новости</a></li>
                    <li><a href="{{route('board')}}">Объявления</a></li>
                    <li><a href="{{route('blog')}}">Блоги</a></li>
                    <li><a href="{{route('store')}}">Магазины</a></li>
{{--                    <li><a href="javascript:">еще...</a></li>--}}
                </ul>
            </nav>
            <div class="header-actions btn-icon">
                <button  class="header-actionsCity">
                    <img src="{{ URL::asset('img/city-pointer.png') }}" alt="icon"/>
                    <span>Москва</span>
                </button>
                <button  class="header-actionsAuth">
                    <img src="{{ URL::asset('img/person.png') }}" alt="icon"/>
                    <span>Войти</span>
                </button>
            </div>
        </div>
    </div>
</header>
<div id="app">
    @yield('index')
</div>

<footer>
    <div>
        <div class="footer-top">
            <div class="footer-top-logo">
                <a href="javascript:" class="logo-sm">
                    <p>торг экспресс</p>
                    <span>Фермерская торговая площадка №1 в России</span>
                </a>
            </div>
            <div class="footer-top-menu">
                <a href="javascript:">Подать объявление</a>
                <a href="javascript:">Объявления</a>
                <a href="javascript:">Магазины</a>
                <a href="javascript:">Помощь</a>
                <a href="javascript:">Безопасность</a>
                <a href="javascript:">Реклама на сайте</a>
                <a href="javascript:">О компании</a>
                <a href="javascript:">Вакансии</a>
                <a href="javascript:">Мобильное приложение</a>
            </div>
        </div>

        <div class="footer-middle">
            <div class="footer-middle-soc">
                @include('partials/socials')
            </div>
            <div class="footer-middle-menu">
                <ul class="footer-middle-menu-geo">
                    <li>
                        <ul>
                            <li><a href="javascript:"><span>Москва</span></a></li>
                            <li><a href="javascript:"><span>Санкт-Петербург</span></a></li>
                            <li><a href="javascript:"><span>Балашиха</span></a></li>
                            <li><a href="javascript:"><span>Владивосток</span></a></li>
                            <li><a href="javascript:"><span>Волгоград</span></a></li>
                            <li><a href="javascript:"><span>Воронеж</span></a></li>
                        </ul>
                    </li>
                    <li>
                        <ul>
                            <li><a href="javascript:"><span>Екатеринбург</span></a></li>
                            <li><a href="javascript:"><span>Иркутск</span></a></li>
                            <li><a href="javascript:"><span>Казань</span></a></li>
                            <li><a href="javascript:"><span>Калуга</span></a></li>
                            <li><a href="javascript:"><span>Краснодар</span></a></li>
                            <li><a href="javascript:"><span>Красноярск</span></a></li>
                        </ul>
                    </li>
                    <li>
                        <ul>
                            <li><a href="javascript:"><span>Мытищи</span></a></li>
                            <li><a href="javascript:"><span>Нижний Новгород</span></a></li>
                            <li><a href="javascript:"><span>Новосибирск</span></a></li>
                            <li><a href="javascript:"><span>Омск</span></a></li>
                            <li><a href="javascript:"><span>Пермь</span></a></li>
                            <li><a href="javascript:"><span>Подольск</span></a></li>
                        </ul>
                    </li>
                    <li>
                        <ul>
                            <li><a href="javascript:"><span>Пятигорск</span></a></li>
                            <li><a href="javascript:"><span>Ростов-на-Дону</span></a></li>
                            <li><a href="javascript:"><span>Самара</span></a></li>
                            <li><a href="javascript:"><span>Саратов</span></a></li>
                            <li><a href="javascript:"><span>Сочи</span></a></li>
                            <li><a href="javascript:"><span>Сургут</span></a></li>
                        </ul>
                    </li>
                    <li>
                        <ul>
                            <li><a href="javascript:"><span>Томск</span></a></li>
                            <li><a href="javascript:"><span>Тюмень</span></a></li>
                            <li><a href="javascript:"><span>Уфа</span></a></li>
                            <li><a href="javascript:"><span>Хабаровск</span></a></li>
                            <li><a href="javascript:"><span>Челябинск</span></a></li>
                            <li><a href="javascript:"><span>Ярославль</span></a></li>
                        </ul>
                    </li>
                    <li class="helper"></li>
                </ul>

                <a class="footer-middle-menu-more" href="javascript:"><span>Показать еще</span></a>

                <ul class="footer-middle-menu-rubricator">
                    <li>
                        <ul>
                            <li><a href="javascript:"><span>Бизнес-планы и финансы</span></a></li>
                            <li><a href="javascript:"><span>Ветеринария</span></a></li>
                            <li><a href="javascript:"><span>Грибоводство</span></a></li>
                            <li><a href="javascript:"><span>Животноводство</span></a></li>
                            <li><a href="javascript:"><span>Здоровье</span></a></li>
                            <li><a href="javascript:"><span>Кормовые растения</span></a></li>
                        </ul>
                    </li>
                    <li>
                        <ul>
                            <li><a href="javascript:"><span>Мелкое животноводство</span></a></li>
                            <li><a href="javascript:"><span>Мировой опыт</span></a></li>
                            <li><a href="javascript:"><span>Ноу-Хау</span></a></li>
                            <li><a href="javascript:"><span>Оборудование и технологии</span></a></li>
                            <li><a href="javascript:"><span>Птицеводство</span></a></li>
                            <li><a href="javascript:"><span>Пчеловодство</span></a></li>
                        </ul>
                    </li>
                    <li>
                        <ul>
                            <li><a href="javascript:"><span>Растениеводство</span></a></li>
                            <li><a href="javascript:"><span>Рыбоводство</span></a></li>
                            <li><a href="javascript:"><span>Садоводство</span></a></li>
                            <li><a href="javascript:"><span>Секреты урожайности</span></a></li>
                            <li><a href="javascript:"><span>Сельхозкооперация</span></a></li>
                            <li><a href="javascript:"><span>Удобрения</span></a></li>
                        </ul>
                    </li>
                    <li>
                        <ul>
                            <li><a href="javascript:"><span>Усадьба</span></a></li>
                            <li><a href="javascript:"><span>Фермерская электроника</span></a></li>
                            <li><a href="javascript:"><span>Цветоводство</span></a></li>
                        </ul>
                    </li>
                    <li class="helper"></li>
                </ul>

            </div>

        </div>


        <div class="footer-copyright">
            <div class="footer-copyright-left">
                <p>© 2021
                    <a href="javascript:">RedRockets</a>
                    &amp;
                    <a href="javascript:">Barbudos Group</a>
                </p>
            </div>
            <div class="footer-copyright-right">
                <a href="javascript:">Лицензионное соглашение </a>
                <a href="javascript:">Правила акции</a>
                <a href="javascript:">Обратная связь</a>
                <a href="javascript:">Помощь</a>
            </div>
        </div>


    </div>

</footer>

<script src="{{ asset('js/site/index.js') }}"></script>
<script src="{{ asset('js/scripts/jq.3.3.0.js') }}"></script>
<script src="{{ asset('js/scripts/index.js') }}"></script>

</body>
</html>
