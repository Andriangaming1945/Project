<div id="sidebar-nav" class="sidebar">
    <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 95%;"><div class="sidebar-scroll" style="overflow: hidden; width: auto; height: 95%;">
        <nav>
            <ul class="nav">
                <li><a href="/dashboard " class="active"><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>

                @if(auth()->user()->role == 'admin')
                <li><a href="/siswa" class=""><i class="lnr lnr-user"></i> <span>Siswa</span></a></li>
                @endif
            </ul>
        </nav>
    </div><div class="slimScrollBar" style="background: rgb(0, 0, 0); width: 7px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 586px;"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;"></div></div>
</div>