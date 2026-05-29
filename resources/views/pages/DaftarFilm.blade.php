@extends('mainlayout')

@section('maincontent')

<div class="container-fluid custom-padding">

    <div class="row">

        <!-- SIDEBAR -->
        <div class="col-md-2">
            <div class="sidebar p-3">

                <h5 class="font-color font">Genre</h5>
            
                <div class="form-check">
                    <input class="form-check-input" type="checkbox">
                    <label class="form-check-label font-color font">
                        Action
                    </label>
                </div>
            
                <div class="form-check">
                    <input class="form-check-input" type="checkbox">
                    <label class="form-check-label font-color font">
                        Horror
                    </label>
                </div>
            
                <button class="btn btn-primary w-100 mt-3">
                    Terapkan
                </button>
            
            </div>
        </div>

        <!-- CONTENT -->
        <div class="col-md-10">
            <div class="row g-4">
                <div class="col-6 col-sm-5 col-md-4 col-lg-2">

                    <div class="movie-card-list">
                
                        <img src="{{ asset('images/movie1.jpg') }}"
                             class="img-fluid">
                
                        <div class="p-2">
                
                            <h6>The Boys</h6>
                
                            <small>2019 • TV Show</small>
                
                        </div>
                
                    </div>
                
                </div>
                <div class="col-6 col-sm-5 col-md-4 col-lg-2">

                    <div class="movie-card-list">
                
                        <img src="{{ asset('images/movie1.jpg') }}"
                             class="img-fluid">
                
                        <div class="p-2">
                
                            <h6>The Boys</h6>
                
                            <small>2019 • TV Show</small>
                
                        </div>
                
                    </div>
                
                </div>
                <div class="col-6 col-sm-5 col-md-4 col-lg-2">

                    <div class="movie-card-list">
                
                        <img src="{{ asset('images/movie1.jpg') }}"
                             class="img-fluid">
                
                        <div class="p-2">
                
                            <h6>The Boys</h6>
                
                            <small>2019 • TV Show</small>
                
                        </div>
                
                    </div>
                
                </div>
                <div class="col-6 col-sm-6 col-md-4 col-lg-2">

                    <div class="movie-card-list">
                
                        <img src="{{ asset('images/movie1.jpg') }}"
                             class="img-fluid">
                
                        <div class="p-2">
                
                            <h6>The Boys</h6>
                
                            <small>2019 • TV Show</small>
                
                        </div>
                
                    </div>
                
                </div>
            </div>
            
        </div>
        
    </div>

</div>