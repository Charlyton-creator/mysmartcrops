@extends('layouts.base-app')

@section('content')
  <!-- 
    - #ASIDE
  -->
  @include('layouts.agrotech-header')
  <aside class="aside">

    <div class="side-panel" data-side-panel="whishlist">

      <button class="panel-close-btn" aria-label="Close whishlist" data-panel-btn="whishlist">
        <ion-icon name="close-outline"></ion-icon>
      </button>

      <ul class="panel-list">

        <li class="panel-item">
          <a href="./product-details.html" class="panel-card">

            <figure class="item-banner">
              <img src="./assets/images/product-small-1.jpg" width="46" height="46" loading="lazy"
                alt="Bright Side Vegetarian">
            </figure>

            <div>
              <p class="item-title">Bright Side Vegetarian</p>

              <span class="item-value">$20.15x1</span>
            </div>

            <button class="item-close-btn" aria-label="Remove item">
              <ion-icon name="close-outline"></ion-icon>
            </button>

          </a>
        </li>

        <li class="panel-item">
          <a href="./product-details.html" class="panel-card">

            <figure class="item-banner">
              <img src="./assets/images/product-small-2.jpg" width="46" height="46" loading="lazy" alt="Eco Vegetable">
            </figure>

            <div>
              <p class="item-title">Eco Vegetable</p>

              <span class="item-value">$13.25x2</span>
            </div>

            <button class="item-close-btn" aria-label="Remove item">
              <ion-icon name="close-outline"></ion-icon>
            </button>

          </a>
        </li>

        <li class="panel-item">
          <a href="./product-details.html" class="panel-card">

            <figure class="item-banner">
              <img src="./assets/images/product-small-3.jpg" width="46" height="46" loading="lazy"
                alt="House of Veggies">
            </figure>

            <div>
              <p class="item-title">House of Veggies</p>

              <span class="item-value">$20.15x1</span>
            </div>

            <button class="item-close-btn" aria-label="Remove item">
              <ion-icon name="close-outline"></ion-icon>
            </button>

          </a>
        </li>

      </ul>

      <div class="subtotal">
        <p class="subtotal-text">Subtotal:</p>

        <data class="subtotal-value" value="215.14">$215.14</data>
      </div>

      <a href="./whishlist.html" class="panel-btn">View Whishlist</a>

    </div>

    <div class="side-panel" data-side-panel="cart">

      <button class="panel-close-btn" aria-label="Close cart" data-panel-btn="cart">
        <ion-icon name="close-outline"></ion-icon>
      </button>

      <ul class="panel-list">

        <li class="panel-item">
          <a href="./product-details.html" class="panel-card">

            <figure class="item-banner">
              <img src="{{ asset('images/' . $produit->image) }}" width="46" height="46" loading="lazy"
                alt="Bright Side Vegetarian">
            </figure>

            <div>
              <p class="item-title">Bright Side Vegetarian</p>

              <span class="item-value">$20.15x1</span>
            </div>

            <button class="item-close-btn" aria-label="Remove item">
              <ion-icon name="close-outline"></ion-icon>
            </button>

          </a>
        </li>

        <li class="panel-item">
          <a href="./product-details.html" class="panel-card">

            <figure class="item-banner">
              <img src="./assets/images/product-small-2.jpg" width="46" height="46" loading="lazy" alt="Eco Vegetable">
            </figure>

            <div>
              <p class="item-title">Eco Vegetable</p>

              <span class="item-value">$13.25x2</span>
            </div>

            <button class="item-close-btn" aria-label="Remove item">
              <ion-icon name="close-outline"></ion-icon>
            </button>

          </a>
        </li>

      </ul>

      <div class="subtotal">
        <p class="subtotal-text">Subtotal:</p>

        <data class="subtotal-value" value="215.14">$215.14</data>
      </div>

      <a href="./cart.html" class="panel-btn">View Cart</a>

    </div>

  </aside>





  <main>
    <article>

      <!-- 
        - #BREADCUMB
      -->

      <div class="breadcumb-wrapper">

        <h2 class="page-title">Product Details</h2>

        <ol class="breadcumb-list">

          <li class="breadcumb-item">
            <a href="{{url('/')}}" class="breadcumb-link">Home</a>
          </li>

          <li class="breadcumb-item">Product</li>

        </ol>

      </div>





      <!-- 
        - #PRODUCT DETAILS
      -->

      <section class="section product-details">
        <div class="container">

          <div class="wrapper">

            <div class="product-details-img">

              <figure class="product-display">
                <img src="{{ asset('images/'.$produit->image) }} " width="700" height="700" loading="lazy"
                  alt="Non-starchy vegetables." class="w-100" data-product-display>
              </figure>

              <ul class="product-thumbnail-list has-scrollbar">

                <li class="product-thumbnail-item">
                  <img src="{{ asset('images/'.$produit->image) }}" width="700" height="700" loading="lazy"
                    alt="Non-starchy vegetables." class="w-100" data-product-thumbnail>
                </li>

                <li class="product-thumbnail-item">
                  <img src="{{ asset('images/'.$produit->image) }}" width="700" height="700" loading="lazy"
                    alt="Non-starchy vegetables." class="w-100" data-product-thumbnail>
                </li>

                <li class="product-thumbnail-item">
                  <img src="{{ asset('images/'.$produit->image) }}" width="700" height="700" loading="lazy"
                    alt="Non-starchy vegetables." class="w-100" data-product-thumbnail>
                </li>

                <li class="product-thumbnail-item">
                  <img src="{{ asset('images/'.$produit->image) }}" width="700" height="700" loading="lazy"
                    alt="Non-starchy vegetables." class="w-100" data-product-thumbnail>
                </li>

              </ul>

            </div>

            <div class="product-details-content">

              <h3 class="product-title">{{$produit->nom}}</h3>

              <data class="product-price" value="350.00">{{$produit->prix}} USD</data>

              <div class="rating-wrapper">
                <ion-icon name="star"></ion-icon>
                <ion-icon name="star"></ion-icon>
                <ion-icon name="star"></ion-icon>
                <ion-icon name="star"></ion-icon>
                <ion-icon name="star"></ion-icon>
              </div>

              <p class="product-text">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc quis ultrices lectus lobortis, dolor et
                tempus porta, leo
                mi efficitur ante, in varius felis sem ut mauris. Proin volutpat lorem inorci sed vestibulum tempus.
                Lorem
                ipsum dolor
                sit amet, consectetur adipiscing elit. Aliquam hendrerit sem porta dolor congue sagittis Lorem ipsum
                dolor
                sit amet
                consectetur.
              </p>

              <div class="product-weight-wrapper">

                <p class="product-weight-title">Poids :</p>

                <ul class="product-weight-list">

                  <li class="product-weight-item">
                    <input type="radio" name="weight" id="weight-1" class="product-weight-radio">

                    <label for="weight-1" class="product-weight-label">4Kg</label>
                  </li>

                  <li class="product-weight-item">
                    <input type="radio" name="weight" id="weight-2" class="product-weight-radio">

                    <label for="weight-2" class="product-weight-label">2Kg</label>
                  </li>

                  <li class="product-weight-item">
                    <input type="radio" name="weight" id="weight-3" class="product-weight-radio">

                    <label for="weight-3" class="product-weight-label">500G</label>
                  </li>

                  <li class="product-weight-item">
                    <input type="radio" name="weight" id="weight-4" class="product-weight-radio">

                    <label for="weight-4" class="product-weight-label">200G</label>
                  </li>

                </ul>

              </div>

              <div class="product-qty">
                <input type="number" name="quantity" value="1" min="1" max="50" class="product-qty-input">

                <button class="btn btn-primary product-qty-btn">Add To Cart</button>
              </div>

            </div>

          </div>

          <h4 class="description-title">Descripton :</h4>

          <p class="description-text">
            Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem
            aperiam,
            eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim
            ipsam
            voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui
            ratione
            voluptatem sequi nesciunt. Neque porro quisquam.Sed ut perspiciatis unde omnis iste natus error sit
            voluptatem
            accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi
            architecto
            beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut
            fugit,
            sed quia
            consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam
          </p>

          <h4 class="description-title">Additional Information :</h4>

          <table class="description-table" border="1px">

            <tr class="table-row">
              <th class="table-heading" scope="row">Ratings</th>

              <td class="table-data">
                <div class="rating-wrapper">
                  <ion-icon name="star"></ion-icon>
                  <ion-icon name="star"></ion-icon>
                  <ion-icon name="star"></ion-icon>
                  <ion-icon name="star-half"></ion-icon>
                  <ion-icon name="star-outline"></ion-icon>
                </div>
              </td>
            </tr>

            <tr class="table-row">
              <th class="table-heading" scope="row">Categorie</th>

              <td class="table-data">{{ $produit->categorie->libelle }}</td>
            </tr>

            <tr class="table-row">
              <th class="table-heading" scope="row">Poids de base</th>

              <td class="table-data">{{ $produit->poids_base }}</td>
            </tr>

            <tr class="table-row">
              <th class="table-heading" scope="row">Detenteur ou Vendeur</th>

              <td class="table-data">AgroTech</td>
            </tr>
          </table>

        </div>
      </section>

    </article>
  </main>

  <!-- 
    - #BACK TO TOP
  -->

  <a href="#top" class="back-to-top" aria-label="Back to Top" data-back-top-btn>
    <ion-icon name="arrow-up-outline"></ion-icon>
  </a>
@endsection