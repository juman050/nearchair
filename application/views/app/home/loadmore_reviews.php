<?php if(!empty($more_reviews)){ foreach($more_reviews as $data_review){?>
<li class="single-raing reviews">
    <div class="col-md-12 col-sm-12 col-xs-12 p-none">
        <div class="row">
            <div class="col-md-3 col-sm-3 col-xs-3 ">
                <div class="cl-img">
                    <img src="<?php echo site_url('resource/app/images/photo.png');?>" alt="">
                </div>
            </div>
            <div class="col-md-9 col-sm-9 col-xs-9 ">
               <div class="content">
                    <h4><?= $data_review->fullname;?></h4>
                    <div class="rating">
                        <?php for($rating=0;$rating<$data_review->rating;$rating++){?>
                            <i class="fa fa-star"></i>
                        <?php } ?>
                        <span><?php echo time_ago($data_review->createdDtm);?> ago</span>
                    </div>
                </div>
            </div>
        </div>
        <p class="p-text"><?=$data_review->review_text;?> </p>
    </div>
</li>
<?php } } ?>