<?php

namespace App\Repositories\AffiliateContract;
// Model
use App\Models\affiliate_contract;
use App\Models\affiliate;
// random str
use Illuminate\Support\Str;
// 
use Illuminate\Support\Facades\DB;
use App\Repositories\AffiliateContract\AffiliateContractRepositoryInterface;

class AffiliateContractRepository implements AffiliateContractRepositoryInterface
{
    protected $model;

    public function __construct(affiliate_contract $affiliateContract)
    {
        $this->model = $affiliateContract;
    }

    public function createContract(array $data)
    {
        try {
            // Kiểm tra xem user có phải là affiliate không
            $affiliate = Affiliate::where('affiliate_user_id', $data['user_id'])->first();
            DB::transaction(function () use ($affiliate, $data) {
                if (!$affiliate) {
                    // Nếu chưa có, thì tạo mới
                    $affiliate = Affiliate::create([
                        'affiliate_user_id' => $data['user_id'],
                        'affiliate_code' => Str::random(length: 10), // Tạo mã ngẫu nhiên 10 ký tự
                        'affiliate_balance' => $data['contract_payment_minimum'],
                        'affiliate_create_time' => time(),
                        'affiliate_update_time' => time(),
                    ]);
                } else {
                    // Nếu đã có, chỉ cập nhật thời gian
                    $affiliate->update([
                        'affiliate_update_time' => time(),
                    ]);
                }
                $affiliate_id = $affiliate->affiliate_id;
                $data = [
                    'contract_affiliate_id' => $affiliate_id,
                    'contract_company_name' => $data['contract_company_name'],
                    'contract_partner_name' => $data['contract_partner_name'],
                    'company_sign_name' => $data['company_sign_name'],
                    'partner_sign_name' => $data['partner_sign_name'],
                    'company_sign_date' => $data['company_sign_date'],
                    'partner_sign_date' => $data['partner_sign_date'],
                    'contract_payment_date' => $data['contract_payment_date'],
                    'contract_payment_method' => $data['contract_payment_method'],
                    'contract_payment_minimum' => $data['contract_payment_minimum'],
                    'terminate_date_min' => $data['terminate_date_min'],
                    'contract_create_time' => time(),
                    'contract_update_time' => time(),
                ];
                $data = $this->model->create($data);
            });
            return [
                'success' => true,
                'message' => "Thêm thông tin thành công",
                'httpCode' => 200,
                'data' => $data,
            ];
        } catch (\Exception $e) {
            \Log::error("Lỗi khi đăng ký tài khoản: " . $e->getMessage());
            return [
                'success' => false,
                'message' => "Lỗi server, vui lòng thử lại sau.",
                'httpCode' => 500,
                'data' => null,
            ];
        }
    }

    public function deleteContract($id)
    {
        try {
            $deletedRows = $this->model->where('contracts_id', $id)->delete();

            if ($deletedRows === 0) {
                return [
                    'success' => false,
                    'message' => "Không tìm thấy hợp đồng cần xóa",
                    'httpCode' => 404,
                    'data' => null,
                ];
            }

            return [
                'success' => true,
                'message' => "Xóa dữ liệu thành công",
                'httpCode' => 200,
                'data' => null,
            ];
        } catch (\Exception $e) {
            \Log::error("Lỗi khi xóa hợp đồng: " . $e->getMessage());
            return [
                'success' => false,
                'message' => "Lỗi server, vui lòng thử lại sau.",
                'httpCode' => 500,
                'data' => null,
            ];
        }
    }

}
