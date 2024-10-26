<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <style>
        #menu {
            font-family: 'Montserrat', serif !important;
            font-size: 18px;
            color: white;
            background-color: #002244;
            height: 50px;
            text-align: right;
            display: flex;
            flex-wrap: nowrap;
            flex-direction: row;
            align-items: center;
            justify-content: space-evenly
        }

        #menu a {
            color: white;
            padding: 5px;
            text-decoration: none;
            text-align: center;
            right: 5px;
            font-size: 16.5px;
            font-family: var(--font-family);
        }

        a {
            text-decoration: none;
        }

        .hd-logo a:hover {
            text-decoration: none
        }

        :root {
            --font-family: 'Montserrat', serif;
        }

        body {
            font-family: var(--font-family);
        }
    </style>
    <link rel="stylesheet" href="{{ asset('css/main1.css') }}">
</head>

<body>
    <div>
        <div class="hd-logo"
            style="
                        background-color: #002244;
                        display: flex;
                        flex-direction: row;
                        align-items: center;
                        padding: 10px
                    ">
            <a href="#" class="custom-logo-link" rel="home" itemprop="url" style="margin-right: 10px">
                <div class="icon" style="
                            width: fit-content;
                        ">
                    <img width="90" height="86" src="https://vaa.edu.vn/wp-content/uploads/2024/05/vaa.svg"
                        class="header-logo-image" alt="" decoding="async">
                </div>
            </a>
            <a class="logo-txt font-second" href="/trangchu" style="font-size: 1.5rem">HỌC VIỆN HÀNG KHÔNG
                VIỆT NAM<br>VIETNAM AVIATION ACADEMY </a>
        </div>
        <!-- menu bar -->
        <div id="menu">
            <a href="/trangchu">Trang Chủ</a> |
            <a href="/dangky">Đăng ký học phần</a> |
            <a href="/ketqua-dangky">Kết quả đăng ký</a> |
            <a href="/profile">{{ $sinhvien->hoten }}</a> -
            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit"
                    style="background: none; font-size: 16.5px; border: none; color: white; cursor: pointer;">Đăng
                    Xuất</button>
            </form>
        </div>
    </div>

</body>

</html>
