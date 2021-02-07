<nav class="navbar navbar-default" style="border-radius: 0;background-color: #ED454D;border:#ED454D;">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar" style="color: white">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand white" href="#" style="color: yellow;font-weight: bold">kurye.live</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <li class="{{ (request()->is('company/orders')) ? 'active' : '' }}"><a href="{{route('company-homepage')}}" style="color:#fff;">Siparişler</a></li>
                <li  class="{{ (request()->is('company/couriers')) ? 'active' : '' }}"><a href="{{route('company-couriers')}}" style="color: white">Kurye Yönetimi</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">

                <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="color: white;font-weight: bold"><span class="glyphicon glyphicon-log-in"></span> Çıkış</a></li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </ul>
        </div>
    </div>
</nav>
