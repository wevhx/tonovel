  <div id="fb-root"></div> 
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="{{url('/')}}"><i class="glyphicon glyphicon-tree-conifer gly-xmas"></i> Tonovel.co<small style="font-size: 10px;position:absolute;left: 110px;top: 3px;">Alpha</small></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-left">
    <li><a href="{{url('/novel')}}" title="Index"><i class="glyphicon glyphicon-list-alt"></i> Index</a></li>
      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="glyphicon glyphicon-stats"></i> Ranking
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="{{url('/ranking/novel')}}"><i class="glyphicon glyphicon-book"></i> Novel</a></li>
          <li><a href="{{url('/ranking/people')}}"><i class="glyphicon glyphicon-record"></i> People</a></li>
          <li><a href="{{url('/ranking/user')}}"><i class="glyphicon glyphicon-user"></i> User</a></li>
        </ul>
      </li>
    </ul>
          <ul class="nav navbar-nav navbar-right">
    <li><a href="{{url('/r')}}" title="Random"><i class="icon glyphicon glyphicon-random"></i> <span class="labeled-top">Random</span></a></li>
         @guest
        <li><a href="{{url('/login')}}" title="Home"><i class="glyphicon glyphicon-user"></i> Akun</a></li>
                        @else
                            <li class="dropdown {{ Request::is('user/*','home') ? "active" : ""}}">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    <img src="{{ ToNovel::imggo('user',2,Auth::user()->userimg) }}" style="width:32px; height:32px; position:absolute; top:10px; left:4px; border-radius:50%" class="miniled-top"><label class="badge-level miniled-top"><small>LV.{{ToNovel::exp(Auth::user()->total_exp)['level']}}</small></label> <span class="labeled-top">{{ ucfirst(Auth::user()->name) }}</span> <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                 <li><span>Hi, <b>{{ ucfirst(Auth::user()->name) }}</b></span></li> 
                                 <li><span>Total Poin : <b>{{ ucfirst(Auth::user()->total_exp) }}</b> <i class="glyphicon glyphicon-tint red-d"></i></span></li> 
                                    <li><a href="{{route('home')}}" title="Daftar Library">Daftar Library</a></li>
                                    <li><a href="{{route('changePassword')}}" title="Pengaturan">Pengaturan</a></li>
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" title="Keluar">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
          </ul><ul class="nav navbar-nav navbar-right" id="search-nav">
<form class="navbar-form navbar-right" role="search" action="{{url('/search')}}">
<div class="form-group">
<input type="text" autocomplete="off" class="app-control search-navbar" id="search" placeholder="Cari" value="" name="s">
<div class="search-suggest" style="display:none;"><p class="search-helper" style="text-align:center;padding:3px">MINIMAL 3 HURUF</p></div>
</div>
</form>
</ul>
        </div><!--/.nav-collapse -->
      </div>
      <co id="headku"/>
    </nav>