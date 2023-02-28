<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.css">

    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.js"></script>
        <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
        <script>
            $(document).ready( function () {
                $('#tableProduct').DataTable();
                $('#tableOrders').DataTable();
            } );

            let groupProduct = document.getElementById('groupProduct');
            let quantity = document.getElementById('quantity');

            function addProduct() {
                let item = $("#products option[value='" + $('#productsList').val() + "']");
                let id = item.attr('data-id');
                let value = item.attr('data-title');
                let cost = item.attr('data-cost');

                groupProduct.innerHTML += `
                    <br><div id="product_card_${id}">
                         <x-input-label for="price" :value="__('Product title: ${value} || Product cost ${cost}')" />
                         <x-input-label for="price" :value="__('Product quantity')" />
                         <x-text-input id="quantity" class="cost-quantity mt-1 w-full" type="text" name="quantity" onchange="chengInput()"/>
                         <x-text-input id="cost" class="cost-product block mt-1 w-full" type="hidden" name="cost" value="${cost}" />
                         <x-text-input id="product_id" class="product-id block mt-1 w-full" type="hidden" name="product_id" value="${id}" />
                         <br>
                         <a href="#" style="text-decoration: underline" onclick="removeProduct(${id})">Delete</a>
                    </div><br>`
            }
            function removeProduct(id) {
                document.getElementById('price').value = document.getElementById('price').value - (document.getElementById(`product_card_${id}`).children[3].value * document.getElementById(`product_card_${id}`).children[2].value);
                document.getElementById('groupProduct').removeChild(document.getElementById(`product_card_${id}`))
            }


            function chengInput() {

                let arrCost = Array.from(document.querySelectorAll('.cost-product')).map(inputElement => inputElement.value);
                let arrQuantity = Array.from(document.querySelectorAll('.cost-quantity')).map(inputElement => inputElement.value);
                let id = Array.from(document.querySelectorAll('.product-id')).map(inputElement => inputElement.value);
                let inputPrice = document.getElementById('price');
                let productIdInput = document.getElementById('products_id');
                let total = 0;



                let empties = $('#groupProduct').find('input:text').filter(function() {
                    return $(this).val() == "";
                });

                if (empties.length > 0) {
                    console.log("has empty inputs");
                } else {
                    for (let i = 0; i < arrQuantity.length; i++) {
                        for (let i = 0; i < arrCost.length; i++) {
                            total += parseInt(arrQuantity[i]) * parseInt(arrCost[i]);
                        }
                        break
                    }

                    if (inputPrice.value != '') {
                        inputPrice.value = parseInt(inputPrice.value) + total;
                    }else {
                        inputPrice.value = total;
                    }

                    productIdInput.value = id;
                }
            }
        </script>
        <script src="http://www.openlayers.org/api/OpenLayers.js">
        </script>
        <script src="http://www.openlayers.org/api/OpenLayers.js">
        </script>
        <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU&amp;apikey=<ваш API-ключ>" type="text/javascript"></script>
        <script src="event_reverse_geocode.js" type="text/javascript"></script>
        <script>
            ymaps.ready(init);

            function init() {
                var myPlacemark,
                    myMap = new ymaps.Map('map', {
                        center: [55.753994, 37.622093],
                        zoom: 9
                    }, {
                        searchControlProvider: 'yandex#search'
                    });

                // Слушаем клик на карте.
                myMap.events.add('click', function (e) {
                    var coords = e.get('coords');

                    // Если метка уже создана – просто передвигаем ее.
                    if (myPlacemark) {
                        myPlacemark.geometry.setCoordinates(coords);
                    }
                    // Если нет – создаем.
                    else {
                        myPlacemark = createPlacemark(coords);
                        myMap.geoObjects.add(myPlacemark);
                        // Слушаем событие окончания перетаскивания на метке.
                        myPlacemark.events.add('dragend', function () {
                            getAddress(myPlacemark.geometry.getCoordinates());
                        });
                    }
                    getAddress(coords);
                });

                // Создание метки.
                function createPlacemark(coords) {
                    return new ymaps.Placemark(coords, {
                        iconCaption: 'поиск...'
                    }, {
                        preset: 'islands#violetDotIconWithCaption',
                        draggable: true
                    });
                }

                // Определяем адрес по координатам (обратное геокодирование).
                function getAddress(coords) {
                    myPlacemark.properties.set('iconCaption', 'поиск...');
                    ymaps.geocode(coords).then(function (res) {
                        var firstGeoObject = res.geoObjects.get(0);

                        myPlacemark.properties
                            .set({
                                // Формируем строку с данными об объекте.
                                iconCaption: [
                                    // Название населенного пункта или вышестоящее административно-территориальное образование.
                                    firstGeoObject.getLocalities().length ? firstGeoObject.getLocalities() : firstGeoObject.getAdministrativeAreas(),
                                    // Получаем путь до топонима, если метод вернул null, запрашиваем наименование здания.
                                    firstGeoObject.getThoroughfare() || firstGeoObject.getPremise()
                                ].filter(Boolean).join(', '),
                                // В качестве контента балуна задаем строку с адресом объекта.
                                balloonContent: firstGeoObject.getAddressLine()
                            });
                    });
                }
            }
        </script>
    </body>
</html>
