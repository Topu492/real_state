<div class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="item">
                    <h2 class="heading">Important Links</h2>
                    <ul class="useful-links">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="{">Properties</a></li>
                        <li><a href="">Agents</a></li>
                        <li><a href="">Blog</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="item">
                    <h2 class="heading">Locations</h2>
                    <ul class="useful-links">
                        
                            <li><a href=""></a></li>
                     
                    </ul>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="item">
                    <h2 class="heading">Contact</h2>

                  
                    <div class="list-item">
                        <div class="left">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="right">
                           
                        </div>
                    </div>
                  

                  
                    <div class="list-item">
                        <div class="left">
                            <i class="fas fa-phone"></i>
                        </div>
                        <div class="right"></div>
                    </div>
                  

             
                    <div class="list-item">
                        <div class="left">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="right"></div>
                    </div>
                
                    
                
                    <ul class="social">
                      
                        <li>
                            <a href=""><i class="fab fa-facebook-f"></i></a>
                        </li>
                      

                       
                        <li>
                            <a href=""><i class="fab fa-twitter"></i></a>
                        </li>
                   

                      
                        <li>
                            <a href=""><i class="fab fa-linkedin-in"></i></a>
                        </li>
                      

                       
                        <li>
                            <a href=""><i class="fab fa-instagram"></i></a>
                        </li>
                       
                    </ul>
                   

                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="item">
                    <h2 class="heading">Newsletter</h2>
                    <p>
                        To get the latest news from our website, please
                        subscribe us here:
                    </p>
                   <form action="{{ route('subscriber_send_email') }}" method="post" class="form_subscribe_ajax">
                        @csrf
                        <div class="form-group">
                            <input type="text" name="email" class="form-control" placeholder="Your Email Address">
                            <span class="text-danger error-text email_error"></span>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Subscribe Now">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="footer-bottom">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="copyright">
                  
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="right">
                    <ul>
                        <li><a href="{{ route('terms') }}">Terms of Use</a></li>
                        <li>
                            <a href="{{ route('privacy') }}">Privacy Policy</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    (function($){
        $(".form_subscribe_ajax").on('submit', function(e){
            e.preventDefault();
            $('#loader').show();
            var form = this;
            $.ajax({
                url:$(form).attr('action'),
                method:$(form).attr('method'),
                data:new FormData(form),
                processData:false,
                dataType:'json',
                contentType:false,
                beforeSend:function(){
                    $(form).find('span.error-text').text('');
                },
                success:function(data)
                {
                    $('#loader').hide();
                    if(data.code == 0)
                    {
                        $.each(data.error_message, function(prefix, val) {
                            $(form).find('span.'+prefix+'_error').text(val[0]);
                        });
                    }
                    else if(data.code == 1)
                    {
                        $(form)[0].reset();
                        iziToast.success({
                            message: data.success_message,
                            position: 'topRight',
                            timeout: 5000,
                            progressBarColor: '#00FF00',
                        });
                    }
                    
                }
            });
        });
    })(jQuery);
</script>
<div id="loader"></div>