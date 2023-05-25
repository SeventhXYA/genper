<nav class="sidebar">
    <div class="sidebar-header">
        <a href="#" class="sidebar-brand">
            Gen<span>Per</span>
        </a>
        <div class="sidebar-toggler not-active">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="sidebar-body">
        <ul class="nav">
            @if (auth()->user()->id_level == 3)
                <li class="nav-item nav-category">Main</li>
                <li class="nav-item {{ active_class(['/']) }}">
                    <a href="{{ url('/') }}" class="nav-link">
                        <i class="link-icon" data-feather="box"></i>
                        <span class="link-title">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item nav-category">Daily</li>
                <li class="nav-item {{ active_class(['selfdevelopment/*']) }}">
                    <a class="nav-link" data-bs-toggle="collapse" href="#selfdevelopment" role="button"
                        aria-expanded="{{ is_active_route(['selfdevelopment/*']) }}" aria-controls="selfdevelopment">
                        <i class="link-icon mdi mdi-book-open-page-variant"></i>
                        <span class="link-title">Self-Development</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse {{ show_class(['selfdevelopment/*']) }}" id="selfdevelopment">
                        <ul class="nav sub-menu">
                            <li class="nav-item">
                                <a href="{{ url('/newsd') }}" class="nav-link {{ active_class(['newsd']) }}">Laporan
                                    Baru</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/historysd') }}"
                                    class="nav-link {{ active_class(['historysd']) }}">Riwayat</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item {{ active_class(['bisnisprofit/*']) }}">
                    <a class="nav-link" data-bs-toggle="collapse" href="#bisnisprofit" role="button"
                        aria-expanded="{{ is_active_route(['bisnisprofit/*']) }}" aria-controls="bisnisprofit">
                        <i class="link-icon mdi mdi-chart-areaspline"></i>
                        <span class="link-title">Bisnis & Profit</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse {{ show_class(['bisnisprofit/*']) }}" id="bisnisprofit">
                        <ul class="nav sub-menu">
                            <li class="nav-item">
                                <a href="{{ url('/newbp') }}" class="nav-link {{ active_class(['newbp']) }}">Laporan
                                    Baru</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/historybp') }}"
                                    class="nav-link {{ active_class(['historybp']) }}">Riwayat</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item {{ active_class(['kelembagaan/*']) }}">
                    <a class="nav-link" data-bs-toggle="collapse" href="#kelembagaan" role="button"
                        aria-expanded="{{ is_active_route(['kelembagaan/*']) }}" aria-controls="kelembagaan">
                        <i class="link-icon mdi mdi-bank"></i>
                        <span class="link-title">Kelembagaan</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse {{ show_class(['kelembagaan/*']) }}" id="kelembagaan">
                        <ul class="nav sub-menu">
                            <li class="nav-item">
                                <a href="{{ url('/newkl') }}" class="nav-link {{ active_class(['newkl']) }}">Laporan
                                    Baru</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/historykl') }}"
                                    class="nav-link {{ active_class(['historykl']) }}">Riwayat</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item {{ active_class(['inovasicreativity/*']) }}">
                    <a class="nav-link" data-bs-toggle="collapse" href="#inovasicreativity" role="button"
                        aria-expanded="{{ is_active_route(['inovasicreativity/*']) }}"
                        aria-controls="inovasicreativity">
                        <i class="link-icon mdi mdi-brush"></i>
                        <span class="link-title">Inovasi & Creativity</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse {{ show_class(['inovasicreativity/*']) }}" id="inovasicreativity">
                        <ul class="nav sub-menu">
                            <li class="nav-item">
                                <a href="{{ url('newic') }}" class="nav-link {{ active_class(['newic']) }}">Laporan
                                    Baru</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('historyic') }}"
                                    class="nav-link {{ active_class(['historyic']) }}">Riwayat</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item {{ active_class(['evaluasi/*']) }}">
                    <a class="nav-link" data-bs-toggle="collapse" href="#evaluasi" role="button"
                        aria-expanded="{{ is_active_route(['evaluasi/*']) }}" aria-controls="evaluasi">
                        <i class="link-icon mdi mdi-clipboard-text"></i>
                        <span class="link-title">Evaluasi Harian</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse {{ show_class(['evaluasi/*']) }}" id="evaluasi">
                        <ul class="nav sub-menu">
                            <li class="nav-item">
                                <a href="{{ url('/newev') }}" class="nav-link {{ active_class(['newev']) }}">Laporan
                                    Baru</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/historyev') }}"
                                    class="nav-link {{ active_class(['historyev']) }}">Riwayat</a>
                            </li>
                        </ul>
                    </div>
                </li>
            @endif
            <li class="nav-item nav-category">Weekly</li>
            <li class="nav-item {{ active_class(['selfdevelopment/*']) }}">
                <a class="nav-link" data-bs-toggle="collapse" href="#selfdevelopment" role="button"
                    aria-expanded="{{ is_active_route(['selfdevelopment/*']) }}" aria-controls="selfdevelopment">
                    <i class="link-icon mdi mdi-book-open-page-variant"></i>
                    <span class="link-title">Self-Development</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse {{ show_class(['selfdevelopment/*']) }}" id="selfdevelopment">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ url('/selfdevelopment/newsd') }}"
                                class="nav-link {{ active_class(['selfdevelopment/newsd']) }}">Laporan
                                Baru</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/selfdevelopment/historysd') }}"
                                class="nav-link {{ active_class(['selfdevelopment/historysd']) }}">Riwayat</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item {{ active_class(['bisnisprofit/*']) }}">
                <a class="nav-link" data-bs-toggle="collapse" href="#bisnisprofit" role="button"
                    aria-expanded="{{ is_active_route(['bisnisprofit/*']) }}" aria-controls="bisnisprofit">
                    <i class="link-icon mdi mdi-chart-areaspline"></i>
                    <span class="link-title">Bisnis & Profit</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse {{ show_class(['bisnisprofit/*']) }}" id="bisnisprofit">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ url('/bisnisprofit/newbp') }}"
                                class="nav-link {{ active_class(['bisnisprofit/newbp']) }}">Laporan Baru</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/bisnisprofit/historybp') }}"
                                class="nav-link {{ active_class(['bisnisprofit/historybp']) }}">Riwayat</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item {{ active_class(['kelembagaan/*']) }}">
                <a class="nav-link" data-bs-toggle="collapse" href="#kelembagaan" role="button"
                    aria-expanded="{{ is_active_route(['kelembagaan/*']) }}" aria-controls="kelembagaan">
                    <i class="link-icon mdi mdi-bank"></i>
                    <span class="link-title">Kelembagaan</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse {{ show_class(['kelembagaan/*']) }}" id="kelembagaan">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ url('/kelembagaan/newkl') }}"
                                class="nav-link {{ active_class(['kelembagaan/newkl']) }}">Laporan Baru</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/kelembagaan/historykl') }}"
                                class="nav-link {{ active_class(['kelembagaan/historykl']) }}">Riwayat</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item {{ active_class(['inovasicreativity/*']) }}">
                <a class="nav-link" data-bs-toggle="collapse" href="#inovasicreativity" role="button"
                    aria-expanded="{{ is_active_route(['inovasicreativity/*']) }}" aria-controls="inovasicreativity">
                    <i class="link-icon mdi mdi-brush"></i>
                    <span class="link-title">Inovasi & Creativity</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse {{ show_class(['inovasicreativity/*']) }}" id="inovasicreativity">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ url('/inovasicreativity/newic') }}"
                                class="nav-link {{ active_class(['inovasicreativity/newic']) }}">Laporan Baru</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/inovasicreativity/historyic') }}"
                                class="nav-link {{ active_class(['inovasicreativity/historyic']) }}">Riwayat</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item {{ active_class(['evaluasi/*']) }}">
                <a class="nav-link" data-bs-toggle="collapse" href="#evaluasi" role="button"
                    aria-expanded="{{ is_active_route(['evaluasi/*']) }}" aria-controls="evaluasi">
                    <i class="link-icon mdi mdi-clipboard-text"></i>
                    <span class="link-title">Evaluasi Harian</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse {{ show_class(['evaluasi/*']) }}" id="evaluasi">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ url('/evaluasi/newev') }}"
                                class="nav-link {{ active_class(['evaluasi/newev']) }}">Laporan Baru</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/evaluasi/historyev') }}"
                                class="nav-link {{ active_class(['evaluasi/historyev']) }}">Riwayat</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item nav-category">web apps</li>
            <li class="nav-item {{ active_class(['email/*']) }}">
                <a class="nav-link" data-bs-toggle="collapse" href="#email" role="button"
                    aria-expanded="{{ is_active_route(['email/*']) }}" aria-controls="email">
                    <i class="link-icon" data-feather="mail"></i>
                    <span class="link-title">Email</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse {{ show_class(['email/*']) }}" id="email">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ url('/email/inbox') }}"
                                class="nav-link {{ active_class(['email/inbox']) }}">Inbox</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/email/read') }}"
                                class="nav-link {{ active_class(['email/read']) }}">Read</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/email/compose') }}"
                                class="nav-link {{ active_class(['email/compose']) }}">Compose</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item {{ active_class(['apps/chat']) }}">
                <a href="{{ url('/apps/chat') }}" class="nav-link">
                    <i class="link-icon" data-feather="message-square"></i>
                    {{-- <i class="mdi mdi-transcribe"></i> --}}
                    <span class="link-title">Chat</span>
                </a>
            </li>
            <li class="nav-item {{ active_class(['apps/calendar']) }}">
                <a href="{{ url('/apps/calendar') }}" class="nav-link">
                    <i class="link-icon" data-feather="calendar"></i>
                    <span class="link-title">Calendar</span>
                </a>
            </li>
            <li class="nav-item nav-category">Components</li>
            <li class="nav-item {{ active_class(['ui-components/*']) }}">
                <a class="nav-link" data-bs-toggle="collapse" href="#uiComponents" role="button"
                    aria-expanded="{{ is_active_route(['ui-components/*']) }}" aria-controls="uiComponents">
                    <i class="link-icon" data-feather="feather"></i>
                    <span class="link-title">UI Kit</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse {{ show_class(['ui-components/*']) }}" id="uiComponents">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ url('/ui-components/accordion') }}"
                                class="nav-link {{ active_class(['ui-components/accordion']) }}">Accordion</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/ui-components/alerts') }}"
                                class="nav-link {{ active_class(['ui-components/alerts']) }}">Alerts</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/ui-components/badges') }}"
                                class="nav-link {{ active_class(['ui-components/badges']) }}">Badges</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/ui-components/breadcrumbs') }}"
                                class="nav-link {{ active_class(['ui-components/breadcrumbs']) }}">Breadcrumbs</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/ui-components/buttons') }}"
                                class="nav-link {{ active_class(['ui-components/buttons']) }}">Buttons</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/ui-components/button-group') }}"
                                class="nav-link {{ active_class(['ui-components/button-group']) }}">Button group</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/ui-components/cards') }}"
                                class="nav-link {{ active_class(['ui-components/cards']) }}">Cards</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/ui-components/carousel') }}"
                                class="nav-link {{ active_class(['ui-components/carousel']) }}">Carousel</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/ui-components/collapse') }}"
                                class="nav-link {{ active_class(['ui-components/collapse']) }}">Collapse</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/ui-components/dropdowns') }}"
                                class="nav-link {{ active_class(['ui-components/dropdowns']) }}">Dropdowns</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/ui-components/list-group') }}"
                                class="nav-link {{ active_class(['ui-components/list-group']) }}">List group</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/ui-components/media-object') }}"
                                class="nav-link {{ active_class(['ui-components/media-object']) }}">Media object</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/ui-components/modal') }}"
                                class="nav-link {{ active_class(['ui-components/modal']) }}">Modal</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/ui-components/navs') }}"
                                class="nav-link {{ active_class(['ui-components/navs']) }}">Navs</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/ui-components/navbar') }}"
                                class="nav-link {{ active_class(['ui-components/navbar']) }}">Navbar</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/ui-components/pagination') }}"
                                class="nav-link {{ active_class(['ui-components/pagination']) }}">Pagination</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/ui-components/popovers') }}"
                                class="nav-link {{ active_class(['ui-components/popovers']) }}">Popvers</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/ui-components/progress') }}"
                                class="nav-link {{ active_class(['ui-components/progress']) }}">Progress</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/ui-components/scrollbar') }}"
                                class="nav-link {{ active_class(['ui-components/scrollbar']) }}">Scrollbar</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/ui-components/scrollspy') }}"
                                class="nav-link {{ active_class(['ui-components/scrollspy']) }}">Scrollspy</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/ui-components/spinners') }}"
                                class="nav-link {{ active_class(['ui-components/spinners']) }}">Spinners</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/ui-components/tabs') }}"
                                class="nav-link {{ active_class(['ui-components/tabs']) }}">Tabs</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/ui-components/tooltips') }}"
                                class="nav-link {{ active_class(['ui-components/tooltips']) }}">Tooltips</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item {{ active_class(['advanced-ui/*']) }}">
                <a class="nav-link" data-bs-toggle="collapse" href="#advanced-ui" role="button"
                    aria-expanded="{{ is_active_route(['advanced-ui/*']) }}" aria-controls="advanced-ui">
                    <i class="link-icon" data-feather="anchor"></i>
                    <span class="link-title">Advanced UI</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse {{ show_class(['advanced-ui/*']) }}" id="advanced-ui">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ url('/advanced-ui/cropper') }}"
                                class="nav-link {{ active_class(['advanced-ui/cropper']) }}">Cropper</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/advanced-ui/owl-carousel') }}"
                                class="nav-link {{ active_class(['advanced-ui/owl-carousel']) }}">Owl Carousel</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/advanced-ui/sweet-alert') }}"
                                class="nav-link {{ active_class(['advanced-ui/sweet-alert']) }}">Sweet Alert</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item {{ active_class(['forms/*']) }}">
                <a class="nav-link" data-bs-toggle="collapse" href="#forms" role="button"
                    aria-expanded="{{ is_active_route(['forms/*']) }}" aria-controls="forms">
                    <i class="link-icon" data-feather="inbox"></i>
                    <span class="link-title">Forms</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse {{ show_class(['forms/*']) }}" id="forms">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ url('/forms/basic-elements') }}"
                                class="nav-link {{ active_class(['forms/basic-elements']) }}">Basic Elements</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/forms/advanced-elements') }}"
                                class="nav-link {{ active_class(['forms/advanced-elements']) }}">Advanced
                                Elements</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/forms/editors') }}"
                                class="nav-link {{ active_class(['forms/editors']) }}">Editors</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/forms/wizard') }}"
                                class="nav-link {{ active_class(['forms/wizard']) }}">Wizard</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item {{ active_class(['charts/*']) }}">
                <a class="nav-link" data-bs-toggle="collapse" href="#charts" role="button"
                    aria-expanded="{{ is_active_route(['charts/*']) }}" aria-controls="charts">
                    <i class="link-icon" data-feather="pie-chart"></i>
                    <span class="link-title">Charts</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse {{ show_class(['charts/*']) }}" id="charts">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ url('/charts/apex') }}"
                                class="nav-link {{ active_class(['charts/apex']) }}">Apex</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/charts/chartjs') }}"
                                class="nav-link {{ active_class(['charts/chartjs']) }}">ChartJs</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/charts/flot') }}"
                                class="nav-link {{ active_class(['charts/flot']) }}">Flot</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/charts/morrisjs') }}"
                                class="nav-link {{ active_class(['charts/morrisjs']) }}">MorrisJs</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/charts/peity') }}"
                                class="nav-link {{ active_class(['charts/peity']) }}">Peity</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/charts/sparkline') }}"
                                class="nav-link {{ active_class(['charts/sparkline']) }}">Sparkline</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item {{ active_class(['tables/*']) }}">
                <a class="nav-link" data-bs-toggle="collapse" href="#tables" role="button"
                    aria-expanded="{{ is_active_route(['tables/*']) }}" aria-controls="tables">
                    <i class="link-icon" data-feather="layout"></i>
                    <span class="link-title">Tables</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse {{ show_class(['tables/*']) }}" id="tables">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ url('/tables/basic-tables') }}"
                                class="nav-link {{ active_class(['tables/basic-tables']) }}">Basic Tables</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/tables/data-table') }}"
                                class="nav-link {{ active_class(['tables/data-table']) }}">Data Table</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item {{ active_class(['icons/*']) }}">
                <a class="nav-link" data-bs-toggle="collapse" href="#icons" role="button"
                    aria-expanded="{{ is_active_route(['icons/*']) }}" aria-controls="icons">
                    <i class="link-icon" data-feather="smile"></i>
                    <span class="link-title">Icons</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse {{ show_class(['icons/*']) }}" id="icons">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ url('/icons/feather-icons') }}"
                                class="nav-link {{ active_class(['icons/feather-icons']) }}">Feather Icons</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/icons/flag-icons') }}"
                                class="nav-link {{ active_class(['icons/flag-icons']) }}">Flag Icons</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/icons/mdi-icons') }}"
                                class="nav-link {{ active_class(['icons/mdi-icons']) }}">Mdi Icons</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item nav-category">Pages</li>
            <li class="nav-item {{ active_class(['general/*']) }}">
                <a class="nav-link" data-bs-toggle="collapse" href="#general" role="button"
                    aria-expanded="{{ is_active_route(['general/*']) }}" aria-controls="general">
                    <i class="link-icon" data-feather="book"></i>
                    <span class="link-title">Special Pages</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse {{ show_class(['general/*']) }}" id="general">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ url('/general/blank-page') }}"
                                class="nav-link {{ active_class(['general/blank-page']) }}">Blank page</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/general/faq') }}"
                                class="nav-link {{ active_class(['general/faq']) }}">Faq</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/general/invoice') }}"
                                class="nav-link {{ active_class(['general/invoice']) }}">Invoice</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/general/profile') }}"
                                class="nav-link {{ active_class(['general/profile']) }}">Profile</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/general/pricing') }}"
                                class="nav-link {{ active_class(['general/pricing']) }}">Pricing</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/general/timeline') }}"
                                class="nav-link {{ active_class(['general/timeline']) }}">Timeline</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item {{ active_class(['auth/*']) }}">
                <a class="nav-link" data-bs-toggle="collapse" href="#auth" role="button"
                    aria-expanded="{{ is_active_route(['auth/*']) }}" aria-controls="auth">
                    <i class="link-icon" data-feather="unlock"></i>
                    <span class="link-title">Authentication</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse {{ show_class(['auth/*']) }}" id="auth">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ url('/auth/login') }}"
                                class="nav-link {{ active_class(['auth/login']) }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/auth/register') }}"
                                class="nav-link {{ active_class(['auth/register']) }}">Register</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item {{ active_class(['error/*']) }}">
                <a class="nav-link" data-bs-toggle="collapse" href="#error" role="button"
                    aria-expanded="{{ is_active_route(['error/*']) }}" aria-controls="error">
                    <i class="link-icon" data-feather="cloud-off"></i>
                    <span class="link-title">Error</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse {{ show_class(['error/*']) }}" id="error">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ url('/error/404') }}"
                                class="nav-link {{ active_class(['error/404']) }}">404</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/error/500') }}"
                                class="nav-link {{ active_class(['error/500']) }}">500</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item nav-category">Docs</li>
            <li class="nav-item">
                <a href="https://www.nobleui.com/laravel/documentation/docs.html" target="_blank" class="nav-link">
                    <i class="link-icon" data-feather="hash"></i>
                    <span class="link-title">Documentation</span>
                </a>
            </li>
        </ul>
    </div>
</nav>
{{-- <nav class="settings-sidebar">
    <div class="sidebar-body">
        <a href="#" class="settings-sidebar-toggler">
            <i data-feather="settings"></i>
        </a>
        <h6 class="text-muted mb-2">Sidebar:</h6>
        <div class="mb-3 pb-3 border-bottom">
            <div class="form-check form-check-inline">
                <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="sidebarThemeSettings" id="sidebarLight"
                        value="sidebar-light" checked>
                    Light
                </label>
            </div>
            <div class="form-check form-check-inline">
                <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="sidebarThemeSettings" id="sidebarDark"
                        value="sidebar-dark">
                    Dark
                </label>
            </div>
        </div>
        <div class="theme-wrapper">
            <h6 class="text-muted mb-2">Light Version:</h6>
            <a class="theme-item active" href="https://www.nobleui.com/laravel/template/demo1/">
                <img src="{{ url('assets/images/screenshots/light.jpg') }}" alt="light version">
            </a>
            <h6 class="text-muted mb-2">Dark Version:</h6>
            <a class="theme-item" href="https://www.nobleui.com/laravel/template/demo2/">
                <img src="{{ url('assets/images/screenshots/dark.jpg') }}" alt="light version">
            </a>
        </div>
    </div>
</nav> --}}
