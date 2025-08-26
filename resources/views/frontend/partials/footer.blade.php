<!-- Footer Section Begin -->
<footer class="footer-section">
    <div class="container">
        <div class="footer-text">
            <div class="row">
                <div class="col-lg-5">
                    <div class="ft-about">
                        <div class="logo">
                            <a href="{{ route('frontend.index') }}">
                                <p>DR.HENRY OMOROGIEVA AKPATA</p>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 offset-lg-1">
                    <div class="ft-contact">
                        
                        <a href="#"><h6>Contact</h6></a>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="copyright-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <ul>
                        <li><a href="{{ route('frontend.index') }}">Home</a></li>
                        <li><a href="{{ route('frontend.venue') }}">The Venues</a></li>
                        <li><a href="{{ route('frontend.committee') }}">Contact Persons</a></li>
                        <li><a href="{{ route('rsvp.index') }}">RSVP</a></li>
                        <li><a href="{{ route('tribute.index') }}">Submit Tribute</a></li>
                    </ul>
                </div>
                <div class="col-lg-5">
                    <div class="co-text">
                        <p style="color:white;">
                            Copyright &copy;<script>
                                document.write(new Date().getFullYear());
                            </script> VonCap Advisory</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Footer Section End -->
@include('frontend.layouts.scripts')