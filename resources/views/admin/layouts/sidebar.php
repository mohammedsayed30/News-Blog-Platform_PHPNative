<div class="container-fluid">
  <div class="row">
  <div class="sidebar border border-right col-md-3 col-lg-2 p-0 bg-body-tertiary">
      <div class="offcanvas-md offcanvas-end bg-body-tertiary" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title" id="sidebarMenuLabel">Company name</h5>
          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto">
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link d-flex align-items-center gap-2 active" aria-current="page" href="#">
                {{trans('admin.dashboard')}}
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link d-flex align-items-center gap-2" href="{{ aurl('categories') }}">
              {{ trans('admin.categories') }}<i class="fa-solid fa-rectangle-list"></i>
              </a>
            </li>            
            <li class="nav-item">
              <a class="nav-link d-flex align-items-center gap-2" href="{{ aurl('news') }}">
              {{ trans('admin.news') }} <i class="fa-regular fa-newspaper"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link d-flex align-items-center gap-2" href="{{ aurl('comments') }}">
              {{ trans('admin.comments') }} <i class="fa-regular fa-comments"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link d-flex align-items-center gap-2" href="{{ aurl('users') }}">
              {{ trans('admin.users') }} <i class="fa-solid fa-users"></i>
              </a>
            </li>

 
 
          </ul>

          <hr class="my-3">

          <ul class="nav flex-column mb-auto">
            <li class="nav-item">
              <a class="nav-link d-flex align-items-center gap-2 " href="#">
                {{ trans('admin.settings') }} <i class="fa-solid fa-gear"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link d-flex align-items-center gap-2" href="{{ url('admin/logout') }}">
              {{ trans('admin.logout') }} <i class="fa-solid fa-arrow-right-from-bracket"></i>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>

