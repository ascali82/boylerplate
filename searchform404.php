<form class="uk-search uk-search-large uk-align-center" action="<?php echo home_url( '/' ); ?>" method="get" role="search">
    <label for="search">Search in <?php echo home_url( '/' ); ?></label>
    <input class="uk-search-input" type="search" name="s" id="search" value="<?php the_search_query(); ?>"  placeholder="Search..." />
    <span class="uk-search-icon-flip" uk-search-icon></span>
</form>

<form role="search" method="get" class="search-form" action="http://localhost/boylerplate/">
				<label>
					<span class="screen-reader-text">Ricerca per:</span>
					<input type="search" class="search-field" placeholder="Cerca &hellip;" value="" name="s" />
				</label>
				<input type="submit" class="search-submit" value="Cerca" />
			</form>