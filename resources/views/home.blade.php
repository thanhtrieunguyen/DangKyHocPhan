@extends('layouts.main')
@section('title', 'Trang Chủ')

@section('content')
    <div class="container">
        <div class="container mx-auto">
            @if (Session::has('message'))
                <script>
                    toastr.success("{{ Session::get('message') }}");
                </script>
            @endif
    
            <div class="py-5">
                <h2 class="text-center text-2xl font-bold mb-4">TIN TỨC SỰ KIỆN</h2>
    
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="bg-white shadow-md rounded-lg overflow-hidden">
                        <img src="{{ asset('uploads/h1.jpg') }}" class="w-full h-48 object-cover" alt="News 1 Image">
                        <div class="p-4">
                            <h5 class="text-lg font-bold">
                                <a
                                    href="https://vaa.edu.vn/hoi-thao-khoa-hoc-phien-dich-gia-dinh-cua-sinh-vien-ngon-ngu-anh/">Hội
                                    thảo khoa học phiên dịch giả định của sinh viên ngôn ngữ anh</a>
                            </h5>
                            <p class="text-gray-500">28 May, 2024</p>
                            <p class="text-gray-700">Dựa trên mô hình Hội thảo Giả định (Mock Conference) của UNESCO, Hội
                                thảo khoa học phiên dịch giả định đã đem đến cho sinh viên Ngôn ngữ Anh một sân chơi học
                                thuật sôi động vào sáng nay 15/4/2024...</p>
                        </div>
                    </div>
    
                    <div class="bg-white shadow-md rounded-lg overflow-hidden">
                        <img src="{{ asset('uploads/h2.png') }}" class="w-full h-48 object-cover" alt="News 2 Image">
                        <div class="p-4">
                            <h5 class="text-lg font-bold">
                                <a
                                    href="https://vaa.edu.vn/bo-pham-chat-va-nang-luc-sinh-vien-tot-nghiep-hoc-vien-hang-khong-viet-nam/">BỘ
                                    PHẨM CHẤT VÀ NĂNG LỰC SINH VIÊN TỐT NGHIỆP HỌC VIỆN HÀNG KHÔNG VIỆT NAM</a>
                            </h5>
                            <p class="text-gray-500">1 October, 2024</p>
                            <p class="text-gray-700">Nhằm cụ thể hóa tầm nhìn, sứ mạng và giá trị cốt lõi của Học viện Hàng
                                không Việt Nam trong đào tạo nguồn nhân lực...</p>
                        </div>
                    </div>
    
                    <div class="bg-white shadow-md rounded-lg overflow-hidden">
                        <img src="{{ asset('uploads/h3.png') }}" class="w-full h-48 object-cover" alt="News 3 Image">
                        <div class="p-4">
                            <h5 class="text-lg font-bold">
                                <a
                                    href="https://vaa.edu.vn/le-khai-giang-am-ap-tinh-nguoi-cua-hoc-vien-hang-khong-viet-nam/">LỄ
                                    KHAI GIẢNG ẤM ÁP TÌNH NGƯỜI CỦA HỌC VIỆN HÀNG KHÔNG VIỆT NAM</a>
                            </h5>
                            <p class="text-gray-500">30 September, 2024</p>
                            <p class="text-gray-700">Sáng ngày 29/9/2024, Học viện Hàng không Việt Nam tổ chức Lễ Khai giảng
                                năm học 2024-2025 với sự tham dự của các bậc phụ huynh...</p>
                        </div>
                    </div>
                    <div class="bg-white shadow-md rounded-lg overflow-hidden">
                        <img src="{{ asset('uploads/h4.png') }}" class="w-full h-48 object-cover" alt="News 4 Image">
                        <div class="p-4">
                            <h5 class="text-lg font-bold">
                                <a
                                    href="https://vaa.edu.vn/net-dep-sinh-vien-hoc-vien-hang-khong-viet-nam-khi-ho-tro-hanh-khach-tai-cang-hang-khong-quoc-te-tan-son-nhat-dip-le-quoc-khanh-02-09-2024/">Nét
                                    đẹp sinh viên Học viện Hàng không Việt Nam khi hỗ trợ hành khách tại cảng hàng không
                                    quốc tế Tân Sơn Nhất dịp lễ Quốc khánh 02/09/2024</a>
                            </h5>
                            <p class="text-gray-500">6 September, 2024</p>
                            <p class="text-gray-700">Chiến dịch Thanh niên tình nguyện dịp cao điểm Lễ Quốc Khánh được phát
                                động bởi Đoàn Cảng hàng không Quốc tế Tân Sơn Nhất...</p>
                        </div>
                    </div>
                    
                </div>
            </div>
    
        </div>
    </div>
@endsection
    
