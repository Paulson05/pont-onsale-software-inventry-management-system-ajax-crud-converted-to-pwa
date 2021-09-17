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

                <li class="{{ Route::currentRouteNamed('pending.list') ? 'active' : '' }}" >
                    <a href="{{route('pending.list')}}">
                        <span class="sidebar-mini-icon">PL</span>
                        <span class="sidebar-normal">Pending list</span>
                    </a>
                </li>

                <li class="{{ Route::currentRouteNamed('daily.purchase.report') ? 'active' : '' }}" >
                    <a href="{{route('daily.purchase.report')}}">
                        <span class="sidebar-mini-icon">DR</span>
                        <span class="sidebar-normal">Daily Report </span>
                    </a>
                </li>

            </ul>
        </div>


    </li>

    <li  >


        <a data-toggle="collapse" href="#componentsExamples" >

            <i class="now-ui-icons education_atom"></i>

            <p>
               Invoice<b class="caret"></b>
            </p>
        </a>

        <div class="collapse " id="componentsExamples">
            <ul class="nav">

                <li class="{{ Route::currentRouteNamed('pending.list') ? 'active' : '' }}" >
                    <a href="{{Route('invoice.index')}}">
                        <span class="sidebar-mini-icon">AI</span>
                        <span class="sidebar-normal">Add Invoice</span>
                    </a>
                </li>

                <li class="{{ Route::currentRouteNamed('invoice.daily.report') ? 'active' : '' }}" >
                    <a href="{{Route('invoice.daily.report')}}">
                        <span class="sidebar-mini-icon">DI</span>
                        <span class="sidebar-normal">Daily invoice </span>
                    </a>
                </li>

                <li class="{{ Route::currentRouteNamed('invoice.print-list') ? 'active' : '' }}" >
                    <a href="{{Route('invoice.print-list')}}">
                        <span class="sidebar-mini-icon">PI</span>
                        <span class="sidebar-normal">Print Invoice</span>
                    </a>
                </li>

                <li  class="{{ Route::currentRouteNamed('invoice.list') ? 'active' : '' }}" >
                    <a href="{{route('invoice.list')}}">
                        <span class="sidebar-mini-icon">IL</span>
                        <span class="sidebar-normal">Invoice List</span>
                    </a>
                </li>

            </ul>
        </div>


    </li>

    <li >


        <a data-toggle="collapse" href="#formsExamples" >

            <i class="now-ui-icons files_single-copy-04"></i>

            <p>
                Stock Managment<b class="caret"></b>
            </p>
        </a>

        <div class="collapse " id="formsExamples">
            <ul class="nav">

                <li >
                    <a href="{{route('stock.report')}}">
                        <span class="sidebar-mini-icon">SR</span>
                        <span class="sidebar-normal">STOCK Report</span>
                    </a>
                </li>

                <li >
                    <a href="{{route('supplier.wise.report')}}">
                        <span class="sidebar-mini-icon">SWR</span>
                        <span class="sidebar-normal">Supplier Wise Report </span>
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
