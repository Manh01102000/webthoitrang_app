<?php
// namespace
namespace App\Http\Controllers;
// Import Request
use Illuminate\Http\Request;
// import CartRepositoryInterface
use App\Repositories\Cart\CartRepositoryInterface;

class CartController extends Controller
{
    protected $cartRepository;

    public function __construct(CartRepositoryInterface $cartRepository)
    {
        $this->cartRepository = $cartRepository;
    }
    public function index()
    {
        /** === Khai báo thư viện sử dụng === */
        $dataversion = [
            'useslick' => 0,
            'useselect2' => 1,
        ];
        /** === 1. Lấy thông tin người dùng từ cookie & giải mã === */
        $UID_ENCRYPT = $_COOKIE['UID'] ?? 0;
        $UT_ENCRYPT = $_COOKIE['UT'] ?? 0;
        $key = base64_decode(getenv('KEY_ENCRYPT'));
        $user_id = decryptData($UID_ENCRYPT, $key);
        $userType = decryptData($UT_ENCRYPT, $key);

        /** === 2. Lấy dữ liệu giỏ hàng từ repository === */
        $response = $this->cartRepository->getCartByUser($user_id);
        $datacart = [];
        if ($response['success']) {
            $datacart = $response['data']->toArray();
        }

        /** === Xây dựng SEO === */
        $domain = env('DOMAIN_WEB');
        $dataSeo = [
            'seo_title' => "Giỏ Hàng Của Bạn - Fashion Houses",
            'seo_desc' => "Xem lại các sản phẩm thời trang trong giỏ hàng của bạn tại Fashion Houses. Hoàn tất đơn hàng để sở hữu những thiết kế mới nhất từ các nhà mốt hàng đầu!",
            'seo_keyword' => "Fashion Houses giỏ hàng, sản phẩm thời trang, mua sắm thời trang, thanh toán đơn hàng, thời trang cao cấp, giỏ hàng trực tuyến, xu hướng thời trang, đặt hàng thời trang.",
            'canonical' => $domain . '/gio-hang',
        ];
        /** === Xây dựng breadcrumb === */
        $breadcrumbItems = [
            ['title' => 'Trang chủ', 'url' => '/', 'class' => 'otherssite'],
            [
                'title' => "Giỏ hàng",
                'url' => '',
                'class' => 'thissite'
            ]
        ];
        /** === Chuẩn bị dữ liệu giao diện (UI) === */
        $dataversion = [
            'useslick' => 0,
            'useselect2' => 1,
        ];
        $data = InForAccount();
        $categoryTree = getCategoryTree();
        $dataAll = [
            'data' => $data,
            'breadcrumbItems' => $breadcrumbItems,
            'Category' => $categoryTree,
            'datacart' => $datacart,
        ];

        /** === Trả về view với dữ liệu === */
        return view('cart', [
            'dataSeo' => $dataSeo,
            'domain' => $domain,
            'dataversion' => $dataversion,
            'dataAll' => $dataAll,
        ]);
    }

    public function AddToCart(Request $request)
    {
        try {
            // 🟢 ======= Lấy thông tin người dùng từ request =======
            $user = $request->user;
            if (!$user) {
                return response()->json(['message' => 'Không tìm thấy người dùng!'], 401);
            }
            $user_id = $user->use_id;
            $userType = $user->use_role;
            // ================================================
            $product_amount = $request->get('product_amount');
            $product_code = $request->get('product_code');
            $product_size = $request->get('product_size');
            $product_color = $request->get('product_color');
            if (!$product_code || !$product_amount) {
                return apiResponse("error", "Thiếu mã sản phẩm hoặc số lượng", [], false, 400);
            }
            $product_classification = trim($product_size . ',' . $product_color);
            /** === Lấy dữ liệu từ repository === */
            $response = $this->cartRepository->addToCart($user_id, $product_code, $product_amount, $product_classification);
            if ($response['success']) {
                return apiResponse('success', $response['message'], $response['data'], true, $response['httpCode']);
            } else {
                return apiResponse('error', $response['message'], $response['data'], false, $response['httpCode']);
            }
        } catch (\Exception $e) {
            \Log::error("Có lỗi xảy ra khi thêm giỏ hàng - " . $e->getMessage());
            return apiResponse("error", "Lỗi server: " . $e->getMessage(), [], false, 500);
        }
    }

    public function updateCartCountBuy(Request $request)
    {
        try {
            // 🟢 ======= Lấy thông tin người dùng từ request =======
            $user = $request->user;
            if (!$user) {
                return response()->json(['message' => 'Không tìm thấy người dùng!'], 401);
            }
            $user_id = $user->use_id;
            $userType = $user->use_role;
            // Nhận dữ liệu từ request
            $cart_product_amount = (int) $request->get('cart_product_amount');
            $cart_id = (int) $request->get('cart_id');

            // Kiểm tra dữ liệu đầu vào (tránh lỗi null hoặc giá trị không hợp lệ)
            if (!$cart_product_amount || !$cart_id) {
                return apiResponse("error", "Thiếu ID giỏ hàng hoặc số lượng", [], false, 400);
            }

            /** === Lấy dữ liệu từ repository === */
            $response = $this->cartRepository->updateCartAmount($user_id, $cart_id, $cart_product_amount);
            if ($response['success']) {
                return apiResponse('success', $response['message'], $response['data'], true, $response['httpCode']);
            } else {
                return apiResponse('error', $response['message'], $response['data'], false, $response['httpCode']);
            }
        } catch (\Exception $e) {
            \Log::error("Lỗi khi cập nhật giỏ hàng: " . $e->getMessage(), [
                'request' => $request->all(),
                'user_id' => $user_id ?? null
            ]);
            return apiResponse("error", "Lỗi server, vui lòng thử lại sau.", [], false, 500);
        }
    }
}
