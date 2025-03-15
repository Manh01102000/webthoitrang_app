<nav class="management-order-nav">
    <ul class="management-order-top">
        <li class="menu-management-order active-management-order">
            <a class="management-order-title font_s15 line_h500 font_w500 cl_000" href="/quan-ly-don-hang">
                Quản lý đơn hàng ({{ $dataAll['CountOrderAll'] }})
            </a>
        </li>
        <li class="menu-management-order">
            <a class="management-order-title font_s15 line_h500 font_w500 cl_000" href="/quan-ly-don-hang/dang-xu-ly">
                Đang xử lý ({{ $dataAll['Count_OrderIsProcessing'] }})
            </a>
        </li>
        <li class="menu-management-order">
            <a class="management-order-title font_s15 line_h500 font_w500 cl_000" href="/quan-ly-don-hang/dang-giao-hang">
                Đang giao hàng ({{ $dataAll['Count_OrderIsBeingDelivered'] }})
            </a>
        </li>
        <li class="menu-management-order">
            <a class="management-order-title font_s15 line_h500 font_w500 cl_000" href="/quan-ly-don-hang/da-huy">
                Đã hủy ({{ $dataAll['Count_OrderHasBeenCancelled'] }})
            </a>
        </li>
        <li class="menu-management-order">
            <a class="management-order-title font_s15 line_h500 font_w500 cl_000" href="/quan-ly-don-hang-ban/da-giao">
                Đã giao ({{ $dataAll['Count_OrderHasBeenDelivered'] }})
            </a>
        </li>
        <li class="menu-management-order">
            <a class="management-order-title font_s15 line_h500 font_w500 cl_000" href="/quan-ly-don-hang-ban/hoan-tat">
                Hoàn tất ({{ $dataAll['Count_OrderCompleted'] }})
            </a>
        </li>
    </ul>
</nav>