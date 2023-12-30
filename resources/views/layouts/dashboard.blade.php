<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Dashboard - Obelaw Groupiumo</title>
    <!-- CSS files -->

    @if ($dir == 'ltr')
        <link href="{{ asset('/vendor/obelaw/tabler.min.css') }}" rel="stylesheet" />
    @endif

    @if ($dir == 'rtl')
        <link href="{{ asset('/vendor/obelaw/tabler.rtl.min.css') }}" rel="stylesheet" />
    @endif

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.7.19/sweetalert2.min.css"
        integrity="sha512-yX1R8uWi11xPfY7HDg7rkLL/9F1jq8Hyiz8qF4DV2nedX4IVl7ruR2+h3TFceHIcT5Oq7ooKi09UZbI39B7ylw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        @import url('https://rsms.me/inter/inter.css');

        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }

        body {
            font-feature-settings: "cv03", "cv04", "cv11";
        }
    </style>

    @livewireStyles

    @stack('styles')
</head>

<body>
    <div class="page">
        <!-- Sidebar -->

        {{-- @if (isset($_module)) --}}
        <aside class="navbar navbar-vertical navbar-expand-lg" data-bs-theme="dark">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar-menu"
                    aria-controls="sidebar-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <h1 class="navbar-brand navbar-brand-autodark">
                    <a href="{{ route('obelaw.home') }}" class="nav-link">
                        <img width="110" height="auto" src="{{ asset('/vendor/obelaw/images/logo-light.svg') }}"
                            alt="">
                    </a>
                </h1>
                <div class="collapse navbar-collapse" id="sidebar-menu">
                    <ul class="navbar-nav pt-lg-3">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('obelaw.home') }}">
                                <span
                                    class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
                                        <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                                        <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                                    </svg>
                                </span>
                                <span class="nav-link-title">
                                    Home
                                </span>
                            </a>
                        </li>
                        @foreach (\Obelaw\Facades\Bundles::getModulesByGroup(config('obelaw.groupium.groups', [])) as $modules)
                            @foreach ($modules as $module)
                                <div class="hr-text text-white">{{ $module['name'] }}</div>

                                @foreach (\Obelaw\Facades\Bundles::getNavbars($module['id']) as $link)
                                    @if (isset($link['href']) && hasPermission($link['permission']))
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route($link['href']) }}">
                                                <span class="nav-link-icon d-md-none d-lg-inline-block">
                                                    @if (isset($link['icon']))
                                                        @svg('tabler-' . $link['icon'], 'icon')
                                                    @else
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            class="icon icon-tabler icon-tabler-face-id" width="24"
                                                            height="24" viewBox="0 0 24 24" stroke-width="2"
                                                            stroke="currentColor" fill="none" stroke-linecap="round"
                                                            stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none">
                                                            </path>
                                                            <path d="M4 8v-2a2 2 0 0 1 2 -2h2"></path>
                                                            <path d="M4 16v2a2 2 0 0 0 2 2h2"></path>
                                                            <path d="M16 4h2a2 2 0 0 1 2 2v2"></path>
                                                            <path d="M16 20h2a2 2 0 0 0 2 -2v-2"></path>
                                                            <path d="M9 10l.01 0"></path>
                                                            <path d="M15 10l.01 0"></path>
                                                            <path d="M9.5 15a3.5 3.5 0 0 0 5 0"></path>
                                                        </svg>
                                                    @endif
                                                </span>
                                                <span class="nav-link-title">
                                                    {{ \Illuminate\Support\Str::contains($link['label'], '::navbar') ? __($link['label']) : $link['label'] }}
                                                </span>
                                            </a>
                                        </li>
                                    @endif

                                    @if (isset($link['sublinks']) && hasPermission($link['permission']))
                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle" href="#navbar-help"
                                                data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button"
                                                aria-expanded="false">
                                                <span class="nav-link-icon d-md-none d-lg-inline-block">
                                                    @if (isset($link['icon']))
                                                        @svg('tabler-' . $link['icon'], 'icon')
                                                    @else
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon"
                                                            width="24" height="24" viewBox="0 0 24 24"
                                                            stroke-width="2" stroke="currentColor" fill="none"
                                                            stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none">
                                                            </path>
                                                            <path d="M4 8v-2a2 2 0 0 1 2 -2h2"></path>
                                                            <path d="M4 16v2a2 2 0 0 0 2 2h2"></path>
                                                            <path d="M16 4h2a2 2 0 0 1 2 2v2"></path>
                                                            <path d="M16 20h2a2 2 0 0 0 2 -2v-2"></path>
                                                            <path d="M9 10l.01 0"></path>
                                                            <path d="M15 10l.01 0"></path>
                                                            <path d="M9.5 15a3.5 3.5 0 0 0 5 0"></path>
                                                        </svg>
                                                    @endif
                                                </span>
                                                <span class="nav-link-title">
                                                    {{ \Illuminate\Support\Str::contains($link['label'], '::navbar') ? __($link['label']) : $link['label'] }}
                                                </span>
                                            </a>
                                            <div class="dropdown-menu">
                                                @foreach ($link['sublinks'] as $_link)
                                                    @if (hasPermission($_link['permission']))
                                                        <a class="dropdown-item" href="{{ route($_link['href']) }}">
                                                            @if (isset($_link['icon']))
                                                                @svg('tabler-' . $_link['icon'], 'icon me-1')
                                                            @endif
                                                            {{ \Illuminate\Support\Str::contains($_link['label'], '::navbar') ? __($_link['label']) : $_link['label'] }}
                                                        </a>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </li>
                                    @endif
                                    
                                @endforeach
                            @endforeach
                        @endforeach
                    </ul>
                </div>
            </div>
        </aside>
        {{-- @endif --}}

        <!-- Navbar -->
        <header class="navbar navbar-expand-md d-none d-lg-flex d-print-none">
            <div class="container-xl">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu"
                    aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="navbar-nav flex-row order-md-last">
                    <div class="d-none d-md-flex">
                        <div class="nav-item dropdown d-none d-md-flex me-3">
                            <a href="#" class="nav-link px-0" data-bs-toggle="dropdown" tabindex="-1"
                                aria-label="Show notifications">
                                <!-- Download SVG icon from http://tabler-icons.io/i/bell -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M10 5a2 2 0 1 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6" />
                                    <path d="M9 17v1a3 3 0 0 0 6 0v-1" />
                                </svg>
                                <span class="badge bg-red"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-end dropdown-menu-card">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Last updates</h3>
                                    </div>
                                    <div class="list-group list-group-flush list-group-hoverable">
                                        <div class="list-group-item">
                                            <div class="row align-items-center">
                                                <div class="col-auto"><span
                                                        class="status-dot status-dot-animated bg-red d-block"></span>
                                                </div>
                                                <div class="col text-truncate">
                                                    <a href="#" class="text-body d-block">Example 1</a>
                                                    <div class="d-block text-secondary text-truncate mt-n1">
                                                        Change deprecated html tags to text decoration classes (#29604)
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <a href="#" class="list-group-item-actions">
                                                        <!-- Download SVG icon from http://tabler-icons.io/i/star -->
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            class="icon text-muted" width="24" height="24"
                                                            viewBox="0 0 24 24" stroke-width="2"
                                                            stroke="currentColor" fill="none"
                                                            stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                            <path
                                                                d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z" />
                                                        </svg>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="list-group-item">
                                            <div class="row align-items-center">
                                                <div class="col-auto"><span class="status-dot d-block"></span></div>
                                                <div class="col text-truncate">
                                                    <a href="#" class="text-body d-block">Example 2</a>
                                                    <div class="d-block text-secondary text-truncate mt-n1">
                                                        justify-content:between ⇒ justify-content:space-between (#29734)
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <a href="#" class="list-group-item-actions show">
                                                        <!-- Download SVG icon from http://tabler-icons.io/i/star -->
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            class="icon text-yellow" width="24" height="24"
                                                            viewBox="0 0 24 24" stroke-width="2"
                                                            stroke="currentColor" fill="none"
                                                            stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                            <path
                                                                d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z" />
                                                        </svg>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="list-group-item">
                                            <div class="row align-items-center">
                                                <div class="col-auto"><span class="status-dot d-block"></span></div>
                                                <div class="col text-truncate">
                                                    <a href="#" class="text-body d-block">Example 3</a>
                                                    <div class="d-block text-secondary text-truncate mt-n1">
                                                        Update change-version.js (#29736)
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <a href="#" class="list-group-item-actions">
                                                        <!-- Download SVG icon from http://tabler-icons.io/i/star -->
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            class="icon text-muted" width="24" height="24"
                                                            viewBox="0 0 24 24" stroke-width="2"
                                                            stroke="currentColor" fill="none"
                                                            stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                            <path
                                                                d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z" />
                                                        </svg>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="list-group-item">
                                            <div class="row align-items-center">
                                                <div class="col-auto"><span
                                                        class="status-dot status-dot-animated bg-green d-block"></span>
                                                </div>
                                                <div class="col text-truncate">
                                                    <a href="#" class="text-body d-block">Example 4</a>
                                                    <div class="d-block text-secondary text-truncate mt-n1">
                                                        Regenerate package-lock.json (#29730)
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <a href="#" class="list-group-item-actions">
                                                        <!-- Download SVG icon from http://tabler-icons.io/i/star -->
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            class="icon text-muted" width="24" height="24"
                                                            viewBox="0 0 24 24" stroke-width="2"
                                                            stroke="currentColor" fill="none"
                                                            stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                            <path
                                                                d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z" />
                                                        </svg>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown"
                            aria-label="Open user menu">
                            <span class="avatar avatar-sm"
                                style="background-image: url(https://www.gravatar.com/avatar/)"></span>
                            <div class="d-none d-xl-block ps-2">
                                <div>{{ $admin->name }}</div>
                                <div class="mt-1 small text-muted">{{ $admin->rule->name }}</div>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <a href="{{ route('obelaw.account.settings') }}"
                                class="dropdown-item">{{ __('obelaw::layout.settings') }}</a>
                            <a href="{{ route('obelaw.admin.logout') }}"
                                onclick="event.preventDefault(); document.getElementById('form-logout').submit();"
                                class="dropdown-item">{{ __('obelaw::layout.logout') }}</a>
                            <form id="form-logout" action="{{ route('obelaw.admin.logout') }}" method="POST"
                                style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
                <div class="collapse navbar-collapse" id="navbar-menu">
                    <div class="d-flex flex-column flex-md-row flex-fill align-items-stretch align-items-md-center">
                        <ul class="navbar-nav">
                            @if (isset($_module))
                                <li class="nav-item opacity-50">
                                    <a class="nav-link">
                                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                                            @if (isset($_module['icon']))
                                                @svg('tabler-' . $_module['icon'], 'icon')
                                            @else
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="icon icon-tabler icon-tabler-face-id" width="24"
                                                    height="24" viewBox="0 0 24 24" stroke-width="2"
                                                    stroke="currentColor" fill="none" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path d="M4 8v-2a2 2 0 0 1 2 -2h2"></path>
                                                    <path d="M4 16v2a2 2 0 0 0 2 2h2"></path>
                                                    <path d="M16 4h2a2 2 0 0 1 2 2v2"></path>
                                                    <path d="M16 20h2a2 2 0 0 0 2 -2v-2"></path>
                                                    <path d="M9 10l.01 0"></path>
                                                    <path d="M15 10l.01 0"></path>
                                                    <path d="M9.5 15a3.5 3.5 0 0 0 5 0"></path>
                                                </svg>
                                            @endif
                                        </span>
                                        <span class="nav-link-title">
                                            {{ \Illuminate\Support\Str::contains($_module['name'], '::') ? __($_module['name']) : $_module['name'] }}
                                        </span>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </header>
        <div class="page-wrapper">
            {{ $slot }}
            <footer class="footer footer-transparent d-print-none">
                <div class="container-xl">
                    <div class="row text-center align-items-center flex-row-reverse">
                        <div class="col-lg-auto ms-lg-auto">
                            <ul class="list-inline list-inline-dots mb-0">
                                {{-- <li class="list-inline-item"><a href="#s" target="_blank"
                                        class="link-secondary" rel="noopener">Documentation</a></li> --}}
                                <li class="list-inline-item"><a href="#" class="link-secondary">License</a>
                                </li>
                                {{-- <li class="list-inline-item"><a href="#"
                                        target="_blank" class="link-secondary" rel="noopener">Source code</a></li> --}}
                                <li class="list-inline-item">
                                    <a href="https://obelaw.com/" target="_blank" class="link-secondary"
                                        rel="noopener">
                                        <!-- Download SVG icon from http://tabler-icons.io/i/heart -->
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="icon text-pink icon-filled icon-inline" width="24"
                                            height="24" viewBox="0 0 24 24" stroke-width="2"
                                            stroke="currentColor" fill="none" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path
                                                d="M19.5 12.572l-7.5 7.428l-7.5 -7.428a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572" />
                                        </svg>
                                        Obelaw Pro
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                            <ul class="list-inline list-inline-dots mb-0">
                                <li class="list-inline-item">
                                    Copyright &copy; 2023
                                    <a href="https://obelaw.com/" target="_blank" class="link-secondary">Obelaw
                                        Pro</a>.
                                    All rights reserved.
                                </li>
                                <li class="list-inline-item">
                                    <a href="#" class="link-secondary" rel="noopener">
                                        v1.0.0
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <div class="modal modal-blur fade" id="modal-report" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">New report</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control" name="example-text-input"
                            placeholder="Your report name">
                    </div>
                    <label class="form-label">Report type</label>
                    <div class="form-selectgroup-boxes row mb-3">
                        <div class="col-lg-6">
                            <label class="form-selectgroup-item">
                                <input type="radio" name="report-type" value="1"
                                    class="form-selectgroup-input" checked>
                                <span class="form-selectgroup-label d-flex align-items-center p-3">
                                    <span class="me-3">
                                        <span class="form-selectgroup-check"></span>
                                    </span>
                                    <span class="form-selectgroup-label-content">
                                        <span class="form-selectgroup-title strong mb-1">Simple</span>
                                        <span class="d-block text-secondary">Provide only basic data needed for the
                                            report</span>
                                    </span>
                                </span>
                            </label>
                        </div>
                        <div class="col-lg-6">
                            <label class="form-selectgroup-item">
                                <input type="radio" name="report-type" value="1"
                                    class="form-selectgroup-input">
                                <span class="form-selectgroup-label d-flex align-items-center p-3">
                                    <span class="me-3">
                                        <span class="form-selectgroup-check"></span>
                                    </span>
                                    <span class="form-selectgroup-label-content">
                                        <span class="form-selectgroup-title strong mb-1">Advanced</span>
                                        <span class="d-block text-secondary">Insert charts and additional advanced
                                            analyses to be inserted in the report</span>
                                    </span>
                                </span>
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="mb-3">
                                <label class="form-label">Report url</label>
                                <div class="input-group input-group-flat">
                                    <span class="input-group-text">
                                        https://tabler.io/reports/
                                    </span>
                                    <input type="text" class="form-control ps-0" value="report-01"
                                        autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label class="form-label">Visibility</label>
                                <select class="form-select">
                                    <option value="1" selected>Private</option>
                                    <option value="2">Public</option>
                                    <option value="3">Hidden</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Client name</label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Reporting period</label>
                                <input type="date" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div>
                                <label class="form-label">Additional information</label>
                                <textarea class="form-control" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                        Cancel
                    </a>
                    <a href="#" class="btn btn-primary ms-auto" data-bs-dismiss="modal">
                        <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M12 5l0 14" />
                            <path d="M5 12l14 0" />
                        </svg>
                        Create new report
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>

<script src="{{ asset('/vendor/obelaw/tabler.min.js') }}"></script>
<script src="https://tabler.io/demo/dist/js/demo.min.js" defer></script>
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

@livewireScripts

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.7.19/sweetalert2.min.js"
    integrity="sha512-zHKwhWCHqpmDbi6d/5Fnuwr7JKmzmpXErmoVE0OX2i0TRLlJy+19j1YzRRzD/CnpjGMSD3P0XVo+ca6v4tbn4A=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{ asset('vendor/livewire-alert/livewire-alert.js') }}"></script>
<x-livewire-alert::flash />

@stack('scripts')

</html>
