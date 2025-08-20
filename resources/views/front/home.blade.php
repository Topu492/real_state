@extends('front.layouts.master')

@section('main_content')
<div class="slider" style="background-image">
    <div class="bg"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="item">
                    <div class="text">
                        <h2>Discover Your New Home</h2>
                        <p>
                            You can get your desired awesome properties, homes, condos etc. here by name, category or location.
                        </p>
                    </div>
                    <div class="search-section">
                        <form action="" method="get">
                            <div class="inner">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <input type="text" name="name" class="form-control" placeholder="Find Anything ..." value="">
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <select name="location" class="form-select select2">
                                                <option value="">Select Location</option>
                                              
                                                    <option value=""></option>
                                               
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <select name="type" class="form-select select2">
                                                <option value="">Select Type</option>
                                              
                                                    <option value=""></option>
                                              
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-search"></i>
                                            Search
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="property">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="heading">
                    <h2>Featured Properties</h2>
                    <p>Find out the awesome properties that you must love</p>
                </div>
            </div>
        </div>
        <div class="row">
       
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="item">
                    <div class="photo">
                        <img class="main" src="" alt="">
                        <div class="top">
                           
                            <div class="status-sale">
                                For Sale
                            </div>
                         
                            <div class="status-rent">
                                For Rent
                            </div>
                            
                          
                            <div class="featured">
                                Featured
                            </div>
                        
                        </div>
                        <div class="price">$</div>
                        <div class="wishlist"><a href=""><i class="far fa-heart"></i></a></div>
                    </div>
                    <div class="text">
                        <h3><a href=""></a></h3>
                        <div class="detail">
                            <div class="stat">
                                <div class="i1">sqft</div>
                                <div class="i2"> Bed</div>
                                <div class="i3"> Bath</div>
                            </div>
                            <div class="address">
                                <i class="fas fa-map-marker-alt"></i> 
                            </div>
                            <div class="type-location">
                                <div class="i1">
                                    <i class="fas fa-edit"></i> 
                                </div>
                                <div class="i2">
                                    <i class="fas fa-location-arrow"></i>
                                </div>
                            </div>
                            <div class="agent-section">
                               
                                <img class="agent-photo" src="" alt="">
                            
                                <img class="agent-photo" src="" alt="">
                                
                                <a href=""> </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
           

        </div>
    </div>
</div>


<div class="why-choose" style="background-image">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="heading">
                    <h2>Why Choose Us</h2>
                    <p>
                        Describing why we are best in the property business
                    </p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="inner">
                    <div class="icon">
                        <i class="fas fa-briefcase"></i>
                    </div>
                    <div class="text">
                        <h2>Years of Experience</h2>
                        <p>
                            With decades of combined experience in the industry, our agents have the expertise and knowledge to provide you with a seamless home-buying experience.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="inner">
                    <div class="icon">
                        <i class="fas fa-search"></i>
                    </div>
                    <div class="text">
                        <h2>Competitive Prices</h2>
                        <p>
                            We understand that buying a home is a significant investment, which is why we strive to offer competitive prices to our clients.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="inner">
                    <div class="icon">
                        <i class="fas fa-share-alt"></i>
                    </div>
                    <div class="text">
                        <h2>Responsive Communication</h2>
                        <p>
                            Our responsive agents are here to answer your questions and address your concerns, ensuring a smooth and stress-free home-buying experience.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="agent">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="heading">
                    <h2>Agents</h2>
                    <p>
                        Meet our expert property agents from the following list
                    </p>
                </div>
            </div>
        </div>
        <div class="row">
         
            <div class="col-lg-3 col-md-3">
                <div class="item">
                    <div class="photo">
                        <a href=""><img src="" alt=""></a>
                    </div>
                    <div class="text">
                        <h2>
                            <a href=""></a>
                        </h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="location pb_40">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="heading">
                    <h2>Locations</h2>
                    <p>
                        Check out all the properties of important locations
                    </p>
                </div>
            </div>
        </div>
        <div class="row">
            
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="item">
                    <div class="photo">
                        <a href=""><img src="" alt=""></a>
                    </div>
                    <div class="text">
                        <h2><a href=""></a></h2>
                        <h4></h4>
                    </div>
                </div>
            </div>
           
        </div>
    </div>
</div>



<div class="testimonial" style="background-image: url({{ asset('uploads/testimonial-bg.jpg') }})">
    <div class="bg"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="main-header">Our Happy Clients</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="testimonial-carousel owl-carousel">
                    
                  
                    <div class="item">
                        <div class="photo">
                            <img src="" alt="">
                        </div>
                        <div class="text">
                            <h4></h4>
                            <p></p>
                        </div>
                        <div class="description">
                            
                        </div>
                    </div>
                   

                </div>
            </div>
        </div>
    </div>
</div>

<div class="blog">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="heading">
                    <h2>Latest News</h2>
                    <p>
                        Check our latest news from the following section
                    </p>
                </div>
            </div>
        </div>
        <div class="row">
            
            <div class="col-lg-4 col-md-6">
                <div class="item">
                    <div class="photo">
                        <img src="" alt="">
                    </div>
                    <div class="text">
                        <h2>
                            <a href=""></a>
                        </h2>
                        <div class="short-des">
                            <p>
                                
                            </p>
                        </div>
                        <div class="button">
                            <a href="" class="btn btn-primary">Read More</a>
                        </div>
                    </div>
                </div>
            </div>
          
        </div>
    </div>
</div>
@endsection