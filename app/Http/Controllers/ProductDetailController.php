<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
// Model
use App\Models\product;
use App\Models\comment;
use App\Models\content_emojis;
use App\Models\Review;
//JWT
use Tymon\JWTAuth\Facades\JWTAuth;
// COOKIE
use Illuminate\Support\Facades\Cookie;

class ProductDetailController extends Controller
{
    public function index(Request $request)
    {
        /** === Lấy id sản phẩm từ router === */
        $product_id = $request->route('id');
        /** === Khai báo thư viện sử dụng === */
        $dataversion = [
            'useslick' => 0,
            'useselect2' => 1,
        ];
        /** === Lấy dữ liệu tài khoản === */
        $data = InForAccount();
        /** === Lấy thông tin sản phẩm theo ID === */
        $dataProduct = Product::leftJoin('manage_discounts', 'products.product_code', '=', 'manage_discounts.discount_product_code')
            ->where(function ($query) {
                $query->where('manage_discounts.discount_active', 1)
                    ->orWhereNull('manage_discounts.discount_active');
            })
            ->where('products.product_id', $product_id)
            ->select([
                'products.*',
                'manage_discounts.discount_product_code',
                'manage_discounts.discount_active',
                'manage_discounts.discount_type',
                'manage_discounts.discount_start_time',
                'manage_discounts.discount_end_time',
                'manage_discounts.discount_price',
            ])->first(); // Chỉ lấy một sản phẩm

        /** === Nếu sản phẩm không tồn tại, trả về lỗi 404 === */
        if (!$dataProduct) {
            abort(404);
        }
        /** === Chuyển dữ liệu sản phẩm về dạng mảng === */
        $dataProduct = $dataProduct->toArray();
        /** === Lấy dữ liệu sản phẩm tương tự === */
        $similarProducts = Product::join('manage_discounts', 'products.product_code', '=', 'manage_discounts.discount_product_code')
            ->where('product_id', '!=', $product_id) // Loại trừ chính sản phẩm đang xem
            ->where('products.product_active', 1)
            ->where(function ($query) {
                $query->where('manage_discounts.discount_active', 1)
                    ->orWhereNull('manage_discounts.discount_active'); // Nếu không có giảm giá thì vẫn giữ lại sản phẩm
            })
            ->where(function ($query) use ($dataProduct) {
                $query->where('category_children_code', $dataProduct['category_children_code']) // Điều kiện ưu tiên 1
                    ->orWhere('category_code', $dataProduct['category_code']) // Điều kiện ưu tiên 2
                    ->orWhere('category', $dataProduct['category']) // Điều kiện ưu tiên 3
                    ->orWhere('product_name', 'like', '%' . $dataProduct['product_name'] . '%'); // Điều kiện ưu tiên 4
            })->select(
                'products.product_id',
                'products.product_code',
                'products.product_name',
                'products.product_alias',
                'products.product_create_time',
                'products.product_brand',
                'products.product_sizes',
                'products.product_colors',
                'products.product_classification',
                'products.product_stock',
                'products.product_price',
                'products.product_images',
                'manage_discounts.discount_product_code',
                'manage_discounts.discount_active',
                'manage_discounts.discount_type',
                'manage_discounts.discount_start_time',
                'manage_discounts.discount_end_time',
                'manage_discounts.discount_price',
            ) // Chỉ lấy dữ liệu cần dùng
            ->orderByDesc('product_sold') // Ưu tiên sản phẩm bán chạy
            ->limit(8) // Giới hạn số lượng sản phẩm lấy ra
            ->get();

        /** === Lấy danh sách bình luận cha === */
        $page = request()->get('page', 1);
        $limit = 10;
        $offset = ($page - 1) * $limit;

        $parentComments = comment::leftJoin('comment_replies as cr', 'comments.comment_id', '=', 'cr.comment_id')
            ->leftJoin('comment_emojis as ce', 'comments.comment_id', '=', 'ce.emoji_comment_id')
            ->leftJoin('users as us', 'comments.comment_user_id', '=', 'us.use_id')
            ->select(
                // Dữ liệ comment
                'comments.comment_id',
                'comments.comment_parents_id',
                'comments.comment_user_id',
                'comments.comment_content_id',
                'comments.comment_type',
                'comments.comment_content',
                'comments.comment_share',
                'comments.comment_views',
                'comments.comment_image',
                'comments.createdAt',
                'comments.updatedAt',
                // Dữ liệu người dùng
                'us.use_name',
                'us.use_logo',
                'us.use_create_time',
                // Dữ liệu admin rep
                'cr.reply_id',
                'cr.admin_id',
                'cr.content as reply_content',
                'cr.comment_image as reply_image',
                'cr.created_at as reply_createdAt',
                'cr.updated_at as reply_updatedAt',
                // Dữ liệu emoji
                'ce.emoji_id',
                'ce.emoji_comment_user',
                'ce.emoji_comment_type'
            )
            ->where('comments.comment_content_id', $product_id)
            ->where('comments.comment_parents_id', "=", 0)
            ->orderBy('comments.createdAt', 'desc')
            ->limit($limit)
            ->offset($offset)
            ->get();
        /** === Xử lý bình luận con === */
        if (!$parentComments->isEmpty()) {
            $limitchild = 5;
            $parentIds = $parentComments->pluck('comment_id')->toArray();
            // Lấy danh sách bình luận con
            $childComments = Comment::leftJoin('comment_replies as cr', 'comments.comment_id', '=', 'cr.comment_id')
                ->leftJoin('comment_emojis as ce', 'comments.comment_id', '=', 'ce.emoji_comment_id')
                ->leftJoin('users as us', 'comments.comment_user_id', '=', 'us.use_id')
                ->select(
                    'comments.comment_id',
                    'comments.comment_parents_id',
                    'comments.comment_user_id',
                    'comments.comment_content_id',
                    'comments.comment_type',
                    'comments.comment_content',
                    'comments.comment_share',
                    'comments.comment_views',
                    'comments.comment_image',
                    'comments.createdAt',
                    'comments.updatedAt',
                    'us.use_name',
                    'us.use_logo',
                    'us.use_create_time',
                    'cr.reply_id',
                    'cr.admin_id',
                    'cr.content as reply_content',
                    'cr.comment_image as reply_image',
                    'cr.created_at as reply_createdAt',
                    'cr.updated_at as reply_updatedAt',
                    'ce.emoji_id',
                    'ce.emoji_comment_user',
                    'ce.emoji_comment_type'
                )
                ->whereIn('comments.comment_parents_id', $parentIds)
                ->orderBy('comments.createdAt', 'desc')
                ->get()
                ->groupBy('comment_parents_id');

            // Chuyển danh sách con thành mảng
            $childComments = $childComments->map(function ($replies) use ($limitchild) {
                return [
                    'data' => $replies->take($limitchild)->toArray(), // Giới hạn 5 bình luận con
                    'has_more' => $replies->count() > $limitchild // Kiểm tra xem có nhiều hơn 5 bình luận không
                ];
            })->toArray();

            // Chuyển danh sách cha thành mảng
            $parentComments = $parentComments->toArray();
            // Gắn bình luận con vào bình luận cha
            $parentComments = array_map(function ($parent) use ($childComments) {
                $parentCommentId = $parent['comment_id'];
                $parent['children'] = $childComments[$parentCommentId]['data'] ?? [];
                $parent['has_more'] = $childComments[$parentCommentId]['has_more'] ?? false;
                return $parent;
            }, $parentComments);
        }
        /** === Tổng số lượng bình luận của sản phẩm === */
        $ToTalComments = comment::where('comment_content_id', $product_id)->count();
        /** === Dữ liệu trả về === */
        $dataComments = [
            'DBComment' => (!empty($parentComments)) ? $parentComments : [],
            'totalComments' => $ToTalComments
        ];

        /** === Lấy thông tin emoji và Lấy thông tin đánh giá sản phẩm === */
        // Kiểm tra xem cookie có tồn tại không
        $UID_ENCRYPT = $_COOKIE['UID'] ?? null;
        $UT_ENCRYPT = $_COOKIE['UT'] ?? null;

        $data_emojis = null; // Mặc định là null
        $total_emojis = 0;   // Tổng số emoji từ người khác
        $key = getenv('KEY_ENCRYPT') ? base64_decode(getenv('KEY_ENCRYPT')) : null;

        // LẤY ĐÁNH GIÁ
        $reviews = []; //lấy dữ liệu reviews
        // Lấy tất cả đánh giá của mọi user
        $data_reviews_all = Review::join('users', 'users.use_id', '=', 'reviews.review_user_id')
            ->where('review_product_id', $product_id)
            ->select(['review_product_rating', 'review_created_at', 'users.use_id', 'users.use_name'])
            ->get();

        // Lấy tổng số sao và tổng số lượt đánh giá từ tất cả user
        $review_stats = Review::where('review_product_id', $product_id)
            ->selectRaw('SUM(review_product_rating) as total_rating, COUNT(*) as total_reviews')
            ->first();

        // Nếu không có đánh giá nào thì đặt mặc định
        $total_reviews = $review_stats->total_reviews ?? 0;
        $product_rating_total = $review_stats->total_rating ?? 0;

        // Tránh lỗi chia 0 khi không có đánh giá
        $percent_rating_total = $total_reviews > 0 ? ceil($product_rating_total / $total_reviews) : 0;

        // Chuẩn bị dữ liệu trả về
        $reviews = [
            'data_reviews_all' => (!empty($data_reviews_all)) ? $data_reviews_all->toArray() : [],
            'percent_rating_total' => $percent_rating_total,
            'total_reviews' => $total_reviews,
        ];

        if ($UID_ENCRYPT && $UT_ENCRYPT && $key) {
            $user_id = decryptData($UID_ENCRYPT, $key);

            if (is_numeric($user_id)) {
                /** === Lấy thông tin emoji === */
                // Lấy emoji của chính user hiện tại
                $data_emojis = content_emojis::where('content_id', $product_id)
                    ->where('content_type', 1)
                    ->where('user_id', $user_id)
                    ->value('emoji');

                // Đếm tổng số emoji nhưng không tính của user hiện tại
                $total_emojis = content_emojis::where('content_id', $product_id)
                    ->where('content_type', 1)
                    ->where('user_id', '!=', $user_id) // Loại bỏ bản ghi của user hiện tại
                    ->count();

                /** === Lấy đánh giá sản phẩm của user hiện tại === */
                $data_reviews_user = Review::join('users', 'users.use_id', '=', 'reviews.review_user_id')
                    ->where([
                        ['review_product_id', $product_id],
                        ['review_user_id', $user_id]
                    ])
                    ->select(['review_product_rating', 'review_created_at', 'users.use_id', 'users.use_name'])
                    ->first();
                // Gán dữ liệu trả về
                $reviews['data_reviews_user'] = (!empty($data_reviews_user)) ? $data_reviews_user->toArray() : [];
            }
        }
        /** === Xây dựng SEO === */
        $domain = env('DOMAIN_WEB');
        $product_name = $dataProduct['product_name'] ?? 'Sản phẩm thời trang cao cấp';

        $seo_title = strlen($product_name) > 50
            ? limitText($product_name, 50) . ' | Mua ngay tại Fashion House'
            : "$product_name | Thời trang cao cấp | Fashion House";

        $seo_description = strlen($product_name) > 100
            ? "Mua ngay " . limitText($product_name, 100) . " tại Fashion House. Ưu đãi hấp dẫn, giao hàng toàn quốc!"
            : "Mua ngay $product_name chính hãng tại Fashion House. Thiết kế đẹp, chất liệu cao cấp, nhiều ưu đãi!";

        $seo_keywords = "$product_name, thời trang cao cấp, shop thời trang, quần áo đẹp, thời trang nam nữ";

        $dataSeo = [
            'seo_title' => $seo_title,
            'seo_desc' => $seo_description,
            'seo_keyword' => $seo_keywords,
            'canonical' => $domain,
        ];

        // ===================Lấy danh mục theo từng cấp=============
        $categoryTree = Cache::remember('category_tree', 3600, function () {
            return getCategoryTree();
        });
        // ===================Xây dựng breadcrumb=============
        $breadcrumbItems = [
            ['title' => 'Trang chủ', 'url' => '/', 'class' => 'otherssite'],
            [
                'title' => FindCategoryByCatId($dataProduct['category'])['cat_name'],
                'url' => '/' . FindCategoryByCatId($dataProduct['category'])['cat_alias'],
                'class' => 'otherssite'
            ],
            [
                'title' => FindCategoryByCatId($dataProduct['category_code'])['cat_name'],
                'url' => '/' . FindCategoryByCatId($dataProduct['category'])['cat_alias'] . '/' . FindCategoryByCatId($dataProduct['category_code'])['cat_alias'],
                'class' => 'otherssite'
            ],
            [
                'title' => FindCategoryByCatId($dataProduct['category_children_code'])['cat_name'],
                'url' => '/' . FindCategoryByCatId($dataProduct['category'])['cat_alias'] . '/' . FindCategoryByCatId($dataProduct['category_code'])['cat_alias'] . '/' . FindCategoryByCatId($dataProduct['category_children_code'])['cat_alias'],
                'class' => 'otherssite'
            ],
            [
                'title' => $dataProduct['product_name'],
                'url' => '',
                'class' => 'thissite'
            ]
        ];
        // ===================Chuẩn bị dữ liệu tổng hợp=============

        $dataAll = [
            'data' => $data,
            // Breadcrumb
            'breadcrumbItems' => $breadcrumbItems,
            // Dữ liệu danh mục theo phân lớp
            'Category' => $categoryTree,
            // Dữ liệu sản phẩm
            'ProductDetails' => $dataProduct,
            // Dữ liệu sản phẩm tương tự
            'similarProducts' => (!empty($similarProducts)) ? $similarProducts->toArray() : [],
            // end
            'data-id' => $dataProduct['product_id'],
            // Chức năng bình luận & emoji
            'interaction' => [
                'data-emoji' => $data_emojis,
                'total-emojis' => $total_emojis,
                'dataComments' => $dataComments,
            ],
            // data review
            'reviews' => $reviews,
        ];
        // =============== TRẢ VỀ VIEW =====================
        return view('product_detail', [
            'dataSeo' => $dataSeo,
            'domain' => $domain,
            'dataversion' => $dataversion,
            'dataAll' => $dataAll,
        ]);
    }
    public function RatingProduct(Request $request)
    {
        try {
            $rating = $request->get('rating', 0);
            $product_id = $request->get('product_id', 0);

            if (!$rating || !$product_id) {
                return apiResponse("error", "Thiếu ID sản phẩm hoặc đánh giá", [], false, 400);
            }

            // Lấy thông tin người dùng từ token trong cookie
            $cookie = Cookie::get('jwt_token');

            if (!$cookie) {
                return apiResponse("error", "Không tìm thấy token", [], false, 401);
            }

            $user = JWTAuth::setToken($cookie)->authenticate();

            if (!$user) {
                return apiResponse("error", "Token không hợp lệ hoặc đã hết hạn", [], false, 401);
            }

            // Convert user thành array nếu cần
            $user = $user->toArray();
            $user_id = $user['use_id'];

            $review = Review::where([
                ['review_user_id', $user_id],
                ['review_product_id', $product_id],
            ])->first();

            if ($review) {
                $review->update([
                    'review_product_rating' => $rating,
                    'review_updated_at' => time(),
                ]);
                return apiResponse("success", "Cập nhật đánh giá sản phẩm thành công", [], true, 200);
            } else {
                Review::create([
                    'review_user_id' => $user_id,
                    'review_product_id' => $product_id,
                    'review_product_rating' => $rating,
                    'review_created_at' => time(),
                    'review_updated_at' => time(),
                ]);
                return apiResponse("success", "Đánh giá sản phẩm thành công", [], true, 200);
            }
        } catch (\Exception $e) {
            return apiResponse("error", "Lỗi server: " . $e->getMessage(), [], false, 500);
        }
    }

}