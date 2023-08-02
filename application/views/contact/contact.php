<link rel="stylesheet" href="<?php echo base_url('assets/web/CSS/contact.css')?>">

<section id="contact-form" class="contact-form">
    <div class="container">
        <div class="form-section">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="contact-img">
                        <img class="lazy" data-src="<?php echo base_url('assets/web/images/contact-us.png')?>" width="100%" alt="">
                    </div>
                    <div class="text-content">
                        <h3 class="email"><i class="fas fa-envelope"> </i> info@shyamalsylhet.com</h3>
                        <h3 class="phone"><i class="fas fa-phone"> </i> +৮৮ ০১৭১২০৩৫৫৭৭</h3>
                        
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">

                    <form action="">
                        <div class="title">যোগাযোগ</div>
                        <div class="row">

                            <div class="col-lg-12 col-md-12 mb-3">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingInput" placeholder="নাম" required>
                                    <label for="floatingInput">আপনার নাম</label>
                                </div>

                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control" id="floatingInput" placeholder="ই-মেইল" required>
                                    <label for="floatingInput">ই-মেইল</label>
                                </div>

                                <div class="form-floating text-area">
                                    <textarea class="form-control" placeholder="মন্তব্য" rows="12" cols="50" maxlength="200" id="floatingTextarea" required></textarea>
                                    <label for="floatingTextarea">মন্তব্য</label>
                                    <span id='remainingC'></span>
                                </div>
                            </div>
                            
                            
                        </div>
                    

                    

                        <div class="row">
                            <div class="col-lg-12">
                                <button type="submit" class="submit">জমা দিন</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    $('textarea').keypress(function(){

        if(this.value.length > 160){
            return false;
        }
        
        $('textarea').on('keyup', function(e) {
            $("#remainingC").show();
            if(this.value.length === 0){
                $("#remainingC").hide();
            }
            $("#remainingC").html("Remaining characters : " +(160 - this.value.length));
        })
        
    });
</script>