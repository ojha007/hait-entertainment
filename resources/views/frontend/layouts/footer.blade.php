<footer
    class="footer p-5 fs-6 pb-3"
    style="background:#000000;border-top-right-radius:100px"
>

    <div class="container-lg">
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3">
            <div class="">
                <div class="img-container">
                    <img src="{{asset('main-logo.png')}}" style="height: 8rem" alt="{{config('app.name')}}"/>
                </div>
                <h3 class="mt-3">Hait Entertainment</h3>
                <p class="d-block mt-2"> Hassle Free Ticketing <br> at your finger tips</p>
                <div class="tnc-container mt-2 text-sm">
                    <a class="underline d-block" href="{{url('terms-and-condition')}}">Terms and Condition</a>
                    <a class="underline mt-1 d-block" href="{{url('privacy-policy')}}">Privacy Policy</a>
                </div>
            </div>
            <div class=" mt-5 mt-md-0">
                <h3 class="mb-3">Contact</h3>
                <ul class="ml-0 pl-0">
                    <li class="d-flex align-items-center">
                        <h2 class="ic-marker text-primary mr-2"></h2>
                        <div>
                            <p>306/343 Little Collins Street, </p>
                            <p>Melbourne VIC </p>
                        </div>
                    </li>
                    <li class="d-flex align-items-center mt-4">
                        <h2 class="ic-phone text-primary mr-2"></h2>
                        <div>
                            <p>We are also available on WhatsApp and Viber </p>
                            <p class="font-bold mt-1"><a href="tel:0424451758">0424451758</a></p>
                        </div>
                    </li>
                </ul>
            </div>

            <div class=" mt-5 mt-lg-0">
                <h3 class="mb-3">Follow us</h3>
                <ul class="ml-0 pl-0" style="list-style: none">
                    <li class="mt-3">
                        <a href="https://www.facebook.com/registeredremit" class="d-flex align-items-center">
                            <h3 class="ic-facebook text-primary d-inline-block mr-2"></h3> <span>facebook/hait_entertainment</span>
                        </a>
                    </li>
                    <li class="mt-3">
                        <a href="https://www.instagram.com/registered_remit" class="d-flex align-items-center">
                            <h3 class="ic-instagram text-primary d-inline-block mr-2"></h3> <span>instagram/hait_entertainment</span>
                        </a>
                    </li>
                </ul>
            </div>

        </div>
    </div>
    <p class="text-center mt-5">©<span id="footer-date"></span>. All rights reserved. Hait Entertainment</p>
</footer>
