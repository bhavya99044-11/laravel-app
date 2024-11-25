<div>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js
                                                "></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link
        href="
            https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css
            "
        rel="stylesheet">
</div>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        :root {
            --header-color: white;
            --website-background: #F2F9FF;
            --button-hover: #3E83FD;
        }

        .navbar {
            background-color: transparent;
            display: flex;
            align-items: center;
            padding: 1.5rem;
        }

        .header-background {
            background-color: var(--header-color);
            border-radius: 40px;
            box-shadow: 1px 2px 10px rgba(0, 0, 0, 0.2);
            padding: 0.5rem 1.3rem;
        }

        .hero {
            margin-top: 123px;
            height: auto;
        }

        .working-button {
            background-color: #E2F0FE;
            color: #3E83FD;
            font-weight: 500;
            font-size: 1.2rem;
            border: none;
            padding: 10px;
            border-radius: 50px;
            margin-bottom: 0px;
        }

        .workin-button:hover {}

        .hero h1 {
            font-size: 56px;
        }

        .hero-buttons a {
            border-radius: 50px;
            padding: 10px 15px;
        }

        .hero-buttons a:hover {
            filter: brightness(60%);

        }

        .working-button i {
            transition: 0.70s;
            -webkit-transition: 0.70s;
            -moz-transition: 0.70s;
            -ms-transition: 0.70s;
            -o-transition: 0.70s;

        }

        .working-button:hover i {
            transition: 0.70s;
            -webkit-transition: 0.70s;
            -moz-transition: 0.70s;
            -ms-transition: 0.70s;
            -o-transition: 0.70s;
            -webkit-transform: rotate(180deg);
            -moz-transform: rotate(180deg);
            -o-transform: rotate(180deg);
            -ms-transform: rotate(180deg);
            transform: rotate(180deg);

        }


        .hero-stats .start-icon {
            height: 50px;
            width: 50px;
            justify-content: center;
            border-radius: 50%;
            margin-right: 10px;
            transition: 0.5s ease;
        }

        .hero-stats:hover .start-icon {
            background-color: var(--button-hover);
        }

        .hero-stats .content {
            height: 50px;

        }

        .hero-stats {
            gap: 1rem;
        }

        .hero .hero-stats i {
            font-size: 30px;
        }

        .hero-stats-section {
            background-color: var(--website-background)
        }

        .about-us {
            margin: 100px auto;
        }

        .about-us-content p {
            text-align: justify;
        }



        ul {
            list-style-type: none;
            padding: 0 !important;
        }


        .about-us .feature-list ul li {
            font-size: 17px;
            font-weight: 450;
            margin-bottom: 14px;
            color: rgb(87, 87, 87);
        }

        .about-us .feature-list ul li i {
            margin-right: 10px;
        }

        .feature-list {
            justify-content: start;
        }

        .about-us .info-wrapper img {
            width: 20%;
            border-radius: 50%;

            float: left;
        }

        .info-wrapper .contact {
            display: flex;
            align-items: center;
            height: 50px;
        }

        .about-us .images {
            width: 100%;
            height: 100%;
        }

        .about-us .images img {
            width: 100%;
            height: 100%;
            border-radius: 10px;
        }

        .second-img {
            position: absolute;
            max-height: 50%;
            max-width: 200px;
            /* margin-left: -200px; */
            left: -75px;
            top: 25%;
            border: 7px solid white;
            /* float: left; */

        }

        .feature-text {
            cursor: pointer;
            position: relative;
        }

        .feature-text:hover::before {
            transition: 0.5s;

            scale: (1);
            opacity: 1;
        }

        .feature-text::before {
            content: "";
            width: 135px;
            height: 2px;
            background: #000;
            left: auto;
            bottom: -6px;
            opacity: 0;
            scale: (0.5);
            position: absolute;
        }

        .top-button {
            transform-origin: bottom;
            transform: translateY(-10px);
            transition: 0.5s ease;
            visibility: hidden;
            position: fixed;
            bottom: -15px;
            opacity: 0;
            right: 10px;
            z-index: 99;
        }

        .top-button.active {
            visibility: visible;
            opacity: 1;
            bottom: 15px;
        }

        /* .top-button .show{
            opacity: 1 !important;
            visibility: visible !   important;
        } */


        .feature-text {
            /* animation: MoveUpDown 2s linear infinite; */

        }

        .floating-container {
            position: absolute;
            /* top: -10px; */
            bottom: 6%;
            right: 6%;
            color: white;
            padding: 5px;
            border-radius: 5px;
            animation: MoveUpDown 2s infinite;
            background-color: var(--button-hover);
        }


        .floating-container span {
            font-size: 17px;
        }

        .price-list li {
            margin-top: 10px;
        }

        .price-list li i {
            margin-right: 10px;
            font-size: 1.1rem;
            color: blue;
        }

        @keyframes MoveUpDown {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .pricing-details {
            margin-top: 100px;
        }

        .pricing-details .dollar {
            font-size: 25px;
            font-weight: 900;
        }

        .pricing-details .price-amount {
            font-size: 40px;
            font-weight: 900;

        }

        .pricing-details .price-card {
            padding: 35px;
        }

        .price-card a {
            font-size: 20px;
            font-weight: 800;
            padding: 10px;
            border-radius: 50px;
            width: 100%;
        }
        .price-card{
            border-radius: 50px;
            /* margin-right: 10px; */
        }

        .price-card.second-card li i{
            color: white;
        }

        .price-card:hover{
            box-shadow: 0 0 10px grey;
            }

        @media screen and (max-width:766px) {

            .feature-buttons{
                display: flex;
                flex-direction: column;
            }
            .feature-buttons >*{
                margin: 5px 0;

            }
            .hero h1 {
                font-size: 30px;
                text-align: justify;
            }

            .hero p {
                text-align: justify;
            }

            .hero .sm-margin {
                margin-top: 2rem;
            }

            .hero .hero-buttons {
                text-align: center;
            }

            .about-us .images {
                position: absolute;
                display: flex;
                flex-direction: column;
                width: 100%;
            }

            .second-img {
                position: static;
                object-fit: contain;
                max-width: 100% !important;
                max-height: 100% !important;
            }

            .about-us .contact {
                margin-left: 5px;
            }

            .floating-container {
                margin-top: 30px;
                width: 100%;
                position: static;
            }


        }
    </style>


</head>

<body>

    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container  header-background" id="nav">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#hero">Section</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Projects</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-lg-none" href="#">Testimonials</a>
                    </li>
                </ul>
                <a class="btn btn-outline-primary d-none d-lg-block" href="#">Let's Talk</a>
            </div>
        </div>
    </nav>

    <div class="top-button"><a class="btn btn-primary btn-outline-dark rounded-5">Top</a></div>

    <section class="hero" id="hero">

        <div class="container">

            <div class="row align-items-center">
                <div class="col-md-6 sm-margin col-sm-12 order-md-fisrt order-last">
                    <button class="working-button flex-start mb-4"><i class="fa fa-cog" aria-hidden="true"></i>
                        Working for your success</button>
                    <h1 class="">
                        Maecenas Vitae
                        <br>
                        Consectetur Led
                        <br>
                        <span class="text-primary">Vestibulum Ante</span>
                    </h1>
                    <p class="mt-4">Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed
                        fringilla mauris sit amet nibh. Donec sodales sagittis magna.</p>

                    <div class="hero-buttons mt-5">
                        <a href="#" class="btn btn-primary">Discover More</a>
                        <a href="#" class="btn btn-outline-primary ms-2">Contact Us</a>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 order-md-last order-first">
                    <img class="img-fluid"
                        src="https://bootstrapmade.com/content/demo/iLanding/assets/img/illustration-1.webp">
                </div>


            </div>

            <div class="row mt-5 hero-stats-section mb-5">
                <div class="col-md-3 d-flex align-items-center p-4  col-12 hero-stats">
                    <div class="start-icon d-flex align-items-center p-4">

                        <i class="fa fa-trophy" aria-hidden="true"></i>
                    </div>
                    <div class="content">
                        <h5> #x won awards</h5>
                        <p class="text-secondary">best award of</p>
                    </div>
                </div>
                <div class="col-md-3 d-flex align-items-center p-4  col-12 hero-stats">
                    <div class="start-icon d-flex align-items-center p-4">

                        <i class="fa fa-trophy" aria-hidden="true"></i>
                    </div>
                    <div class="content">
                        <h5> #x won awards</h5>
                        <p class="text-secondary">best award of</p>
                    </div>
                </div>
                <div class="col-md-3 d-flex align-items-center p-4  col-12 hero-stats">
                    <div class="start-icon d-flex align-items-center p-4">

                        <i class="fa fa-trophy" aria-hidden="true"></i>
                    </div>
                    <div class="content">
                        <h5> #x won awards</h5>
                        <p class="text-secondary">best award of</p>
                    </div>
                </div>
                <div class="col-md-3 d-flex align-items-center p-4  col-12 hero-stats">
                    <div class="start-icon d-flex align-items-center p-4">

                        <i class="fa fa-trophy" aria-hidden="true"></i>
                    </div>
                    <div class="content">
                        <h5> #x won award</h5>
                        <p class="text-secondary">best award of</p>
                    </div>
                </div>

            </div>

        </div>

    </section>

    <section class="about-us" id="about-us">
        <div class="container">
            <h4 class="fw-bold">About us</h4>
            <div class="row gy-4 align-items-center mt-3 about-us-content justify-content-between">
                <div class="col-lg-5 col-12">
                    <h4 class="text-primary">Voluptas enim suscipit temporibus</h4>
                    <p class="mt-3">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium
                        doloremque laudantium,
                        totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae
                        dicta sunt explicabo.</p>
                    <div class="row feature-list mt-4">
                        <div class="col-md-6">
                            <ul class="">
                                <li><i class="bi bi-check-circle-fill text-primary"></i>Lorem ipsum dolor sit amet</li>
                                <li><i class="bi bi-check-circle-fill  text-primary"></i>Lorem ipsum dolor sit amet
                                </li>
                                <li><i class="bi bi-check-circle-fill  text-primary"></i>Lorem ipsum dolor sit amet
                                </li>

                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul class="">
                                <li><i class="bi bi-check-circle-fill text-primary"></i>Lorem ipsum dolor sit amet</li>
                                <li><i class="bi bi-check-circle-fill  text-primary"></i>Lorem ipsum dolor sit amet
                                </li>
                                <li><i class="bi bi-check-circle-fill  text-primary"></i>Lorem ipsum dolor sit amet
                                </li>

                            </ul>
                        </div>

                    </div>

                    <div class="info-wrapper mt-5">
                        <div class="row gy-3">
                            <div class="col-md-5">
                                <div class="profile">
                                    <img class="me-3"
                                        src="https://bootstrapmade.com/content/demo/iLanding/assets/img/avatar-1.webp">
                                    <div>
                                        Mario Smith
                                        <p class="text-primary">CEO & Founder</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="contact">
                                    <i class="bi bi-telephone-fill me-3"></i>
                                    <div class="text-center">
                                        <div class="div text-secondary">Call us anytime</div>
                                        <div class="text-primary">CEO & Founder</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-12">
                    <div class="div images position-relative">
                        <img class="main-img imf-fluid"
                            src="https://bootstrapmade.com/content/demo/iLanding/assets/img/about-5.webp">
                        <img class="second-img rounded-4 img-fluid"
                            src="https://bootstrapmade.com/content/demo/iLanding/assets/img/about-2.webp">
                        <div class="floating-container text-center">
                            <h3>50+ <span>years</span></h3>
                            <div>of experience in business service</div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>


    <section class="features mt-5 mb-5" id="features">
        <div class="container">
            <h2 class="text-center feature-text">Features</h2>
            <p class="text-center mt-5">Necessitatibus eius consequatur ex aliquid fuga eum
                velit
            </p>

            <div class="feature-buttons text-center gy-3">
                <a href="#" class="btn btn-primary rounded-5 me-2">Discover More</a>
                <a href="#" class="btn btn-outline-primary rounded-5 me-2">Contact Us</a>
                <a href="#" class="btn btn-outline-primary rounded-5 me-2">Contact Us</a>

            </div>

            <div class="row pricing-details g-4 justify-content-center">
                <div class="col-md-4 col-lg-4 ">
                    <div class="price-card">
                    <h4>Basic Plan</h4>
                    <div class="price">
                        <span class="dollar align-top">$</span>
                        <span class="price-amount">99.00</span>
                        <span class="month">/months</span>
                    </div>
                    <p class="mt-3">Sed ut perspiciatis unde omnis iste natus error sit
                        doloremque laudantium
                        totam.</p>

                    Feature included:

                    <ul class="price-list mt-4">
                        <li><i class="bi bi-check-circle-fill"></i>Duis aute irure dolor</li>
                        <li><i class="bi bi-check-circle-fill"></i>Excepteur sint occaecat</li>
                        <li><i class="bi bi-check-circle-fill"></i>Nemo enim ipsam voluptatem</li>

                    </ul>

                    <a class="btn btn-primary mt-5">Buy Now</a>
                </div>
                </div>
                <div class="col-md-4  col-lg-4 ">
                    <div class="price-card second-card text-white bg-primary">
                    <h4>Basic Plan</h4>
                    <div class="price">
                        <span class="dollar align-top">$</span>
                        <span class="price-amount">99.00</span>
                        <span class="month">/months</span>
                    </div>
                    <p class="mt-3">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium
                        doloremque laudantium
                        totam.</p>

                    Feature included:

                    <ul class="price-list mt-4">
                        <li><i class="bi bi-check-circle-fill"></i>Duis aute irure dolor</li>
                        <li><i class="bi bi-check-circle-fill"></i>Excepteur sint occaecat</li>
                        <li><i class="bi bi-check-circle-fill"></i>Nemo enim ipsam voluptatem</li>

                    </ul>

                    <a class="btn btn-primary mt-5">Buy Now</a>
                </div>
                </div>
                <div class="col-md-4">cccc</div>

            </div>
        </div>
    </section>
</body>


</body>

</html>

<script>
    window.onload = function() {
        function scrollTop() {
            console.log(1)
        }
        let button = document.querySelector('.top-button');
        button.onclick = function() {
            window.scrollTo(0, 0);
        }
        window.onscroll = function() {
            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                button.classList.add("active");
            } else {
                button.classList.remove('active')
            }
        }
    }
</script>
