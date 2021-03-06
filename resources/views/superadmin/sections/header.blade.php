<div class="d-flex">
              <a class="header-brand" href="{{ route('superadmin.home') }}">
                <img src="https://via.placeholder.com/232x68" class="header-brand-img" alt="tabler logo">
              </a>
              <div class="d-flex order-lg-2 ml-auto">
                
                <div class="dropdown d-none d-md-flex">
                  <a class="nav-link icon" data-toggle="dropdown">
                    <i class="fe fe-bell"></i>
                    <span class="nav-unread"></span>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                    <a href="#" class="dropdown-item d-flex">                      
                      <span class="avatar mr-3 align-self-center" style="background-image: url(/images/demo/faces/male/41.jpg)"></span>
                      <div>
                        <strong>Nathan</strong> pushed new commit: Fix page load performance issue.
                        <div class="small text-muted">10 minutes ago</div>
                      </div>
                    </a>
                    <a href="#" class="dropdown-item d-flex">
                      <span class="avatar mr-3 align-self-center" style="background-image: url(/images/demo/faces/female/1.jpg)"></span>
                      <div>
                        <strong>Alice</strong> started new task: Tabler UI design.
                        <div class="small text-muted">1 hour ago</div>
                      </div>
                    </a>
                    <a href="#" class="dropdown-item d-flex">
                      <span class="avatar mr-3 align-self-center" style="background-image: url(/images/demo/faces/female/18.jpg)"></span>
                      <div>
                        <strong>Rose</strong> deployed new version of NodeJS REST Api V3
                        <div class="small text-muted">2 hours ago</div>
                      </div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item text-center">Mark all as read</a>
                  </div>
                </div><!-- //dropdown d-none d-md-flex -->
                  
                <div class="dropdown">
                  <a href="#" class="nav-link pr-0 leading-none" data-toggle="dropdown">
                    @if(Auth::guard('superadmin')->user()->avatar == "" || Auth::guard('superadmin')->user()->avatar == null)
                      
                      <span class="avatar avatar-{{ avatar_colors(Auth::guard('superadmin')->user()->id) }}">{{ getinitial(Auth::guard('superadmin')->user()->name) }}</span>
                    @else
                    <span class="avatar" style="background-image: url('/images/avatar/128/{{ Auth::guard('superadmin')->user()->avatar }}') ">
                    </span>
                    @endif
                    
                    <span class="ml-2 d-none d-lg-block">
                      <span class="text-default">{{ Auth::guard('superadmin')->user()->name }}</span>
                      <small class="text-muted d-block mt-1">Superadmin</small>
                    </span>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                    <a class="dropdown-item" href="{{ route('superadmin.profile') }}">
                      <i class="dropdown-icon fe fe-user"></i> Profile
                    </a>
                    <!--a class="dropdown-item" href="#">
                      <i class="dropdown-icon fe fe-settings"></i> Settings
                    </a>
                    <a class="dropdown-item" href="#">
                      <span class="float-right"><span class="badge badge-primary">6</span></span>
                      <i class="dropdown-icon fe fe-mail"></i> Inbox
                    </a>
                    <a class="dropdown-item" href="#">
                      <i class="dropdown-icon fe fe-send"></i> Message
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">
                      <i class="dropdown-icon fe fe-help-circle"></i> Need help?
                    </a -->
                    <a class="dropdown-item" href="{{ route('superadmin.logout') }}" 
                    onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                      <i class="dropdown-icon fe fe-log-out"></i> Sign out                    
                    </a>
                    <form id="logout-form" action="{{ route('superadmin.logout') }}" method="POST" style="display: none;">
                      @csrf
                    </form>
                  </div>
                </div><!-- //dropdown -->
              </div>
              <a href="#" class="header-toggler d-lg-none ml-3 ml-lg-0" data-toggle="collapse" data-target="#headerMenuCollapse">
                <span class="header-toggler-icon"></span>
              </a>
            </div><!-- //d-flex -->