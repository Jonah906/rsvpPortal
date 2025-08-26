@extends('frontend.layouts.app')

@section('content')
    <section class="hero-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="hero-text">
                        <h1>DR. HENRY OMOROGIEVA AKPATA</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="hero-slider owl-carousel">
            <div class="hs-item set-bg" data-setbg="{{ asset('frontend/img/hero/babs.jpg') }}"></div>
        </div>
    </section>

    {{-- <section class="services-section spad">
    </section> --}}

    <section class="hp-room-section">
        <div class="container-fluid">
            <div class="hp-room-items">
                <h2 style="text-align: center; text-decoration: underline; margin-bottom: 40px;">GALLERY</h2>
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="hp-room-item set-bg" data-setbg="frontend/img/hero/dr.jpg">
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="hp-room-item set-bg" data-setbg="frontend/img/hero/son.jpg">
                        
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="hp-room-item set-bg" data-setbg="frontend/img/hero/this.jpg">
                    
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="hp-room-item set-bg" data-setbg="frontend/img/hero/1.jpg">
                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="blog-section spad">
    </section>
@endsection
@section('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            Swal.fire({
                title: "Are you attending?",
                icon: "question",
                showCancelButton: true,
                confirmButtonText: "Yes",
                cancelButtonText: "No",
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ route('rsvp.index') }}";
                }else{
                    window.location.href = "/";
                }
            });
        });
    </script>
@endsection