@php
    $data_reviews_user = $dataAll['reviews']['data_reviews_user'] ?? [];
    $data_reviews_all = $dataAll['reviews']['data_reviews_all'] ?? [];
    $percent_rating_total = $dataAll['reviews']['percent_rating_total'] ?? 0;
    $total_reviews = $dataAll['reviews']['total_reviews'] ?? 0;
@endphp
<div class="detail-customer-reviews">
    <div class="customer-reviews">
        <div class="box-show-reviews">
            <p class="font_s16 font_w600 line_h24 cl_000">Đánh giá về sản phẩm</p>
            <span class="font_s14 font_w500 line_h20 cl_000">({{ $total_reviews }} đánh giá)</span>
            <div class="rating-summary">
                <div class="show-reviews d_flex al_ct gap_5">
                    <span class="average-rating mt_5">{{ $percent_rating_total }} / 5</span>
                    <span class="stars">⭐⭐⭐⭐⭐</span>
                </div>
            </div>
        </div>
        <div class="box-review-list">
            <p class="font_s16 font_w600 line_h24 cl_000">Đánh giá mới nhất về sản phẩm</p>
            <div class="review-list">
                @foreach ($data_reviews_all as $key => $reviews_user)
                    <div class="review-item">
                        <span class="mt_5 font_s14 font_w500 line_h16">{{ $reviews_user['use_name'] }}</span>
                        <span class="stars">{!! StarsReview()[$reviews_user['review_product_rating']] !!}</span>
                    </div>
                @endforeach
            </div>
        </div>
        <form class="review-form">
            <p class="font_s16 font_w600 line_h24 cl_000">Chọn đánh giá của bạn về sản phẩm</p>
            <label for="rating">Chọn sao:</label>
            <select id="rating" class="cursor_pt">
                <option value="1" {{ isset($data_reviews_user['review_product_rating']) && $data_reviews_user['review_product_rating'] == 1 ? "selected" : ""  }}>⭐</option>
                <option value="2" {{ isset($data_reviews_user['review_product_rating']) && $data_reviews_user['review_product_rating'] == 2 ? "selected" : ""  }}>⭐⭐</option>
                <option value="3" {{ isset($data_reviews_user['review_product_rating']) && $data_reviews_user['review_product_rating'] == 3 ? "selected" : ""  }}>⭐⭐⭐</option>
                <option value="4" {{ isset($data_reviews_user['review_product_rating']) && $data_reviews_user['review_product_rating'] == 4 ? "selected" : ""  }}>⭐⭐⭐⭐</option>
                <option value="5" {{ isset($data_reviews_user['review_product_rating']) && $data_reviews_user['review_product_rating'] == 5 ? "selected" : ""  }}>⭐⭐⭐⭐⭐</option>
            </select>
            <button type="button" class="button_rating-product" data-proid="{{ $dataAll['ProductDetails']['product_id'] ?? 0 }}" data-user = "{{ $dataAll['data']['data']['us_id'] ?? 0 }}" onclick="RatingProduct(this)">Gửi đánh giá</button>
        </form>
    </div>
</div>