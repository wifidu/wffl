<nav class="navbar navbar-expand-lg navbar-light  navbar-static-top">
  <div class="container">
    <a class="navbar-brand" href="{{ url('/') }}">
      wffl
    </a>
  </div>
  <button class="navbar-toggler" type="button" data-toggle="collapse" 
    data-target="#navbarSupportedContent">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div id="navbarSupportedContent" class="collapse navbar-collapse">
    <ul class="navbar-nav mr-auto">

    </ul>

    <form class="form-inline my-2 my-lg-0 mr-4">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
    <ul class="navbar-nav navbar-right">
      <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">登录</a></li>
      <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">注册</a></li>
    </ul>
  </div>
</nav>
