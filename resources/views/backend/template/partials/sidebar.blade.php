<ul class="nav">

    <li class="{{ Route::currentRouteNamed('dashboard') ? 'active' : '' }}"  >


        <a href="{{Route('dashboard')}}">

            <i class="now-ui-icons design_app"></i>

            <p>Dashboard</p>
        </a>

    </li>

    <li >


        <a data-toggle="collapse" href="#pagesExamples" >

            <i class="now-ui-icons design_image"></i>

            <p>
                Pages <b class="caret"></b>
            </p>
        </a>

        <div class="collapse " id="pagesExamples">
            <ul class="nav">

                <li  class="{{ Route::currentRouteNamed('supplier.index') ? 'active' : '' }}" >
                    <a href="{{route('supplier.index')}}">
                        <span class="sidebar-mini-icon">SM</span>
                        <span class="sidebar-normal">Supplier Management</span>
                    </a>
                </li>

                <li  class="{{ Route::currentRouteNamed('customer.index') ? 'active' : '' }}" >
                    <a href="{{route('customer.index')}}">
                        <span class="sidebar-mini-icon">CM</span>
                        <span class="sidebar-normal"> Customer Management</span>
                    </a>
                </li>

                <li class="{{ Route::currentRouteNamed('unit.index') ? 'active' : '' }}" >
                    <a href="{{route('unit.index')}}">
                        <span class="sidebar-mini-icon">UM</span>
                        <span class="sidebar-normal">Unit Management</span>
                    </a>
                </li>

                <li class="{{ Route::currentRouteNamed('category.index') ? 'active' : '' }} ">
                    <a href="{{route('category.index')}}">
                        <span class="sidebar-mini-icon">CM</span>
                        <span class="sidebar-normal">Category Mangement</span>
                    </a>
                </li>

                <li class="{{ Route::currentRouteNamed('product.index') ? 'active' : '' }}" >
                    <a href="{{route('product.index')}}">
                        <span class="sidebar-mini-icon">PM</span>
                        <span class="sidebar-normal">Product Management</span>
                    </a>
                </li>

                <li class="{{ Route::currentRouteNamed('purchase.index') ? 'active' : '' }}" >
                    <a href="{{route('purchase.index')}}">
                        <span class="sidebar-mini-icon">PM</span>
                        <span class="sidebar-normal"> Purchase Management </span>
                    </a>
                </li>

                <li >
                    <a href="pages/lock.html">
                        <span class="sidebar-mini-icon">LS</span>
                        <span class="sidebar-normal"> Lock Screen </span>
                    </a>
                </li>

                <li >
                    <a href="pages/user.html">
                        <span class="sidebar-mini-icon">UP</span>
                        <span class="sidebar-normal"> User Profile </span>
                    </a>
                </li>

            </ul>
        </div>


    </li>

    <li >


        <a data-toggle="collapse" href="#componentsExamples" >

            <i class="now-ui-icons education_atom"></i>

            <p>
                Components <b class="caret"></b>
            </p>
        </a>

        <div class="collapse " id="componentsExamples">
            <ul class="nav">

                <li >
                    <a href="components/buttons.html">
                        <span class="sidebar-mini-icon">B</span>
                        <span class="sidebar-normal"> Buttons </span>
                    </a>
                </li>

                <li >
                    <a href="components/grid.html">
                        <span class="sidebar-mini-icon">G</span>
                        <span class="sidebar-normal"> Grid System </span>
                    </a>
                </li>

                <li >
                    <a href="components/panels.html">
                        <span class="sidebar-mini-icon">P</span>
                        <span class="sidebar-normal"> Panels </span>
                    </a>
                </li>

                <li >
                    <a href="components/sweet-alert.html">
                        <span class="sidebar-mini-icon">SA</span>
                        <span class="sidebar-normal"> Sweet Alert </span>
                    </a>
                </li>

                <li >
                    <a href="components/notifications.html">
                        <span class="sidebar-mini-icon">N</span>
                        <span class="sidebar-normal"> Notifications </span>
                    </a>
                </li>

                <li >
                    <a href="components/icons.html">
                        <span class="sidebar-mini-icon">I</span>
                        <span class="sidebar-normal"> Icons </span>
                    </a>
                </li>

                <li >
                    <a href="components/typography.html">
                        <span class="sidebar-mini-icon">T</span>
                        <span class="sidebar-normal"> Typography </span>
                    </a>
                </li>

            </ul>
        </div>


    </li>

    <li >


        <a data-toggle="collapse" href="#formsExamples" >

            <i class="now-ui-icons files_single-copy-04"></i>

            <p>
                Forms <b class="caret"></b>
            </p>
        </a>

        <div class="collapse " id="formsExamples">
            <ul class="nav">

                <li >
                    <a href="forms/regular.html">
                        <span class="sidebar-mini-icon">RF</span>
                        <span class="sidebar-normal"> Regular Forms </span>
                    </a>
                </li>

                <li >
                    <a href="forms/extended.html">
                        <span class="sidebar-mini-icon">EF</span>
                        <span class="sidebar-normal"> Extended Forms </span>
                    </a>
                </li>

                <li >
                    <a href="forms/validation.html">
                        <span class="sidebar-mini-icon">V</span>
                        <span class="sidebar-normal"> Validation Forms </span>
                    </a>
                </li>

                <li >
                    <a href="forms/wizard.html">
                        <span class="sidebar-mini-icon">W</span>
                        <span class="sidebar-normal"> Wizard </span>
                    </a>
                </li>

            </ul>
        </div>


    </li>

    <li >


        <a data-toggle="collapse" href="#tablesExamples" >

            <i class="now-ui-icons design_bullet-list-67"></i>

            <p>
                Tables <b class="caret"></b>
            </p>
        </a>

        <div class="collapse " id="tablesExamples">
            <ul class="nav">

                <li >
                    <a href="tables/regular.html">
                        <span class="sidebar-mini-icon">RT</span>
                        <span class="sidebar-normal"> Regular Tables </span>
                    </a>
                </li>

                <li >
                    <a href="tables/extended.html">
                        <span class="sidebar-mini-icon">ET</span>
                        <span class="sidebar-normal"> Extended Tables </span>
                    </a>
                </li>

                <li >
                    <a href="tables/datatables.net.html">
                        <span class="sidebar-mini-icon">DT</span>
                        <span class="sidebar-normal"> DataTables.net </span>
                    </a>
                </li>

            </ul>
        </div>


    </li>

    <li >


        <a data-toggle="collapse" href="#mapsExamples" >

            <i class="now-ui-icons location_pin"></i>

            <p>
                Maps <b class="caret"></b>
            </p>
        </a>

        <div class="collapse " id="mapsExamples">
            <ul class="nav">

                <li >
                    <a href="maps/google.html">
                        <span class="sidebar-mini-icon">GM</span>
                        <span class="sidebar-normal"> Google Maps </span>
                    </a>
                </li>

                <li >
                    <a href="maps/fullscreen.html">
                        <span class="sidebar-mini-icon">FM</span>
                        <span class="sidebar-normal"> Full Screen Map </span>
                    </a>
                </li>

                <li >
                    <a href="maps/vector.html">
                        <span class="sidebar-mini-icon">VM</span>
                        <span class="sidebar-normal"> Vector Map </span>
                    </a>
                </li>

            </ul>
        </div>


    </li>

    <li >


        <a href="widgets.html">

            <i class="now-ui-icons objects_diamond"></i>

            <p>Widgets</p>
        </a>

    </li>

    <li >


        <a href="charts.html">

            <i class="now-ui-icons business_chart-pie-36"></i>

            <p>Charts</p>
        </a>

    </li>

    <li >


        <a href="calendar.html">

            <i class="now-ui-icons media-1_album"></i>

            <p>Calendar</p>
        </a>

    </li>



</ul>
