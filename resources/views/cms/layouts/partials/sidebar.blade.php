<?php
$current_url_slug = slugURL();
?>
<div class="sidebar sidebar-collapse" id="sidebar">
    <div class="sidebar__menu-group">
        <ul class="sidebar_nav">
            <li class="menu-title">
                <span>Main menu</span>
            </li>
            @foreach (collect(config('menu'))->sortBy('sort') as $key => $params)
            @if (isset($params['route']))
                @if (!Permission::has($params['route']))
                    @continue
                @endif
            @endif
            <?php
            $active = false;
            $open = false;
            if (isset($params['submenu'])) {
                foreach ($params['submenu'] as $sub) {
                    $sub_url = menuUrl($sub);
                    if (slugURL($sub_url) == $current_url_slug) {
                        $open = true;
                    }
                }
            }
            if (slugURL(menuUrl($params)) == $current_url_slug) {
                $active = true;
            }
            ?>
            <li class="{{ isset($params['submenu']) ? 'has-child ' . ($open ? 'open' : '') : '' }}">
                <a href="{{ menuUrl($params) }}" class="ajax-priority {{ $active ? 'active' : '' }}" {!! isset($params['new_tab']) ? 'target="_blank"' : '' !!}>
                    <span data-feather="{{ isset($params['icon']) ? $params['icon'] : '' }}" class="nav-icon"></span>
                    <span class="menu-text">{{ $params['title'] ?? '-' }}</span>
                    @if (isset($params['submenu']))
                    <span class="toggle-icon"></span>
                    @endif
                </a>
                @if (isset($params['submenu']))
                <ul>
                    @foreach (collect($params['submenu'])->sortBy('sort') ?? [] as $key_sub => $sub_param)
                    @if (!Permission::has($sub_param['route']))
                        @continue
                    @endif
                    <?php
                    $active = false;
                    $open = false;
                    if (isset($sub_param['submenu'])) {
                        foreach ($sub_param['submenu'] as $sub) {
                            $sub_url = menuUrl($sub);
                            if (slugURL($sub_url) == $current_url_slug) {
                                $open = true;
                            }
                        }
                    }
                    if (slugURL(menuUrl($sub_param)) == $current_url_slug) {
                        $active = true;
                    }
                    ?>
                    <li class="{{ isset($sub_param['submenu']) ? 'has-child ' . ($open ? 'open' : '') : '' }}">
                        <a class="ajax-priority {{ $active ? 'active' : '' }}" href="{{ menuUrl($sub_param) }}" {!! isset($sub_param['new_tab']) ? 'target="_blank"' : '' !!}>
                            {{ $sub_param['title'] ?? '-' }}
                            @if (isset($sub_param['submenu']))
                            <span class="toggle-icon"></span>
                            @endif
                        </a>
                        @if (isset($sub_param['submenu']))
                        <ul>
                            @foreach (collect($sub_param['submenu'])->sortBy('sort') as $key_last => $last_param)
                            @if (!Permission::has($last_param['route']))
                                @continue
                            @endif
                            <?php
                            $active = false;
                            if (slugURL(menuUrl($last_param)) == $current_url_slug) {
                                $active = true;
                            }
                            ?>
                            <li>
                                <a class="ajax-priority {{ $active ? 'active' : '' }}" href="{{ menuUrl($last_param) }}" {!! isset($last_param['new_tab']) ? 'target="_blank"' : '' !!}>{{ $last_param['title'] ?? '-' }}</a>
                            </li>
                            @endforeach
                        </ul>
                        @endif
                    </li>
                    @endforeach
                </ul>
                @endif
            </li>
            @endforeach

        </ul>
    </div>
</div>