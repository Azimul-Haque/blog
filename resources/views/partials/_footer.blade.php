<!-- {!!Html::style('css/sticky-footer-navbar.css')!!} -->

<div class="container">
    <p class="text-muted text-center">
    	<hr>
            <p class="text-muted text-center">ব্লগ | হিউম্যানস অব ঠাকুরগাঁও-এ প্রকাশিত সকল লেখা এবং মন্তব্যের দায় লেখক-ব্লগার ও মন্তব্যকারীর। কোন ব্লগপোস্ট এবং মন্তব্যের দায় কোন অবস্থায় 'ব্লগ | হিউম্যানস অব ঠাকুরগাঁও' কর্তৃপক্ষ বহন করবে না</p>
        <hr>
    </p>
</div>

<div class="footer">
    <div class="container">
    	<div class="row">
            <div class="col-md-4 visible-md-block visible-lg-block">
                <a href="http://humansofthakurgaon.org/"><i class="fa fa-rss-square" aria-hidden="true"></i> Humans of Thakurgaon</a><br/>
                <a href="/about#rules"><i class="fa fa-plug" aria-hidden="true"></i> ব্লগ ব্যাবহারের নিয়মাবলী</a><br/>
                <a href="/about#conditions"><i class="fa fa-gavel" aria-hidden="true"></i> ব্লগ ব্যবহারের শর্তাবলী</a><br/>
                <a href="/contact"><i class="fa fa-envelope" aria-hidden="true"></i> যোগাযোগ</a><br/><br/>
            </div>
    		<div class="col-md-4 hidden-md hidden-lg text-center">
    			<a href="http://humansofthakurgaon.org/"><i class="fa fa-rss-square" aria-hidden="true"></i> Humans of Thakurgaon</a><br/>
    			<a href="/about#rules"><i class="fa fa-plug" aria-hidden="true"></i> ব্লগ ব্যাবহারের নিয়মাবলী</a><br/>
    			<a href="/about#conditions"><i class="fa fa-gavel" aria-hidden="true"></i> ব্লগ ব্যবহারের শর্তাবলী</a><br/>
    			<a href="/contact"><i class="fa fa-envelope" aria-hidden="true"></i> যোগাযোগ</a><br/><br/>
    		</div>

    		<div class="col-md-4">
                <center>
                <span class="text-muted" style="font-size: 20px; line-height: 2em;">সামাজিক যোগাযোগ মাধ্যম</span><br/>
                <!-- Like -->
                <div class="fb-like" data-href="https://www.facebook.com/humansofthakurgaon/?ref=bookmarks" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="false"></div>
                <!-- Like -->
                
                <!-- Share -->
                <div class="fb-share-button" data-href="http://blog.humansofthakurgaon.org/" data-layout="button" data-size="small" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Fblog.humansofthakurgaon.org%2F&amp;src=sdkpreparse">Share</a></div>
                <!-- Share -->

                <!-- Send -->
                <div class="fb-send" data-colorscheme="dark" data-href="http://blog.humansofthakurgaon.org/"></div>
                <!-- Send -->

                <!-- Save -->
                <div class="fb-save" data-uri="http://blog.humansofthakurgaon.org/" data-size="small"></div>
                <!-- Save -->
                <br/>
                <center>
                
                <table border="0" width="100%">
                    <tr>
                        <td width="20%"></td>
                        <td>
                            <ul class="" style="list-style-type: none;">
                                <li class="shareLI text-center">
                                    <a class='btn btn-success btn-xs' style="height: 20px !important; border-radius: 3px !important;" href='http://instagram.com/humansofthakurgaon?ref=badge'><i class="fa fa-instagram" aria-hidden="true"></i> Instagram</a>
                                </li>
                                <li class="shareLI text-center">
                                    <a class="twitter-follow-button" style="" href="https://twitter.com/humansoftkg" data-show-screen-name="false" data-show-count="false">Follow</a>
                                </li>
                            </ul>
                        </td>
                        <td width="20%"></td>
                    </tr>
                </table>
                </center>
                <br/>
                </center>
            </div>
            <div class="col-md-4 visible-md-block visible-lg-block">
                <div class="right">{{ bn_date($totaluserforfooter->id) }} জন ব্লগার <i class="fa fa-users" aria-hidden="true"></i></div><br/>
                <div class="right">{{ bn_date($totalpostsforfooter->id) }} টি ব্লগপোস্ট <i class="fa fa-clipboard" aria-hidden="true"></i></div><br/>
                <div class="right">{{ bn_date($totalcomandrepsforfooter) }} টি মন্তব্য-প্রতিমন্তব্য <i class="fa fa-comments-o" aria-hidden="true"></i></div><br/>
                <div class="right">{{ bn_date($visitlogvisits->id) }} বার অভিগমন/ পরিদর্শন <i class="fa fa-eye" aria-hidden="true"></i></div><br/>
            </div>
    		<div class="col-md-4 hidden-md hidden-lg text-center">
                <div class=""><i class="fa fa-users" aria-hidden="true"></i> {{ bn_date($totaluserforfooter->id) }} জন ব্লগার</div><br/>
                <div class=""><i class="fa fa-clipboard" aria-hidden="true"></i> {{ bn_date($totalpostsforfooter->id) }} টি ব্লগপোস্ট</div><br/>
                <div class=""><i class="fa fa-comments-o" aria-hidden="true"></i> {{ bn_date($totalcomandrepsforfooter) }} টি মন্তব্য-প্রতিমন্তব্য</div><br/>
                <div class=""><i class="fa fa-eye" aria-hidden="true"></i> {{ bn_date($visitlogvisits->id) }} বার অভিগমন/ পরিদর্শন</div><br/>
            </div>
    	</div>
        <hr>
	    <p class="text-muted text-center">&copy; {{date('Y')}} Copyright Reserved, Blog | Humans of Thakurgaon</p>
	</div>
</div>

