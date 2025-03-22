<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Model
use App\Models\product;
use App\Models\User;
use App\Models\orders;
use App\Models\order_details;
// 
use App\Repositories\Affiliate\AffiliateRepositoryInterface;

class AffiliateController extends Controller
{
    protected $AffiliateRepository;
    public function __construct(AffiliateRepositoryInterface $AffiliateRepository)
    {
        $this->AffiliateRepository = $AffiliateRepository;
    }
    public function index()
    {
        /** === Khai báo thư viện sử dụng === */
        $dataversion = [
            'useslick' => 0,
            'useselect2' => 1,
        ];

        /** === Xây dựng SEO === */
        $domain = env('DOMAIN_WEB');
        $dataSeo = [
            'seo_title' => "Tiếp Thị Liên Kết - Kiếm Tiền Online Cùng Fashion Houses",
            'seo_desc' => "Tham gia chương trình tiếp thị liên kết của Fashion Houses để kiếm tiền online dễ dàng. Hoa hồng hấp dẫn, thanh toán minh bạch & hỗ trợ tận tâm!",
            'seo_keyword' => "tiếp thị liên kết, kiếm tiền online, affiliate marketing, hoa hồng hấp dẫn, chương trình đối tác, Fashion Houses",
            'canonical' => $domain . '/tiep-thi-lien-ket',
        ];

        /** === Xây dựng breadcrumb === */
        $breadcrumbItems = [
            ['title' => 'Trang chủ', 'url' => '/', 'class' => 'otherssite'],
            ['title' => "Tiếp thị liên kết", 'url' => '', 'class' => 'thissite']
        ];

        /** === Chuẩn bị dữ liệu === */
        $data = InForAccount();
        $user_id = $data['data']['us_id'];
        /** === Chuẩn bị mảng dữ liệu trả về view === */
        $categoryTree = getCategoryTree();
        $dataAll = [
            'data' => $data,
            'breadcrumbItems' => $breadcrumbItems,
            'Category' => $categoryTree,
        ];

        /** === Debug kiểm tra dữ liệu === */
        // dd($dataAll);

        /** === Trả về view với dữ liệu === */
        return view('affiliate', [
            'dataSeo' => $dataSeo,
            'domain' => $domain,
            'dataversion' => $dataversion,
            'dataAll' => $dataAll,
        ]);
    }

}
