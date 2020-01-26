<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <ul class="nav side-menu">
                  <li><a href=" {{ route("shop.index") }} "><i class="fa fa-home"></i> Home</a> </li>
                  <li><a href=" {{ route("shop.favorits") }} "><i class="fa fa-heart"></i> My Preferred </a></li>
                  <li><a href=" {{ route("shop.blacklist") }}" ><i class="fa fa-ban"></i> My Blacklist </a> </li>
                </ul>
              </div>
</div>

<!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="{{ route("logout") }}">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
<!-- /menu footer buttons -->