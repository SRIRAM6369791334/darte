@extends('layouts.app')
@section('content')
    <style>
        /* FULL PAGE WHITE BACKGROUND */
        body,
        .bg-light,
        .contact-bnr,
        .content-inner-2
        {
            background: #ffffff !important;
        }
        @media (max-width: 767px) {
            #emailicon{
                width: 60px !important;
                height: 60px !important;
                min-width: 60px !important;
                max-width: 60px !important;
                min-height: 60px !important;
                max-height: 60px !important;

                background: rgba(98,157,35,.1);
                color: #629D23;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                margin-right: 15px;
                flex: 0 0 60px !important;
            }

            #emailicon i{
                font-size: 24px !important;
                line-height: 1;
            }
        }
@media only screen and (max-width: 575px) {
    .dz-bnr-inr .dz-bnr-inr-entry {
        padding: 0px 0 0px 0;
        text-align: center;
        display: table-cell;
    }
}
@media only screen and (max-width: 767px) {
    .form-wrapper {
        padding: 25px !important;
    }
}
    </style>

    <div class="page-content bg-light  mt-7">
        <div class="dz-bnr-inr bg-secondary overlay-black-light dz-bnr-inr-md" style="position: relative;min-height: 251px;display: flex;align-items: center;overflow: hidden;z-index: 1;">
            <img src="{{ asset('assets/images/cropped_contact.png') }}" alt="Contact Us Banner" style="position: absolute;top: 0;left: 0;width: 100%;height: 100%;object-fit: revert;object-position: center 15%;z-index: -1;">
            <div class="container" style="position: relative; z-index: 2;">
                <div class="dz-bnr-inr-entry d-table-cell">
                    <h1 class="color1">Contact Us</h1>
                    <nav aria-label="breadcrumb" class="breadcrumb-row">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/"> Home</a></li>
                            <li class="breadcrumb-item">Contact Us</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <!--banner-->
        <div class="contact-bnr bg-light">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="contact-info style-1 text-start">
                            <h2 class="title wow fadeInUp" data-wow-delay="0.1s"
                                style="color: #000; font-weight: 700; margin-bottom: 10px;">CONTACT US</h2>
                            <p class="text wow fadeInUp mb-5" data-wow-delay="0.2s"
                                style="font-size: 18px; color: #555; line-height: 1.6;">
                                {{-- <span style="border-bottom: 2px solid #629D23; padding-bottom: 2px; font-weight: 600;">We’re
                                    here to help.</span><br> --}}

                                If you have any questions, feedback, or support needs, feel free to reach out to us.
                            </p>

                            <div class="contact-boxes row g-4">
                                <div class="col-md-12 wow fadeInUp" data-wow-delay="0.3s">
                                    <div class="info-box d-flex align-items-center p-4"
                                        style="background: #fff; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); border: 1px solid #f0f0f0;">
                                        <div class="icon-bx" id="emailicon"
                                            style="width: 60px; height: 60px; background: rgba(98, 157, 35, 0.1); color: #629D23; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 24px; margin-right: 20px;">
                                            <i class="fa-solid fa-location-dot"></i>
                                        </div>
                                        <div>
                                            <h5 class="mb-1" style="font-weight: 700;">Our Address</h5>
                                            <p class="mb-0 text-dark">46, kumaran colony extension, ammapalayam, Tirupur,
                                                Tamilnadu 641652.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12 wow fadeInUp" data-wow-delay="0.4s">
                                    <div class="info-box d-flex align-items-center p-4"
                                        style="background: #fff; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); border: 1px solid #f0f0f0;">
                                        <div class="icon-bx"
                                            style="width: 60px; height: 60px; background: rgba(0, 123, 255, 0.1); color: #007bff; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 24px; margin-right: 20px;">
                                            <i class="fa-solid fa-envelope"></i>
                                        </div>
                                        <div>
                                            <h5 class="mb-1" style="font-weight: 700;">Email Address</h5>
                                            <p class="mb-0 text-dark"><a
                                                    href="mailto:support@darte.com">support@darte.com</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12 wow fadeInUp" data-wow-delay="0.5s">
                                    <div class="info-box d-flex align-items-center p-4"
                                        style="background: #fff; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); border: 1px solid #f0f0f0;">
                                        <div class="icon-bx"
                                            style="width: 60px; height: 60px; background: rgba(247, 164, 0, 0.1); color: #f7a400; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 24px; margin-right: 20px;">
                                            <i class="fa-solid fa-phone"></i>
                                        </div>
                                        <div>
                                            <h5 class="mb-1" style="font-weight: 700;">Call Us</h5>
                                            <p class="mb-0 text-dark"> <a href="tel:+917810078107">+91 78100 78107
                                                </a></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-wrapper wow fadeInUp" data-wow-delay="0.5s"
                            style="background: #fff; padding: 50px; border-radius: 25px; box-shadow: 0 20px 50px rgba(0,0,0,0.2);">
                            <form id="contact-form" method="POST" action="{{ route('contact.submit') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 mb-2">
                                        <label class="form-label text-50 small mb-2"
                                            style="color: #555!important; font-weight: 500; margin-bottom: 6px; display: block;">Name
                                            *</label>
                                        <input type="text" name="name" class="form-control custom-input"
                                            placeholder="Your Name">
                                        <small class="error-text text-danger"></small>
                                    </div>

                                    <div class="col-md-6 mb-2">
                                        <label class="form-label text-50 small mb-2"
                                            style="color: #555!important; font-weight: 500; margin-bottom: 6px; display: block;">Email
                                            Address *</label>
                                        <input type="email" name="email" class="form-control custom-input"
                                            placeholder="Your Email">
                                        <small class="error-text text-danger"></small>
                                    </div>

                                    <div class="col-md-6 mb-2">
                                        <label class="form-label text-50 small mb-2"
                                            style="color: #555!important; font-weight: 500; margin-bottom: 6px; display: block;">Phone
                                            Number *</label>
                                        <input type="tel" name="phone_number" class="form-control custom-input"
                                            placeholder="Your Phone" oninput="this.value=this.value.replace(/\D/g,'')">
                                        <small class="error-text text-danger"></small>
                                    </div>

                                    <div class="col-md-6 mb-2">
                                        <label class="form-label text-50 small mb-2"
                                            style="color:  #555!important; font-weight: 500; margin-bottom: 6px; display: block;">Subject
                                            *</label>
                                        <select name="subject" class="form-control custom-input">
                                            <option value="">Select Subject</option>
                                            <option value="General Inquiry">General Inquiry</option>
                                            <option value="Order Support">Order Support</option>
                                            <option value="Delivery Issue">Delivery Issue</option>
                                            <option value="Product Question">Product Question</option>
                                            <option value="Other">Other</option>
                                        </select>
                                        <small class="error-text text-danger"></small>
                                    </div>

                                    <div class="col-md-12 mb-4">
                                        <label class="form-label text-white-50 small mb-2"
                                            style="color: #fff; font-weight: 500; margin-bottom: 6px; display: block;">Write
                                            Message *</label>
                                        <textarea name="message" class="form-control custom-input" rows="5" placeholder="How can we help?"></textarea>
                                        <small class="error-text text-danger"></small>
                                    </div>

                                    <div class="col-md-12 text-center mt-2">
                                        <button type="submit" class="btn btn-primary px-5 py-3 w-20"
                                            style="background: #000000; border: none; border-radius: 50px; font-weight: 600; font-size: 18px; transition: 0.3s; color: #fff;">
                                            Send Message
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="content-inner-2 pt-0">
            <div class="map-iframe map">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31315.558130525704!2d77.2650515743164!3d11.154668100000002!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ba907090702beab%3A0x7197b8c8f87da3d5!2sSivaSakthi%20Apparel!5e0!3m2!1sen!2sin!4v1775714413906!5m2!1sen!2sin"
                    width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
                <!-- <iframe
                                                                                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d125282.06393883149!2d77.28141076953816!3d11.10857104732568!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ba907b0424d75b9%3A0x4750551698a91687!2sTiruppur%2C%20Tamil%20Nadu!5e0!3m2!1sen!2sin!4v1775461208711!5m2!1sen!2sin"
                                                                                        width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                                                                                        referrerpolicy="no-referrer-when-downgrade"></iframe> -->
                <!-- <iframe
                                                                                                                                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d227748.3825624477!2d75.65046970649679!3d26.88544791796718!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x396c4adf4c57e281%3A0xce1c63a0cf22e09!2sJaipur%2C+Rajasthan!5e0!3m2!1sen!2sin!4v1500819483219"
                                                                                                                                        style="border:0; width:100%; min-height:100%; margin-bottom: -8px;" allowfullscreen></iframe> -->
            </div>
        </div>

    </div>


    {{--
    <script>
        $(document).ready(function () {
            $('#contact-form').on('submit', function (e) {
                e.preventDefault();

                const form = $(this);
                const submitBtn = form.find('button[type="submit"]');
                const originalBtnText = submitBtn.text();

                submitBtn.prop('disabled', true).text('Sending...');

                $.ajax({
                    url: "{{ route('contact.submit') }}",
                    type: 'POST',
                    data: form.serialize(),
                    success: function (response) {
                        if (response.status === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: response.message,
                                confirmButtonColor: '#629D23'
                            });
                            form[0].reset();
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: response.message
                            });
                        }
                    },
                    error: function (xhr) {
                        let errorMsg = 'An error occurred. Please try again.';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMsg = xhr.responseJSON.message;
                        }
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: errorMsg
                        });
                    },
                    complete: function () {
                        submitBtn.prop('disabled', false).text(originalBtnText);
                    }
                });
            });
        });
    </script> --}}
    <style>
        .custom-input {
            background-color: #ffffff !important;
            border: 1px solid #333 !important;
            color: #555 !important;
            border-radius: 10px !important;
            transition: 0.3s !important;
        }

        .custom-input::placeholder {
            color: #888 !important;
        }

        .custom-input:focus {
            border-color: #000000 !important;
            box-shadow: 0 0 10px rgba(98, 157, 35, 0.2) !important;
        }

        .info-box {
            transition: transform 0.3s ease;
        }

        .info-box:hover {
            transform: translateY(-5px);
        }

        .btn-primary:hover {
            background: #000000 !important;
            transform: scale(1.02);
        }
    </style>

    {{--
    <script>
        $(document).ready(function () {
            $('#contact-form').on('submit', function (e) {
                e.preventDefault();

                const form = $(this);
                const submitBtn = form.find('button[type="submit"]');
                const originalBtnText = submitBtn.text();

                submitBtn.prop('disabled', true).text('Sending...');

                $.ajax({
                    url: "{{ route('contact.submit') }}",
                    type: "POST",
                    data: form.serialize(),

                    success: function (response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: response.message,
                            confirmButtonColor: '#629D23'
                        });

                        form[0].reset();
                    },

                    error: function (xhr) {
                        let errorMsg = 'Something went wrong';

                        if (xhr.responseJSON && xhr.responseJSON.errors) {
                            errorMsg = Object.values(xhr.responseJSON.errors)
                                .map(e => e[0])
                                .join('\n');
                        }

                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: errorMsg
                        });
                    },

                    complete: function () {
                        submitBtn.prop('disabled', false).text(originalBtnText);
                    }
                });
            });
        });
    </script> --}}
@endsection
