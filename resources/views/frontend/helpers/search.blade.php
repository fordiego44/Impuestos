<style>
    input:not([href]):not([tabindex]):focus, input:not([href]):not([tabindex]):hover {
		color: inherit;
		text-decoration: none;
	}
	.casaroyal-search-locations-list {
		width: 100%;
		display: inline-block;
		margin: 0!important;
		color: #232628;
		list-style: none;
		box-shadow: 0 10px 15px 0 rgba(0, 0, 0, .1);
		border-radius: 4px;
		-webkit-border-top-left-radius: 0;
		-webkit-border-top-right-radius: 0;
		-moz-border-radius-topleft: 0;
		-moz-border-radius-topright: 0;
		border-top-left-radius: 0;
		border-top-right-radius: 0;
		position: absolute;
		left: 15px;
		top: 58px;
		background-color: #fff;
		width: calc(100% - 30px);
		z-index: 1010;
		padding: 15px 0!important;
		display: none
	}

	.casaroyal-search-locations-list li {
		list-style: none!important;
		width: calc(100% - 30px);
		margin: 0 15px!important
	}

	.casaroyal-search-locations-list li a {
		color: #797979;
		padding: 10px;
		letter-spacing: 0;
		font-size: 16px;
		line-height: 15px;
		border-radius: 4px;
		width: 100%;
		display: inline-block;
		padding-left: 35px;
		position: relative
	}

	.casaroyal-search-locations-list li a .fa {
		opacity: .2;
		font-size: 20px;
		position: absolute;
		top: 8px;
		left: 15px
	}

	.casaroyal-search-locations-list li a .listings_count {
		display: inline-block;
		min-width: 18px;
		padding-left: 6px;
		padding-right: 6px;
		line-height: 18px;
		position: relative;
		top: -1px;
		background: #ff5e14;
		color: #fff!important;
		border-radius: 30px;
		text-align: center;
		margin-left: 5px;
		font-size: 13px
	}

	.casaroyal-search-locations-list li a:hover,
	.casaroyal-search-locations-list li:first-child a {
		background-color: rgba(42, 65, 232, .07);
		color: #003a70
	}

	.casaroyal-search-locations-list li a.property-location-child {
		padding-left: 65px
	}

	.casaroyal-search-locations-list li a.property-location-child .fa {
		left: 35px
	}
</style>