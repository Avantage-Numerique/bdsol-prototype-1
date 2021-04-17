<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>


<li class="nav-item"><a class="nav-link" href="{{ backpack_url('personnes') }}"><i class="nav-icon la la-user"></i> <span>@lang('menu.persons')</span></a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('organisations') }}'><i class='nav-icon la la-users'></i> @lang('menu.organisations')</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('projets') }}'><i class='nav-icon la la-project-diagram'></i> @lang('menu.projects')</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('evenements') }}'><i class='nav-icon la la-calendar-day'></i> @lang('menu.events')</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('lieux') }}'><i class='nav-icon la la-map-marked'></i> @lang('menu.places')</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('competences') }}'><i class='nav-icon la la-stream'></i> @lang('menu.skills')</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('equipements') }}'><i class='nav-icon la la-microchip'></i> @lang('menu.equipments')</a></li>

<!-- Users, Roles, Permissions -->
@if (backpack_user()->hasPermissionTo('manage users'))
<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-users"></i> @lang('auth.authentication')</a>
    <ul class="nav-dropdown-items">
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('user') }}"><i class="nav-icon la la-user"></i> <span>@lang('auth.users')</span></a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('role') }}"><i class="nav-icon la la-id-badge"></i> <span>@lang('auth.roles')</span></a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('permission') }}"><i class="nav-icon la la-key"></i> <span>@lang('auth.permissions')</span></a></li>
    </ul>
</li>
@endif


