<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DonHang;

class DonHangAdminController extends Controller
{
    public function index()
    {
        $orders = DonHang::with(['nguoiDung'])
            ->orderByDesc('MaDonHang')
            ->get();

        return view('admin.orders.index', compact('orders'));
    }
     public function destroy($id)
    {
        $order = DonHang::findOrFail($id);

        if ($order->TrangThaiDonHang !== 'DaHuy') {
            return redirect()
                ->back()
                ->with('error', 'Chỉ được xóa đơn hàng đã bị hủy');
        }

        $order->delete();

        return redirect()
            ->back()
            ->with('success', 'Đã xóa đơn hàng');
    }
    public function updateStatus(Request $request, $id)
    {
        $order = DonHang::findOrFail($id);

        $current = $order->TrangThaiDonHang;
        $new = $request->TrangThaiDonHang;

        $allowed = [
            'ChoXuLy'  => ['DangGiao', 'DaHuy'],
            'DangGiao' => ['DaGiao'],
        ];

        if (!isset($allowed[$current]) || !in_array($new, $allowed[$current])) {
            return redirect()->back();
        }

        $order->TrangThaiDonHang = $new;
        $order->save();

        return redirect()->back();
    }
}
