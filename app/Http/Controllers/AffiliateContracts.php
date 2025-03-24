<?php
namespace App\Http\Controllers;
// import class request
use Illuminate\Http\Request;
// import Validator
use Illuminate\Support\Facades\Validator;
// 
use App\Repositories\AffiliateContract\AffiliateContractRepositoryInterface;

class AffiliateContracts extends Controller
{
    protected $AffiliateContractRepository;
    public function __construct(AffiliateContractRepositoryInterface $AffiliateContractRepository)
    {
        $this->AffiliateContractRepository = $AffiliateContractRepository;
    }
    public function create(Request $request)
    {
        try {
            // 🟢 ======= Lấy thông tin người dùng từ request =======
            $user = $request->user;
            if (!$user) {
                return response()->json(['message' => 'Không tìm thấy người dùng!'], 401);
            }
            $user_id = $user->use_id;
            $validator = Validator::make($request->all(), [
                'companyName' => 'required',
                'partnerName' => 'required',
                'company_sign_name' => 'required',
                'partner_sign_name' => 'required',
                'companySignDate' => 'nullable',
                'partnerSignDate' => 'required',
                'TerminateDateMin' => 'required',
                'paymentDate' => 'required',
                'paymentMethod' => 'required',
                'paymentMinimum' => 'required',
            ]);

            // Nếu validation thất bại, trả về lỗi
            if ($validator->fails()) {
                return apiResponse("error", "Dữ liệu không hợp lệ", $validator->errors(), false, 422);
            }
            $data = [
                'user_id' => $user_id,
                'contract_company_name' => $validator->validated()['companyName'],
                'contract_partner_name' => $validator->validated()['partnerName'],
                'company_sign_name' => $validator->validated()['company_sign_name'],
                'partner_sign_name' => $validator->validated()['partner_sign_name'],
                'company_sign_date' => strtotime($validator->validated()['companySignDate']),
                'partner_sign_date' => strtotime($validator->validated()['partnerSignDate']),
                'contract_payment_date' => $validator->validated()['paymentDate'],
                'contract_payment_method' => $validator->validated()['paymentMethod'],
                'contract_payment_minimum' => $validator->validated()['paymentMinimum'],
                'terminate_date_min' => $validator->validated()['TerminateDateMin'],
            ];
            // var_dump($data);die;
            $response = $this->AffiliateContractRepository->createContract($data);

            if ($response['success']) {
                return apiResponse('success', $response['message'], $response['data'], true, $response['httpCode']);
            } else {
                return apiResponse('error', $response['message'], $response['data'], false, $response['httpCode']);
            }
        } catch (\Exception $e) {
            // Xử lý lỗi bất ngờ
            return response()->json([
                'result' => false,
                'message' => "Lỗi hệ thống: " . $e->getMessage(),
            ], 500);
        }
    }

    public function delete(Request $request)
    {
        try {
            // 🟢 ======= Lấy thông tin người dùng từ request =======
            $user = $request->user;
            if (!$user) {
                return response()->json(['message' => 'Không tìm thấy người dùng!'], 401);
            }
            // kiểm tra validate
            $validator = Validator::make($request->all(), [
                'contracts_id' => 'required',
            ]);
            // Nếu validation thất bại, trả về lỗi
            if ($validator->fails()) {
                return apiResponse("error", "Dữ liệu không hợp lệ", $validator->errors(), false, 422);
            }
            // var_dump($data);die;
            $response = $this->AffiliateContractRepository->deleteContract($validator->validated()['contracts_id']);

            if ($response['success']) {
                return apiResponse('success', $response['message'], $response['data'], true, $response['httpCode']);
            } else {
                return apiResponse('error', $response['message'], $response['data'], false, $response['httpCode']);
            }
        } catch (\Exception $e) {
            // Xử lý lỗi bất ngờ
            return response()->json([
                'result' => false,
                'message' => "Lỗi hệ thống: " . $e->getMessage(),
            ], 500);
        }
    }

}