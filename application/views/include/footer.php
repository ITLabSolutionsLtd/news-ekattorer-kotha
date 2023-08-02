<div class="contaienr-fluid py-2"></div>


<!-------- ************** ----------->
<!-------- FOOTER SECTION ----------->
<!-------- ************** ----------->

<footer class="pt-3">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="footer-brand-nav p-2">
                    <div class=" responsive-footer-nav d-flex align-items-center">
                        <a href="#">
                            <div class="template-logo">
                                <a href="<?php echo base_url(); ?>">
                                    <img src="<?= base_url('images/ekattorer-kotha-logo.png') ?>" width="100%">
                                </a>
                            </div>
                        </a>

                    </div>
                </div>

                <div class="row mt-3 pb-3">

                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                        <div class="footer-box ">
                            <h3>আমাদের সম্পর্কে</h3>
                            <p class="detail-text mb-1"> মো. নজরুল ইসলাম কর্তৃক বিসমিল্লাহ অফসেট প্রিন্টিং প্রেস লালদীঘিরপার, সিলেট থেকে মুদ্রিত ও বিসিক শিল্পনগরী, গোটাটিকর, সিলেট থেকে প্রকাশিত। </p>
                            <p class="text-muted mt-1" > <strong> &copy - একাত্তরের কথা <?php echo bn_convert(date('Y')); ?>  </strong> </p>
            
                        </div>
                    </div>

                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                        <div class="footer-box ">
                            <h3 style="visibility: hidden" >আমাদের সম্পর্কে</h3>
                            <p class="mb-1">সম্পাদক : <strong> চৌধুরী মুমতাজ আহমদ</strong> </p>
                            <p>প্রকাশক : <strong> মো. নজরুল ইসলাম</strong> </p> <br>

                        </div>
                    </div>

                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                        <div class="footer-box">
                            <h3>যোগাযোগ</h3>

                            <div class="footer-box">
                                <span>কার্যালয়: রংমহল টাওয়ার, ৫ম তলা, বন্দরবাজার, সিলেট </span>
                            </div>

                            <div class="important-links list-group mb-2">
                                <span> <strong>ই-মেইল</strong> <small>(বার্তা) :</small>  <a href="mailto:barta.ekattor@gmail.com" >  barta.ekattor@gmail.com</a></span>
                                <span> <strong>ই-মেইল</strong> <small>(বিজ্ঞাপন) :</small> <a href="mailto:ekattor.ad@gmail.com" >  ekattor.ad@gmail.com</a></span>
                                <span> <strong>ফোন</strong> : <a href="tel: 0821719202"> ০৮২১-৭১৯২০২ </a></span>
                            </div>
                            <div class="footer-social">
                                <div class="d-flex">
                                    <a href="https://www.facebook.com/ekattorerkotha/" target="_blank"><i class="fab fa-facebook"></i></a>
                                    <a href="#"><i class="fab fa-twitter"></i></a>
                                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                                    <a href="https://www.youtube.com/channel/UCUtVg6kZ6R2UC71_9Mihc8g/featured" target="_blank"><i class="fab fa-youtube"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright-text text-center">
        <h5 class="mb-0"><span class="fw-bold"> পোর্টাল তৈরি ও তত্ত্বাবধানে <a href="https://www.itlabsolutions.com/" target="_blank" style="color: #00bcd4"> <img src="<?= base_url('images/itlabsolutions-bg-white.png') ?>" width="10%" > আইটি ল্যাব সলিউশন্স লি.</a></span></h5>
    </div>
</footer>
<!-- Bootstrap js / Fontawsome js / Main js -->


<!--- Bangla Date Picker --->

<script>
    $(function () {
        var fullmonth_array = $.datepicker.regional['bn-BD'].monthNames;
 
        $.datepicker.setDefaults($.datepicker.regional['bn-BD']);
        $("#date_of_birth").datepicker({
            dateFormat: "dd/mm/yy",
            monthNamesShort: fullmonth_array,
            changeMonth: true,
            changeYear: true,
            maxDate: '0',
        }, $.datepicker.regional['bn-BD']);
    });


</script>


<script type="text/javascript">
    jQuery.browser = {};
    (function () {
        jQuery.browser.msie = false;
        jQuery.browser.version = 0;
        if (navigator.userAgent.match(/MSIE ([0-9]+)\./)) {
            jQuery.browser.msie = true;
            jQuery.browser.version = RegExp.$1;
        }
    })();
</script>

<script>
    $(window).bind("load", function() { 
        $('.weather-div-main').show(); 
        $('.fb-page').show(); 
    });
</script>

<script type="text/javascript">
    $(document).on("change", "#date_of_birth", function () {
        var dateArr = $(this).val().split('/');
        var banglaDate = mrt(dateArr[0]) + '/' + mrt(dateArr[1]) + '/' + mrt(dateArr[2]);
        $(this).val(banglaDate);
    });
</script>

<!--- Bangla Date Picker --->

<script>
    $(document).ready(function () {
        $("#toggle-search").click(function () {
            $("#searchBar").toggle();
        });
    });
</script>


<script>
    document.addEventListener("DOMContentLoaded", function(){
        window.addEventListener('scroll', function() {
            if (window.scrollY > 200) {
                document.getElementById('fixed_top_navbar').classList.add('fixed-top');
                // add padding top to show content behind navbar
                navbar_height = document.querySelector('.fixed-nav').offsetHeight;
                document.body.style.paddingTop = navbar_height + 'px';
            } 
            else {
                document.getElementById('fixed_top_navbar').classList.remove('fixed-top');
                document.body.style.paddingTop = '0';
            } 
        });
    }); 
</script>



<script>

    $(".lazy").on("load", function(){
        // console.log("loaded!")
    });

    $(function() {
        $('.lazy').lazy({
            chainable: false, // tell lazy to return its own instance
            placeholder: "data:image/gif;base64,R0lGODlhEALAPQAPzl5uLr9Nrl8e7...",
            effect: "fadeIn",
            effectTime: 100,
            threshold: 100
        });
    });
</script>

<script>
    var owl = $('.header-owl');
    owl.owlCarousel({
        loop:true,
        margin:10,
        nav:true,
        autoplay:true,
        dots: false,
        autoplayTimeout:5000,
        autoplayHoverPause:true,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:3
            },
            1000:{
                items:5
            }
        }
    });
</script>

<script>
    $('.floting-slider').owlCarousel({
        loop: true,
        margin: 10,
        lazyLoad:true,
        nav: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 2
            },
            1000: {
                items: 5
            }
        }
    })

    $('.list-slider').owlCarousel({
        loop: true,
        margin: 10,
        nav: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            1000: {
                items: 1
            }
        }
    })
</script>

<script>
    $(document).ready(function() {
        $(document).on('click', '#btn_more', function() {
            var news_id     = $(this).data("vid");
            var cat         = $("#fetch_cat_id").val();
            var subcat      = $("#fetch_subcat_id").val();
            var segment     = $(this).data("segment");
            $('#btn_more').html("<i class='fa fa-spinner fa-spin'></i>");
            $.ajax({
                url: "<?php echo base_url(); ?>News/Loadmore_category/",
                method: "POST",
                data: {
                    news_id: news_id,
                    cat: cat,
                    segment: segment,
                    subcat: subcat
                },
                dataType: "text",
                success: function(data) {
                    if (data != '') {
                        $('#remove_row').remove();
                        $('#load_data_table').append(data);
                        var rowCount = $('#load_data_table .rowCount').length;

                        if (rowCount % 12 != 0) {
                            document.getElementById('btn_more').style.display = 'none';
                        }
                    } else {
                        // $('#btn_more').html("দুঃখিত ! আর কোন তথ্য নেই ।");
                        document.getElementById('btn_more').style.visibility = 'hidden';
                    }
                }
            });
        });
    });
</script>

<script>
    $(document).ready(function() {
        $(document).on('click', '#btn_filter_more_avd', function() {
            var news_id = $(this).data("vid");
            var search_item = $(this).data("search");
            var search_date = $(this).data("date");

            $('#btn_filter_more_avd').html("আরো <i class='fa fa-spinner fa-spin'></i>");
            $.ajax({
                url: "<?php echo base_url(); ?>News/Loadmore_filter_news_avd/",
                method: "POST",
                data: {
                    news_id: news_id,
                    search_item: search_item,
                    search_date: search_date,
                },
                dataType: "text",
                success: function(data) {
                    if (data != '') {
                        $('#remove_row').remove();
                        $('#load_data_table').append(data);
                    } else {
                        // $('#btn_more').html("দুঃখিত ! আর কোন তথ্য নেই ।");
                        document.getElementById('btn_filter_more_avd').style.visibility = 'hidden';
                    }
                }
            });
        });
    });
</script>

<script>
    (function(global) {
        const SECOND = 1;
        const MINUTE = 60;
        const HOUR = 3600;
        const DAY = 86400;
        const WEEK = 604800;
        const MONTH = 2629746;
        const YEAR = 31556952;
        const DECADE = 315569520;

        global.timeAgo = function(date) {
            var now = new Date("<?php echo date('D M d Y H:i:s') . ' GMT+0600 (Bangladesh Standard Time)'; ?>");
            var diff = Math.round((now - date) / 1000);

            var unit = '';
            var num = 0;
            var plural = false;

            switch (true) {
                case diff <= 0:
                    return 'এইমাত্র';
                    break;

                case diff <= MINUTE:
                    num = Math.round(diff / SECOND);
                    unit = 'সেকেন্ড';
                    plural = num > 1;
                    break;

                case diff < HOUR:
                    num = Math.round(diff / MINUTE);
                    unit = 'মিনিট';
                    plural = num > 1;
                    break;
                case diff < DAY:
                    num = Math.round(diff / HOUR);
                    unit = 'ঘন্টা';
                    plural = num > 1;
                    break;
                case diff < WEEK:
                    num = Math.round(diff / DAY);
                    unit = 'দিন';
                    plural = num > 1;
                    break;
                case diff < MONTH:
                    num = Math.round(diff / WEEK);
                    unit = 'সপ্তাহ';
                    plural = num > 1;
                    break;
                case diff < YEAR:
                    num = Math.round(diff / MONTH);
                    unit = 'মাস';
                    plural = num > 1;
                    break;
                case diff < DECADE:
                    num = Math.round(diff / YEAR);
                    unit = 'বছর';
                    plural = num > 1;
                    break;
                default:
                    num = Math.round(diff / YEAR);
                    unit = 'বছর';
                    plural = num > 1;
            }
            var str = '';
            if (num) {
                str += `${num} `;
            }
            str += `${unit}`;
            if (plural) {
                str += '';
            }
            str += ' আগে';
            return str;
        }
    })(window);

    var numbers = {
        0: '০',
        1: '১',
        2: '২',
        3: '৩',
        4: '৪',
        5: '৫',
        6: '৬',
        7: '৭',
        8: '৮',
        9: '৯'
    };

    function replaceNumbers(input) {
        var output = [];
        for (var i = 0; i < input.length; ++i) {
            if (numbers.hasOwnProperty(input[i])) {
                output.push(numbers[input[i]]);
            } else {
                output.push(input[i]);
            }
        }
        return output.join('');
    }
    var dates = $('.previous_date');
    if (dates.length > 0) {
        $.each(dates, function(key, row) {
            var news_id = $(row).data('news_id');
            var date = $(row).val();
            $(row).after(`<span id="time" class="time">${replaceNumbers(timeAgo(new Date(date)))}</span>`)
        });
    }
</script>




</body>

</html>