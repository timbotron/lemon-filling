<div class="container">
	<div class="row">
	<div class="offset4 span5">
		<h2>About Lemon-filling</h2>
		<p>Lemon-filling is a tool to build localization (multi-language) support into your small to medium-sized application. With Lemon-filling, you can create terms, define those terms in various locales, and group terms together into pages. Via MySQL query in your application, ask for a page, specify the locale you desire, and all terms on that page will be returned. Comes with web-based admin area to create and manage your localized content.</p>
		<p>Lemon-filling is suitable for web-based and traditional applications. It is open-source and free to use.</p>
	<h3>Demo</h3>
	<p>Here is a demonstration of how easy it can be to pull data out of Lemon-filling. As you can see in the URI, you just need to give it the page_name and locale id, and you'll get the JSON-formatted output of the terms associated for that page.</p>
	<ul>
		<li><a href="<?php echo site_url('/pages/json/sign_in/1');?>"><?php echo site_url('/pages/json/sign_in/1');?></a></li>
		<li><a href="<?php echo site_url('/pages/json/sign_in/2');?>"><?php echo site_url('/pages/json/sign_in/2');?></a></li>
	</ul>
	<h3>Credits</h3>
	<ul>
		<li>Author: Tim Habersack
			<ul>
				<li>Email: <a href="mailto:tim@hithlonde.com">tim@hithlonde.com</a></li>
				<li>Blog: <a href="http://tim.hithlonde.com">tim.hithlonde.com</a></li>
			</ul>
		</li>
		<li><a href="http://ellislab.com/codeigniter">CodeIgniter PHP Framework</a></li>
		<li><a href="http://twitter.github.com/bootstrap/index.html">Twitter Bootstrap</a></li>
		<li><a href="https://www.mysql.com/">MySQL</a></li>
	</ul>
	<h3>License</h3>
	<p>Info to go here</p>
	</div>
	</div>
</div> <!-- /container -->

</body>
</html>