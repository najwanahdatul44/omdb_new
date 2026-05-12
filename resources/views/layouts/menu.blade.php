<div class="main-sidebar sidebar-style-2">
  <aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <a href="index.html">Najwa Web</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
      <a href="index.html">St</a>
    </div>
    <ul class="sidebar-menu">
      <li class="menu-header">{{ __('menu.dashboard') }}</li>
      <li class="dropdown active">
        <a href="#" class="nav-link has-dropdown">
          <i class="fas fa-fire"></i>
          <span>{{ __('menu.movies') }}</span>
        </a>
        <ul class="dropdown-menu">
          <li><a class="nav-link" href="/search">{{ __('menu.search_movie') }}</a></li>
          <li><a class="nav-link" href="/favorites">{{ __('menu.my_favorites') }}</a></li>
        </ul>
      </li>
    </ul>
  </aside>
</div>