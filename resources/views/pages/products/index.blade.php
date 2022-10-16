<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Магазин Посуды</title>

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
                      <a href="/" class="nav-link active" aria-current="page">Товары</a>
                  </li>
                  <li class="nav-item">
                      <a href="/cart/1" class="nav-link" aria-current="page">Корзина</a>
                  </li>
              </ul>
            </header>
          </div>

          <div class="album py-3">
              <div class="container">
                  <h1>Товары</h1>

                  <div class="row my-5">
                      <div class="col-md-3">
                          <p class="h5">Категории</p>
                          @foreach ($filters['categories'] as $categoryFilter)
                          <label for="category_filter_{{ $categoryFilter->id }}">
                          <input
                            type="checkbox"
                            class="category-checkbox"
                            id="category_filter_{{ $categoryFilter->id }}"
                            name="category"
                            value="{{ $categoryFilter->id }}" />
                          {{ $categoryFilter->name }}</label><br>
                          @endforeach
                      </div>
                      <div class="col-md-3">
                          <p class="h5">Материал</p>
                          @foreach ($filters['materials'] as $materialFilter)
                          <label for="material_filter_{{ $materialFilter->id }}">
                          <input
                            type="checkbox"
                            class="material-checkbox"
                            id="material_filter_{{ $materialFilter->id }}"
                            name="material"
                            value="{{ $materialFilter->id }}" />
                          {{ $materialFilter->name }}</label><br>
                          @endforeach
                      </div>
                      <div class="col-md-3">
                          <p class="h5">Назначение</p>
                          @foreach ($filters['mealTypes'] as $mealTypesFilter)
                          <label for="mt_filter_{{ $mealTypesFilter->id }}">
                          <input
                            type="checkbox"
                            class="meal-type-checkbox"
                            id="mt_filter_{{ $mealTypesFilter->id }}"
                            name="meal_type"
                            value="{{ $mealTypesFilter->id }}" />
                          {{ $mealTypesFilter->name }}</label><br>
                          @endforeach
                      </div>
                      <div class="col-md-3">
                          <p class="h5">Параметры</p>

                          <div class="row mb-2">
                              <input type="text" id="weight_from" name="weight_from" placeholder="Вес от" style="width: 45%; margin-right: 1rem;">
                              <input type="text" id="weight_to" name="weight_to" placeholder="до" style="width: 45%;">
                          </div>

                          <div class="row mb-2">
                              <input type="text" id="length_from" name="length_from" placeholder="Длина от" style="width: 45%; margin-right: 1rem;">
                              <input type="text" id="length_to" name="length_to" placeholder="до" style="width: 45%;">
                          </div>

                          <div class="row">
                              <input type="text" id="width_from" name="width_from" placeholder="Ширина от" style="width: 45%; margin-right: 1rem;">
                              <input type="text" id="width_to" name="width_to" placeholder="до" style="width: 45%;">
                          </div>

                      </div>
                  </div>

                  <div class="row my-5">
                      <a href="#" class="btn btn-outline-primary" id="find">Найти</a>
                  </div>

                  <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-3">
                      @if (count($products) == 0)
                      <p>Нет товаров</p>
                      @else
                      @foreach ($products as $product)
                    <div class="col">
                      <div class="card shadow-sm">
                        <img src="https://via.placeholder.com/150" alt="" width="100%" height="100%">
                        <div class="card-body">
                          <p class="card-text">
                              <b>{{ $product->name }}</b><br>
                              Категория: <i>{{ $product->category->name }}</i><br>
                              Материал: <i>{{ $product->material->name }}</i><br>
                              Назначение:<i>
                              @php
                              $types = json_decode($product->mealTypes, true);
                              $mealTypes = '';
                              $i = 0;

                              foreach ($types as $type) {
                                  if ($i > 0) {
                                      $mealTypes .= ', ';
                                  }
                                  $mealTypes .= $type['name'];
                                  $i++;
                              }
                              @endphp

                              {{ $mealTypes }}</i>
                              <br>
                              Вес: <i>{{ $product->weight }}</i><br>
                              Размеры (ДхШхВ): <i>{{ $product->length }}x{{ $product->width }}x{{ $product->height }}</i>
                          </p>
                          <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group" style="width: 50%;">
                                <input
                                    class="form-control form-control-sm product-counter"
                                    type="text"
                                    value="1"
                                    style="border-radius: 3px 0 0 3px; border-color: gray; width: 30%;"
                                />
                              <button type="button" class="btn btn-sm btn-outline-secondary increment" style="width: 30px !important; flex: none;">+</button>
                            </div>
                            <button
                                type="button"
                                class="btn btn-primary btn-sm add-to-cart"
                                data-product="{{ $product->id }}"
                            >
                                В корзину
                            </button>
                          </div>
                        </div>
                      </div>
                    </div>
                    @endforeach
                    @endif
                </div>

              </div>
          </div>

          <script>
          const incrementBtns = document.querySelectorAll('.increment');
          const productCounters = document.querySelectorAll('.product-counter');

          incrementBtns.forEach((btn, key) => {
              btn.addEventListener('click', (e) => {
                  incrementCounter(productCounters[key]);
              });
          });

          const incrementCounter = (el) => {
              el.value++;
          }

          const cartButtons = document.querySelectorAll('.add-to-cart');
          cartButtons.forEach((btn, key) => {
              btn.addEventListener('click', (e) => {
                  addToCart(key);
              });
          });

          const addToCart = async (key) => {
              await axios.post('/order-products', {
                  user_id: 1,
                  product_id: cartButtons[key].getAttribute('data-product'),
                  count_items: productCounters[key].value,
              })
                .then(response => {
                    console.log(response);
                }).catch(error => {
                    console.log(error);
                })
          }

          const filterBtn = document.getElementById('find');

          filterBtn.addEventListener('click', (e) => {
              e.preventDefault();
              filterProducts();
          });

          const filterProducts = async () => {
              let url = 'http://' + window.location.hostname + "?";
              let categoryQuery = await getCheckboxFilter('.category-checkbox');
              let materialQuery = await getCheckboxFilter('.material-checkbox');
              let mealTypeQuery = await getCheckboxFilter('.meal-type-checkbox');
              let weightFrom = document.getElementById('weight_from').value;
              let weightTo = document.getElementById('weight_to').value;
              let lengthFrom = document.getElementById('length_from').value;
              let lengthTo = document.getElementById('length_to').value;
              let widthFrom = document.getElementById('width_from').value;
              let widthTo = document.getElementById('width_to').value;

              if (categoryQuery) {
                  url += '&category=' + categoryQuery;
              }

              if (materialQuery) {
                  url += '&material=' + materialQuery;
              }

              if (mealTypeQuery) {
                  url += '&meal_type=' + mealTypeQuery;
              }

              if (weightFrom) {
                  url += '&weight_from=' + weightFrom;
              }

              if (weightTo) {
                  url += '&weight_to=' + weightTo;
              }

              if (lengthFrom) {
                  url += '&length_from=' + lengthFrom;
              }

              if (lengthTo) {
                  url += '&length_to=' + lengthTo;
              }

              if (widthFrom) {
                  url += '&width_from=' + widthFrom;
              }

              if (widthTo) {
                  url += '&width_to=' + widthTo;
              }

              window.location.href = url;
          }

          const getCheckboxFilter = async (el) => {
              let checkboxes = document.querySelectorAll(el);
              let chbxValues = [];
              await checkboxes.forEach((cbx) => {
                  if (cbx.checked) {
                      chbxValues.push(cbx.value);
                  }
              });

              if (chbxValues.length) {
                  return chbxValues.join(',');
              }
          }

          </script>
    </body>
</html>
