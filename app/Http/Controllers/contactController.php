<?php

namespace App\Http\Controllers;
// use App\Models\blog;

class ContactController extends Controller
{
    public function index()
    {
        // kiểm tra xem có dùng thư viện hay không
        $dataversion = [
            'useslick' => 0,
            'useselect2' => 1,
        ];
        // SEO 
        $domain = env('DOMAIN_WEB');
        $dataSeo = [
            'seo_title' => "Liên Hệ Fashion Houses - Kết Nối Với Chúng Tôi",
            'seo_desc' => "Liên hệ với Fashion Houses để hợp tác, gửi góp ý hoặc nhận hỗ trợ. Chúng tôi luôn sẵn sàng giải đáp mọi thắc mắc và kết nối với bạn!",
            'seo_keyword' => "Fashion Houses liên hệ, hỗ trợ khách hàng, tư vấn thời trang, liên hệ nhà thiết kế, hợp tác thời trang, liên hệ Fashion Houses, dịch vụ khách hàng, hỗ trợ thời trang.",
            'canonical' => $domain . '/lien-he',
        ];
        // LÂY DỮ LIỆU
        $data = InForAccount();
        $categoryTree = getCategoryTree();
        $dataAll = [
            'data' => $data,
            'Category' => $categoryTree,
            'datacity' => '',
            'datadistrict' => '',
            'datacommune' => '',
        ];
        // Trả về view 'example'
        return view('contact', [
            'dataSeo' => $dataSeo,
            'domain' => $domain,
            'dataversion' => $dataversion,
            'dataAll' => $dataAll,
        ]);
    }
}
