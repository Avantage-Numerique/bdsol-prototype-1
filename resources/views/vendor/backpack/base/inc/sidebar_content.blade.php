
<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>

<li class="nav-title"><i class="nav-icon la la-sitemap"></i> @lang('menu.entities')</li>

<li class="nav-item"><a class="nav-link" href="{{ backpack_url('personnes') }}"><i class="nav-icon la la-user"></i> @lang('menu.persons')</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('organisations') }}'><i class='nav-icon la la-users'></i> @lang('menu.organisations')</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('equipes') }}'><i class='nav-icon la la-user-friends'></i> @lang('menu.teams')</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('projets') }}'><i class='nav-icon la la-project-diagram'></i> @lang('menu.projects')</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('evenements') }}'><i class='nav-icon la la-calendar-day'></i> @lang('menu.events')</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('lieux') }}'><i class='nav-icon la la-map-marked'></i> @lang('menu.places')</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('competences') }}'><i class='nav-icon la la-stream'></i> @lang('menu.skills')</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('equipements') }}'><i class='nav-icon la la-microchip'></i> @lang('menu.equipments')</a></li>


<hr>
<li class="nav-title"><i class="nav-icon la la-tags"></i> @lang('menu.categorisation')</li>

<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-tags"></i> @lang('menu.categories')</a>
    <ul class="nav-dropdown-items">
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('services') }}'><i class='nav-icon la la-concierge-bell'></i> @lang('menu.services')</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('occupations') }}'><i class='nav-icon la la-glasses'></i> @lang('menu.occupations')</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('roles-de-personne') }}'><i class='nav-icon la la-user-tag'></i> @lang('menu.roles-de-personne')</a></li>
    </ul>
</li>
<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-table"></i> @lang('menu.datas')</a>
    <ul class="nav-dropdown-items">
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('methodes-de-contact') }}'><i class='nav-icon la la-envelope'></i> @lang('menu.contact-methods')</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('identifiants') }}'><i class='nav-icon la la-id-card'></i> @lang('menu.identifiers')</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('langues') }}'><i class='nav-icon la la-language'></i> @lang('menu.languages')</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('formes-juridique') }}'><i class='nav-icon la la-question'></i> @lang('menu.juridic-forms')</a></li>
    </ul>
</li>

@if (backpack_user()->hasPermissionTo('manage users'))
<hr>
<li class="nav-title"><i class="nav-icon la la-cogs"></i> @lang('menu.administration')</li>

<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-cog"></i> @lang('menu.tools')</a>
    <ul class="nav-dropdown-items">

    </ul>
</li>
@endif

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
