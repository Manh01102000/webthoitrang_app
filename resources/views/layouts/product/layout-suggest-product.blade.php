<div class="prod-detail-bottom">
    <h2 class="font_s16 line_h20 font_w600 cl_000">Sản phẩm tương tự</h2>
    <div class="product-suggest-list">
        <div class="product-suggest-item">
            <div class="product-suggest-item-avatar">
                <img class="product-suggest-item-img lazyloaded" 
                    onerror="this.onerror=null; this.src='{{ asset('images/icon/load.gif') }}';"
                    src="{{ asset('images/product_sample/anh1.jpg') }}" 
                    data-src="{{asset("images/product_sample/anh1.jpg")}}?v={{ time() }}"
                    alt="{{ $dataAll['ProductDetails']['product_name'] ?? "" }}">
                <img src="{{ asset('/images/product_icon/favorite_product.svg') }}" class="icon-favorite cursor_pt" width="20" height="20" prod-id="" onclick="FavoriteProduct(this)" alt="icon">
            </div>
            <div class="product-suggest-item-desc">
                <h3 class="product-suggest-desc-name">Tên sản phẩm</h3>
                <p class="product-suggest-desc-text">Số lượng kho: 10</p>
                <div class="product-price">
                    <p class="product-price-discount">
                        100.000 đ
                    </p>
                    <p class="product-price-original">
                        150.000 đ
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>