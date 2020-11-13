{{-- @dd($apartment) --}}
@extends('layouts.app')
@section('content')

<!-- navbar fittizia -->

        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item active">
                                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Link</a>
                            </li>
                            <li class="nav-item dropdown">

                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                            </li>
                        </ul>
                        <form class="form-inline my-2 my-lg-0">
                            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                        </form>
                    </div>
            </nav>
        </div>
        <!-- section titolo MOCKUP3 -->

        <div class="container">
            <div class="card mb-3">
                <img src="https://a0.muscache.com/im/pictures/a521cb47-fe9b-4d6b-b69d-6777b012edf2.jpg?aki_policy=large" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Appartamento panoramico vista mare</h5>
                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                    <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                </div>

        </div>

        <section class="offer bg-light">
            <div class="container py-5">
                <div class="row">
                    <div class="col-lg-6 wow animate__animated animate__fadeInLeft">
                        <img src="https://www.thespruce.com/thmb/_WJOc-34GLmc5QAzOR-3TXKumu8=/960x0/filters:no_upscale():max_bytes(150000):strip_icc():format(webp)/bed-and-fireplace-in-luxury-bedroom-748316169-37b1062605034b23ab6d193be9c58ef6.jpg" class="img-fluid" alt="">
                    </div>
                    <div class="col-lg-6">
                        <div class="details wow animate__animated animate__fadeInRight">
                            <h2 class="py-3">Lorem</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</p>
                        </div>

                        <div class="detail_bedroom wow animate__animated animate__fadeInRight animate__delay-1s">
                            <h5 class="pt-5 pl-3">Bedroom</h5>
                            <p class="pl-3">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</p>
                        </div>

                        <div class="detail_rooms wow animate__animated animate__fadeInRight animate__delay-2s">
                            <h5 class="pt-5 pl-3">Bedroom</h5>
                            <p class="pl-3">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</p>
                        </div>

                    </div>
                </div>
            </div>
        </section>

        <section class="offer bg-light">

            <div class="container py-5">
                <div class="row">
                    <div class="col-lg-6 wow animate__animated animate__flipInX animate__delay-1s">
                        <img src="https://www.ladige.it/sites/www.ladige.it/files/styles/798x457/public/google%20maps.jpg?itok=G0_VMHYd" class="img-fluid" alt="">
                    </div>


                    <div class="col-lg-5 mb-lg-0 mb-4 wow animate__animated animate__fadeInRight animate__delay-1s">
                        <div class="card">
                            <div class="card-body">
                                <!-- Header -->
                                <div class="form-header blue accent-1">
                                    <h3 class="mt-2"><i class="fas fa-envelope"></i> Write to us:</h3>
                                </div>

                                <p class="dark-grey-text">We'll write rarely, but only the best content.</p>

                                  <!-- Body -->
                                <div class="md-form">
                                    <i class="fas fa-user prefix grey-text"></i>
                                    <input type="text" id="form-name" class="form-control">
                                    <label for="form-name">Your name</label>
                                </div>

                                <div class="md-form">
                                    <i class="fas fa-envelope prefix grey-text"></i>
                                    <input type="text" id="form-email" class="form-control">
                                    <label for="form-email">Your email</label>
                                </div>

                                <div class="md-form">
                                    <i class="fas fa-tag prefix grey-text"></i>
                                    <input type="text" id="form-Subject" class="form-control">
                                    <label for="form-Subject">Subject</label>
                                </div>

                                <div class="md-form">
                                    <i class="fas fa-pencil-alt prefix grey-text"></i>
                                    <textarea id="form-text" class="form-control md-textarea" rows="3"></textarea>
                                    <label for="form-text">Send message</label>
                                </div>

                                <div class="text-center">
                                    <button class="btn btn-light-blue">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
@endsection
