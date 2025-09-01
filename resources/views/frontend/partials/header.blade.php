   
<!-- Header Section Begin -->
<header class="header-section">
    <div class="menu-item">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <div class="logo">
                        <a href="{{ route('frontend.index') }}">
                            <p class="hero-name-text">DR.HENRY OMOROGIEVA AKPATA</p>
                            <p class="sub-hero-name-text"><a href="{{ route('frontend.index') }}">Registration Portal for Attendees (RSVP)</a></p>
                        </a>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="nav-menu">
                        <nav class="mainmenu">
                            <ul>
                                <li class="{{ (Request::segment(1) === 'home') ? 'active' : '' }}"><a href="{{ route('frontend.index') }}">Home</a></li>
                                <li class="{{ (Request::segment(1) === 'venue') ? 'active' : '' }}"><a href="{{ route('frontend.venue') }}">The Venues</a></li>
                                <li class="{{ (Request::segment(1) === 'committee') ? 'active' : '' }}"><a href="{{ route('frontend.committee') }}">Planning Committee</a></li>

                                <li class="{{ (Request::segment(1) === 'rsvp') ? 'active' : '' }}"><a href="#">RSVP</a>
                                    <ul class="dropdown">
                                        <li><a href="{{ route('rsvp.index') }}">Registration</a></li>
                                        <li><a href="{{ route('frontend.vehicle') }}">Vehicle Service</a></li>
                                        <li><a href="{{ route('frontend.cloth') }}">Aso Ebi</a></li>
                                        <li><a href="{{ route('rsvp.ref_tag') }}">Edit Reservation</a></li>
                                    </ul>
                                </li>
                                <li class="{{ (Request::segment(1) === 'tribute') ? 'active' : '' }}"><a href="{{ route('tribute.index') }}">Submit Tribute</a></li>
                                <li class="{{ (Request::segment(1) === 'tribute') ? 'active' : '' }}"><a href="{{ route('tribute.index') }}">CI/CD Sub</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- Header End -->