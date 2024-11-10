@extends('layouts.main')
@section('title', 'Trang Chủ')

@section('content')

    <div class="container min-w-full px-5 mx-auto bg-gray-50">
        @if (Session::has('message'))
            <script>
                toastr.success("{{ Session::get('message') }}");
            </script>
        @endif

        <div class="py-8">
            <h2 class="text-center text-3xl font-bold mb-8 text-gray-800 relative">
                TIN TỨC SỰ KIỆN
                <div class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-20 h-1 bg-blue-500 mt-2"></div>
            </h2>

            @php
                $news = [
                    [
                        'title' => 'Hội thảo khoa học phiên dịch giả định của sinh viên ngôn ngữ anh',
                        'date' => '28 May, 2024',
                        'excerpt' => 'Dựa trên mô hình Hội thảo Giả định của UNESCO...',
                        'image' => 'uploads/h1.jpg',
                        'link' =>
                            'https://vaa.edu.vn/hoi-thao-khoa-hoc-phien-dich-gia-dinh-cua-sinh-vien-ngon-ngu-anh/',
                    ],
                    [
                        'title' => 'Bộ phẩm chất và năng lực sinh viên tốt nghiệp Học viện Hàng không Việt Nam',
                        'date' => '1 October, 2024',
                        'excerpt' =>
                            'Nhằm cụ thể hóa tầm nhìn, sứ mạng và giá trị cốt lõi của Học viện Hàng không Việt Nam...',
                        'image' => 'uploads/h2.png',
                        'link' =>
                            'https://vaa.edu.vn/bo-pham-chat-va-nang-luc-sinh-vien-tot-nghiep-hoc-vien-hang-khong-viet-nam/',
                    ],
                    [
                        'title' => 'Khai giảng ấm áp tình người của Học viện Hàng không Việt Nam',
                        'date' => '30 September, 2024',
                        'excerpt' =>
                            'Sáng ngày 29/9/2024, Học viện Hàng không Việt Nam tổ chức Lễ Khai giảng năm học 2024-2025...',
                        'image' => 'uploads/h3.png',
                        'link' => 'https://vaa.edu.vn/khai-giang-am-ap-tinh-nguoi-cua-hoc-vien-hang-khong-viet-nam/',
                    ],
                    [
                        'title' => 'Sinh viên Học viện Hàng không hỗ trợ hành khách tại Tân Sơn Nhất dịp lễ 02/09/2024',
                        'date' => '6 September, 2024',
                        'excerpt' =>
                            'Chiến dịch Thanh niên tình nguyện dịp cao điểm Lễ Quốc Khánh được phát động bởi Đoàn Cảng hàng không Quốc tế Tân Sơn Nhất...',
                        'image' => 'uploads/h4.png',
                        'link' =>
                            'https://vaa.edu.vn/net-dep-sinh-vien-hoc-vien-hang-khong-viet-nam-khi-ho-tro-hanh-khach-tai-cang-hang-khong-quoc-te-tan-son-nhat-dip-le-quoc-khanh-02-09-2024/',
                    ],
                    [
                        'title' => 'Sinh viên Học viện Hàng không hỗ trợ hành khách tại Tân Sơn Nhất dịp lễ 02/09/2024',
                        'date' => '6 September, 2024',
                        'excerpt' =>
                            'Chiến dịch Thanh niên tình nguyện dịp cao điểm Lễ Quốc Khánh được phát động bởi Đoàn Cảng hàng không Quốc tế Tân Sơn Nhất...',
                        'image' => 'uploads/h4.png',
                        'link' =>
                            'https://vaa.edu.vn/net-dep-sinh-vien-hoc-vien-hang-khong-viet-nam-khi-ho-tro-hanh-khach-tai-cang-hang-khong-quoc-te-tan-son-nhat-dip-le-quoc-khanh-02-09-2024/',
                    ],
                    [
                        'title' => 'Sinh viên Học viện Hàng không hỗ trợ hành khách tại Tân Sơn Nhất dịp lễ 02/09/2024',
                        'date' => '6 September, 2024',
                        'excerpt' =>
                            'Chiến dịch Thanh niên tình nguyện dịp cao điểm Lễ Quốc Khánh được phát động bởi Đoàn Cảng hàng không Quốc tế Tân Sơn Nhất...',
                        'image' => 'uploads/h4.png',
                        'link' =>
                            'https://vaa.edu.vn/net-dep-sinh-vien-hoc-vien-hang-khong-viet-nam-khi-ho-tro-hanh-khach-tai-cang-hang-khong-quoc-te-tan-son-nhat-dip-le-quoc-khanh-02-09-2024/',
                    ],
                    [
                        'title' => 'Sinh viên Học viện Hàng không hỗ trợ hành khách tại Tân Sơn Nhất dịp lễ 02/09/2024',
                        'date' => '6 September, 2024',
                        'excerpt' =>
                            'Chiến dịch Thanh niên tình nguyện dịp cao điểm Lễ Quốc Khánh được phát động bởi Đoàn Cảng hàng không Quốc tế Tân Sơn Nhất...',
                        'image' => 'uploads/h4.png',
                        'link' =>
                            'https://vaa.edu.vn/net-dep-sinh-vien-hoc-vien-hang-khong-viet-nam-khi-ho-tro-hanh-khach-tai-cang-hang-khong-quoc-te-tan-son-nhat-dip-le-quoc-khanh-02-09-2024/',
                    ],
                    [
                        'title' => 'Sinh viên Học viện Hàng không hỗ trợ hành khách tại Tân Sơn Nhất dịp lễ 02/09/2024',
                        'date' => '6 September, 2024',
                        'excerpt' =>
                            'Chiến dịch Thanh niên tình nguyện dịp cao điểm Lễ Quốc Khánh được phát động bởi Đoàn Cảng hàng không Quốc tế Tân Sơn Nhất...',
                        'image' => 'uploads/h4.png',
                        'link' =>
                            'https://vaa.edu.vn/net-dep-sinh-vien-hoc-vien-hang-khong-viet-nam-khi-ho-tro-hanh-khach-tai-cang-hang-khong-quoc-te-tan-son-nhat-dip-le-quoc-khanh-02-09-2024/',
                    ],
                    [
                        'title' => 'Sinh viên Học viện Hàng không hỗ trợ hành khách tại Tân Sơn Nhất dịp lễ 02/09/2024',
                        'date' => '6 September, 2024',
                        'excerpt' =>
                            'Chiến dịch Thanh niên tình nguyện dịp cao điểm Lễ Quốc Khánh được phát động bởi Đoàn Cảng hàng không Quốc tế Tân Sơn Nhất...',
                        'image' => 'uploads/h4.png',
                        'link' =>
                            'https://vaa.edu.vn/net-dep-sinh-vien-hoc-vien-hang-khong-viet-nam-khi-ho-tro-hanh-khach-tai-cang-hang-khong-quoc-te-tan-son-nhat-dip-le-quoc-khanh-02-09-2024/',
                    ],[
                        'title' => 'Sinh viên Học viện Hàng không hỗ trợ hành khách tại Tân Sơn Nhất dịp lễ 02/09/2024',
                        'date' => '6 September, 2024',
                        'excerpt' =>
                            'Chiến dịch Thanh niên tình nguyện dịp cao điểm Lễ Quốc Khánh được phát động bởi Đoàn Cảng hàng không Quốc tế Tân Sơn Nhất...',
                        'image' => 'uploads/h4.png',
                        'link' =>
                            'https://vaa.edu.vn/net-dep-sinh-vien-hoc-vien-hang-khong-viet-nam-khi-ho-tro-hanh-khach-tai-cang-hang-khong-quoc-te-tan-son-nhat-dip-le-quoc-khanh-02-09-2024/',
                    ],
                ];
                $perPage = 8; // Số lượng bài viết hiển thị trên mỗi trang
                $page = request('page', 1); // Trang hiện tại
                $total = count($news); // Tổng số bài viết
                $newsOnPage = array_slice($news, ($page - 1) * $perPage, $perPage); // Chia nhỏ dữ liệu theo trang
            @endphp


            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                @foreach ($newsOnPage as $item)
                    <div
                        class="bg-white shadow-lg rounded-xl overflow-hidden h-[380px] flex flex-col transform transition duration-300 hover:scale-105 hover:shadow-xl">
                        <div class="relative flex-shrink-0 h-48">
                            <img src="{{ asset($item['image']) }}"
                                class="w-full h-full object-cover transition duration-300 hover:scale-110" alt="News Image">
                            <div
                                class="absolute bottom-0 left-0 bg-gradient-to-t from-black/60 to-transparent w-full h-1/2">
                            </div>
                            <p
                                class="absolute bottom-3 left-3 text-white text-sm font-medium bg-blue-600 px-3 py-1 rounded-full">
                                {{ $item['date'] }}</p>
                        </div>
                        <div class="p-5 flex flex-col flex-grow">
                            <h5 class="text-lg font-bold mb-3 line-clamp-2 group">
                                <a href="{{ $item['link'] }}"
                                    class="text-gray-800 hover:text-blue-600 transition duration-300">{{ $item['title'] }}</a>
                            </h5>
                            <p class="text-gray-600 line-clamp-3 text-sm">{{ $item['excerpt'] }}</p>
                            <div class="mt-auto pt-4">
                                <a href="{{ $item['link'] }}"
                                    class="inline-flex items-center text-sm font-medium text-blue-600 hover:text-blue-800 transition duration-300">
                                    Xem thêm
                                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-8 flex justify-center">
                @if ($page > 1)
                    <a href="?page={{ $page - 1 }}" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-800">Trang trước</a>
                @endif
                @if ($page * $perPage < $total)
                    <a href="?page={{ $page + 1 }}" class="px-4 py-2 ml-2 bg-blue-600 text-white rounded-md hover:bg-blue-800">Trang sau</a>
                @endif
            </div>

         
            </div>
        </div>
    </div>

@endsection
