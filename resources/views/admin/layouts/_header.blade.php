<nav class="navbar navbar-default top-navbar" role="navigation">
  <div class="navbar-header">
    <a class="navbar-brand" href="index.html"><i class="fa fa-comments"></i> <strong>View</strong></a>
  </div>

  <ul class="nav navbar-top-links navbar-right">
    <li class="dropdown">
      <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
          {{ Auth::user() ->name }}
      </a>
      <ul class="dropdown-menu dropdown-user">
          <li>
            <a href="{{ route('admin.logout') }}"><i class=""></i> Logout</a>
          </li>
      </ul>
    </li>
  </ul>
</nav>
