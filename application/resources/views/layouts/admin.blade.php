<!DOCTYPE html>
<!-- saved from url=(0044)https://coreui.io/demo/3.0-beta.0/#main.html -->
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="CoreUI - Open Source Bootstrap Admin Template">
    <meta name="author" content="Łukasz Holeczek">
    <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">
    <title>CoreUI Pro Bootstrap Admin Template</title>

    <link href="./core-ui_files/style.css" rel="stylesheet">
    <link href="./core-ui_files/pace.min.css" rel="stylesheet">
    {{-- Font Awesome --}}
<link rel="stylesheet" href="{{ asset('/fontawesome/css/all.css') }}">
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'UA-118965717-1');
    </script>
    <style type="text/css">
        /* Chart.js */
        /*
 * DOM element rendering detection
 * https://davidwalsh.name/detect-node-insertion
 */
        
        @keyframes chartjs-render-animation {
            from {
                opacity: 0.99;
            }
            to {
                opacity: 1;
            }
        }
        
        .chartjs-render-monitor {
            animation: chartjs-render-animation 0.001s;
        }
        /*
 * DOM element resizing detection
 * https://github.com/marcj/css-element-queries
 */
        
        .chartjs-size-monitor,
        .chartjs-size-monitor-expand,
        .chartjs-size-monitor-shrink {
            position: absolute;
            direction: ltr;
            left: 0;
            top: 0;
            right: 0;
            bottom: 0;
            overflow: hidden;
            pointer-events: none;
            visibility: hidden;
            z-index: -1;
        }
        
        .chartjs-size-monitor-expand > div {
            position: absolute;
            width: 1000000px;
            height: 1000000px;
            left: 0;
            top: 0;
        }
        
        .chartjs-size-monitor-shrink > div {
            position: absolute;
            width: 200%;
            height: 200%;
            left: 0;
            top: 0;
        }
        /* #1073CB */
    </style>
</head>

<body class="c-app  pace-running pace-done" cz-shortcut-listen="true">
    <div class="pace  pace-inactive">
        <div class="pace-progress" data-progress-text="100%" data-progress="99" style="transform: translate3d(100%, 0px, 0px);">
            <div class="pace-progress-inner"></div>
        </div>
        <div class="pace-activity"></div>
    </div>
    <div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
        <div class="c-sidebar-brand" style="background: #1073CB"><img class="c-sidebar-brand-full" src="./core-ui_files/coreui-pro-base-white.svg" width="118" height="46" alt="CoreUI Logo"><img class="c-sidebar-brand-minimized" src="./core-ui_files/coreui-signet-white.svg" width="118" height="46" alt="CoreUI Logo"></div>
        <ul style="background: #1073CB" class="c-sidebar-nav ps ps--active-y" data-drodpown-accordion="true">
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link c-active">
                    <i class="fas fa-tachometer-alt mr-3" style="font-size: 18px"></i>  Dashboard
                </a>
            </li>
            <li class="c-sidebar-nav-title">Menu</li>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{ url('admin/home') }}">
                    <i class="fas fa-home mr-3" style="font-size: 18px"></i> Home
                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{ url('admin/admins') }}">
                    <i class="fas fa-user mr-3" style="font-size: 18px"></i> Admins
                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{ url('admin/patients') }}">
                    <i class="fas fa-user mr-3" style="font-size: 18px"></i> Patients
                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{ url('admin/doctors') }}">
                    <i class="fas fa-user-md mr-3" style="font-size: 18px"></i> Doctors
                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{ url('admin/convenants') }}">
                    <i class="fas fa-user-friends mr-3" style="font-size: 18px"></i> Convenants 
                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{ url('/admin/documents') }}">
                    <i class="fas fa-file mr-3" style="font-size: 18px"></i> Documents
                </a>
            </li>
            {{-- <li class="c-sidebar-nav-title">Components</li>
            <li class="c-sidebar-nav-dropdown">
                <a class="c-sidebar-nav-dropdown-toggle" href="https://coreui.io/demo/3.0-beta.0/#">
                    <svg class="c-sidebar-nav-icon">
                        <use xlink:href="core-ui_files/vendors/@coreui/icons/svg/free.svg#cil-puzzle"></use>
                    </svg> Base</a>
                <ul class="c-sidebar-nav-dropdown-items">
                    <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="https://coreui.io/demo/3.0-beta.0/base/breadcrumb.html"> Breadcrumb</a></li>
                    <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="https://coreui.io/demo/3.0-beta.0/base/cards.html"> Cards</a></li>
                    <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="https://coreui.io/demo/3.0-beta.0/base/carousel.html"> Carousel</a></li>
                    <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="https://coreui.io/demo/3.0-beta.0/base/collapse.html"> Collapse</a></li>
                    <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="https://coreui.io/demo/3.0-beta.0/base/jumbotron.html"> Jumbotron</a></li>
                    <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="https://coreui.io/demo/3.0-beta.0/base/list-group.html"> List group</a></li>
                    <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="https://coreui.io/demo/3.0-beta.0/base/navs.html"> Navs</a></li>
                    <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="https://coreui.io/demo/3.0-beta.0/base/pagination.html"> Pagination</a></li>
                    <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="https://coreui.io/demo/3.0-beta.0/base/popovers.html"> Popovers</a></li>
                    <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="https://coreui.io/demo/3.0-beta.0/base/progress.html"> Progress</a></li>
                    <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="https://coreui.io/demo/3.0-beta.0/base/scrollspy.html"> Scrollspy</a></li>
                    <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="https://coreui.io/demo/3.0-beta.0/base/switches.html"> Switches</a></li>
                    <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="https://coreui.io/demo/3.0-beta.0/base/tabs.html"> Tabs</a></li>
                    <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="https://coreui.io/demo/3.0-beta.0/base/tooltips.html"> Tooltips</a></li>
                </ul>
            </li> --}}
        </ul>
        <button style="background: #1073CB" class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent" data-class="c-sidebar-unfoldable"></button>
    </div>
    <div class="c-sidebar c-sidebar-lg c-sidebar-light c-sidebar-right c-sidebar-overlaid" id="aside">
        <button class="c-sidebar-close c-class-toggler" type="button" data-target="_parent" data-class="c-sidebar-show" responsive="true">
            <svg class="c-icon">
                <use xlink:href="core-ui_files/vendors/@coreui/icons/svg/free.svg#cil-x"></use>
            </svg>
        </button>
        <ul class="nav nav-tabs nav-underline nav-underline-primary" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="https://coreui.io/demo/3.0-beta.0/#timeline" role="tab">
                    <svg class="c-icon">
                        <use xlink:href="core-ui_files/vendors/@coreui/icons/svg/free.svg#cil-list"></use>
                    </svg>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="https://coreui.io/demo/3.0-beta.0/#messages" role="tab">
                    <svg class="c-icon">
                        <use xlink:href="core-ui_files/vendors/@coreui/icons/svg/free.svg#cil-speech"></use>
                    </svg>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="https://coreui.io/demo/3.0-beta.0/#settings" role="tab">
                    <svg class="c-icon">
                        <use xlink:href="core-ui_files/vendors/@coreui/icons/svg/free.svg#cil-settings"></use>
                    </svg>
                </a>
            </li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane active" id="timeline" role="tabpanel">
                <div class="list-group list-group-accent">
                    <div class="list-group-item list-group-item-accent-secondary bg-light text-center font-weight-bold text-muted text-uppercase c-small">Today</div>
                    <div class="list-group-item list-group-item-accent-warning list-group-item-divider">
                        <div class="c-avatar float-right"><img class="c-avatar-img" src="./core-ui_files/7.jpg" alt="user@email.com"></div>
                        <div>Meeting with <strong>Lucas</strong></div><small class="text-muted mr-3">
<svg class="c-icon">
<use xlink:href="core-ui_files/vendors/@coreui/icons/svg/free.svg#cil-calendar"></use>
</svg>&nbsp; 1 - 3pm</small><small class="text-muted">
<svg class="c-icon">
<use xlink:href="core-ui_files/vendors/@coreui/icons/svg/free.svg#cil-location-pin"></use>
</svg>&nbsp; Palo Alto, CA</small>
                    </div>
                    <div class="list-group-item list-group-item-accent-info">
                        <div class="c-avatar float-right"><img class="c-avatar-img" src="./core-ui_files/4.jpg" alt="user@email.com"></div>
                        <div>Skype with <strong>Megan</strong></div><small class="text-muted mr-3">
<svg class="c-icon">
<use xlink:href="core-ui_files/vendors/@coreui/icons/svg/free.svg#cil-calendar"></use>
</svg>&nbsp; 4 - 5pm</small><small class="text-muted">
<svg class="c-icon">
<use xlink:href="core-ui_files/vendors/@coreui/icons/svg/free.svg#cil-skype"></use>
</svg>&nbsp; On-line</small>
                    </div>
                    <div class="list-group-item list-group-item-accent-secondary bg-light text-center font-weight-bold text-muted text-uppercase c-small">Tomorrow</div>
                    <div class="list-group-item list-group-item-accent-danger list-group-item-divider">
                        <div>New UI Project - <strong>deadline</strong></div><small class="text-muted mr-3">
<svg class="c-icon">
<use xlink:href="core-ui_files/vendors/@coreui/icons/svg/free.svg#cil-calendar"></use>
</svg>&nbsp; 10 - 11pm</small><small class="text-muted">
<svg class="c-icon">
<use xlink:href="core-ui_files/vendors/@coreui/icons/svg/free.svg#cil-home"></use>
</svg>&nbsp; creativeLabs HQ</small>
                        <div class="c-avatars-stack mt-2">
                            <div class="c-avatar c-avatar-xs"><img class="c-avatar-img" src="./core-ui_files/2.jpg" alt="user@email.com"></div>
                            <div class="c-avatar c-avatar-xs"><img class="c-avatar-img" src="./core-ui_files/3.jpg" alt="user@email.com"></div>
                            <div class="c-avatar c-avatar-xs"><img class="c-avatar-img" src="./core-ui_files/4.jpg" alt="user@email.com"></div>
                            <div class="c-avatar c-avatar-xs"><img class="c-avatar-img" src="./core-ui_files/5.jpg" alt="user@email.com"></div>
                            <div class="c-avatar c-avatar-xs"><img class="c-avatar-img" src="./core-ui_files/6.jpg" alt="user@email.com"></div>
                        </div>
                    </div>
                    <div class="list-group-item list-group-item-accent-success list-group-item-divider">
                        <div><strong>#10 Startups.Garden</strong> Meetup</div><small class="text-muted mr-3">
<svg class="c-icon">
<use xlink:href="core-ui_files/vendors/@coreui/icons/svg/free.svg#cil-calendar"></use>
</svg>&nbsp; 1 - 3pm</small><small class="text-muted">
<svg class="c-icon">
<use xlink:href="core-ui_files/vendors/@coreui/icons/svg/free.svg#cil-location-pin"></use>
</svg>&nbsp; Palo Alto, CA</small>
                    </div>
                    <div class="list-group-item list-group-item-accent-primary list-group-item-divider">
                        <div><strong>Team meeting</strong></div><small class="text-muted mr-3">
<svg class="c-icon">
<use xlink:href="core-ui_files/vendors/@coreui/icons/svg/free.svg#cil-calendar"></use>
</svg>&nbsp; 4 - 6pm</small><small class="text-muted">
<svg class="c-icon">
<use xlink:href="core-ui_files/vendors/@coreui/icons/svg/free.svg#cil-home"></use>
</svg>&nbsp; creativeLabs HQ</small>
                        <div class="c-avatars-stack mt-2">
                            <div class="c-avatar c-avatar-xs"><img class="c-avatar-img" src="./core-ui_files/2.jpg" alt="user@email.com"></div>
                            <div class="c-avatar c-avatar-xs"><img class="c-avatar-img" src="./core-ui_files/3.jpg" alt="user@email.com"></div>
                            <div class="c-avatar c-avatar-xs"><img class="c-avatar-img" src="./core-ui_files/4.jpg" alt="user@email.com"></div>
                            <div class="c-avatar c-avatar-xs"><img class="c-avatar-img" src="./core-ui_files/5.jpg" alt="user@email.com"></div>
                            <div class="c-avatar c-avatar-xs"><img class="c-avatar-img" src="./core-ui_files/6.jpg" alt="user@email.com"></div>
                            <div class="c-avatar c-avatar-xs"><img class="c-avatar-img" src="./core-ui_files/7.jpg" alt="user@email.com"></div>
                            <div class="c-avatar c-avatar-xs"><img class="c-avatar-img" src="./core-ui_files/8.jpg" alt="user@email.com"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane p-3" id="messages" role="tabpanel">
                <div class="message">
                    <div class="py-3 pb-5 mr-3 float-left">
                        <div class="c-avatar"><img class="c-avatar-img" src="./core-ui_files/7.jpg" alt="user@email.com"><span class="c-avatar-status bg-success"></span></div>
                    </div>
                    <div><small class="text-muted">Lukasz Holeczek</small><small class="text-muted float-right mt-1">1:52 PM</small></div>
                    <div class="text-truncate font-weight-bold">Lorem ipsum dolor sit amet</div><small class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt...</small>
                </div>
                <hr>
                <div class="message">
                    <div class="py-3 pb-5 mr-3 float-left">
                        <div class="c-avatar"><img class="c-avatar-img" src="./core-ui_files/7.jpg" alt="user@email.com"><span class="c-avatar-status bg-success"></span></div>
                    </div>
                    <div><small class="text-muted">Lukasz Holeczek</small><small class="text-muted float-right mt-1">1:52 PM</small></div>
                    <div class="text-truncate font-weight-bold">Lorem ipsum dolor sit amet</div><small class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt...</small>
                </div>
                <hr>
                <div class="message">
                    <div class="py-3 pb-5 mr-3 float-left">
                        <div class="c-avatar"><img class="c-avatar-img" src="./core-ui_files/7.jpg" alt="user@email.com"><span class="c-avatar-status bg-success"></span></div>
                    </div>
                    <div><small class="text-muted">Lukasz Holeczek</small><small class="text-muted float-right mt-1">1:52 PM</small></div>
                    <div class="text-truncate font-weight-bold">Lorem ipsum dolor sit amet</div><small class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt...</small>
                </div>
                <hr>
                <div class="message">
                    <div class="py-3 pb-5 mr-3 float-left">
                        <div class="c-avatar"><img class="c-avatar-img" src="./core-ui_files/7.jpg" alt="user@email.com"><span class="c-avatar-status bg-success"></span></div>
                    </div>
                    <div><small class="text-muted">Lukasz Holeczek</small><small class="text-muted float-right mt-1">1:52 PM</small></div>
                    <div class="text-truncate font-weight-bold">Lorem ipsum dolor sit amet</div><small class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt...</small>
                </div>
                <hr>
                <div class="message">
                    <div class="py-3 pb-5 mr-3 float-left">
                        <div class="c-avatar"><img class="c-avatar-img" src="./core-ui_files/7.jpg" alt="user@email.com"><span class="c-avatar-status bg-success"></span></div>
                    </div>
                    <div><small class="text-muted">Lukasz Holeczek</small><small class="text-muted float-right mt-1">1:52 PM</small></div>
                    <div class="text-truncate font-weight-bold">Lorem ipsum dolor sit amet</div><small class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt...</small>
                </div>
            </div>
            <div class="tab-pane p-3" id="settings" role="tabpanel">
                <h6>Settings</h6>
                <div class="c-aside-options">
                    <div class="clearfix mt-4"><small><b>Option 1</b></small>
                        <label class="c-switch c-switch-label c-switch-pill c-switch-success c-switch-sm float-right">
                            <input class="c-switch-input" type="checkbox" checked=""><span class="c-switch-slider" data-checked="On" data-unchecked="Off"></span>
                        </label>
                    </div>
                    <div><small class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</small></div>
                </div>
                <div class="c-aside-options">
                    <div class="clearfix mt-3"><small><b>Option 2</b></small>
                        <label class="c-switch c-switch-label c-switch-pill c-switch-success c-switch-sm float-right">
                            <input class="c-switch-input" type="checkbox"><span class="c-switch-slider" data-checked="On" data-unchecked="Off"></span>
                        </label>
                    </div>
                    <div><small class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</small></div>
                </div>
                <div class="c-aside-options">
                    <div class="clearfix mt-3"><small><b>Option 3</b></small>
                        <label class="c-switch c-switch-label c-switch-pill c-switch-success c-switch-sm float-right">
                            <input class="c-switch-input" type="checkbox"><span class="c-switch-slider" data-checked="On" data-unchecked="Off"></span>
                        </label>
                    </div>
                </div>
                <div class="c-aside-options">
                    <div class="clearfix mt-3"><small><b>Option 4</b></small>
                        <label class="c-switch c-switch-label c-switch-pill c-switch-success c-switch-sm float-right">
                            <input class="c-switch-input" type="checkbox" checked=""><span class="c-switch-slider" data-checked="On" data-unchecked="Off"></span>
                        </label>
                    </div>
                </div>
                <hr>
                <h6>System Utilization</h6>
                <div class="text-uppercase mb-1 mt-4"><small><b>CPU Usage</b></small></div>
                <div class="progress progress-xs">
                    <div class="progress-bar bg-info" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div><small class="text-muted">348 Processes. 1/4 Cores.</small>
                <div class="text-uppercase mb-1 mt-2"><small><b>Memory Usage</b></small></div>
                <div class="progress progress-xs">
                    <div class="progress-bar bg-warning" role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                </div><small class="text-muted">11444GB/16384MB</small>
                <div class="text-uppercase mb-1 mt-2"><small><b>SSD 1 Usage</b></small></div>
                <div class="progress progress-xs">
                    <div class="progress-bar bg-danger" role="progressbar" style="width: 95%" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
                </div><small class="text-muted">243GB/256GB</small>
                <div class="text-uppercase mb-1 mt-2"><small><b>SSD 2 Usage</b></small></div>
                <div class="progress progress-xs">
                    <div class="progress-bar bg-success" role="progressbar" style="width: 10%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                </div><small class="text-muted">25GB/256GB</small>
            </div>
        </div>
    </div>
    <div class="c-wrapper">
        <header class="c-header c-header-light c-header-fixed c-header-with-subheader" style="height: 60px">
            <button class="c-header-toggler c-class-toggler d-lg-none mfe-auto" type="button" data-target="#sidebar" data-class="c-sidebar-show"><span class="c-header-toggler-icon"></span></button>
            <a class="c-header-brand d-sm-none" href="https://coreui.io/demo/3.0-beta.0/#"><img class="c-header-brand-full c-d-dark-none" src="./core-ui_files/coreui-pro-base.svg" width="118" height="46" alt="CoreUI Logo"><img class="c-header-brand-minimized c-d-dark-none" src="./core-ui_files/coreui-signet.svg" width="46" height="46" alt="CoreUI Logo"><img class="c-header-brand-full c-d-light-none" src="./core-ui_files/coreui-pro-base-white.svg" width="118" height="46" alt="CoreUI Logo"><img class="c-header-brand-minimized c-d-light-none" src="./core-ui_files/coreui-signet-white.svg" width="46" height="46" alt="CoreUI Logo"></a>
            <button class="c-header-toggler c-class-toggler mfs-3 d-md-down-none" type="button" data-target="#sidebar" data-class="c-sidebar-lg-show" responsive="true"><span class="c-header-toggler-icon"></span></button>
            <ul class="c-header-nav mfs-auto">
                {{-- <li class="c-header-nav-item px-3">
                    <button class="c-class-toggler c-header-nav-btn" type="button" id="header-tooltip" data-target="body" data-class="c-dark-theme" data-toggle="c-tooltip" data-placement="bottom" title="" data-original-title="Toggle Light/Dark Mode">
                        <i class="fas fa-yin-yang" style="font-size: 30px"></i>
                    </button>
                </li> --}}
            </ul>
            <ul class="c-header-nav" style="height: 100%">
                <li class="c-header-nav-item dropdown">
                    <a class="c-header-nav-link" data-toggle="dropdown" href="https://coreui.io/demo/3.0-beta.0/#" role="button" aria-haspopup="true" aria-expanded="false">
                        <div class="c-avatar"><img class="c-avatar-img" src="./core-ui_files/6.jpg" alt="user@email.com"></div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right pt-0">
                        <div class="dropdown-header bg-light py-2"><strong>Account</strong></div>
                        <a class="dropdown-item" >
                            <i class="fas fa-user mr-3"></i>
                            {{Auth::user()->name}}</a>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                             <i class="fas fa-sign-out-alt mr-3"></i>{{ __('Logout') }}
                         </a>

                         <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                             @csrf
                         </form>
                    </div>
                </li>
              
            </ul>
        </header>
        <div class="c-body" style="padding-top: 80px">
            <div class="container-fluid">
                @include('parts/error')
                @include('parts/success')

                @yield('content')
            </div>
           
        </div>
    </div>

    <script src="./core-ui_files/pace.min.js.download"></script>
    <script src="./core-ui_files/coreui.bundle.min.js.download"></script>
    {{-- <script>
        new coreui.AsyncLoad(document.getElementById('ui-view'));
        document.addEventListener('xhr', function() {
            Pace.restart()
        }, true);
        var tooltipEl = document.getElementById('header-tooltip');
        var tootltip = new coreui.Tooltip(tooltipEl);
    </script> --}}

    <script type="text/javascript" src="./core-ui_files/coreui-chartjs.bundle.js.download" class="view-script"></script>
    <script type="text/javascript" src="./core-ui_files/main.js.download" class="view-script"></script>
</body>

</html>