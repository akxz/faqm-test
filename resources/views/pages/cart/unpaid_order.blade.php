<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Корзина</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="container">
            <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
              <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
                <span class="fs-4">Магазин посуды</span>
              </a>

              <ul class="nav nav-pills">
                <li class="nav-item">
                    <a href="/" class="nav-link" aria-current="page">Товары</a>
                </li>
                <li class="nav-item">
                    <a href="/cart/1" class="nav-link active" aria-current="page">Корзина</a>
                </li>
              </ul>
            </header>
          </div>

          <div class="album py-3">
              <div class="container">
                  <h1>Корзина</h1>
                  @if (empty($boxes))
                  <p>Ваша корзина пуста</p>
                  @else


                  <div class="row row-cols-1 g-5">
                      @foreach ($boxes as $box)
                      <div class="col">
                          <div class="card">
                              <div class="card-body">

                                  @foreach ($box['products'] as $product)
                                  <h5 class="card-title">
                                  </h5>
                                  <p class="card-text">
                                      <span class="h5">{{ $product['name'] }}</span><br>
                                      Материал: {{ $product['material_name'] }};
                                      Назначение: {{ implode(', ', $product['meal_types']) }};
                                      Кол-во: {{ $product['count_items'] }};
                                      Вес 1 шт.: {{ $product['weight'] }};
                                      Размер товара (ДхШхВ):
                                      {{ $product['length'] }}x{{ $product['width'] }}x{{ $product['height'] }};
                                  </p>
                                  @endforeach

                              </div>
                              <div class="card-footer text-muted">
                                  <b>Материал</b> {{ $box['material'] }};
                                  <b>Назначение</b> {{ implode(', ', $box['meal_types']) }};
                                  <b>Товарных позиций</b> {{ count($box['products']) }};
                                  <b>Общий вес</b> {{ $box['weight'] }};
                                  <b>Размер коробки (ДхШхВ)</b>
                                  {{ $box['size']['length'] }}x{{ $box['size']['width'] }}x{{ $box['size']['height'] }};
                              </div>
                          </div>

                      </div>
                      @endforeach
                  </div>

                  <div class="row my-5">
                      <div class="col">
                          <a href="#" id="clear-cart" class="btn btn-danger">Очистить корзину</a>
                      </div>
                  </div>

                  @endif

              </div>
          </div>

          <script>
          const clearCartBtn = document.querySelector('#clear-cart');

          clearCartBtn.addEventListener('click', (e) => {
              clearCart();
              location.reload();
          });

          const clearCart = async () => {
              await axios.delete('/order/by-user/1')
                .then(response => {
                    console.log(response);
                }).catch(error => {
                    console.log(error);
                })
          }

          </script>
    </body>
</html>
