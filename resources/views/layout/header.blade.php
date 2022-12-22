<div class="header">
    <table class="tbheader">
        <tr>
            <td class="tdlgchu">
                <div class="logochu">
                    <a href="{{route('home.index')}}">
                        <img src="{{ asset('image/LOGO CHỮ.jpg') }}" class="imglogochu" alt="Logo chữ">
                    </a>
                </div>
            </td>
            <td class="tdacc">
                <div class="useracc">
{{--                    <a href="{{route('home.index')}}">--}}
{{--                        <img src="{{ asset('image/icon account.png') }}" class="imgacc" alt="icon account">--}}
{{--                    </a>--}}
                </div>
            </td>
            <td class="tddndk">
                <div class="dndk">
                    @if(auth()->check() && auth()->user()->role === 0)
                        <a href="{{ route('user.profile.info') }}" class="link">
                            <img src="{{ asset('image/icon account.png') }}" class="imgacc" alt="icon account">
                            {{auth()->user()->username}}
                        </a>
                    @elseif(auth()->check() && auth()->user()->role === 1)
                        <a href="{{ route('admin.home.index') }}" class="link">
                            <img src="{{ asset('image/icon account.png') }}" class="imgacc" alt="icon account">
                            {{auth()->user()->username}}
                        </a>
                    @else
                        <a href="{{ route('register') }}" class="link" title="Dang Ky">ĐĂNG KÝ</a><span class="sep">|</span><a href="{{ route('login') }}" class="link" title="Dang Nhap">ĐĂNG NHẬP</a>
                    @endauth
                </div>
            </td>
        </tr>
    </table>
</div>
<div class="khunggiohang">
    <table class="tbkhunggiohang">
        <tr>
            <td class="tdlghinh">
                <div class="logohinh">
                    <a href="{{route('home.index')}}">
                        <img src="{{ asset('image/LOGO HÌNH.png') }}" class="imglogohinh" alt="logo hình">
                    </a>
                </div>
            </td>
            <td class="tdonline">
                <div class="online">
                    <div class="shoptruyentranh">
                        <a href="{{route('home.index')}}" class="hrefonline">
                            SHOP<br> TRUYỆN<br> TRANH<br> ONLINE
                        </a>
                    </div>
                </div>
            </td>
            <td class="tdthanhtimkiem">
                <div class="thanhtimkiem">
                    <p>
                        <div class="search">
                            <form action="{{route('home.search')}}">
                                <input type="search" name="q" placeholder="Tìm kiếm" class="inputsearch"
                                       @if(isset($search))value="{{ $search }}"
                                       @endif
                                >
                                <button class="btnsearch">
                                    Tìm kiếm
                                </button>
                            </form>
                        </div>
                    </p>
                </div>
            </td>
            <td class="tdcart">
                <div class="cart">
                    <label>
                        <a href="{{ route('user.cart.index')}}" style="color: #1a202c">
                            <i class="fa-solid fa-cart-shopping"></i>
                        </a>
                    </label>
                    <div class="spansl">
                        @if(auth()->check() && auth()->user()->role === 0 && auth()->user()->user->cart)
                            <span class="soluongmua">{{ auth()->user()->user->cart->total_product }}</span>
                        @else
                            <span class="soluongmua">0</span>
                        @endif
                    </div>
                </div>
            </td>
        </tr>
    </table>
</div>
<div class="menu">
    <table class="tbmenu">
        <tr>
            <td class="tdtrangchu">
                <a href="{{route('home.index')}}" class="trangchu">
                    TRANG CHỦ
                </a>
            </td>
            <td class="tdsanpham">
                <a href="{{route('home.search')}}" class="sanpham">
                    SẢN PHẨM
                </a>
            </td>
            <td class="tdcollection">
                <a href="{{route('home.get-collection')}}" class="collection">
                    COLLECTION
                </a>
            </td>
            <td class="tdhotdeals">
                <a href="{{route('home.get-hot-deal')}}" class="hotdeals">
                    HOT DEALS
                </a>
            </td>
            <td class="tdtintuc">
                <a href="{{route('home.articles.index')}}" class="tintuc">
                    TIN TỨC
                </a>
            </td>
        </tr>
    </table>
</div>
