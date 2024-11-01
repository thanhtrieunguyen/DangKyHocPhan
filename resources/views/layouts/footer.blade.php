<style>
    *,
    *:before,
    *:after {
        box-sizing: border-box;
    }

    .footer {
        display: flex;
        flex-flow: row wrap;
        padding: 30px 30px 20px 30px;
        color: #2f2f2f;
        background-color: #fff;
        border-top: 1px solid #e5e5e5;
    }

    .footer>* {
        flex: 1 100%;
    }

    .footer__addr {
        margin-right: 1.25em;
        margin-bottom: 2em;
    }

    .footer__logo {
        font-family: 'Pacifico', cursive;
        font-weight: 400;
        text-transform: lowercase;
        font-size: 1.5rem;
    }

    .footer__addr h2 {
        margin-top: 1.3em;
        font-size: 15px;
        font-weight: 400;
    }

    .nav__title {
        font-weight: 400;
        font-size: 15px;
    }

    .footer address {
        font-style: normal;
        color: #999;
    }

    .footer__btn {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 36px;
        max-width: max-content;
        background-color: rgb(33, 33, 33, 0.07);
        border-radius: 100px;
        color: #2f2f2f;
        line-height: 0;
        margin: 0.6em 0;
        font-size: 1rem;
        padding: 0 1.3em;
    }

    .footer ul {
        list-style: none;
        padding-left: 0;
    }

    .footer li {
        line-height: 2em;
    }

    .footer a {
        text-decoration: none;
    }

    .footer__nav {
        display: flex;
        flex-flow: row wrap;
    }

    .footer__nav>* {
        flex: 1 50%;
        margin-right: 1.25em;
    }

    .nav__ul a {
        color: #999;
    }

    .nav__ul--extra {
        column-count: 2;
        column-gap: 1.25em;
    }

    .legal {
        display: flex;
        flex-wrap: wrap;
        color: #999;
    }

    .legal__links {
        display: flex;
        align-items: center;
    }

    .heart {
        color: #2f2f2f;
    }

    @media screen and (min-width: 24.375em) {
        .legal .legal__links {
            margin-left: auto;
        }
    }

    @media screen and (min-width: 40.375em) {
        .footer__nav>* {
            flex: 1;
        }

        .nav__item--extra {
            flex-grow: 2;
        }

        .footer__addr {
            flex: 1.5 0px;
        }

        .footer__nav {
            flex: 2 0px;
        }
    }
</style>
<footer class="footer">
    <div class="footer__addr">
        <div class="hd-logo"
            style="
                        display: flex;
                        flex-direction: row;
                        align-items: center;
                    ">
            <a href="#" class="custom-logo-link" rel="home" itemprop="url" style="margin-right: 10px">
                <div class="icon" style="
                            width: fit-content;
                        ">
                    <img width="60" height="86" src="https://vaa.edu.vn/wp-content/uploads/2024/05/vaa.svg"
                        class="header-logo-image" alt="" decoding="async">
                </div>
            </a>
            <a class="logo-txt font-second" href="/trangchu" style="font-size: 1rem">HỌC VIỆN HÀNG KHÔNG
                VIỆT NAM<br>VIETNAM AVIATION ACADEMY </a>
        </div>
        <address>
            Cơ sở chính: 104 Nguyễn Văn Trỗi, P.8, Q. Phú Nhuận, TP.HCM, VN.<br>
            Cơ sở 2: 18A/1 Cộng Hòa, P.4, Q. Tân Bình, TP.HCM, VN.<br>

            <a class="footer__btn" href="mailto:example@gmail.com">Email Us</a>
        </address>
    </div>

    <ul class="footer__nav">
        <li class="nav__item">
            <h2 class="nav__title">Media</h2>

            <ul class="nav__ul">
                <li>
                    <a href="#">Online</a>
                </li>

                <li>
                    <a href="#">Print</a>
                </li>

                <li>
                    <a href="#">Alternative Ads</a>
                </li>
            </ul>
        </li>

        <li class="nav__item nav__item--extra">
            <h2 class="nav__title">Technology</h2>

            <ul class="nav__ul nav__ul--extra">
                <li>
                    <a href="#">Hardware Design</a>
                </li>

                <li>
                    <a href="#">Software Design</a>
                </li>

                <li>
                    <a href="#">Digital Signage</a>
                </li>

                <li>
                    <a href="#">Automation</a>
                </li>

                <li>
                    <a href="#">Artificial Intelligence</a>
                </li>

                <li>
                    <a href="#">IoT</a>
                </li>
            </ul>
        </li>

        <li class="nav__item">
            <h2 class="nav__title">Legal</h2>

            <ul class="nav__ul">
                <li>
                    <a href="#">Privacy Policy</a>
                </li>

                <li>
                    <a href="#">Terms of Use</a>
                </li>

                <li>
                    <a href="#">Sitemap</a>
                </li>
            </ul>
        </li>
    </ul>

    <div class="legal">
        <p>&copy; 2024 Something. All rights reserved.</p>

        <div class="legal__links">
            <span>Made with <span class="heart">♥</span> remotely from Anywhere</span>
        </div>
    </div>

    <script>
        function confirmDelete(url) {
            Swal.fire({
                title: 'Bạn có chắc chắn?',
                text: "Hành động này sẽ xóa đăng ký môn học này!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Có, xóa nó!',
                cancelButtonText: 'Không, hủy bỏ!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Nếu xác nhận, gửi yêu cầu xóa
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = url;
    
                    const csrfToken = document.createElement('input');
                    csrfToken.type = 'hidden';
                    csrfToken.name = '_token';
                    csrfToken.value = '{{ csrf_token() }}'; // Thay thế với token của bạn
    
                    const methodField = document.createElement('input');
                    methodField.type = 'hidden';
                    methodField.name = '_method';
                    methodField.value = 'DELETE';
    
                    form.appendChild(csrfToken);
                    form.appendChild(methodField);
                    document.body.appendChild(form);
                    form.submit();
                }
            });
        }
    </script>
</footer>
