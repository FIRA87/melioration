@php
    $id = Auth::user()->id;
    $userid = App\Models\User::find($id);
    $status = $userid->status;
@endphp

<div class="left-side-menu">
    <div class="h-100" data-simplebar>
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <ul id="side-menu">
                <li class="menu-title">Навигация</li>
                <li>
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="mdi mdi-view-dashboard-outline"></i>
                        <span> Панель инструментов </span>
                    </a>
                </li>

                @if ($status == 'active')
                    <li>
                        <a href="#media" data-bs-toggle="collapse">
                            <i class="mdi mdi-folder-multiple-image"></i>
                            <span> Медиабиблиотека </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="media">
                            <ul class="nav-second-level"> <li style="margin-left: -20px"> <a href="{{ route('media.index') }}"><i class="mdi mdi-animation"></i> Все </a></li>
                            </ul>
                        </div>
                    </li>



                    <li>
                        <a href="#page" data-bs-toggle="collapse">
                            <i class="mdi mdi-menu"></i>
                            <span> Меню </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="page">
                            <ul class="nav-second-level">
                                <li> <a href="{{ route('all.pages') }}"> <i class="mdi mdi-animation"></i> Все</a></li>
                                <li> <a href="{{ route('add.pages') }}"> <i class="mdi mdi-database-plus"></i> Добавить</a> </li>
                            </ul>
                        </div>
                    </li>


                    <li>
                        <a href="#page-munu" data-bs-toggle="collapse">
                            <i class="mdi mdi-menu-open"></i>
                            <span>Подменю </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="page-munu">
                            <ul class="nav-second-level">
                                <li style="margin-left: -20px">
                                    <a href="{{ route('all.submenu') }}"><i class="mdi mdi-animation"></i> Все
                                        </a>
                                </li>
                                <li style="margin-left: -20px">
                                    <a href="{{ route('add.submenu') }}"><i class="mdi mdi-database-plus"></i>
                                        Добавить
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>





                    <li>
                        <a href="#sidebarEcommerce" data-bs-toggle="collapse">
                            <i class="mdi mdi-tag-multiple"></i>
                            <span> Категория </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="sidebarEcommerce">
                            <ul class="nav-second-level">
                                <li style="margin-left: -20px">
                                    <a href="{{ route('all.category') }}"><i class="mdi mdi-animation"></i> Все
                                        </a>
                                </li>
                                <li style="margin-left: -20px">
                                    <a href="{{ route('add.category') }}"><i class="mdi mdi-database-plus"></i> Добавить
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>



                    <li>
                        <a href="#Link" data-bs-toggle="collapse">
                            <i class="mdi mdi-link"></i>
                            <span>Ссылки </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="Link">
                            <ul class="nav-second-level">
                                <li style="margin-left: -20px">
                                    <a href="{{ route('all.links') }}"><i class="mdi mdi-animation"></i> Все </a>
                                </li>
                                <li style="margin-left: -20px">
                                    <a href="{{ route('add.links') }}"><i class="mdi mdi-database-plus"></i> Добавить
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>




                    <li class="menu-title mt-2">Контент</li>

                    <li>
                        <a href="#sidebarAuth" data-bs-toggle="collapse">
                            <i class="mdi mdi-newspaper"></i>
                            <span> Настройка новостей </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="sidebarAuth">
                            <ul class="nav-second-level">
                                <li style="margin-left: -20px">
                                    <a href="{{ route('all.news') }}"><i class="mdi mdi-animation"></i> Все
                                        </a>
                                </li>
                                <li style="margin-left: -20px">
                                    <a href="{{ route('add.news') }}"><i class="mdi mdi-database-plus"></i>
                                        Добавить </a>
                                </li>

                            </ul>
                        </div>
                    </li>


                    <li>
                        <a href="#sidebarCrm" data-bs-toggle="collapse">
                            <i class="mdi mdi-video"></i>
                            <span> Настройка видео </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="sidebarCrm">
                            <ul class="nav-second-level">
                                <li style="margin-left: -20px">
                                    <a href="{{ url('all/video') }}"><i class="mdi mdi-animation"></i> Все </a>
                                </li>
                                <li style="margin-left: -20px">
                                    <a href="{{ route('add.video') }}"><i class="mdi mdi-database-plus"></i> Добавить
                                    </a>
                                </li>

                            </ul>
                        </div>
                    </li>


                    <li>
                        <a href="#sidebarExpages" data-bs-toggle="collapse">
                            <i class="mdi mdi-image-multiple"></i>
                            <span>Галерея </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="sidebarExpages">
                            <ul class="nav-second-level">
                                <li style="margin-left: -20px">
                                    <a href="{{ route('all.gallery') }}"><i class="mdi mdi-animation"></i> Все
                                        </a>
                                </li>

                                <li style="margin-left: -20px">
                                    <a href="{{ route('add.gallery') }}"><i class="mdi mdi-database-plus"></i>
                                        Добавить </a>
                                </li>


                            </ul>
                        </div>
                    </li>

                    <li>
                        <a href="#sidebarPresident" data-bs-toggle="collapse">
                            <i class="mdi mdi-account-star"></i>
                            <span>Президент </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="sidebarPresident">
                            <ul class="nav-second-level">
                                <li style="margin-left: -20px">
                                    <a href="{{ route('all.presidents') }}"><i class="mdi mdi-animation"></i> Все
                                        </a>
                                </li>
                                <li style="margin-left: -20px">
                                    <a href="{{ route('add.presidents') }}"><i class="mdi mdi-database-plus"></i>
                                        Добавить </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li>
                        <a href="#sidebarProjects" data-bs-toggle="collapse">
                            <i class="mdi mdi-folder-star"></i>
                            <span>Проекты </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="sidebarProjects">
                            <ul class="nav-second-level">
                                <li style="margin-left: -20px">
                                    <a href="{{ route('all.projects') }}"><i class="mdi mdi-animation"></i> Все
                                        </a>
                                </li>
                                <li style="margin-left: -20px">
                                    <a href="{{ route('add.projects') }}"><i class="mdi mdi-database-plus"></i>
                                        Добавить </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li>
                        <a href="#sidebarTasks" data-bs-toggle="collapse">
                            <i class="mdi mdi-format-list-checks"></i>
                            <span>Задачи </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="sidebarTasks">
                            <ul class="nav-second-level">
                                <li style="margin-left: -20px">
                                    <a href="{{ route('all.tasks') }}"><i class="mdi mdi-animation"></i> Все
                                        </a>
                                </li>
                                <li style="margin-left: -20px">
                                    <a href="{{ route('add.tasks') }}"><i class="mdi mdi-database-plus"></i> Добавить
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li>
                        <a href="#sidebarServices" data-bs-toggle="collapse">
                            <i class="mdi mdi-cog-outline"></i>
                            <span>Услуги </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="sidebarServices">
                            <ul class="nav-second-level">
                                <li style="margin-left: -20px">
                                    <a href="{{ route('all.services') }}"><i class="mdi mdi-animation"></i> Все
                                        </a>
                                </li>
                                <li style="margin-left: -20px">
                                    <a href="{{ route('add.services') }}"><i class="mdi mdi-database-plus"></i>
                                        Добавить </a>
                                </li>

                                <li style="margin-left: -20px">
                                    <a href="{{ route('all.service.requests') }}"><i class="mdi mdi-animation"></i> Заявки на услуги  </a>
                                </li>


                            </ul>
                        </div>
                    </li>

                    <li class="menu-title mt-2">Настройка</li>

                    <li>
                        <a href="#setting" data-bs-toggle="collapse">
                            <i class="mdi mdi-wrench"></i>
                            <span> Настройка сайта </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="setting">
                            <ul class="nav-second-level">
                                <li style="margin-left: -20px">
                                    <a href={{ route('setting.index') }}><i class="mdi mdi-cog"></i>
                                        Настройка</a>
                                </li>

                            </ul>
                        </div>
                    </li>




                    <li>
                        <a href="#sidebarEmail" data-bs-toggle="collapse">
                            <i class="mdi mdi-account-multiple"></i>
                            <span> Пользователи</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="sidebarEmail">
                            <ul class="nav-second-level">
                                <li style="margin-left: -20px">
                                    <a href="{{ route('all.admin') }}"><i class="mdi mdi-animation"></i> Все
                                        пользователи</a>
                                </li>
                                <li style="margin-left: -20px">
                                    <a href="{{ route('add.admin') }}"><i class="mdi mdi-database-plus"></i> Добавить
                                    </a>
                                </li>


                            </ul>
                        </div>
                    </li>

                    <li>
                        <a href="#sidebarRole" data-bs-toggle="collapse">
                            <i class="mdi mdi-shield-half-full"></i>
                            <span> Роли и права</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="sidebarRole">
                            <ul class="nav-second-level">
                                <li style="margin-left: -20px">
                                    <a href="{{ route('all.permission') }}"><i class="mdi mdi-account"></i> Все
                                        разрешения</a>
                                </li>
                                <li style="margin-left: -20px">
                                    <a href="{{ route('all.roles') }}"><i class="mdi mdi-account-key"></i> Роли
                                        пользователей</a>
                                </li>
                                <li style="margin-left: -20px">
                                    <a href="{{ route('add.roles.permission') }}"><i class="mdi mdi-account-key"></i>
                                        Добавить разрешение для роли</a>
                                </li>
                                <li style="margin-left: -20px">
                                    <a href="{{ route('all.roles.permission') }}"><i
                                            class="mdi mdi-database-plus"></i> Все роли с разрешениями</a>
                                </li>

                            </ul>
                        </div>
                    </li>
                @else
                @endif

            </ul>

        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
