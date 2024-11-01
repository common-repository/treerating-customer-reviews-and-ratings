<div itemscope itemtype="http://schema.org/WebPage">
	<div itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating" class="blocktreerating">
		<p>
			<img src="<?php echo $rating['star_image']; ?>" alt="" class="img-responsive" /> 
			<span class="treerating-text">
				<meta itemprop="worstRating" content="1"/>
				<span itemprop="ratingValue"><?php echo $rating['rating']; ?></span>/<span itemprop="bestRating">10</span> <?php echo __('based on'); ?> 
				<a href="<?php echo $rating['url']; ?>" title="<?php echo $rating['total_reviews']; ?> <?php echo __('reviews'); ?> " target="_blank">
					<span itemprop="ratingCount"><?php echo $rating['total_reviews']; ?></span> <?php echo __('reviews'); ?> 
				</a>
			</span>
		</p>
	</div>
</div>