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
            <a class="logo-txt font-second" href="/admin" style="font-size: 1.5rem">HỌC VIỆN HÀNG KHÔNG
                VIỆT NAM<br>VIETNAM AVIATION ACADEMY </a>
        </div>
        <!-- menu bar -->
        <div id="menu">
            <a href="/admin">Trang Chủ</a> |
            <a href="/quanly-sinhvien">Quản lý sinh viên</a> |
            <a href="/quanly-monhoc">Quản lý môn học</a> |
            <a href="/quanly-khoa">Quản lý khoa</a> |
            <a href="/quanly-lop">Quản lý lớp</a> |
            <a href="#">Admin</a> -
            <form action="{{ route('logout') }}" method="POST" style="display:inline;" onsubmit="return confirm('Bạn có chắc chắn muốn đăng xuất không?');">
                @csrf
                <button type="submit"
                    style="background: none; font-size: 16.5px; border: none; color: white; cursor: pointer;">Đăng
                    Xuất</button>
            </form>
        </div>
    </div>
