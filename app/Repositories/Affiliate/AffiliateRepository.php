<?php
namespace App\Repositories\Affiliate;
use App\Repositories\Affiliate\AffiliateRepositoryInterface;
// Model
use App\Models\affiliate_contract;
use App\Models\affiliate;

class AffiliateRepository implements AffiliateRepositoryInterface
{
    protected $model;

    public function __construct(affiliate_contract $affiliateContract)
    {
        $this->model = $affiliateContract;
    }
    public function getData($user_id)
    {
        try {
            // Kiểm tra xem user có phải là affiliate không
            $affiliate = Affiliate::join('affiliate_contracts', 'affiliates.affiliate_id', '=', 'affiliate_contracts.contract_affiliate_id')
                ->where('affiliate_user_id', $user_id)->first();

            return [
                'success' => true,
                'message' => "Lấy dữ liệu thành công",
                'httpCode' => 200,
                'data' => $affiliate,
            ];
        } catch (\Exception $e) {
            \Log::error("Lỗi khi lấy dữ liệu: " . $e->getMessage());
            return [
                'success' => false,
                'message' => "Lỗi server, vui lòng thử lại sau.",
                'httpCode' => 500,
                'data' => null,
            ];
        }
    }
}