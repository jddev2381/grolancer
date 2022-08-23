@extends('layouts.main')



@section('content')

 <!-- HERO -->
 <section id="home" class="bg-dark text-light p-5 p-lg-0 pt-lg-5 text-center text-sm-start" style="padding-top: 150px !important;">
    <div class="container">
        <div class="d-sm-flex align-items-center justify-content-between">
            <div>
                <h1>The Freelancers' <span class="text-logo">Growth Platform</span></h1>
                <p class="lead my-4">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    Quisquam, quidem.
                </p>
                <a href="/register" class="btn btn-outline-light">Get Started</a>
            </div>
            <img class="img-fluid w-50 d-none d-sm-block" src="img/coding.png" alt="GroLancer">
        </div>
    </div>
</section>







<!-- Newsletter -->
<section class="bg-logo text-light p-5">
    <div class="container">
        <div class="d-md-flex justify-content-between align-items-center">
            <h3 class="mb-3 mb-md-0">Sign Up For Our Newsletter</h3>

            <div class="input-group news-input">
                <input type="text" class="form-control" placeholder="Recipient's Email Address">
                <button class="btn btn-dark btn-lg" type="button">Sign Up</button>
            </div>
        </div>
    </div>
</section>










<!-- Boxes -->
<section class="p-5">
    <div class="container">
        <div class="row gy-4">
            <div class="col-md">
                <div class="card bg-dark text-light">
                    <div class="card-body text-center">
                        <div class="h1 mb-3">
                            <i class="fa-solid fa-users"></i>
                        </div>
                        <h3 class="card-title mb-3">CRM</h3>
                        <p class="card-text">
                            Manage all of your prospects and clients in one place.
                        </p>
                        <a href="#" class="btn btn-outline-light">Learn More</a>
                    </div>
                </div>
            </div>
            <div class="col-md">
                <div class="card bg-secondary text-light">
                    <div class="card-body text-center">
                        <div class="h1 mb-3">
                            <i class="fa-solid fa-file-pen"></i>
                        </div>
                        <h3 class="card-title mb-3">Send Proposals</h3>
                        <p class="card-text">
                            Close more deals by sending professional proposals to your prospects.
                        </p>
                        <a href="#" class="btn btn-dark">Learn More</a>
                    </div>
                </div>
            </div>
            <div class="col-md">
                <div class="card bg-dark text-light">
                    <div class="card-body text-center">
                        <div class="h1 mb-3">
                            <i class="fa-solid fa-file-invoice-dollar"></i>
                        </div>
                        <h3 class="card-title mb-3">Get Paid</h3>
                        <p class="card-text">
                            Send professional invoices with your personal branding and get paid quicker.
                        </p>
                        <a href="#" class="btn btn-outline-light">Learn More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>









<!-- Learn Section -->
<section class="p-5">
    <div class="container">
        <div class="row align-items-center justify-content-between">
            <div class="col-md">
                <img src="img/finance.png" class="img-fluid" alt="">
            </div>
            <div class="col-md p-5">
                <h2 class="text-logo">A Free Forever Plan</h2>
                <p class="lead">
                    Never worry about not having the money to use the tools you've grown to love!
                </p>
                <p>It is our goal at GroLancer to make sure that you and your business are always getting the best possible value for your money. We offer a free forever plan for all of our customers.</p>
                <a href="#" class="btn btn-light mt-3">
                <i class="fa-solid fa-chevron-right"></i> Read more
                </a>
            </div>
        </div>
    </div> 
</section>














<!-- Learn Section -->
<section class="p-5 bg-dark text-light">
    <div class="container">
        <div class="row align-items-center justify-content-between">
            <div class="col-md p-5">
                <h2 class="text-logo">A Free Forever Plan</h2>
                <p class="lead">
                    Never worry about not having the money to use the tools you've grown to love!
                </p>
                <p>It is our goal at GroLancer to make sure that you and your business are always getting the best possible value for your money. We offer a free forever plan for all of our customers.</p>
                <a href="#" class="btn btn-light mt-3">
                <i class="fa-solid fa-chevron-right"></i> Read more
                </a>
            </div>
            <div class="col-md">
                <img src="img/finance.png" class="img-fluid" alt="">
            </div>
        </div>
    </div> 
</section>






<!-- Question Accordion -->
<section id="faq" class="p-5">
    <div class="container">
        <h2 class="text-center mb-4">Frequently Asked Questions</h2>

        <div class="accordion accordion-flush" id="accordionFlushExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingOne">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#q1">
                        Accordion Item #1
                    </button>
                </h2>
                <div id="q1" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the first item's accordion body.</div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#q2">
                        Accordion Item #2
                    </button>
                </h2>
                <div id="q2" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the second item's accordion body. Let's imagine this being filled with some actual content.</div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#q3">
                        Accordion Item #3
                    </button>
                </h2>
                <div id="q3" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the third item's accordion body. Nothing more exciting happening here in terms of content, but just filling up the space to make it look, at least at first glance, a bit more representative of how this would look in a real-world application.</div>
                </div>
            </div>
        </div>
    </div>
</section>
















<!-- Contributors -->
<section id="contributors" class="p-5 bg-logo">
    <div class="container">
        <h2 class="text-center text-white">Contributors</h2>
        <p class="lead text-center text-white mb-5">
            The people that make GroLancer possible.
        </p>

        <div class="row g-4 contributors">
            <div class="col-md-6">
                <div class="card bg-light">
                    <div class="card-body text-center">
                        <img class="rounded-circle mb-3 img-fluid" src="img/cartoon-jd.png" alt="JD Simpkins" />
                        <h3 class="card-title mb-3">JD Simpkins</h3>
                        <p class="card-text">JD is a freelance web developer and built GroLancer from the ground up, being passionate about helping others succeed. </p>
                        <a href="/" target="_blank"><i class="fa-brands fa-facebook text-dark mx-2 h3"></i></a>
                        <a href="/" target="_blank"><i class="fa-brands fa-linkedin text-dark mx-2 h3"></i></a>
                        <a href="/" target="_blank"><i class="fa-brands fa-github text-dark mx-2 h3"></i></a>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card bg-light">
                    <div class="card-body text-center">
                        <img class="rounded-circle mb-3" src="img/heather.jpeg" alt="Heather Grant" />
                        <h3 class="card-title mb-3">Heather Grant</h3>
                        <p class="card-text">Heather is a freelance virtual assistant and contributes regularly to the GroLancer blog and podcast.</p>
                        <a href="/" target="_blank"><i class="fa-brands fa-facebook text-dark mx-2 h3"></i></a>
                        <a href="/" target="_blank"><i class="fa-brands fa-linkedin text-dark mx-2 h3"></i></a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>















 <!-- Contact Map -->
 <section id="contact" class="p-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-md">
                <h2 class="text-center mb-4">Contact Info</h2>
                <ul class="list-group list-group-flush lead">
                    <li class="list-group-item">
                        <span class="fw-bold">Headquarters:</span> Ashland, KY
                    </li>
                    <li class="list-group-item">
                        <span class="fw-bold">Phone: </span> (606) 618-5364
                    </li>
                    <li class="list-group-item">
                        <span class="fw-bold">Email: </span> support@grolancer.com
                    </li>
                </ul>
            </div>

            <div class="col-md">
                <img class="img-fluid rounded" src="img/grolancer-map.png" alt="GroLancer Headquarters" />
            </div>
        </div>
    </div>
</section>

















@endsection