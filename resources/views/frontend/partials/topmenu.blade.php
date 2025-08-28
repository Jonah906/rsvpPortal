 <!-- Offcanvas Menu Section Begin -->
 <div class="offcanvas-menu-overlay"></div>
 <div class="canvas-open">
    <i class="icon_menu"></i>
 </div>
 <div class="offcanvas-menu-wrapper">
    <div class="canvas-close">
        <i class="icon_close"></i>
    </div>

    <div class="header-configure-area">
        <div class="language-option"></div>
    </div>
    <nav class="mainmenu mobile-menu">
    <ul>
        <li class="active"><a href="{{ route('frontend.index') }}">Home</a></li>
        <li><a href="{{ route('frontend.venue') }}">The Venues</a></li>
        <li><a href="{{ route('frontend.committee') }}">Planning Committee</a></li>
        <li>RSVP
            <ul class="dropdown">
                <li><a href="{{ route('rsvp.index') }}">Registration</a></li>
                <li><a href="{{ route('frontend.vehicle') }}">Vehicle Service</a></li>
                <li><a href="{{ route('frontend.cloth') }}">Aso Ebi</a></li>
                <li><a href="{{ route('rsvp.ref_tag') }}">Edit Reservation</a></li>
            </ul>
        </li>
	    <li><a href="{{ route('tribute.index') }}">Submit Tribute</a></li>
        <li><a href="{{ route('tribute.index') }}">Tester CI/CD</a></li>
    </ul>
    </nav>
    <div id="mobile-menu-wrap"></div>
</div>